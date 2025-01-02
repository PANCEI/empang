<?= $this->extend('temp/index'); ?>
<?= $this->section('css'); ?>
 <!-- DataTables -->
 <link rel="stylesheet" href="<?= base_url() ?>plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
<?= $this->endSection('css'); ?>
<?= $this->section('content'); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Invoice Rumput Laut</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
        <button type="button" class="btn btn-info mt-2" data-toggle="modal" data-target="#modal-default">
                    Tambah Invoice 
                </button>
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <?php var_dump($invoice) ?>
    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
        <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">List Asset</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Kode Invoice</th>
                    <th>Pemanen</th>
                    <th>upah</th>
                    <th>Harga</th>
                    <th>Jumlah *KG</th>
                    <th>Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                 
                    <?php foreach ($invoice as $i): ?>
                      <tr>
                        <td><?= $i['kode_invoice'] ?></td>
                        <td><?= $i['namapemanen'] ?></td>
                        <td><?= $i['jumlah_upah'] ?></td>
                        <td><?= $i['harga'] ?></td>
                        <td><?= $i['jumlah'] ?></td>
                        <td>
                        <a href="/print?kode=<?= $i['kode_invoice'] ?>" class="btn btn-danger btn-xs delete-asset">
                            <i class="fas fa-trash"></i> Hapus
                             </a>
                        </td>
                      </tr>
                    
                    <?php endforeach; ?>
                  </tbody>
                  <tfoot>
                  <tr>
                  <th>Kode Invoice</th>
                    <th>Pemanen</th>
                    <th>upah</th>
                    <th>Harga</th>
                    <th>Jumlah *KG</th>
                    <th>Aksi</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

       
          </div>
        </div>
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
 
    <!-- awal modal  -->
    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Invoice Rumput Laut</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <form action="/invoice-rmpl" class="invoice-rmpl" method="POST">
                <div class="card-body">
                <div class="form-group">
                    <label for="kode_invoice">Kode Invoice</label>
                    <input type="text" class="form-control" id="kode_invoice" placeholder="Masukan Asset" name="kode_invoice" readonly>
                  </div>
                  <div class="form-group">
                    <label for="namapemanen">Nama Pemanen</label>
                    <input type="text" class="form-control" id="namapemanen" placeholder="Masukan Nama Pemanen" name="namapemanen">
                  </div>
                  <div class="form-group">
                    <label for="upah">Upah</label>
                    <input type="number" class="form-control" id="upah" placeholder="Masukan Upah" name="upah">
                  </div>
                  <div class="form-group">
                    <label for="jumlah">Jumlah</label>
                    <input type="number" class="form-control" id="jumlah" placeholder="Masukan Jumlah" name="jumlah">
                  </div>
                  <div class="form-group">
                    <label for="harga">Masukan Harga</label>
                    <input type="number" class="form-control" id="harga" placeholder="Masukan Harga" name="harga">
                  </div>
                </div>
                <!-- /.card-body -->

        
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
   </div>
   <!-- akhir modal  -->
<?= $this->endSection('content'); ?>
<?= $this->section('js'); ?>
<!-- DataTables  & Plugins -->
<script src="<?= base_url() ?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url() ?>plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?= base_url() ?>plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>plugins/jszip/jszip.min.js"></script>
<script src="<?= base_url() ?>plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?= base_url() ?>plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?= base_url() ?>plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?= base_url() ?>plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?= base_url() ?>plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<script>
   $('#example2').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": false,
      "info": true,
      "autoWidth": false,
      "responsive": true,
      "processing": true,
      
      "language": {
        "processing": "Memuat..."
      }
    });
  // generate kode invoice
  generateKodeInvoice();
  function generateKodeInvoice() {
  $.ajax({
    url:'/get-kode-invoice-rmpl',
    method:'GET',
    success:function(data){
      console.log(data);
      $('#kode_invoice').val(data.kode);
    },
    error:function(xhr,status,error){

      console.log(xhr);
      console.log(status);
      console.log(error);
    }
  })
  }
</script>
<?= $this->endSection('js');?>