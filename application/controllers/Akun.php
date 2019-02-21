<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Akun extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
	}
	
	
	public function index()
	{
	$this->signin();
	}
	
	public function signin()
	{
	$data						= array();
	$load_setting 				= $this->m_main->show_config();
	$data['title']				= $load_setting[0]->title;
	$data['description']		= $load_setting[0]->description;
	$data['keyword']			= $load_setting[0]->keyword;
	$data['author']				= $load_setting[0]->author;
	$data['x_icon']				= $load_setting[0]->icon;
	$this->load->view('depan/v_template_login',$data);	
	}
	
	
	public function profile()
	{
	$data						= array();
	$load_setting 				= $this->m_main->show_config();
	$data['title']				= $load_setting[0]->title;
	$data['description']		= $load_setting[0]->description;
	$data['keyword']			= $load_setting[0]->keyword;
	$data['author']				= $load_setting[0]->author;
	$data['x_icon']				= $load_setting[0]->icon;
	$data['name']				= $this->session->userdata('name');
	$data['menu_projek_active']	= "";
	$data['menu_testing_active']= "";
	$data['menu_user_active']	= "";
	$data['menu_kontak']		= "";
	$data['breadcrumb']			= "<h1>Profile
        <small>User</small>
      </h1>
      <ol class='breadcrumb'>
        <li><a href='#'><i class='fa fa-dashboard'></i>Account</a></li>
        <li><a href='#'>Profile</a></li>
        <li class='active'>User</li>
      </ol>";	
	$data['content']			= $this->load->view('depan/v_profile',$data,true);	
	$this->load->view('depan/v_template',$data);	
	}
	
	
	public function check_login()
	{
	$username					= $this->input->post('username');		
	$password					= $this->input->post('password');
	$q							= $this->m_akun->show_user($username,$password);
	$jml_data					= $q->num_rows();
	if($jml_data>0)
	{
	$user						= $q->result_array();	
			$user_login = array(
				'userid'  	=> $user[0]['mstadmin_id'],
				'username'  => $user[0]['mstadmin_username'],
				'name' 		=> $user[0]['mstadmin_name'],
				'akses' 	=> $user[0]['mstadmin_akses'],
				'logged_in' => TRUE
			);
			$this->session->set_userdata($user_login);
	redirect('./');
	
	}
	else
	{
	echo "<script>alert('Login Failed');location=(window.history.back());</script>";	
	}
	
	}	
	
	public function signout(){
	$array_items = array('userid', 'username','name','akses','logged_in');
	$this->session->unset_userdata($array_items);
	redirect('./');
	}

	public function update_profile(){
	$id				=  $this->session->userdata('userid');
	$data = array(
        'mstadmin_name' 		=> $this->input->post('nama'),
        'mstadmin_password' 	=> md5($this->input->post('password')),
        'mdate'					=> date('Y-m-d H:i:s')
	);
	$this->db->where('mstadmin_id', $id);
	$this->db->update('mstadmin', $data);
	redirect('./');
	}
	
	
	
}
