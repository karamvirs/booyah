<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Custom_image extends CI_Controller {



	

	public function index()

	{
	print_r($_POST);
	print_r($_FILES);
	die();

		$image_path = $_SERVER['DOCUMENT_ROOT'].'/spotonmedia/templates/custom_upload/'; 
		$config['upload_path'] = $image_path; 
		$file_name = uniqid() . str_replace(' ', '_', $_FILES['uploaded_image']['name']);
		$filename1 = $image_path . basename($file_name);

        if (move_uploaded_file($_FILES['uploaded_image']['tmp_name'], $filename1)) {

            $imgArray = array(

							'image_name' => $file_name,

							'image_type' => $_FILES['uploaded_image']['type'],

							'image_size' => $_FILES['uploaded_image']['size']

							);

							}
							
							

		die($file_name);

		

	



}

}

?>