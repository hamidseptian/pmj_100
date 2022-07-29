 <style type="text/css">
   .botton_to_text{
    padding: 0;
border: none;
background: none;
color:blue;
};
 </style><div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Detail Pengunjung</h3>
          <div class="pull-right">
           
          </div>
        </div>
        <div class="box-body">
          
          
            <div class="form-group">
              
              <table class="table">
                <tr>
                  <td>Tanggal Kunjungan</td>
                  <td>:</td>
                  <td><?php echo $pengunjung['tgl_kunjungan'] ?></td>
                </tr>
                <tr>
                  <td>Kategori</td>
                  <td>:</td>
                  <td><?php echo $pengunjung['kategori'] ?></td>
                </tr>
                <tr>
                  <td>Nama</td>
                  <td>:</td>
                  <td><?php echo $pengunjung['nama'] ?></td>
                </tr>
                <tr>
                  <td>No HP</td>
                  <td>:</td>
                  <td><?php echo $pengunjung['nohp'] ?></td>
                </tr>
                <tr>
                  <td>Status</td>
                  <td>:</td>
                  <td><?php echo $pengunjung['status'] ?></td>
                </tr>
              </table>
              <hr>
              <table class="table table-striped table-bordered" id="tabel1">
            <thead>
              <tr>
                <td width="20px">No</td>
                <td>Produk</td>
                <td>Harga</td>
                <td>Poin Produk</td>
                <td>Jumlah Pesanan</td>
                <td>Total harga</td>
                <td>Poin Didapatkan</td>
                <td>Status</td>
                <td width="90px">Option</td>
              </tr>
            </thead>
            <?php 
            $no=1;
            $total_harga_semua = 0;
            $poin_didapatkan =0;
            $masuk_keranjang = 0;
            foreach ($pesanan->result_array() as $d1) { 
              if ($d1['status']=='Masuk Ke Keranjang') {
                $masuk_keranjang+=1;
              }
              $harga_total = $d1['qty'] * $d1['harga'] ;
              $poin_1_produk = $d1['qty'] * $d1['poin'] ;
              $poin_didapatkan += $poin_1_produk;
              $total_harga_semua += $harga_total;
              ?>
              <tr>
                <td><?php echo $no++ ?></td>
               
                <td><?php echo $d1['nama_produk'] ?></td>
                <td><?php echo number_format($d1['harga']) ?></td>
                <td><?php echo $d1['poin'] ?></td>
                <td><?php echo $d1['qty'] ?></td>
                <td><?php echo number_format($harga_total) ?></td>
                <td><?php echo $poin_1_produk ?></td>
                <td><?php echo $d1['status'] ?></td>
                <td>
                  <button type="button" class="btn btn-info btn-xs"  data-toggle="modal"  data-target="#tambah_pesanan" onclick="edit_pesanan('<?php echo $d1['id_pesanan'] ?>','<?php echo $d1['id_produk'] ?>','<?php echo $d1['qty'] ?>', 'edit')">Edit</button>
                  <a href="<?php echo base_url('user/admin/pengunjung/hapus_pesanan/'.$d1['id_pesanan'].'/detail/'.$d1['id_pengunjung']) ?>" class="btn btn-info btn-xs" onclick="return">Hapus</a>
                  
                </td>
              </tr>
            <?php } ?>
            <tr>
              <td colspan="5">Total</td>
              <td><?php echo number_format($total_harga_semua) ?></td>
              <td colspan="2"><?php echo number_format($poin_didapatkan) ?></td>
            </tr>
          </table>
             
            </div>


        </div>


      </div>
            <form action="<?php echo base_url('user/admin/pengunjung/konfirmasi_pesanan_pribadi/'.$pengunjung['id_pengunjung'].'/'.$pengunjung['id_pelanggan']) ?>" method="get">
              <input type="hidden" name="id_pelanggan" value="<?php echo $id_pelanggan ?>">
              <input type="hidden" name="tgl_kunjungan" value="<?php echo $pengunjung['tgl_kunjungan'] ?>">
              <input type="hidden" name="jam_kunjungan" value="<?php echo $pengunjung['jam_kunjungan'] ?>">
              <input type="hidden" name="poin_didapatkan_kunjungan" id="poin_didapatkan_kunjungan">
              <input type="hidden" name="total_belanja_kunjungan" id="total_belanja_kunjungan">
            <a href="<?php echo base_url('user/admin/pengunjung') ?>" class="btn btn-info">Kembali</a>
       <?php if ($pengunjung['status']=='Booking') { ?>
            <!-- <a href="<?php echo base_url('user/admin/pengunjung/konfirmasi_pesanan_kelompok/'.$pengunjung['id_pengunjung']) ?>" class="btn btn-info">Konfirmasi</a> -->
            <button onclick="return confirm('Konfirmasi pesanan.?')" class="btn btn-info">Proses Pesanan</button>
            <button class="btn btn-info" type="button" data-toggle="modal" data-target="tambah_pesanan" onclick="tambah_pesanan()">Tambah Pesanan</button>
       <?php }
       elseif ($pengunjung['status']=='Dalam Proses') { ?>
            <button class="btn btn-info" type="button" data-toggle="modal" data-target="#tambah_pesanan">Tambah Pesanan</button>
            <a href="<?php echo base_url('user/admin/pengunjung/konfirmasi_pesanan_pribadi/'.$pengunjung['id_pengunjung'].'/'.$id_pelanggan) ?>?tgl_kunjungan=<?php echo $pengunjung['tgl_kunjungan'] ?>&jam_kunjungan=<?php echo $pengunjung['jam_kunjungan'] ?>&total_belanja_kunjungan=<?php echo $total_harga_semua ?>&poin_didapatkan_kunjungan=<?php echo $poin_didapatkan ?>" onclick="return confirm('Konfirmasi pesanan.?')" class="btn btn-info">Proses Pesanan</a>
              <?php if ($masuk_keranjang>0) { ?>
                <button type="button" onclick="alert('Maaf, anda belum bisa mengakhiri pesanan karena masih ada pesanan yang statusnya masih Masuk dalam keranjang')" class="btn btn-default">Akhiri Pesanan</button>
              <?php }else{ ?>
            <a href="<?php echo base_url('user/admin/pengunjung/akhiri_pesanan_pribadi/'.$pengunjung['id_pengunjung']) ?>" onclick="return confirm('Akhiri pesanan.?')" class="btn btn-default">Akhiri Pesanan</a>
          <?php } ?>
       <?php }else{ ?>
            <a href="<?php echo base_url('user/admin/pengunjung/print_pesanan_kelompok/'.$pengunjung['id_pengunjung']) ?>" class="btn btn-info" target="_blank">Print Faktur</a>

       <?php } ?>
              
            </form>
    </div>



  </div>

<script type="text/javascript">

  function tambah_pesanan(){
    $('#tambah_pesanan').modal('show');
     $('#qty').val('');
    $('#form_pesanan').attr('action', '<?php echo base_url('user/admin/pengunjung/simpan_pesanan_pribadi') ?>');
    $('#title').html('Tambah Pesanan');
}
  function edit_pesanan(id_pesanan, id_produk, qty, action){
    // $('#tambah_pesanan').modal('show');
    $('#id_produk').val(id_produk).change();
    $('#title').html('Edit Pesanan');
    $('#qty').val(qty);
    $('#id_pesanan').val(id_pesanan);
    $('#form_pesanan').attr('action', '<?php echo base_url('user/admin/pengunjung/simpanedit_pesanan_pribadi') ?>');

}
 

</script>



  <div class="modal modal-default fade" id="tambah_pesanan">
    <form action="<?php echo base_url('user/admin/pengunjung/simpan_pesanan_pribadi') ?>" method='post' id="form_pesanan">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="title">Tambah Pesanan</h4>
              </div>
              <div class="modal-body">
                <input type="hidden" name="id_pesanan" id="id_pesanan" class="form-control">
                <input type="hidden" name="id_pengunjung" class="form-control" required value="<?php echo $pengunjung['id_pengunjung'] ?>">
                
                <div class="form-group">
                  <label>Produk</label>
                  <select name="id_produk" class="form-control" id="id_produk">
                   <?php foreach ($produk as $k => $v) { ?>
                     <option value="<?php echo $v['id_produk'] ?>"><?php echo $v['nama_produk'] ?> [Rp. <?php echo number_format($v['harga']) ?>]</option>
                   <?php } ?>
                  </select>
                </div>
                <div class="form-group">
                  <label>Qty</label>
                  <input type="text" name="qty" id="qty" class="form-control" required >
                </div>
               
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-info pull-left" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-info">Simpan</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </form>
      </div>
