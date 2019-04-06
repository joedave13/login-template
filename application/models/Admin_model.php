<?php 
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class Admin_model extends CI_Model {
        public function getWelcomeName()
        {
            return $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        }
        
        public function getAllRole()
        {
            return $this->db->get('user_role')->result_array();
        }

        public function getRoleById($role_id)
        {
            return $this->db->get_where('user_role', ['id' => $role_id])->row_array();
        }
    }
    
    /* End of file Admin_model.php */
    
?>
