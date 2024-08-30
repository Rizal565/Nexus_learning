<?php
defined('BASEPATH') or exit('No direct script access allowed');

class KategoriModel extends CI_Model
{
    public function getData($id = false)
    {
        if ($id == false) {
            return $this->db->get('kategori')->result();
        }

        return $this->db->get_where('kategori', ['id_kategori' => $id])->row();
    }

    public function insertData($data)
    {
        $this->db->insert('kategori', $data);
        return $this->db->insert_id();
    }

    public function updateData($id, $data)
    {
        $this->db->where('id_kategori', $id);
        $this->db->update('kategori', $data);
    }

    public function deleteData($id)
    {
        $this->db->where('id_kategori', $id);
        $this->db->delete('kategori');
    }

    public function getCategoryByName($nama_kategori)
    {
        return $this->db->get_where('kategori', ['nama_kategori' => $nama_kategori])->row_array();
    }
}
