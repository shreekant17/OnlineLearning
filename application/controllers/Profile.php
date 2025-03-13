<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {
    public function __construct(){

		parent::__construct();
		
		$this->load->model('Authentication_model', 'auth');
		$this->load->model('dashboard_model', 'dashboard');
		
		$this->load->model('profile_model', 'profile');
        $this->auth->check_auth();
        
	}

    public function index(){

        if($this->input->post('submit')){

            $this->form_validation->set_rules('firstname', 'Firstname', 'trim|required');
			$this->form_validation->set_rules('lastname', 'Lastname', 'trim|required');

			

            if ($this->form_validation->run() == FALSE) {
				$data = array(
					'errors' => validation_errors()
				);
				$this->session->set_flashdata('errors', $data['errors']);
				
				redirect(base_url('profile'),'refresh');
			}

            $config = array(
				'upload_path' => "./uploads/profiles/",
				'allowed_types' => "gif|jpg|png|jpeg|pdf",
				'overwrite' => TRUE,
				'max_size' => "20480", // Can be set to particular file size , here it is 2 MB(2048 Kb)
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

                    $data= array(
                        'firstname' => $this->input->post('firstname'),
                        'lastname' => $this->input->post('lastname'),
                        'email' => $this->input->post('email'),
                        'mobile_no' => $this->input->post('mobile_no'),
                    );
                    
                    $data['image'] = 'uploads/profiles/'.$file_name;

                    if($this->session->userdata('instructor_id')){
                        $id = $this->session->userdata('instructor_id');
                        $this->profile->update_instructor_profile($data, $id);
                    }else{
                       $id =  $this->session->userdata('student_id');
                       $this->profile->update_student_profile($data, $id);
                    }

                    $this->session->set_userdata('image', $data['image']);
                    $this->session->set_userdata('firstname', $data['firstname']);
                   
                    redirect(base_url('profile'),'refresh');

                    

                }else{
                    $upload_error = $this->upload->display_errors();
                    $this->session->set_flashdata('errors', $upload_error);
				    redirect(base_url('profile'),'refresh');
                   
                    
                }

            }else{

                $data= array(
                        'firstname' => $this->input->post('firstname'),
                        'lastname' => $this->input->post('lastname'),
                        'email' => $this->input->post('email'),
                        'mobile_no' => $this->input->post('mobile_no'),
                    );

               if($this->session->userdata('instructor_id')){
                    $id = $this->session->userdata('instructor_id');
                    $this->profile->update_instructor_profile($data, $id);
                }else{
                    $id =  $this->session->userdata('student_id');
                    $this->profile->update_student_profile($data, $id);
                }
                $this->session->set_userdata('firstname', $data['firstname']);

                redirect(base_url('profile'),'refresh');
                
            }

        }else{
            if($this->session->userdata('instructor_id')){
                $profile_id = $this->session->userdata('instructor_id'); 
                $profile = $this->profile->get_instructor_by_id($profile_id);
            }else{
                $profile_id = $this->session->userdata('student_id');
                $profile = $this->profile->get_student_by_id($profile_id);
            }
            $data['profile']=$profile;
            $this->load->view('user/includes/header');
            $this->load->view('user/profile/profile', $data);
            $this->load->view('user/includes/footer');
        }

    }
}