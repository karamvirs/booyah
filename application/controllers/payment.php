<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Payment extends CI_Controller {

    function __construct() {
        parent::__construct();
        // $this->load->model('payment_model');
        $this->load->model('deliveryzone_model');
        $this->load->model('pricepack_model');
        $this->load->model('order_model');
        $this->load->model('authenticate');
        $this->load->model('media_type');
    }

    public function index() {

        $ids = array();
        $data = array();
        $ids = $this->session->userdata("item_ids");
        $spoton_user_id = $this->session->userdata("spoton_user_id");
        $data['user_address'] = $this->authenticate->user_shipping_address($spoton_user_id);

        $media_id = $this->session->userdata('media_type_id');
        $data['mediatype'] = @$this->media_type->edit_mediatype_show_model($media_id);
        //print_r($data['mediatype']);die("ddd");
        $data['seleted_zones'] = $this->deliveryzone_model->getZonebyId($ids); // uncmt to use
        $data['pricepacks'] = $this->pricepack_model->all_pricepacks_by_quantity(); // uncmt to use
        $this->load->view('payment', $data); // uncmt to use
        /*

          if (!empty($spoton_user_id)) { // check if user logged in or not
          if (!empty($data)) {
          $data['seleted_zones'] = $this->deliveryzone_model->getZonebyId($data);
          $data['pricepacks'] = $this->pricepack_model->all_pricepacks_by_quantity();
          $this->load->view('payment', $data);
          }
          } else {
          $payment_referer = base_url().'payment';
          $this->session->set_userdata("payment_referer",$payment_referer);
          redirect('login');
          }
         * */
    }

    function check_for_login() {
        $user_id = $this->session->userdata('spoton_user_id');
        $item_ids = $this->session->userdata('item_ids');
        if (!empty($user_id) && !empty($item_ids)) {
            echo "loggedin";
        } else {
            echo "notloggedin";
        }
    }

    public function insert_orderproduct() {
        $paypal_email = $this->authenticate->get_paypal_email();
        if($paypal_email['mode']=='live'){
            $url = 'https://www.paypal.com/cgi-bin/webscr';
        }else {
            $url = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
        }
        if (!empty($_POST)) {
            $session_product = $this->session->userdata("session_product");
            $data = array();
            $spoton_user_id = $this->session->userdata("spoton_user_id");

            $session_product = $this->session->userdata("session_product");
            $final_prod = json_decode($session_product);
            
            $raw_all = array('front_all'=>$final_prod->front_all,'back_all'=>$final_prod->back_all);
            $data['raw_product'] = json_encode($raw_all);

            $complete = array('front_complete' => $final_prod->front_complete, 'back_complete' => $final_prod->back_complete);
            $data['final_product'] = json_encode($complete);

            $media_id = $this->session->userdata('media_type_id');
           
            $paypal_data = array();
            $data['user_id'] = $spoton_user_id;
            $data['name'] = $_POST['fname'] . ' ' . $_POST['lname'];
            $data['email'] = $_POST['email'];
            $data['address1'] = $_POST['address1'];
            $data['address2'] = $_POST['address2'];
            $data['city'] = $_POST['city'];
            $data['province'] = $_POST['province'];
            $data['zip'] = $_POST['zip'];
            $data['country'] = $_POST['country'];
            $data['if_remaining'] = $_POST['if_remaining'];
            $data['pricepack_id'] = $_POST['pricepack_id'];
            $data['delivery_zone_ids'] = $_POST['delivery_zone_ids'];
            $data['media_type_id'] = $media_id;


            $merchent_email = $paypal_email['paypal_email'];
            $paypal_data ['cmd'] = $_POST['cmd'];
            $paypal_data ['custom'] = $_POST['email'] . "|" . $_POST['fname'] . ' ' . $_POST['lname'];

            $paypal_data ['business'] = $merchent_email;
            $paypal_data ['item_name'] = $_POST['item_name'];
            $paypal_data ['currency_code'] = $_POST['currency_code'];
            $paypal_data ['item_number'] = $_POST['item_number'];
            $paypal_data ['amount'] = $_POST['amount'];
            $paypal_data ['return'] = $_POST['return'];
            $paypal_data ['notify_url'] = $_POST['notify_url'];




            $insert_id = $this->order_model->insert_product_order($data);
            if ($insert_id) {
                $this->session->set_userdata("last_insert_id", $insert_id);
                $query_string = http_build_query($paypal_data);

                header('Location: '.$url.'?' . $query_string);
            } else {
                echo "failure";
            }
        }
    }

    public function payment_success() {
        //echo "<pre>";print_r($session_product );echo "</pre>";die;

        $session_product = $this->session->userdata('session_product');
        if (!empty($session_product)) {
            $custom = explode('|', $_REQUEST['custom']); //name and email
            $email_data = array();
            $data = array();
            $data['transaction_id'] = $_REQUEST['txn_id'];
            $data['auth_code'] = $_REQUEST['auth'];
            $data['status'] = '1';
            $data['transaction_method'] = "paypal_standard";
            $insert_id = $this->session->userdata("last_insert_id");
            $to_email = $this->session->userdata("spoton_user_email");
            $email_data['name'] = $this->session->userdata("spoton_user_name");
            if ($to_email) {
                $to = $this->session->userdata("spoton_user_email");
            } else {
                $to = $custom['0'];
                $email_data['name'] = $custom['1'];
            }

            $status = $this->order_model->update_after_paypal($insert_id, $data);
            if ($status) {

                $subject = "Confirmation Email: SpotOnMedia";
                $email_data['amount'] = $_REQUEST['mc_gross'];
                $email_data['txn_id'] = $_REQUEST['txn_id'];
                /*                 * ************************************ */
                $session_product = $this->session->userdata("session_product");
                $final_prod = json_decode($session_product);

                $email_data['front_complete'] = $final_prod->front_complete;
                $email_data['back_complete'] = $final_prod->back_complete;
                /*                 * ************************************ */

                $txt = $this->load->view('/email/payment_confirmation', $email_data, true);
                $headers = "From: info@60degreedeveloper.info" . "\r\n";
                $headers .= "MIME-Version: 1.0\r\n";
                $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
                mail($to, $subject, $txt, $headers);
                //here we have to destroy session
                /*                 * ********************* */
                $this->session->unset_userdata('item_ids_quantity');
                $this->session->unset_userdata('last_insert_id');
                $this->session->unset_userdata('item_ids');
                $this->session->unset_userdata('media_type_id');
                $this->session->unset_userdata('session_product');
                /*                 * *************************** */
                $this->load->view('payment_success', $email_data);
            }
        } else {
            redirect(base_url());
        }
    }

    public function payment_failed() {

        echo "<pre>";
        print_r($_REQUEST);
        die;
    }

}
