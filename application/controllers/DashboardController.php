<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DashboardController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('logged') != TRUE) {
            redirect('login');
        }
    }
    public function index()
    {
        $data = [
            'title' => 'Dashboard'
        ];

        $this->load->view('layout/head', $data);
        $this->load->view('layout/navbar', $data);
        $this->load->view('dashboard/index', $data);
        $this->load->view('layout/footer', $data);
        $this->load->view('layout/javascript', $data);
    }
}
