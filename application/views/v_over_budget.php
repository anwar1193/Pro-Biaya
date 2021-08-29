  <!DOCTYPE html>
  <html>
  <head>
    <title>Over Budget</title>

    <script type = "text/javascript" > history.pushState(null, null); window.addEventListener('popstate', function(event) { history.pushState(null, null); }); </script>

    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="<?php echo base_url().'asset/' ?>bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url().'asset/' ?>bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?php echo base_url().'asset/' ?>bower_components/Ionicons/css/ionicons.min.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="<?php echo base_url().'asset/' ?>bower_components/jvectormap/jquery-jvectormap.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url().'asset/' ?>dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?php echo base_url().'asset/' ?>dist/css/skins/_all-skins.min.css">

    <!-- DataTables -->
    <link rel="stylesheet" href="<?php echo base_url().'asset' ?>/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

    <!-- jQuery 3 -->
    <script src="<?php echo base_url().'asset' ?>/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Jquery UI CSS -->
    <link rel="stylesheet" href="<?php echo base_url().'asset/' ?>jquery-ui.css">

  </head>
  <body>


    <!-- Modal Over Budget -->
    <form action="<?php echo base_url().'pengajuan_biaya/lanjut_over_budget' ?>" method="post">
    <!-- dibawah, data-backdrop & data-keyboard untuk mengunci supaya tidak close saat klik sembarang -->
    <div class="modal fade" id="modal-ob" data-keyboard="false" data-backdrop="static"> 
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button> -->
            <h4 class="modal-title">Pengajuan Over Budget</h4>
          </div>
          <div class="modal-body">

            <p>
              Saldo Budget Untuk Biaya Ini Tidak Mencukupi, Jika Anda Ingin Tetap Melanjutkan Harap Isi Form Alasan Over Budget Dibawah ini, Lalu "Lanjutkan Pengajuan"
            </p>

            <div class="form-group">
              <label>Alasan Over Budget</label>
              <textarea class="form-control" name="alasan_over_budget" autofocus required rows="5"></textarea>
            </div>

          </div>
          <div class="modal-footer">
            <a href="<?php echo base_url().'pengajuan_biaya/batal_over_budget' ?>" class="btn btn-danger pull-left"><i class="fa fa-times"></i> Batalkan Pengajuan</a>

            <button type="submit" class="btn btn-primary"><i class="fa fa-send"></i> Lanjutkan Pengajuan</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    </form>
    <!-- / Modal Over Budget -->

    <!-- jQuery 3 -->
  <script src="<?php echo base_url().'asset/' ?>bower_components/jquery/dist/jquery.min.js"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="<?php echo base_url().'asset/' ?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <!-- FastClick -->
  <script src="<?php echo base_url().'asset/' ?>bower_components/fastclick/lib/fastclick.js"></script>
  <!-- AdminLTE App -->
  <script src="<?php echo base_url().'asset/' ?>dist/js/adminlte.min.js"></script>
  <!-- Sparkline -->
  <script src="<?php echo base_url().'asset/' ?>bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
  <!-- jvectormap  -->
  <script src="<?php echo base_url().'asset/' ?>plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
  <script src="<?php echo base_url().'asset/' ?>plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
  <!-- SlimScroll -->
  <script src="<?php echo base_url().'asset/' ?>bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
  <!-- ChartJS -->
  <script src="<?php echo base_url().'asset/' ?>bower_components/chart.js/Chart.js"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="<?php echo base_url().'asset/' ?>dist/js/pages/dashboard2.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="<?php echo base_url().'asset/' ?>dist/js/demo.js"></script>

  <!-- DataTables -->
  <script src="<?php echo base_url().'asset' ?>/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="<?php echo base_url().'asset' ?>/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

  <script type="text/javascript">
    $('#modal-ob').modal('show');
  </script>

  <!-- Matikan Refresh -->
  <script type="text/javascript">
    $(function () {  
        $(document).keydown(function (e) {  
            return (e.which || e.keyCode) != 116;  
        });  
    }); 
  </script>
  
  </body>
  </html>

