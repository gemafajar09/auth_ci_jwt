<?php
class Loginmodel extends CI_Model{

    public function cekDataUser($username){
        $this->db->select('*');
        $this->db->from('tb_user');
        $this->db->where('username',$username);
        $query = $this->db->get();
        return $query->row();
    }

    public function cekJikaAda($username){
        $this->db->select('*');
        $this->db->from('tb_user');
        $this->db->where('username',$username);
        $query = $this->db->get();
        return $query->num_rows();
    }
}