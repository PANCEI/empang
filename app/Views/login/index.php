<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url() ?>plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?= base_url() ?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="<?= base_url() ?>plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="<?= base_url() ?>plugins/toastr/toastr.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url() ?>dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="../../index2.html" class="h1"><b>Login</b></a>
    </div>
    <div class="card-body">


      <form action="/masuk" method="post" class="masuk">
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Email" name="email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
        
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

  
      <!-- /.social-auth-links -->

     
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="<?= base_url() ?>plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url() ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url() ?>dist/js/adminlte.min.js"></script>
<script src="<?= base_url() ?>plugins/sweetalert2/sweetalert2.min.js"></script>
<script src="<?= base_url() ?>plugins/toastr/toastr.min.js"></script>
<script>
    
    var Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });
  
$(document).on('submit','form.masuk' , function(event){
event.preventDefault();
let form=$(this);
let email= form[0][0].value;
let password= form[0][1].value;
if(email == '' || password == ''){
  console.log('gagal');
  Toast.fire({
        icon: 'error',
        title: 'Inputan Yang Anda Tidak Lengkap'
      })
  return;
}
$.ajax({
  url:form.attr('action'),
  method:form.attr('method'),
  data:form.serialize(),
  success:function(data){
  if(data.success){
    Toast.fire({
      icon: 'success',
      title: 'Selamat Anda Berhasil Login'
      });
      window.location.href = '/dash';
  }
  if(data.error){
    Toast.fire({
      icon: 'error',
      title: data.error
      });
  }
  },
  error:function(){
    Toast.fire({
      icon: 'error',
      title: 'terjadi kesalahan'
      });
  }
})

})
</script>
</body>
</html>
