<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    public function index()
    {
        $data['user'] = $this->db->get_where('user', ['nama_pembeli' => $this->session->userdata('nama_pembeli')])->row_array();
        // $this->load->view('admin/index');
        redirect(base_url() . 'libra');
    }
}
