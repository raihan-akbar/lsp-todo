<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mod extends CI_Model
{

    public function get($table, $where)
    {
        return $this->db->get_where($table, $where);
    }

    public function select($table)
    {
        return $this->db->get_where($table);
    }

    public function add($data, $table)
    {
        $this->db->insert($table, $data);
    }

    public function del($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }

    function upd($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }
}

/* End of file Mod.php */