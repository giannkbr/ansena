<?php

class M_user extends CI_Model
{

    public function tampil()
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->order_by('id', 'asc');
        return $this->db->get()->result_array();
    }
}
