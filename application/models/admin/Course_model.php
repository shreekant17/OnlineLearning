<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Course_model extends CI_Model{

    public function approve_course($course_id){
        $this->db->where('course_id', $course_id);
        $this->db->update('ci_courses', ['is_approved'=>1]);
    }

    public function reject_course($course_id){
        $this->db->where('course_id', $course_id);
        $this->db->update('ci_courses', ['is_approved'=>2]);
    }

    public function get_all_modules_by_course_id($course_id){
        $this->db->select('ci_courses.*, ci_instructors.*, ci_modules.*');
        $this->db->from('ci_courses');
        $this->db->join('ci_instructors', 'ci_courses.instructor_id=ci_instructors.instructor_id', 'left');
        $this->db->join('ci_modules', 'ci_courses.course_id=ci_modules.course_id', 'left');
        $this->db->where("ci_courses.course_id", $course_id);
        $this->db->order_by("ci_courses.course_id");
        return $this->db->get()->result_array();
    }

    public function get_course_by_id($id){
        $this->db->where('course_id', $id);
        return $this->db->get('ci_courses')->row_array();
    }

    public function get_module_by_id($id){
        $this->db->where('module_id', $id);
        return $this->db->get('ci_modules')->row_array();
    }

    public function get_all_lessons_by_module_id($module_id){
        $this->db->select('ci_instructors.*, ci_courses.*, ci_modules.*, ci_lessons.*');
        $this->db->from('ci_lessons');
        $this->db->join('ci_modules', 'ci_modules.module_id=ci_lessons.module_id', 'left');
        $this->db->join('ci_courses', 'ci_courses.course_id=ci_modules.course_id', 'left');
        $this->db->join('ci_instructors', 'ci_courses.instructor_id=ci_instructors.instructor_id', 'left');
        $this->db->where("ci_lessons.module_id", $module_id);
        return $this->db->get()->result_array();
    }

    public function get_courses(){
        $this->db->select('ci_courses.*, ci_instructors.*');
        $this->db->from('ci_courses');
        $this->db->join('ci_instructors','ci_instructors.instructor_id=ci_courses.instructor_id', 'left');
        $this->db->order_by('ci_courses.course_id');
        return $this->db->get()->result_array();
    }

}