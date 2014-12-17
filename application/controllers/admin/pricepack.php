<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pricepack extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('pricepack_model');
    }

    function index() {

        $data['pricepacks'] = $this->pricepack_model->all_pricepacks();
        $this->load->view('admin/admin_pricepack', $data);
    }

    function add_pricepack() {

        $this->load->view('admin/admin_add_pricepack');
    }

    function insert_pricepack() {

        $pack_name = $_POST['pack_name'];
        $quantity = $_POST['quantity'];
        $price = $_POST['price'];

        $data = array(
            'pack_name' => $pack_name,
            'quantity' => $quantity,
            'price' => $price
        );

        $this->pricepack_model->add_pricepack($data);
        redirect('admin/pricepack');
    }

    function edit_pricepack($pricepack_id) {

        $data['pricepacks'] = $this->pricepack_model->edit_pricepack($pricepack_id);
        $this->load->view('admin/admin_pricepack_edit', $data);
    }

    function update_pricepack() {

        if (isset($_POST['pricepack_id']) && !empty($_POST['pricepack_id'])) {
            $price_data = array(
                'pricepack_id' => $_POST['pricepack_id'],
                'pack_name' => $_POST['pack_name'],
                'price' => $_POST['price'],
                'quantity' => $_POST['quantity']
            );


            $data = $this->pricepack_model->update_pricepack($price_data);
            if ($data) {
                $this->session->set_flashdata('success', 'Record successfully updated.');
                redirect('admin/pricepack');
            } else {
                $this->session->set_flashdata('failure', 'Error in update.');
                redirect('admin/pricepack');
            }
        }
    }

    function delete_pricepack($pricepack_id) {

        $data = $this->pricepack_model->delete_pricepack($pricepack_id);
        if ($data) {
            $this->session->set_flashdata('success', 'Record successfully deleted.');
            redirect('admin/pricepack');
        } else {
            $this->session->set_flashdata('failure', 'Error in deletion.');
            redirect('admin/pricepack');
        }
    }

}
