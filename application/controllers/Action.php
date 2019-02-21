<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Action extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		//$this->check_isvalidate();
		$this->load->helper(array('form','url', 'text_helper','date','tgl_indonesia','rupiah','umum'));
		$this->load->database();
		//$this->load->library('session');
		$this->load->model(array('m_main'));	
		$data = array();
	}
	
	
	public function manage()
	{
	$data						= array();
	$token						= $this->uri->segment(4);
	$idfeature					= $this->uri->segment(3);
	$load_setting 				= $this->m_main->show_config();
	$data['title']				= $load_setting[0]->title;
	$data['description']		= $load_setting[0]->description;
	$data['keyword']			= $load_setting[0]->keyword;
	$data['author']				= $load_setting[0]->author;
	$data['x_icon']				= $load_setting[0]->icon;
	$data['name']				= $this->session->userdata('name');
	$data['menu_projek_active']	= "active";
	$data['menu_testing_active']= "";
	$data['menu_projek_active']	= "active";
	$data['menu_testing_active']= "";
	$data['menu_user_active']	= "";
	$data['menu_kontak']		= "";
	$project_name				= $this->m_main->show_projectname_by_token($token);
	
	$data['breadcrumb']			= "<h1>Action of Project : ". $project_name  ."
        <small></small>
      </h1>
      <ol class='breadcrumb'>
        <li><a href='#'><i class='fa fa-dashboard'></i> Home</a></li>
        <li><a href='#'>Project</a></li>
        <li class='active'>Action</li>
      </ol>";	
	$data['token']				= $token;
	$data['idfeature']			= $idfeature;
	$data['load_action']		= $this->m_main->show_action_by_idfeature($idfeature); 
	$data['feature_name']		= $this->m_main->show_featurename_by_id($idfeature); 
	$data['feature_list']		= $this->m_main->manage_feature_by_token($token);	
	$data['content']			= $this->load->view('depan/v_action',$data,true);	
	$this->load->view('depan/v_template',$data);	
	}
	
	public function save(){
	$id				=  $this->session->userdata('userid');
	$username		=  $this->session->userdata('username');
	$token			=  $this->input->post('token');
	$idfeature		=  $this->input->post('idfeature');
	$type			=  $this->input->post('type');
    $name           =  $this->input->post('name');
	$order          =  $this->m_main->get_last_action_by_idfeature($idfeature);
	$data = array(
        'project1_token' 		=> $token,
		'feature1_id'			=> $idfeature,
		'action1_type'			=> $type,
		'action1_name'			=> preg_replace('/(<br>)+$/', '', $name),
		'action1_order'         => $order,
		'project1_id'			=> $this->m_main->show_idproject_by_token($token),
		'cby'				    => $username,
		'activerow'				=> 1,
        'cdate' 				=> date('Y-m-d H:i:s')
	);
	$save = $this->db->insert('action1', $data);
	
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
	$id				=  $this->session->userdata('userid');
	$username		=  $this->session->userdata('username');
	$idaction		=  $this->uri->segment(3);
	$idfeature		=  $this->uri->segment(4);
	$token			=  $this->uri->segment(5);
	$this->db->where('action1_id', $idaction);
	$delete = $this->db->delete('action1');
	$this->db->where('project1_id', $idproject);
	$delete = $this->db->delete('case1');
	
	if($delete)
	{
	$alert_status	= 1;	
	$alert_type		= "alert-success";
	$alert_icon		= "fa fa-check";
	$alert_heading	= "Success!";
	$alert_label	= "Data Deleted!";
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
	

	public function update(){
	$id				=  $this->session->userdata('userid');
	$username		=  $this->session->userdata('username');
	$idaction		=  $this->input->post('id');
	$idfeature		=  $this->input->post('idfeature');
	$token			=  $this->input->post('token');
	$type			=  $this->input->post('type');
	$name           = $this->input->post('name');

	$data = array(
		'action1_name'			=> preg_replace('/(<br>)+$/', '', $name),
		'mby'				=> $username,
		'action1_type'			=> $type,
		'activerow'				=> 1,
        'mdate' 				=> date('Y-m-d H:i:s')
	);
	$this->db->where('action1_id', $idaction);
	$save = $this->db->update('action1', $data);
	
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



    public function move($action1_id,$current_order,$tobe_order,$feature1_id,$project1_token){
	    $this->db->query("call sp_change_order('". $action1_id."','". $current_order."','". $tobe_order."')");
        redirect("./action/manage/".$feature1_id."/".$project1_token);
	}
	
}
