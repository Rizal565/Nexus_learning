<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PengunjungController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('PengunjungModel');

        if ($this->session->userdata('logged') != TRUE) {
            redirect('login');
        }
    }

    public function index()
    {
        $data = [
            'title' => 'Data Pengunjung',
            'result' => $this->PengunjungModel->getData()
        ];

        $this->load->view('layout/head', $data);
        $this->load->view('layout/navbar', $data);
        $this->load->view('dashboard/data_pengunjung/index', $data);
        $this->load->view('layout/footer', $data);
        $this->load->view('layout/javascript', $data);
    }

    public function create()
    {
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[user.email]');
        $this->form_validation->set_rules('password', 'Password', 'required');
        // Hapus aturan validasi untuk gambar

        if ($this->form_validation->run() == false) {
            $data = [
                'title' => 'Data Pengunjung'
            ];

            $this->load->view('layout/head', $data);
            $this->load->view('layout/navbar', $data);
            $this->load->view('dashboard/data_pengunjung/create', $data);
            $this->load->view('layout/footer', $data);
            $this->load->view('layout/javascript', $data);
        } else {
            // Upload gambar
            $config['upload_path'] = './assets/uploads/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png';
            $config['file_name'] = uniqid() . '_' . time(); // Generate unique file name
            $this->load->library('upload', $config);

            if ($_FILES['images']['size'] > 0 && $this->upload->do_upload('images')) {
                // Gambar berhasil diunggah, ambil nama file
                $upload_data = $this->upload->data();
                $images = $upload_data['file_name'];
            
                // Pindahkan gambar ke direktori yang diinginkan
                $upload_path = './assets/uploads/' . $images;
                move_uploaded_file($_FILES['images']['tmp_name'], $upload_path);
            } else {
                // Upload gambar gagal atau tidak ada gambar yang diunggah, set default image name
                $images = 'default.png';
            }

            $data = array(
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'image' => $images, // Set default image name
                'password' => $this->input->post('password'),
                'role' => 'pengunjung', // You can set the role as per your requirements
            );

            $this->PengunjungModel->insertData($data);

            $this->session->set_flashdata('success', true);
            $this->session->set_flashdata('message', '<strong>Berhasil!</strong> Data anda telah tersimpan.');
            redirect('data-pengunjung');
        }
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Data Pengunjung',
            'user' => $this->PengunjungModel->getData($id),
        ];

        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

        // Check if the password field is not empty, then add the validation rule
        if (!empty($this->input->post('password'))) {
            $this->form_validation->set_rules('password', 'Password', 'required');
        }

        if ($this->form_validation->run() == false) {
            $this->load->view('layout/head', $data);
            $this->load->view('layout/navbar', $data);
            $this->load->view('dashboard/data_pengunjung/edit', $data);
            $this->load->view('layout/footer', $data);
            $this->load->view('layout/javascript', $data);
        } else {
            // Check if a new image is uploaded
            if ($_FILES['images']['name'] != '') {
                // Delete the old image if it's not default.png
                if ($data['user']->image != 'default.png') {
                    unlink('./assets/uploads/' . $data['user']->image);
                }

                // Upload the new image
                $config['upload_path'] = './assets/uploads/';
                $config['allowed_types'] = 'gif|jpg|jpeg|png';
                $config['file_name'] = $this->generateUniqueFileName($_FILES['images']['name']);
                $this->load->library('upload', $config);

                if ($this->upload->do_upload('images')) {
                    $upload_data = $this->upload->data();
                    $images = $upload_data['file_name'];
                } else {
                    $error = $this->upload->display_errors();
                    echo $error;
                    // Handle the error
                }
            } else {
                // No new image, use the existing one
                $images = $data['user']->image;
            }

            // Prepare update data
            $update_data = [
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'image' => $images,
            ];

            // Check if the password is provided, then update the password
            if (!empty($this->input->post('password'))) {
                $update_data['password'] = $this->input->post('password');
            }

            $this->PengunjungModel->updateData($id, $update_data);

            $this->session->set_flashdata('success', true);
            $this->session->set_flashdata('message', '<strong>Berhasil!</strong> Data anda telah diperbarui.');
            redirect('data-pengunjung');
        }
    }

    public function delete($id)
    {
        // Get user data to check the image name
        $user = $this->PengunjungModel->getData($id);

        // Delete the user data
        $this->PengunjungModel->deleteData($id);

        // Delete the old image if it's not default.png
        if ($user->image != 'default.png') {
            unlink('./assets/uploads/' . $user->image);
        }

        $this->session->set_flashdata('success', true);
        $this->session->set_flashdata('message', '<strong>Berhasil!</strong> Data telah dihapus.');
        redirect('data-pengunjung');
    }

    private function generateUniqueFileName($original_filename)
    {
        $path_parts = pathinfo($original_filename);
        $timestamp = time();
        $new_filename = $path_parts['filename'] . '_' . $timestamp . '.' . $path_parts['extension'];
        return $new_filename;
    }
}
