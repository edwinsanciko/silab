<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu_model extends CI_Model
{

    public $tablemenuSubMenu    = "user_sub_menu";
    public $tableUm             = "user_menu";
    public $tableDataTunggal    = "data_tunggal";
    public $tableDataLokasi     = "tb_lokasi";
    public $prodi               = "tb_prodi";
    public $tableDataAset       = "tb_aset";
    public $tablemenu           = "user_menu";
    public $tableUser           = "user";




    public function delete($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }

    ////////////////////////////////// SUB MENU ///////////////////////////////
    public function getId($id)
    {
        return $this->db->get_where($this->tablemenu, ["id" => $id])->row();
    }
    public function newUpdateMenu($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }
    public function getSubMenu()
    {
        $query = "SELECT user_sub_menu.*, user_menu.menu
                    FROM user_sub_menu JOIN  user_menu
                    ON user_sub_menu.menu_id = user_menu.id
                ";

        return $this->db->query($query)->result_array();
    }


    public function getByIdSubMenu($id)
    {
        return $this->db->get_where($this->tablemenuSubMenu, ["id" => $id])->row();
    }


    public function getByUserMenu()
    {
        return $this->db->get($this->tableUm)->result();
    }


    public function newUpdateSubMenu($where, $data, $table)
    {

        $this->db->where($where);
        $this->db->update($table, $data);
    }

    //////////////////////////////// SUB MENU ///////////////////////////////////////////////


    //////////////////////////////////// DATA LOKASI /////////////////////////////////////////

    public function getDataLokasi()
    {
        $query = "SELECT tb_lokasi.*, tb_prodi.nama_prodi
                    FROM tb_lokasi JOIN  tb_prodi
                    ON tb_lokasi.id_prodi = tb_prodi.id_prodi
                ";

        return $this->db->query($query)->result_array();
    }
    public function getByIdDataLokasi($id)
    {
        return $this->db->get_where($this->tableDataLokasi, ["id_lokasi" => $id])->row();
    }
    public function getByProdi()
    {
        return $this->db->get($this->prodi)->result();
    }

    ///////////////////////////////// END DATA LOKASI ///////////////////////////////////////

    public function getDataUser()
    {
        $query = "SELECT id,name,email,jabatan FROM user";

        return $this->db->query($query)->result_array();
    }

    public function getByIdDataUser($id)
    {
        return $this->db->get_where($this->tableUser, ["id" => $id])->row();
    }

    ///////////////////////////////// DATA ASET ////////////////////////////////////////////

    public function getDataAset()
    {
        $query = "SELECT tb_aset.*, tb_lokasi.nama_lab
                    FROM tb_aset JOIN  tb_lokasi
                    ON tb_aset.id_lokasi = tb_lokasi.id_lokasi
                ";
        //if ($keyword) {
        // $this->db->like('nama_barang', $keyword);
        //}
        return $this->db->query($query)->result_array();
    }

    public function getByIdDataAset($id)
    {
        return $this->db->get_where($this->tableDataAset, ["kode_aset" => $id])->row();
    }


    public function getByLokasi()
    {
        return $this->db->get($this->tableDataLokasi)->result();
    }
    //public function countAllaset()
    //{
    //$query = "SELECT tb_aset.*, tb_lokasi.nama_lab
    //FROM tb_aset JOIN  tb_lokasi
    //ON tb_aset.id_lokasi = tb_lokasi.id_lokasi
    // ";
    //if ($keyword) {
    // $this->db->like('nama_barang', $keyword);
    //}
    //return $this->db->query($query)->num_rows();
    //}



    ///////////////////////////////// END DATA ASET ////////////////////////////////////////////


    public function getByIdDataProdi($id)
    {
        return $this->db->get_where($this->prodi, ["id_prodi" => $id])->row();
    }
}
