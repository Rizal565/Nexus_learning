<?php defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('UserModel');

        if ($this->session->userdata('logged') != TRUE) {
            redirect('login');
        }
    }

    
    public function index()
    {
        $userId = $this->session->userdata('user_id'); // Assuming 'user_id' is the key for the user ID in the session

        if (!$userId) {
            // Handle the case when the user ID is not available in the session
            show_error('User ID not found in session.');
        }
    
        redirect('user/edit/' . $userId);    }

    public function edit($id)
    {
        // Fetch user data based on ID
        $user = $this->UserModel->getData($id);

        if (!$user) {
            show_404();
        }

        $data = [
            'title' => 'Edit Pengguna',
            'user' => $user,
        ];

    $this->form_validation->set_rules('name', 'Name', 'required');
    $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

    if (!empty($this->input->post('password'))) {
        $this->form_validation->set_rules('password', 'Password', 'required');
    }

    if ($this->form_validation->run() == false) {
        $this->load->view('layout/head', $data);
        $this->load->view('layout/navbar', $data);
        $this->load->view('user/index', $data); // Ganti 'index' dengan 'edit'
        $this->load->view('layout/footer', $data);
        $this->load->view('layout/javascript', $data);
    }
    else {
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

        $this->UserModel->updateData($id, $update_data);

        $this->session->set_flashdata('success', true);
        $this->session->set_flashdata('message', '<strong>Berhasil!</strong> Data anda telah diperbarui.');
        redirect(base_url());
    }
}

    private function generateUniqueFileName($original_filename)
    {
        $path_parts = pathinfo($original_filename);
        $timestamp = time();
        $new_filename = $path_parts['filename'] . '_' . $timestamp . '.' . $path_parts['extension'];
        return $new_filename;
    }
}
