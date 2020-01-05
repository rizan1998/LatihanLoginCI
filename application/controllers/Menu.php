<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Pelanggan_model');
        $this->load->library(array('PHPExcel', 'PHPExcel/IOFactory'));
        $this->load->library('pdf');
    }

    public function index()
    {
        $data['title'] = 'Menu Management';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(); //row karena datanya hanya 1 atau satu baris
        $data['menu'] = $this->db->get('user_menu')->result_array(); //result karna datanya banyak

        $this->form_validation->set_rules('menu', 'Menu', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/index', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $this->db->insert('user_menu', ['menu' => $this->input->post('menu')]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New menu added!</div>');
            redirect('menu');
        }
    }

    public function submenu()
    {
        $data['title'] = 'Submenu Management';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->model('Menu_model', 'menu');
        $data['subMenu'] = $this->menu->getSubMenu();
        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->form_validation->set_rules('title', 'Title', 'required|trim');
        $this->form_validation->set_rules('menu_id', 'Menu_id', 'required|trim');
        $this->form_validation->set_rules('url', 'Url', 'required|trim');
        $this->form_validation->set_rules('icon', 'Icon', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/submenu', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $data = [
                'title' => $this->input->post('title'),
                'menu_id' => $this->input->post('menu_id'),
                'url' => $this->input->post('url'),
                'icon' => $this->input->post('icon'),
                'is_active' => $this->input->post('is_active')
            ];
            $this->db->insert('user_sub_menu', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New Submenu added!</div>');
            redirect('menu/submenu');
        }
    }
    public function ExportDBtoExcel()
    {
        $data['title'] = 'Submenu Management';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->model('Menu_model', 'menu');
        $data['subMenu'] = $this->menu->getSubMenu();
        $data['menu'] = $this->db->get('user_menu')->result_array();
        $data['titleExcel'] =  'Laporan Excel | Tutorial Export ke excel CodeIgniter @ https://recodeku.blogspot.com';

        $this->load->view('menu/ExportDBtoExcel', $data);
    }

    function pdf()
    {
        $pdf = new FPDF('l', 'mm', 'A5');
        // membuat halaman baru
        $pdf->AddPage();
        // setting jenis font yang akan digunakan
        $pdf->SetFont('Arial', 'B', 16);
        // mencetak string 
        $pdf->Cell(190, 7, 'SEKOLAH MENENGAH KEJURUSAN NEEGRI 2 LANGSA', 0, 1, 'C');
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(190, 7, 'DAFTAR SISWA KELAS IX JURUSAN REKAYASA PERANGKAT LUNAK', 0, 1, 'C');
        // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->Cell(10, 7, '', 0, 1);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(20, 6, 'NIM', 1, 0);
        $pdf->Cell(85, 6, 'NAMA MAHASISWA', 1, 0);
        $pdf->Cell(27, 6, 'NO HP', 1, 0);
        $pdf->Cell(25, 6, 'TANGGAL LHR', 1, 1);
        $pdf->SetFont('Arial', '', 10);
        $submenu = $this->Pelanggan_model->lihat_data('user_sub_menu')->result();
        foreach ($submenu as $sm) {
            $pdf->Cell(20, 6, $sm->title, 1, 0);
            $pdf->Cell(85, 6, $sm->menu_id, 1, 0);
            $pdf->Cell(27, 6, $sm->url, 1, 0);
            $pdf->Cell(25, 6, $sm->icon, 1, 1);
            $pdf->Cell(25, 6, $sm->is_active, 1, 1);
        }
        $pdf->Output();
    }

    function tambah()
    {
        $data = array(
            'nama'        => $this->input->post('nama'),
            'alamat'    => $this->input->post('alamat'),
            'pekerjaan'    => $this->input->post('pekerjaan')
        );
        $this->model_admin->tambah($data);
        $this->session->set_flashdata('notif', '<div class="alert alert-success" role="alert"> Data Berhasil ditambahkan <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        redirect('admin');
    }

    function lihatDetail($id)
    {
        $data['title'] = 'Submenu Management';
        $where = array('email' => $this->session->userdata('email'));
        $data['user'] = $this->Pelanggan_model->lihat_detail($where, 'user')->row_array();
        $where = array('id' => $id);
        $data['detailsubmenu'] = $this->Pelanggan_model->lihat_detail($where, 'user_sub_menu')->result();
        $data['user_menu'] = $this->Pelanggan_model->lihat_data('user_menu')->result();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('menu/editSubmenu', $data);
        $this->load->view('templates/footer', $data);
    }

    function ubahSubmenu()
    {
        $id = $this->input->post('id');
        $title = $this->input->post('title');
        $menu_id = $this->input->post('menu_id');
        $url = $this->input->post('url');
        $icon = $this->input->post('icon');
        $is_active = $this->input->post('is_active');
        $data = array(

            'title' => $title,
            'menu_id' => $menu_id,
            'url' => $url,
            'icon' => $icon,
            'is_active' => $is_active
        );

        $where = array('id' => $id);
        $this->Pelanggan_model->ubah_data($where, $data, 'user_sub_menu');
        $this->session->set_flashdata('notif', '<div class="alert alert-success" role="alert"> Data Berhasil diubah <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        redirect('menu/submenu');
    }

    function hapusSubmenu()
    {
        $id = $this->input->post('id');
        $this->Pelanggan_model->Hapus_data(['id' => $id], 'user_sub_menu');
        redirect('menu/submenu');
    }
}
