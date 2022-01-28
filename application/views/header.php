<?php  

    $nama_lengkap = $this->libraryku->tampil_user()->nama_lengkap;

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Pro-Biaya</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
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
  

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  
  <!-- Style Loading -->
  <style>
    #loading{
      width: 100%;
      height: 100%;
      position: fixed;
      text-indent: 100%;
      background: url('../../asset/gambar/loading3.gif') no-repeat;
      margin-left: 350px;
      margin-top: 120px;
      z-index: 1;
      opacity: 0.6;
      /* background-size: 10%; */
    }

    .perhatian{
      animation: animasi_notif 0.3s ease infinite alternate;
    }

    @keyframes animasi_notif{
      0%{
        opacity: 0;
      }

      100%{
        opacity: 1;
      }
    }

    @media print
    {    
        .no-print, .no-print *
        {
            display: none !important;
        }
    }
  </style>

</head>
<body class="hold-transition skin-yellow sidebar-mini 
<?= $this->uri->segment(1)=='all_pengajuan_tanggal' && $this->uri->segment(2)=='detail' ||
    $this->uri->segment(1)=='all_pengajuan_tanggal' && $this->uri->segment(2)=='jurnal_pic' ||
    $this->uri->segment(1)=='all_pengajuan_tanggal' && $this->uri->segment(2)=='jurnal_finance' ||
    $this->uri->segment(1)=='inbox' && $this->uri->segment(2)=='detail_counter' ||
    $this->uri->segment(1)=='inbox' && $this->uri->segment(2)=='detail_counter_lalu' ||
    $this->uri->segment(1)=='inbox' && $this->uri->segment(2)=='detail_counter_lalu_all' ||
    $this->uri->segment(1)=='data_user' && $this->uri->segment(2)=='history_clearlog' ||
    $this->uri->segment(1)=='data_user' && $this->uri->segment(2)=='log_login' ||
    $this->uri->segment(1)=='all_pengajuan_tanggal' && $this->uri->segment(2)=='jurnal_reverse' ||
    $this->uri->segment(1)=='p_bayar' && $this->uri->segment(2)=='detail' ||
    $this->uri->segment(1)=='p_bayar_final' && $this->uri->segment(2)=='detail' ||
    $this->uri->segment(1)=='inbox' && $this->uri->segment(2)=='detail_list_counter' ||
    $this->uri->segment(1)=='inbox' && $this->uri->segment(2)=='detail_list_counter_lalu' ||
    $this->uri->segment(1)=='kelebihan_biaya' && $this->uri->segment(2)=='detail' ||
    $this->uri->segment(1)=='review_kekurangan_accounting' && $this->uri->segment(2)=='jurnal_pic' ||
    $this->uri->segment(1)=='review_kekurangan_accounting' && $this->uri->segment(2)=='jurnal_finance' ||
    $this->uri->segment(1)=='review_kelebihan_accounting' && $this->uri->segment(2)=='jurnal_balik' ||
    $this->uri->segment(1)=='review_penyelesaian_dikembalikan' && $this->uri->segment(2)=='jurnal_balik'
? 'sidebar-collapse' : null ?>"
>

<div class="wrapper">

  <header class="main-header">

    <!-- Logo -->
    <a href="#" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Pro-</b>Biaya</span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          
          <!-- Icon Lonceng Pemberitahuan -->
          <!-- <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-success" id="tot-mhs">8</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">Ada 8 Pemberitahuan</li>
              <li class="footer"><a href="#">Lihat Data</a></li>
            </ul>
          </li> -->


          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo base_url().'asset/' ?>dist/img/avatar5.jpg" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $nama_lengkap; ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?php echo base_url().'asset/' ?>dist/img/avatar5.jpg" class="user-image" alt="User Image">

                <p>
                  <?php echo $nama_lengkap; ?> - PT Procar Int'l Finance
                </p>
              </li>
              <!-- Menu Body -->
              
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-right">
                  <a href="<?php echo base_url().'login/logout' ?>" class="btn btn-danger btn-flat">Logout</a>
                </div>
              </li>
            </ul>
          </li>

          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>

    </nav>
  </header>

<!-- jQuery 3 -->
<script src="<?php echo base_url().'asset/' ?>bower_components/jquery/dist/jquery.min.js"></script>