<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MateriModel extends CI_Model
{
    public function getData($id = false)
    {
        if ($id == false) {
            // Join the materi table with the kategori table
            $this->db->select('materi.*, kategori.nama_kategori');
            $this->db->from('materi');
            $this->db->join('kategori', 'materi.id_kategori = kategori.id_kategori', 'left');
            return $this->db->get()->result();
        }

        return $this->db->get_where('materi', ['materi.id_materi' => $id])->row();
    }

    public function insertData($data)
    {
        $this->db->insert('materi', $data);
        return $this->db->insert_id();
    }

    public function updateData($id, $data)
    {
        $this->db->where('id_materi', $id);
        $this->db->update('materi', $data);
    }

    public function deleteData($id)
    {
        $this->db->where('id_materi', $id);
        $this->db->delete('materi');
    }
}
