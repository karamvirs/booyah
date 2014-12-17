<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
	
class Advertisements extends CI_Controller
{
    
    public function __construct()
    {
        parent::__construct();
		$this->load->model('advertisement_model');
    }
    function index()
    {
      $result['advertisement'] = $this->advertisement_model->fetch_advertisement();
      $this->load->view('admin/alladvertisement',$result);   
    }
    function add_advertisement($id="")
    {

        $result['advertisement_detail'] = $this->advertisement_model->advertisement_detail($id);
        $this->load->view('admin/addadvertisement',$result); 
    }
    function save_advertisements($id="")
    {
        $data=$_POST;
        $id=$this->advertisement_model->add_advertisement($id,$data);   
        redirect(base_url()."admin/advertisements/add_advertisement/".$id) ; 
    }
     function delete_advertisement($id="")
    {
        $this->advertisement_model->delete_advertisement($id);   
        redirect(base_url()."admin/advertisements") ; 
    }
    
    
}
?>
