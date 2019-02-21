<?php
class M_main extends CI_Model
    {
		
		var $table = 'project1';
		var $column_order = array(null,'project1_id','project1_token','project1_name','project1_code','project1_platform','project1_version','project1_status'); 
		var $column_search = array('project1_name','project1_code','project1_platform','project1_version'); 
		var $order = array('cdate' => 'desc'); // default order 	
		
		
     	function __construct()
		{
			parent::__construct();
		}
			
			
		private function _get_datatables_query()
		{
		if($this->input->post('status'))
		{
			$this->db->where('project1_status', $this->input->post('status'));
		}
		
		$this->db->from($this->table);
		$this->db->where("activerow",1);
	
		$i=0;
		foreach ($this->column_search as $item) 
		{
			if($_REQUEST['search']['value']) 
			{
				
				if($i==0) 
				{
					$this->db->group_start(); 
					$this->db->like($item, $_POST['search']['value']);
				}
				else
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if(count($this->column_search) - 1 == $i) 
					$this->db->group_end();
			}
			$i++;
		}
		
		
		if(isset($_POST['order'])) 
		{
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	public function get_datatables()
	{
		$this->_get_datatables_query();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	public function count_filtered()
	{
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all()
	{
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}
		
			
			
			
		//SHOW OPENED
		function show_config()
		{
		$myfile 		= fopen("./setting/setting_global.json", "r") or die("Unable to open file!");
		$json			= fread($myfile,filesize("./setting/setting_global.json"));
		$respons		= json_decode($json);
		$data			=(array)$respons; //convert to array
		fclose($myfile);
		return $data;
		}	
		
		/*project */
		function show_project_coming(){
		$this->db->select('project1_id,project1_token,project1_name,
						   project1_code,project1_platform,project1_version,project1_status');
		//$array = array('activerow' => 1, 'project1_status <=' => 1);
		$array = array('activerow' => 1);
		$this->db->where($array);
		$this->db->order_by('project1_id', 'asc');
		$query = $this->db->get('project1');
		return $query;
		}
	
		function show_project_result(){
		$this->db->select('project1_id,project1_token,project1_name,
						   project1_code,project1_platform,project1_version,project1_status');
		$array = array('activerow' => 1);
		$this->db->where($array);
		$query = $this->db->get('project1');
		$this->db->order_by('project1_id', 'asc');
		return $query;
		}
	
		function show_project_status($idproject){
		$this->db->select('project1_status');
		$array = array('activerow' => 1, 'project1_id' => $idproject);
		$this->db->where($array);
		$this->db->limit(1);
		$query = $this->db->get('project1');
		if($query->num_rows()>0)
		{
		$d=$query->result_array();
				if($d[0]['project1_status']=='1')
				{
				$text="<span class='label label-success'><i class='fa fa-check'></i> Accepted </span>";	
				}
				else if($d[0]['project1_status']=='2')
				{
				$text="<span class='label label-danger'><i class='fa fa-remove'></i> Rejected </span>";		
				}
				else 
				{
				$text="<span class='label label-info'><i class='fa fa-refresh'></i> In Progress... </span>";		
				}
		}
		else
		{
		$text="<span class='label label-info'><i class='fa fa-remove'></i>  In Progress... </span>";	
		}	
		return $text;
		}
		
		function show_project_avg($idproject){
		$query 		= $this->db->query("select AVG(a.result1_score) as avgscore from result1 a where a.project1_id='". $idproject ."' limit 1");
		$row		= $query->row();	
		$avgscore	= $row->avgscore;
		return	$avgscore;
		}
		
		function show_project_avg_by_user($idproject,$idadmin){
		$query 		= $this->db->query("select result1_score as avgscore from result1 a where a.project1_id='". $idproject ."' and a.mstadmin_id='". $idadmin ."' limit 1");
		$row		= $query->row();	
		$avgscore	= $row->avgscore;
		return	$avgscore;
		}
			
		function show_project_tester($idproject){
		$query 		= $this->db->query("select a.mstadmin_id,b.mstadmin_name,a.result1_score from result1 a inner join mstadmin b on a.mstadmin_id=b.mstadmin_id
										where a.project1_id='".$idproject ."'");
		return	$query;
		}
				
		function show_idproject_by_token($token){
		$this->db->select('project1_id');
		$array 		= array('activerow' => 1, 'project1_token' =>$token);
					  $this->db->where($array);
		$query 		= $this->db->get('project1');
		$row		= $query->row();	
		return $row->project1_id;
		}
		
		function show_projectname_by_token($token){
		$this->db->select('project1_name');
		$array 		= array('activerow' => 1, 'project1_token' =>$token);
					  $this->db->where($array);
		$query 		= $this->db->get('project1');
		$row		= $query->row();	
		return $row->project1_name;
		}
		
		function show_status_by_token($token){
		$this->db->select('project1_status');
		$array 		= array('activerow' => 1, 'project1_token' =>$token);
					  $this->db->where($array);
		$query 		= $this->db->get('project1');
		$row		= $query->row();	
		return $row->project1_status;
		}
		
		
		/*feature */	
		function manage_feature_by_token($token){
		$this->db->select('feature1_id,feature1_name,feature1_desc');
		$array = array('activerow' => 1, 'project1_token' =>$token);
		$this->db->where($array);
		$this->db->order_by('feature1_id', 'asc');
		$query = $this->db->get('feature1');
		return $query;
		}

		function show_featurename_by_id($id){
		$this->db->select('feature1_name');
		$array 		= array('activerow' => 1, 'feature1_id' =>$id);
					  $this->db->where($array);
		$query 		= $this->db->get('feature1');
		$row		= $query->row();	
		return $row->feature1_name;
		}
		
		function show_total_feature($idproject){
		$query	= $this->db->query("select count(feature1_id) as total from feature1 where project1_id='". $idproject."' and activerow='1'");
		$row	= $query->row();
		$total	= $row->total;
		return $total;
		}	
		
		function show_feature_by_token($token){
		$this->db->select('feature1_id,feature1_name,activerow,totalaction');
		$array = array('activerow' => 1, 'project1_token' =>$token);
		$this->db->where($array);
		$this->db->order_by('feature1_id', 'asc');
		$query = $this->db->get('v_list_feature');
		return $query;
		}
		
		/*actions */	
		function show_total_actions($idfeature){
		$query	=	$this->db->query("select count(action1_id) as total from action1 where feature1_id='". $idfeature."' and activerow='1'");
		$row	= $query->row();
		$total	= $row->total;
		return $total;
		}	
		
		function show_action_by_idfeature($idfeature){
		$this->db->select('action1_id, action1_name,action1_type,action1_type,totalcase,feature1_id,action1_order');
		$array = array('activerow' => 1,'feature1_id' => $idfeature);
		$this->db->where($array);
		$this->db->order_by('action1_order', 'asc');
		$query = $this->db->get('v_actions');
		return $query;
		}
		
		function show_action_by_idfeature2($idfeature,$type=null){
		$this->db->select('project1_token,action1_id,action1_name,totalcase,action1_type,action1_order');
		$array = array('activerow' => 1,'feature1_id' => $idfeature);
		if($type !=null)
		{
			$array['action1_type']=$type;
		}	
		$this->db->where($array);
		$this->db->order_by('action1_order', 'asc');
		$query = $this->db->get('v_list_action');
		return $query;
		}


        function get_last_action_by_idfeature($idfeature){
        $this->db->select('action1_order');
        $array = array('activerow' => 1,'feature1_id' => $idfeature);
        $this->db->where($array);
        $this->db->order_by('action1_order', 'desc');
        $this->db->limit(1);
        $query = $this->db->get('action1');
        $data = $query->row_array();
        $num = $query->num_rows();

        if($num==0)
        {
            $order = 1;
        }
        else
        {
            $order = $data['action1_order']+1;
        }
        return $order;
        }


        function update_order($action1_id,$action1_order)
        {
            $data = array(
                'action1_order'			=> $action1_order
            );
            $this->db->where('action1_id', $action1_id);
            $save = $this->db->update('action1', $data);
            return $save;
        }


		function count_action($idfeature,$idaction){
		$query = $this->db->query("select count(action1_id) as urutan from action1 where action1_id <=". $idaction ." and feature1_id=". $idfeature ." ORDER BY action1_id asc;");
		$urutan = $query->row()->urutan;
		return $urutan;
		}
		

		/*case */	
		function show_case_by_idaction($idaction){
		$this->db->select('case1_id, case1_desc,case1_desc,case1_expectation, case1_important,case1_type');
		$array = array('activerow' => 1, 'action1_id' => $idaction);
		$this->db->where($array);
		$this->db->order_by('case1_id', 'asc');
		$query = $this->db->get('case1');
		return $query;
		}	
		
		function show_case_by_idcase($idcase){
		$this->db->select('case1_id, case1_desc,case1_desc,case1_expectation, case1_important,case1_type');
		$array = array('activerow' => 1, 'case1_id' => $idcase);
		$this->db->where($array);
		$this->db->order_by('case1_id', 'asc');
		$query = $this->db->get('case1');
		$this->db->limit(1);
		return $query;
		}	
		
		function show_list_case($token){
		$this->db->select('project1_id, action1_type,project1_token,feature1_id,feature1_name,action1_id,action1_name, case1_id,case1_desc,
						   case1_expectation,case1_type,case1_important,totalaction,totalcase');
		$array = array('project1_token' => $token);
		$this->db->order_by('feature1_id asc,action1_id asc, case1_id asc');
		$this->db->where($array);
		$query = $this->db->get('v_list_case');
		return $query;
		}
		
		function count_case($idfeature,$idaction,$idcase){
		$query = $this->db->query("call sp_num_case('".$idfeature."','". $idaction."','". $idcase ."')");
		$urutan = $query->row()->urutan;	
		return $urutan;
		}
		
		function count_case_perfeature($idfeature){
		$query = $this->db->query("select count(case1_id) as jumlah from case1 where feature1_id='".$idfeature."'");
		$urutan = $query->row()->jumlah;	
		return $urutan;
		}
		
		
		/*result */	
		function show_result1($idadmin,$idproject){
		$query	=$this->db->query("select project1_id,result1_score from result1 where mstadmin_id='".$idadmin."' and project1_id='". $idproject."' limit 1");
		return $query;
		}	
		
		function show_result2($idadmin,$idcase){
		$query	=$this->db->query("select result2_id,result2_status,result2_note,result2_comment from result2 where mstadmin_id='".$idadmin."' and case1_id='". $idcase."' limit 1");
		return $query;
		}	
		
		function show_result3($token,$idcase){
		$query	=$this->db->query("select max(result2_status) as result_status, GROUP_CONCAT(CONCAT('<b>',ucase(cby),'</b>: ',result2_note,'<br>' )) as result_note,GROUP_CONCAT(CONCAT(result2_comment,'<br>')) as result_comment from result2 where case1_id='". $idcase ."' and project1_token='". $token ."' limit 1");
		return $query;
		}


    function get_last_result_id($idcase){
        $this->db->select('result2_id');
        $array = array('activerow' => 1, 'case1_id' =>$idcase);
        $this->db->where($array);
        $this->db->limit(1);
        $this->db->order_by('result2_id', 'desc');
        $query = $this->db->get('result2')->row_array();
        return $query['result2_id'];
    }

    function update_score($idadmin,$idproject){
		$query	=$this->db->query("select result2_id,result2_status,result2_note from result2 where mstadmin_id='".$idadmin."' and case1_id='". $idcase."' limit 1");
		return $query;
		}
		
		function show_note_by_idcase($idcase,$actor){
		$this->db->select('note1_id');
		$array = array('activerow' => 1, 'case1_id' =>$idcase);
		$this->db->where($array);
		$this->db->limit(1);
		$this->db->order_by('note1_id', 'desc');
		$query = $this->db->get('note1');
		$note= $query->row();
		if($this->db->query("update note1 set note1_status='solved',mby=now(),mby='". $actor ."' where note1_id='". $note->note1_id ."'"))
		{return true;}
		else
		{return false;}	
		}
		
		function check_note_by_idcase($idcase){
		$this->db->select('note1_id');
		$array = array('activerow' => 1, 'case1_id' =>$idcase);
		$this->db->where($array);
		$this->db->limit(1);
		$query = $this->db->get('note1');
		if($query->num_rows()>0)
		return true;
		else
		return false;	
		}
		
		function notes($idcase)
		{
		$query	=$this->db->query("select GROUP_CONCAT(CONCAT(note1_text,' (',cdate,') ','-', note1_status,'.') separator '<br>') as notes from note1 where case1_id='". $idcase ."'");
		if($query->num_rows()>0)
		{
		$dt= $query->row();
		return $dt->notes; 
		}
		else
		return false;
		}

    function detail_result2_by_case1_id($case1_id){
        $this->db->select("result2_id,result1_id,result2_status,result2_note,feature1_id,action1_id,case1_id,project1_id,mstadmin_id,cdate,mdate,activerow,cby,mby,project1_token,result2_comment");
        $array = array('case1_id'=>$case1_id,'activerow' => 1);
        $this->db->where($array);
        $this->db->limit(1);
        $query = $this->db->get("result2");
        return $query;
    }

    /* get detail */
    function detail_case1_by_case1_id($case1_id){
        $this->db->select("case1_id,case1_desc,case1_expectation,case1_important,project1_id,feature1_id,action1_id,activerow,cby,mby,cdate,mdate,project1_token,case1_type");
        $array = array('case1_id'=>$case1_id,'activerow' => 1);
        $this->db->where($array);
        $this->db->limit(1);
        $query = $this->db->get("case1");
        return $query;
    }

    /*image*/
    function show_all_result3($case1_id)
    {
        $this->db->select("result3_id,result2_id,result3_image,feature1_id,action1_id,case1_id,project1_id,mstadmin_id,cdate,mdate,activerow,cby,mby,project1_token");
        $array = array('case1_id'=>$case1_id,'activerow' => 1);
        $this->db->where($array);
        $query = $this->db->get("result3");
        return $query;
    }

    /* update */
    function update_result3($dataupdate,$where)
    {
        return $this->db->update('result3', $dataupdate,$where);
    }


    function insert_result3($datainput)
    {
        return $this->db->insert('result3', $datainput);
    }


}