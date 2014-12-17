<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Profile extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('deliveryzone_model');
        $this->load->model('authenticate');
        $this->load->model('deliveryzone_model');
        $this->load->model('order_model');
        $this->load->model('pricepack_model');
        $this->load->library('session');
    }

    function index() {

        $user_logged_in = $this->session->userdata('spoton_user_id');

        if ($user_logged_in) {

            $data['user_address'] = $this->authenticate->user_shipping_address($user_logged_in);
            $data['all_orders'] = $this->order_model->user_orders($user_logged_in);
            $user_name = $this->authenticate->get_user_name($user_logged_in);
            $data['user_name'] = $user_name['name'];
            if (!empty($data['all_orders'])) {
                foreach ($data['all_orders'] as $key => $all_order) {

                    $zone_ids_arr = json_decode($all_order['delivery_zone_ids']);
                    $zname = array();
                    $delivery_zone = $this->deliveryzone_model->getZoneNamebyId($zone_ids_arr);
                    $pack_name = $this->pricepack_model->getPricepackName($all_order['pricepack_id']);
                    $user_name = $this->authenticate->get_user_name($all_order['user_id']);
                    // echo "<pre>";print_r($delivery_zone);
                    foreach ($delivery_zone as $zone_name) {
                        foreach ($zone_name as $zone) {
                            $zname[] = $zone;
                        }
                    }
                    $z = implode(',', $zname);
                    $data['all_orders'][$key]['delivery_zone'] = $z;
                    $data['all_orders'][$key]['pricepack'] = $pack_name['pack_name'];
                    $data['all_orders'][$key]['name'] = $user_name['name'];
                }
            }
            $this->load->view('profile', $data);
        } else {
            $this->load->view('login');
        }
    }

    function update_address() {
        // print_r($_POST); die;
        if (isset($_POST['id']) && !empty($_POST['id'])) {
            $data = array(
                'name' => $_POST['name'],
                'address1' => $_POST['address1'],
                'address2' => $_POST['address2'],
                'city' => $_POST['city'],
                'province' => $_POST['province'],
                'zip' => $_POST['zip'],
                'country' => $_POST['country']
            );
            $data = $this->authenticate->update_address($_POST['id'], $data);
            if ($data) {
                $this->session->set_flashdata('success', 'Record successfully updated.');
                redirect('profile');
            } else {
                $this->session->set_flashdata('failure', 'Error in update.');
                redirect('profile');
            }
        }
    }

}

?>