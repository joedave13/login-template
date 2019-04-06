<?php 
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class Menu extends CI_Controller {
        public function __construct()
        {
            parent::__construct();
            //Do your magic here
            is_logged_in();
            $this->load->model('Menu_model');
        }
        
    
        public function index()
        {
            $data['title'] = 'Menu Management';
            $data['user'] = $this->Menu_model->getWelcomeName();
            $data['menu'] = $this->Menu_model->getUserMenu();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/index', $data);
            $this->load->view('templates/footer');
        }

        public function addMenu()
        {
            $this->form_validation->set_rules('menu', 'Menu', 'required');
            
            if ($this->form_validation->run() == FALSE) {
                $data['title'] = 'Menu Management';
                $data['user'] = $this->Menu_model->getWelcomeName();
                $data['menu'] = $this->Menu_model->getUserMenu();

                $this->load->view('templates/header', $data);
                $this->load->view('templates/sidebar', $data);
                $this->load->view('templates/topbar', $data);
                $this->load->view('menu/index', $data);
                $this->load->view('templates/footer');
            } else {
                $this->Menu_model->insertMenuData();
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                New Menu Added.</div>');
                redirect('menu');
            }
        }

        public function subMenu()
        {
            $data['title'] = 'Submenu Management';
            $data['user'] = $this->Menu_model->getWelcomeName();
            $data['subMenu'] = $this->Menu_model->getSubMenu();
            $data['menu'] = $this->Menu_model->getUserMenu();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/submenu', $data);
            $this->load->view('templates/footer');
        }

        public function addSubMenu()
        {
            $this->form_validation->set_rules('title', 'Title', 'required');
            $this->form_validation->set_rules('menu_id', 'Menu', 'required');
            $this->form_validation->set_rules('url', 'URL', 'required');
            $this->form_validation->set_rules('icon', 'Icon', 'required');
            
            if ($this->form_validation->run() == FALSE) {
                $data['title'] = 'Submenu Management';
                $data['user'] = $this->Menu_model->getWelcomeName();
                $data['subMenu'] = $this->Menu_model->getSubMenu();
                $data['menu'] = $this->Menu_model->getUserMenu();

                $this->load->view('templates/header', $data);
                $this->load->view('templates/sidebar', $data);
                $this->load->view('templates/topbar', $data);
                $this->load->view('menu/submenu', $data);
                $this->load->view('templates/footer');
            } else {
                $this->Menu_model->insertSubMenuData();
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                New Sub Menu Added.</div>');
                redirect('menu/subMenu');
            }
        }
    
    }
    
    /* End of file Menu.php */
    
?>
