<?php
defined('BASEPATH') or exit('No direct script access allowed');

class KategoriController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('KategoriModel');

        if ($this->session->userdata('logged') != TRUE) {
            redirect('login');
        }
    }

    public function index()
    {
        $data = [
            'title' => 'Data Kategori',
            'result' => $this->KategoriModel->getData()
        ];

        $this->load->view('layout/head', $data);
        $this->load->view('layout/navbar', $data);
        $this->load->view('dashboard/data_kategori/index', $data);
        $this->load->view('layout/footer', $data);
        $this->load->view('layout/javascript', $data);
    }

    public function create()
    {
    $this->form_validation->set_rules('nama_kategori', 'Nama Kategori', 'required');

    if ($this->form_validation->run() == false) {
        $data = [
            'title' => 'Data Kategori'
        ];

        $this->load->view('layout/head', $data);
        $this->load->view('layout/navbar', $data);
        $this->load->view('dashboard/data_kategori/create', $data);
        $this->load->view('layout/footer', $data);
        $this->load->view('layout/javascript', $data);
    } else {
        // Check if the category name already exists
        $existing_category = $this->KategoriModel->getCategoryByName($this->input->post('nama_kategori'));

        if ($existing_category) {
            $this->session->set_flashdata('failed', true);
            $this->session->set_flashdata('message', '<strong>Error!</strong> Nama kategori ' . $this->input->post('nama_kategori') . ' sudah ada.');
            redirect('data-kategori/edit'. $id);
        }

        $data = array(
            'nama_kategori' => $this->input->post('nama_kategori'),
        );

        $this->KategoriModel->insertData($data);

        $this->session->set_flashdata('success', true);
        $this->session->set_flashdata('message', '<strong>Berhasil!</strong> Menambah Kategori.');
        redirect('data-kategori');
    }
    }


    public function edit($id)
    {
    $data = [
        'title' => 'Data Kategori',
        'user' => $this->KategoriModel->getData($id),
    ];

    $this->form_validation->set_rules('nama_kategori', 'Nama Kategori', 'required');

    if ($this->form_validation->run() == false) {
        $this->load->view('layout/head', $data);
        $this->load->view('layout/navbar', $data);
        $this->load->view('dashboard/data_kategori/edit', $data);
        $this->load->view('layout/footer', $data);
        $this->load->view('layout/javascript', $data);
    } else {
        // Check if the category name already exists
        $existing_category = $this->KategoriModel->getCategoryByName($this->input->post('nama_kategori'));
        if ($existing_category) {
            $this->session->set_flashdata('failed', true);
            $this->session->set_flashdata('message', '<strong>Error!</strong> Nama kategori ' . $this->input->post('nama_kategori') . ' sudah ada.');
        
            // Tampilkan pesan di view terlebih dahulu
            redirect('data-kategori/edit/' . $id);// Atau 'data-kategori/edit' sesuai fungsinya
        }

        // Prepare update data
        $update_data = [
            'nama_kategori' => $this->input->post('nama_kategori'),
        ];

        $this->KategoriModel->updateData($id, $update_data);

        $this->session->set_flashdata('success', true);
        $this->session->set_flashdata('message', '<strong>Berhasil!</strong> Memperbarui Nama Kategori.');
        redirect('data-kategori');
    }
    }


    public function delete($id)
    {
        $this->KategoriModel->deleteData($id);

        $this->session->set_flashdata('success', true);
        $this->session->set_flashdata('message', '<strong>Berhasil!</strong> Data telah dihapus.');
        redirect('data-kategori');
    }
}
