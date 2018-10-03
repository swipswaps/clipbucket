<?php

if(!defined('MAIN_PAGE')){
    define('MAIN_PAGE', 'Demo Switcher');
}
if(!defined('SUB_PAGE')){
    define('SUB_PAGE', 'Add Demos');
}

	require_once '../includes/admin_config.php';
	$userquery->admin_login_check();
	$userquery->login_check('admin_access');

	$mode = mysql_clean($_GET['mode']);

	if($mode == 'delete'){
		if(isset($_GET['demoid'])){
			$demoid = mysql_clean($_GET['demoid']);
			if(!empty($demoid)){
				$dswitch->remove_demo($demoid);
			}
		}
	}


	if(isset($_POST['submit_demo'])){
		if(!empty($_POST)){
			$params = $_POST;
			$dswitch->add_demo($params);
		}
	}

	$limit = RESULTS;
	$params['order'] = " date_added DESC ";
	$page = mysql_clean($_GET['page']);
	$get_limit = create_query_limit($page,$limit);
	$count_query = $params;
	$params['limit'] = $get_limit;
	$records = $dswitch->get_demos($params);
	if(!$counter) {
		$rcount = $params;
		$rcount['count_only'] = true;
		$total_rows = $dswitch->get_demos($rcount);
		$counter = $total_rows;
	}
	$total_pages = count_pages($counter,$limit);
	$link=NULL;
	$extra_params=NULL;
	$tag='<li><a #params#>#page#</a><li>';
	$pages->paginate($total_pages,$page,$link,$extra_params,$tag);

	assign('demos', $records);


subtitle("Add cb demos");
template_files(DEMO_SWITCHER_DIR.'/admin/add_demos.html');


?>