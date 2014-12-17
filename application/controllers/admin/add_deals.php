<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
	
class Add_deals extends CI_Controller
{
    
    function index()
    {
		$this->load->model('media_type');
        $data['all_medtpye'] = $this->media_type->all_mediatype();
		
        $this->load->model('categories');
        $data['all_deals_cats'] = $this->categories->all_deals_categories();
		
        $this->load->view('admin/admin_adddeals', $data);
    }
    function insert_deals()
    {
        /* echo "<pre>";
		print_r($_POST);
        print_r($_FILES);	
		die(); */
        
        $name                  = $_POST['name'];
        $media_id              = json_encode($_POST['media_id']);
		$categories            = json_encode($_POST['categories']);
        $image_path            = $_SERVER['DOCUMENT_ROOT'] . '/spotonmedia/templates/deals_images/';
        $config['upload_path'] = $image_path;
		
        
        /* if($_FILES['front']) {
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
        if($_FILES['back']) {
        $file_namee = uniqid() . str_replace(' ', '_', $_FILES['back']['name']);
        
        $filenamee1 = $image_path . basename($file_namee);
        if (move_uploaded_file($_FILES['back']['tmp_name'], $filenamee1)) {
            $imgArray = array(
                'image_name' => $file_namee,
                'image_type' => $_FILES['back']['type'],
                'image_size' => $_FILES['back']['size']
            );
        }
        } */
		$stack = array();
		 if($_FILES['deal']['name'][0]) {
        $j = intval(count($_FILES['deal']['name']));
        
        
        for ($x = 0; $x <= $j - 1; $x++) {
            
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
		}

        //$json_images=json_encode($stack);
        
        $data = array(
            'name' => $name,
            'media_id' => $media_id,			
			'category_id' => $categories,
            /* 'front_image' => $file_name,
            'back_image' => $file_namee, */
            'deals_images' => json_encode($stack),
			'status'=> 1
        );
        
        
        $this->load->model('deals_model');
        $this->deals_model->add_deals($data);
        redirect('admin/deals');
    }
	
	function edit_deals($artworkid)
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
		$deals_id = array('deals_id' => $artworkid);
        
        
        $this->load->model('deals_model');		
        $this->deals_model->edit_deal($data, $deals_id );
        redirect('admin/deals');
    }
    
}
?>
