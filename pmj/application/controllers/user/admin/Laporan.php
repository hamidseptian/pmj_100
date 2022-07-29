<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class laporan extends CI_Controller {

public function __construct()
    {
        parent::__construct();
        error_reporting(0);
    }

// public function penjualan()
// 	{
// 		$q_faktur = $this->db->query("SELECT p.*, 
// 			pl.nama, pl.nohp, 
// 			pg.kategori,pg.tgl_kunjungan,pg.nama_kelompok,
// 			dp.nama as nama_anggota,

// 			pr.harga
// 			from pesanan p
// 			left join produk pr on p.id_produk = pr.id_produk
// 			left join pengunjung pg on p.id_pengunjung = pg.id_pengunjung
// 			left join detail_pengunjung dp on p.id_detail_pengunjung = dp.id_detail_pengunjung
// 			left join pelanggan pl on pg.id_pelanggan = pl.id_pelanggan
// 			")->result_array();
// 		$data['periode_penjualan'] ='Semua Data';
// 		$data['faktur'] =$q_faktur;
// 		$this->admin->load('admin/template','admin/form/laporan/penjualan', $data);

		
// 	}
public function penjualan()
	{
		$pilihan_bulan = array("01"=>"Januari", "02"=>"Februari", "03"=>"Maret", "04"=>"April", "05"=>"Mei", "06"=>"Juni", "07"=>"Juli", "08"=>"Agustus", "09"=>"September", "10"=>"Oktober", "11"=>"November", "12"=>"Desember");
		$data['pilihan_bulan'] = $pilihan_bulan;
		if (isset($_GET['tipe'])) {
			$tipe = $_GET['tipe'];
			if ($tipe=='periode') {
				$tgl_awal = $_GET['tgl_awal'].' 00:00:00';
				$tgl_akhir = $_GET['tgl_akhir'].' 23:59:59';
				$where = "where p.waktu_pesan between '$tgl_awal' and  '$tgl_akhir'";
				$print = "?tgl_awal=".$tgl_awal."&tgl_akhir=".$tgl_akhir."&tipe=periode";
				$caption_filter = 'Periode '.$_GET['tgl_awal'].' sampai '.$_GET['tgl_akhir'];
			}else{
				$bulan = $_GET['bulan'];
				$tahun = $_GET['tahun'];
				$where = "where month(p.waktu_pesan)='$bulan' and year(p.waktu_pesan)='$tahun'";
				$print = "?bulan=".$bulan."&tahun=".$tahun."&tipe=bulanan";
				$caption_filter = ' '.$pilihan_bulan[$bulan].' '.$_GET['tahun'];

			}
		}else{
			$print = "";
			$caption_filter = "Semua Data";
			$where = "";
		}
		$q_faktur = $this->db->query("SELECT p.*, 
			pl.nama, pl.nohp, 
			pg.kategori,pg.tgl_kunjungan,pg.nama_kelompok,
			dp.nama as nama_anggota,

			pr.nama_produk, pr.harga
			from pesanan p
			left join produk pr on p.id_produk = pr.id_produk
			left join pengunjung pg on p.id_pengunjung = pg.id_pengunjung
			left join detail_pengunjung dp on p.id_detail_pengunjung = dp.id_detail_pengunjung
			left join pelanggan pl on pg.id_pelanggan = pl.id_pelanggan
			$where
			")->result_array();
		$data['print'] =$print;
		$data['periode_penjualan'] = $caption_filter;
		$data['faktur'] =$q_faktur;
		$this->admin->load('admin/template','admin/form/laporan/penjualan', $data);

		
	}
	
public function visit()
	{
		$pilihan_bulan = array("01"=>"Januari", "02"=>"Februari", "03"=>"Maret", "04"=>"April", "05"=>"Mei", "06"=>"Juni", "07"=>"Juli", "08"=>"Agustus", "09"=>"September", "10"=>"Oktober", "11"=>"November", "12"=>"Desember");
		$data['pilihan_bulan'] = $pilihan_bulan;
		if (isset($_GET['tipe'])) {
			$tipe = $_GET['tipe'];
			if ($tipe=='periode') {
				$tgl_awal = $_GET['tgl_awal'].' 00:00:00';
				$tgl_akhir = $_GET['tgl_akhir'].' 23:59:59';
				$where = "where pg.tgl_kunjungan between '$tgl_awal' and  '$tgl_akhir'";
				$print = "?tgl_awal=".$tgl_awal."&tgl_akhir=".$tgl_akhir."&tipe=periode";
				$caption_filter = 'Periode '.$_GET['tgl_awal'].' sampai '.$_GET['tgl_akhir'];
			}else{
				$bulan = $_GET['bulan'];
				$tahun = $_GET['tahun'];
				$where = "where month(pg.tgl_kunjungan)='$bulan' and year(pg.tgl_kunjungan)='$tahun'";
				$print = "?bulan=".$bulan."&tahun=".$tahun."&tipe=bulanan";
				$caption_filter = ' '.$pilihan_bulan[$bulan].' '.$_GET['tahun'];

			}
		}else{
			$print = "";
			$caption_filter = "Semua Data";
			$where = "";
		}
		$q_faktur = $this->db->query("SELECT pg.*, 
			pl.nama, pl.nohp
			
			from pengunjung pg 
			left join pelanggan pl on pg.id_pelanggan = pl.id_pelanggan
			$where
			")->result_array();
		$data['periode_penjualan'] =$caption_filter	;
		$data['faktur'] =$q_faktur;
		$data['print'] =$print;
		$this->admin->load('admin/template','admin/form/laporan/visit', $data);

		
	}


public function poin()
	{
		$pilihan_bulan = array("01"=>"Januari", "02"=>"Februari", "03"=>"Maret", "04"=>"April", "05"=>"Mei", "06"=>"Juni", "07"=>"Juli", "08"=>"Agustus", "09"=>"September", "10"=>"Oktober", "11"=>"November", "12"=>"Desember");
		$data['pilihan_bulan'] = $pilihan_bulan;
		if (isset($_GET['tipe'])) {
			$tipe = $_GET['tipe'];
			if ($tipe=='periode') {
				$tgl_awal = $_GET['tgl_awal'].' 00:00:00';
				$tgl_akhir = $_GET['tgl_akhir'].' 23:59:59';
				$where = "where tp.tgl_transaksi between '$tgl_awal' and  '$tgl_akhir'";
				$print = "?tgl_awal=".$tgl_awal."&tgl_akhir=".$tgl_akhir."&tipe=periode";
				$caption_filter = 'Periode '.$_GET['tgl_awal'].' sampai '.$_GET['tgl_akhir'];
			}else{
				$bulan = $_GET['bulan'];
				$tahun = $_GET['tahun'];
				$where = "where month(tp.tgl_transaksi)='$bulan' and year(tp.tgl_transaksi)='$tahun'";
				$print = "?bulan=".$bulan."&tahun=".$tahun."&tipe=bulanan";
				$caption_filter = ' '.$pilihan_bulan[$bulan].' '.$_GET['tahun'];

			}
		}else{
			$print = "";
			$caption_filter = "Semua Data";
			$where = "";
		}
		$q_transaksi = $this->db->query("SELECT tp.*, 
			itp.nama_item_tukar_poin, itp.poin as poin_dibutuhkan,
			p.nama, p.nohp
			
			from transaksi_poin tp 
			left join item_tukar_poin itp on tp.id_item_tukar_poin = itp.id_item_tukar_poin
			left join pelanggan p on tp.id_pelanggan = p.id_pelanggan
			$where
			")->result_array();
		$data['periode_poin'] =$caption_filter	;
		$data['transaksi'] =$q_transaksi;
		$data['print'] =$print;
		$this->admin->load('admin/template','admin/form/laporan/poin', $data);

		
	}


	public function print_laporan_penjualan()
	{
		$level = $this->session->userdata('level');
		$mpdf = new \Mpdf\Mpdf([
		    'mode' => 'utf-8',
		    'format' => 'A4',
		    'orientation' => 'P',
		    'tempDir' => '/tmp'
		]);
		$data['tes'] = '';

	
		$pilihan_bulan = array("01"=>"Januari", "02"=>"Februari", "03"=>"Maret", "04"=>"April", "05"=>"Mei", "06"=>"Juni", "07"=>"Juli", "08"=>"Agustus", "09"=>"September", "10"=>"Oktober", "11"=>"November", "12"=>"Desember");
		$data['pilihan_bulan'] = $pilihan_bulan;
		if (isset($_GET['tipe'])) {
			$tipe = $_GET['tipe'];
			if ($tipe=='periode') {
				$tgl_awal = $_GET['tgl_awal'].' 00:00:00';
				$tgl_akhir = $_GET['tgl_akhir'].' 23:59:59';
				$where = "where p.waktu_pesan between '$tgl_awal' and  '$tgl_akhir'";
				$print = "?tgl_awal=".$tgl_awal."&tgl_akhir=".$tgl_akhir."&tipe=periode";
				$caption_filter = 'Periode '.$_GET['tgl_awal'].' sampai '.$_GET['tgl_akhir'];
			}else{
				$bulan = $_GET['bulan'];
				$tahun = $_GET['tahun'];
				$where = "where month(p.waktu_pesan)='$bulan' and year(p.waktu_pesan)='$tahun'";
				$print = "?bulan=".$bulan."&tahun=".$tahun."&tipe=bulanan";
				$caption_filter = ' '.$pilihan_bulan[$bulan].' '.$_GET['tahun'];

			}
		}else{
			$print = "";
			$caption_filter = "Semua Data";
			$where = "";
		}
		$q_faktur = $this->db->query("SELECT p.*, 
			pl.nama, pl.nohp, 
			pg.kategori,pg.tgl_kunjungan,pg.nama_kelompok,
			dp.nama as nama_anggota,

			pr.nama_produk, pr.harga
			from pesanan p
			left join produk pr on p.id_produk = pr.id_produk
			left join pengunjung pg on p.id_pengunjung = pg.id_pengunjung
			left join detail_pengunjung dp on p.id_detail_pengunjung = dp.id_detail_pengunjung
			left join pelanggan pl on pg.id_pelanggan = pl.id_pelanggan
			$where
			")->result_array();
		$data['periode_penjualan'] = $caption_filter;
		$data['faktur'] =$q_faktur;
	    $html =  $this->load->view('admin/form/laporan/print_laporan_penjualan', $data, true);


        // $mpdf->SetMargins(0, 0, 40);
        $mpdf->SetHTMLHeader($header);
		$mpdf->WriteHTML($html);
		$mpdf->Output('Laporan Penjualan.pdf', 'I');
	}

	public function print_laporan_visit()
	{
		$level = $this->session->userdata('level');
		$mpdf = new \Mpdf\Mpdf([
		    'mode' => 'utf-8',
		    'format' => 'A4',
		    'orientation' => 'P',
		    'tempDir' => '/tmp'
		]);
		$data['tes'] = '';

	
		$pilihan_bulan = array("01"=>"Januari", "02"=>"Februari", "03"=>"Maret", "04"=>"April", "05"=>"Mei", "06"=>"Juni", "07"=>"Juli", "08"=>"Agustus", "09"=>"September", "10"=>"Oktober", "11"=>"November", "12"=>"Desember");
		$data['pilihan_bulan'] = $pilihan_bulan;
		if (isset($_GET['tipe'])) {
			$tipe = $_GET['tipe'];
			if ($tipe=='periode') {
				$tgl_awal = $_GET['tgl_awal'].' 00:00:00';
				$tgl_akhir = $_GET['tgl_akhir'].' 23:59:59';
				$where = "where pg.tgl_kunjungan between '$tgl_awal' and  '$tgl_akhir'";
				$print = "?tgl_awal=".$tgl_awal."&tgl_akhir=".$tgl_akhir."&tipe=periode";
				$caption_filter = 'Periode '.$_GET['tgl_awal'].' sampai '.$_GET['tgl_akhir'];
			}else{
				$bulan = $_GET['bulan'];
				$tahun = $_GET['tahun'];
				$where = "where month(pg.tgl_kunjungan)='$bulan' and year(pg.tgl_kunjungan)='$tahun'";
				$print = "?bulan=".$bulan."&tahun=".$tahun."&tipe=bulanan";
				$caption_filter = ' '.$pilihan_bulan[$bulan].' '.$_GET['tahun'];

			}
		}else{
			$print = "";
			$caption_filter = "Semua Data";
			$where = "";
		}
		$q_faktur = $this->db->query("SELECT pg.*, 
			pl.nama, pl.nohp
			
			from pengunjung pg 
			left join pelanggan pl on pg.id_pelanggan = pl.id_pelanggan
			$where
			")->result_array();
		$data['periode_penjualan'] = $caption_filter;
		$data['faktur'] =$q_faktur;
	    $html =  $this->load->view('admin/form/laporan/print_laporan_visit', $data, true);


        // $mpdf->SetMargins(0, 0, 40);
        $mpdf->SetHTMLHeader($header);
		$mpdf->WriteHTML($html);
		$mpdf->Output('Laporan Visitor.pdf', 'I');
	}
	public function print_laporan_poin()
	{
		$level = $this->session->userdata('level');
		$mpdf = new \Mpdf\Mpdf([
		    'mode' => 'utf-8',
		    'format' => 'A4',
		    'orientation' => 'P',
		    'tempDir' => '/tmp'
		]);
		$data['tes'] = '';

	
		$pilihan_bulan = array("01"=>"Januari", "02"=>"Februari", "03"=>"Maret", "04"=>"April", "05"=>"Mei", "06"=>"Juni", "07"=>"Juli", "08"=>"Agustus", "09"=>"September", "10"=>"Oktober", "11"=>"November", "12"=>"Desember");
		$data['pilihan_bulan'] = $pilihan_bulan;
		if (isset($_GET['tipe'])) {
			$tipe = $_GET['tipe'];
			if ($tipe=='periode') {
				$tgl_awal = $_GET['tgl_awal'].' 00:00:00';
				$tgl_akhir = $_GET['tgl_akhir'].' 23:59:59';
				$where = "where tp.tgl_transaksi between '$tgl_awal' and  '$tgl_akhir'";
				$print = "?tgl_awal=".$tgl_awal."&tgl_akhir=".$tgl_akhir."&tipe=periode";
				$caption_filter = 'Periode '.$_GET['tgl_awal'].' sampai '.$_GET['tgl_akhir'];
			}else{
				$bulan = $_GET['bulan'];
				$tahun = $_GET['tahun'];
				$where = "where month(tp.tgl_transaksi)='$bulan' and year(tp.tgl_transaksi)='$tahun'";
				$print = "?bulan=".$bulan."&tahun=".$tahun."&tipe=bulanan";
				$caption_filter = ' '.$pilihan_bulan[$bulan].' '.$_GET['tahun'];

			}
		}else{
			$print = "";
			$caption_filter = "Semua Data";
			$where = "";
		}
		$q_transaksi = $this->db->query("SELECT tp.*, 
			itp.nama_item_tukar_poin, itp.poin as poin_dibutuhkan,
			p.nama, p.nohp
			
			from transaksi_poin tp 
			left join item_tukar_poin itp on tp.id_item_tukar_poin = itp.id_item_tukar_poin
			left join pelanggan p on tp.id_pelanggan = p.id_pelanggan
			$where
			")->result_array();
		$data['periode_poin'] =$caption_filter	;
		$data['transaksi'] =$q_transaksi;
	    $html =  $this->load->view('admin/form/laporan/print_laporan_poin', $data, true);


        // $mpdf->SetMargins(0, 0, 40);
        $mpdf->SetHTMLHeader($header);
		$mpdf->WriteHTML($html);
		$mpdf->Output('Laporan Penukaran Poin.pdf', 'I');
	}


}
