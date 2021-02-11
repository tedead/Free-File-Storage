CREATE TABLE `uploads` (
 `ID` varchar(36) NOT NULL DEFAULT 'UUID()',
 `Name` varchar(500) NOT NULL,
 `Size` bigint(20) NOT NULL,
 `Type` varchar(500) NOT NULL,
 `Location` varchar(500) NOT NULL,
 `Date` datetime NOT NULL,
 PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8