<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Activation extends CI_Controller {

    function index($id) {
        $this->load->model('authenticate');
        $data = array();
        $user_id_hash = base64_decode($id); 
        $u_id = explode('_',$user_id_hash);
        $user_id = $u_id['0'];

        
        $user_active = $this->authenticate->get_user_information($user_id);
        if ($user_active) {
            $user_activated = $this->authenticate->update_user_info_status($user_id);
            if ($user_active == true) {
                $this->session->set_userdata('spoton_user_loggedin', true);
                $this->session->set_userdata('spoton_user_id', $user_activated['id']);
                $this->session->set_userdata('spoton_user_email', $user_activated['email']);
                $this->session->set_userdata('spoton_user_name', $user_activated['name']);

                // $this->session->set_fleshdata('message', 'Please login');


                redirect('login');
            }
        } else {
            //$this->session->set_fleshdata('message', 'No user found.'); 
            redirect('login');
        }
    }

}
?>
