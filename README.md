# Short URL project
## Summary: 
Transforms any url to a short version to be easily used

## Requirements
Multiviews Options must be enabled for this to work

## Database
MySQL

### Table
short_urls

###### Create Statement
    CREATE TABLE `short_urls` (
	  `id` int(11) NOT NULL AUTO_INCREMENT,
	  `short_url` varchar(45) NOT NULL,
	  `long_url` varchar(512) NOT NULL,
	  `clicks` int(11) DEFAULT '0',
	  `create_date` timestamp(6) NULL DEFAULT NULL,
	  PRIMARY KEY (`id`),
	  UNIQUE KEY `id_UNIQUE` (`id`),
	  KEY `id_shortURL` (`short_url`)
	) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;
	
	


