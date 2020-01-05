<?php

//helper adalah sarana dari CI untuk membuat sebuah function yang tidak ada di CI atau di php
//helper yg akan dibuat saat ini adalah untuk mengecek apakah user sudah login dan role_id nya berapa

//karena helper tidak masuk kedalam CI atau MVC nya CI maka harus bikin instance CI baru


function is_logged_in()
{
    //maka panggil instance siasi CI nya menggunakan fungsi get_instance
    //untuk memanggil library CI didalam fungsi ini
    //jadi fungsi $this pada CI diganti dengan var ci

    $ci = get_instance();
    if (!$ci->session->userdata('email')) {
        redirect('auth');
    } else {
        //role_id didapat dalam session login
        $role_id = $ci->session->userdata('role_id');

        //pengaksesan menu mana
        //cara dapetin menunya dilihat pada url nya
        //jadi disini dapat menu yang akan di aksesnya
        $menu = $ci->uri->segment(1);

        //lalu cocokan dengan database
        //jika roel_id = 1 boleh tidak mengakses admin dll
        //lakukan query terlebih dahulu
        //untuk mengambil menu_id
        $queryMenu = $ci->db->get_where('user_menu', ['menu' => $menu])->row_array();
        $menu_id = $queryMenu['id'];

        //lalu query table user access menu untuk menyamakan nilai yang sudah di dapat
        $userAccess = $ci->db->get_where('user_access_menu', [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ]);
        //lalu cek didalam baris userAccess jika ada isinya
        if ($userAccess->num_rows() < 1) {
            redirect('auth/blocked');
        }
    }


    function check_access($role_id, $menu_id)
    {
        $ci = get_instance();

        //ambil dulu data user access menu nya
        $ci->db->where('role_id', $role_id);
        $ci->db->where('menu_id', $menu_id);
        $result =  $ci->db->get('user_access_menu');

        if ($result->num_rows() > 0) {
            return "checked = 'checked'";
        }

        //bija juga memakai query lain
        // $ci->db->get_where( 'user_access_menu', 
        //                     ['role_id' => $role_id,
        //                     'menu_id' => $menu_id]);
    }
}
