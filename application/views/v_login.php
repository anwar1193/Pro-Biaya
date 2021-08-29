
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Login-Pro Biaya</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->  
  <link rel="icon" type="image/png" href="<?php echo base_url().'asset_login/' ?>/images/icons/favicon.ico"/>
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url().'asset_login/' ?>/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url().'asset_login/' ?>/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url().'asset_login/' ?>/vendor/animate/animate.css">
<!--===============================================================================================-->  
  <link rel="stylesheet" type="text/css" href="<?php echo base_url().'asset_login/' ?>/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url().'asset_login/' ?>/vendor/select2/select2.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url().'asset_login/' ?>/css/util.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url().'asset_login/' ?>/css/main.css">
<!--===============================================================================================-->


</head>
<body>
  
  <div class="limiter">
    <div class="container-login100">
      <div class="wrap-login100">
        <div class="login100-pic js-tilt" data-tilt>
          <center>
          <img src="<?php echo base_url().'asset_login/' ?>/images/procar.png" alt="IMG" class="img-thumbnail" width="70%">
        </div>

        <form method="post" action="<?php echo base_url().'login/proses' ?>" class="login100-form validate-form">
          <span class="login100-form-title">
            Pro-Biaya Login
          </span>

          <div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
            <input class="input100" type="text" name="username" placeholder="Username" autocomplete="off">
            <span class="focus-input100"></span>
            <span class="symbol-input100">
              <i class="fa fa-user" aria-hidden="true"></i>
            </span>
          </div>

          <div class="wrap-input100 validate-input" data-validate = "Password is required">
            <input class="input100 form-password" type="password" name="password" placeholder="Password" autocomplete="off">
            <span class="focus-input100"></span>
            <span class="symbol-input100">
              <i class="fa fa-lock" aria-hidden="true"></i>
            </span>
          </div>

          &nbsp; &nbsp; &nbsp; <input type="checkbox" class="form-checkbox"> Show password
          
          <div class="container-login100-form-btn">
            <button type="submit" name="submit" class="login100-form-btn">
              Login
            </button>
          </div>

          <div class="text-center p-t-12">
            <span class="txt1">
              Perlu Bantuan?
            </span>
            <a class="txt2" id="lupa" href="#" data-toggle="modal" data-target="#modal-bantuan">
              Hubungi Kami
            </a>
          </div>

          <div class="text-center p-t-12">
            <span class="txt1">
              Lupa Logout? Klik :
            </span>
            <a class="btn btn-success btn-sm" id="clear_session" href="#" data-toggle="modal" data-target="#modal-clear">
              Clear Session
            </a>
          </div>

          <!-- <div class="text-center p-t-136">
            <a class="txt2" href="#">
              Create your Account
              <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
            </a>
          </div> -->
        </form>
      </div>
    </div>
  </div>
  
  

  
<!--===============================================================================================-->  
  <script src="<?php echo base_url().'asset_login/' ?>/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
  <script src="<?php echo base_url().'asset_login/' ?>/vendor/bootstrap/js/popper.js"></script>
  <script src="<?php echo base_url().'asset_login/' ?>/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
  <script src="<?php echo base_url().'asset_login/' ?>/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
  <script src="<?php echo base_url().'asset_login/' ?>/vendor/tilt/tilt.jquery.min.js"></script>
  <script >
    $('.js-tilt').tilt({
      scale: 1.1
    })
  </script>
<!--===============================================================================================-->
  <script src="<?php echo base_url().'asset_login/' ?>/js/main.js"></script>

</body>
</html>

<!-- <script type="text/javascript">
  $(document).ready(function(){
    $(document).on('click', '#lupa', function(){
      alert('Silahkan Hubungi Team IT Development Procar - Anwar (085219063505)');
    })
  })
</script> -->


<!-- Script Lihat Password -->
  <script type="text/javascript">
    $(document).ready(function(){   
      $('.form-checkbox').click(function(){
        if($(this).is(':checked')){
          $('.form-password').attr('type','text');
        }else{
          $('.form-password').attr('type','password');
        }
      });
    });
  </script>


<!-- Modal Bantuan -->
 <div class="modal fade" id="modal-bantuan" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Kontak Kami</h4>
      </div>
      <div class="modal-body">
        <p style="text-align: justify;">
          Untuk hal-hal yang berkaitan dengan bisnis: Jenis biaya/Persyaratan biaya (non teknis IT), silahkan hubungi PIC Department Reviewer Biaya terkait atau Accounting Department (PIC: Welly)<br>
          
        </p>

        <p>
          * Email : <b>welly@procarfinance.com</b>, <br>
          &nbsp;&nbsp; CC : <b>gadis@procarfinance.com</b> <br>
          * Telepon/WA : <b>081219856038</b>
        </p>
        <br>

        <p style="text-align: justify;">
          Untuk hal-hal yang berkaitan dengan Teknis aplikasi (IT), silahkan hubungi IT Application & Development (PIC: Anwar/Khairul)
        </p>

        <p>
          * Email : <b>munawar.ahmad@procarfinance.com , datacenter@procarfinance.com</b> <br>
          * Telepon/WA : <b>085219063505 (Anwar), 081219971941(Khairul)</b>
        </p>
        <br>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



<!-- Modal Clear -->
<form method="POST" action="<?php echo base_url().'login/hapus_session' ?>">
 <div class="modal fade" id="modal-clear" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Hapus Session Login</h4>
      </div>

      <div class="modal-body">

          <input class="form-control" type="text" name="username" placeholder="Masukan Username" autocomplete="off" required>

          <input class="form-control" type="password" name="password" placeholder="Masukan Password" autocomplete="off" required>

      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success btn-sm">Hapus Session</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
</form>