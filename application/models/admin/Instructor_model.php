<?php
	class Instructor_model extends CI_Model{

		public function add_instructor($data){
			$this->db->insert('ci_instructors', $data);
			return true;
		}

		//---------------------------------------------------
		// get all instructors for server-side datatable processing (ajax based)
		public function get_all_instructors(){

			return $this->db->get('ci_instructors')->result_array();
			
		}


		//---------------------------------------------------
		// Get instructor detial by ID
		public function get_instructor_by_id($id){
			$query = $this->db->get_where('ci_instructors', array('instructor_id' => $id));
			return $result = $query->row_array();
		}

		//---------------------------------------------------
		// Edit instructor Record
		public function edit_instructor($data, $id){
			$this->db->where('instructor_id', $id);
			$this->db->update('ci_instructors', $data);
			return true;
		}

		//---------------------------------------------------
		// Change instructor status
		//-----------------------------------------------------
		function change_status()
		{		
			$this->db->set('is_active', $this->input->post('status'));
			$this->db->where('instructor_id', $this->input->post('id'));
			$this->db->update('ci_instructors');
		} 

	}

?>