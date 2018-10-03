<?php
	if(!defined('IN_CLIPBUCKET'))
	exit('Invalid access');
	
	function produce_switcher() {
		global $db;
		$db->Execute(
			'CREATE TABLE IF NOT EXISTS '.tbl("demos").' (
				`id` int(20) NOT NULL AUTO_INCREMENT,
				`name` varchar(200) NOT NULL,
				`url` TEXT NOT NULL,
				`date_added` timestamp NOT NULL DEFAULT "0000-00-00 00:00:00",
				 PRIMARY KEY (id)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8;'
		);

	}
	produce_switcher()
?>