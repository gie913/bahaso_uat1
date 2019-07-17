<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;
class Project extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library(array('aws3','s3_upload'));

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
	$data['name']				= $this->session->userdata('name');
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

	
	public function result()
	{
	$data						= array();
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
	$data['breadcrumb']			= "<h1>Project
        <small>List</small>
      </h1>
      <ol class='breadcrumb'>
        <li><a href='#'><i class='fa fa-dashboard'></i> Home</a></li>
        <li><a href='#'>Project</a></li>
        <li class='active'>Waiting/in Progress</li>
      </ol>";	
	$data['load_project']		= $this->m_main->show_project_result();  
	$data['content']			= $this->load->view('depan/v_project_result',$data,true);	
	$this->load->view('depan/v_template',$data);	
	}
	
	public function resultdetail()
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
	$data['breadcrumb']			= "<h1>Case
        <small>List</small>
      </h1>
      <ol class='breadcrumb'>
        <li><a href='#'><i class='fa fa-dashboard'></i> Home</a></li>
        <li><a href='". base_url()."project'>Project</a></li>
		 <li><a href='". base_url()."project/result'>Result</a></li>
        <li class='active'>Detail</li>
      </ol>";	
	$data['nama']				= $this->uri->segment(5);  
	$data['user_id']			= $this->uri->segment(4);
	$data['token']				= $this->uri->segment(3);
	$idproject					= $this->m_main->show_idproject_by_token($token);
	$data['avg']				= $this->m_main->show_project_avg_by_user($idproject,$this->uri->segment(4));
	$data['project_status']		= $this->m_main->show_project_status($idproject); 
	$data['load_feature']		= $this->m_main->show_feature_by_token($token); 
	$data['project_name']		= $this->m_main->show_projectname_by_token($token); 
	$data['content']			= $this->load->view('depan/v_project_result_detail',$data,true);	
	$this->load->view('depan/v_template',$data);	
	}
	
	
	public function download()
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
	$data['breadcrumb']			= "<h1>Case
        <small>List</small>
      </h1>
      <ol class='breadcrumb'>
        <li><a href='#'><i class='fa fa-dashboard'></i> Home</a></li>
        <li><a href='". base_url()."project'>Project</a></li>
		 <li><a href='". base_url()."project/result'>Result</a></li>
        <li class='active'>Detail</li>
      </ol>";	
	$data['nama']				= $this->uri->segment(5);  
	$data['user_id']			= $this->uri->segment(4);
	$data['token']				= $this->uri->segment(3);
	$idproject					= $this->m_main->show_idproject_by_token($token);
	$data['avg']				= $this->m_main->show_project_avg($idproject);
	$data['project_status']		= $this->m_main->show_project_status($idproject);
	$data['project_tester']		= $this->m_main->show_project_tester($idproject);	
	$data['load_feature']		= $this->m_main->show_feature_by_token($token); 
	$data['project_name']		= $this->m_main->show_projectname_by_token($token); 
	$data['load_project_data']	= $this->m_main->show_list_case($token); 
	$this->load->view('depan/v_project_download',$data);	
	}
	
	
	
	public function save(){
	$this->check_isvalidate();		
	$id				=  $this->session->userdata('userid');
	$username		=  $this->session->userdata('username');
	$token			=  generateRandomString(15).date('ymd');
	$data = array(
        'project1_token' 		=> $token,
        'mstadmin_id' 			=> $id,
		'project1_name'			=> $this->input->post('projectname'),
		'project1_version'		=> $this->input->post('version'),
		'project1_platform'		=> $this->input->post('platform'),
		'project1_status'		=> 0,
		'cby'					=> $username,
		'activerow'				=> 1,
        'cdate' 				=> date('Y-m-d H:i:s')
	);
	$save = $this->db->insert('project1', $data);
	
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
	
	redirect('./');
	}
	
	public function copyproject(){
	$this->check_isvalidate();		
	$id				=  $this->session->userdata('userid');
	$username		=  $this->session->userdata('username');
	$token_old		=  $this->uri->segment(3);
	$token_new		=  generateRandomString(15).date('ymd');
	$copy_project	= $this->m_main->copy_project($token_new,$token_old, $username);

	if($copy_project==true)
	{
	$new_project1_id	=	$this->m_main->show_idproject_by_token($token_new);

		//loop for feature
		$old_features = $this->m_main->manage_feature_by_token($token_old);
		foreach ($old_features->result_array() as $old_feature)
		{
			$old_feature_id	= $old_feature['feature1_id'];
			$old_feature_name	= $old_feature['feature1_name'];
			$old_feature_desc	= $old_feature['feature1_desc'];
			$data_feature = array(
				'project1_token' 		=> $token_new,
				'feature1_name'			=> $old_feature_name,
				'feature1_desc'			=> $old_feature_desc,
				'project1_id'			=> $new_project1_id,
				'cby'					=> $username,
				'activerow'				=> 1,
				'cdate' 				=> date('Y-m-d H:i:s')
			);
			$save_feature = $this->db->insert('feature1', $data_feature);
			$new_feature1_id = $this->m_main->get_feature_id($token_new,$old_feature_name);


			$old_actions = $this->m_main->show_action_by_idfeature($old_feature_id);
			foreach ($old_actions->result_array() as $old_action)
			{
				$old_action_id		= $old_action['action1_id'];
				$old_action_name	= $old_action['action1_name'];
				$old_action_type	= $old_action['action1_type'];
				$old_action_order	= $old_action['action1_order'];

				$data_action = array(
					'project1_token' 		=> $token_new,
					'project1_id'			=> $new_project1_id,
					'feature1_id'			=> $new_feature1_id,
					'action1_name'			=> $old_action_name,
					'action1_type'			=> $old_action_type,
					'action1_order'			=> $old_action_order,
					'cby'					=> $username,
					'activerow'				=> 1,
					'cdate' 				=> date('Y-m-d H:i:s')
				);
				$save_action = $this->db->insert('action1', $data_action);
				$new_action1_id = $this->m_main->get_action_id($token_new,$new_feature1_id,$old_action_name);
				$old_cases = $this->m_main->show_case_by_idaction($old_action_id);
				foreach ($old_cases->result_array() as $old_case) {
					$case1_desc = $old_case['case1_desc'];
					$case1_expectation = $old_case['case1_expectation'];
					$case1_important = $old_case['case1_important'];
					$case1_type = $old_case['case1_type'];
					$data_action = array(
						'project1_token' => $token_new,
						'project1_id' => $new_project1_id,
						'feature1_id' => $new_feature1_id,
						'action1_id' => $new_action1_id,
						'case1_desc' => $case1_desc,
						'case1_expectation' => $case1_expectation,
						'case1_important' => $case1_important,
						'case1_type' => $case1_type,
						'cby' => $username,
						'activerow' => 1,
						'cdate' => date('Y-m-d H:i:s')
					);
					$save_case = $this->db->insert('case1', $data_action);
				}
			}
			$save=1;
		}
	}

	else
	{
		echo "failed";
		$save=0;
	}
	
	//$save = $this->db->query("call sp_project_copy('". $token_old ."','". $token_new ."','". $username ."','". $user_id."')");
	
	if($save==1)
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
	
	redirect('./');
	}
	
	public function delete(){
	$this->check_isvalidate();	
	$id				=  $this->session->userdata('userid');
	$username		=  $this->session->userdata('username');
	$token			=  $this->uri->segment(3);
	
	$delete = $this->db->query("call sp_project_delete('". $token ."');");

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
	
	redirect('./');
	}
	

	public function update(){
	$this->check_isvalidate();	
	$id				=  $this->session->userdata('userid');
	$username		=  $this->session->userdata('username');
	$idproject		=  $this->input->post('id');
	$data = array(
        'mstadmin_id' 			=> $id,
		'project1_name'			=> $this->input->post('projectname'),
		'project1_version'		=> $this->input->post('version'),
		'project1_platform'		=> $this->input->post('platform'),
		'project1_status'		=> 0,
		'mby'				=> $username,
		'activerow'				=> 1,
        'mdate' 				=> date('Y-m-d H:i:s')
	);
	$this->db->where('project1_id', $idproject);
	$save = $this->db->update('project1', $data);
	
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
	
	redirect('./');
	}
	
	
	public function status(){
	$this->check_isvalidate();	
	$id				=  $this->session->userdata('userid');
	$username		=  $this->session->userdata('username');
	$token			=  $this->input->post('token');
	$status			=  $this->input->post('status');
	$data = array(
		'project1_status'		=> $status,
		'mby'					=> $username,
		'activerow'				=> 1,
        'mdate' 				=> date('Y-m-d H:i:s')
	);
	$this->db->where('project1_token', $token);
	$save = $this->db->update('project1', $data);
	
	if($save)
	{
	$alert="berhasil";
	}
	else 
	{
	$alert="gagal";
	}	
	echo $alert;
	}
	
	public function checklist(){
	$this->check_isvalidate();		
	$id				=  $this->session->userdata('userid');
	$username		=  $this->session->userdata('username');
	$status			=  $this->uri->segment('4');
	$token			=  $this->uri->segment('3');
	$data = array(
		'project1_status'		=> $status,
		'mby'				=> $username,
		'activerow'				=> 1,
        'mdate' 				=> date('Y-m-d H:i:s')
	);
	$this->db->where('project1_token', $token);
	$save = $this->db->update('project1', $data);
	
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
	
	redirect('./feature/manage/'.$token);
	}
	
	public function view()
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
	$data['type']				= $this->uri->segment(4);
	$data['breadcrumb']			= "<h1>Case
        <small>List</small>
      </h1>
      <ol class='breadcrumb'>
        <li><a href='#'><i class='fa fa-dashboard'></i> Home</a></li>
        <li><a href='". base_url()."project'>Project</a></li>
        <li class='active'>View</li>
      </ol>";	
	$data['token']				= $this->uri->segment(3);
	$data['load_feature']		= $this->m_main->show_feature_by_token($token); 
	$data['project_name']		= $this->m_main->show_projectname_by_token($token); 
    $data['project_status']		= $this->m_main->show_status_by_token($token); 	
	$data['content']			= $this->load->view('depan/v_project_view',$data,true);	
	$this->load->view('depan/v_template',$data);	
	}

	public function input()
	{
	$this->check_isvalidate();	
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
	$data['breadcrumb']			= "<h1>Case
        <small>List</small>
      </h1>
      <ol class='breadcrumb'>
        <li><a href='#'><i class='fa fa-dashboard'></i> Home</a></li>
        <li><a href='". base_url()."project'>Project</a></li>
        <li class='active'>View</li>
      </ol>";	
	 $data['user_id']			= $this->session->userdata('userid');
	$data['token']				= $this->uri->segment(3);
	$data['load_feature']		= $this->m_main->show_feature_by_token($token); 
	$data['project_name']		= $this->m_main->show_projectname_by_token($token); 
    $data['project_status']		= $this->m_main->show_status_by_token($token); 	
	$data['type']				= $this->uri->segment(4); 
	$data['content']			= $this->load->view('depan/v_project_input',$data,true);	
	$this->load->view('depan/v_template',$data);	
	}
	
	function api_project_coming()
	{
		$list = $this->m_main->get_datatables();
		$data = array();
		$no = $this->input->post('start');
		
		foreach ($list as $dt) {
			$accept_selected="";
			$reject_selected="";
			if($dt->project1_status=='1')
			$accept_selected="selected";
			
			if($dt->project1_status=='2')
			$reject_selected="selected";
			
		$btn_edit	= "<a class='btn btn-success' href='". base_url()."project/input/".$dt->project1_token."/positive'> <i class='fa fa-edit'></i> </a> ";
		$btn_status = "<form action='' method='post' id='form". $dt->project1_id ."'>
<input type='hidden' name='token' value='".$dt->project1_token ."'>
<select name='status' class='form-control' onchange=\"changeStatus('form".$dt->project1_id."')\">
<option value=''>Choose</option>
<option value='1' ". $accept_selected . ">Accept</option>
<option value='2' ". $reject_selected. ">Reject</option>
</select>
</form>";
			$btn_manage="<div class='dropdown'>
  <button class='btn btn-primary dropdown-toggle' type='button' data-toggle='dropdown'><i class='fa fa-cog'></i>
  <span class='caret'></span></button>
  <ul class='dropdown-menu'>
  <li> <a  href='".base_url() ."feature/manage/".$dt->project1_token."'>Manage</a></li>
    <li class='divider'></li>
	  <li> <a  href='".base_url() ."project/copyproject/".$dt->project1_token."'>Copy</a></li>
    <li class='divider'></li>
<li><a href='#' onclick=\"callModal('". $dt->project1_id ."','". $dt->project1_name  ."','". $dt->project1_version ."','". $dt->project1_platform."')\">Edit</a></li>
 <li><a  onclick=\"return confirm('Are you sure to delete ". $dt->project1_name ."')\" href='". base_url() ."project/delete/".$dt->project1_token." '>Delete</a> </li>
  </ul>
</div>";
			
			
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = "<a href='".base_url() ."feature/manage/".$dt->project1_token."'>". $dt->project1_name ."</a>";
			$row[] = $dt->project1_platform;
			$row[] = $dt->project1_version;
			//$row[] = round($this->m_main->show_project_avg($dt->project1_id),2);//
			
			$row[] = "<a class='btn btn-info' href='". base_url()."project/view/". $dt->project1_token ."/positive'> <i class='fa fa-eye'></i> </a> ";
			$row[] = "<a class='btn btn-primary' href='". base_url()."project/download/". $dt->project1_token ."/positive'> <i class='fa fa-download'></i> </a>";	
			if($this->session->has_userdata('userid')) 
			{
			$row[] = $btn_edit;
			$row[] = $btn_status;
			$row[] = $btn_manage;
			}
			$data[] = $row;
		}

		$output = array(
						"draw" 				=> 	$_POST['draw'],
						"recordsTotal" 		=> 	$this->m_main->count_all(),
						"recordsFiltered" 	=> 	$this->m_main->count_filtered(),
						"data" 				=> 	$data,
				);
		echo json_encode($output);
	}

	
	function api_project_result()
	{
	$list = $this->m_main->get_datatables();
		$data = array();
		$no = $this->input->post('start');
		
		foreach ($list as $dt) {	
					
					$label="";
					$load_tester = $this->m_main->show_project_tester($dt->project1_id);
					if($load_tester->num_rows()>0)
					{
						foreach($load_tester->result_array() as $tester)
						{
						$label .= "<a class='label label-warning label-lg' data-toggle='tooltip' title='view Result' href='". base_url()."project/resultdetail/".$dt->project1_token."/".$tester['mstadmin_id']."/".$tester['mstadmin_name']."'>". ucwords($tester['mstadmin_name']) ."</a> ";			
						}	
						
					}	
			
			if($dt->project1_status==1)
				{
					$status="<span class='label label-success'>Accepted</span>";
				}
				else if ($dt->project1_status==2)
				{
					$status="<span class='label label-danger'>Rejected</span>";
				}
				else
				{
					$status="<span class='label label-info'>In Progress</span>";
				}
			
			
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $dt->project1_name;
			$row[] = $dt->project1_platform;
			$row[] = $dt->project1_version;
			$row[] = round($this->m_main->show_project_avg($dt->project1_id),2);//
			$row[] = $status;
			$row[] = "<a class='btn btn-primary' href='". base_url()."project/download/". $dt->project1_token ."/positive'> <i class='fa fa-download'></i> </a>";	
			$row[] = $label;
			$data[] = $row;
		}

		$output = array(
						"draw" 				=> 	$_POST['draw'],
						"recordsTotal" 		=> 	$this->m_main->count_all(),
						"recordsFiltered" 	=> 	$this->m_main->count_filtered(),
						"data" 				=> 	$data,
				);
		echo json_encode($output);	

	}	
	
	
	
	public function check_isvalidate() 
    {
        if(empty($this->session->userdata('userid'))){
            redirect("depan");
        }
    }


    function insert_image()
    {
        $result2_id = $this->input->post('result2_id');
        $feature1_id = $this->input->post('feature1_id');
        $action1_id = $this->input->post('action1_id');
        $case1_id = $this->input->post('case1_id');
        $project1_id = $this->input->post('project1_id');
        $mstadmin_id = $this->session->userdata('userid');
        $activerow = 1;
        $cby = $this->session->userdata('name');;

        $project1_token = $this->input->post('project1_token');

        $image = $_FILES['result3_image']['name'];
        $explodeimage = explode('.', $image);
        $extensionimage = end($explodeimage);
        $image_new = md5(date('ymdHis')) . generateRandomString(5) . '.' . $extensionimage;
        $config['allowed_types'] = "jpg|png|gif"; // file yang di perbolehkan
        $config['max_size'] = 5400; // maksimal ukuran
        $config['upload_path'] = "./uploads/";
        $config['file_name'] = $image_new;
        $config['overwrite'] = true;
        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        $params = array(
            'result2_id' => $result2_id,
            'feature1_id' => $feature1_id,
            'action1_id' => $action1_id,
            'case1_id' => $case1_id,
            'project1_id' => $project1_id,
            'mstadmin_id' => $mstadmin_id,
            'activerow' => $activerow,
            'cby' => $cby,
            'project1_token' => $project1_token
        );
        $upl = move_uploaded_file($_FILES['result3_image']['tmp_name'],"./uploads/".$image_new);
       // if ($this->upload->do_upload('result3_image')) {
        if($upl){
            $params['result3_image'] = $image_new;
            $bucket_name = S3_BUCKET;
             $keyname = S3_FOLDER.'/'.$image_new;
           // $keyname = S3_FOLDER.'/'.$_FILES['result3_image']['name'];
            $key_s3 = S3_PUBLIC_KEY;
            $secret_s3=S3_SECRET;
             $sample_file = base_url() . 'uploads/' . $image_new;
            //$sample_file=$_FILES['result3_image']['name'];
            try {
                $s3 = S3Client::factory(
                    array(
                        'credentials' => array(
                            'key' => $key_s3 ,
                            'secret' => $secret_s3 ,
                        ),
                        'region'  => 'ap-southeast-1'
                    )
                );
            } catch (Exception $e) {
                die("Error user: " . $e->getMessage());
            }

            try {
                $s3->putObject(
                    array(
                        'Bucket'=>$bucket_name,
                        'Key' =>  $keyname,
                        'Body' => file_get_contents($sample_file),
                        'ContentType'  => 'image/jpeg',
                        'ACL'          => 'public-read',
                        'StorageClass' => 'STANDARD',
                        'ServerSideEncryption' => 'AES256',
                    )
                );
            } catch (S3Exception $e) {
                die('Error s3:' . $e->getMessage());
            } catch (Exception $e) {
                die('Error upload :' . $e->getMessage());
            }

    }
        else
        {
            $error = array('error' => $this->upload->display_errors());
            $img1_msg			=  $error['error'];
        }
        $this->m_main->insert_result3($params);
     //   unlink("./uploads/".$image_new);
        redirect("./project/input/". $project1_token ."/positive");
    }


    function delete_image($id,$token,$result3_image)
    {
        $val = array(
            'activerow'=>0,
            'mby'=>$this->session->userdata('name'),
        );
        $where = array(
            'result3_id'=>$id,
        );

        if(file_exists('./uploads/'.$result3_image))
        {
            unlink('./uploads/'.$result3_image);
        }

        $this->m_main->update_result3($val,$where);
        redirect("./project/input/".$token."/positive");
    }

    function show_images()
    {
        $case1_id = $this->input->post('case1_id');
        $data = $this->m_main->detail_result2_by_case1_id($case1_id)->row_array();
        $result2_id = $data['result2_id'];
        $data2 = $this->m_main->detail_case1_by_case1_id($case1_id)->row_array();
        $images = "";

        $images .= "<div id=\"carousel-example-generic\" class=\"carousel slide\" data-ride=\"carousel\">
                <ol class=\"carousel-indicators\">";

        $_img = $this->m_main->show_all_result3($case1_id);
        $n1 = 0;

        foreach ($_img->result_array() as $img) {
            if ($n1 == 0) {
                $class_active1 = "class='active'";
            }
            else
            {
                $class_active1 = "";
            }


                $data_slide_to=$n1;


            $images .= "<li data-target='#carousel-example-generic' data-slide-to='" . $data_slide_to . "' " . $class_active1 . " ></li>";
            $n1++;
        }
        $images .= " 
                </ol>
                <div class=\"carousel-inner\">";

        $n2 = 0;

        foreach ($_img->result_array() as $img2) {
            if ($n2 == 0) {
                $class_active2 = "active";
            }
            else
            {
                $class_active2 = "";
            }
            $images .= "
                    <div class='item ". $class_active2 ."'>
                     <img src='" . S3_URL  . $img2['result3_image'] . "' alt='" . $img2['result3_image'] . "'>
                     <div class='carousel-caption'>
                       <a href='". base_url() ."project/delete_image/". $img2['result3_id'] ."/".  $img2['project1_token'] . "/". $img2['result3_image']."' class='btn btn-danger' onclick=\"return confirm('are you sure to delete ?')\">Delete</a>
                      <a href='". base_url()  ."uploads/". $img2['result3_image'] ."' class='btn btn-primary' target='_blank' >Preview</a>
                     </div>
                     </div>";
            //$images .="joooo";
        $n2++;
        }
            $images .= "
                <a class=\"left carousel-control\" href=\"#carousel-example-generic\" data-slide=\"prev\">
                  <span class=\"fa fa-angle-left\"></span>
                </a>
                <a class=\"right carousel-control\" href=\"#carousel-example-generic\" data-slide=\"next\">
                  <span class=\"fa fa-angle-right\"></span>
                </a>
              </div>";

            $new_array = array('project1_id' => $data2['project1_id'],
                'feature1_id' => $data2['feature1_id'],
                'action1_id' => $data2['action1_id'],
                'case1_id' => $data2['case1_id'],
                'result2_id' => $data['result2_id'],
                'project1_token' => $data2['project1_token'],
                'images' => $images);
            echo json_encode($new_array);
        }




}
