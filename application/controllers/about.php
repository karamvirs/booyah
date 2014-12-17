<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class About extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('deliveryzone_model');
        $this->load->model('media_type');
    }   

    public function index() {
        $this->load->view('about');
    }
}

