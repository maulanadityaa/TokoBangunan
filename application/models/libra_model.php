<?php defined('BASEPATH') or exit('No direct script access allowed');
class libra_model extends CI_Model
{

    public function getAllDat()
    {
        $this->db->select('*');
        $this->db->from('barang');
        $this->db->where('stock >', 0);
        $query = $this->db->get();
        return $query->result();
    }

    public function getById($id_barang)
    {
        return $this->db->get_where('barang', ["id_barang" => $id_barang])->result();
    }

    public function getMaxId()
    {
        $this->db->select_max('id_barang');
        $this->db->from('barang');
        $query = $this->db->get();
        return $query->result();
    }

    public function insert_barang($data)
    {
        $this->db->insert('barang', $data);
    }

    public function update_barang($data, $id_barang)
    {
        $this->db->update('barang', $data, array('id_barang' => $id_barang));
    }

    public function delete_barang($id_barang)
    {
        $this->db->delete('barang', array('id_barang' => $id_barang));
    }

    public function insert_pinjam($data)
    {
        $this->db->insert('pinjam', $data);
    }

    public function ubah_kondisi($username)
    {
        $this->db->set('kondisi', 0);
        $this->db->where('username', $username);
        $this->db->update('user');
    }

    public function del_pinjam($username)
    {
        $this->db->delete('pinjam', array('username' => $username));
    }

    public function ubah_kondisi1($username)
    {
        $this->db->set('kondisi', 1);
        $this->db->where('username', $username);
        $this->db->update('user');
    }

    public function tambah_stock($id, $stock)
    {
        $temp = $stock + 1;
        $this->db->set('stock', $temp);
        $this->db->where('id_barang', $id);
        $this->db->update('barang');
    }

    // Function cari buku
    public function cariBuku()
    {
        $keyword = $this->input->post('keyword', true);
        $this->db->like('kategori', $keyword);
        return $this->db->get('buku')->result();
    }

    public function getPembelian($nama_pembeli){
        $this->db->select("*");
        $this->db->from('pembelian');
        $this->db->where('nama_pembeli =', $nama_pembeli);
        $this->db->join('barang', 'barang.id_barang = pembelian.id_barang');
        // $query = $this->db->get_where('pembelian', ["nama_pembeli" => $nama_pembeli])->row();
        $query = $this->db->get()->result();
        // return $this->db->get_where('barang', ["id_barang" => $query->id_barang] )->result();
        return $query;
    }

    public function getIdBuku($username)
    {
        $query = $this->db->get_where('pinjam', ["username" => $username])->row();
        return $query->id_buku;
    }

    public function getStock($id)
    {
        $query = $this->db->get_where('buku', ["id_buku" => $id])->row();
        return $query->stock; 
    }

    public function tambah_totalbeli($nama_pembeli, $jumlah_harga, $jumlah_harga_temp)
    {
        $temp = $jumlah_harga_temp + $jumlah_harga;
        $this->db->set('total_harga', $temp);
        $this->db->where('nama_pembeli', $nama_pembeli);
        $this->db->update('pembelian');
    }

    public function tambah_jumlahbeli($nama_pembeli, $jumlah)
    {
        
        $this->db->set('jumlah_beli', $jumlah);
        $this->db->where('nama_pembeli', $nama_pembeli);
        $this->db->update('pembelian');
    }

    public function insert_pembelian($data)
    {
        $this->db->insert('pembelian', $data);
    }

    public function del_pembelian($nama_pembeli)
    {
        $this->db->where('nama_pembeli', $nama_pembeli);
        return $this->db->delete('pembelian');
    }

    public function kurangi_stock($id, $stock, $jumlah)
    {
        $temp = $stock - $jumlah;
        $this->db->set('stock', $temp);
        $this->db->where('id_barang', $id);
        $this->db->update('barang');
    }

    public function getAllSup()
    {
        $this->db->select('*');
        $this->db->from('supplier');
        $query = $this->db->get();
        return $query->result();
    }
}
