<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->helper('download');
    }

    public function index()
    {
        $data['title'] = 'My profile';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/index', $data);
        $this->load->view('templates/footer', $data);
    }
    //download foto profil
    public function downloadFile()
    {

        force_download('/assets/1577851828Book1.xlsx', NULL);
        redirect('user');
    }


    public function edit()
    {
        $data['title'] = 'Edit profile';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('name', 'Full Name', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/edit', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $name = $this->input->post('name');
            $email = $this->input->post('email');

            //cek apakah ada gambar
            $upload_image = $_FILES['image']['name'];

            //tentukan kriteria gambar yang akan diupload
            if ($upload_image) {
                //cek apakah tipe sesuai
                $config['allowed_types'] = 'gif|jpg|png';
                //cek ukuran gambar apakah lebih dar i 2048/2mb
                $config['max_size'] = '5048';
                //tempat nyimpen gambarnya dimana
                $config['upload_path'] = './assets/images/profile';

                //tambahkan library upload filenya
                $this->load->library('upload', $config);

                //upload dari input yang namanya image
                if ($this->upload->do_upload('image')) {
                    //jika bagian ini berhasi maka gambar akan diupload ke folder
                    //tapi tidak cukup diupload ke folder karena harus menupdate nama gambar
                    //baru ke database table user

                    //jika ganti gambar baru maka akan upload gambar
                    //gambar baru tersebut akan terus bertambah hingga file nya penuh
                    //yang harus dilakukan cek terlebih dahulu old gambarnya
                    //jadi hapus gambar lama dan ganti dengan gambar baru
                    //tapi gambar default jangan dihapus
                    //maka cek dulu gambar lamaya apa
                    //diambil dari data
                    $old_image = $data['user']['image'];
                    //sekarang cek apakah gambar tersebut adalah gambar default
                    if ($old_image != 'default.jpg') // atau nama gambar default nya
                    {
                        //kalau buka default maka gambar baru 
                        //maka hapus gambar lama
                        //maka temukan alamat filenya
                        //pencerian tidak bisa menggunakan base_url
                        //karena harus alamat lengkap nya
                        //maka gunakan FCPATH untuk mengetahui path alamt ke filenya
                        //atau front controllernya
                        unlink(FCPATH . 'assets/images/profile' . $old_image);
                    }

                    //jadi yang pertama harus ambil dulu gambar baru
                    //nama yang akan dipakai yaitu nama defaultnya yg user upload
                    //jika ada nama yg sama library ci sudah otomatis menambahkan angka dibelakang namanya
                    //jadi tidak akan bentrok
                    $new_image = $this->upload->data('file_name');
                    //new_image adalah file yang telah diupload
                    //jadi nambah set baru jadi kalo ada gambarnya maka tambah set baru
                    $this->db->set('image', $new_image); //jadi akan sambung lagi dengan yg bawah jadi terupload
                } else {
                    //kalo gagal maka tampilkan errornya
                    echo $this->upload->display_errors();
                }
            }

            //lakukan query builder
            $this->db->set('name', $name);
            $this->db->where('email', $email);
            $this->db->update('user');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Your Profile has been Updated!</div>');
            redirect('user');
        }
    }


    public function changepassword()
    {
        $data['title'] = 'Change Password';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('current_password', 'Current password', 'required|trim');
        $this->form_validation->set_rules('new_password1', 'New password', 'required|trim|min_length[3]|matches[new_password2]');
        $this->form_validation->set_rules('new_password2', 'Confirm New password', 'required|trim|min_length[3]|matches[new_password1]');

        if ($this->form_validation->run() == false) {

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/changepassword', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $curren_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password1');

            if (!password_verify($curren_password, $data['user']['password'])) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Wrong current password!</div>');
                redirect('user/changepassword');
            } else {
                if ($curren_password == $new_password) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    New Password cannot be the same as current password!</div>');
                    redirect('user/changepassword');
                } else {
                    //password sudah oke
                    $password_hash = password_hash($new_password, PASSWORD_DEFAULT);

                    $this->db->set('password', $password_hash);
                    $this->db->where('email', $this->session->userdata('email')); //emal didapat dari user data
                    $this->db->update('user');

                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    Password Changed!</div>');
                    redirect('user/changepassword');
                }
            }
        }
    }
}
