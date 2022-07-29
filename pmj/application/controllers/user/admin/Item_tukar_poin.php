<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Item_tukar_poin extends CI_Controller {

	public function index()
	{
		$data['item_tukar_poin']=$this->db->query("SELECT * from item_tukar_poin")->result_array();
		$this->admin->load('admin/template','admin/form/item_tukar_poin/data_item_tukar_poin', $data);
	}
	public function tambah()
	{
		
		$this->admin->load('admin/template','admin/form/item_tukar_poin/tambah_item_tukar_poin');
	}
	
	
	 public function simpan(){
 		
	     
			$item_tukar_poin = $this->input->post('item_tukar_poin');
			$poin = $this->input->post('poin');
			$keterangan = $this->input->post('keterangan');

			$datainput = [
				'nama_item_tukar_poin'=>$item_tukar_poin,
				'keterangan'=>$keterangan,
				'poin'=>$poin,
				
				];
	   
	                $this->session->set_flashdata('pesan','<div class="alert alert-success alert-dismissible">
	                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	                
	               Data disimpan
	              </div>');
 
	             $this->db->insert('item_tukar_poin',$datainput);
	           
	          redirect('user/admin/item_tukar_poin');
	}

	public function edit($id)
	{
		
		$data['item_tukar_poin'] = $this->db->get_where('item_tukar_poin', array('id_item_tukar_poin' => $id))->row_array(); 
		$this->admin->load('admin/template','admin/form/item_tukar_poin/edit_item_tukar_poin', $data);
	}

	
	 public function simpanedit(){
 		
	 	
	     
			$item_tukar_poin = $this->input->post('item_tukar_poin');
			$biaya = $this->input->post('biaya');
			$id = $this->input->post('id');
			$filelama = $this->input->post('filelama');
			$keterangan = $this->input->post('keterangan');
			$satuan = $this->input->post('satuan');
			$poin = $this->input->post('poin');
	
			
			$where = [
				'id_item_tukar_poin'=>$id,
				
				];
	       // echo $namabaru;
	         $config['file_name']  = $namabaru;
	          $this->load->library('upload', $config);
	 

	 			$datainput = [
					'nama_item_tukar_poin'=>$item_tukar_poin,
					'keterangan'=>$keterangan,
					'poin'=>$poin,
					
				];
	 			
			                $this->session->set_flashdata('pesan','<div class="alert alert-success alert-dismissible">
			                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			                
			               Data diperbaharui
			              </div>');
			             $this->db->update('item_tukar_poin',$datainput, $where);
	 		
			          redirect('user/admin/item_tukar_poin');
	      
	}
	public function hapus($id)
	{
		$this->db->delete('item_tukar_poin', array('id_item_tukar_poin' => $id)); 
			$this->session->set_flashdata('pesan','<div class="alert alert-success">Data berhasil dihapus</div>');
		redirect('user/admin/item_tukar_poin');
	}
}
