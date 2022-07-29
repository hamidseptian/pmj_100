 <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Laporan Penjualan<br><?php echo $periode_penjualan ?></h3>
          <div class="pull-right">
            <a href="<?php echo base_url('user/admin/laporan/print_laporan_penjualan'.$print) ?>" class="btn btn-info" target="_blank">Print</a>
            <a href="#" class="btn btn-info" data-toggle="modal" data-target="#filter">Filter</a>
          </div>
        </div>
        <div class="box-body">
         <table class="table table-striped table-bordered" id="tabel1">
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
          
          
        </div>


      </div>
    </div>
  </div>







  <div class="modal modal-default fade" id="filter">
          <div class="modal-dialog modal-xl">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Filter</h4>
              </div>
              <div class="modal-body">
                <div>
                
                  <form action="<?php echo base_url('user/admin/laporan/penjualan') ?>" method='get' id="">
                    <div class="form-group">
                      <label>Tgl Awal</label>
                      <input type="date" name="tgl_awal" class="form-control" value="<?php echo date('Y-m') ?>-01">
                    </div>
                    <div class="form-group">
                      <label>Tgl Akhir</label>
                      <input type="date" name="tgl_akhir" class="form-control" value="<?php echo date('Y-m-d') ?>">
                    </div>
                  
                      <input type="hidden" name="tipe" class="form-control" value="periode">
                    <div class="form-group">
                      <button type="submit" class="btn btn-info">Filter Berdasarkan Periode</button>
                    </div>
                  </form>

                  <hr>
                  <form action="<?php echo base_url('user/admin/laporan/penjualan') ?>" method='get' id="">
                    <div class="form-group">
                      <label>Bulan</label>
                      <select class="form-control" name="bulan">
                      <?php foreach ($pilihan_bulan as $key => $value) { ?>
                        <option value="<?php echo $key ?>"><?php echo $value ?></option>
                      <?php } ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Tahun</label>
                      <select name="tahun" class="form-control">
                        <?php for ($i=date('Y'); $i > 2010 ; $i--) { ?>
                          <option><?php echo $i ?></option>
                        <?php } ?>
                      </select>
                      <input type="hidden" name="tipe" class="form-control" value="bulanan">
                    </div>
                    <div class="form-group">
                      <button type="submit" class="btn btn-info">Filter Berdasarkan Bulanan</button>
                    </div>
                  </form>
                
               </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-info pull-left" data-dismiss="modal">Tutup</button>
                
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
      </div>











