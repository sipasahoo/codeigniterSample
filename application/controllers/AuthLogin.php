<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AuthLogin extends CI_Controller {
	public function __construct(){
		Parent::__construct();
		$this->load->database();
        $this->load->model("Admin_model","admin_model",true); 
        $this->load->library('session');
        $this->load->helper('security');  
        $this->load->helper(array('form', 'url','security'));     
		$this->load->library('form_validation'); 
        $this->load->library('password');
        $this->load->library('email');
    } 
	public function index()
	{
		$this->load->view('signup');
	}
	
	public function insert_user()
	{
		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('email', 'Email', 'trim|valid_email|required');
		$this->form_validation->set_rules('username', 'User Name', 'required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
		$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required|matches[password]');
		if($this->form_validation->run() == TRUE){    
			$name=$this->input->post('name');
            $email=$this->input->post('email');
            $username=$this->input->post('username');
            $password=$this->input->post('password'); 
           
            $exist_user=  $this->admin_model->ExistingUser($email);
            if(count($exist_user)>0){
				$this->session->set_flashdata('error','User already exist');
				redirect('AuthLogin/index');
            }
            else{
                $insert_array_data=array(
                    'name'=>$name,
                    'user_name'=>$username,
                    'user_email'=>$email,
					'user_password'=>$this->password->create_hash($this->input->post('password')),
					'user_role'=>1,
					'created_date'=>date('Y-m-d')
				);
				$data = $this->security->xss_clean($insert_array_data);

				$last_inserted_id=$this->admin_model->InsertUser($data);
				$this->session->set_flashdata('success','User Registered Successfully please Login');
				redirect('AuthLogin/index');
			}
		}
		else{
			$this->session->set_flashdata('error','Unable to Insert please try again');
			redirect('AuthLogin/index');
		}
	}
	public function login()
	{
		$this->load->view('login');
	}
	public function UserLogin(){
		$this->form_validation->set_rules('user_email', 'Email', 'trim|valid_email|required');
		$this->form_validation->set_rules('user_password', 'Password', 'trim|required');

		if($this->form_validation->run() == TRUE){
		   $email=$this->input->post('user_email');
		   $password=$this->input->post('user_password');
		   $user=$this->admin_model->LoginUser($email,$password);
		   if(!empty($user) && count($user)>0){
				  $user_id= $user[0]->user_id;
				  $name= $user[0]->name;
				  $user_name= $user[0]->user_name;
				  $user_role= $user[0]->user_role;
				  $user_email= $user[0]->user_email;
				  $is_verified= $user[0]->is_verified;
				  if($is_verified==1){
					$sess_array = array(
						'userid' => $user_id,
						'name'=>$name,
						'username' => $user_name,
						'useremail' => $user_email,
						'roleid' => $user_role,
						'sess_id' => session_id(),
					);
					$this->session->set_userdata($sess_array);
					redirect('AuthLogin/manageuser'); 

				  }
				  else{
					$array_datas=array(
						'verification_code'=>'VER_'.time(),
						'user_id'=> $user_id,
						);
					$data = $this->security->xss_clean($array_datas);
					$update=$this->admin_model->UpdateUserverification($data);
					$message='Hi'. $name .'</br>'.'Your verification code is '.'VER_'.time();
					$email_send = $this->send_mail('sipasahoo503@gmail.com',$user_email,'userverification',$message);
					$this->session->set_flashdata('success','Login Successfully');
					redirect('AuthLogin/Verificatiom'); 
				  }
					
		   }
		   else{
				$this->session->set_flashdata('error','Unable to Login please try again');
				redirect('AuthLogin/index');  
		   }
	   }
	   else{
			$this->session->set_flashdata('error','Unable to Login please try again');
			redirect('AuthLogin/index'); 
	   }
	}
	public function Verificatiom(){
		$this->load->view('verification');
	}  
	public function SubmitVerification(){
		$this->form_validation->set_rules('verification_code', 'Verification Code', 'trim|required');
		$verification_code=$this->input->post('verification_code');
		$user=$this->admin_model->getverificationInfo($verification_code);
		if(count($user)>0){			
			$update=$this->admin_model->UpdateUserstatus($verification_code);
			$user_id= $user[0]->user_id;
			$name= $user[0]->name;
			$user_name= $user[0]->user_name;
			$user_role= $user[0]->user_role;
			$user_email= $user[0]->user_email;
			$sess_array = array(
				'userid' => $user_id,
				'name'=>$name,
				'username' => $user_name,
				'useremail' => $user_email,
				'roleid' => $user_role,
				'sess_id' => session_id(),
			);
			$this->session->set_userdata($sess_array);
			redirect('AuthLogin/manageuser'); 

		}
		else{
			$this->session->set_flashdata('error','invalid code');
			redirect('AuthLogin/index'); 
		}
	}
	public function send_mail($from,$to,$subject,$message){ 
        $mailconfig = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 465,
            'smtp_user' => 'sipasahoo503@gmail.com',
            'smtp_pass' => 'kamalasahoo',
            'mailtype'  => 'html',
            'charset'   => 'iso-8859-1'
        ); 
        $this->email->initialize($mailconfig);
        $from_email =$from; 
        $to_email =$to; 
        $this->load->library('email'); 
        $this->email->from($from_email,'E-Coomerce'); 
        $this->email->to($to_email);
        $this->email->subject($subject); 
        $this->email->message($message); 
		$this->email->send();  
		   
	}
	public function manageuser(){
		$user_data=$this->session->userdata;
		$userid=$user_data['userid'];
		$name=$user_data['name'];
		$username=$user_data['username'];
		$useremail=$user_data['useremail'];
		$roleid=$user_data['roleid'];
		if($roleid=='2')
		{
			echo "Thank you ". $name. ' TO CONNECT WITH US';
		}
		else{
			$data['getallusers']=$this->admin_model->getallUsers();
			$this->load->view('manage_user',$data);

		}

	}
	public function AddUser(){
		$user_data=$this->session->userdata;
		$userid=$user_data['userid'];
		$name=$user_data['name'];
		$username=$user_data['username'];
		$useremail=$user_data['useremail'];
		$roleid=$user_data['roleid'];
		if($roleid=='2')
		{
			echo "Thank you ". $name. ' TO CONNECT WITH US';
		}
		else{
			$this->load->view('add_user');

		}

	}
	public function insert_guest_user()
	{
		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('email', 'Email', 'trim|valid_email|required');
		$this->form_validation->set_rules('region', 'Region', 'required');
		$this->form_validation->set_rules('country', 'Country', 'required');
		$this->form_validation->set_rules('division', 'Division', 'required');
		$this->form_validation->set_rules('role_id', 'Role', 'required');

		if($this->form_validation->run() == TRUE){    
			$name=$this->input->post('name');
            $email=$this->input->post('email');
            $region=$this->input->post('region');
            $country=$this->input->post('country'); 
			$division=$this->input->post('division');
			$role_id=$this->input->post('role_id'); 
            $exist_user=  $this->admin_model->ExistingUser($email);
            if(count($exist_user)>0){
				$this->session->set_flashdata('error','User already exist');
				redirect('AuthLogin/manageuser');
            }
            else{
                $insert_array_data=array(
                    'name'=>$name,
					'user_email'=>$email,
					'user_region'=>$region,
					'user_country'=>$country,
					'user_division'=>$division,
					'user_role'=>$role_id,
					'created_date'=>date('Y-m-d')
				);
				$data = $this->security->xss_clean($insert_array_data);
				$last_inserted_id=$this->admin_model->InsertUser($data);
				$this->session->set_flashdata('success','User Registered Successfully please Login');
				redirect('AuthLogin/manageuser');
			}
		}
		else{
			$this->session->set_flashdata('error','Unable to Insert please try again');
			redirect('AuthLogin/manageuser');
		}
	}
}
