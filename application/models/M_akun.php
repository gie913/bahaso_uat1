<?php
class M_akun extends CI_Model
    {
     	function __construct()
		{
			parent::__construct();
		}
				
		function show_user($username,$password){
		$this->db->select('mstadmin_id,mstadmin_name,mstadmin_username,mstadmin_akses');
		$array = array('activerow' => 1, 'mstadmin_username' => $username, 'mstadmin_password' => md5($password));
		$this->db->where($array);
		$this->db->limit(1); 
		$query = $this->db->get('mstadmin');
		return $query;
		}
		
		

	}