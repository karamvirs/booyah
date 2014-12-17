<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Contactus extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('external_user');
    }

    function index() {
        $data['all_users_contact'] = $this->external_user->all_users_contact();
        $this->load->view('admin/contact_users', $data);
    }

    

}
