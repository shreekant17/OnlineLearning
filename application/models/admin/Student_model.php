<?php
	class Student_model extends CI_Model{

		public function add_student($data){
			$this->db->insert('ci_students', $data);
			return true;
		}

		//---------------------------------------------------
		// get all students for server-side datatable processing (ajax based)
		public function get_all_students(){

			return $this->db->get('ci_students')->result_array();
			
		}


		//---------------------------------------------------
		// Get student detial by ID
		public function get_student_by_id($id){
			$query = $this->db->get_where('ci_students', array('student_id' => $id));
			return $result = $query->row_array();
		}

		//---------------------------------------------------
		// Edit student Record
		public function edit_student($data, $id){
			$this->db->where('student_id', $id);
			$this->db->update('ci_students', $data);
			return true;
		}

		//---------------------------------------------------
		// Change student status
		//-----------------------------------------------------
		function change_status()
		{		
			$this->db->set('is_active', $this->input->post('status'));
			$this->db->where('student_id', $this->input->post('id'));
			$this->db->update('ci_students');
		} 

	}

?>