<!-- DASHBOARD Karyawan LIST -->
<!-- ditampilkan hanya untuk anggota HR Departement -->
<!-- ================================================ -->
<script type="text/javascript">
    function downloadxls(){
            window.location.assign('<?=base_url('LaporanXls/absenBulanAktif') ?>');            
        }
</script>
<!-- Breadcumb section -->
<section class="content-header">
    <h1><i class="icon fa fa-file-o"></i>
        Laporan Absensi
        <small>Pusat Informasi HR Department</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>Hrd"><i class="fa fa-dashboard"></i> Central Info HR</a></li>
        <li active><a href="#"><i class="fa fa-circle-o text-red"></i> Laporan Absensi</a></li>
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
            Berikut Laporan Absensi Karyawan
        </div><!-- /.box-body -->
        <!-- <div class="box-footer">
            Footer
        </div>/.box-footer -->
    </div>
<!-- /.box -->

<!-- Info boxes -->
    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-aqua-gradient"><i class="ionicons ion-log-in"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Kehadiran</span>
                    <span class="info-box-number">
                        <?php 
                        $this->db->where('status',"Y");
                        // $this->db->where('email!=',"admin@batam-samudra.id");
                        $data = $this->db->count_all_results('tb_kontrak');
                        // echo $data;

                        $today = gmdate("Y-m-d",time()+60*60*7);
                        $this->db->where('tgl',$today);
                        $this->db->where('id_kar!=',"1");
                        $data2 = $this->db->count_all_results('tb_absensi');

                        $hasil = ($data2/$data)*100;

                        echo round($hasil);
                        ?>
                        <small> %</small>
                    </span>
                </div><!-- /.info-box-content -->
            </div><!-- /.info-box -->
        </div><!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-purple-gradient"><i class="ion-ios-close-outline"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Alpha</span>
                    <span class="info-box-number"><?php 
                    $this->db->where('status',"Y");
                    // $this->db->where('email!=',"admin@batam-samudra.id");
                    $data = $this->db->count_all_results('tb_kontrak');

                    $today = gmdate("Y-m-d",time()+60*60*7);
                    $this->db->where('tgl',$today);
                    $this->db->where('id_kar!=',"1");
                    $data2 = $this->db->count_all_results('tb_absensi');
                    $hitung = $data-$data2;
                    $hasil = ($hitung/$data)*100;
                    echo round($hasil);
                    ?><small> %</small>
                    </span>
                </div><!-- /.info-box-content -->
            </div><!-- /.info-box -->
        </div><!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-green-gradient"><i class="ion ion-ios-people-outline"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Hadir Hari Ini</span>
                    <span class="info-box-number"><?php $today = gmdate("Y-m-d",time()+60*60*7);
                        $this->db->where('tgl',$today);
                        $this->db->where('id_kar !=',"1");
                        // $this->db->where('status',"1");
                        $this->db->from('tb_absensi');
                        echo $this->db->count_all_results();
                        ?>                            
                    </span>
                    <span class="pull-right"><a href="<?=site_url('LaporanPdf/laporanHadirSkrg') ?>" target="_blank" class="custom"><i class="fa fa-print" style="font-size:20px"></i></a></span>
                </div><!-- /.info-box-content -->
            </div><!-- /.info-box -->
        </div><!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-red-gradient"><i class="ion ion-ios-people-outline"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Terlambat Hari Ini</span>
                    <span class="info-box-number">
                        <?php $today = gmdate("Y-m-d",time()+60*60*7);
                        $this->db->where('tgl',$today);
                        $this->db->where('absen_status',"2");
                        $this->db->where('id_kar !=',"1");
                        $this->db->from('tb_absensi');
                        echo $this->db->count_all_results();
                        ?>
                    </span>
                    <span class="pull-right"><a href="<?=site_url('LaporanPdf/laporanLambatSkrg') ?>" target="_blank" class="custom"><i class="fa fa-print" style="font-size:20px"></i></a></span>
                </div><!-- /.info-box-content -->
            </div><!-- /.info-box -->
        </div><!-- /.col -->
    </div> <!-- /.row -->

<!-- Table -->
    <div class="row">
        <div class="col-xs-8">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="active">
                        <a href="#perKaryawan" data-toggle="tab"><i class="fa fa-power-off text-blue" style="margin-right:10px"></i>Per Karyawan</a>
                    </li>
                    <li>
                        <a href="#allKaryawan" data-toggle="tab"><i class="fa fa-power-off text-yellow" style="margin-right:10px"></i>Semua Karyawan</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="perKaryawan">
                        <div class="box">
                            <div class="box-header">
                                <h2 class="box-title">Laporan Per Karyawan</h2>
                            </div><!-- /.box-header -->
                            <div class="box-body ">
                                <div class="table-responsive no-padding">
                                    <table class="table table-hover" id="tablehistory">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>NIP</th>
                                                <th>Nama</th>
                                                <th>SBU</th>
                                                <th style="margin:right">Detail</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $no = 1;
                                        foreach($rowkar as $data) {
                                        ?>
                                            <tr>
                                                <td><?=$no++?></td>
                                                <td><?php $email = $data['email'];
                                                    $this->db->select('*');
                                                    $this->db->from('tb_kontrak');
                                                    $this->db->where('email',$email); 
                                                    $this->db->where('status','Y');                            
                                                    $query =  $this->db->get();
                                                    foreach($query->result() as $row){
                                                        echo $row->nip;
                                                    }
                                                    ?>
                                                </td>
                                                <td><?=$data['fullname'] ?></td>
                                                <td><?=$data['kode'] ?></td>
                                                <td><a href="<?= site_url('Hrd/laporanAbsenKar/').encrypt_url($data['id_kar']).'/'.encrypt_url($data['fullname']) ?>" class="btn btn-xs btn-primary pull-right"><i class="fa fa-info-circle text-purple" style="margin-right:2px"></i>  Detail </a> </td>
                                            </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div> <!-- ./ Box body -->
                        </div>
                    </div>
                    <div class="tab-pane" id="allKaryawan">
                        <div class="box">
                            <div class="box-header">
                                <h2 class="box-title">Laporan Absensi Karyawan</h2>
                                <div class="pull-right">
                                    <a href="javascript:voi(0)" data-toggle="tooltip" title="Download Excel" onclick="downloadxls();" > <i class="text-green fa fa-file-excel-o" style="font-size:20px;margin-right:5px"></i></a>
                                    <a href="<?=site_url('LaporanPdf/laporanBulanAktif') ?>" target="_blank" data-toggle="tooltip" title="Download PDF" > <i class="fa fa-file-pdf-o text-red" style="font-size:20px"></i></a>
                                    <a href="<?=site_url('Hrd/laporanAbsensiAll') ?>" data-toggle="tooltip" title="Lihat Semua"><i class="fa fa-database text-blue" style="font-size:20px;margin-left:5px"></i></a>
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
                                                <th>Masuk</th>
                                                <th>Pulang</th>
                                                <!-- <th>Status</th> -->
                                        </thead>
                                        <tbody>
                                        <?php $no = 1;
                                        foreach ($rowabsen as $data){ ?>
                                            <tr <?= $data['absen_status'] == "2" ? "class='danger'" : null ?>>
                                                <td><?= $no++?></td>
                                                <td><?=$data['nip'] ?></td>
                                                <td><?=$data['nickname'] ?></td>
                                                <td><?=date("d M Y",strtotime($data['tgl']))?></td>
                                                <td><?=$data['jam_masuk'] ?></td>
                                                <td><?=$data['jam_pulang'] ?></td>
                                                <!-- <td><?=$data['status'] ?></td> -->
                                            </tr>
                                        <?php }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div> <!-- ./ Box body -->
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        <!-- Table Kanan -->
        <div class="col-xs-4">
            <div class="box box-danger">
                <div class="box-header">
                    <h3 class="box-title">Kehadiran Hari Ini</h3>
                </div><!-- /.box-header -->
                <div class="box-body ">
                    <div class="table-responsive no-padding">
                        <table class="table table-hover" id="table3">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NIP</th>
                                    <th>Nama</th>
                                    <th>Jam Masuk</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $no = 1;
                            foreach($rowhadir as $data) {
                            ?>
                                <tr <?= $data['absen_status'] == "2" ? "class='danger'" : null ?>>
                                    <td><?= $no++?></td>
                                    <td><?php $idkar = $data['id_kar'];
                                        $this->db->select('*');
                                        $this->db->from('tb_kontrak');
                                        $this->db->join('tb_karyawan','tb_karyawan.email=tb_kontrak.email','left');
                                        $this->db->where('tb_karyawan.id_kar',$idkar); 
                                        $this->db->where('status','Y');                            
                                        $query =  $this->db->get();
                                        foreach($query->result() as $row){
                                            echo $row->nip;
                                        }?>
                                    </td>
                                    <td><?=$data['nickname'] ?></td>
                                    <td><?=$data['jam_masuk'] ?></td>
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