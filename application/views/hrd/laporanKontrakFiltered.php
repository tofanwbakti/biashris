<!-- DASHBOARD Karyawan LIST -->
<!-- ditampilkan hanya untuk anggota HR Departement -->
<!-- ================================================ -->
<!-- Breadcumb section -->
<section class="content-header">
    <h1><i class="icon fa fa-file-o"></i>
        Laporan Kontrak
        <small>Pusat Informasi HR Department</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>Hrd"><i class="fa fa-dashboard"></i> Central Info HR</a></li>
        <li active><a href="<?=site_url('Hrd/laporanKontrak')?>"><i class="fa fa-circle-o text-red"></i> Laporan Kontrak</a></li>
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
            Berikut Laporan Kontrak Karyawan
        </div><!-- /.box-body -->
        <!-- <div class="box-footer">
            Footer
        </div>/.box-footer -->
    </div>
<!-- /.box -->

<!-- Main Row -->
<div class="row">
    <div class="col-md-12">
        <!-- Table -->
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Laporan Kontrak <strong >Karyawan</strong></h3>
                <a href="<?=site_url('LaporanPdf/kontrakFiltered/').encrypt_url($sbu).'/'.encrypt_url($jabatan).'/'.encrypt_url($range1).'/'.encrypt_url($range2) ?>" target="_blank" class="btn" data-toggle="tooltip" title="Cetak Semua">
                <i class="fa fa-print" style="margin-left:20px;font-size:20px"></i></a>
                <div class="pull-right">
                    <form action="<?=site_url('Hrd/laporanKontrakFilter')?>" method="post">
                    <div class="form-inline">
                        <label for="" style="margin-right:10px"> Filter Kategori : </label>
                        <select name="sbu" id="sbu" class="form-control">
                            <option selected disabled>Pilih SBU..</option>
                            <?php  
                            foreach($rowsbu as $data){ ?>
                            <option value="<?=$data['kode']?>"><?=$data['kode']?></option>
                            <?php } ?>
                        </select>
                        <select  class="jabatan form-control" name="jabatan" id="jabatan"  style="width:150px;margin-left:5px">
                            <option selected disabled>Pilih Jabatan..</option>
                            <?php foreach ($rowjab as $data) {?>
                                <option value="<?=$data['id_jab']?>"><?=$data['nama_jab']?></option>
                            <?php } ?>
                        </select>
                        <div class="input-group">
                            <input type="text" id="reportrange" class="form-control" name="daterange" style="width:200px">
                            <div class="input-group-addon"><i class="fa fa-calendar"></i>
                            </div>
                        </div>
                        <button type="submit" name="search" class="btn btn-info" style="margin-left:5px">Filter</button>
                        <a href="<?=site_url('Hrd/laporanKontrak')?>" class="btn btn-default"> Reset</a>
                    </div>
                    </form>        
                </div>                
            </div>
            
            <div class="box-body table-responsive">
                <table id="tablehistory" class="table table-bordered table-striped">
                    
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIP</th>
                            <th>Nama</th>
                            <th>Awal Kontrak</th>
                            <th>Akhir Kontrak</th> 
                            <th>SBU</th> 
                            <th>Jabatan</th>
                            <th>Durasi</th>                    
                        </tr>
                    </thead>
                    <tbody>
                    <?php $no=1;
                    foreach($rowlist as $data) { ?>
                        <tr>
                            <td><?=$no++?></td>
                            <td><?=$data['nip']?></td>
                            <td><?=$data['fullname']?></td>
                            <td><?=date("d M Y",strtotime($data['start']))?></td>
                            <td><?=date("d M Y",strtotime($data['end']))?></td>
                            <td><?=$data['kode']?></td>
                            <td><?=$data['nama_jab']?></td>
                            <td><?=$data['durasi']?></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- ./Table -->
    </div> <!-- ./ col -->
    
</div> <!-- ./ row -->


</section>