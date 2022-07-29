

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
  <h4>Laporan Data Transaksi Poin </h4>   
 </div>

  <div style="width:50%;float:left" class="font_laporan">
    <?php echo $periode_poin ?>
  </div>


  <div class="clearfix"></div>
<br>      
      <table class="font_laporan" id="tabel1" style="border-collapse: collapse; " border=1 width="100%">
            <thead>
                <tr>
                  <th rowspan="2">No</th>
                  <th rowspan="2">Waktu Transaksi</th>
                  <th rowspan="2">Pelanggan</th>
                  <th rowspan="2">Poin Masuk</th>
                  <th colspan="4">Poin Keluar</th>
                </tr>
                <tr>
                  <th>Ditukarkan Dengan</th>
                  <th>Poin Dibutuhkan</th>
                  <th>Qty Item</th>
                  <th>Poin Digunakan</th>
                </tr>
            </thead>
            
             <tbody>
      <?php  
      $no=1;
      $total_poin_masuk = 0;
      $total_poin_keluar = 0;
      foreach ($transaksi as $k => $v) { 
        $poin_transaksi = $v['qty'] * $v['poin_dibutuhkan'];
        if ($v['status_poin']=='+') { 
          $total_poin_masuk += $v['poin'];
          ?>
         <tr>
          <td><?php echo $no++ ?></td>
          <td><?php echo $v['tgl_transaksi'] ?></td>
          <td><?php echo $v['nama'] ?></td>
          <td align="center"><?php echo $v['poin'] ?></td>
          <td>-</td>
          <td>-</td>
          <td>-</td>
          <td>-</td>
      
        </tr>
       <?php  }else{
          $total_poin_keluar += $poin_transaksi;
?>
      <tr>
        <td><?php echo $no++ ?></td>
        <td><?php echo $v['tgl_transaksi'] ?></td>
        <td><?php echo $v['nama'] ?></td>
        <td></td>
        <td><?php echo $v['nama_item_tukar_poin'] ?></td>
        <td align="center"><?php echo $v['qty'] ?></td>
        <td align="center"><?php echo $v['poin_dibutuhkan'] ?></td>
        <td align="center"><?php echo $poin_transaksi ?></td>
    
      </tr>
      <?php 
          }
        } 
       ?>
    </tbody>
            
            <tfoot>
              <tr>
                <td colspan="3">Total</td>
                <td align="center"><?php echo $total_poin_masuk ?></td>
                <td align="center" colspan="4"><?php echo $total_poin_keluar ?></td>
              </tr>
            </tfoot>
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

