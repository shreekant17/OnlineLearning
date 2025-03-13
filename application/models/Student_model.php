<?php
	class Student_model extends CI_Model{


        public function get_all_courses(){

            $this->db->select("ci_courses.course_name, ci_courses.price, ci_courses.course_id, ci_courses.description, ci_courses.instructor_id, ci_instructors.instructor_id, ci_instructors.firstname, ci_instructors.lastname");
            $this->db->from('ci_courses');
            $this->db->join('ci_instructors', 'ci_instructors.instructor_id=ci_courses.instructor_id', 'left');
            $this->db->order_by('ci_courses.course_id');
            return $this->db->get()->result_array();
        }


        public function get_purchased_courses($student_id){

            $this->db->select("ci_courses.*, payments.*, ci_students.student_id, ci_instructors.instructor_id, ci_instructors.firstname, ci_instructors.lastname");
            $this->db->from('ci_courses');
            $this->db->join('payments', 'payments.course_id=ci_courses.course_id', 'left');
            $this->db->join('ci_students', 'ci_students.student_id=payments.student_id', 'left');
            $this->db->join('ci_instructors', 'ci_courses.instructor_id=ci_instructors.instructor_id', 'left');
            $this->db->where('ci_students.student_id', $student_id);
            $this->db->order_by('ci_courses.course_id');
            return $this->db->get()->result_array();
        }


        public function check_lesson_access($lesson_id){

            $student_id = $this->session->userdata('student_id');

            $this->db->select("ci_courses.course_id, ci_modules.module_id, ci_lessons.lesson_id, payments.course_id, payments.student_id, ci_students.student_id,");
            $this->db->from('ci_courses');
            $this->db->join('payments', 'payments.course_id = ci_courses.course_id', 'left');
            $this->db->join('ci_modules', 'ci_modules.course_id=ci_courses.course_id', 'left');
            $this->db->join('ci_lessons', 'ci_lessons.module_id=ci_modules.module_id', 'left');
            $this->db->join('ci_students', 'ci_students.student_id=payments.student_id', 'left');
            $this->db->where('ci_students.student_id', $student_id);
            $this->db->where('ci_lessons.lesson_id', $lesson_id);
            $this->db->order_by('ci_courses.course_id');
            
            $query= $this->db->get();

            if($query->num_rows()>0){
                return true;
            }else{
                return false;
            }
        }

        
        public function check_course_access($course_id){

            $student_id = $this->session->userdata('student_id');

            $this->db->where('course_id', $course_id);
            $this->db->where('student_id', $student_id);
            $query=$this->db->get('payments');

            if($query->num_rows()>0){
                return true;
            }else{
                return false;
            }
        }

        public function get_student_by_id($id){
            $this->db->where("student_id", $id);
            return $this->db->get('ci_students')->row_array();
            
        }

        public function add_course($data){
            $this->db->insert('ci_courses', $data);
            return true;
        }

        public function edit_course($data, $id){
            $this->db->where("course_id", $id);
            $this->db->update('ci_courses', $data);
            return true;
        }

        public function get_course_by_id($id){
            $this->db->where("course_id", $id);
            return $this->db->get('ci_courses')->row_array();
            
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

        public function add_module($data){
            $this->db->insert("ci_modules", $data);
            return true;
        }

        public function edit_module($data, $id){
            $this->db->where("module_id", $id);
            $this->db->update('ci_modules', $data);
            return true;
        }

        public function get_module_by_id($id){
            $this->db->where("module_id", $id);
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

        public function add_lesson($data){
            $this->db->insert('ci_lessons', $data);
            return true;
        }
        
        public function edit_lesson($data, $id){
            $this->db->where("lesson_id", $id);
            $this->db->update('ci_lessons', $data);
            return true;
        }

        public function get_lesson_by_id($id){
            $this->db->where("lesson_id", $id);
            return $this->db->get('ci_lessons')->row_array();
        }

       
}