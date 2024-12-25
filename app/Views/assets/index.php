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
            <h1 class="m-0">Assets</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
        <button type="button" class="btn btn-info mt-2" data-toggle="modal" data-target="#modal-default">
                  Tambah Asset
                </button>
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

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
                    <th>Kode Asset</th>
                    <th>Nama Asset</th>
                    <th>Jumlah</th>
                    <th>Status</th>
                    <th>Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($asset as $a): ?>
                      <tr>
                        <td><?= $a['kodeasset'] ?></td>
                        <td><?= $a['nama'] ?></td>
                        <td><?= $a['jumlah'] ?></td>
                        <?php if($a['jumlah'] == 0) : ?>
                        <td><span class="badge badge-danger">Kosong</span></td>
                        <?php else : ?>
                        <td><span class="badge badge-info">Ada</span></td>
                        <?php endif; ?>
                        <td>
                        <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#edit-asset<?= $a['kodeasset'] ?>">
                          <i class="fas fa-edit"></i> Edit
                         </button>
                            <a href="/delete-asset" data-id="<?= $a['kodeasset'] ?>" class="btn btn-danger btn-xs delete-asset">
                            <i class="fas fa-trash"></i> Hapus
                             </a>
                        </td>
                      </tr>
                      <!-- awal modal edit -->
                      <div class="modal fade" id="edit-asset<?= $a['kodeasset'] ?>">
                            <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h4 class="modal-title">Edit Asset</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <div class="modal-body">
                                <form action="/edit-asset" class="edit-asset" method="POST">
                                  
                                    <div class="card-body">
                                    <div class="form-group">
                                        <label for="editkodeasset">Kode Asset</label>
                                        <input type="text" class="form-control" id="editkodeasset" placeholder="Masukan editkodeasset" name="editkodeasset" value="<?= $a['kodeasset'] ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="=editnama">Nama Asset</label>
                                        <input type="text" class="form-control" id="editnama" placeholder="Masukan editnama" name="editnama" value="<?= $a['nama'] ?>">
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

                       <!-- akhir modal edit -->
                    <?php endforeach; ?>
                  </tbody>
                  <tfoot>
                  <tr>
                  <th>Kode Asset</th>
                    <th>Nama Asset</th>
                    <th>Jumlah</th>
                    <th>Status</th>
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
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- awak modal  -->
  <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Tambah Asset</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <form action="/tambah-asset" class="tambah-asset" method="POST">
                <div class="card-body">
                  <div class="form-group">
                    <label for="kodeasset">Kode Asset</label>
                    <input type="text" class="form-control" id="kodeasset" placeholder="Masukan Kode Asset" name="kodeasset" readonly>
                  </div>
                  <div class="form-group">
                    <label for="Asset">Asset</label>
                    <input type="text" class="form-control" id="Asset" placeholder="Masukan Asset" name="Asset">
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
   <div id="dynamicmodal"></div>
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
    getkodeasset();
  function getkodeasset(){
    $.ajax({
      url:'/generate-kode',
      method:'GET',
      success:function(res){
        $('#kodeasset').val(res.kode);
        console.log(res);
      },
      error: function(xhr, status, error) {
          console.error('Status:', status);
          console.error('Error:', error);
          console.error('Response:', xhr.responseText); // Tampilkan respons server jika ada
          Toast.fire({
              icon: 'error',
              title: `Kesalahan: ${status} - ${error}`,
          });
      }
    })
  }
  function loadAssets() {
    $.ajax({
        url: '/get-all-assets', // Sesuaikan dengan endpoint API Anda
        method: 'GET',
        dataType: 'json',
        success: function(data) {
            let table = $('#example2').DataTable(); // Inisialisasi DataTables
            table.clear(); // Hapus semua data yang ada di DataTables
            let modals=$("#dynamicmodal");
            if (data.length > 0) {
                let rows = [];
                let modal;
                data.forEach(asset => {
                    let status = asset.jumlah == 0 
                        ? '<span class="badge badge-danger">Kosong</span>' 
                        : '<span class="badge badge-info">Ada</span>';
                    
                    rows.push([
                        asset.kodeasset,
                        asset.nama,
                        asset.jumlah,
                        status,
                        `
                            <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#edit-asset${asset.kodeasset}">
                                <i class="fas fa-edit"></i> Edit
                            </button>
                            <a href="/delete-asset" data-id="${asset.kodeasset}" class="btn btn-danger btn-xs delete-asset">
                                <i class="fas fa-trash"></i> Hapus
                            </a>
                        `
                    ]);
                    modal = `
    <div class="modal fade" id="edit-asset${asset.kodeasset}">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Asset</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/edit-asset" class="edit-asset" method="POST">
                    <div class="modal-body">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="editkodeasset">Kode Asset</label>
                                <input type="text" class="form-control" id="editkodeasset" placeholder="Masukan Komoditi" name="editkodeasset" value="${asset.kodeasset}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="editnama">Nama Asset</label>
                                <input type="text" class="form-control" id="editnama" placeholder="Masukan Komoditi" name="editnama" value="${ asset.nama}">
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
`;
modals.append(modal);
                });
              
                table.rows.add(rows); // Tambahkan data baru ke DataTables
            }
            table.draw(); // Render ulang DataTables
        },
        error: function(xhr, status, error) {
            console.error('Status:', status);
            console.error('Error:', error);
            console.error('Response:', xhr.responseText);
            Toast.fire({
                icon: 'error',
                title: `Kesalahan: ${status} - ${error}`,
            });
        }
    });
}

// // Panggil fungsi saat halaman dimuat
// $(document).ready(function() {
//     loadAssets();

//     // Refresh data assets setiap 5 menit (opsional)
//     setInterval(loadAssets, 10000); // 300000 ms = 5 menit
// });
$(document).on('submit', 'form.tambah-asset', function(e){
  e.preventDefault();
  
  let form= $(this);
  let kodeasset= form[0][0].value;
  let nama= form[0][1].value;
  if(kodeasset == '' || nama == ''){
    Toast.fire({
        icon: 'error',
        title: 'Inputan harap Di Lengkapi.'
      });
      return;
  }
  $.ajax({
    url:form.attr('action'),
    method:form.attr('method'),
    data:form.serialize(),
    success: function(response){
      console.log(response);
      if(response.success){
            Toast.fire({
              icon: 'success',
              title: response.success
              });
              loadAssets();
              getkodeasset();
          }
          if(response.error){
            Toast.fire({
              icon: 'error',
              title: 'Data Gagal Disimpan'
              });
          }
          $('#modal-default').modal('hide');
    },
    error: function(xhr , status, error){
      $('#modal-default').modal('hide');
      console.log(xhr);
      console.log(status);
      console.log(error);
    
    }
  })
})

// edit asset 
$(document).on('submit','form.edit-asset', function(e){
  e.preventDefault();
  console.log('oke');
  let form = $(this);
  let kodeasset= form[0][0].value;
  let nama= form[0][1].value;
  if(kodeasset == '' || nama == ''){
    Toast.fire({
      icon: 'error',
      title: 'Inputan harap Di Lengkapi.'
      });
      return;
  }
  $.ajax({
    url:form.attr('action'),
    method: form.attr('method'),
    data:form.serialize(),
    success: function(response){
      if(response.success){
            Toast.fire({
              icon: 'success',
              title: response.success
              });
              loadAssets();
              getkodeasset();
          }
          if(response.error){
            Toast.fire({
              icon: 'error',
              title: 'Data Gagal Disimpan'
              });
          }
          $('#edit-asset' + kodeasset).modal('hide');
    },
    error: function(xhr, status , error){
      console.log(xhr);
      console.log(status);
      console.log(error);
    }
  })
})
// delete kode asset
$(document).on('click','a.delete-asset', function(e){
  e.preventDefault();
  let kodeasset = $(this).data('id');
  if(kodeasset== ''){
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
    url:'/delete-asset',
    method: 'POST',
    data: {kodeasset: kodeasset},
    success: function(response){
      if(response.success){
        Toast.fire({
          icon: 'success',
          title: response.success
          });
          loadAssets();
          getkodeasset();
        }
        if(response.error){
            Toast.fire({
              icon: 'error',
              title: 'Data Gagal Di hapus'
              });
          }
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