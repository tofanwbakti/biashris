<!-- View Template Ijen Keluar  -->
<!-- ================================================ -->
<script type="text/javascript">
    function myFunction(x) {
        x.classList.toggle("fa-search-minus");
    }

    function downloadxls(){
        window.location.assign('<?=base_url('LaporanXls/laporanTerlambat/').$awal."/".$akhir ?>');            
    }
</script>

<!-- Breadcumb section -->
<section class="content-header">
    <h1>
        <i class="fa fa-sign-in text-warning"></i> Laporan Izin Terlambat
        <small>Masuk Kerja Terlambat</small>
        
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>Dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li> 
        <li><a href="<?= site_url('C_Personal/ijinLambat') ?>"><i class="fa fa-user-md"></i> Izin Lambat</a></li>
        
</section>

<!-- Main content -->
<section class="content">

<!-- Default box -->

    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Hi! <b> <?= $this->fungsi->user_login()->nickname ?> </b> </h3> 
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
            </div>
        </div>
        <div class="box-body">
            Berikut history izin terlambat masuk kerja karyawan.
        </div><!-- /.box-body -->
        <!-- <div class="box-footer">
            Footer
        </div>/.box-footer -->
    </div>
<!-- /.box -->


<!-- Tables  -->
    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title"> Riwayat Izin Terlambat</h3>        
            <div class="pull-right">  
                <!-- <a href="javascript:voi(0)" data-toggle="tooltip" title="Download Excel" onclick="downloadxls();" > <i class="text-green fa fa-file-excel-o" style="font-size:20px;margin-right:5px"></i></a>     -->
                <a href="javascript:void(0);" data-toggle="collapse" data-target="#cari"><i class="fa fa-search" onclick="myFunction(this)" data-toggle="tooltip" title="Cari Tgl." style="font-size:20px;margin-right:5px"></i></a>                   
            </div>
            <form action="#" method="post">
                <div class="form-group collapse" id="cari" style="margin-right:15px;margin-top:5px">
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control" name="reservation" id="reservation">
                    <span class="input-group-btn"> <button class="btn btn-info"> Cari</button></span>
                    </div>
                    <!-- /.input group -->
                </div>
            </form>
        </div>
        <div class="box-body table-responsive">
            <table id="repButton" class="table table-hover display">
                <thead>
                <tr>
                    <th >#</th>
                    <!-- <th>Nomor</th> -->
                    <th >Nama</th>
                    <th>Hari</th>
                    <th>Tanggal </th>
                    <th>Masuk </th>
                    <th>Alasan</th>
                    <th>Atasan</th>
                    <th>HRD</th>
                    <th>Ket</th> 
                    <th>Status</th> 
                </tr>
                </thead>
                <tbody>
                <?php $no = 1;
                foreach ($rowLate as $data) { ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?=$data['nickname'] ?></td>
                        <td><?php if($data['hari']=="Monday") echo "Senin";
                            elseif ($data['hari']=="Tuesday") echo "Selasa";
                            elseif ($data['hari']=="Wednesday") echo "Rabu";
                            elseif ($data['hari']=="Thursday") echo "Kamis";
                            elseif ($data['hari']=="Friday") echo "Jumat";
                            elseif ($data['hari']=="Saturday") echo "Sabtu";
                            elseif ($data['hari']=="Monday") echo "Minggu";
                            ?>
                        </td>
                        <td><?=date('d M y',strtotime($data['tgl']))?></td>
                        <td><?=$data['jam_masuk'] ?></td>
                        <td><?=$data['keterangan'] == "NULL" || $data['keterangan'] == "" ? "-" : $data['keterangan']?></td>
                        <td><?=$data['apv1'] == "NULL" || $data['apv1'] == "" ? "-" : $data['apv1']?></td>
                        <td><?=$data['apv2'] == "NULL" || $data['apv2'] == "" ? "-" : $data['apv2']?></td>
                        <td><?=$data['comment'] == "NULL" || $data['comment'] == "" ? "-" : $data['comment']?></td>
                        <td><?php if($data['status'] == "Y") { echo " Disetujui";
                        } else if ($data['status'] == "N") { echo "Ditolak";
                        } else if ($data['status'] == "W") { echo "Menunggu";}?></td>
                    </tr>
                <?php } ?>
            </table>
        </div>
                
    </div><!-- </div> -->
</section><!-- /.content -->
