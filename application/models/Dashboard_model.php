<?php
	class Dashboard_model extends CI_Model{

        public function get_all_courses_by_instructor_id($id){
            $this->db->where('instructor_id',$id);
            return $this->db->get('ci_courses')->result_array();
        }

        public function get_all_courses(){

            $this->db->select("ci_courses.course_name, ci_courses.price, ci_courses.course_id, ci_courses.description, ci_courses.instructor_id, ci_instructors.instructor_id, ci_instructors.firstname, ci_instructors.lastname");
            $this->db->from('ci_courses');
            $this->db->join('ci_instructors', 'ci_instructors.instructor_id=ci_courses.instructor_id', 'left');
            $this->db->order_by('ci_courses.course_id');
            return $this->db->get()->result_array();
        }
        
        public function get_course_by_id($id){

            $this->db->select("ci_courses.course_name, ci_courses.price, ci_courses.course_id, ci_courses.description, ci_courses.instructor_id, ci_instructors.instructor_id, ci_instructors.firstname, ci_instructors.lastname");
            $this->db->from('ci_courses');
            $this->db->join('ci_instructors', 'ci_instructors.instructor_id=ci_courses.instructor_id', 'left');
            $this->db->where('ci_courses.course_id', $id);
            $this->db->order_by('ci_courses.course_id');
            return $this->db->get()->row_array();
        }
}