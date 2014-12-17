<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Deliveryzone extends CI_Controller{
	
	function __construct()
    {
		parent::__construct();
		
		$this->load->model('deliveryzone_model');
	  
	}
	
	function index(){
		
		$data['all_deliveryzone']= $this->deliveryzone_model->all_deliveryzone();
		$this->load->view('admin/admin_delivery', $data); 
	}
	
	function edit_zone($zone_id){
		
		$data['zone']= $this->deliveryzone_model->edit_zone($zone_id);
		$this->load->view('admin/admin_zone_edit', $data);
	}
	
	function update_zone(){
		
		if(isset($_POST['delivery_zone_id']) && !empty($_POST['delivery_zone_id'])){
			$zone_data = array(
			   'delivery_zone_id' 	=> $_POST['delivery_zone_id'],
			   'location_name' 		=> $_POST['location_name'],
			   'post_code' 			=> $_POST['post_code'],
			   'map'			=> $_POST['map'],
			   'letter_boxes' 		=> $_POST['letter_boxes']
			);
			
			
			$data = $this->deliveryzone_model->updat_zone($zone_data);
				if($data){
					$this->session->set_flashdata('success', 'Record successfully updated.');
					redirect('admin/deliveryzone');
				} else {
					$this->session->set_flashdata('failure', 'Error in update.');
					redirect('admin/deliveryzone');
				}
		}
		
	}
	
	function delete_zone($zone_id){
			
			$data = $this->deliveryzone_model->delete_zone($zone_id);
				if($data){
					$this->session->set_flashdata('success', 'Record successfully deleted.');
					redirect('admin/deliveryzone');
				} else {
					$this->session->set_flashdata('failure', 'Error in deletion.');
					redirect('admin/deliveryzone');
				}
		}
		

	
	function view_deals(){
		print_R($_GET['id']);
		$this->load->model('deals_model');
		$data['view_deals']= $this->deals_model->view_deals();
		$this->load->view('admin/admin_deals', $data); 
	}
    
	
}
