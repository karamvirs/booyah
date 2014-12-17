<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->model('authenticate');
        $this->load->library('form_validation');
        $this->load->model('media_type');
    }

    public function index() {
        
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        /*$data['allmedia_data'] = $this->media_type->all_mediatype();
        if ($this->form_validation->run() == TRUE) {
            $email = $this->input->post();
            $res = $this->authenticate->check_subscriber_email($email['email']);
            if ($res) {
                $this->session->set_flashdata('result', 'Email allready exists.');
                redirect(base_url());
            }else {
                $insert_res = $this->authenticate->insert_subscriber_email($email['email']);
                if ($insert_res) {
                    $this->session->set_flashdata('result', 'Email successfully registered.');
                    redirect(base_url());
                } else {
                    $this->session->set_flashdata('result', 'Please enter again.');
                    redirect(base_url());
                }
            }

            //insert;
        } else {*/
            $this->load->view('home');
       // }
    }

}
