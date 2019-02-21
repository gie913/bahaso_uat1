<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Listcase extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();	
	}
	
	public function save(){
	$this->check_isvalidate();	
	$id				=  $this->session->userdata('userid');
	$username		=  $this->session->userdata('username');
	$token			=  $this->input->post('token');
	$idfeature		=  $this->input->post('idfeature');
	$idaction		=  $this->input->post('idaction');
	$case			=  $this->input->post('case');
	$expectation	=  $this->input->post('expectation');
	$type			=  $this->input->post('type');
	$important		=  $this->input->post('important');
	$data = array(
        'project1_token' 		=> $token,
		'feature1_id'			=> $idfeature,
		'action1_id'			=> $idaction,
		'case1_desc'			=> $case,
		'case1_expectation'		=> $expectation,
		'case1_type'			=> $type,
		'case1_important'		=> $important,
		'action1_id'			=> $idaction,
		'project1_id'			=> $this->m_main->show_idproject_by_token($token),
		'cby'				=> $username,
		'activerow'				=> 1,
        'cdate' 				=> date('Y-m-d H:i:s')
	);
	$save = $this->db->insert('case1', $data);
	
	if($save)
	{
	$alert_status	= 1;	
	$alert_type		= "alert-success";
	$alert_icon		= "fa fa-check";
	$alert_heading	= "Success!";
	$alert_label	= "Data Saved!";
	}
	else 
	{
	$alert_status	= 1;	
	$alert_type		= "alert-warning";
	$alert_icon		= "fa fa-warning";
	$alert_heading	= "Warning!!";
	$alert_label	= " Failed to save";
	}	
	
	$alert = array(
				'alert_status'  	=> $alert_status,
				'alert_type'  		=> $alert_type,
				'alert_icon' 		=> $alert_icon,
				'alert_heading' 	=> $alert_heading,
				'alert_label'		=> $alert_label
			);
			$this->session->set_userdata($alert);
	
	redirect("./action/manage/".$idfeature."/".$token);
	}
	
	public function delete(){
	$this->check_isvalidate();	
	$id				=  $this->session->userdata('userid');
	$username		=  $this->session->userdata('username');
	$idcase			=  $this->uri->segment(3);
	$idfeature		=  $this->uri->segment(4);
	$token			=  $this->uri->segment(5);
	$this->db->where('case1_id',$idcase);
	$delete = $this->db->delete('case1');
	
	if($delete)
	{
	$alert_status	= 1;	
	$alert_type		= "alert-success";
	$alert_icon		= "fa fa-check";
	$alert_heading	= "Success!";
	$alert_label	= "Data Saved!";
	}
	else 
	{
	$alert_status	= 1;	
	$alert_type		= "alert-warning";
	$alert_icon		= "fa fa-warning";
	$alert_heading	= "Warning!!";
	$alert_label	= "Failed to save";
	}	
	$alert = array(
				'alert_status'  	=> $alert_status,
				'alert_type'  		=> $alert_type,
				'alert_icon' 		=> $alert_icon,
				'alert_heading' 	=> $alert_heading,
				'alert_label'		=> $alert_label
			);
	$this->session->set_userdata($alert);
	redirect("./action/manage/".$idfeature."/".$token);
	}
	
	public function saveresult(){
	$this->check_isvalidate();		
	$id				=  $this->session->userdata('userid');
	$username		=  $this->session->userdata('username');
	$token			=  $this->input->post('token');
	$idfeature		=  $this->input->post('idfeature');
	$idaction		=  $this->input->post('idaction');
	$idcase			=  $this->input->post('idcase');
	$note			=  $this->input->post('note');
	$status			=  $this->input->post('status');
	$idproject		=  $this->m_main->show_idproject_by_token($token);
	
	$data = array(
        'project1_token' 		=> $token,
		'feature1_id'			=> $idfeature,
		'action1_id'			=> $idaction,
		'case1_id'				=> $idcase,
		'project1_id'			=> $idproject,
		'mstadmin_id'			=> $id,
		'result2_status'		=> $status,
		'result2_note'			=> $note,
		'cby'					=> $username,
		'activerow'				=> 1,
        'cdate' 				=> date('Y-m-d H:i:s')
	);
	$load_result2	= $this->m_main->show_result2($id,$idcase);
	if($load_result2->num_rows()>0)
	{
		$array = array(
        'result2_status' => $status,
        'result2_note' => $note,
		'mby'	=> $username,
        'mdate' => date('Y-m-d H:i:s'),
		);
		$this->db->set($array);
		$this->db->where('case1_id', $idcase);
		$this->db->where('mstadmin_id', $id);
		$save = $this->db->update('result2');
		if($status==1){
			if($this->m_main->check_note_by_idcase($idcase)==true)
			{$this->m_main->show_note_by_idcase($idcase,$username);}
		}
	}
	else
	{
		$save = $this->db->insert('result2', $data);
		
	}
	
	if($status==2)
	{
	$array2 = array(
        'note1_text' 			=> $note,
		'feature1_id'			=> $idfeature,
		'action1_id'			=> $idaction,
		'case1_id'				=> $idcase,
		'project1_id'			=> $idproject,
		'cby'	=> $username,
        'cdate' => date('Y-m-d H:i:s')
		);
		$save2 = $this->db->insert('note1',$array2);	
	}
	
	
	
	$load_result1 				= $this->m_main->show_result1($id,$idproject);
	if($load_result1->num_rows()>0)
	{
		$this->db->query("call sp_updatescore_result1('". $id."','". $idproject ."')");
	}
	else
	{
		$data1 = array(
        'project1_token' 		=> $token,
		'result1_score'			=> 0,
		'project1_id'			=> $idproject,
		'mstadmin_id'			=> $id,
		'cby'					=> $username,
		'activerow'				=> 1,
        'cdate' 				=> date('Y-m-d H:i:s')
		);
		 $this->db->insert('result1', $data1);
		
	}	

	if($save)
	{
	$alert			= "berhasil";
	}
	else 
	{
	$alert			= "gagal";
	}	
	echo $alert;
	}
	
	public function showcase(){
	$idcase			= $this->input->post('idcase');
	$query			= $this->m_main->show_case_by_idcase($idcase);
	$row			= $query->row();
	$desc			= $row->case1_desc;
	$expectation	= $row->case1_expectation;
	$type			= $row->case1_type;
	$important		= $row->case1_important;
	$array 			= array($desc,$expectation,$expectation,$important);
	echo json_encode($array);
	}
	
	public function update(){
	$this->check_isvalidate();	
	$id				=  $this->session->userdata('userid');
	$username		=  $this->session->userdata('username');
	$token			=  $this->input->post('token');
	$idfeature		=  $this->input->post('idfeature');
	$idaction		=  $this->input->post('idaction');
	$idcase			=  $this->input->post('idcase');
	$case			=  $this->input->post('case');
	$expectation	=  $this->input->post('expectation');
	$type			=  $this->input->post('type');
	$important		=  $this->input->post('important');
	$data = array(
		'case1_desc'			=> $case,
		'case1_expectation'		=> $expectation,
		'case1_type'			=> $type,
		'case1_important'		=> $important,
		'mby'				=> $username,
		'activerow'				=> 1,
        'mdate' 				=> date('Y-m-d H:i:s')
	);
	$this->db->where('case1_id', $idcase);
	$save = $this->db->update('case1', $data);
	
	if($save)
	{
	$alert_status	= 1;	
	$alert_type		= "alert-success";
	$alert_icon		= "fa fa-check";
	$alert_heading	= "Success!";
	$alert_label	= "Data Saved!";
	}
	else 
	{
	$alert_status	= 1;	
	$alert_type		= "alert-warning";
	$alert_icon		= "fa fa-warning";
	$alert_heading	= "Warning!!";
	$alert_label	= " Failed to save";
	}	
	
	$alert = array(
				'alert_status'  	=> $alert_status,
				'alert_type'  		=> $alert_type,
				'alert_icon' 		=> $alert_icon,
				'alert_heading' 	=> $alert_heading,
				'alert_label'		=> $alert_label
			);
			$this->session->set_userdata($alert);
	redirect("./action/manage/".$idfeature."/".$token);
	}

	public function comment()
	{
	$idresult			=  $this->input->post('idresult');
	$comment			=  $this->input->post('comment');
		$array = array(
        'result2_comment' => strip_tags($comment),
        'mdate' => date('Y-m-d H:i:s'),
		);
		$this->db->set($array);
		$this->db->where('result2_id', $idresult);
		$save = $this->db->update('result2');	
	if($save)
	{
	$alert			= "berhasil";
	$comment		= "<label class='label label-info' data-toggle='tooltip' title='". $comment ."'><i class='fa fa-info'></i></label>";
	}
	else 
	{
	$alert			= "gagal";
	}	
	$array 			= array('alert'=>$alert,'comment' =>$comment);
	echo json_encode($array);
	}
	
	public function check_isvalidate() 
    {
        if(empty($this->session->userdata('userid'))){
            redirect("depan");
        }
    }	
}