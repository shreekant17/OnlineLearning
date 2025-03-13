<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Test extends MY_Controller {

	public function __construct(){

		parent::__construct();
		auth_check(); // check login auth
		$this->rbac->check_module_access();
		
		$this->load->model('admin/test_model', 'test');
	}

	//-----------------------------------------------------------
	public function index()
	{
		$this->load->view('admin/includes/_header');
		$this->load->view('admin/test/test');
		$this->load->view('admin/includes/_footer');
	}
}
