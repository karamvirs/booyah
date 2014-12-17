<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends CI_Controller {


    function index() {
		$this->load->view('login');
	}
    function login_check() { 
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $this->load->model('authenticate');
        @$referer = $_SERVER['HTTP_REFERER']; 
        $user_detail = $this->authenticate->check_user($email, $password);
		//echo "<pre>";print_r($user_detail);echo "</pre>";die;


        if ($user_detail) {
            $status = $this->authenticate->check_user_acivation($user_detail['id']);
            //print_r($status);
            if ($status['status'] == '0') {
                $this->session->set_flashdata('message', 'Please check your mail first.');
                //redirect($referer);
                $this->load->view('login');
            } else {
                $this->session->set_userdata('booyah_user_email', $user_detail['email']);
                $this->session->set_userdata('booyah_user_loggedin', true);
                $this->session->set_userdata('booyah_user_id', $user_detail['id']);
                $this->session->set_userdata('booyah_user_name', $user_detail['name']);
                $this->session->set_userdata('booyah_user_type', $user_detail['type']);
                $this->session->set_flashdata('message', $user_detail['name'].' Successfully logged in');
                redirect('/user');
               /* if($user_detail['type']=='regular'){
					redirect('/reguser/addgif');
				}
				if($user_detail['type']=='pro'){
					redirect('/prouser/addgif');
				}*/
                //$this->load->view('login');
            }
        } else {
            $this->session->set_flashdata('message', '*Invalid username or password.');
            $this->load->view('login');
           
        }
    }

    function forgot_password() {
        $email = $_POST['email'];
        $this->load->model('authenticate');
        $admin_email = $this->authenticate->forgot_password($email);
        if ($admin_email) {

            $forgotScret = md5(uniqid(time(), true));

            $forgot_email = $admin_email['email'];
            $sql = "UPDATE users SET forgot_secret = '$forgotScret' , forgot_password_request = 1 WHERE email = '$forgot_email'";
            $this->db->query($sql);
            $forgotScret = base_url() . 'login/forgotPassword/' . $forgotScret;
            $email_data = array(
                'email' => $forgot_email,
                'code' => $forgotScret,
                'name' => $admin_email['name']
            );

            $subject = "[THUMBFound App] Password Recovery";
            $message = $this->load->view('/email/forgot_password_email', $email_data, true);


            // $from = $this->config->item('from_address');
            // $from_name = $this->config->item('from_name');
            //$from = 'susheel.kumar@60degree.com';
           
            $headers = "From: info@60degreedeveloper.info" . "\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
            mail($email, $subject, $message, $headers);
            echo "success";
            die();
        } else {
            echo "fail";
            die();
        }
    }

    function forgotPassword($secret) {
        if (!empty($_POST) && $_POST['action'] == 'change_password') {
            $password = md5($_REQUEST['password']);
            $f_secret = $_REQUEST['secret'];
            $sql = "SELECT * FROM users WHERE forgot_secret = '" . $f_secret . "'";
            $query = $this->db->query($sql);
            if ($query->num_rows() > 0) {
                $sql = "UPDATE users SET password = '$password' , forgot_password_request = '0', forgot_secret='' WHERE forgot_secret = '$f_secret'";
                $this->db->query($sql);
                echo 'true';
            } else {
                echo 'false';
            }
        } else {
            $data['secret'] = $secret;
            $this->load->view('forgot_password', $data);
        }
    }

    function logout() {
        $this->session->sess_destroy();
        redirect('login');
    }

    public function email_exists() {
        $data = '';
        $this->load->model('authenticate');
        $email = $this->input->post('reg_email');
        $data = $this->authenticate->email_exists($email);
        if ($data > 0) {
            echo "sucess";
        } else {
            echo "failed";
        }
    }

    public function registration_active() {
        $this->load->model('authenticate');
        $data = array(
            "name" => $this->input->post('name'),
            "type" => 'user',
            "email" => $this->input->post('reg_email'),
            "password" => md5($this->input->post('password')),
        );

        $data = $this->authenticate->insert($data);
        $user_id_info = $this->db->insert_id();
        $base_code = $user_id_info . '_' . time();

        $data1['activation_link'] = base_url() . "activation/index/" . base64_encode($base_code);
        $this->authenticate->update_user_information($base_code, $user_id_info);
        $email = $this->input->post('reg_email');
        $password = $this->input->post('reg_password');
        $firstname = $this->input->post('name');
        $to = $email;
        //$to = 'sachin.mishra@60deree.com';

        $subject = "Activation Code : SpotOnMedia";
        $data1['name'] = $firstname;
        $data1['email'] = $email;
        $data1['password'] = $password;
        $txt = $this->load->view('/email/verificationemail', $data1, true);
        $headers = "From: info@60degreedeveloper.info" . "\r\n" . "CC: susheel1688@gmail.com" . "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        mail($to, $subject, $txt, $headers);
        echo "success";
    }

}

?>
