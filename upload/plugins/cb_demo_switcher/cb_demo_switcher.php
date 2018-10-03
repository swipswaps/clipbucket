<?php
/*
	Plugin Name: Demo Switcher
	Description: This will let you switch between different demos of cb
	Author: Awais Fiaz
	ClipBucket Version: 4.0
	Plugin Version: 1.0
	Website: https://clipbucket.com/
*/

define("_DEMO_SWITCHER_",basename(dirname(__FILE__)));
define("DEMO_SWITCHER_DIR",PLUG_DIR.'/'._DEMO_SWITCHER_);
define("DEMO_SWITCHER_URL",PLUG_URL.'/'._DEMO_SWITCHER_);
assign("demo_switcher_dir",DEMO_SWITCHER_DIR);
assign("demo_switcher_url",DEMO_SWITCHER_URL);
assign("demo_switcher_admin_url",DEMO_SWITCHER_URL.'/'.'admin');

require_once("includes/demo_switcher.class.php");

$dswitch = new demoSwitcher();
assign('dswitch',$dswitch);

//Registering Premium button anchor
if(!function_exists('show_demo_switcher'))
{
	function show_demo_switcher()
	{
		Template(DEMO_SWITCHER_DIR.'/anchor/switcher.html',false);
	}
}

register_anchor_function('show_demo_switcher','demo_switcher_button');
add_admin_menu('Demo Switcher','Add Demos','add_demos.php',_DEMO_SWITCHER_.'/admin');

?>