<!-- DASHBOARD Karyawan LIST -->
<!-- ditampilkan hanya untuk anggota HR Departement -->
<!-- ================================================ -->
<!-- Breadcumb section -->
<section class="content-header">
    <h1><i class="icon fa fa-file-o"></i>
        Laporan Absensi
        <small>Pusat Informasi HR Department</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>Hrd"><i class="fa fa-dashboard"></i> Central Info HR</a></li>
        <li active><a href="<?= site_url('Hrd/laporanAbsensi')?>"><i class="fa fa-circle-o text-red"></i> Laporan Absensi</a></li>
</section>
<!-- Main content -->
<section class="content">

<!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Hi! <b> <?= $this->fungsi->user_login()->nickname ?> </b> Selamat Datang</h3> 
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
            </div>
        </div>
        <div class="box-body">
            Berikut Laporan Absensi Karyawan <strong style="font-size:20px"><?php foreach($rowkarbyid as $data) echo $data['fullname'] ?></strong>
        </div><!-- /.box-body -->
        <!-- <div class="box-footer">
            Footer
        </div>/.box-footer -->
    </div>
<!-- /.box -->
<div class="box box-primary">
    <div class="box-header">
        <h3 class="box-title">Laporan Absensi <strong ><?php foreach($rowkarbyid as $data) echo $data['fullname'] ?></strong></h3>
        <a href="<?=site_url('LaporanPdf/absenRange/').encrypt_url($data['id_kar']).'/'.encrypt_url($data['fullname']).'/'.encrypt_url($range1).'/'.encrypt_url($range2) ?>" target="_blank" class="btn" data-toggle="tooltip" title="Print">
        <i class="fa fa-print" style="margin-left:20px;font-size:20px"></i></a>
        
        <div class="pull-right">
            <!-- <form action="<?=site_url('Hrd/laporanAbsenKar2')?>" method="post"> -->
            <div class="form-inline">
                <label for="" style="margin-right:10px"> Cari Tanggal : </label>
                <div class="input-group">
                    <input type="hidden" name="idkar" value="<?=$data['id_kar']?>">
                    <input type="text" class="form-control" value="<?= date("m/d/Y",strtotime($range1)),' - ',date("m/d/Y",strtotime($range2)) ?>" name="daterange" style="width:200px" disabled>
                    <div class="input-group-addon"><i class="fa fa-calendar"></i>
                    </div>
                </div>
                <!-- <button type="submit" name="search" class="btn btn-info" style="margin-left:5px">Cari</button> -->
                <a href="<?= site_url('Hrd/laporanAbsenKar/').encrypt_url($data['id_kar']).'/'.encrypt_url($data['fullname']) ?>" class="btn btn-default">Reset</a>
            </div>
            <!-- </form> -->
        </div>
        <div class=""><?= date("d-M-Y",strtotime($range1)),' s/d ',date("d-M-Y",strtotime($range2)) ?></div>
    </div>
    <div class="box-body table-responsive">
        <table id="tablereport" class="table table-bordered table-striped">
            
            <thead>
                <tr>
                    <th>No</th>
                    <th>Hari</th>
                    <th>Tanggal</th>
                    <th>Jam Masuk</th>
                    <th>Jam Keluar</th> 
                    <th>Keterangan</th> 
                </tr>
            </thead>
            <tbody>
            <?php $no=1; 
            foreach($presentrange as $data){ ?>
                <tr>
                    <td><?=$no++;?></td>
                    <td><?php if($data['hari'] == "Monday" ){
                        echo "Senin";
                    } elseif($data['hari'] == "Tuesday") {
                        echo "Selasa";
                    } elseif($data['hari'] == "Wednesday") {
                        echo "Rabu";
                    } elseif($data['hari'] == "Thursday") {
                        echo "Kamis";
                    } elseif($data['hari'] == "Friday") {
                        echo "Jumat";
                    }elseif($data['hari'] == "Saturday") {
                        echo "Sabtu";
                    }elseif($data['hari'] == "Sunday") {
                        echo "Minggu";
                    } ?></td>
                    <td><?=date("d F Y",strtotime($data['tgl']))?></td>
                    <td><?=$data['jam_masuk']?></td>
                    <td <?=$data['jam_pulang']=="null"? "class='danger'" : null ?>><?=$data['jam_pulang']?></td>
                    <td><?php if($data['status'] == "2") echo "Terlambat" ?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>

</section>


