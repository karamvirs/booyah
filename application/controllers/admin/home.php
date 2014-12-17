<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	
	public function index()
	{
	$is_admin = $this->session->userdata('spoton_admin_id');
	
    if($is_admin){
  
        // $this->load->model('league');
	    // $this->page_data['all_league'] = $this->league->allleagues();
	  
	

		
		/* $data['header_content'] = array(
									'load_view' 		 	 => 'admin_header_view',
									
								);
		$data['main_content']   = array(
									'load_view' 		 	 => 'admin/admin_home',
									'page_data'				 => $this->page_data,
								);
								
								
		$data['footer_content'] = array(
									'load_view' 		 	 => 'admin_footer_view',
								); */
								
		$this->load->view('admin/dashboard'); 
	 }
	else 
	{
	
					
		$this->load->view('admin/admin_login'); 
	
	} 
	
}

}


/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */