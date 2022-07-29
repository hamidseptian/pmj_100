

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

<body style="margin-top:100px">
  <div class="">
  <img src="<?php echo base_url() ?>file/gambar/kop_logo.jpg" style="width:100%" >
</div>
    <span class="font_laporan">
      Jl. Jend. A Yani No.21, Kp. Jao, Kec. Padang Bar., Kota Padang, Sumatera Barat 25114 
    </span>


  <div class="clearfix"></div>
<hr>  


<br>      
       <table class="font_laporan" width="100%">
                <tr>
                  <td valign="top">Nama</td>
                  <td valign="top">:</td>
                  <td valign="top"><?php echo $pengunjung['nama'] ?> <br>  <?php echo $pengunjung['nama_kelompok'] ?></td>
                </tr>
                <tr>
                  <td valign="top">No HP</td>
                  <td valign="top">:</td>
                  <td valign="top"><?php echo $pengunjung['nohp'] ?></td>
                </tr>
                <tr>
                  <td valign="top">Waktu Order </td>
                  <td valign="top">:</td>
                  <td valign="top"><?php echo $pengunjung['tgl_kunjungan'] ?><br> <?php echo $pengunjung['jam_kunjungan'] ?></td>
                </tr>

              </table>

                <hr>  
               <table class="font_laporan"  width="100%">
               
              
              <?php 
                $kumpul = [];
                $no = 0;
                $total_semua = 0;
              foreach ($produk as $k => $v_p) { 
                $id_produk = $v_p['id_produk'];
                $pesanan = $this->db->query("SELECT sum(qty) as qty_produk from pesanan where id_produk='$id_produk' and id_pengunjung='$id_pengunjung'")->row_array();
                $total = $pesanan['qty_produk'] * $v_p['harga'];
                $total_semua   +=$total;
                $no++;
                        ?>
                        <tr>  
                        
                          <td colspan="3"> <?php echo $v_p['nama_produk'] ?></td>
                        <tr>
                        <tr>  
                        
                          <td align="right" width="15px"><?php echo $pesanan['qty_produk'] ?></td>
                          <td align="right" width="10px">pcs</td>
                          <td align="right"> <?php echo number_format($v_p['harga']) ?></td>
                          <td align="right"> <?php echo number_format($total) ?></td>
                        </tr>  
                     


              <?php } 
                $pajak = 0.1 * $total_semua;
                $grand_total = $total_semua + $pajak;
              ?>
                 
              </table>
              <hr>  
               <table class="font_laporan"  width="100%">
                  <tr>  
                    <td>Sub Total</td>
                    <td align="right">  <?php echo number_format($total_semua) ?></td>
                  </tr>
                  <tr>  
                    <td>Tax</td>
                    <td align="right">  <?php echo number_format($pajak) ?></td>
                  </tr>
                  <tr>  
                    <td>Grand Total</td>
                    <td align="right">  <?php echo number_format($grand_total) ?></td>
                  </tr>
              </table>
<br>  
<div class="font_laporan" style="text-align:center"> 
      Terima kasih atas kunjungan anda  <br>  
      Order delivery, TakeAway silahkan hubungi  <br> 
      1-500-600 / Aplikasi Pizza Hut Indonesia <br> 

      Download aplikasi si Google Play /  Apple store & dapatkan produk gratis <br> 
</div>

<hr>  
  <table class="font_laporan" width="100%">
    <tr>  
      <td><?php echo date('Y-m-d') ?></td>
      <td align="right"><?php echo date('H:i:s') ?></td>
    </tr>
  </table>

































