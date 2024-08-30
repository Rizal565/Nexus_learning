<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MateriController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('MateriModel');
        $this->load->model('KategoriModel');

        if ($this->session->userdata('logged') != TRUE) {
            redirect('login');
        }
    }

    public function index()
    {
        $data = [
            'title' => 'Data Materi',
            'result' => $this->MateriModel->getData(),
        ];

        $this->load->view('layout/head', $data);
        $this->load->view('layout/navbar', $data);
        $this->load->view('dashboard/data_materi/index', $data);
        $this->load->view('layout/footer', $data);
        $this->load->view('layout/javascript', $data);
    }

    public function create()
    {
        $this->form_validation->set_rules('id_kategori', 'Nama Kategori', 'required');
        $this->form_validation->set_rules('judul_materi', 'Judul Materi', 'required');

        if ($this->form_validation->run() == false) {
            $data = [
                'title' => 'Data Materi',
                'kategori' => $this->KategoriModel->getData()
            ];

            $this->load->view('layout/head', $data);
            $this->load->view('layout/navbar', $data);
            $this->load->view('dashboard/data_materi/create', $data);
            $this->load->view('layout/footer', $data);
            $this->load->view('layout/javascript', $data);
        } else {
            // Upload gambar
            $config['upload_path'] = './assets/files/';
            $config['allowed_types'] = 'pdf';
            $config['file_name'] = uniqid() . '_' . time(); // Generate unique file name
            $this->load->library('upload', $config);

            if ($this->upload->do_upload('file_uploaded')) {
                // Gambar berhasil diunggah, ambil nama file
                $upload_data = $this->upload->data();
                $file_uploaded = $upload_data['file_name'];

                // Pindahkan gambar ke direktori yang diinginkan
                $upload_path = './assets/files/' . $file_uploaded;
                move_uploaded_file($_FILES['file_uploaded']['tmp_name'], $upload_path);
            } else {
                // Upload gambar gagal, set default image name
                $file_uploaded = 'default.png';
            }

            $data = array(
                'id_kategori' => $this->input->post('id_kategori'),
                'judul_materi' => $this->input->post('judul_materi'),
                'file_uploaded' => $file_uploaded
            );

            $this->MateriModel->insertData($data);

            $this->session->set_flashdata('success', true);
            $this->session->set_flashdata('message', '<strong>Berhasil!</strong> Data anda telah tersimpan.');
            redirect('materi');
        }
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Data Materi',
            'materi' => $this->MateriModel->getData($id),
            'kategori' => $this->KategoriModel->getData()
        ];

        $this->form_validation->set_rules('id_kategori', 'Nama Kategori', 'required');
        $this->form_validation->set_rules('judul_materi', 'Judul Materi', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('layout/head', $data);
            $this->load->view('layout/navbar', $data);
            $this->load->view('dashboard/data_materi/edit', $data);
            $this->load->view('layout/footer', $data);
            $this->load->view('layout/javascript', $data);
        } else {
            // Check if a new image is uploaded
            if ($_FILES['file_uploaded']['name'] != '') {
                // Delete the old image if it's not default.png
                if ($data['materi']->file_uploaded != 'default.png') {
                    unlink('./assets/files/' . $data['materi']->file_uploaded);
                }

                // Upload the new image
                $config['upload_path'] = './assets/files/';
                $config['allowed_types'] = 'pdf';
                $config['file_name'] = $this->generateUniqueFileName($_FILES['file_uploaded']['name']);
                $this->load->library('upload', $config);

                if ($this->upload->do_upload('file_uploaded')) {
                    $upload_data = $this->upload->data();
                    $file_uploaded = $upload_data['file_name'];
                } else {
                    $error = $this->upload->display_errors();
                    echo $error;
                    // Handle the error
                }
            } else {
                // No new file_uploaded, use the existing one
                $file_uploaded = $data['materi']->file_uploaded;
            }

            // Prepare update data
            $update_data = [
                'id_kategori' => $this->input->post('id_kategori'),
                'judul_materi' => $this->input->post('judul_materi'),
                'file_uploaded' => $file_uploaded,
            ];

            $this->MateriModel->updateData($id, $update_data);

            $this->session->set_flashdata('success', true);
            $this->session->set_flashdata('message', '<strong>Berhasil!</strong> Data anda telah diperbarui.');
            redirect('materi');
        }
    }

    public function delete($id)
    {
        // Get materi data to check the image name
        $materi = $this->MateriModel->getData($id);

        // Delete the materi data
        $this->MateriModel->deleteData($id);

        // Delete the old file_uploaded if it's not default.png
        if ($materi->file_uploaded != 'default.png') {
            unlink('./assets/files/' . $materi->file_uploaded);
        }

        $this->session->set_flashdata('success', true);
        $this->session->set_flashdata('message', '<strong>Berhasil!</strong> Data telah dihapus.');
        redirect('materi');
    }

    private function generateUniqueFileName($original_filename)
    {
        $path_parts = pathinfo($original_filename);
        $timestamp = time();
        $new_filename = $path_parts['filename'] . '_' . $timestamp . '.' . $path_parts['extension'];
        return $new_filename;
    }
}
