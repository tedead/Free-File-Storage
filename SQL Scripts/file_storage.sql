CREATE TABLE `login` (
 `UserID` int(11) NOT NULL AUTO_INCREMENT,
 `FirstName` varchar(50) DEFAULT '',
 `LastName` varchar(50) DEFAULT '',
 `Email` varchar(50) DEFAULT '',
 `DisplayName` varchar(50) DEFAULT '',
 `UserName` varchar(50) DEFAULT '',
 `Password` varchar(50) DEFAULT '',
 `Created` datetime DEFAULT CURRENT_TIMESTAMP,
 PRIMARY KEY (`UserID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8