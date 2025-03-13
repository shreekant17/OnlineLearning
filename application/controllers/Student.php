<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Student extends CI_Controller {
    public function __construct(){

		parent::__construct();
		
		$this->load->model('Authentication_model', 'auth');
		$this->load->model('dashboard_model', 'dashboard');
		$this->load->model('student_model', 'student');
        $this->auth->check_auth();
        if(!$this->session->userdata('student_id')){
            redirect(base_url('dashboard'));
        }
	}

    public function course($id){

        $data['course'] = $this->student->get_course_by_id($id);

		if($this->student->check_course_access($id)){
			$data['course_owned']=true;
		}else{
			$data['course_owned']=false;
		}

        $this->load->view('user/includes/header');
        $this->load->view('student/course/view', $data);
        $this->load->view('user/includes/footer');
    }

    public function datatable_json_module($course_id){	

		$records['data'] = $this->student->get_all_modules_by_course_id($course_id);
		$data = array();

		$i=0;
		foreach ($records['data']   as $row) 
		{  
			
			$data[]= array(
				++$i,
				$row['module_name'],
				$row['firstname'].' '.$row['lastname'],
				$row['course_name'],
				date_time($row['created_at']),	
				'<a title="View" class="view btn btn-xs btn-info" href="'.base_url('student/module/'.$row['module_id']).'"> <i class="fa fa-eye"></i></a>'
				
			);
		}
		$records['data']=$data;
		echo json_encode($records);						   
	}

    public function datatable_json_lesson($module_id){	

		$records['data'] = $this->student->get_all_lessons_by_module_id($module_id);
		$data = array();

		$i=0;
		foreach ($records['data']   as $row) 
		{  
			if($this->student->check_lesson_access($row['lesson_id'])){
				$action = '<a title="View" class="view btn btn-xs btn-info" href="'.base_url('student/lesson/'.$row['lesson_id']).'"> <i class="fa fa-eye"></i></a>';
			}else{
				$action = '<a title="View" class="view btn btn-xs btn-info"> <i class="fa fa-lock"></i></a>';

			}
			
			$data[]= array(
				++$i,
				$row['lesson_name'],
                $row['module_name'],
                $row['course_name'],
                $row['firstname']. ' '. $row['lastname'],
				date_time($row['created_at']),
				$action,		
			);
		}
		$records['data']=$data;
		echo json_encode($records);						   
	}

    public function module($module_id){


        $data['module'] = $this->student->get_module_by_id($module_id);

		if($this->student->check_course_access($data['module']['course_id'])){
			$data['course_owned']=true;
		}else{
			$data['course_owned']=false;
		}

        $this->load->view('user/includes/header');
        $this->load->view('student/module/view', $data);
        $this->load->view('user/includes/footer');
    }

	public function lesson($lesson_id){

		if($this->student->check_lesson_access($lesson_id)){

			$data['lesson'] = $this->student->get_lesson_by_id($lesson_id);
			$data['all_lessons'] = $this->student->get_all_lessons_by_module_id($data['lesson']['module_id']);
			$data['module'] = $this->student->get_module_by_id($data['lesson']['module_id']);

			$this->load->view('user/includes/header');
			$this->load->view('student/lesson/view', $data);
			$this->load->view('user/includes/footer');
		}else{
			redirect(base_url());
		}
		

	}
}