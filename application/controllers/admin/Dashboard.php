<?php defined('BASEPATH') OR exit('No direct script access allowed');



class Dashboard extends My_Controller {



	public function __construct(){

		parent::__construct();

		auth_check(); // check login auth


		$this->load->model('admin/dashboard_model', 'dashboard_model');

	}

	//--------------------------------------------------------------------------

	public function index(){

		$data['title'] = 'Dashboard';

		$this->load->view('admin/includes/_header', $data);

		
    		redirect(base_url('admin/dashboard/index_1'));
	
		

    	$this->load->view('admin/includes/_footer');

	}

	//--------------------------------------------------------------------------

	public function index_1(){

		$data['all_users'] = $this->dashboard_model->get_all_users();

		$data['active_users'] = $this->dashboard_model->get_active_users();

		$data['deactive_users'] = $this->dashboard_model->get_deactive_users();



		$data['all_students'] = $this->dashboard_model->get_all_students();

		$data['all_instructors'] = $this->dashboard_model->get_all_instructors();

		$data['all_courses'] = $this->dashboard_model->get_all_courses();

		$data['monthly_sales'] = $this->dashboard_model->get_monthly_sales();


		$data['title'] = 'Dashboard';

		$this->load->view('admin/includes/_header', $data);

    	$this->load->view('admin/dashboard/index', $data);

    	$this->load->view('admin/includes/_footer');

	}



	//--------------------------------------------------------------------------

	public function index_2(){

		$data['title'] = 'Dashboard';


		$this->load->view('admin/includes/_header');

    	$this->load->view('admin/dashboard/index2');

    	$this->load->view('admin/includes/_footer');

	}



	//--------------------------------------------------------------------------

	public function index_3(){

		$data['title'] = 'Dashboard';

		$this->load->view('admin/includes/_header');

    	$this->load->view('admin/dashboard/index3');

    	$this->load->view('admin/includes/_footer');

	}

	public function datatable_json_unapproved_courses(){
		$records['data'] = $this->dashboard_model->get_unapproved_courses();
		$data = array();

		$i=0;
		foreach ($records['data']   as $row) 
		{  
			
			$data[]= array(
				++$i,

				$row['course_name'],

				$row['firstname'].' '.$row['lastname'],

				$row['mobile_no'],

				date_time($row['created_at']),	
				 
				'<a title="View" class="view btn btn-s btn-info" href="'.base_url('admin/course/view/'.$row['course_id']).'"> View </a>
				 <a title="Approve" class="view btn btn-s btn-success" href="'.base_url('admin/course/approve/'.$row['course_id']).'"> Approve </a>
				<a title="Reject" class="update btn btn-s btn-danger" href="'.base_url('admin/course/reject/'.$row['course_id']).'"> Reject </a>'
				
			);
		}
		$records['data']=$data;
		echo json_encode($records);		
	}




}
?>	