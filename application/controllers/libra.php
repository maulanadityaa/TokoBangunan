<?php defined('BASEPATH') or exit('No direct script access allowed');

class Libra extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("libra_model");
        $this->load->library('form_validation');
        if ($this->session->userdata('nama_pembeli')) {
        } else {
            redirect(base_url() . 'auth', 'refresh');
        }
    }

    public function index()
    {
        $title['title'] = 'Daftar Barang';
        $data['libra'] = $this->libra_model->getAllDat();
        $this->load->view('callbootstrap', $title);
        $this->load->view('index', $data);
    }

    public function supplier()
    {
        $title['title'] = 'Daftar Supplier Barang';
        $data['libra'] = $this->libra_model->getAllSup();
        $this->load->view('callbootstrap', $title);
        $this->load->view('supplier', $data);
    }

    public function create()
    {
        $title['title'] = 'Tambah Barang';
        $data['id_barang'] = $this->libra_model->getMaxId();
        $this->load->view('callbootstrap', $title);
        $this->load->view('create', $data);
    }

    public function create_process()
    {
        $this->form_validation->set_rules('id_barang', 'ID Barang', 'required|is_unique[barang.id_barang]', ['required' => 'Form ID harus diisi.', 'is_unique' => 'ID sudah digunakan.']);
        $this->form_validation->set_rules('jenis_barang', 'Jenis Barang', 'required', ['required' => 'Form jenis_barang harus diisi.']);
        $this->form_validation->set_rules('merk_barang', 'Penulis', 'required', ['required' => 'Form merk_barang harus diisi.']);
        $this->form_validation->set_rules('ukuran', 'Kategori', 'required', ['required' => 'Form ukuran harus diisi.']);
        $this->form_validation->set_rules('stock', 'Stock', 'required', ['required' => 'Form stock harus diisi.']);
        $this->form_validation->set_rules('harga', 'Harga', 'required', ['required' => 'Form harga harus diisi.']);
        if ($this->form_validation->run() == true) {
            $data['id_barang'] = $this->input->post('id_barang');
            $data['jenis_barang'] = $this->input->post('jenis_barang');
            $data['merk_barang'] = $this->input->post('merk_barang');
            $data['ukuran'] = $this->input->post('ukuran');
            $data['stock'] = $this->input->post('stock');
            $data['harga'] = $this->input->post('harga');
            $this->libra_model->insert_barang($data);
            // Mengisi flashdata dengan perintah sesuai
            $this->session->set_flashdata('flash', 'ditambahkan');
            redirect(base_url() . 'libra', 'refresh');
        } else {
            $title['title'] = 'Tambah Barang';
            $data['id_barang'] = $this->libra_model->getMaxId();
            $this->load->view('callbootstrap', $title);
            $this->load->view('create', $data);
        }
    }

    public function update($id)
    {
        $title['title'] = 'Edit Barang';
        $data['libra'] = $this->libra_model->getById($id);
        $this->load->view('callbootstrap', $title);
        $this->load->view('update', $data);
    }

    public function update_process()
    {
        $id = $this->input->post('id_barang');
        $this->form_validation->set_rules('jenis_barang', 'Jenis Barang', 'required', ['required' => 'Form jenis_barang harus diisi.']);
        $this->form_validation->set_rules('merk_barang', 'Penulis', 'required', ['required' => 'Form merk_barang harus diisi.']);
        $this->form_validation->set_rules('ukuran', 'Kategori', 'required', ['required' => 'Form ukuran harus diisi.']);
        $this->form_validation->set_rules('stock', 'Stock', 'required', ['required' => 'Form stock harus diisi.']);
        $this->form_validation->set_rules('harga', 'Harga', 'required', ['required' => 'Form harga harus diisi.']);
        if ($this->form_validation->run() == true) {
            $data['jenis_barang'] = $this->input->post('jenis_barang');
            $data['merk_barang'] = $this->input->post('merk_barang');
            $data['ukuran'] = $this->input->post('ukuran');
            $data['stock'] = $this->input->post('stock');
            $data['harga'] = $this->input->post('harga');
            $this->libra_model->update_barang($data, $id);
            // Mengisi flashdata dengan perintah sesuai
            $this->session->set_flashdata('flash', 'diubah');
            redirect(base_url() . 'libra', 'refresh');
        } else {
            $title['title'] = 'Edit Barang';
            $data['libra'] = $this->libra_model->getById($id);
            $this->load->view('callbootstrap', $title);
            $this->load->view('update', $data);
        }
    }

    public function delete($id)
    {
        $this->libra_model->delete_barang($id);
        // Mengisi flashdata dengan perintah sesuai
        $this->session->set_flashdata('flash', 'dihapus');
        redirect(base_url() . 'libra', 'refresh');
    }

    public function beli($id)
    {
        $title['title'] = 'Beli Barang';
        $data['libra'] = $this->libra_model->getById($id);
        $this->load->view('callbootstrap', $title);
        $this->load->view('beli', $data);
    }

    public function beli_process()
    {
        $id = $this->input->post('id_barang');
        $jumlah = $this->input->post('jumlah');
        $jumlah_harga = $this->input->post('jumlah_harga');
        $stock = $this->input->post('stock');
        $this->session->kondisi++;

        $nama_pembeli = $this->session->nama_pembeli;
        // $jumlah_harga_temp = $this->session->jumlah_harga;

        // $this->libra_model->tambah_totalbeli($nama_pembeli, $jumlah_harga, $jumlah_harga_temp);
        // $this->libra_model->tambah_jumlahbeli($nama_pembeli, $jumlah);

        $data['id_barang']=$id;
        $data['nama_pembeli']=$nama_pembeli;
        $data['jumlah_beli']=$jumlah;
        $data['total_harga']=$jumlah_harga;
        $this->libra_model->insert_pembelian($data);

        // $stock['jumlah'] = $this->input->post('jumlah');
        $this->libra_model->kurangi_stock($id, $stock, $jumlah);
        // Mengisi flashdata dengan perintah sesuai
        $this->session->set_flashdata('flash', 'dibeli');
        redirect(base_url() . 'libra', 'refresh');
    }

    public function beli_sukses()
    {
        $nama_pembeli = $this->session->nama_pembeli;
        $this->libra_model->del_pembelian($nama_pembeli);
        $this->load->view('beli_sukses');
    }

    public function logout()
    {
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('role');
        $this->session->unset_userdata('kondisi');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil logout!</div>');
        redirect(base_url() . 'auth', 'refresh');
    }

    public function pembelian(){
        $title['title'] = 'List Pembelian';
        $nama_pembeli = $this->session->nama_pembeli;
        $data['libra'] = $this->libra_model->getPembelian($nama_pembeli);
        $this->load->view('callbootstrap', $title);
        $this->load->view('pembelian', $data);
    }
    public function mengembalikan_process()
    {
        $this->session->kondisi = 1;
        $username = $this->session->username;
        $id = $this->libra_model->getIdBuku($username);
        $stock = $this->libra_model->getStock($id);
        $this->libra_model->del_pinjam($username);
        $this->libra_model->ubah_kondisi1($username);
        $this->libra_model->tambah_stock($id, $stock);
        // Mengisi flashdata dengan perintah sesuai
        $this->session->set_flashdata('flash', 'dikembalikan');
        redirect(base_url() . 'libra', 'refresh');
    }
}
