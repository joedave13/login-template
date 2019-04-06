<?php 
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class Admin extends CI_Controller {
        public function __construct()
        {
            parent::__construct();
            //Do your magic here
            is_logged_in();
            $this->load->model('Admin_model');
            $this->load->model('Menu_model');
        }
        
    
        public function index()
        {
            $data['title'] = 'Dashboard';
            $data['user'] = $this->Admin_model->getWelcomeName();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/index', $data);
            $this->load->view('templates/footer');
        }

        public function role()
        {
            $data['title'] = 'Role';
            $data['user'] = $this->Admin_model->getWelcomeName();
            $data['role'] = $this->Admin_model->getAllRole();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/role', $data);
            $this->load->view('templates/footer');
        }

        public function roleAccess($role_id)
        {
            $data['title'] = 'Role Access';
            $data['user'] = $this->Admin_model->getWelcomeName();
            
            $data['role'] = $this->Admin_model->getRoleById($role_id);

            $this->db->where('id != ', 1);
            $data['menu'] = $this->Menu_model->getUserMenu();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/roleaccess', $data);
            $this->load->view('templates/footer');
        }

        public function changeAccess()
        {
            $menu_id = $this->input->post('menuId');
            $role_id = $this->input->post('roleId');

            $data = [
                'role_id' => $role_id,
                'menu_id' => $menu_id
            ];

            $result = $this->db->get_where('user_access_menu', $data);

            if ($result->num_rows() < 1) {
                $this->db->insert('user_access_menu', $data);
            }
            else {
                $this->db->delete('user_access_menu', $data); 
            }
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Access Changed!</div>');
        }
    }
    
    /* End of Admin.php */
    
?>
