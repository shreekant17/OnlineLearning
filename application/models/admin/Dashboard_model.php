<?php
	class Dashboard_model extends CI_Model{

		public function get_all_users(){
			return $this->db->count_all('ci_users');
		}
		public function get_active_users(){
			$this->db->where('is_active', 1);
			return $this->db->count_all_results('ci_users');
		}
		public function get_deactive_users(){
			$this->db->where('is_active', 0);
			return $this->db->count_all_results('ci_users');
		}

		public function get_all_students(){
			return $this->db->count_all('ci_students');
		}


		public function get_all_instructors(){
			return $this->db->count_all('ci_instructors');
		}

		public function get_all_courses(){
			$this->db->where('is_approved', 1);
			return $this->db->count_all_results('ci_courses');
		}

		public function get_monthly_sales(){
			$this->db->select_sum('price');
			$this->db->from('payments');
			$this->db->where('MONTH(created_at)', date('m'));
			$this->db->where('YEAR(created_at)', date('Y'));
			$query = $this->db->get();
			return $query->row()->price;
		}


		public function get_unapproved_courses(){
			$this->db->select('ci_courses.*, ci_instructors.*');
			$this->db->from('ci_courses');
			$this->db->join('ci_instructors','ci_instructors.instructor_id=ci_courses.instructor_id', 'left');
			$this->db->where('ci_courses.is_approved', 0);
			$this->db->order_by('ci_courses.course_id');
			return $this->db->get()->result_array();
		}
		
	}

?>
