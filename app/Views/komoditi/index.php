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
     
          <div class="col-4 ">
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
                  <tbody>
                    <?php  $i=1 ?>
                    <?php foreach($komoditi as $ko): ?>
                        <tr>
                          <td><?= $i; ?></td>
                          <td><?= $ko['jenis_komoditi']; ?></td>
                          <td>
                          <a class="btn btn-primary btn-xs">
                          <i class="fas fa-edit"></i> Edit
                            </a>
                          </td>
                        </tr>
                    <?php $i++; ?>
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
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
<?= $this->endSection('content'); ?>
<?= $this->section('js'); ?>
<?= $this->endSection('js');?>