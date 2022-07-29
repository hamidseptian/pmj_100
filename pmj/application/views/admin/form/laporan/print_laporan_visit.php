

<?php   
$bulan = array('', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');

 ?>
 <style>
  .font_laporan{
    font-size:11px;
    font-family: 'arial';
  }
 


  .logo{
   float:left;
   width : 70px;
  }
  .clearfix{
   clear:both;
   
  }
  .kop{
    margin-left:30px;
   font-family: 'arial';
  }
  .garis_kop1{
    margin-top:5px;
    border-width: 1.6px;
      border-style: solid;
  }
  .garis_kop2{
    margin-top:1px;
    border-width: 1px;
      border-style: solid;
  }

  .ratatengah{
    text-align:center;
  }


  .table {
    
    border-collapse: collapse;
    width:100%;
}
.table td, th {
    border: 0.01em solid ;
    padding:3px;
}
</style>

<body>
  <div class="logo">
  <img src="<?php echo base_url() ?>file/gambar/logo.PNG" >
</div>
<div >
    <div class="kop">
      <div><b><h2>Pizza Hut</h2></b></div>
      <div style="margin-top:-20px">
        Jl. Jl. Jend. A Yani No.21, Kp. Jao, Kec. Padang Bar., Kota Padang, Sumatera Barat 25114<br>
      HP : 0811-3249-092
    </div>


     
    </div>
  </div>
  <div class="clearfix"></div>

<div class="garis_kop1"></div>
<div class="garis_kop2"></div>

 <div class="ratatengah"> 
  <h4>Laporan Data Kunjungan </h4>   
 </div>

  <div style="width:50%;float:left" class="font_laporan">
    <?php echo $periode_penjualan ?>
  </div>


  <div class="clearfix"></div>
<br>      
      <table class="font_laporan" id="tabel1" style="border-collapse: collapse; " border=1 width="100%">
            <thead>
                <tr>
                  <th>No</th>
                  <th>Tanggal Kunjungan</th>
                  <th>Kategori</th>
                  <th>Nama Pelanggan</th>
                  <th>PJ</th>
                 
                </tr>
            </thead>
            
             <tbody>
      <?php  
      $no=1;
      foreach ($faktur as $k => $v) { 
        $id_pengunjung = $v['id_pengunjung'];
        $detail_pengunjung = $this->db->query("SELECT * from detail_pengunjung  where id_pengunjung='$id_pengunjung'")->result_array();


        if ($v['kategori']=="Pribadi") { ?>
         <tr> 
           <td><?php echo $no++ ?></td>
            <td><?php echo $v['tgl_kunjungan'] ?></td>
            <td><?php echo $v['kategori'] ?></td>
            <td><?php echo $v['nama'] ?></td>
            <td>-</td>
         </tr>


        <?php }else{ 
            foreach ($detail_pengunjung as $k_dp => $v_dp) { ?>
              <tr> 
               <td><?php echo $no++ ?></td>
                <td><?php echo $v['tgl_kunjungan'] ?></td>
                <td><?php echo $v['kategori'].' - '.$v['nama_kelompok'] ?></td>
                <td><?php echo $v_dp['nama'] ?></td>
                <td><?php echo $v['nama'] ?></td>
             </tr>
           
         <?php } ?>
     
      <?php 
        }
      }
         ?>
    </tbody>
            
          </table>
          
    <br>  <br>  

  <div style="width:50%;float:left" >
   
  </div>
  <div style="width:25%; float:right; " class="font_laporan">
   <div class="ratatengah">
     Padang, <?php echo date('d').' '.$bulan[date('n')].' '.date('Y') ?> <br>
     Hormat Kami 
     <br><br><br><br>
     Manager
   </div>
  </div>
</body>

