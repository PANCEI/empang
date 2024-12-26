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
          <h1 class="m-0">Asset Masuk</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
        <button type="button" class="btn btn-info mt-2" data-toggle="modal" data-target="#modal-default">
                    Asset Masuk
                </button>
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
<!-- //<?php var_dump($masuk) ?> -->
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
                    <th>Id</th>
                    <th>Kode Asset</th>
                    <th>Jumlah</th>
                    <th>Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                   <?php $i=1; ?>
                   <?php foreach($masuk as $m): ?>
                    <tr>
                      <td><?= $i; ?></td>
                      <td><?= $m['kodeaset']; ?> || <?= $m['nama_asset']; ?> </td>
                      <td><?= $m['jumlah']; ?></td>
                      <td> <a href="/delete-masuk" data-id="<?= $m['id'] ?>" class="btn btn-danger btn-xs delete-masuk">
                            <i class="fas fa-trash"></i> Hapus
                             </a></td>
                   <?php $i++; ?>
                   <?php endforeach; ?>
                  </tbody>
                  <tfoot>
                  <tr>
                  <th>Id</th>
                    <th>Kode Asset</th>
                    <th>Jumlah</th>
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
    <!-- awal modal -->
    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Asset Masuk</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <form action="/asset-masuk" class="asset-masuk" method="POST">
                <div class="card-body">
                  <div class="form-group">
                    <label for="assetall">Kode Asset</label>
                    <select class="form-control" id="assetall" name="kodeasset">
                      <option value="">Pilih Kode Asset</option>
                      <!-- Opsi akan diisi secara dinamis menggunakan JavaScript -->
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="jumlah">Jumlah</label>
                    <input type="number" class="form-control" id="jumlah" placeholder="Masukan Asset" name="jumlah">
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
   <!-- akhir modal -->
<?= $this->endSection('content'); ?>
<?= $this->section('js'); ?>
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
  //  getallasset();
function getallasset(){
    $.ajax({
        url: '/tambah-asset-getall-asset',
        type: 'GET',
        success: function(data) {
            console.log(data);
            $.each(data, function(index, value) {
                $('#assetall').append('<option value="' + value.kodeasset + '">' + value.kodeasset + " || " + value.nama + '</option>');
            });
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
}

function getdatamasukall() {
    $.ajax({
        url: '/tambah-asset-getdatamasukall', // Endpoint untuk mendapatkan data
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            let table = $('#example2').DataTable(); // Inisialisasi DataTables
            table.clear(); // Hapus semua data yang ada di DataTables
          console.log('getdataall');
          console.log(data);
            if (data.length > 0) {
                let rows = [];
                $.each(data, function (index, value) {
                    rows.push([
                        index + 1, // Nomor urut
                        value.kodeaset + " || " + value.nama_asset, // Kode Asset dan Nama
                        value.jumlah, // Jumlah
                        `<a href="/delete-masuk" data-id="${value.id}" class="btn btn-danger btn-xs delete-masuk">
                            <i class="fas fa-trash"></i> Hapus
                        </a>`
                    ]);
                });

                table.rows.add(rows).draw(); // Tambahkan data baru ke tabel dan refresh
            }else{
              table.destroy();
              let tables = $('#example2').DataTable();
            }
        },
        error: function (xhr, status, error) {
            console.error("Error retrieving data:", xhr.responseText);
        }
    });
}
// insert data
$(document).on('submit','form.asset-masuk',function(e){
  e.preventDefault();
  let form= $(this);
  console.log(form[0][0].value);
  let kodeaset= form[0][0].value;
  let jumlah = form[0][1].value;
  if(kodeaset == '' || jumlah == ''){
    Toast.fire({
        icon: 'error',
        title: 'Inputan harap Di Lengkapi.'
      });
      return;
  }
  $.ajax({
    url: form.attr('action'),
    method:form.attr('method'),
    data: form.serialize(),
    success: function (response){
      if(response.success){
            Toast.fire({
              icon: 'success',
              title: response.success
              });
              getdatamasukall();
          }
          if(response.error){
            Toast.fire({
              icon: 'error',
              title: 'Data Gagal Disimpan'
              });
          }
          $('#modal-default').modal('hide');
    },
    error: function (xhr, status, error) {
    console.log(xhr);
    console.log(status);
    console.log(error);
    }
  })
})
$(document).on('click','a.delete-masuk', function(e){
  e.preventDefault();
  let id = $(this).data('id');
  if(id== ''){
    Toast.fire({
      icon: 'error',
      title: 'Data Yang Di Kirim Tidak Boleh Kosong'
      });
      return;

    }
    Swal.fire({
  title: "Anda Yakin?",
  text: "Anda Tidak Dapat Memulihkan Data Yang Di Hapus!",
  icon: "warning",
  showCancelButton: true,
  confirmButtonColor: "#3085d6",
  cancelButtonColor: "#d33",
  confirmButtonText: "Yes, delete it!"
}).then((result) => {
  if (result.isConfirmed) {
   $.ajax({
    url:'/delete-masuk',
    method: 'POST',
    data: {id: id},
    success: function(response){
      //getdatamasukall();
      console.log(response);
      if(response.success){
        Toast.fire({
          icon: 'success',
          title: response.success
          });
          
        }
        if(response.error){
            Toast.fire({
              icon: 'error',
              title: 'Data Gagal Dihapus'
              });
          }
          getdatamasukall();
    },
    error: function(xhr, status , error){
      console.log(xhr);
      console.log(status);
      console.log(error);
    }
  })
  }
});
  
  console.log('oke');

})
</script>
<?= $this->endSection('js');?>