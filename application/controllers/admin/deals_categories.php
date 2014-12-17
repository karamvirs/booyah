<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Deals_categories extends CI_Controller {	public function __construct() {        parent::__construct();        $this->load->model('categories'); 			    }
	function index() {	
		$data['deals_cat']= $this->categories->all_deals_categories();
		$this->load->view('admin/admin_deals_categories', $data); 
	}		function edit($data) {			$this->form_validation->set_rules('cat_name', 'category Name', 'required');						        if ($this->form_validation->run() == FALSE) {				$cat_data = array('cat_id' => $data);			$result['cat_data']= $this->categories->deals_cat_data($cat_data);		            $this->load->view('admin/admin_edit_deals_category', $result);        } else {			$cat_data = array('cat_id' => $data);				$this->categories->update_deals_category($this->input->post(), $cat_data);				redirect(base_url().'admin/deals_categories');		}	}	function delete($data) {						$this->categories->delete_deals_category($data);				redirect(base_url().'admin/deals_categories');			}	
	
    
	
}