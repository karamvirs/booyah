<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Delivery extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('deliveryzone_model');
        $this->load->model('media_type');
    }

    public function index() {
         $img_data = $this->session->userdata('session_product');
        if(!empty($img_data)) {
            
            $media_id = $this->session->userdata('media_type_id');
            $data['details_of_mediatype'] = @$this->media_type->edit_mediatype_show_model($media_id);
            $data['all_zone'] = $this->deliveryzone_model->all_deliveryzone();

            $item_ids = $this->session->userdata("item_ids");
            if (!empty($item_ids)) {
                $data['ifInSeesion'] = $this->deliveryzone_model->getZonebyId($item_ids);
            }
            $this->load->view('delivery', $data);
        } elseif(isset($_REQUEST['product']) && !empty($_REQUEST['product'])) {
            $product = json_encode($_REQUEST['product']);
            $this->session->set_userdata('session_product', $product);
            $media_id = $this->session->userdata('media_type_id');
            $data['details_of_mediatype'] = @$this->media_type->edit_mediatype_show_model($media_id);
            $data['all_zone'] = $this->deliveryzone_model->all_deliveryzone();

            $item_ids = $this->session->userdata("item_ids");
            if (!empty($item_ids)) {
                $data['ifInSeesion'] = $this->deliveryzone_model->getZonebyId($item_ids);
            }
            $this->load->view('delivery', $data);
        }else{
            redirect('customization');
        }
    }

    public function setitemsession() {
        if (isset($_POST['ids'])) {
            $this->session->set_userdata("item_ids", $_POST['ids']); //for payment and delivery purpose
            $this->session->set_userdata("item_ids_quantity", $_POST['qty']); //for payment and delivery purpose
            echo "success";
        } else {
            $this->session->set_userdata("item_ids", ''); //for payment and delivery purpose
            $this->session->set_userdata("item_ids_quantity", 0); //for payment and delivery purpose
            echo "failure";
        }
    }

}

?>
