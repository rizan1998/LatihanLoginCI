<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pelanggan_model extends CI_Model
{
    // public function cariDataPelanggan()
    // {
    //     $keyword = $this->input->post('keyword', true);
    //     $this->db->like('nama', $keyword);
    //     return $this->db->get('pelanggan')->result_array();
    // }

    // function ambildata($perPage, $uri, $ringkasan)
    // {
    //     $this->db->select('*');
    //     $this->db->from('pelanggan');
    //     if (!empty($ringkasan)) {
    //         $this->db->like('nama', $ringkasan);
    //     }
    //     $this->db->order_by('nama', 'asc');
    //     $getData = $this->db->get('', $perPage, $uri);

    //     if ($getData->num_rows() > 0)
    //         return $getData->result_array();
    //     else
    //         return null;
    // }

    //ambil data
    function lihat($sampai, $dari, $like = '')
    {
        if ($like)
            $this->db->where($like);
        $query = $this->db->get('pelanggan', $sampai, $dari);
        return $query->result_array();
    }

    //hitung jumlah row
    function jumlah($like = '')
    {
        if ($like)
            $this->db->where($like);
        $query = $this->db->get('pelanggan');
        return $query->num_rows();
    }

    //hitung jumlah pelanggan
    public function hitungJumlahInventori()
    {
        $this->db->select_sum('pekerjaan');
        $query = $this->db->get('pelanggan');
        if ($query->num_rows() > 0) {
            return $query->row()->pekerjaan;
        } else {
            return 0;
        }
    }
    public function hitungJumlahAsset()
    {
        $query = $this->db->get('pelanggan');
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        } else {
            return 0;
        }
    }



    //Ubah data
    function ubah_data($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }
    //hapus data
    function Hapus_data($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }
    //lihat data
    function lihat_data($table)
    {
        return $this->db->get($table);
    }
    //lihat detail data
    function lihat_detail($where, $table)
    {
        return $this->db->get_where($table, $where);
    }
}
