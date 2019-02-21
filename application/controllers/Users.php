<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Users extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
        $this->load->model(array('m_users'));
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
	$data['menu_projek_active']	= "";
	$data['menu_testing_active']= "";
	$data['menu_user_active']	= "active";
	$data['menu_kontak']		= "";
	$data['breadcrumb']			= "<h1>List
        <small>User</small>
      </h1>
      <ol class='breadcrumb'>
        <li><a href='#'><i class='fa fa-users'></i>Account</a></li>
        <li class='active'>User</li>
      </ol>";
	$userid                     = $this->session->userdata('userid');
	$data['qdata']      		= $this->m_users->show_all_exclude_id($userid);
	$data['content']			= $this->load->view('depan/v_user_list',$data,true);
	$this->load->view('depan/v_template',$data);	
	}

    function do_insert()
    {
        $params = array('mstadmin_id' => $this->input->post('mstadmin_id'),
            'mstadmin_username' => $this->input->post('mstadmin_username'),
            'mstadmin_akses' => $this->input->post('mstadmin_akses'),
            'mstadmin_password' => md5($this->input->post('mstadmin_password')),
            'mstadmin_name' => $this->input->post('mstadmin_name'),
            'activerow' => 1,
            'cby' => $this->input->post('name'),
        );
        $save= $this->m_users->insert($params);
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

        redirect('users');

    }

    function do_update()
    {
        $params = array(
            'mstadmin_username' => $this->input->post('mstadmin_username'),
            'mstadmin_name' => $this->input->post('mstadmin_name'),
            'mstadmin_akses' => $this->input->post('mstadmin_akses'),
             'mby' => $this->input->post('name'),

        );
        $where = array(
            'mstadmin_id'=>$this->input->post('mstadmin_id'),
        );


        $password = $this->input->post('mstadmin_password');
        if(strlen($password>0)){
            $params['mstadmin_password'] = md5($password);
        }

       $update= $this->m_users->update($params,$where);

        if($update)
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

        redirect('users');
    }


    function do_delete($id)
    {
        $val = array(
            'activerow'=>0,
            'mby'=>$this->session->userdata('user_name'),
        );
        $where = array(
            'mstadmin_id'=>$id,
        );
        $update=$this->m_users->update($val,$where);

        if($update)
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

        redirect('users');
    }


    function get_detail()
    {
        $id					= $this->input->post('id');
        $qry				= $this->m_users->detail_by_id($id);
        $status=false;
        if($qry->num_rows()>0)
        {
            $status	= true;
            foreach($qry->result_array() as $key=>$value){
                $data_result[$key]	= $value;
            }
        }
        $new_array	= array('status'=>$status,'data'=>$data_result);
        echo json_encode($new_array);
    }
	
}
