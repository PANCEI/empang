<?= $this->extend('temp/index'); ?>
<?= $this->section('css'); ?>

<?= $this->endSection('css'); ?>
<?= $this->section('content'); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-10">
            <h1 class="m-0">Komoditi</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
        <button type="button" class="btn btn-info mt-2" data-toggle="modal" data-target="#modal-default">
                  Tambah Komoditi
                </button>
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
     
          <div class="col-12 col-sm-12 col-lg-4">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Daftar Komoditi</h3>

                <div class="card-tools">
           
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>id</th>
                      <th>Komoditi</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody id="table-komoditi">
                    <?php  $i=1 ?>
                    <?php foreach($komoditi as $ko): ?>
                        <tr>
                          <td><?= $i; ?></td>
                          <td><?= $ko['jenis_komoditi']; ?></td>
                          <td>
                          <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#edit-komoditi<?= $ko['id_komoditi'] ?>">
                          <i class="fas fa-edit"></i> Edit
                         </button>
                            <a href="/delete-komoditi" data-id="<?= $ko['id_komoditi'] ?>" class="btn btn-danger btn-xs delete-komoditi">
                            <i class="fas fa-trash"></i> Hapus
                             </a>
                          </td>
                        </tr>
                    <?php $i++; ?>
                    <!-- awal modal edit -->
                    <div class="modal fade" id="edit-komoditi<?= $ko['id_komoditi'] ?>">
                            <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h4 class="modal-title">Edit Komoditi</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <div class="modal-body">
                                <form action="/edit-komoditi" class="edit-komoditi" method="POST">
                                  <input type="hidden" name="id_komoditi" value="<?= $ko['id_komoditi'] ?>">
                                    <div class="card-body">
                                    <div class="form-group">
                                        <label for="komoditi">Komoditi</label>
                                        <input type="text" class="form-control" id="komoditi" placeholder="Masukan Komoditi" name="komoditi" value="<?= $ko['jenis_komoditi'] ?>">
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
  <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Tambah Komoditi</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <form action="/tambah-komoditi" class="tambah-komoditi" method="POST">
                <div class="card-body">
                  <div class="form-group">
                    <label for="komoditi">Komoditi</label>
                    <input type="text" class="form-control" id="komoditi" placeholder="Masukan Komoditi" name="komoditi">
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
      <div id="dynamicmodal"></div>
<?= $this->endSection('content'); ?>
<?= $this->section('js'); ?>

<script>
  $(document).on('click', 'a.delete-komoditi', function(event){
    event.preventDefault();
    let id= $(this).data('id');
    if(id == ''){
      Toast.fire({
        icon: 'error',
        title: 'Inputan harap Di Lengkapi.'
      });
      return;
    }
    $.ajax({
      type: "POST",
      url: "/delete-komoditi",
      data: {id:id},
      success: function(data){
        if(data.success){
          Toast.fire({
            icon: 'success',
            title: 'Data Berhasil Dihapus'
            });
            getDataKomoditi();
            }
            else{
              Toast.fire({
                icon: 'error',
                title: 'Data Gagal Dihapus'
                });
                }
              },
              error: function(xhr, status, error) {
                Toast.fire({
                  icon: 'error',
                  title: 'Data Gagal Dihapus'
                  });
            }       
    })
  })
  // untuk melakukan edit data
  $(document).on('submit', 'form.edit-komoditi', function(e){
    e.preventDefault();
   let form= $(this);
   let id_komoditi = form[0][0].value;
   let komiditi = form[0][0].value;
   if(id_komoditi == '' || komoditi == '0'){
    Toast.fire({
        icon: 'error',
        title: 'Inputan harap Di Lengkapi.'
      });
      return;
   }
   $.ajax({
    url: form.attr('action'),
    method: form.attr('method'),
    data:form.serialize(),
    success: function(response){
      if(response.success){
            Toast.fire({
              icon: 'success',
              title: response.success
              });
              getDataKomoditi();
          }
          if(response.error){
            Toast.fire({
              icon: 'error',
              title: 'Data Gagal Disimpan'
              });
          }
          $('#edit-komoditi' + id_komoditi).modal('hide');
    },
    error: function(xhr, status, error) {
    console.log(xhr);
    console.log(status);
    console.log(error);
    }
   })
  })
    // untuk inssert data
    $(document).on('submit','form.tambah-komoditi' ,function(e){
    e.preventDefault();
    let form = $(this);
    let jenis_komoditi = form[0][0].value;
    if(jenis_komoditi == ''){
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
        success:function(response){
          if(response.success){
            Toast.fire({
              icon: 'success',
              title: 'Data Berhasil Disimpan'
              });
              getDataKomoditi();
          }
          if(response.error){
            Toast.fire({
              icon: 'error',
              title: 'Data Gagal Disimpan'
              });
          }
          $('#modal-default').modal('hide');
        },
        error:function(xhr,status,error){
        console.log(xhr)
        console.log(status)
        console.log(error)
        }
      })
    })
   

    // untuk melakuukan get data
    function getDataKomoditi(){
     $.ajax({
        type: "GET",
        url:'/get-komoditi',
        success:function(response){
            let tablebody=$("#table-komoditi");
            let modals=$("#dynamicmodal");
            tablebody.empty();
            let row;
            let modal;
            response.forEach((kom, index)=>{
                 row=`
                   <tr>
                          <td>${index +1 }</td>
                          <td>${kom.jenis_komoditi}</td>
                          <td>
                          <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#edit-komoditi${kom.id_komoditi}">
                          <i class="fas fa-edit"></i> Edit
                         </button>
                            <a href="/delete-komoditi" data-id="${kom.id_komoditi}" class="btn btn-danger btn-xs" delete-komoditi>
                            <i class="fas fa-trash"></i> Hapus
                             </a>
                          </td>
                        </tr>
                `;
                modal = `
    <div class="modal fade" id="edit-komoditi${kom.id_komoditi}">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Komoditi</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/edit-komoditi" class="edit-komoditi" method="POST">
                    <div class="modal-body">
                        <input type="hidden" name="id_komoditi" value="${kom.id_komoditi}">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="komoditi">Komoditi</label>
                                <input type="text" class="form-control" id="komoditi" placeholder="Masukan Komoditi" name="komoditi" value="${kom.jenis_komoditi}">
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
tablebody.append(row);
modals.append(modal);

              })
        },
        error:function(xhr,status,error){
        console.log(xhr)
        console.log(status)
        console.log(error)
        }
     })   
    }
</script>
<?= $this->endSection('js');?>