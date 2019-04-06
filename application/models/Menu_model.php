<?php 
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class Menu_model extends CI_Model {
        public function getWelcomeName()
        {
            return $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        }

        public function getUserMenu()
        {
            return $this->db->get('user_menu')->result_array();
        }
        
        public function insertMenuData()
        {
            $data = ['menu' => $this->input->post('menu')];
            $this->db->insert('user_menu', $data);
        }

        public function getSubMenu()
        {
            $this->db->select('user_sub_menu.*, user_menu.menu');
            $this->db->from('user_sub_menu');
            $this->db->join('user_menu', 'user_sub_menu.menu_id = user_menu.id');
            return $this->db->get()->result_array();
        }

        public function insertSubMenuData()
        {
            $data = [
                'title' => $this->input->post('title'),
                'menu_id' => $this->input->post('menu_id'), 
                'url' => $this->input->post('url'), 
                'icon' => $this->input->post('icon'),
                'is_active' => $this->input->post('is_active')
            ];
            $this->db->insert('user_sub_menu', $data);
        }
    }
    
    /* End of file Menu_model.php */
    
?>
