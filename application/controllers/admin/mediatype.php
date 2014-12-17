<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mediatype extends CI_Controller{
	public function __construct() {        parent::__construct();        $this->load->model('media_type');		    }
	function index(){	
	$data['media_data']= $this->media_type->all_mediatype();
	$this->load->view('admin/admin_mediatype', $data); 
	}		function delete($data) {						$this->media_type->delete_mediatype($data);				redirect(base_url().'admin/mediatype');			}
	
}