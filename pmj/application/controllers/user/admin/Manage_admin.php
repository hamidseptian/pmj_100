<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manage_admin extends CI_Controller {

	public function index()
	{
		$data['admin']=$this->db->query("SELECT * from admin")->result_array();
		$this->admin->load('admin/template','admin/form/admin/data_admin', $data);
	}
	public function tambah()
	{
		
		$this->admin->load('admin/template','admin/form/admin/tambah_admin');
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
				$this->db->insert('admin',$datainput);
	      

	         $this->session->set_flashdata('pesan','<div class="alert alert-success alert-dismissible">
	                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	                
	               Data admin disimpan
	              </div>');
	          redirect('user/admin/manage_admin');
	}

	public function edit($id)
	{
		
		$data['admin'] = $this->db->get_where('admin', array('id' => $id))->row_array(); 
		$this->admin->load('admin/template','admin/form/admin/edit_admin', $data);
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
	 			$datainput = [
					'nama'=>$nama,
					'alamat'=>$alamat,
					'nohp'=>$nohp,
					'jabatan'=>$jabatan,
					'email'=>$email,
					'password'=>$password,
				];
	 			 $this->db->update('admin',$datainput, $where);

	 			    $this->session->set_flashdata('pesan','<div class="alert alert-success alert-dismissible">
			                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			                
			               Data admin diperbaharui
			              </div>');

	 		
			          redirect('user/admin/manage_admin');
	      
	}
	public function hapus($id)
	{
		$this->db->delete('admin', array('id' => $id)); 
			$this->session->set_flashdata('pesan','<div class="alert alert-success">Data admin berhasil dihapus</div>');
		redirect('user/admin/manage_admin');
	}
}
