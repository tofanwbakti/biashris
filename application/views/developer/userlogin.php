<!-- DASHBOARD HRD -->
<!-- ditampilkan hanya untuk anggota HR Departement -->
<!-- ================================================ -->
<!-- Breadcumb section -->
<section class="content-header">
    <h1>
        <div class="icon">
        <i class="fa fa-dashboard"></i> Dashboard
        <small>Developer Mode</small>
        </div>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>Developer"><i class="fa fa-dashboard"></i> Developer</a></li>
</section>

<!-- Flash Data -->
<div class="flash-unit" data-flashdata="<?=$this->session->flashdata('flash'); ?>"></div>

<!-- Main content -->
<section class="content">

<!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Hello Bos! <b> </b> Welcome Back</h3> 
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
            </div>
        </div>
        <div class="box-body">
            Enjoy your day.. every day is improvement! 
        </div><!-- /.box-body -->
        <div class="box-footer">
            We working on version <b>20.09.1</b> now.
        </div>
        <!-- /.box-footer -->
    </div>
<!-- /.box -->
    <div class="row">
        <div class="col-md-12">
            <!-- TABLE: LATEST ORDERS -->
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Log User Login</h3>
                    <div class="pull-right" style="margin-left:20px">
                        <!-- <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#modalTambah"><i class="fa fa-plus-square"></i>    Kontrak Baru </button> -->
                        <div class="dropdown">
                            <button class="btn btn-primary btn-xs dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-print"style="margin-right:5px"> </i>  Print PDF <span class="caret" style="margin-left:3px"></span>
                            </button>
                            <ul class="dropdown-menu pull-right">
                                <li><a href="<?= site_url('LaporanPdf/laporanLoginToday')?>" target="_window"><i class="fa fa-file-pdf-o text-red"></i> Today</a></li>
                                <li><a href="<?= site_url('LaporanPdf/laporanLoginMonthly')?>" target="_window"><i class="fa fa-file-pdf-o text-red"></i> This Month</a></li>
                                <li><a href="<?= site_url('LaporanPdf/laporanLoginAll')?>" target="_window"><i class="fa fa-file-pdf-o text-red"></i> All</a></li>
                            </ul>                                
                        </div>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                    <table class="table no-margin" id="tablehistory">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Email</th>
                            <th width="20px">Status</th>
                            <!-- <th>On Version</th> -->
                        </tr>
                        </thead>
                        <tbody>
                        <?php $no=1; foreach($row as $data){ ?>
                        <tr>
                            <td><?=$no++?></td>
                            <td><?=$data->date_login?></td>
                            <td><?=$data->time_login?></td>
                            <td><?=$data->email?></td>
                            <td class="text-center"><?=$data->status == "ON" ? "<a href='".site_url('Developer/turnOffLogin/').encrypt_url($data->email)."' class='tombol-off'
                            ><i class='fa fa-power-off' style='font-size:16px'></i></a>" : "<i class='fa fa-power-off text-muted' style='font-size:16px' disabled></i>" ?> </td>
                        </tr>
                        <?php }?>
                        </tbody>
                    </table>
                    </div><!-- /.table-responsive -->
                </div><!-- /.box-body -->
            
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div>
<!-- =========================================================== -->

</section><!-- /.content -->
