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

    public function deleteDataLokasi($id)
    {
        $where = array('id_lokasi' => $id);
        $this->Menu_model->delete($where, 'tb_lokasi');
        redirect('menu/dataLokasi');
    }
    ///////////////////////////////////////////////// END DATA LOKASI //////////////////////////////////////////////////

    ///////////////////////////////////////////////// DATA ASET ///////////////////////////////////////////////////////

    public function dataAset()
    {
        $data['title'] = 'Master Data Aset';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->model('Menu_model', 'menu');
        $data['dataAset'] = $this->menu->getDataAset();
        $data['lokasi'] = $this->db->get('tb_lokasi')->result_array();

        $this->form_validation->set_rules('id_lokasi', 'Nama Lab', 'required');
        $this->form_validation->set_rules('nama_barang', 'Nama Barang', 'required');
        $this->form_validation->set_rules('spesifikasi', 'Spesifikasi', 'required');
        $this->form_validation->set_rules('jumlah', 'Jumlah', 'required');
        $this->form_validation->set_rules('satuan', 'Satuan', 'required');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required');

        if ($this->form_validation->run() == false) {

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/dataAset', $data);
            $this->load->view('templates/footer');
        } else {
            $konfigurasi = array(
                'allowed_types' => 'jpg|JPG|jpeg|gif|png|bmp',
                'upload_path'  => realpath('./assets/media')
            );
            $this->load->library('upload', $konfigurasi);
            $this->upload->do_upload('image');
            $data = [
                'id_lokasi'     => $this->input->post('id_lokasi'),
                'nama_barang'   => $this->input->post('nama_barang'),
                'spesifikasi'   => $this->input->post('spesifikasi'),
                'jumlah'        => $this->input->post('jumlah'),
                'satuan'        => $this->input->post('satuan'),
                'keterangan'    => $this->input->post('keterangan'),
                'foto'          => $_FILES['image']['name']

            ];

            $this->db->insert('tb_aset', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New Data Assets Added!</div>');
            redirect('menu/dataAset');
        }
    }

    public function editDataAset($id)
    {
        $asetData            = $this->Menu_model;
        $dataLokasi          = $this->Menu_model;
        $data['asetData']    = $asetData->getByIdDataAset($id);
        $data['dataLokasi']  = $dataLokasi->getByLokasi();
        $data['title']       = 'Edit Data Aset';
        $data['user']        = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('menu/editDataAset', $data);
        $this->load->view('templates/footer');
    }


    public function deleteDataAset($id)
    {
        $where = array('kode_aset' => $id);
        $this->Menu_model->delete($where, 'tb_aset');
        redirect('menu/dataAset');
    }


    ///////////////////////////////////////////////// END DATA ASET ///////////////////////////////////////////////////////


}
