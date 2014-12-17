<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Begin extends CI_Controller {

	
	public function index()
	{
		$this->load->model('media_type');
		$data['allmedia_data']= $this->media_type->all_mediatype();		
		$this->load->view('begin',$data);
	}
}
?>