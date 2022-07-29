

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
  <h4>Laporan Data Penjualan </h4>   
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
                  <th>Waktu Transaksi</th>
                  <th>Produk</th>
                  <th>Qty</th>
                  <th>Harga</th>
                  <th>Total</th>
                </tr>
            </thead>
            
             <tbody>
       <?php  
      $no=1;
      $total_belanja = 0;
      foreach ($faktur as $k => $v) { 
        $belanja = $v['qty'] * $v['harga'];
        $total_belanja += $belanja;
?>
      <tr>
        <td><?php echo $no++ ?></td>
        <td><?php echo $v['waktu_pesan'] ?></td>
        <td><?php echo $v['nama_produk'] ?></td>
        <td align="center"><?php echo $v['qty'] ?></td>
        <td align="right"><?php echo number_format($v['harga']) ?></td>
        <td align="right"><?php echo number_format($belanja) ?></td>
    
      </tr>
      <?php } ?>
    </tbody>
         <tfoot>
              <tr>
                <td colspan="5">Total</td>
                <td align="right"><?php echo number_format($total_belanja) ?></td>
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

