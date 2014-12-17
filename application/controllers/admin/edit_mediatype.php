<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Edit_mediatype extends CI_Controller {

    function index() {
        $mediatype_id = $_GET['id'];
        $this->load->model('media_type');
        $data['edit_mediatype'] = $this->media_type->edit_mediatype_show_model($mediatype_id);
        $this->load->view('admin/admin_edit_mediatype', $data);
    }

    function edit_media_type() {
        $media_id = $_POST['media_id'];
        $name = $_POST['name'];
        $width = $_POST['width'];
        $height = $_POST['height'];
        $allow_deals = $_POST['allow_deals'];
        $allow_image = $_POST['allow_image'];
        $image_types = json_encode($_POST['image_types']);
        $allow_text_input = $_POST['allow_text_input'];
        //$uploaded_image=$_POST['uploaded_image'];
        if(!empty($_REQUEST['custom_fields'])){
        	
        $custom_fields = json_encode($_REQUEST['custom_fields']);
        }
        $data1 = array();
        $image_path = $_SERVER['DOCUMENT_ROOT'] . '/spotonmedia/templates/mediatype_images/';

        $config['upload_path'] = $image_path;


        $file_name = uniqid() . str_replace(' ', '_', $_FILES['uploaded_image']['name']);

        $filename1 = $image_path . basename($file_name);
        if (move_uploaded_file($_FILES['uploaded_image']['tmp_name'], $filename1)) {
            $imgArray = array(
                'image_name' => $file_name,
                'image_type' => $_FILES['uploaded_image']['type'],
                'image_size' => $_FILES['uploaded_image']['size']
            );


            $data = array(
                'name' => $name,
                'width' => $width,
                'height' => $height,
                'allow_deals' => $allow_deals,
                /* 'max_deals'=>$max_deals, */
                'custom_image' => $allow_image,
                'image_types' => $image_types,
                'allow_text_input' => $allow_text_input,
                'image' => $file_name,
                'custom_fields' => $custom_fields
            );
        } else {
            $data = array(
                'name' => $name,
                'width' => $width,
                'height' => $height,
                'allow_deals' => $allow_deals,
                /* 'max_deals'=>$max_deals, */
                'custom_image' => $allow_image,
                'image_types' => $image_types,
                'allow_text_input' => $allow_text_input,
                'custom_fields' => $custom_fields
            );
        }

        $data1['media_id'] = $media_id;
        $this->load->model('media_type');
        $this->media_type->edit_mediatype_model($data, $data1);
        redirect('admin/mediatype');
    }

}
