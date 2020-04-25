<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Menu_model');
        $this->load->helper('url');
    }


    public function index()
    {
        $data['title'] = 'Menu Management';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->form_validation->set_rules('menu', 'Menu', 'required');

        if ($this->form_validation->run() == false) {

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/index', $data);
            $this->load->view('templates/footer');
        } else {
            $this->db->insert('user_menu', ['menu' => $this->input->post('menu')]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New Menu Added!</div>');
            redirect('menu');
        }
    }


    ///////////////////////////////////////////////////// CRUD SUB MENU ///////////////////////////////////////////////////////////////////

    public function submenu()
    {
        $data['title'] = 'Submenu Management';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->model('Menu_model', 'menu');

        $data['subMenu'] = $this->menu->getSubMenu();
        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('menu_id', 'Menu', 'required');
        $this->form_validation->set_rules('url', 'URL', 'required');
        $this->form_validation->set_rules('icon', 'icon', 'required');

        if ($this->form_validation->run() == false) {

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/submenu', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'title'     => $this->input->post('title'),
                'menu_id'   => $this->input->post('menu_id'),
                'url'       => $this->input->post('url'),
                'icon'      => $this->input->post('icon'),
                'is_active' => $this->input->post('is_active')
            ];

            $this->db->insert('user_sub_menu', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New Sub Menu Added!</div>');
            redirect('menu/submenu');
        }
    }

    public function deleteSubmenu($id)
    {
        $where = array('id' => $id);
        $this->Menu_model->delete($where, 'user_sub_menu');
        redirect('menu/submenu');
    }

    public function editSubMenu($id)
    {
        $subMenu = $this->Menu_model;
        $userMenu = $this->Menu_model;
        $data['subMenu'] = $subMenu->getByIdSubMenu($id);
        $data['userMenu'] = $userMenu->getByUserMenu();
        $data['title'] = 'Edit Sub Menu';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('menu/updateSubMenu', $data);
        $this->load->view('templates/footer');
    }

    public function newUpdateSubMenu()
    {
        $menu       = $this->input->post('menu_id');
        $title      = $this->input->post('title');
        $url        = $this->input->post('url');
        $icon       = $this->input->post('icon');
        $is_active  = $this->input->post('is_active');
        $id         = $this->input->post('id_s');


        $data = array(

            'menu_id' => $menu,
            'title' => $title,
            'url' => $url,
            'icon' => $icon,
            'is_active' => $is_active,


        );
        $where = array('id' => $id);

        $this->Menu_model->newUpdateSubMenu($where, $data, 'user_sub_menu');

        redirect('menu/submenu');
    }

    ///////////////////////////////////////////////////// END CRUD SUB MENU ////////////////////////////////////////

    public function dashboard()
    {
        $data['title'] = 'Menu Utama';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('menu/dashboard', $data);
        $this->load->view('templates/footer');
    }

    //////////////////////////////////////////////////////// DATA LOKASI ////////////////////////////////////////////////////

    public function dataLokasi()
    {
        $data['title'] = 'Master Data Lokasi';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->model('Menu_model', 'menu');

        $data['dataLokasi'] = $this->menu->getDataLokasi();
        $data['prodi'] = $this->db->get('tb_prodi')->result_array();

        $this->form_validation->set_rules('id_prodi', 'Nama Prodi', 'required');
        $this->form_validation->set_rules('nama_lab', 'Nama Lab', 'required');

        if ($this->form_validation->run() == false) {

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/dataLokasi', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'id_prodi'   => $this->input->post('id_prodi'),
                'nama_lab'   => $this->input->post('nama_lab')
            ];

            $this->db->insert('tb_lokasi', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New Data Lokasi Added!</div>');
            redirect('menu/dataLokasi');
        }
    }

    public function editDataLokasi($id)
    {
        $dataLokasi         = $this->Menu_model;
        $dataProdi          = $this->Menu_model;
        $data['dataLokasi'] = $dataLokasi->getByIdDataLokasi($id);
        $data['dataProdi']  = $dataProdi->getByProdi();
        $data['title']      = 'Edit Data Lokasi';
        $data['user']       = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('menu/editDataLokasi', $data);
        $this->load->view('templates/footer');
    }

    public function newEditDataLokasi()
    {
        $id_prodi   = $this->input->post('id_prodi');
        $nama_lab   = $this->input->post('nama_lab');
        $id         = $this->input->post('id_lokasi');


        $data = array(

            'id_prodi' => $id_prodi,
            'nama_lab' => $nama_lab,


        );
        $where = array('id_lokasi' => $id);

        $this->Menu_model->newUpdateSubMenu($where, $data, 'tb_lokasi');

        redirect('menu/dataLokasi');
    }

    public function deleteDataLokasi($id)
    {
        $where = array('id_lokasi' => $id);
        $this->Menu_model->delete($where, 'tb_lokasi');
        redirect('menu/dataLokasi');
    }
    ///////////////////////////////////////////////// END DATA LOKASI //////////////////////////////////////////////////


}
