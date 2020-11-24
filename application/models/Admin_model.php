<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {
   
    function __construct(){
        parent::__construct();        
    } 
    public function ExistingUser($email)
    {
        $this->db->select('*');
        $this->db->from('tbl_users');       
        $this->db->where('user_email', $email); 
        $query=$this->db->get();
        return $query->result();
    }
    public function InsertUser($datas)
    {        
        $this->db->insert('tbl_users',$datas);
        return $this->db->insert_id();
    }
    public function LoginUser($email,$pass)
    {
        $this->load->library('password'); 
        $this->db->select('*');
        $this->db->from('tbl_users');       
        $this->db->where('user_email', $email); 
        $query = $this->db->get();
        $userInfo =$query->result();
        if(!empty($userInfo)){
            $databse_pass=$userInfo[0]->user_password;
            if(!$this->password->validate_password($pass, $databse_pass)){
             return array();
            }
            else{
                 return $userInfo;
            }
        }else{
            return array();
        }
    }
    public function UpdateUserverification($datas)
    {
        $data = array(
            'verification_code'=> $datas['verification_code'], 
            'updated_date'=> date('Y-m-d'),
        );
        $this->db->where('user_id ',$datas['user_id']);
        $this->db->update('tbl_users',$data);
        return true;
    }
    public function getverificationInfo($verification_id)
    {
        $this->db->select('*');
        $this->db->from('tbl_users');
        $this->db->where('verification_code ', $verification_id); 
        $query=$this->db->get();
        return $query->result();
    }
    public function UpdateUserstatus($datas)
    {
        $data = array(
            'is_verified'=> 1, 
            'user_status'=> 1, 
            'updated_date'=> date('Y-m-d'),
        );
        $this->db->where('verification_code ',$datas);
        $this->db->update('tbl_users',$data);
        return true;
    }
    public function getallUsers()
    {
        $this->db->select('*');
        $this->db->from('tbl_users');
        $query=$this->db->get();
        return $query->result();
    }
}


?>