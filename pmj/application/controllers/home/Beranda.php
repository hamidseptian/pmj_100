<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Beranda extends CI_Controller {

	public function index()
	{
		$this->load->view('beranda');
	}
	public function login()
	{
		$this->load->view('home/form/login/login_admin');
		// $data['judul_konten'] = "Login";
		// 		$data['menu'] = "Login";
		// 		$this->template->load('template/home','home/form/pendaftaran/pendaftaran', $data);
	}

	public function produk()
	{
		$data['produk'] = $this->db->get('produk');
		$this->load->view('home/form/produk/produk', $data);
		// $data['judul_konten'] = "Login";
		// 		$data['menu'] = "Login";
		// 		$this->template->load('template/home','home/form/pendaftaran/pendaftaran', $data);
	}


	public function proseslogin_admin(){
		$username = $this->input->post('username');
		//$pass = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
		$pass=$this->input->post('password');
		$level=$this->input->post('level');

			if ($level=='PMJ') {
				$tabel = 'pmj';
				$hak_akses = 'PMJ';
			}else{
				$tabel = 'admin';
				$hak_akses = 'Admin';

			}
			$user= $this->db->get_where($tabel, ['email'=>$username])->row_array();
			if ($user) {
				$pasword_tersimpan = $user['password'];
				//$verivikasi=password_verify($pass, $pasword_tersimpan);
			
				if ($pasword_tersimpan == $pass) {
					$data_session = [
						'status' => "login",
						'level'=>$hak_akses,
						'nama_user'=>$user['nama'],
						'id_user'=>$user['id']
					];
 					$this->session->set_userdata($data_session);
					redirect('user/admin/dashboard');
				}
				else{
					$this->session->set_flashdata('pesan','<div class="alert alert-danger">Password salah</div>');
					redirect('home/beranda/login');
					
				}

			}
			else{
				$this->session->set_flashdata('pesan','<div class="alert alert-danger">Username dan password salah</div>');
				redirect('home/beranda/login');
			}
	}


	public function logout(){
		$this->session->sess_destroy();
		redirect('home/beranda');
	}
}
