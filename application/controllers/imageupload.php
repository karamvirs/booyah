<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Imageupload extends CI_Controller {

	
	public function index()
	{
	
		$upload_dir =$_SERVER['DOCUMENT_ROOT'].'/spotonmedia/templates/mediatype_images/'; 
		$img = $_POST['imgBase64'];
		$img = str_replace('data:image/png;base64,', '', $img);
		$img = str_replace(' ', '+', $img);
		$data = base64_decode($img);
		$imgname=uniqid()."front_image.png";
		$file = $upload_dir.$imgname;
		$success = file_put_contents($file, $data);
		die($imgname);
		
	

}
}
?>
