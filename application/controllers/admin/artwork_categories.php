<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Artwork_categories extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('categories');
    }

    function index() {
        $data['artwork_cat'] = $this->categories->all_artwork_categories();
        $this->load->view('admin/admin_artwork_categories', $data);
    }

    function add_category() {
        $this->form_validation->set_rules('cat_name', 'category Name', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('admin/admin_add_artwork_category');
        } else {
            $this->categories->add_artwork_category($this->input->post());
            redirect(base_url() . 'admin/' . $this->input->post('cat_type'));
        }
    }

    function edit($data) {
        $this->form_validation->set_rules('cat_name', 'category Name', 'required');
        if ($this->form_validation->run() == FALSE) {
            $cat_data = array('cat_id' => $data);
            $result['cat_data'] = $this->categories->cat_data($cat_data);
            $this->load->view('admin/admin_edit_artwork_category', $result);
        } else {
            $cat_data = array('cat_id' => $data);
            $this->categories->update_artwork_category($this->input->post(), $cat_data);
            redirect(base_url() . 'admin/artwork_categories');
        }
    }

    function delete($data) {
        $this->categories->delete_artwork_category($data);
        redirect(base_url() . 'admin/artwork_categories');
    }

}
