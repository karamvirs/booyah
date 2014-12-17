<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Subscribe extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('external_user');
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
    }

    function index() {
        $data['all_users_subscribe'] = $this->external_user->all_users_subscribe();
        $this->load->view('admin/subscribe_users', $data);
    }
}