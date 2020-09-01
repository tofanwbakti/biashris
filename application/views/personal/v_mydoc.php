<!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Dokumen Pribadi
        <!-- <small>Medical Checkup</small> -->
        </h1>
        <ol class="breadcrumb">
        <li><a href="<?=site_url('Dashboard') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="<?=site_url('C_Personal/data_pri') ?>"><i class="fa fa-user-md"></i>Data Pribadi</a></li>
        <li class="active">Dokumen</li>
        </ol>
    </section>

    <div class="pad margin no-print">
        <div class="callout callout-info" style="margin-bottom: 0!important;">												
        <h4><i class="fa fa-info"></i> Note:</h4>
        Dokumen pribadi bersifat rahasia.
        </div>
    </div>

    <!-- Main content -->
    <?php foreach($rowdok as $data) { } ?>
    <section class="invoice">
        <!-- title row -->
        <div class="row">
            <div class="col-xs-12">
                <h2 class="page-header">
                <i class="fa fa-globe"></i> <?=$data['fullname'] ?> 
                <!-- <small><?=$data['typedoc']?></small> -->
                <a href="<?=site_url('C_Personal/data_pri') ?>" class="btn btn-info btn-xs pull-right"> <i class="fa fa-undo"></i> Kembali</a>
                </h2>
            </div><!-- /.col -->
        </div>
        <!-- info row -->
        <div class="row invoice-info">
            <div class="box">
                <embed src="<?php echo base_url(); ?>uploads/documents/<?= $data['namadoc'] ?>" type="application/pdf" width ="100%" height = "600px" >
            </div>
        </div><!-- /.row -->

        <!-- this row will not appear when printing -->
        
    </section><!-- /.content -->
<!-- /.content-wrapper -->
