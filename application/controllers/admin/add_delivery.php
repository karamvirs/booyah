<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
	
class Add_delivery extends CI_Controller
{
    
    function index()
    {
		$this->load->view('admin/admin_adddeliveryzone');
    }
    function insert_deliveryzone()
    {
        // echo "<pre>";
		// print_r($_POST);
        
		// die();
        
        $delivery_name         = $_POST['delivery_name'];
		$post_code         	   = $_POST['post_code'];
		$map		           = $_POST['map'];
		$letter_box     	   = $_POST['letter_box'];
		

        
        $data = array(
            'location_name' => $delivery_name,
			'post_code' => $post_code,
			'map' => $map,
			'letter_boxes' => $letter_box,
			'status ' => 1
            );
        
        
        $this->load->model('deliveryzone_model');
        $this->deliveryzone_model->add_deliveryzone($data);
        redirect('admin/deliveryzone');
    }
	
	function edit_deals()
    {
      
        $name                  = $_POST['name'];
        $media_id              = json_encode($_POST['media_id']);
		$categories            = json_encode($_POST['categories']);
		
		$deal_previous[]	   = $_POST['deal_previous'];
		$image_path            = $_SERVER['DOCUMENT_ROOT'].'/spotonmedia/templates/deals_images/';
        $config['upload_path'] = $image_path;
		
        
		$stack = array();
	
        $j = intval(count($_FILES['deal']['name']));
        
        
        for ($x = 0; $x <= $j - 1; $x++) {
             if($_FILES['deal']['name'][$x]) {
            $file_nameee = uniqid() . str_replace(' ', '_', $_FILES['deal']['name'][$x]);
            
            $filenamee1 = $image_path . basename($file_nameee);
            if (move_uploaded_file($_FILES['deal']['tmp_name'][$x], $filenamee1)) {
                $imgArray = array(
                    'image_name' => $file_nameee,
                    'image_type' => $_FILES['deal']['type'][$x],
                    'image_size' => $_FILES['deal']['size'][$x]
                );
            }
            array_push($stack, $file_nameee);
           } 
		   else 
		   {
		   
		   array_push($stack,  $_POST['deal_previous'][$x]);
		   }
        }
		
		

       //$json_images=json_encode($stack);
		
        
         $data = array(
            'name' => $name,
            'media_id' => $media_id,
			'category_id' => $categories,
			/* 'front_image' => $file_name,
            'back_image' => $file_namee,*/
            'deals_images' => json_encode($stack),
			'status'=> 1
        ); 
        
        
        $this->load->model('deals_model');
        $this->deals_model->edit_deals($data);
        redirect('admin/deals');
    }
    
}
?>
