<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Artwork extends CI_Controller {

    function __construct() {
        parent::__construct();
		$this->load->model('art_work');
		$this->load->model('media_type');
		$this->load->model('categories');
    }

    function index() {
        $data['art'] = $this->art_work->all_art_work();
        $this->load->view('admin/admin_artwork', $data);
    }
	function add_artwork() {	
		$this->form_validation->set_rules('name', 'Artwork Name', 'required');
		$this->form_validation->set_rules('media_id','Artwork Media Type', 'required');
		$this->form_validation->set_rules('categories', 'Artwork Categories', 'required');
		
        if ($this->form_validation->run() == FALSE) {				
			$data['all_medtpye'] = $this->media_type->all_mediatype();			
			$data['all_artwork_cats'] = $this->categories->all_artwork_categories();
			$this->load->view('admin/admin_addartwork', $data);
        } else {	
		
        if($_FILES['front']) {
		$image_path            = './templates/artwork_images/';
        $config['upload_path'] = $image_path;   
		$file_name = uniqid() . str_replace(' ', '_', $_FILES['front']['name']);
        $filename1 = $image_path . basename($file_name);
        if (move_uploaded_file($_FILES['front']['tmp_name'], $filename1)) {
            $imgArray = array(
                'image_name' => $file_name,
                'image_type' => $_FILES['front']['type'],
                'image_size' => $_FILES['front']['size']
            );
        }
		}		
		
		$add_artwork = array( 	
								'media_id' => json_encode($_POST['media_id']),
								'cat_id'   => json_encode($_POST['categories']),
								'front_image' => $file_name,
								'status'=>'1'
								);
                    
		unset($_POST['media_id'], $_POST['categories']);
		$artwork_data = array_merge((array) $this->input->post(), $add_artwork);		 
		
		$this->art_work->add_artwork($artwork_data);
		redirect(base_url().'admin/artwork');
		}
	}
	function edit_artwork($artworkid) {	
		$this->form_validation->set_rules('name', 'Artwork Name', 'required');
		$this->form_validation->set_rules('media_id','Artwork Media Type', 'required');
		$this->form_validation->set_rules('categories', 'Artwork Categories', 'required');	
		
        if ($this->form_validation->run() == FALSE) {
			
			$data['edit_artwork'] = $this->art_work->edit_artwork_show_model($artworkid);			
			$data['all_medtpye'] = $this->media_type->all_mediatype();			
			$data['all_artwork_cats'] = $this->categories->all_artwork_categories();
			$this->load->view('admin/admin_editartwork', $data);
        } else {
		if ($_FILES['front']['tmp_name'])  {
		$image_path            = './templates/artwork_images/';
        $config['upload_path'] = $image_path;   
		$file_name = uniqid() . str_replace(' ', '_', $_FILES['front']['name']);
        $filename1 = $image_path . basename($file_name);
        if (move_uploaded_file($_FILES['front']['tmp_name'], $filename1)) {
            $imgArray = array(
                'image_name' => $file_name,
                'image_type' => $_FILES['front']['type'],
                'image_size' => $_FILES['front']['size']
            );
        }
		$add_artwork = array( 	
								'media_id' => json_encode($_POST['media_id']),
								'cat_id'   => json_encode($_POST['categories']),
								'front_image' => $file_name
								);
                    
		unset($_POST['media_id'], $_POST['categories']);
		$artwork_data = array_merge((array) $this->input->post(), $add_artwork);
		} else { 
		$add_artwork = array( 	
								'media_id' => json_encode($_POST['media_id']),
								'cat_id'   => json_encode($_POST['categories'])								
								);
                    
		unset($_POST['media_id'], $_POST['categories']);
		$artwork_data = array_merge((array) $this->input->post(), $add_artwork);
		}			
		$artwork_id = array('artwork_id' => $artworkid);	
		// print_r($artwork_data);		
		// die();
		$this->art_work->edit_artwork($artwork_data, $artwork_id);		
		redirect(base_url().'admin/artwork');
		}
	}

    function delete($artworkid) {
	    $status_artwork = array('status'=>'0');
		$artwork_id = array('artwork_id' => $artworkid);
        $this->art_work->delete_art_work($status_artwork , $artwork_id);
        redirect(base_url() . 'admin/artwork');
    }

    function edit() {
        $where = array('artwork_id' => $this->input->post('artwork_id'));
        $name = $_POST['name'];
        $media_id = json_encode($_POST['media_id']);
        $categories = json_encode($_POST['categories']);
        $image_path = $_SERVER['DOCUMENT_ROOT'] . '/spotonmedia/templates/artwork_images/';
        $config['upload_path'] = $image_path;
		$front_image = array();
		$back_image = array();
        if ($_FILES['front']['tmp_name'] || $_FILES['back']['tmp_name'])  {
            if ($_FILES['front']['tmp_name']) {
                $file_name = uniqid() . str_replace(' ', '_', $_FILES['front']['name']);
                $filename1 = $image_path . basename($file_name);
                if (move_uploaded_file($_FILES['front']['tmp_name'], $filename1)) {
                    $imgArray = array('image_name' => $file_name, 'image_type' => $_FILES['front']['type'], 'image_size' => $_FILES['front']['size']);
                } 
				$front_image = array('front_image' => $file_name);
            }
			if ($_FILES['back']['tmp_name']) {
                $file_namee = uniqid() . str_replace(' ', '_', $_FILES['back']['name']);
                $filenamee1 = $image_path . basename($file_namee);
                if (move_uploaded_file($_FILES['back']['tmp_name'], $filenamee1)) {
                    $imgArray = 
						array('image_name' => $file_namee, 
								'image_type' => $_FILES['back']['type'], 
								'image_size' => $_FILES['back']['size']);
                } 
				$back_image = array('back_image' => $file_namee);
            } $data = array('name' => $name, 'media_id' => $media_id, 'cat_id' => $categories);
            $data = array_merge((array) $data, $front_image, $back_image);
			
        } else {
            $data = array('name' => $name, 'media_id' => $media_id, 'cat_id' => $categories);
        }
		// print_r($data);
		// die("d");
		$this->art_work->edit_artwork($data, $where);
        redirect('admin/artwork');
    }

}
