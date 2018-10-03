<?php
	if(!defined('IN_CLIPBUCKET'))
	exit('Invalid access');
	
	function destroy_switcher() {
		global $db;
		$db->Execute(
			'DROP TABLE '.tbl("demos").''
		);
	}

	destroy_switcher()
?>