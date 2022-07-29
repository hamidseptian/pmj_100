<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengunjung extends CI_Controller {

	public function index()
	{
		$data['pengunjung']=$this->db->query("SELECT * from pengunjung p left join pelanggan pl on pl.id_pelanggan = p.id_pelanggan")->result_array();
		$this->admin->load('admin/template','admin/form/pengunjung/data_pengunjung', $data);
	}
	public function tambah()
	{
		$data['pesanan']=$this->db->query("SELECT * from pesanan p left join produk pr on p.id_produk = pr.id_produk where p.status='Masuk Ke Keranjang'");
		$q_keranjang = $this->db->query("SELECT * from pelanggan_keranjang")->row_array();
		$data['pemesan_aktif']=$q_keranjang['id_pelanggan'] =='' ? 0 : $q_keranjang['id_pelanggan'];
		$data['kategori_pemesan_aktif']=$q_keranjang['kategori'];
		$data['pelanggan']=$this->db->query("SELECT * from pelanggan")->result_array();
		$data['produk']=$this->db->query("SELECT * from produk")->result_array();
		$this->admin->load('admin/template','admin/form/pengunjung/tambah_pengunjung', $data);
	}
	public function edit($id)
	{
		$this->db->delete('pesanan', ['status'=>'Masuk Ke Keranjang', 'id_pengunjung !='=>$id]);
		$pengunjung= $this->db->get_where('pengunjung', array('id_pengunjung' => $id))->row_array(); 
		$data['pengunjung'] = $pengunjung; 
		$data['id_pelanggan_edit'] = $pengunjung['id_pelanggan']; 
		$data['id_pengunjung'] = $pengunjung['id_pengunjung']; 
		$data['pesanan']=$this->db->query("SELECT * from pesanan p left join produk pr on p.id_produk = pr.id_produk where p.id_pengunjung='$id'");
		$q_keranjang = $this->db->query("SELECT * from pelanggan_keranjang")->row_array();
		$data['pemesan_aktif']=$q_keranjang['id_pelanggan'] =='' ? 0 : $q_keranjang['id_pelanggan'];
		$data['kategori_pemesan_aktif']=$q_keranjang['kategori'];
		$data['pelanggan']=$this->db->query("SELECT * from pelanggan")->result_array();
		$data['produk']=$this->db->query("SELECT * from produk")->result_array();
		$this->admin->load('admin/template','admin/form/pengunjung/edit_pengunjung', $data);
	}
	
	public function simpan_kategori_terpilih($kategori)
	{
		$cek = $this->db->update('pelanggan_keranjang',['kategori'=>$kategori]);
		
	}
	public function simpan()
	{
		$tgl = $this->input->post('tgl');
		$nama = $this->input->post('nama');
		$id_pelanggan = $this->input->post('id_pelanggan_pemesan');
		$kategori = $this->input->post('kategori');
		$status = "Di Proses";//$this->input->post('status');
		$poin = $this->input->post('poin');
		$total_harga = $this->input->post('total_harga');
		$jam = $this->input->post('jam');
		$data = [
			'nama_kelompok'=>$nama,
			'tgl_kunjungan'=>$tgl,
			'jam_kunjungan'=>$jam,
			'id_pelanggan'=>$id_pelanggan,
			'kategori'=>$kategori,
			'status '=>$status,
		];
		$this->db->insert('pengunjung', $data);
	     $last_insert_id = $this->db->insert_id(); 
		$data_poin = [
			'id_pelanggan'=>$id_pelanggan,
			'id_pengunjung'=>$last_insert_id,
			'tgl_kunjungan'=>$tgl,
			'jam_kunjungan'=>$jam,
			'jumlah_belanja'=>$total_harga,
			'poin'=>$poin,
			'status_poin'=>'+',
			'tgl_transaksi'=>date('Y-m-d H:i:s'),
		];
		$this->session->set_flashdata('pesan','<div class="alert alert-success">Data pengunjung berhasil ditambahkan</div>');
		$this->db->delete('pelanggan_keranjang',['id_pelanggan!='=>'']);
		$this->db->update('pesanan',['id_pengunjung'=>$last_insert_id, 'status'=>'Diproses'], ['status'=>'Masuk Ke Keranjang']);
		if ($kategori=='Pribadi') {
			$this->db->insert('transaksi_poin', $data_poin);
			redirect('user/admin/pengunjung/detail_pribadi/'.$last_insert_id);
		}else{
			redirect('user/admin/pengunjung/detail/'.$last_insert_id);

		}
	}
	public function simpanedit($id_pengunjung)
	{
		$action = $this->input->post('action');
		$tgl = $this->input->post('tgl');
		$nama = $this->input->post('nama');
		$id_pelanggan = $this->input->post('id_pelanggan_pemesan');
		$kategori = $this->input->post('kategori');
		$status = $this->input->post('status');
		$poin = $this->input->post('poin');
		$total_harga = $this->input->post('total_harga');
		$jam = $this->input->post('jam');
		$data = [
			'nama_kelompok'=>$nama,
			'tgl_kunjungan'=>$tgl,
			'jam_kunjungan'=>$jam,
			'id_pelanggan'=>$id_pelanggan,
			'kategori'=>$kategori,
			'status '=>$status,
		];
		$where = ['id_pengunjung'=>$id_pengunjung];
		$this->db->update('pengunjung', $data, $where);
	     $last_insert_id = $id_pengunjung; 
		$data_poin = [
			'id_pelanggan'=>$id_pelanggan,
			'id_pengunjung'=>$last_insert_id,
			'tgl_kunjungan'=>$tgl,
			'jam_kunjungan'=>$jam,
			'jumlah_belanja'=>$total_harga,
			'poin'=>$poin,
			'status_poin'=>'+',
			'tgl_transaksi'=>date('Y-m-d H:i:s'),
		];
		$this->session->set_flashdata('pesan','<div class="alert alert-success">Data pengunjung berhasil ditambahkan</div>');
		$this->db->delete('pelanggan_keranjang',['id_pelanggan!='=>'']);
		$this->db->update('pesanan',[ 'status'=>'Diproses'], ['id_pengunjung'=>$id_pengunjung]);
		$this->db->delete('transaksi_poin', ['id_pengunjung'=>$id_pengunjung]);
		if ($kategori=='Pribadi') {
			$this->db->insert('transaksi_poin', $data_poin);
			redirect('user/admin/pengunjung/detail/'.$last_insert_id);
		}else{
			redirect('user/admin/pengunjung/detail/'.$last_insert_id);

		}
	}
	public function masuk_ke_keranjang()
	{
		$id_pelanggan = $this->input->post('id_pelanggan_keranjang');
		$id_produk_terpilih = $this->input->post('id_produk_terpilih');
		$qty = $this->input->post('qty');
		$data = [
			'id_produk'=>$id_produk_terpilih,
			'qty'=>$qty,
			'status '=>'Masuk Ke Keranjang',
		];
		$this->db->insert('pesanan', $data);

		// $cek_pesanan=$this->db->query("SELECT id_pesanan from pesanan p where p.status='Masuk Ke Keranjang'")->num_rows();
		// if ($cek_pesanan==0) {
		// 	$this->db->insert('pelanggan_keranjang', ['id_pelanggan'=>$id_pelanggan]);
		// }
		$this->session->set_flashdata('pesan_pesanan','<div class="alert alert-success">Pesanan ditambahkan</div>');
		// echo $id_pelanggan;
		redirect('user/admin/pengunjung/tambah');
	}
	public function edit_masuk_ke_keranjang($id_pengunjung)
	{
		$id_pelanggan = $this->input->post('id_pelanggan_keranjang');
		$id_produk_terpilih = $this->input->post('id_produk_terpilih');
		$qty = $this->input->post('qty');
		$data = [
			'id_pengunjung'=>$id_pengunjung,
			'id_produk'=>$id_produk_terpilih,
			'qty'=>$qty,
			'status '=>'Masuk Ke Keranjang',
		];
		$this->db->insert('pesanan', $data);

		// $cek_pesanan=$this->db->query("SELECT id_pesanan from pesanan p where p.status='Masuk Ke Keranjang'")->num_rows();
		// if ($cek_pesanan==0) {
		// 	$this->db->insert('pelanggan_keranjang', ['id_pelanggan'=>$id_pelanggan]);
		// }
		$this->session->set_flashdata('pesan_pesanan','<div class="alert alert-success">Pesanan ditambahkan</div>');
		// echo $id_pelanggan;
		redirect('user/admin/pengunjung/edit/'.$id_pengunjung);
	}


	public function simpan_pesanan_anggota()
	{
		$id_detail_pengunjung = $this->input->post('id_detail_pengunjung_pesanan');
		$id_pengunjung = $this->input->post('id_pengunjung');
		$id_produk_terpilih = $this->input->post('id_produk');
		$qty = $this->input->post('qty');
		$data = [
			'id_pengunjung'=>$id_pengunjung,
			'id_detail_pengunjung'=>$id_detail_pengunjung,
			'id_produk'=>$id_produk_terpilih,
			'qty'=>$qty,
			'status '=>'Masuk Ke Keranjang',
		];
		$this->db->insert('pesanan', $data);

	}

	public function simpan_pesanan_pribadi()
	{
		$id_pengunjung = $this->input->post('id_pengunjung');
		$id_produk_terpilih = $this->input->post('id_produk');
		$qty = $this->input->post('qty');
		$data = [
			'id_pengunjung'=>$id_pengunjung,
			'id_produk'=>$id_produk_terpilih,
			'qty'=>$qty,
			'status '=>'Masuk Ke Keranjang',
		];
		$this->db->insert('pesanan', $data);

		redirect('user/admin/pengunjung/detail_pribadi/'.$id_pengunjung);

	}

	public function simpanedit_pesanan_pribadi()
	{
		$id_pesanan = $this->input->post('id_pesanan');
		$id_pengunjung = $this->input->post('id_pengunjung');
		$id_produk_terpilih = $this->input->post('id_produk');
		$qty = $this->input->post('qty');
		$data = [
			'id_pengunjung'=>$id_pengunjung,
			'id_produk'=>$id_produk_terpilih,
			'qty'=>$qty,
			'status '=>'Masuk Ke Keranjang',
		];
		$where = ['id_pesanan'=>$id_pesanan];
		$this->db->update('pesanan', $data, $where);

		redirect('user/admin/pengunjung/detail_pribadi/'.$id_pengunjung);

	}
	public function simpanedit_keranjang()
	{
		$id_pesanan = $this->input->post('id_pesanan');
		$id_produk_terpilih = $this->input->post('id_produk_terpilih');
		$qty = $this->input->post('qty');
		$data = [
			'id_produk'=>$id_produk_terpilih,
			'qty'=>$qty,
			'status '=>'Masuk Ke Keranjang',
		];
		$where = [
			'id_pesanan'=>$id_pesanan,
			
		];
		$this->db->update('pesanan', $data, $where);
		$this->session->set_flashdata('pesan_pesanan','<div class="alert alert-success">Pesanan ditambahkan</div>');
		redirect('user/admin/pengunjung/tambah');
	}
	public function edit_simpanedit_keranjang($id_pengunjung)
	{
		$id_pesanan = $this->input->post('id_pesanan');
		$id_produk_terpilih = $this->input->post('id_produk_terpilih');
		$qty = $this->input->post('qty');
		$data = [
			'id_produk'=>$id_produk_terpilih,
			'qty'=>$qty,
			'status '=>'Masuk Ke Keranjang',
		];
		$where = [
			'id_pesanan'=>$id_pesanan,
			
		];
		$this->db->update('pesanan', $data, $where);
		$this->session->set_flashdata('pesan_pesanan','<div class="alert alert-success">Pesanan ditambahkan</div>');
		redirect('user/admin/pengunjung/edit/'.$id_pengunjung);
	}





	public function pemesan_aktif($id)
	{
		$cek = $this->db->query("SELECT * from pelanggan_keranjang")->num_rows();
		if ($cek==0) {
			$this->db->insert('pelanggan_keranjang',['id_pelanggan'=>$id]);
		}else{
			$this->db->update('pelanggan_keranjang',['id_pelanggan'=>$id]);

		}
	}
	public function simpan_anggota_kelompok()
	{
		$id = $this->input->post('id');
		$nama = $this->input->post('nama');
		$alamat = $this->input->post('alamat');
		$nohp = $this->input->post('nohp');
		$pendidikan = $this->input->post('pendidikan');
		$produk = $this->input->post('produk');
		$qty = $this->input->post('qty');
		
		$data = [
			'id_pengunjung'=>$id,
			'nama'=>$nama,
			'alamat'=>$alamat,
			'no_hp'=>$nohp,
			'pendidikan'=>$pendidikan,
			
		];
		$this->db->insert('detail_pengunjung', $data);
         $last_insert_id = $this->db->insert_id(); 
         echo json_encode(['id_detail_pengunjung'=>$last_insert_id]);
		// redirect('user/admin/pengunjung/detail/'.$id);

	}
	public function simpan_detail()
	{
		$id = $this->input->post('id');
		$nama = $this->input->post('nama');
		$alamat = $this->input->post('alamat');
		$nohp = $this->input->post('nohp');
		$pendidikan = $this->input->post('pendidikan');
		$produk = $this->input->post('produk');
		$qty = $this->input->post('qty');
		
		$data = [
			'id_pengunjung'=>$id,
			'nama'=>$nama,
			'alamat'=>$alamat,
			'no_hp'=>$nohp,
			'pendidikan'=>$pendidikan,
			'id_produk'=>$produk,
			
		];
		$this->db->insert('detail_pengunjung', $data);


         $last_insert_id = $this->db->insert_id(); 
         $data_pesanan = [
			'id_pengunjung'=>$id,
			'id_detail_pengunjung'=>$last_insert_id,
			'id_produk'=>$produk,
			'qty'=>$qty,
		];
		$this->db->insert('pesanan', $data_pesanan);
		$this->session->set_flashdata('pesan','<div class="alert alert-success">Data detail pengunjung berhasil ditambahkan</div>');
		redirect('user/admin/pengunjung/detail/'.$id);
	}

	public function simpan_tambah_menu()
	{
		$id = $this->input->post('id');
		$id_pengunjung = $this->input->post('id_pengunjung');
		
		$produk = $this->input->post('produk');
		$qty = $this->input->post('qty');
		
	
         $data_pesanan = [
			'id_pengunjung'=>$id_pengunjung,
			'id_detail_pengunjung'=>$id,
			'id_produk'=>$produk,
			'qty'=>$qty,
		];
		$this->db->insert('pesanan', $data_pesanan);
		$this->session->set_flashdata('pesan','<div class="alert alert-success">Data detail pengunjung berhasil ditambahkan</div>');
		redirect('user/admin/pengunjung/detail/'.$id_pengunjung);
	}


	public function pesanan_anggota_kelompok($id)
	{
		
		$anggota = $this->db->get_where('detail_pengunjung', array('id_detail_pengunjung' => $id))->row_array(); 
		echo json_encode($anggota);
	}
	public function list_pesanan_anggota_kelompok($id)
	{
		
		$pesanan = $this->db->query("SELECT p.*, pr.* from pesanan p 
			left join produk pr on p.id_produk = pr.id_produk where p.id_detail_pengunjung='$id'")->result_array(); 
		echo json_encode($pesanan);
	}
	public function detail($id)
	{
		$pengunjung = $this->db->query("SELECT p.*, pl.nama, pl.nohp from pengunjung p left join pelanggan pl on p.id_pelanggan=p.id_pelanggan where p.id_pengunjung='$id'")->row_array(); 
		$data['pengunjung'] = $pengunjung;
		$data['produk'] = $this->db->get('produk')->result_array(); 
		$data['id_pelanggan'] = $pengunjung['id_pelanggan']; 
		$data['detail_pengunjung'] = $this->db->query("
			SELECT dp.*, p.nama_produk from detail_pengunjung dp
			left join produk p on dp.id_produk=p.id_produk
			where dp.id_pengunjung = '$id'
			")->result_array(); 
		$this->admin->load('admin/template','admin/form/pengunjung/detail_pengunjung', $data);
	}


	public function print_pesanan_kelompok($id)
	{
		$pengunjung = $this->db->query("SELECT p.*, pl.nama, pl.nohp from pengunjung p left join pelanggan pl on p.id_pelanggan=p.id_pelanggan where p.id_pengunjung='$id'")->row_array(); 
		$pesanan = $this->db->query("SELECT * from pesanan p left join produk pr on p.id_produk=pr.id_produk where p.id_pengunjung='$id' group by p.id_produk order by p.id_produk "); 
		$produk = $this->db->query("SELECT * from produk")->result_array(); 
		$tinggi_satuan_item = $this->db->get('tabel_bantu')->row_array()['ukuran_kertas_item'];
		$tinggi_header = 72;
		$tinggi_footer = 35;
		$tinggi_total_belanja = 20;
		$height_mpdf = $tinggi_header + $tinggi_footer + ($tinggi_satuan_item * $pesanan->num_rows()) + $tinggi_total_belanja;
		$data['pengunjung'] = $pengunjung;
		$data['pesanan'] = $pesanan->result_array();
		$data['produk'] = $pesanan->result_array();
		$data['id_pengunjung'] = $id; 
		// $data['produk'] = $this->db->get('produk')->result_array(); 
		$data['id_pelanggan'] = $pengunjung['id_pelanggan']; 
		$data['detail_pengunjung'] = $this->db->query("
			SELECT dp.*, p.nama_produk from detail_pengunjung dp
			left join produk p on dp.id_produk=p.id_produk
			where dp.id_pengunjung = '$id'
			")->result_array(); 
		// $this->admin->load('admin/template','admin/form/pengunjung/print_pesanan_kelompok', $data);

	    $html =  $this->load->view('admin/form/pengunjung/print_pesanan_kelompok', $data, true);
		$mpdf = new \Mpdf\Mpdf([
				'mode' => 'utf-8',
				'format' => [80,$height_mpdf],
				// 'orientation' => 'P',
				'tempDir' => '/tmp',


				'margin_top' => 3,
				'margin_bottom' => 3,
				'margin_left' => 4,
				'margin_right' => 4,
			]);
		   $mpdf->SetHTMLHeader($header);
		$mpdf->WriteHTML($html);
		$mpdf->Output('Faktur.pdf', 'I');
	}

	public function detail_pribadi($id)
	{
		$pengunjung = $this->db->query("SELECT p.*, pl.nama, pl.nohp from pengunjung p left join pelanggan pl on p.id_pelanggan=p.id_pelanggan where p.id_pengunjung='$id'")->row_array(); 
		$data['pesanan']=$this->db->query("SELECT * from pesanan p left join produk pr on p.id_produk = pr.id_produk where p.id_pengunjung='$id'");
		
		$data['pengunjung'] = $pengunjung;
		$data['produk'] = $this->db->get('produk')->result_array(); 
		$data['id_pelanggan'] = $pengunjung['id_pelanggan']; 
		$data['detail_pengunjung'] = $this->db->query("
			SELECT dp.*, p.nama_produk from detail_pengunjung dp
			left join produk p on dp.id_produk=p.id_produk
			where dp.id_pengunjung = '$id'
			")->result_array(); 
		$this->admin->load('admin/template','admin/form/pengunjung/detail_pengunjung_pribadi', $data);
	}

	public function konfirmasi_pesanan_kelompok($id)
	{
		$poin = $this->input->post('poin_didapatkan_kunjungan');
		$belanja = $this->input->post('total_belanja_kunjungan');
		$id_pelanggan = $this->input->post('id_pelanggan');
		$tgl_kunjungan = $this->input->post('tgl_kunjungan');
		$jam_kunjungan = $this->input->post('jam_kunjungan');
		$status = "Dalam Proses";

		$data_poin = [
			'id_pengunjung'=>$id,
			'id_pelanggan'=>$id_pelanggan,
			'tgl_kunjungan'=>$tgl_kunjungan,
			'jam_kunjungan'=>$jam_kunjungan,
			'jumlah_belanja'=>$belanja,
			'poin'=>$poin,
			'status_poin'=>'+',
			'tgl_transaksi'=>date('Y-m-d H:i:s'),
		];
		$where_poin = [
			'id_pengunjung'=>$id,
			'id_pelanggan'=>$id_pelanggan,
		];

		$cek_transaksi_sebelumnya = $this->db->get_where('transaksi_poin', $where_poin)->num_rows();
		if ($cek_transaksi_sebelumnya>0) {
			$this->db->delete('transaksi_poin',$where_poin);
		}

		
		$data = ['status'=>'Diproses'];
		$where = ['status'=>'Masuk Ke Keranjang','id_pengunjung'=>$id];

		$data_pengunjung = ['status'=>$status];
		$where_pengunjung = ['id_pengunjung'=>$id];
		$this->db->update('pengunjung', $data_pengunjung, $where_pengunjung);
		$this->db->update('pesanan', $data, $where);
		$this->db->insert('transaksi_poin', $data_poin);

		redirect('user/admin/pengunjung/detail/'.$id);
	}
	public function konfirmasi_pesanan_pribadi($id, $id_pelanggan)
	{
		// error ;
		$poin = $this->input->get('poin_didapatkan_kunjungan');
		$belanja = $this->input->get('total_belanja_kunjungan');
		echo $belanja;
		
		$tgl_kunjungan = $this->input->get('tgl_kunjungan');
		$jam_kunjungan = $this->input->get('jam_kunjungan');
		$status = "Dalam Proses";
		$data_poin = [
			'id_pengunjung'=>$id,
			'id_pelanggan'=>$id_pelanggan,
			'tgl_kunjungan'=>$tgl_kunjungan,
			'jam_kunjungan'=>$jam_kunjungan,
			'jumlah_belanja'=>$belanja,
			'poin'=>$poin,
			'status_poin'=>'+',
			'tgl_transaksi'=>date('Y-m-d H:i:s'),
		];
		$where_poin = [
			'id_pengunjung'=>$id,
			'id_pelanggan'=>$id_pelanggan,
		];

		$cek_transaksi_sebelumnya = $this->db->get_where('transaksi_poin', $where_poin)->num_rows();
		if ($cek_transaksi_sebelumnya>0) {
			$this->db->delete('transaksi_poin',$where_poin);
		}

		$data = ['status'=>'Diproses'];
		$where = ['status'=>'Masuk Ke Keranjang','id_pengunjung'=>$id];

		$data_pengunjung = ['status'=>$status];
		$where_pengunjung = ['id_pengunjung'=>$id];
		$this->db->update('pengunjung', $data_pengunjung, $where_pengunjung);
		$this->db->update('pesanan', $data, $where);
		$this->db->insert('transaksi_poin', $data_poin);

		redirect('user/admin/pengunjung/detail_pribadi/'.$id);
	}
	public function akhiri_pesanan_kelompok($id)
	{
		$status = "Selesai";
		$where = ['status'=>'Masuk Ke Keranjang','id_pengunjung'=>$id];

		$data_pengunjung = ['status'=>$status];
		$where_pengunjung = ['id_pengunjung'=>$id];
		$this->db->update('pengunjung', $data_pengunjung, $where_pengunjung);
		$this->db->delete('pesanan', $where);

		redirect('user/admin/pengunjung/detail/'.$id);
	}
	public function akhiri_pesanan_pribadi($id)
	{
		$status = "Selesai";
		$where = ['status'=>'Masuk Ke Keranjang','id_pengunjung'=>$id];

		$data_pengunjung = ['status'=>$status];
		$where_pengunjung = ['id_pengunjung'=>$id];
		$this->db->update('pengunjung', $data_pengunjung, $where_pengunjung);
		$this->db->update('pesanan', $data_pengunjung, $where_pengunjung);
		$this->db->delete('pesanan', $where);

		redirect('user/admin/pengunjung/detail_pribadi/'.$id);
	}


	public function data_anggota_kelompok($id)
	{
		 
		$data = $this->db->query("
			SELECT dp.*, p.nama_produk from detail_pengunjung dp
			left join produk p on dp.id_produk=p.id_produk
			where dp.id_pengunjung = '$id'
			")->result_array(); 

		$kumpul_anggota = [];
		foreach ($data as $k => $v) {
			$id_anggota = $v['id_detail_pengunjung'];

			$produk_dipesan_anggota = $this->db->query("SELECT * from pesanan p 
				left join produk pr on p.id_produk=pr.id_produk where p.id_detail_pengunjung='$id_anggota'");
			$total_belanja = 0;
			$total_poin = 0;
			$kumpul_pesanan = [];
			foreach ($produk_dipesan_anggota->result_array() as $k_pesanan => $v_pesanan) {
				$qty = $v_pesanan['qty'];
				$harga = $v_pesanan['harga'];
				$belanja = $qty * $harga ; 
				$poin = $qty * $v_pesanan['poin'] ; 
				$total_belanja += $belanja;
				$total_poin += $poin;
				$data_pesanan = [
					'produk'=>$v_pesanan['nama_produk'],
					'qty'=>$v_pesanan['qty'],
					'status'=>$v_pesanan['status'],
				];
				array_push($kumpul_pesanan, $data_pesanan);
			}
			$data_anggota = [
				'id_detail_pengunjung' =>$v['id_detail_pengunjung'],
				'nama' =>$v['nama'],
				'alamat' =>$v['alamat'],
				'nohp' =>$v['no_hp'],
				'pendidikan' =>$v['pendidikan'],
				'total_belanja' =>$total_belanja,
				'total_poin' =>$total_poin,
				'pesanan' =>$produk_dipesan_anggota->num_rows() == 0 ? 'Belum ada pesanan' : $kumpul_pesanan,
				'banyak_data_pesanan' =>$produk_dipesan_anggota->num_rows(),
			];
			array_push($kumpul_anggota,$data_anggota);
		}
		echo json_encode($kumpul_anggota);
		header('Content-Type: application/json');
	}
	public function hapus_anggota_kelompok($id)
	{
		 
		$data = $this->db->query("
			DELETE from detail_pengunjung
			where id_detail_pengunjung = '$id'
			");
		$data = $this->db->query("
			DELETE from pesanan
			where id_detail_pengunjung = '$id'
			");
	}
	public function hapus_pesanan_anggota($id)
	{
		 
		$data = $this->db->query("
			DELETE from pesanan
			where id_pesanan = '$id'
			");
	}

	// public function simpanedit()
	// {
	// 	$id = $this->input->post('id');
	// 	$tgl = $this->input->post('tgl');
	// 	$nama = $this->input->post('nama');
	// 	$pj = $this->input->post('pj');
	// 	$nohp_pj = $this->input->post('nohp_pj');
	// 	$status = $this->input->post('status');
	// 	$data = [
	// 		'nama_kelompok'=>$nama,
	// 		'tgl_kunjungan'=>$tgl,
	// 		'pj'=>$pj,
	// 		'nohp_pj'=>$nohp_pj,
	// 		'status '=>$status,
	// 	];
	// 	$where = [
	// 		'id_pengunjung'=>$id
	// 	];
	// 	$this->db->update('pengunjung', $data, $where);
	// 	$this->session->set_flashdata('pesan','<div class="alert alert-success">Data pengunjung berhasil diperbaharui</div>');
	// 	redirect('user/admin/pengunjung');
	// }
	public function hapus($id)
	{
		$this->db->delete('pengunjung', array('id_pengunjung' => $id)); 
		$this->db->delete('pesanan', array('id_pengunjung' => $id)); 
		$this->db->delete('detail_pengunjung', array('id_pengunjung' => $id)); 
			$this->session->set_flashdata('pesan','<div class="alert alert-success">Data pengunjung berhasil dihapus</div>');
		redirect('user/admin/pengunjung');
	}
	public function hapus_pesanan($id, $action, $id_pengunjung='')
	{
		$this->db->delete('pesanan', array('id_pesanan' => $id)); 
			$this->session->set_flashdata('pesan_pesanan','<div class="alert alert-success">Pesanan dihapus</div>');
		if ($action=='tambah') {
			redirect('user/admin/pengunjung/tambah');
			# code...
		}
		if ($action=='detail') {
			redirect('user/admin/pengunjung/detail_pribadi/'.$id_pengunjung);
			# code...
		}else{
			redirect('user/admin/pengunjung/edit/'.$id_pengunjung);

		}
	}
}
