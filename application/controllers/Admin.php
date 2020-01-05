<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->helper(array('url'));
        $this->load->library('pagination');
        $this->load->model('Menu_model');
        $this->load->model('Pelanggan_model');
    }

    public function index()
    {


        //ini adalah cara ke 1
        // if ($this->input->post('keyword')) {
        //     $data['pelanggan'] = $this->Pelanggan_model->cariDataPelanggan();
        // }

        // $this->load->database();
        // $jumlah_data = $this->Menu_model->jumlah_data();
        // $this->load->library('pagination');
        // $config['base_url'] = base_url() . 'index.php/admin/index';
        // $config['total_rows'] = $jumlah_data;
        // $config['per_page'] = 9;
        // $from = $this->uri->segment(3);
        // $this->pagination->initialize($config);
        // $data['pelanggan'] = $this->Menu_model->data($config['per_page'], $from);


        //ini adalah cara ke 2
        // if (isset($_POST['q'])) {
        //     $data['ringkasan'] = $this->input->post('cari');
        //     // se session userdata untuk pencarian, untuk paging pencarian
        //     $this->session->set_userdata('sess_ringkasan', $data['ringkasan']);
        // } else {
        //     $data['ringkasan'] = $this->session->userdata('sess_ringkasan');
        // }


        // // load model
        // $this->load->model('Pelanggan_model');

        // $this->db->like('nama', $data['ringkasan']);
        // $this->db->from('pelanggan');

        // // pagination limit
        // $pagination['base_url'] = base_url() . 'admin/index/page/';
        // $pagination['total_rows'] = $this->db->count_all_results();
        // $pagination['full_tag_open'] = "<p><div class=\"pagination\" style='letter-spacing:2px;'>";
        // $pagination['full_tag_close'] = "</div></p>";
        // $pagination['cur_tag_open'] = "<span class=\"current\">";
        // $pagination['cur_tag_close'] = "</span>";
        // $pagination['num_tag_open'] = "<span class=\"disabled\">";
        // $pagination['num_tag_close'] = "</span>";
        // $pagination['per_page'] = "3";
        // $pagination['uri_segment'] = 4;
        // $pagination['num_links'] = 5;

        // $this->pagination->initialize($pagination);

        // $data['ListBerita'] = $this->Pelanggan_model->ambildata($pagination['per_page'], $this->uri->segment(4, 0), $data['ringkasan']);
        // $this->load->vars($data);

        $dari      = $this->uri->segment('3');
        $sampai = 12;
        $like      = '';

        //hitung jumlah row
        $jumlah = $this->Pelanggan_model->jumlah();

        //inisialisasi array
        $config = array();

        //set base_url untuk setiap link page
        $config['base_url'] = base_url() . 'admin/index/';

        //hitung jumlah row
        $config['total_rows'] = $jumlah;

        //mengatur total data yang tampil per page
        $config['per_page'] = $sampai;

        //mengatur jumlah nomor page yang tampil
        $config['num_links'] = $jumlah;

        //mengatur tag
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['next_tag_open'] = "<li>";
        $config['next_tagl_close'] = "</li>";
        $config['prev_tag_open'] = "<li>";
        $config['prev_tagl_close'] = "</li>";
        $config['first_tag_open'] = "<li>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open'] = "<li>";
        $config['last_tagl_close'] = "</li>";
        $config['cur_tag_open'] = '&nbsp;<a class="current">';
        $config['cur_tag_close'] = '</a>';
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Previous';

        //inisialisasi array 'config' dan set ke pagination library
        $this->pagination->initialize($config);



        //inisialisasi array
        $data = array();

        //ambil data buku dari database
        $data['data_buku'] = $this->Pelanggan_model->lihat($sampai, $dari, $like);

        //Membuat link
        $str_links = $this->pagination->create_links();
        $data["links"] = explode('&nbsp;', $str_links);
        $data['title'] = 'Dashboard';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['total_asset'] = $this->Pelanggan_model->hitungJumlahAsset();
        $data['total_inventori'] = $this->Pelanggan_model->hitungJumlahInventori();
        $data_grafik = $this->Menu_model->get_data()->result();
        $data['data'] = json_encode($data_grafik);


        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer', $data);
    }

    public function cari()
    {

        //mengambil nilai keyword dari form pencarian
        $search = (trim($this->input->post('key', true))) ? trim($this->input->post('key', true)) : '';

        //jika uri segmen 3 ada, maka nilai variabel $search akan diganti dengan nilai uri segmen 3
        $search = ($this->uri->segment(3)) ? $this->uri->segment(3) : $search;

        //mengambil nilari segmen 4 sebagai offset
        $dari      = $this->uri->segment('4');

        //limit data yang ditampilkan
        $sampai = 12;

        //inisialisasi variabel $like
        $like      = '';

        //mengisi nilai variabel $like dengan variabel $search, digunakan sebagai kondisi untuk menampilkan data
        if ($search) $like = "(nama LIKE '%$search%')";

        //hitung jumlah row
        $jumlah = $this->Pelanggan_model->jumlah($like);

        //inisialisasi array
        $config = array();

        //set base_url untuk setiap link page
        $config['base_url'] = base_url() . 'admin/index/' . $search;

        //hitung jumlah row
        $config['total_rows'] = $jumlah;

        //mengatur total data yang tampil per page
        $config['per_page'] = $sampai;

        //mengatur jumlah nomor page yang tampil
        $config['num_links'] = $jumlah;

        //mengatur tag
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['next_tag_open'] = "<li>";
        $config['next_tagl_close'] = "</li>";
        $config['prev_tag_open'] = "<li>";
        $config['prev_tagl_close'] = "</li>";
        $config['first_tag_open'] = "<li>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open'] = "<li>";
        $config['last_tagl_close'] = "</li>";
        $config['cur_tag_open'] = '&nbsp;<a class="current">';
        $config['cur_tag_close'] = '</a>';
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Previous';

        //inisialisasi array 'config' dan set ke pagination library
        $this->pagination->initialize($config);



        //inisialisasi array
        $data = array();

        //ambil data buku dari database
        $data['data_buku'] = $this->Pelanggan_model->lihat($sampai, $dari, $like);

        //Membuat link
        $str_links = $this->pagination->create_links();
        $data["links"] = explode('&nbsp;', $str_links);
        $data['title'] = 'Dashboard';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/searching', $data);
        $this->load->view('templates/footer', $data);
    }

    public function role()
    {
        $data['title'] = 'Role';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['role'] = $this->db->get('user_role')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/role', $data);
        $this->load->view('templates/footer', $data);
    }


    public function roleAccess($role_id)
    {
        $data['title'] = 'Role Access';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['role'] = $this->db->get_where('user_role', ['id' => $role_id])->row_array();
        $this->db->where('id !=', 1);
        $data['menu'] = $this->db->get('user_menu')->result_array();


        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/role-access', $data);
        $this->load->view('templates/footer', $data);
    }

    public function changeAccess()
    {
        $menu_id = $this->input->post('menuId');
        $role_id = $this->input->post('roleId');

        $data = [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ];
        //jadi disin ambil dulu data acces menu
        $result = $this->db->get_where('user_access_menu', $data);
        //setelah itu maka check apakah datanya ada
        if ($result->num_rows() < 1) {
            //jika datanya tidak ada maka insert
            $this->db->insert('user_access_menu', $data);
        } else {
            //jika datanya ada maka
            $this->db->delete('user_access_menu', $data);
        }
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Access Changed!</div>');
    }
}
