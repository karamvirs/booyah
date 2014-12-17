<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Contact extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('deliveryzone_model');
        $this->load->model('media_type');
        $this->load->model('authenticate');
        $this->load->library('form_validation');
    }   

    public function index() { 
        $this->load->view('contact');
    }
    public function insert_contact() {
        
        $this->form_validation->set_rules('name', 'Name');
        $this->form_validation->set_rules('contact_email', 'Contact Email', 'required|valid_email');
        $this->form_validation->set_rules('phone', 'Phone','');
        $this->form_validation->set_rules('message', 'Message', 'required');
         if ($this->form_validation->run() == TRUE) {
             $data = $this->input->post();
             $result =$this->authenticate->insert_contact($data);
             if($result){ 
                $this->session->set_flashdata('result', 'Thanks for contacting us. You will here from us very soon.');
                redirect('contact');
                exit;
             } else{
                $this->session->set_flashdata('result', 'Please try again.');
                redirect('contact');
             }
         }
        $this->load->view('contact');
    }
}
