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
        <li active><a href="javascript:void(0);"><i class="fa fa-circle-o"></i> Laporan Absens</a></li>
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
            <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">CPU Traffic</span>
                <span class="info-box-number">90<small>%</small></span>
            </div><!-- /.info-box-content -->
            </div><!-- /.info-box -->
        </div><!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-google-plus"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Likes</span>
                <span class="info-box-number">41,410</span>
            </div><!-- /.info-box-content -->
            </div><!-- /.info-box -->
        </div><!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
            <span class="info-box-icon bg-green"><i class="ion ion-ios-people-outline"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Hadir Hari Ini</span>
                <span class="info-box-number">760</span>
            </div><!-- /.info-box-content -->
            </div><!-- /.info-box -->
        </div><!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
            <span class="info-box-icon bg-red"><i class="ion ion-ios-people-outline"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Terlambat Hari Ini</span>
                <span class="info-box-number">2,000</span>
            </div><!-- /.info-box-content -->
            </div><!-- /.info-box -->
        </div><!-- /.col -->
    </div> <!-- /.row -->

<!-- Table -->
    <div class="row">
        <div class="col-md-5">
            <div class="box box-danger">
                <div class="box-header">
                    <h3 class="box-title">Kehadiran Hari ini</h3>
                    <div class="pull-right">
                        <?php echo gmdate("d F Y", time()+60*60*7) ?>
                    </div>
                </div>
                <div class="box-body">
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
                            <?php $no=1;
                            foreach($rowhadir as $data){ ?>
                                <tr <?= $data['status'] == "2" ? "class='danger'" : null ?>>
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
                            </tbody>
                            <?php } ?>
                        </table>                    
                    </div>
                </div>
            </div>
        </div><!-- /.col -->
        <div class="col-md-7">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Detail Kehadiran</h3>
                </div>
                <div class="box-body">
                    <div class="table-responsive no-padding">
                        <table class="table table-hover" id="tablehistory">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NIP</th>
                                    <th>Nama</th>
                                    <th>SBU</th>
                                    <th>Detail</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div><!-- /.col -->
    </div> <!-- /.row -->
<!-- ./ Table -->

</section>