<?php
	class Profile_model extends CI_Model{


        public function get_instructor_by_id($id){
            $this->db->where('instructor_id', $id);
            return $this->db->get('ci_instructors')->row_array();
        }

        public function get_student_by_id($id){
            $this->db->where('student_id', $id);
            return $this->db->get('ci_students')->row_array();
        }

        public function update_instructor_profile($data, $id){
            $this->db->where('instructor_id', $id);
            $this->db->update('ci_instructors', $data);
        }

        public function update_student_profile($data, $id){
            $this->db->where('student_id', $id);
            $this->db->update('ci_students', $data);
        }
    }