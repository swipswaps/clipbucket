<?php
/**
 * 
 */
class demoSwitcher
{
	private $table='demos';

	function add_demo($params)
	{	
		global $db;
		$demo_name = mysql_clean($params['demo_name']);
		$demo_url = mysql_clean($params['demo_url']);
		if(!$demo_name){
			e('Name cannot be empty');
			return false;
		}
		if(!$demo_url){
			e('Url cannot be empty!');
			return false;
		}else{
			if (!filter_var($demo_url, FILTER_VALIDATE_URL)) {
				e("$demo_url is not a valid URL");
			    return false;
			}

			$insert_id = $db->insert(tbl($this->table),array('name','url','date_added'),array($demo_name,$demo_url,NOW()));
			if($insert_id){
				e('Demo added!','m');
			}else{
				e('Somthing went wrong while insertion!');
			}
		}
	}

		/**
		* Gets a list of all currently beats
		*/
		public function get_demos($params = NULL)
		{
			global $db;
			
			$limit = $params['limit'];
			$order = $params['order'];
			$cond = '';

			if($params['id'])
			{
				if($cond!='')
					$cond .= ' AND ';
				$cond .= " id = '".$params['id']."' ";
			}
			
			if($params['name'])
			{
				if($cond!='')
					$cond .= ' AND ';
				$cond .= " name = '".$params['name']."' ";
			}
			
			if($params['url'])
			{
				if($cond!='')
					$cond .= ' AND ';
				$cond .= " ".('url')." LIKE '%".$params['url']."%'";
			}

			if($params['count_only']){
				return $result = $db->count(tbl($this->table),'*',$cond);
			}

			$query = "SELECT * FROM ".tbl($this->table)." ";
		    
		    if( $cond ) {
		    	$query .= " WHERE ".$cond;
		    }
		    $query .= $order ? " ORDER BY ".$order : false;
		    $query .= $limit ? " LIMIT ".$limit : false;
		    
		    $records = db_select($query);
			if (!empty($records) && is_array($records)){
				return $records;
			}else{
				return false;
			}
		}

		function remove_demo($id)
		{
			global $db;
			$demo = $this->get_demos(['id'=>$id]);
			$demo = $demo[0];
			if(!empty($demo) && is_array($demo))
				$db->delete(tbl($this->table),array("id"),array($id));
			e('Demo has been deleted','m');
		}

}



?>