<?php defined('BASEPATH') OR exit('No direct script access allowed');



class Course extends My_Controller {



	public function __construct(){
		parent::__construct();
		auth_check();
		$this->load->model('admin/course_model', 'course');
	}

    public function index(){
        $this->load->view('admin/includes/_header');
		$this->load->view('admin/course/view');
		$this->load->view('admin/includes/_footer');
    }

    public function approve($id){
        $this->course->approve_course($id);
        $referrer = $this->agent->referrer();
        // Redirect back to the referrer URL
        redirect($referrer);
    }

    public function reject($id){
        $this->course->reject_course($id);
        $referrer = $this->agent->referrer();
        // Redirect back to the referrer URL
        redirect($referrer);
    }

    public function view($id){

        $data['course'] = $this->course->get_course_by_id($id);
        
        $this->load->view('admin/includes/_header');
		$this->load->view('admin/course/view_course', $data);
		$this->load->view('admin/includes/_footer');

    }

    public function view_module($id){

        $data['module'] = $this->course->get_module_by_id($id);
        
        $this->load->view('admin/includes/_header');
		$this->load->view('admin/course/view_module', $data);
		$this->load->view('admin/includes/_footer');

    }


    public function datatable_json_module($course_id){	

		$records['data'] = $this->course->get_all_modules_by_course_id($course_id);
		$data = array();

		$i=0;
		foreach ($records['data']   as $row) 
		{  
			
            
            
			$data[]= array(
				++$i,
				$row['module_name'],
				$row['course_name'],
				$row['firstname'].' '.$row['lastname'],
				date_time($row['created_at']),	
						

				'<a title="View" class="view btn btn-xs btn-info" href="'.base_url('admin/course/view_module/'.$row['module_id']).'"> <i class="fa fa-eye"></i> View</a>'
				
			);
		}
		$records['data']=$data;
		echo json_encode($records);						   
	}


    public function datatable_json_lesson($module_id){	

		$records['data'] = $this->course->get_all_lessons_by_module_id($module_id);
		$data = array();

		$i=0;
		foreach ($records['data']   as $row) 
		{  
			
            
            
			$data[]= array(
				++$i,
				$row['lesson_name'],
				$row['module_name'],
				$row['course_name'],
				$row['firstname'].' '.$row['lastname'],
				date_time($row['created_at']),	
					
			);
		}
		$records['data']=$data;
		echo json_encode($records);						   
	}

    public function datatable_json_courses(){
		$records['data'] = $this->course->get_courses();
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

				$row['firstname'].' '.$row['lastname'],

				$row['mobile_no'],

				date_time($row['created_at']),	

                $status,
				 
				'<a title="View" class="view btn btn-s btn-info" href="'.base_url('admin/course/view/'.$row['course_id']).'"> View </a>'
				
			);
		}
		$records['data']=$data;
		echo json_encode($records);		
	}


}