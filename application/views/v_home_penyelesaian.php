<!-- Row Utama -->
<div class="row">

  <!-- Kolom Penyelesaian Kekurangan -->
  <div class="col-md-8">

  <!-- Main content Pengajuan Biaya-->
  <section class="content" style="border:5px dashed green; margin-left:10px; margin-right:0px; ; margin-top:10px">

  <p>
    <span style="font-weight:bold; font-size:20px; text-decoration: underline;">Dashboard Penyelesaian Kekurangan Biaya</span>
  </p>
    
  <!-- Dashboard Utama -->
    <div class="row" style="margin-top:20px">
      <div class="col-md-3 col-sm-6 col-xs-12">
        <a style="color: black" href="<?php echo base_url().'inquiry_kekurangan_biaya/on_proccess' ?>">
        <div class="info-box">
          <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>
          
          <div class="info-box-content">
            <span class="info-box-text">On Proccess</span>
            <span class="info-box-number"><?php echo $data_onproccess2; ?></span>
          </div>
          
          <!-- /.info-box-content -->
        </div>
        </a>
        <!-- /.info-box -->
      </div>      
      <!-- /.col -->

      <!-- fix for small devices only -->
      <div class="clearfix visible-sm-block"></div>

      <div class="col-md-3 col-sm-6 col-xs-12">
        <a style="color: black" href="<?php echo base_url().'inquiry_kekurangan_biaya/final_approved' ?>">
        <div class="info-box">
          <span class="info-box-icon bg-green"><i class="fa fa-check"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Final Approved</span>
            <span class="info-box-number"><?php echo $data_approved2; ?></span>
          </div>
          <!-- /.info-box-content -->
        </div>
        </a>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->

      <div class="col-md-3 col-sm-6 col-xs-12">
        <a style="color: black" href="<?php echo base_url().'inquiry_kekurangan_biaya/revisi' ?>">
        <div class="info-box">
          <span class="info-box-icon bg-yellow"><i class="fa fa-refresh"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Revisi</span>
            <span class="info-box-number"><?php echo $data_revisi2; ?></span>
          </div>
          <!-- /.info-box-content -->
        </div>
        </a>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->

      <div class="col-md-3 col-sm-6 col-xs-12">
        <a style="color: black" href="<?php echo base_url().'inquiry_kekurangan_biaya/rejected' ?>">
        <div class="info-box">
          <span class="info-box-icon bg-red"><i class="fa fa-times"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Rejected</span>
            <span class="info-box-number"><?php echo $data_rejected2; ?></span>
          </div>
          <!-- /.info-box-content -->
        </div>
        </a>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->


    </div>
  <!-- / Dashboard Utama -->

  <!-- Dashboard Paling Bener -->

    <div class="row" style="margin-top:20px">
      
      <div class="col-md-4">
        <!-- Widget: user widget style 1 -->
        <div class="box box-widget widget-user-2">
          <!-- Add the bg color to the header using any of the bg-* classes -->
          <div class="widget-user-header bg-yellow">
            <h4>Proses Review - PIC Dept</h4>
          </div>
          <div class="box-footer no-padding">
            <ul class="nav nav-stacked">

              <!-- Jika Ada data di pending, buat background warnanya jadi kuning -->
              <?php if($data_pending_pic2 > 0){ ?>
                <li style="background-color: yellow">
                  <a href="<?php echo base_url().'inquiry_kekurangan_biaya/pending' ?>">Pending - PIC Dept <span class="pull-right badge bg-green">
                    <?php echo $data_pending_pic2; ?>
                  </span></a>
                </li>
              <?php }else{ ?>
                <li>
                  <a href="<?php echo base_url().'inquiry_kekurangan_biaya/pending' ?>">Pending - PIC Dept <span class="pull-right badge bg-green">
                    <?php echo $data_pending_pic2; ?>
                  </span></a>
                </li>
              <?php } ?>

              <li>
                <a href="<?php echo base_url().'inquiry_kekurangan_biaya/verified' ?>">Verified - PIC Dept <span class="pull-right badge bg-green">
                  <?php echo $data_verified; ?>
                </span></a>
              </li>

            </ul>
          </div>
        </div>
        <!-- /.widget-user -->
      </div>
      <!-- /.col -->


      <div class="col-md-4">
        <!-- Widget: user widget style 1 -->
        <div class="box box-widget widget-user-2">
          <!-- Add the bg color to the header using any of the bg-* classes -->
          <div class="widget-user-header bg-aqua">
            <h4>Proses Payment - Finance Dept</h4>
          </div>
          <div class="box-footer no-padding">
            <ul class="nav nav-stacked">

              <li>
                <a href="inquiry_kekurangan_biaya/proses_bayar">Proses Bayar - Finance <span class="pull-right badge bg-yellow">
                  <?php echo $data_proses_bayar2; ?>
                </span></a>
              </li>

              <li>
                <a href="inquiry_kekurangan_biaya/telah_dibayar">Pembayaran Selesai <span class="pull-right badge bg-yellow">
                  <?php echo $data_telbay2; ?>
                </span></a>
              </li>
            </ul>
          </div>
        </div>
        <!-- /.widget-user -->
      </div>
      <!-- /.col -->


      <div class="col-md-4">
        <!-- Widget: user widget style 1 -->
        <div class="box box-widget widget-user-2">
          <!-- Add the bg color to the header using any of the bg-* classes -->
          <div class="widget-user-header bg-green">
            <h4>Proses Review - Accounting Dept</h4>
          </div>
          <div class="box-footer no-padding">
            <ul class="nav nav-stacked">

              <!-- <li>
                <a href="<?php echo base_url().'p_dokumen_pending' ?>">Dokumen Pending <span class="pull-right badge bg-aqua">
                  <?php echo $data_pendok; ?>
                </span></a>
              </li> -->

              <li>
                <a href="#">Verified By Accounting <span class="pull-right badge bg-aqua">
                  <?php echo 0; //$data_accdok; ?>
                </span></a>
              </li>
            </ul>
          </div>
        </div>
        <!-- /.widget-user -->
      </div>
      <!-- /.col -->

    </div>
    <!-- /.row -->

  <!-- / Dashboard Paling Bener -->
    
  </section>
  <!-- /.main content pengajuan biaya-->

  </div>
  <!-- Penutup Kolom Penyelesaian Kekurangan -->


  <!-- Kolom Penyelesaian Kelebihan -->
  <div class="col-md-4">
  
  <!-- Main content Pengajuan Biaya-->
  <section class="content" style="border:5px dashed blue; margin-left:0px; margin-right:10px; ; margin-top:10px">

  <p>
    <span style="font-weight:bold; font-size:20px; text-decoration: underline;">Dashboard Penyelesaian Kelebihan Biaya</span>
  </p>


  <!-- Dashboard Paling Bener -->

    <div class="row">
      
      <div class="col-md-12">
        <!-- Widget: user widget style 1 -->
        <div class="box box-widget widget-user-2">
          <!-- Add the bg color to the header using any of the bg-* classes -->
          <div class="widget-user-header bg-yellow">
            <h4>Proses Review - PIC Dept</h4>
          </div>
          <div class="box-footer no-padding">
            <ul class="nav nav-stacked">

              <!-- Jika Ada data di pending, buat background warnanya jadi kuning -->
              <?php if($data_pending_pic3 > 0){ ?>
                <li style="background-color: yellow">
                  <a href="<?php echo base_url().'inquiry_kelebihan_biaya/pending' ?>">Pending - PIC Dept <span class="pull-right badge bg-green">
                    <?php echo $data_pending_pic3; ?>
                  </span></a>
                </li>
              <?php }else{ ?>
                <li>
                  <a href="<?php echo base_url().'inquiry_kelebihan_biaya/pending' ?>">Pending - PIC Dept <span class="pull-right badge bg-green">
                    <?php echo $data_pending_pic3; ?>
                  </span></a>
                </li>
              <?php } ?>

              <li>
                <a href="<?php echo base_url().'inquiry_kelebihan_biaya/verified' ?>">Verified - PIC Dept <span class="pull-right badge bg-green">
                  <?php echo $data_verified2; ?>
                </span></a>
              </li>

            </ul>
          </div>
        </div>
        <!-- /.widget-user -->
      </div>
      <!-- /.col -->


      <div class="col-md-12">
        <!-- Widget: user widget style 1 -->
        <div class="box box-widget widget-user-2">
          <!-- Add the bg color to the header using any of the bg-* classes -->
          <div class="widget-user-header bg-green">
            <h4>Proses Review - Accounting Dept</h4>
          </div>
          <div class="box-footer no-padding">
            <ul class="nav nav-stacked">

              <!-- <li>
                <a href="<?php echo base_url().'p_dokumen_pending' ?>">Dokumen Pending <span class="pull-right badge bg-aqua">
                  <?php echo $data_pendok; ?>
                </span></a>
              </li> -->

              <li>
                <a href="#">Verified By Accounting <span class="pull-right badge bg-aqua">
                  <?php echo 0;//$data_accdok; ?>
                </span></a>
              </li>
            </ul>
          </div>
        </div>
        <!-- /.widget-user -->
      </div>
      <!-- /.col -->

    </div>
    <!-- /.row -->

  <!-- / Dashboard Paling Bener -->
    
  </section>
  <!-- /.main content pengajuan biaya-->

  </div>
  <!-- Penutup Kolom Penyelesaian Kelebihan -->

</div>
<!-- Penutup Row Utama -->

