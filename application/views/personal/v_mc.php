<!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Surat MC
        <small>Medical Checkup</small>
        </h1>
        <ol class="breadcrumb">
        <li><a href="<?=site_url('Dashboard') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="<?=site_url('C_Personal/isak') ?>"><i class="fa fa-user-md"></i>Ijin Sakit</a></li>
        <li class="active">MC</li>
        </ol>
    </section>

    <div class="pad margin no-print">
        <div class="callout callout-info" style="margin-bottom: 0!important;">												
        <h4><i class="fa fa-info"></i> Note:</h4>
        Surat MC resmi yang dikeluarkan oleh dokter praktek. Harap serahkan dokumen asli ke Unit HRD
        </div>
    </div>

    <!-- Main content -->
    <?php foreach($rowisak as $data) { } ?>
    <section class="invoice">
        <!-- title row -->
        <div class="row">
            <div class="col-xs-12">
                <h2 class="page-header">
                <i class="fa fa-globe"></i> <?=$data['fullname'] ?> 
                <small class="pull-right">MC Tanggal: <?= date("d F Y",strtotime($data['tgl']) )?></small>
                </h2>
            </div><!-- /.col -->
        </div>
        <!-- info row -->
        <div class="row invoice-info">
            <div class="box"></div>
                <embed src="<?php echo base_url(); ?>uploads/suratmc/<?= $data['suratmc'] ?>" type="application/pdf" width ="100%" height = "600px" >
            </div>
            <div class="row no-print">
                <div class="col-xs-12">
                    <!-- <a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a> -->
                    <a href="<?=site_url('C_personal/isak') ?>" class="btn btn-info"> <i class="fa fa-undo"></i> Kembali</a>
                </div>
            </div>
        </div><!-- /.row -->

        <!-- this row will not appear when printing -->
        
    </section><!-- /.content -->
<!-- /.content-wrapper -->