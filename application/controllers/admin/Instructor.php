<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Instructor extends MY_Controller {

	public function __construct(){

		parent::__construct();
		auth_check(); // check login auth
		$this->rbac->check_module_access();

		$this->load->model('admin/admin_model', 'admin');
		$this->load->model('admin/instructor_model', 'instructor_model');
		$this->load->model('admin/activity_model', 'activity_model');
        
	}

	//-----------------------------------------------------------
	public function index(){
		$this->load->view('admin/includes/_header');
		$this->load->view('admin/instructors/instructor_list');
		$this->load->view('admin/includes/_footer');
	}
	
	public function datatable_json(){				   					   
		$records['data'] = $this->instructor_model->get_all_instructors();
		$data = array();

		$i=0;
		foreach ($records['data']   as $row) 
		{  
			$status = ($row['is_active'] == 1)? 'checked': '';
			$data[]= array(
				++$i,
				$row['firstname'].' '.$row['lastname'],
				$row['email'],
				$row['mobile_no'],
				date_time($row['created_at']),	
				'<input class="tgl_checkbox tgl-ios" 
				data-id="'.$row['instructor_id'].'" 
				id="cb_'.$row['instructor_id'].'"
				type="checkbox"  

				'.$status.'><label for="cb_'.$row['instructor_id'].'"></label>',		

				'<a title="View" class="view btn btn-xs btn-info" href="'.base_url('admin/instructor/edit/'.$row['instructor_id']).'"> <i class="fa fa-eye"></i></a>
				<a title="Edit" class="update btn btn-xs btn-warning" href="'.base_url('admin/instructor/edit/'.$row['instructor_id']).'"> <i class="fa fa-pencil-square-o"></i></a>
				<a title="Delete" class="delete btn btn-xs btn-danger" href='.base_url("admin/instructor/delete/".$row['instructor_id']).' title="Delete" onclick="return confirm(\'Do you want to delete ?\')"> <i class="fa fa-trash-o"></i></a>'
			);
		}
		$records['data']=$data;
		echo json_encode($records);						   
	}

	//-----------------------------------------------------------
	function change_status()
	{   
		$this->instructor_model->change_status();
	}

	public function add(){
		
		$this->rbac->check_operation_access(); // check opration permission

		$data['admin_roles'] = $this->admin->get_admin_roles();


		if($this->input->post('submit')){
		
			$this->form_validation->set_rules('firstname', 'Firstname', 'trim|required');
			$this->form_validation->set_rules('lastname', 'Lastname', 'trim|required');
			$this->form_validation->set_rules('email', 'Email', 'trim|valid_email|required');
			$this->form_validation->set_rules('mobile_no', 'Number', 'trim|required');
			$this->form_validation->set_rules('password', 'Password', 'trim|required');
			


			if ($this->form_validation->run() == FALSE) {
				$data = array(
					'errors' => validation_errors()
				);
				$this->session->set_flashdata('errors', $data['errors']);
				redirect(base_url('admin/instructor/add'),'refresh');
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
				$result = $this->instructor_model->add_instructor($data);
				if($result){

					// Activity Log 
					$this->activity_model->add_log(1);

					$this->session->set_flashdata('success', 'instructor has been added successfully!');
					redirect(base_url('admin/instructor'));
				}
			}
		}
		else{
			$this->load->view('admin/includes/_header');
			$this->load->view('admin/instructors/instructor_add', $data);
			$this->load->view('admin/includes/_footer');
		}
		
	}

	public function edit($id = 0){

		$data['admin_roles'] = $this->admin->get_admin_roles();

		$this->rbac->check_operation_access(); // check opration permission

		if($this->input->post('submit')){
		
			$this->form_validation->set_rules('firstname', 'Firstname', 'trim|required');
			$this->form_validation->set_rules('lastname', 'Lastname', 'trim|required');
			$this->form_validation->set_rules('email', 'Email', 'trim|valid_email|required');
			$this->form_validation->set_rules('mobile_no', 'Number', 'trim|required');
			
			if ($this->form_validation->run() == FALSE) {
					$data = array(
						'errors' => validation_errors()
					);
					$this->session->set_flashdata('errors', $data['errors']);
					redirect(base_url('admin/instructor/instructor_edit/'.$id),'refresh');
			}
			else{
				$data = array(
					
					'firstname' => $this->input->post('firstname'),
					'lastname' => $this->input->post('lastname'),
					'email' => $this->input->post('email'),
					'mobile_no' => $this->input->post('mobile_no'),
					
				);
				$data = $this->security->xss_clean($data);
				$result = $this->instructor_model->edit_instructor($data, $id);
				if($result){
					// Activity Log 
					$this->activity_model->add_log(2);

					$this->session->set_flashdata('success', 'instructor has been updated successfully!');
					redirect(base_url('admin/instructor'));
				}
			}
		}
		else{
			$data['instructor'] = $this->instructor_model->get_instructor_by_id($id);
			
			$this->load->view('admin/includes/_header');
			$this->load->view('admin/instructors/instructor_edit', $data);
			$this->load->view('admin/includes/_footer');
		}
	}

	public function delete($id = 0)
	{
		$this->rbac->check_operation_access(); // check opration permission
		
		$this->db->delete('ci_instructors', array('instructor_id' => $id));

		// Activity Log 
		$this->activity_model->add_log(3);

		$this->session->set_flashdata('success', 'Use has been deleted successfully!');
		redirect(base_url('admin/instructors'));
	}

}


?>