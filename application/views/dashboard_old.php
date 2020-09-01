<!-- DASHBOARD UMUM  --> 
<!-- ditampilkan untuk semua akun user -->
<!-- =================================================== -->
<!-- Breadcumb section -->
<section class="content-header">
    <h1>
        Dashboard
        <small>semua berawal dari sini</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
</section>

<!-- Main content -->
<section class="content">

<!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Hi! <b><?= $this->fungsi->user_login()->nickname ?></b> Selamat Datang</h3> 
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
            </div>
        </div>
        <div class="box-body">
            Semoga harimu menyenangkan
        </div><!-- /.box-body -->
        <!-- <div class="box-footer">
            Footer
        </div>/.box-footer -->
    </div>
<!-- /.box -->

<!-- Small boxes (Stat box) -->
    <div class="row">
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-yellow">
                <div class="inner">
                <!-- <?php //foreach ($totikel as $hitisi) { ?> -->
                  <h3>?</h3>
                  <p>Ijin Keluar Kantor</p>
                </div>
                <div class="icon">
                  <i class="fa fa-share"></i>
                </div>
                <a href="#" class="small-box-footer">
                    Info Lebih <i class="fa fa-arrow-circle-right"></i>
                </a>
                <!-- <?php //} ?> -->
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-red">
                <div class="inner">
                  <h3>65</h3>
                  <p>Sisa Cuti</p>
                </div>
                <div class="icon">
                  <i class="fa fa-briefcase"></i>
                </div>
                <a href="#" class="small-box-footer">
                  Info Lebih <i class="fa fa-arrow-circle-right"></i>
                </a>
              </div>
            </div><!-- ./col -->
          </div><!-- /.row -->

<!-- =========================================================== -->

</section><!-- /.content -->