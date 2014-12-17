<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends CI_Controller {

    function index() {
        $username = $this->input->post('username');

        $password = $this->input->post('password');

        $this->load->model('authenticate');

        $admin_detail = $this->authenticate->check_admin($username, $password);

        if ($admin_detail) {
 
            $this->session->set_userdata('spoton_admin_email', $admin_detail['email']);
            $this->session->set_userdata('spoton_admin_loggedin', true);
            $this->session->set_userdata('spoton_admin_id', $admin_detail['id']);
            $this->session->set_userdata('spoton_admin_name', $admin_detail['name']);
            //print_r($this->session->userdata); 
            redirect('admin');
        } else {
            $this->session->set_flashdata('message', 'Invalid Username or password ');
            redirect('/admin');
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
            /* $email_data = array(
              'email'=>$forgot_email,
              'code'=>$forgotScret,
                'name'=>$admin_email['name'];
              );

              $subject = "[Spotonmedia] Password Recovery";
              $message = $this->load->view('email/forgot_password_email',$email_data,true);


              $from = $this->config->item('from_address');
              $from_name = $this->config->item('from_name');

              // Set headers
              $headers = "From: $from_name<$from>". "\r\n";
              $headers .= "Reply-To: Spotonmedia Support <support@Spotonmedia.com>\r\n";
              $headers .= "MIME-Version: 1.0\r\n";
              $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
              mail($email,$subject,$message,$headers); */

            echo "success";
            die();
        } else {
            echo "fail";
            die();
        }
    }

    function logout() {
		$this->session->sess_destroy();
		redirect('admin');
	}

}

?>
