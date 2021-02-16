USE file_storage;
DROP PROCEDURE IF EXISTS ffs_delFile;
DELIMITER $$
CREATE PROCEDURE ffs_delFile(
	IN UserID VARCHAR(38),
    IN FileID VARCHAR(38),
    OUT RecordsDeleted INT,
	OUT FileName VARCHAR(100)
)
BEGIN
	SET @count := 0;
    SET @filename := '';
	SET @rowcount = (SELECT COUNT(*)
					 FROM files f
					 INNER JOIN user_files uf ON f.FileID = uf.FileID
					 WHERE f.FileID = FileID
						   AND uf.UserID = UserID
					);
	IF (@rowcount = 1)
	THEN
		SELECT @filename := f.Location
		FROM files f
		INNER JOIN user_files uf ON f.FileID = uf.FileID
		WHERE f.FileID = FileID
			  AND uf.UserID = UserID;
		
		DELETE f
		FROM files f
		WHERE f.FileID = FileID;
		
		SELECT @count := ROW_COUNT();
		
		DELETE uf
		FROM user_files uf
		WHERE uf.FileID = FileID
			  AND uf.UserID = UserID;
			  
		SELECT @count := @count + ROW_COUNT();
		SET RecordsDeleted = @count, FileName = @filename;
	ELSE
		SELECT RecordsDeleted = 0, FileName = '';
    END IF;
END$$
DELIMITER ;