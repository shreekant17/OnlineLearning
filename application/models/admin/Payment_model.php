<?php
	class Payment_model extends CI_Model{

		public function get_all_payments(){
            $this->db->select('payments.*, ci_students.*, ci_courses.*');
            $this->db->from('payments');
            $this->db->join('ci_students', 'ci_students.student_id = payments.student_id', 'left');
            $this->db->join('ci_courses', 'ci_courses.course_id = payments.course_id', 'left');
            $this->db->order_by('payments.created_at', 'desc');
			return $this->db->get()->result_array();
			
		}
    }