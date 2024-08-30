<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AuthController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('AuthModel');
    }

    public function index()
    {
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->session->userdata('logged') != TRUE) {
            if ($this->form_validation->run() == false) {
                $this->load->view('auth/login');
            } else {
                $this->_login();
            }
        } else {
            redirect(base_url());
        }
    }

    public function _login()
    {
        $email = htmlspecialchars($this->input->post('email', true));
        $password = htmlspecialchars($this->input->post('password', true));

        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        if ($user) {
            if ($password === $user['password']) {
                $data = [
                    'user_id' => $user['id'],
                    'role' => $user['role'],
                    'logged' => TRUE
                ];

                $this->session->set_userdata($data);
                $this->session->set_flashdata('success', true);
                $this->session->set_flashdata('message', '<strong>Berhasil!</strong> Selamat datang kembali!');
                redirect(base_url());
            } else {
                $this->session->set_flashdata('failed', true);
                $this->session->set_flashdata('message', '<strong>Gagal!</strong> Anda salah password!');
                redirect('login');
            }
        } else {
            $this->session->set_flashdata('failed', true);
            $this->session->set_flashdata('message', '<strong>Gagal!</strong> Email tidak terdaftar!');
            redirect('login');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('id');
        $this->session->unset_userdata('role');
        $this->session->unset_userdata('logged');

        $this->session->set_flashdata('success', true);
        $this->session->set_flashdata('message', '<strong>Berhasil!</strong> You have been logged out!');
        redirect('login');
    }

    public function register()
    {
        $this->form_validation->set_rules('name', 'Full Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[user.email]');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('retype_password', 'Retype Password', 'required|matches[password]');

        if ($this->form_validation->run() == false) {
            $data = [
                'title' => 'Register'
            ];

            $this->load->view('auth/register', $data);
        } else {
            // Upload gambar
            $config['upload_path'] = './assets/uploads/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png';
            $config['file_name'] = uniqid() . '_' . time(); // Generate unique file name
            $this->load->library('upload', $config);

            if ($this->upload->do_upload('images')) {
                // Gambar berhasil diunggah, ambil nama file
                $upload_data = $this->upload->data();
                $images = $upload_data['file_name'];

                // Pindahkan gambar ke direktori yang diinginkan
                $upload_path = './assets/uploads/' . $images;
                move_uploaded_file($_FILES['images']['tmp_name'], $upload_path);
            } else {
                // Upload gambar gagal, set default image name
                $images = 'default.png';
            }

            $data = array(
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'image' => $images, // Set default image name
                'password' => $this->input->post('password'),
                'role' => 'pengunjung', // You can set the role as per your requirements
            );

            $this->AuthModel->insertData($data);

            $this->session->set_flashdata('success', true);
            $this->session->set_flashdata('message', '<strong>Berhasil!</strong> Data anda telah terdaftar disistem.');
            redirect('register');
        }
    }
}
