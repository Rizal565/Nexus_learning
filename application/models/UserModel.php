<?php defined('BASEPATH') or exit('No direct script access allowed');

class UserModel extends CI_Model
{
    public function getData($id = false)
    {
        if ($id == false) {
            return $this->db->get('user')->result();
        }

        return $this->db->get_where('user', ['id' => $id])->row();
    }



    public function insertData($data)
    {
        $this->db->insert('user', $data);
        return $this->db->insert_id();
    }

    public function updateData($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('user', $data);
    }

    public function deleteData($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('user');
    }
}