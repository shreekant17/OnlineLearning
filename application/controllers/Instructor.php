<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Instructor extends CI_Controller {
    public function __construct(){

		parent::__construct();
		
		$this->load->model('admin/student_model', 'student_model');
		$this->load->model('Authentication_model', 'auth');
		$this->load->model('dashboard_model', 'dashboard');
		$this->load->model('instructor_model', 'instructor');

        $this->auth->check_auth();

        if(!$this->session->userdata('instructor_id')){
            redirect(base_url('dashboard'));
        }
	}

    public function add_course(){
        if($this->input->post('submit')){
			$this->form_validation->set_rules('course_name', 'Course Name', 'trim|required');
			$this->form_validation->set_rules('description', 'Description', 'trim|required');
			$this->form_validation->set_rules('title', 'Title', 'trim|required');
			$this->form_validation->set_rules('price', 'Price', 'trim|required');

			if ($this->form_validation->run() == FALSE) {
				$data = array(
					'errors' => validation_errors()
				);
				$this->session->set_flashdata('errors', $data['errors']);
				redirect(base_url('instructor/add_course'),'refresh');
			}
			else{
				$data = array(
					
					'course_name' => $this->input->post('course_name'),
					'description' => $this->input->post('description'),
					'title' => $this->input->post('title'),
					'price' => $this->input->post('price'),
					'instructor_id' => $this->session->userdata('instructor_id'),
				);
				$data = $this->security->xss_clean($data);
				$result = $this->instructor->add_course($data);
				if($result){

					$this->session->set_flashdata('success', 'Course has been added successfully!');
					redirect(base_url('dashboard'));
				}
			}
		}else{
            $this->load->view('user/includes/header');
            $this->load->view('course/add');
            $this->load->view('user/includes/footer');
        }
    }

    public function edit_course($id){

        if($this->input->post('submit')){
			$this->form_validation->set_rules('course_name', 'Course Name', 'trim|required');
			$this->form_validation->set_rules('description', 'Description', 'trim|required');
			$this->form_validation->set_rules('title', 'Title', 'trim|required');
			$this->form_validation->set_rules('price', 'Price', 'trim|required');

			if ($this->form_validation->run() == FALSE) {
				$data = array(
					'errors' => validation_errors()
				);
				$this->session->set_flashdata('errors', $data['errors']);
				redirect(base_url('instructor/edit_course/'.$id),'refresh');
			}
			else{
				$data = array(
					
					'course_name' => $this->input->post('course_name'),
					'description' => $this->input->post('description'),
					'title' => $this->input->post('title'),
					'price' => $this->input->post('price'),
					'instructor_id' => $this->session->userdata('instructor_id'),
				);

				$data = $this->security->xss_clean($data);
				$result = $this->instructor->edit_course($data, $id);

				if($result){

					$this->session->set_flashdata('success', 'Course has been updated successfully!');
					redirect(base_url('dashboard'));
				}
			}

		}else{

            $data['course'] = $this->instructor->get_course_by_id($id);

            $this->load->view('user/includes/header');
            $this->load->view('course/edit', $data);
            $this->load->view('user/includes/footer');

        }
    }

    public function view_course($id){

        $data['course'] = $this->instructor->get_course_by_id($id);

        $this->load->view('user/includes/header');
        $this->load->view('user/modules_instructor', $data);
        $this->load->view('user/includes/footer');
    }

    public function datatable_json_module($course_id){	

		$records['data'] = $this->instructor->get_all_modules_by_course_id($course_id);
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
						

				'<a title="View" class="view btn btn-xs btn-info" href="'.base_url('instructor/view_module/'.$row['module_id']).'"> <i class="fa fa-eye"></i></a>
				<a title="Edit" class="update btn btn-xs btn-warning" href="'.base_url('instructor/edit_module/'.$row['module_id']).'"> <i class="fa-solid fa-pen-to-square"></i></a>
				<a title="Delete" class="delete btn btn-xs btn-danger" href='.base_url("instructor/delete_module/".$row['module_id']).' title="Delete" onclick="return confirm(\'Do you want to delete ?\')"> <i class="fa-solid fa-trash"></i></a>'
			);
		}
		$records['data']=$data;
		echo json_encode($records);						   
	}

    public function view_module($id){

        $data['module'] = $this->instructor->get_module_by_id($id);

        $this->load->view('user/includes/header');
        $this->load->view('module/view', $data);
        $this->load->view('user/includes/footer');
    }


    public function add_module($course_id){

        if($this->input->post('submit')){

            $this->form_validation->set_rules('module_name', 'Course Name', 'trim|required');
			$this->form_validation->set_rules('description', 'Description', 'trim|required');
			

			if ($this->form_validation->run() == FALSE) {
				$data = array(
					'errors' => validation_errors()
				);
				$this->session->set_flashdata('errors', $data['errors']);
				redirect(base_url('instructor/add_module/', $course_id),'refresh');
			}
			else{
				$data = array(
					
					'module_name' => $this->input->post('module_name'),
					'description' => $this->input->post('description'),
					'course_id' => $this->input->post('course_id'),
				);

				$data = $this->security->xss_clean($data);
				$result = $this->instructor->add_module($data);

				if($result){

					$this->session->set_flashdata('success', 'Module has been added successfully!');
					redirect(base_url('instructor/view_course/'.$course_id));
				}
			}
        }else{
            $this->load->view('user/includes/header');
            $this->load->view('module/add', ['course_id'=>$course_id]);
            $this->load->view('user/includes/footer');
        }
    }


    public function edit_module($module_id){

        if($this->input->post('submit')){

			$this->form_validation->set_rules('module_name', 'Module Name', 'trim|required');
			$this->form_validation->set_rules('description', 'Description', 'trim|required');
			

			if ($this->form_validation->run() == FALSE) {
				$data = array(
					'errors' => validation_errors()
				);
				$this->session->set_flashdata('errors', $data['errors']);
				redirect(base_url('instructor/edit_module/'.$module_id),'refresh');
			}
			else{
				$data = array(
					
					'module_name' => $this->input->post('module_name'),
					'description' => $this->input->post('description'),
                    

				);

				$data = $this->security->xss_clean($data);
				$result = $this->instructor->edit_module($data, $module_id);

				if($result){

					$this->session->set_flashdata('success', 'Module has been updated successfully!');
					redirect(base_url('instructor/view_course/'.$this->input->post('course_id')));
				}
			}

		}else{

            $data['module'] = $this->instructor->get_module_by_id($module_id);

            $this->load->view('user/includes/header');
            $this->load->view('module/edit', $data);
            $this->load->view('user/includes/footer');

        }

    }

    public function add_lesson($module_id) {
        if ($this->input->post('submit')) {

            $this->form_validation->set_rules('lesson_name', 'Lesson Name', 'trim|required');
            $this->form_validation->set_rules('description', 'Description', 'trim|required');

            // Configuration for video upload
            $video_config = array(
                'upload_path' => "./uploads/videos/", // Set the path to the directory where you want to save the videos
                'allowed_types' => "mp4|avi|mov|wmv|flv|mkv|webm", // Specify the allowed video file types
                'overwrite' => TRUE, // Allow overwriting existing files
                'max_size' => "204800000", // Set the maximum file size to 200 MB (204800 KB)
                'encrypt_name' => TRUE // Optional: encrypt the file name for security
            );

            // Configuration for thumbnail image upload
            $image_config = array(
                'upload_path' => "./uploads/images/", // Set the path to the directory where you want to save the images
                'allowed_types' => "jpg|jpeg|png|gif", // Specify the allowed image file types
                'overwrite' => TRUE, // Allow overwriting existing files
                'max_size' => "2048000", // Set the maximum file size to 2 MB (2048 KB)
                'encrypt_name' => TRUE // Optional: encrypt the file name for security
            );

            $this->load->library('upload');

            // Handle video upload
            $video_uploaded = false;
            if (isset($_FILES['userfile']['name']) && $_FILES['userfile']['name'] != '') {
                $this->upload->initialize($video_config);
                if ($this->upload->do_upload('userfile')) {
                    $video_uploaded = true;
                    $upload_data = $this->upload->data();
                    $video_file_name = $upload_data['file_name'];
                } else {
                    $upload_error = $this->upload->display_errors();
                    echo $upload_error;
                    return;
                }
            }

            // Handle thumbnail image upload
            $image_uploaded = false;
            if (isset($_FILES['thumbnail']['name']) && $_FILES['thumbnail']['name'] != '') {
                $this->upload->initialize($image_config);
                if ($this->upload->do_upload('thumbnail')) {
                    $image_uploaded = true;
                    $upload_data = $this->upload->data();
                    $image_file_name = $upload_data['file_name'];
                } else {
                    $upload_error = $this->upload->display_errors();
                    echo $upload_error;
                    return;
                }
            }

            // Prepare data for database insertion
            $data = array(
                'lesson_name' => $this->input->post('lesson_name'),
                'description' => $this->input->post('description'),
                'module_id' => $module_id,
            );

            if ($video_uploaded) {
                $data['video_src'] = 'uploads/videos/' . $video_file_name;
            }

            if ($image_uploaded) {
                $data['video_thumbnail'] = 'uploads/images/' . $image_file_name;
            }

            $result = $this->instructor->add_lesson($data);

            if ($result > 0) {
                $this->session->set_flashdata('success', 'Lesson has been added successfully!');
                redirect(base_url('instructor/view_module/' . $module_id), 'refresh');
            }

        } else {
            $this->load->view('user/includes/header');
            $this->load->view('lesson/add', ['module_id' => $module_id]);
            $this->load->view('user/includes/footer');
        }
    }

    public function edit_lesson($lesson_id) {
        if ($this->input->post('submit')) {

            $this->form_validation->set_rules('lesson_name', 'Lesson Name', 'trim|required');
            $this->form_validation->set_rules('description', 'Description', 'trim|required');

            // Configuration for video upload
            $video_config = array(
                'upload_path' => "./uploads/videos/", // Set the path to the directory where you want to save the videos
                'allowed_types' => "mp4|avi|mov|wmv|flv|mkv|webm", // Specify the allowed video file types
                'overwrite' => TRUE, // Allow overwriting existing files
                'max_size' => "204800000", // Set the maximum file size to 200 MB (204800 KB)
                'encrypt_name' => TRUE // Optional: encrypt the file name for security
            );

            // Configuration for thumbnail image upload
            $image_config = array(
                'upload_path' => "./uploads/images/", // Set the path to the directory where you want to save the images
                'allowed_types' => "jpg|jpeg|png|gif", // Specify the allowed image file types
                'overwrite' => TRUE, // Allow overwriting existing files
                'max_size' => "20480000", // Set the maximum file size to 2 MB (2048 KB)
                'encrypt_name' => TRUE // Optional: encrypt the file name for security
            );

            $this->load->library('upload');

            // Handle video upload
            $video_uploaded = false;
            if (isset($_FILES['userfile']['name']) && $_FILES['userfile']['name'] != '') {
                $this->upload->initialize($video_config);
                if ($this->upload->do_upload('userfile')) {
                    $video_uploaded = true;
                    $upload_data = $this->upload->data();
                    $video_file_name = $upload_data['file_name'];
                } else {
                    $upload_error = $this->upload->display_errors();
                    echo $upload_error;
                    return;
                }
            }

            // Handle thumbnail image upload
            $image_uploaded = false;
            if (isset($_FILES['thumbnail']['name']) && $_FILES['thumbnail']['name'] != '') {
                $this->upload->initialize($image_config);
                if ($this->upload->do_upload('thumbnail')) {
                    $image_uploaded = true;
                    $upload_data = $this->upload->data();
                    $image_file_name = $upload_data['file_name'];
                } else {
                    $upload_error = $this->upload->display_errors();
                    echo $upload_error;
                    return;
                }
            }

            // Prepare data for database update
            $data = array(
                'lesson_name' => $this->input->post('lesson_name'),
                'description' => $this->input->post('description'),
            );

            if ($video_uploaded) {
                $data['video_src'] = 'uploads/videos/' . $video_file_name;
            }

            if ($image_uploaded) {
                $data['video_thumbnail'] = 'uploads/images/' . $image_file_name;
            }

            $result = $this->instructor->edit_lesson($data, $lesson_id);

            if ($result > 0) {
                $this->session->set_flashdata('success', 'Lesson has been updated successfully!');
                $module_id = $this->instructor->get_lesson_by_id($lesson_id)['module_id'];
                redirect(base_url('instructor/view_module/' . $module_id), 'refresh');
            }

        } else {
            $data['lesson'] = $this->instructor->get_lesson_by_id($lesson_id);
            $this->load->view('user/includes/header');
            $this->load->view('lesson/edit', $data);
            $this->load->view('user/includes/footer');
        }
    }


    
    /*
    public function edit_lesson($lesson_id){
        if($this->input->post('submit')){

            $this->form_validation->set_rules('lesson_name', 'Lesson Name', 'trim|required');
			$this->form_validation->set_rules('description', 'Description', 'trim|required');

            $config = array(
                'upload_path' => "./uploads/videos/", // Set the path to the directory where you want to save the videos
                'allowed_types' => "mp4|avi|mov|wmv|flv|mkv", // Specify the allowed video file types
                'overwrite' => TRUE, // Allow overwriting existing files
                'max_size' => "204800", // Set the maximum file size to 200 MB (204800 KB)
                'encrypt_name' => TRUE // Optional: encrypt the file name for security
            );

			$this->load->library('upload', $config);

            if (isset($_FILES['userfile']['name']) && $_FILES['userfile']['name'] != '') {
                // Generate a new file name
                $pathinfo = pathinfo($_FILES['userfile']['name']);
                $new_file_name = $pathinfo['filename'] . '_' . time() . '.' . $pathinfo['extension'];
                $config['file_name'] = $new_file_name;

                // Initialize upload library with new configuration
                $this->upload->initialize($config);

                if($this->upload->do_upload('userfile')) {

                    $upload_data = $this->upload->data();
                    $file_name = $upload_data['file_name'];
                    $data = array(
                        'lesson_name' => $this->input->post('lesson_name'),
                        'description' => $this->input->post('description'),
                    );

                    $data['video_src'] = 'uploads/videos/'.$file_name;

                    
                    $result = $this->instructor->edit_lesson($data, $lesson_id);
                    
                    
                    if($result>0){
                        $this->session->set_flashdata('success', 'Lesson has been updated successfully!');
                        $module_id = $this->instructor->get_lesson_by_id($lesson_id)['module_id'];
                        redirect(base_url('instructor/view_module/'.$module_id),'refresh');
                    }

                }else{
                    $upload_error = $this->upload->display_errors();
                    echo $upload_error;
                }
            }else{
                $data = array(
					'lesson_name' => $this->input->post('lesson_name'),
					'description' => $this->input->post('description'),
				);
                $result = $this->instructor->edit_lesson($data, $lesson_id);
                    
                    
                if($result>0){
                    $this->session->set_flashdata('success', 'Lesson has been updated successfully!');
                    $module_id = $this->instructor->get_lesson_by_id($lesson_id)['module_id'];
                    redirect(base_url('instructor/view_module/'.$module_id),'refresh');
                }
            }
        }else{
            $data['lesson'] = $this->instructor->get_lesson_by_id($lesson_id);
            $this->load->view('user/includes/header');
            $this->load->view('lesson/edit',$data);
            $this->load->view('user/includes/footer');
        }
    }
        */


    public function datatable_json_lesson($module_id){	

		$records['data'] = $this->instructor->get_all_lessons_by_module_id($module_id);
		$data = array();

		$i=0;
		foreach ($records['data']   as $row) 
		{  
			
            
            
			$data[]= array(
				++$i,
				$row['lesson_name'],
                $row['module_name'],
                $row['course_name'],
                $row['firstname']. ' '. $row['lastname'],
				date_time($row['created_at']),	
                
				

				'<a title="View" class="view btn btn-xs btn-info" href="'.base_url('instructor/view_lesson/'.$row['lesson_id']).'"> <i class="fa fa-eye"></i></a>
				<a title="Edit" class="update btn btn-xs btn-warning" href="'.base_url('instructor/edit_lesson/'.$row['lesson_id']).'"> <i class="fa-solid fa-pen-to-square"></i></a>
				<a title="Delete" class="delete btn btn-xs btn-danger" href='.base_url("instructor/delete_lesson/".$row['lesson_id']).' title="Delete" onclick="return confirm(\'Do you want to delete ?\')"> <i class="fa-solid fa-trash"></i></a>'
			);
		}
		$records['data']=$data;
		echo json_encode($records);						   
	}

    public function view_lesson($id){

        $data['lesson'] = $this->instructor->get_lesson_by_id($id);
        
		$data['all_lessons'] = $this->instructor->get_all_lessons_by_module_id($data['lesson']['module_id']);
	
        $data['module'] = $this->instructor->get_module_by_id($data['lesson']['module_id']);

         $data['course'] = $this->instructor->get_course_by_id($data['module']['course_id']);

        $this->load->view('user/includes/header');
        $this->load->view('lesson/view', $data);
        $this->load->view('user/includes/footer');
    }


    public function delete_course($course_id){
        $this->instructor->delete_course($course_id);

        $modules = $this->instructor->get_all_modules_by_course_id($course_id);

        foreach($modules as $module){
            $this->instructor->delete_module($module_id);
            $this->instructor->delete_lesson_by_module_id($module_id);
        }
        $referrer = $this->agent->referrer();
        // Redirect back to the referrer URL
        redirect($referrer);

    }

    public function delete_module($module_id){
        $this->instructor->delete_module($module_id);
        $this->session->set_flashdata('success', 'Module has been deleted successfully!');
        $referrer = $this->agent->referrer();
        // Redirect back to the referrer URL
        redirect($referrer);
		
    }

    public function delete_lesson($lesson_id){
        $this->instructor->delete_lesson($lesson_id);
        $this->session->set_flashdata('success', 'Lesson has been deleted successfully!');
		$referrer = $this->agent->referrer();
        // Redirect back to the referrer URL
        redirect($referrer);
    }


}