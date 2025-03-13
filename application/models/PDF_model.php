<?php
	class PDF_model extends CI_Model{


        public function add($data){
            $this->db->insert('ci_pdfs', $data);
            return true;
        }

        public function get_all_pdf_by_lesson_id($lesson_id){
            $this->db->where('lesson_id', $lesson_id);
            return $this->db->get('ci_pdfs')->result_array();
           
        }
    }
?>