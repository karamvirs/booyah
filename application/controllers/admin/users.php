<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Users extends CI_Controller {
	public function __construct() {
        parent::__construct();
        $this->load->model('user_m');
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');		
    }


	function index() {		
		$data['allusers']= $this->user_m->all_users();
		$this->load->view('admin/admin_all_users', $data); 
	}
	function add_user() {	
		$this->form_validation->set_rules('name', 'User Name', 'required');
		$this->form_validation->set_rules('email','User Email', 'required|callback_check_existing_email');
		$this->form_validation->set_rules('type', 'User Type', 'required');
		$this->form_validation->set_rules('address1', 'Address1', 'required');
		$this->form_validation->set_rules('address2', 'Address2', '');
		$this->form_validation->set_rules('city', 'City', '');
		$this->form_validation->set_rules('province', 'State', '');
		$this->form_validation->set_rules('zip', 'Zip', '');
		$this->form_validation->set_rules('password', 'Password', 'required|matches[repassword]');
		$this->form_validation->set_rules('repassword', 'Repassword', 'required');
		
        if ($this->form_validation->run() == FALSE) {		
            $this->load->view('admin/admin_add_user');
        } else {	
		$post=$this->input->post();			
		
		$post_user = array(
                        'status' => '1',
                        'password' => md5($this->input->post('password'))
                    );
		unset($_POST['password'], $_POST['repassword']);
		$post_agent = array_merge((array) $post_user, $this->input->post());		 
		
	
		$user_id=$this->user_m->add_user($post_agent);		
		redirect(base_url().'admin/users');
		}
	}
	 function check_existing_email($email) {
        $data = array(
            'email' => $email
        );
        $result = $this->user_m->get_user($data);		
        if ($result) {
            $this->form_validation->set_message('check_existing_email', 'Email already exist.');			
            return false;
        } else {
            return true;
        }
    }
	
	function edit($data) {	
	$this->form_validation->set_rules('name', 'User Name', 'required');
		$this->form_validation->set_rules('email','User Email', 'required|callback_check_existing_emaill');
		$this->form_validation->set_rules('type', 'User Type', 'required');
		$this->form_validation->set_rules('address1', 'Address1', 'required');
		$this->form_validation->set_rules('address2', 'Address2', '');
		$this->form_validation->set_rules('city', 'City', '');
		$this->form_validation->set_rules('province', 'State', '');
		$this->form_validation->set_rules('zip', 'Zip', '');	
		
        if ($this->form_validation->run() == FALSE) {	
			$user_data = array('id' => $data);
			$result['user_data']= $this->user_m->get_user($user_data);		
            $this->load->view('admin/admin_edit_user', $result);
        } else {
		$user_data = array('id' => $data);	
		unset($_POST['email_cofirm']);		
		unset($_POST['user_id']);		
		$this->user_m->update_user($this->input->post(), $user_data);		
		redirect(base_url().'admin/users');
		}
	}
	
	function check_existing_emaill($email) { 
		$user_id = $this->input->post('user_id');
		if($email!=$this->input->post('email_cofirm')){
		
			$data = array(
				'email' => $email
			);
			$result = $this->user_m->get_user($data);	
				if ($result && $result[0]->id!=$user_id) {
					$this->form_validation->set_message('check_existing_emaill', 'Email already exist.');			
					return false;
				} else {
					return true;
				}
		}
		else return true;
		
    }
	
	function delete($data) {				
		$this->user_m->delete_user($data);		
		redirect(base_url().'admin/users');
		
	}
	
	function permission() {	
		
		if(isset($_POST['persave'])){
			/*unset($_POST['persave']);*/
			if(empty($_POST['reg'])){
				$data['modules']='';
			} else {
				$data['modules']=implode(',',$_POST['reg']);
			}
			$role = array('role' => 'regular');
			
			$this->user_m->update_permisssion($data, $role);
			/************************************/
			if(empty($_POST['pro'])){
				$data1['modules']='';
			} else {
				$data1['modules']=implode(',',$_POST['pro']);
			}
			$role1 = array('role' => 'pro');
			$this->user_m->update_permisssion($data1, $role1);	
					
		} 	
			$data['reg_data'] = $this->user_m->get_permisssion('regular');
			$data['pro_data'] = $this->user_m->get_permisssion('pro');
			
			$this->load->view('admin/admin_permission', $data);
			
		
	}

}
