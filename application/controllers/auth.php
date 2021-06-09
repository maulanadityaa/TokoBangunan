<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index()
    {
        $this->form_validation->set_rules('nama_pembeli', 'Nama Pembeli', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Halaman Login';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/login');
            $this->load->view('templates/auth_footer');
        } else {
            $this->login();
        }
    }

    private function login()
    {
        $nama_pembeli = $this->input->post('nama_pembeli');
        $password = $this->input->post('password');

        $user = $this->db->get_where('user', ['nama_pembeli' => $nama_pembeli, 'password' => $password])->row_array();

        if ($user){
            $data = [
                'nama_pembeli' => $user['nama_pembeli'],
                'role' => $user['role'],
                'kondisi' => $user['kondisi'],
                'jumlah_harga' => $user['jumlah_harga'],
                'jumlah_beli' => $user['jumlah_beli']
            ];
            $this->session->set_userdata($data);
            if ($user['role'] == 2) {
                redirect('admin');
            } else {
                redirect('user');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Username atau password salah!</div>');
            redirect('auth');
        }
    }

    public function register()
    {
        $this->form_validation->set_rules('nama_pembeli', 'Username', 'trim|required|is_unique[user.nama_pembeli]', [
            'is_unique' => 'Username telah digunakan'
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'trim|required|min_length[3]|matches[password2]', [
            'matches' => 'Password tidak sama!',
            'min_length' => 'Password minimal 3 karakter!'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'trim|required|matches[password1]');
        $this->form_validation->set_rules('no_telp', 'No Telp', 'trim|required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Pendaftaran';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/register');
            $this->load->view('templates/auth_footer');
        } else {
            $data = [
                'nama_pembeli' => $this->input->post('nama_pembeli'),
                'password' => $this->input->post('password1'),
                'role' => '1',
                'kondisi' => '0',
                'no_telp' => $this->input->post('no_telp'),
                'alamat' => $this->input->post('alamat')
            ];

            $this->db->insert('user', $data);

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Pendaftaran berhasil!</div>');
            redirect('auth');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('nama_pembeli');
        $this->session->unset_userdata('role');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Telah logout!</div>');
        redirect('auth');
    }
}
