<?php defined('BASEPATH') OR exit('No direct script access allowed');



class Payment extends My_Controller {

	public function __construct(){
		parent::__construct();
		auth_check();
		$this->load->model('admin/payment_model', 'payment');
	}

    public function index(){
        $this->load->view('admin/includes/_header');
		$this->load->view('admin/payment/view');
		$this->load->view('admin/includes/_footer');
    }

    public function datatable_json_payments(){	

		$records['data'] = $this->payment->get_all_payments();
		$data = array();

		$i=0;
		foreach ($records['data']   as $row) 
		{  
			
			$data[]= array(
				++$i,
				$row['course_name'],
				$row['price'],
				$row['firstname'].' '.$row['lastname'],
				$row['method'],
				date_time($row['created_at']),	
			);
		}
		$records['data']=$data;
		echo json_encode($records);						   
	}
}