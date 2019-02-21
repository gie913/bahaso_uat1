<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Depan extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
	}
	
	
	public function index()
	{
	$data						= array();
	$load_setting 				= $this->m_main->show_config();
	$data['title']				= $load_setting[0]->title;
	$data['description']		= $load_setting[0]->description;
	$data['keyword']			= $load_setting[0]->keyword;
	$data['author']				= $load_setting[0]->author;
	$data['x_icon']				= $load_setting[0]->icon;
	$data['menu_projek_active']	= "active";
	$data['menu_testing_active']= "";
	$data['menu_user_active']	= "";
	$data['menu_kontak']		= "";
	$data['breadcrumb']			= "<h1>Project
        <small>List</small>
      </h1>
      <ol class='breadcrumb'>
        <li><a href='#'><i class='fa fa-dashboard'></i> Home</a></li>
        <li><a href='#'>Project</a></li>
        <li class='active'>Waiting/in Progress</li>
      </ol>";	
	$data['load_project']		= $this->m_main->show_project_coming();  
	$data['content']			= $this->load->view('depan/v_project_list',$data,true);	
	$this->load->view('depan/v_template',$data);	
	}
	
	
	public function error()
	{
	$data						= array();
	/*======= config =========================*/
	$load_setting 				= $this->m_main->show_config();
	$data['title']				= $load_setting[0]->title;
	$data['description']		= $load_setting[0]->description;
	$data['keyword']			= $load_setting[0]->keyword;
	$data['author']				= $load_setting[0]->author;
	$data['x_icon']				= $load_setting[0]->icon;
	$data['menu_projek_active']	= "active";
	$data['menu_testing_active']= "";
	$data['menu_user_active']	= "";
	$data['menu_kontak']		= "";
	$data['breadcrumb']			= "<h1>Project
        <small>List</small>
      </h1>
      <ol class='breadcrumb'>
        <li><a href='#'><i class='fa fa-dashboard'></i> Not Found</a></li>
        
      </ol>";	
	$data['content']			= $this->load->view('depan/v_error',$data,true);	
	$this->load->view('depan/v_template',$data);	
	}
}
