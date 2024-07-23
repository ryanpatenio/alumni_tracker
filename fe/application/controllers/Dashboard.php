<?php 


class Dashboard extends CI_Controller{
    
    public function __construct()
    {
        parent::__construct();
    }


    public function index()
	{

		$data['title'] 		= "Dashboard";
        $data['sidebar']    = '_partials/sidebar';
		$data['content']    = 'admin/Dashboard'; 
        #$data['js_file']    = 'assets/admin-assets/ajax/products.js';

		$this->load->view('_partials/header', $data);
	}
}