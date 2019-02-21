<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class M_users extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    /* get detail */
    function detail_by_id($id){
        $this->db->select("mstadmin_id,mstadmin_username,mstadmin_password,mstadmin_name,mstadmin_akses,activerow,cby,mby,cdate,mdate");
        $array = array('mstadmin_id'=>$id,'activerow' => 1);
        $this->db->where($array);
        $this->db->limit(1);
        $query = $this->db->get("mstadmin");
        return $query;
    }


    /* get all */
    function show_all()
    {
        $this->db->select("mstadmin_id,mstadmin_username,mstadmin_password,mstadmin_name,mstadmin_akses,activerow,cby,mby,cdate,mdate");
        $this->db->where('activerow',1);
        $query = $this->db->get("mstadmin");
        return $query;
    }

    function show_all_exclude_id($id)
    {
        $this->db->select("mstadmin_id,mstadmin_username,mstadmin_password,mstadmin_name,mstadmin_akses,activerow,cby,mby,cdate,mdate");
        $this->db->where('activerow',1);
        $this->db->where('mstadmin_id !=',$id);
        $query = $this->db->get("mstadmin");
        return $query;
    }


    /* insert */
    function insert($datainput)
    {
        return $this->db->insert('mstadmin', $datainput);
    }

    /* update */
    function update($dataupdate,$where)
    {
        return $this->db->update('mstadmin', $dataupdate,$where);
    }
    /* delete */
    function delete($where)
    {
        return $this->db->delete('mstadmin',$where);
    }

}
