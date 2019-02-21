<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Feature extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
	}
	
	
	public function manage()
	{
	$data						= array();
	$token						= $this->uri->segment(3);
	$load_setting 				= $this->m_main->show_config();
	$data['title']				= $load_setting[0]->title;
	$data['description']		= $load_setting[0]->description;
	$data['keyword']			= $load_setting[0]->keyword;
	$data['author']				= $load_setting[0]->author;
	$data['x_icon']				= $load_setting[0]->icon;
	$data['name']				= $this->session->userdata('name');
	$data['menu_projek_active']	= "active";
	$data['menu_testing_active']= "";
	$data['menu_user_active']	= "";
	$data['menu_kontak']		= "";
	$data['breadcrumb']			= "<h1>Feature
        <small>List</small>
      </h1>
      <ol class='breadcrumb'>
        <li><a href='#'><i class='fa fa-dashboard'></i> Home</a></li>
        <li><a href='#'>Project</a></li>
        <li class='active'>Feature</li>
      </ol>";	
	$data['token']				= $this->uri->segment(3);
	$data['load_feature']		= $this->m_main->manage_feature_by_token($token); 
	$data['project_name']		= $this->m_main->show_projectname_by_token($token); 
    $data['project_status']		= $this->m_main->show_status_by_token($token);
	$idproject					= $this->m_main->show_idproject_by_token($token);
	$data['avg']				= $this->m_main->show_project_avg($idproject); 	
	$data['totalTester']		= $this->m_main->show_project_tester($idproject)->num_rows();
	$data['content']			= $this->load->view('depan/v_feature_manage',$data,true);	
	$this->load->view('depan/v_template',$data);	
	}
	
	public function save(){
	$id				=  $this->session->userdata('userid');
	$username		=  $this->session->userdata('username');
	$token			=  $this->input->post('token');
	$data = array(
        'project1_token' 		=> $token,
		'feature1_name'			=> $this->input->post('name'),
		'feature1_desc'			=> $this->input->post('desc'),
		'project1_id'			=> $this->m_main->show_idproject_by_token($token),
		'cby'				=> $username,
		'activerow'				=> 1,
        'cdate' 				=> date('Y-m-d H:i:s')
	);
	$save = $this->db->insert('feature1', $data);
	
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
	
	redirect("./feature/manage/".$token);
	}
	
	public function delete(){
	$id				=  $this->session->userdata('userid');
	$username		=  $this->session->userdata('username');
	$idfeature		=  $this->uri->segment(3);
	$token			=  $this->uri->segment(4);
	$this->db->where('feature1_id', $idfeature);
	$delete = $this->db->delete('feature1');
	$this->db->where('project1_id', $idproject);
	$delete = $this->db->delete('action1');
	$this->db->where('project1_id', $idproject);
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
	redirect("./feature/manage/".$token);
	}
	

	public function update(){
	$id				=  $this->session->userdata('userid');
	$username		=  $this->session->userdata('username');
	$idfeature		=  $this->input->post('id');
	$token			=  $this->input->post('token');
	$data = array(
		'feature1_name'			=> $this->input->post('name'),
		'feature1_desc'			=> $this->input->post('desc'),
		'mby'				=> $username,
		'activerow'				=> 1,
        'mdate' 				=> date('Y-m-d H:i:s')
	);
	$this->db->where('feature1_id', $idfeature);
	$save = $this->db->update('feature1', $data);
	
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
	redirect("./feature/manage/".$token);
	}
	
	
	public function check_isvalidate() 
    {
        if(empty($this->session->userdata('userid'))){
            redirect("depan");
        }
    }
		

		
}
