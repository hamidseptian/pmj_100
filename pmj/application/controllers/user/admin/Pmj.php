<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pmj extends CI_Controller {

	public function index()
	{
		$data['pmj']=$this->db->query("SELECT * from pmj")->result_array();
		$this->admin->load('admin/template','admin/form/pmj/data_pmj', $data);
	}
	public function tambah()
	{
		
		$this->admin->load('admin/template','admin/form/pmj/tambah_pmj');
	}
	
	
	 public function simpan(){
 		
	 	
			$nama = $this->input->post('nama');
			$jabatan = $this->input->post('jabatan');
			$alamat = $this->input->post('alamat');
			$nohp = $this->input->post('nohp');
			$email = $this->input->post('email');
			$password = $this->input->post('password');

			$datainput = [
				'nama'=>$nama,
				'alamat'=>$jabatan,
				'nohp'=>$alamat,
				'jabatan'=>$nohp,
				'email'=>$email,
				'password'=>$password,
				
				
				];

				$this->db->insert('pmj',$datainput);
				  $this->session->set_flashdata('pesan','<div class="alert alert-success alert-dismissible">
	                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	                
	               Data pmj disimpan
	              </div>');
	          redirect('user/admin/pmj');
	}

	public function edit($id)
	{
		
		$data['pmj'] = $this->db->get_where('pmj', array('id' => $id))->row_array(); 
		$this->admin->load('admin/template','admin/form/pmj/edit_pmj', $data);
	}

	
	 public function simpanedit(){
 		
	 	
	     
			$id = $this->input->post('id');
			$nama = $this->input->post('nama');
			$jabatan = $this->input->post('jabatan');
			$alamat = $this->input->post('alamat');
			$nohp = $this->input->post('nohp');
			$email = $this->input->post('email');
			$password = $this->input->post('password');

			
			$where = [
				'id'=>$id,
				
				];
	       // echo $namabaru;
	         $config['file_name']  = $namabaru;
	          $this->load->library('upload', $config);
	 

	 			$datainput = [
					'nama'=>$nama,
					'alamat'=>$alamat,
					'nohp'=>$nohp,
					'jabatan'=>$jabatan,
					'email'=>$email,
					'password'=>$password,
				];
	 			 $this->db->update('pmj',$datainput, $where);

	 			    $this->session->set_flashdata('pesan','<div class="alert alert-success alert-dismissible">
			                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			                
			               Data pmj diperbaharui
			              </div>');

	 		
			          redirect('user/admin/pmj');
	      
	}
	public function hapus($id)
	{
		$this->db->delete('pmj', array('id' => $id)); 
			$this->session->set_flashdata('pesan','<div class="alert alert-success">Data pmj berhasil dihapus</div>');
		redirect('user/admin/pmj');
	}
}
