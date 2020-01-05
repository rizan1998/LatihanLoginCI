<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu_model extends CI_Model
{
  public function getSubMenu()
  {
    $query = "SELECT `user_sub_menu`.*, `user_menu`.`menu`
        FROM `user_sub_menu` JOIN `user_menu`
        ON `user_sub_menu`.`menu_id` = `user_menu`.`id`
        ORDER BY `user_sub_menu`.`menu_id` ASC
        ";
    return  $this->db->query($query)->result_array();
  }

  function data($number, $offset)
  {
    return $query = $this->db->get('pelanggan', $number, $offset)->result();
  }

  function jumlah_data()
  {
    return $this->db->get('pelanggan')->num_rows();
  }
  //get data from database
  function get_data()
  {
    $this->db->select('year,purchase,sale,profit');
    $result = $this->db->get('account');
    return $result;
  }
}
