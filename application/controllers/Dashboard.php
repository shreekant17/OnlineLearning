<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct(){

		parent::__construct();
		
		
		$this->load->model('Authentication_model', 'auth');
		$this->load->model('dashboard_model', 'dashboard');
		$this->load->model('student_model', 'student');

        $this->auth->check_auth();
	
		
        
	}

    public function index(){
        if($this->session->userdata('instructor_id')){

			
			
            $this->load->view('user/includes/header');
            $this->load->view('user/dashboard_instructor');
            $this->load->view('user/includes/footer');
        }else{

			$data['all_courses'] = $this->student->get_all_courses();
			
			$data['purchased_courses'] = $this->student->get_purchased_courses($this->session->userdata('student_id'));

            $this->load->view('user/includes/header');
            $this->load->view('user/dashboard_student', $data);
            $this->load->view('user/includes/footer');
        }
     
    }


    public function datatable_json(){				   					   
		$records['data'] = $this->dashboard->get_all_courses_by_instructor_id($this->session->userdata('instructor_id'));
		$data = array();

		$i=0;
		foreach ($records['data']   as $row) 
		{  
			if($row['is_approved']=="1"){
            $status="<span class='btn btn-success'>Approved</span>";
            }elseif($row['is_approved']=="2"){
            $status=" <span class='btn btn-danger'>Rejected</span> ";
            }else{
            $status=" <span class='btn btn-warning'>Pending</span> ";
            }
            
			$data[]= array(
				++$i,
				$row['course_name'],
				date_time($row['created_at']),	
				  

				$status,		

				'<a title="View" class="view btn btn-xs btn-info" href="'.base_url('instructor/view_course/'.$row['course_id']).'"> <i class="fa fa-eye"></i></a>
				<a title="Edit" class="update btn btn-xs btn-warning" href="'.base_url('instructor/edit_course/'.$row['course_id']).'"> <i class="fa-solid fa-pen-to-square"></i></a>
				<a title="Delete" class="delete btn btn-xs btn-danger" href='.base_url("instructor/delete_course/".$row['course_id']).' title="Delete" onclick="return confirm(\'Do you want to delete ?\')"> <i class="fa-solid fa-trash"></i></a>'
			);
		}
		$records['data']=$data;
		echo json_encode($records);						   
	}

    
}