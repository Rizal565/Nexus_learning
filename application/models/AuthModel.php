<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AuthModel extends CI_Model
{
    public function insertData($data)
    {
        $this->db->insert('user', $data);
        return $this->db->insert_id();
    }
}
