<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Settings extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('authenticate');
        $this->load->library('form_validation');
    }

    public function index() {
        $data['data'] = $this->authenticate->get_paypal_email();
        $this->form_validation->set_rules('paypal_email', 'Paypal Email', 'required|valid_email');
        $this->form_validation->set_rules('mode', 'radio', 'required');
        if ($this->form_validation->run() == TRUE) {
            $result = $this->authenticate->paypal_email($_POST);
            if ($result) {
                $this->session->set_flashdata('result', 'Record successfully updated.');
                redirect('admin/settings');
            } else {
                $this->session->set_flashdata('result', 'Error in updation.');
                redirect('admin/settings');
            }
            $this->load->view('admin/settings', $data);
        } else {
            $this->load->view('admin/settings', $data);
        }
    }

    public function insert_paypal_email() {
        $data = $this->authenticate->paypal_email($_POST);
        if ($data) {
            $this->session->set_flashdata('result', 'Record successfully updated.');
            redirect('admin/settings');
        } else {
            $this->session->set_flashdata('result', 'Error in updation.');
            redirect('admin/settings');
        }
    }

}

?>