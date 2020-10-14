<!-- DASHBOARD Karyawan LIST -->
<!-- ditampilkan hanya untuk anggota HR Departement -->
<!-- ================================================ -->
<script type="text/javascript">
    function downloadxls(){
            window.location.assign('<?=base_url('LaporanXls/absenBreakBulanAktif') ?>');            
        }
</script>
<!-- Breadcumb section -->
<section class="content-header">
    <h1><i class="icon fa fa-file-o"></i>
        Laporan Istirahat
        <small>Pusat Informasi HR Department</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>Hrd"><i class="fa fa-dashboard"></i> Central Info HR</a></li>
        <li active><a href="<?=site_url('Hrd/laporanIstirahat') ?>"><i class="fa fa-circle-o text-red"></i> Laporan Istirahat</a></li>
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
            Berikut Laporan Istirahat Karyawan
        </div><!-- /.box-body -->
        <!-- <div class="box-footer">
            Footer
        </div>/.box-footer -->
    </div>
<!-- /.box -->

<!-- Info boxes -->
    <div class="row">
        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-green-gradient"><i class="ion ion-ios-people-outline"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Kehadiran</span>
                    <span class="info-box-number"><?php $today = gmdate("Y-m-d",time()+60*60*7);
                        $this->db->where('tgl',$today);
                        $this->db->where('id_kar !=',"1");
                        $this->db->from('tb_absensi');
                        echo $this->db->count_all_results();
                        ?>
                    </span>                    
                    <span class="pull-right"><a href="<?=site_url('LaporanPdf/laporanHadirSkrg') ?>" target="_blank" class="custom"><i class="fa fa-print" style="font-size:20px"></i></a></span>
                </div><!-- /.info-box-content -->
            </div><!-- /.info-box -->
        </div><!-- /.col -->
        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-blue-gradient"><i class="fa fa-coffee"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Istirahat</span>
                    <span class="info-box-number"><?php $today = gmdate("Y-m-d",time()+60*60*7);
                        $this->db->where('tgl_break',$today);
                        $this->db->where('id_kar !=',"1");
                        $this->db->from('tb_absen_istirahat');
                        echo $this->db->count_all_results();
                        ?>
                    </span>                    
                    <span class="pull-right"><a href="<?=site_url('LaporanPdf/laporanBreakToday') ?>" target="_blank" class="custom"><i class="fa fa-print" style="font-size:20px"></i></a></span>
                </div><!-- /.info-box-content -->
            </div><!-- /.info-box -->
        </div><!-- /.col -->
        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-yellow-gradient"><i class="fa fa-odnoklassniki-square"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Status ON</span>
                    <span class="info-box-number"><?php $today = gmdate("Y-m-d",time()+60*60*7);
                        $this->db->where('tgl_break',$today);
                        $this->db->where('break_status',"ON");
                        $this->db->where('id_kar !=',"1");
                        $this->db->from('tb_absen_istirahat');
                        echo $this->db->count_all_results();
                        ?>
                    </span>                    
                    <span class="pull-right"><a href="<?=site_url('LaporanPdf/laporanBreakOn') ?>" target="_blank" class="custom"><i class="fa fa-print" style="font-size:20px"></i></a></span>
                </div><!-- /.info-box-content -->
            </div><!-- /.info-box -->
        </div><!-- /.col -->   
        
    </div> <!-- /.row -->

<!-- Table -->
    <div class="row">
        <div class="col-xs-8">
            <div class="box">
                <div class="box-header">
                    <h2 class="box-title">Laporan Istirahat Karyawan</h2>
                    <div class="pull-right">
                        <a href="javascript:voi(0)" data-toggle="tooltip" title="Download Excel" onclick="downloadxls();" > <i class="text-green fa fa-file-excel-o" style="font-size:20px;margin-right:5px"></i></a>
                        <a href="<?=site_url('LaporanPdf/laporanBreakBulanAktif') ?>" target="_blank" data-toggle="tooltip" title="Download PDF" > <i class="fa fa-file-pdf-o text-red" style="font-size:20px"></i></a>
                        <!-- <a href="<?=site_url('Hrd/laporanAbsensiAll') ?>" data-toggle="tooltip" title="Lihat Semua"><i class="fa fa-database text-blue" style="font-size:20px;margin-left:5px"></i></a> -->
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body ">
                    <div class="table-responsive no-padding">
                        <table class="table table-hover" class="display" id="tablehistory3" style="width:100%">
                            <thead>
                                <tr>
                                    <th width="10px">No</th>
                                    <th>NIP</th>
                                    <th>Nama</th>
                                    <th width="80px">Tgl</th>
                                    <th>Mulai</th>
                                    <th>Selesai</th>
                                    <th>IPAddress</th>
                            </thead>
                            <tbody>
                            <?php $no = 1;
                            foreach ($rowBreak as $data){ ?>
                                <!-- <tr <?= $data['break_status'] == "OFF" ? "class='primary'" : null ?>> -->
                                <tr>
                                    <td><?= $no++?></td>
                                    <td><?=$data['nip'] ?></td>
                                    <td><?=$data['nickname'] ?></td>
                                    <td><?=date("d M Y",strtotime($data['tgl_break']))?></td>
                                    <td><?=$data['start_break'] ?></td>
                                    <td><?=$data['end_break'] ?></td>
                                    <td><?=$data['ipaddress'] ?></td>
                                </tr>
                            <?php }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div> <!-- ./ Box body -->
            </div>
        </div>
        <!-- Table Kanan -->
        <div class="col-xs-4">
            <div class="box box-danger">
                <div class="box-header">
                    <h3 class="box-title">Istirahat Hari Ini</h3>
                </div><!-- /.box-header -->
                <div class="box-body ">
                    <div class="table-responsive no-padding">
                        <table class="table table-hover" id="table3">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Mulai</th>
                                    <th>Selesai</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $no = 1;
                            foreach($rowBreakToday as $data) {
                            ?>
                                <tr>
                                    <td><?= $no++?></td>
                                    <td><?=$data['nickname'] ?></td>
                                    <td><?=$data['start_break'] ?></td>
                                    <td><?=$data['end_break'] ?></td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div> <!-- ./ Box body -->
            </div>
        </div>
        <!-- ./ Table Kanan -->
    </div>
<!-- ./ Table -->

</section>