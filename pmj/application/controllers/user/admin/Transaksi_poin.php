<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi_poin extends CI_Controller {

	public function index()
	{
		$data['transaksi_poin']=$this->db->query("SELECT * from transaksi_poin tp
			left join pelanggan p on tp.id_pelanggan = p.id_pelanggan
			group by tp.id_pelanggan
			")->result_array();
		$this->admin->load('admin/template','admin/form/transaksi_poin/data_transaksi_poin', $data);
	}
	public function tambah()
	{
		
		$this->admin->load('admin/template','admin/form/transaksi_poin/tambah_transaksi_poin');
	}
	
	
	

	public function riwayat($id)
	{
		
		$data['transaksi_poin'] = $this->db->query("SELECT tp.*, itp.nama_item_tukar_poin, itp.poin as poin_dibutuhkan from transaksi_poin tp left join item_tukar_poin itp on tp.id_item_tukar_poin = itp.id_item_tukar_poin where tp.id_pelanggan='$id'")->result_array(); 
		$data['item_tukar_poin'] = $this->db->query("SELECT * from item_tukar_poin")->result_array(); 
		$data['id_pelanggan'] =$id; 
		$this->admin->load('admin/template','admin/form/transaksi_poin/riwayat_transaksi_poin', $data);
	}
	public function detail_item($id)
	{
		
		$data = $this->db->query("SELECT * from item_tukar_poin where id_item_tukar_poin='$id'")->row_array(); 
		echo json_encode($data);
	}

	public function simpan_transaksi_penukaran()
	{
			$id_item_terpilih = $this->input->post('id_item_terpilih');
			$qty = $this->input->post('qty');
			$id_pelanggan = $this->input->post('id_pelanggan');

			$data_poin = [
			'id_pelanggan'=>$id_pelanggan,
			'status_poin'=>'-',
			'id_item_tukar_poin'=>$id_item_terpilih,
			'qty'=>$qty,
			'tgl_transaksi'=>date('Y-m-d H:i:s'),
		];
		$this->db->insert('transaksi_poin', $data_poin);
			
	}
}
