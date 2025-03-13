<?php
	class Comment_model extends CI_Model{

        public function add_comment($data){

            if($this->session->userdata('instructor_id')){
                $data['instructor_id']=$this->session->userdata('instructor_id');
            }else{
                $data['student_id']=$this->session->userdata('student_id');
            }
            $this->db->insert('ci_comments', $data);
            return true;
        }

        public function add_reply($data){

            if($this->session->userdata('instructor_id')){
                $data['instructor_id']=$this->session->userdata('instructor_id');
            }else{
                $data['student_id']=$this->session->userdata('student_id');
            }
            $this->db->insert('ci_replies', $data);
            return true;
        }

        public function get_comments_by_lesson_id($lesson_id){

            $this->db->select('
                ci_comments.*,
                IFNULL(ci_students.student_id, ci_instructors.instructor_id) commentator_id,
                IFNULL(ci_students.firstname, ci_instructors.firstname) as firstname,
                IFNULL(ci_students.image, ci_instructors.image) as image,
                IFNULL(ci_students.lastname, ci_instructors.lastname) as lastname
                
            ');

            $this->db->from('ci_comments');

            $this->db->join('ci_students', 'ci_students.student_id=ci_comments.student_id', 'left');

            $this->db->join('ci_instructors', 'ci_instructors.instructor_id=ci_comments.instructor_id', 'left');

            $this->db->where('ci_comments.lesson_id', $lesson_id);

            $this->db->order_by('ci_comments.comment_id');

            $query = $this->db->get();

            if($query->num_rows()>0){
                return  ($query->result_array());
            }else{
                return false;
            }
            
        }


        public function get_replies_by_comment_id($comment_id){

            $this->db->select('
                ci_replies.*,
                IFNULL(ci_students.student_id, ci_instructors.instructor_id) commentator_id,
                IFNULL(ci_students.firstname, ci_instructors.firstname) as firstname,
                IFNULL(ci_students.image, ci_instructors.image) as image,
                IFNULL(ci_students.lastname, ci_instructors.lastname) as lastname
                
            ');

            $this->db->from('ci_replies');

            $this->db->join('ci_students', 'ci_students.student_id=ci_replies.student_id', 'left');

            $this->db->join('ci_instructors', 'ci_instructors.instructor_id=ci_replies.instructor_id', 'left');

            $this->db->where('ci_replies.comment_id', $comment_id);

            $this->db->order_by('ci_replies.reply_id');

            $query = $this->db->get();

            if($query->num_rows()>0){
                return ($query->result_array());
            }else{
                return false;
            }
            
        }
}