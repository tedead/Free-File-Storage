USE file_storage;
DROP PROCEDURE IF EXISTS ffs_delFile;
DELIMITER $$
CREATE PROCEDURE ffs_delFile(
	IN UserID VARCHAR(38),
    IN FileID VARCHAR(38),
    OUT FileName VARCHAR(100),
    OUT FileCount INT
)
BEGIN
    DECLARE File VARCHAR(100);
    DECLARE Count INT;
    
	SELECT COUNT(*) INTO Count
		   FROM files f
		   INNER JOIN user_files uf ON f.FileID = uf.FileID
		   WHERE f.FileID = FileID
			     AND uf.UserID = UserID;
	IF (Count = 1)
	THEN
		SELECT f.Location INTO File
		FROM files f
		INNER JOIN user_files uf ON f.FileID = uf.FileID
		WHERE f.FileID = FileID
			  AND uf.UserID = UserID;
              
		DELETE f
		FROM files f
		WHERE f.FileID = FileID;
		
		DELETE uf
		FROM user_files uf
		WHERE uf.FileID = FileID
			  AND uf.UserID = UserID;
              
        SELECT File AS FileName, Count AS FileCount;
	ELSE
		SELECT 'NoFile' AS FileName, 0 AS FileCount;
    END IF;
END$$
DELIMITER ;