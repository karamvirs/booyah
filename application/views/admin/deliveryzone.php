<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Deliveryzone extends CI_Controller{

	function index(){

	$this->load->model('deliveryzone_model');
	$data['all_deliveryzone']= $this->deliveryzone_model->all_deliveryzone();
	$this->load->view('admin/admin_delivery', $data); 
	
	}
	function edit_deals()
	{
	$deals_id=$_GET['id'];
	
	$this->load->model('media_type');
    $data['all_medtpye'] = $this->media_type->all_mediatype();
	$this->load->model('deals_model');
    $data['all_cats'] = $this->deals_model->all_cats();
	$this->load->model('deals_model');
	$data['edit_deals']= $this->deals_model->edit_deals($deals_id);
	$this->load->view('admin/admin_deals_edit', $data);
	
	
	
	
	}
	
	function view_deals()
	{
	print_R($_GET['id']);
	$this->load->model('deals_model');
	$data['view_deals']= $this->deals_model->view_deals();
	$this->load->view('admin/admin_deals', $data); 
	
	
	}
    
	
}
