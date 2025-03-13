<?php
	class Payment_model extends CI_Model{


        public function add($data){
            $this->db->insert('payments', $data);
            return true;
        }
    }
?>