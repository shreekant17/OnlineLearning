<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct(){

		parent::__construct();
		
		$this->load->model('admin/student_model', 'student_model');
		$this->load->model('Authentication_model', 'auth');
        
	}

	public function signup()

	{
		
		
		if($this->input->post('submit')){
			$this->form_validation->set_rules('firstname', 'Firstname', 'trim|required');
			$this->form_validation->set_rules('lastname', 'Lastname', 'trim|required');
			if($this->input->post('type')=="instructor"){

				$this->form_validation->set_rules('email', 'Email', 'trim|valid_email|required|is_unique[ci_instructors.email]');

				$this->form_validation->set_rules('mobile_no', 'Number', 'trim|required|is_unique[ci_instructors.mobile_no]');

			}else{

				$this->form_validation->set_rules('mobile_no', 'Number', 'trim|required|is_unique[ci_students.mobile_no]');

				$this->form_validation->set_rules('email', 'Email', 'trim|valid_email|required|is_unique[ci_students.email]');

			}
			
			$this->form_validation->set_rules('password', 'Password', 'trim|required');

			if ($this->form_validation->run() == FALSE) {
				$data = array(
					'errors' => validation_errors()
				);
				$this->session->set_flashdata('errors', $data['errors']);
				
				redirect(base_url('auth/signup'),'refresh');
			}
			else{
				$data = array(
					'firstname' => $this->input->post('firstname'),
					'lastname' => $this->input->post('lastname'),
					'email' => $this->input->post('email'),
					'mobile_no' => $this->input->post('mobile_no'),
					'address' => $this->input->post('address'),
					'password' =>  password_hash($this->input->post('password'), PASSWORD_BCRYPT),
					'is_active' => 1,
					'created_at' => date('Y-m-d : h:m:s'),
					'updated_at' => date('Y-m-d : h:m:s'),
				);
				$data = $this->security->xss_clean($data);
				if($this->input->post('type')=="instructor"){
					$result = $this->auth->signup_instructor($data);
					if($result>0){
						redirect(base_url('auth/verify_otp/'.$result));
					}
				}else{
					$result = $this->auth->signup_student($data);
					if($result>0){
						redirect(base_url('auth/verify/'.$result));
					}
				}
				
			}
		}else{
			$this->load->view('user/includes/header');
			$this->load->view('auth/signup');
			$this->load->view('user/includes/footer');

		}
		
	}

	public function verify_otp($id){
	
		if($this->input->post('submit')){
			$otp = $this->input->post('otp');
			$result = $this->auth->verify_instructor($otp, $id);
			if($result){

				$instructor = $this->auth->get_instructor_by_id($id);

				$this->session->sess_regenerate(TRUE);
				$this->session->set_userdata('instructor_id', $id);
				$this->session->set_userdata('is_logged_in', TRUE);
				$this->session->set_userdata('firstname', $instructor['firstname']);
				$this->session->set_userdata('image', $instructor['image']);
				
				redirect(base_url('dashboard'), 'refresh');
			}else{
				$this->session->set_flashdata('errors', "Wrong OTP");
				
				$this->load->view('user/includes/header');
				$this->load->view('auth/verify_otp', ['id'=>$id]);
				$this->load->view('user/includes/footer');
			}

		}else{

			$createotp = rand(1000,9000);	
			$this->auth->update_otp_instructor(['login_otp'=>$createotp] , $id);
			$msg="Please don't share this OTP with anyone. Online Learning Platform, Your login OTP is ".$createotp.". ";
			$email = $this->auth->get_instructor_by_id($id)['email'];
			$this->functions->mails($email,$msg,'Verify Your Login with OTP - Online Learning Platform');
			$this->load->view('user/includes/header');
			$this->load->view('auth/verify_otp', ['id'=>$id]);
			$this->load->view('user/includes/footer');
		}

	}

	public function verify($id){
		if($this->input->post('submit')){
			$otp = $this->input->post('otp');
			$result = $this->auth->verify_student($otp, $id);

			if($result){
				$student = $this->auth->get_student_by_id($id);
				$this->session->sess_regenerate(TRUE);
				$this->session->set_userdata('student_id', $id);
				$this->session->set_userdata('firstname', $student['firstname']);
				$this->session->set_userdata('image', $student['image']);
				$this->session->set_userdata('is_logged_in', TRUE);
				redirect(base_url('dashboard'), 'refresh');
			}else{
				$this->session->set_flashdata('errors', "Wrong OTP");

				$this->load->view('user/includes/header');
				$this->load->view('auth/verify', ['id'=>$id]);
				$this->load->view('user/includes/footer');
			}

		}
		else{

			$createotp = rand(1000,9000);	
			$this->auth->update_otp_student(['login_otp'=>$createotp] , $id);
			$msg="Please don't share this OTP with anyone. Online learning Platform, Your login OTP is ".$createotp.". ";
			$email = $this->auth->get_student_by_id($id)['email'];
			$this->functions->mails($email,$msg,'Verify Your Login with OTP - Online learning Platform');
	
			$this->load->view('user/includes/header');
			$this->load->view('auth/verify', ['id'=>$id]);
			$this->load->view('user/includes/footer');
		}

	}

	public function login(){

		

		if($this->input->post('submit')){

			$this->form_validation->set_rules('email', 'Email', 'trim|valid_email|required');
			$this->form_validation->set_rules('password', 'Password', 'trim|required');

			if ($this->form_validation->run() == FALSE) {
				$data = array(
					'errors' => validation_errors()
				);
				$this->session->set_flashdata('errors', $data['errors']);
				
				redirect(base_url('auth/login'),'refresh');

			}else{
				$data = array(
					
					'email' => $this->input->post('email'),
					'password' =>($this->input->post('password')),
					
				);
				$data = $this->security->xss_clean($data);
				if($this->input->post('type')=="instructor"){
					$result = $this->auth->verify_password_instructor($data);
					if($result>0){
						redirect(base_url('auth/verify_otp/'.$result));
					}else{
						$this->session->set_flashdata('errors', "Invalid Credentials");
						redirect(base_url('auth/login'),'refresh');
					}
				}else{
					$result = $this->auth->verify_password_student($data);
					if($result>0){
						redirect(base_url('auth/verify/'.$result));
					}else{
						$this->session->set_flashdata('errors', "Invalid Credentials");
						redirect(base_url('auth/login'),'refresh');
					}
				}
				
			}

		}else{
			$this->load->view('user/includes/header');
			$this->load->view('auth/login');
			$this->load->view('user/includes/footer');
		}
	}

	public function forgot_password(){
		if($this->input->post('submit')){

			$this->form_validation->set_rules('email', 'Email', 'trim|valid_email|required');

			if ($this->form_validation->run() == FALSE) {
				$data = array(
					'errors' => validation_errors()
				);
				$this->session->set_flashdata('errors', $data['errors']);
				
				redirect(base_url('auth/forgot_password'),'refresh');

			}else{
				if($this->input->post('type')=="instructor"){
					$email = $this->input->post('email');
					$verify_email = $this->auth->check_email_instuctor($email);
				}else{
					$email = $this->input->post('email');
					$verify_email = $this->auth->check_email_student($email);
					
				}

				if(!$verify_email){
					$this->session->set_flashdata('errors', "Email Doesn't Exists");
					redirect(base_url('auth/forgot_password'),'refresh');
				}else{
					$createotp = rand(1000,9000);	
					if($this->input->post('type')=='instructor'){
						$id = $verify_email['instructor_id'];

						$this->auth->update_otp_instructor(['login_otp'=>$createotp] , $id);
					}else{
						$id = $verify_email['student_id'];
						$this->auth->update_otp_student(['login_otp'=>$createotp] , $id);
					}
				
					$type=$this->input->post('type');



					$msg="Please don't share this OTP with anyone. Online Learning Platform, Your login OTP is ".$createotp.". ";
					
					$this->functions->mails($email, $msg,'Verify Your Authentication with OTP - Online Learning Platform');

					$this->load->view('user/includes/header');
					$this->load->view('auth/verify_reset_password',['email'=>$email, 'type'=>$type, 'id'=>$id]);
					$this->load->view('user/includes/footer');
				}
			}
		}
		else{
			$this->load->view('user/includes/header');
			$this->load->view('auth/forgot_password');
			$this->load->view('user/includes/footer');
		}
	}

	public function verify_reset_password(){

		$id = $this->input->post('id');
		$type = $this->input->post('type');
		$email = $this->input->post('email');
		$otp = $this->input->post('otp');

		if($type=="instructor"){
			if($this->auth->verify_instructor($otp, $id)){
				echo 1;
			}else{
				echo 0;
			}
		}else{
			if($this->auth->verify_student($otp, $id)){
				echo 1;
			}else{
				echo 0;
			}
		}
	}

	public function reset_password(){
		if($this->input->post('password')){
			$id = $this->input->post('id');
			$type = $this->input->post('type');
			$password = password_hash($this->input->post('password'), PASSWORD_BCRYPT);
			if($type=="instructor"){
					$this->auth->set_password_instructor($password, $id);
					redirect(base_url());
				
			}else{
					
				$this->auth->set_password_student($password, $id);
			    redirect(base_url());
			}
				
			
		
		}
		elseif($this->input->post('id') && $this->input->post('type')){
			$id = $this->input->post('id');
			$type = $this->input->post('type');
			$this->load->view('user/includes/header');
			$this->load->view('auth/reset_password', ['id'=> $id, 'type'=>$type]);
			$this->load->view('user/includes/footer');
		}
		else{
			redirect(base_url());
		}
	}

	

	

}
