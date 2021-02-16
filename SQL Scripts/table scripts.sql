DROP TABLE users;
DROP TABLE user_files;
DROP TABLE files;

CREATE TABLE IF NOT EXISTS users (
   UserID varchar(38) NOT NULL,
   FirstName varchar(100) NOT NULL,
   LastName varchar(100) NOT NULL,
   Email varchar(100) NOT NULL,
   DisplayName varchar(100) NOT NULL,
   UserName varchar(100) NOT NULL,
   Password varchar(100) NOT NULL,
   DateCreated datetime NOT NULL,
   PRIMARY KEY (UserID)
 ) ENGINE=MyISAM DEFAULT CHARSET=utf8;
 
CREATE TABLE IF NOT EXISTS user_files (
   FileID varchar(38) NOT NULL,
   UserID varchar(38) NOT NULL,
   DateCreated datetime NOT NULL,
   PRIMARY KEY (FileID, UserID)
 ) ENGINE=MyISAM DEFAULT CHARSET=utf8;
 
 CREATE TABLE IF NOT EXISTS files (
   FileID varchar(38) NOT NULL,
   Name varchar(500) NOT NULL,
   Size bigint(20) NOT NULL,
   Type varchar(500) NOT NULL,
   Location varchar(500) NOT NULL,
   DateCreated datetime NOT NULL,
   PRIMARY KEY (FileID)
 ) ENGINE=MyISAM DEFAULT CHARSET=utf8;