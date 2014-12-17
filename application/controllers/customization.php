<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Customization extends CI_Controller {

    public function index() {
        $media_id = $this->session->userdata('media_type_id');
        if (isset($_POST['media_type']) || !empty($media_id)) {
            if (!empty($_POST['media_type'])) {
                $this->session->set_userdata('media_type_id', $_POST['media_type']);
                $media_id = $_POST['media_type'];
            }

            $this->load->model('media_type');
            $data['details_of_mediatype'] = @$this->media_type->edit_mediatype_show_model($media_id);
            $this->load->model('deals_model');
            $data['deals_of_mediatypes'] = @$this->deals_model->all_deals_of_mediatype($media_id);
            $this->load->model('art_work');
            $data['artwork_of_mediatypes'] = @$this->art_work->all_artwork_of_mediatype($media_id);
            $this->load->view('customize', $data);
        } else {
            redirect('begin');
        }
    }

    public function manual_image() {
        //
        if(!empty($_FILES)){ 
        $image_path = $_SERVER['DOCUMENT_ROOT'] . '/spotonmedia/templates/artwork_images/';
        $config['upload_path'] = $image_path;
        $uploaded_image = array();
        if ($_FILES['uploaded_image']['tmp_name']) {

            if ($_FILES['uploaded_image']['tmp_name']) {
                $file_name = uniqid() . str_replace(' ', '_', $_FILES['uploaded_image']['name']);
                $filename1 = $image_path . basename($file_name);
                if (move_uploaded_file($_FILES['uploaded_image']['tmp_name'], $filename1)) {
                  echo base_url().'templates/artwork_images/'.$file_name;
                }
               
            }
        }

        } else{
            echo "error";
        }
    }

}

?>