<?php
ob_start();
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Add_mediatype extends CI_Controller{

	function index(){
	$this->load->view('admin/admin_addmediatype'); 
	}
	
	function insert_mediatype() {
	
	$name=$_POST['name'];
	$width=$_POST['width'];
	$height=$_POST['height'];
	$allow_deals=$_POST['allow_deals'];
	//$max_deals=$_POST['max_deals'];
	$allow_image=$_POST['allow_image'];
	$image_types=json_encode($_POST['image_types']);
	$allow_text_input=$_POST['allow_text_input'];
	 if(!empty($_REQUEST['custom_fields'])){
        	
        $custom_fields = json_encode($_REQUEST['custom_fields']);
        }
	//$uploaded_image=$_POST['uploaded_image'];
	
	$image_path = $_SERVER['DOCUMENT_ROOT'].'/spotonmedia/templates/mediatype_images/'; 
	
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
			   'width'=>$width,
			   'height'=>$height,
			   'allow_deals'=>$allow_deals,
			  /* 'max_deals'=>$max_deals, */
			   'allow_deals' => $allow_image,
			   'image_types'=>$image_types,
			   'allow_text_input'=>$allow_text_input,
			   'image' => $file_name,	
			   'status'=>'1',
			   'custom_fields' => $custom_fields		   
			   );
		
		
		$this->load->model('media_type');
		$this->media_type->add_mediatype($data);

		redirect('admin/mediatype');
		exit;
		}
	}
}
?>