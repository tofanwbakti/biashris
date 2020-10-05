<!-- DASHBOARD Kontrak LIST -->
<!-- ditampilkan hanya untuk anggota HR Departement -->
<!-- ================================================ -->
<script src="<?=base_url();?>assets/js/jquery-2.1.1.min.js" type="text/javascript"></script>
<script>
$("#boxNip").hide();
// komponenn untuk pengecekan duplikat email
function checkDbEmail() {
	$("#loaderIcon").show();
	jQuery.ajax({
	url: "<?=base_url();?>Hrd/cekDbEmail",
	data:'email='+$("#emailku").val(),
	type: "POST",
	success:function(data){
		$("#emailCheckStatus").html(data);
		$("#loaderIcon").hide();
	},
	error:function (){}
	});
};

function kontrakxls(){
            window.location.assign('<?=base_url('LaporanXls/excelKontrak') ?>');            
        }

function kontrakEOC(){
    window.location.assign('<?=base_url('LaporanXls/excelKontrakEoc') ?>');
}

// function checkDbEmailOld() {
// 	$("#loaderIconOld").show();
// 	jQuery.ajax({
// 	url: "<?=base_url();?>HRD/cekDbEmail",
// 	data:'email='+$("#emailku").val(),
// 	type: "POST",
// 	success:function(data){
// 		$("#emailCheckStatusOld").html(data);
// 		$("#loaderIconOld").hide();
// 	},
// 	error:function (){}
// 	});
// };
</script>
<!-- <style type="text/css">
    .error{
    color: red;
    }
</style> -->
<!-- Breadcumb section -->
<section class="content-header">
    <h1> <img src="<?=base_url()?>/assets/images/contract.svg" style="height:50px; margin-right:10px" alt="">
        Kontrak Karyawan
        <small>Pusat Informasi HR Department</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>Hrd"><i class="fa fa-dashboard"></i> Central Info HR</a></li>
        <li><a href="<?php echo base_url();?>Hrd/kontrak"><i class="fa fa-archive"></i> Kontrak Karyawan</a></li>
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
            Berikut Daftar Kontrak Karyawan di Bias Mandiri Group
        </div><!-- /.box-body -->
        <!-- <div class="box-footer">
            <small><i>Pastikan sudah memiliki <strong><a href="<?=site_url('Hrd/kontrak')?>">Kontrak Kerja</a></strong> untuk penambahan karyawan baru !</i></small>
        </div> -->
        <!-- /.box-footer-->
    </div>
<!-- /.box -->

<!-- Flash Data -->
<div class="conflash" data-flashdata="<?=$this->session->flashdata('flash'); ?>"></div>
<!-- ./ Flash Data -->

<!-- Row widget -->
    <div class="row">
        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="info-box bg-aqua">
                <span class="info-box-icon"><i class="fa fa-thumb-tack"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Karyawan Tetap</span>
                    <span class="info-box-number">
                    <?php 
                    $this->db->where('stat_kar!=',"F");
                    $data = $this->db->count_all_results('tb_karyawan');
                    
                    $this->db->where('stat_kar',"T");
                    $this->db->where('email !=',"admin@batam-samudra.id");
                    $this->db->from('tb_karyawan');
                    $data1 =$this->db->count_all_results();
                    echo $data1;
                    // echo $data;

                    $persen = ($data1/$data)*100;
                    ?>
                    </span>
                        <div class="progress">
                            <div class="progress-bar" style="width:<?=$persen?>%"></div>
                        </div>
                    <span class="progress-description">
                    <?=round($persen).'% dari total karyawan '.$data ?>
                    </span>
                </div><!-- /.info-box-content -->
            </div><!-- /.info-box -->
        </div><!-- /.col -->
        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="info-box bg-yellow">
                <span class="info-box-icon"><i class="fa fa-bookmark-o"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Karyawan Kontrak</span>
                    <span class="info-box-number"> 
                    <?php 
                    $this->db->where('stat_kar!=',"F");
                    $data = $this->db->count_all_results('tb_karyawan');
                    
                    $this->db->where('stat_kar',"K");
                    $this->db->from('tb_karyawan');
                    $data1 =$this->db->count_all_results();
                    echo $data1;
                    // echo $data;

                    $persen = ($data1/$data)*100; //hitung rata2
                    ?>
                    </span>
                        <div class="progress">
                            <div class="progress-bar" style="width: <?=$persen?>%"></div>
                        </div>
                    <span class="progress-description">
                    <?=round($persen).'% dari total karyawan '.$data ?> 
                    </span>
                </div><!-- /.info-box-content -->
            </div><!-- /.info-box -->
        </div><!-- /.col -->
        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="info-box bg-red">
                <span class="info-box-icon"><i class="fa fa-bell-o"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Notifikasi EOC </span>
                    <span class="info-box-number">
                    <?php 
                    $this->db->where('stat_kar!=',"F");
                    $data = $this->db->count_all_results('tb_karyawan');

                    $this->db->where('end<=', "CURDATE() + INTERVAL 30 DAY",false);
                    $this->db->where('email!=', "admin@batam-samudra.id");
                    $this->db->where('kontrak!=', "P");
                    $this->db->where('kontrak!=', "F");
                    $this->db->from('tb_kontrak');
                    $data1 = $this->db->count_all_results(); 
                    echo $data1;

                    $persen = ($data1/$data)*100; //hitung rata2
                    ?>
                    </span>
                        <div class="progress">
                            <div class="progress-bar" style="width:<?=$persen?>%"></div>
                        </div>
                    <span class="progress-description">
                    <?=round($persen).'% '?> kontrak kurang dari 30 hari
                    </span>
                </div><!-- /.info-box-content -->
            </div><!-- /.info-box -->
        </div><!-- /.col -->
    </div>
<!-- ./ Row widget -->
    <div class="row">
        <div class="col-md-8">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Daftar Kontrak Karyawan</h3>
                    <a href="<?= site_url('LaporanPdf/laporanKontrak')?>" target="_window"><i class="pull-right text-red fa fa-file-pdf-o" style="font-size:20px; margin-left:20px" data-toggle="tooltip" data-placement="left" title="Print Semua"></i></a>
                    <a href="javascript:void(0)" onclick="kontrakxls()"><i class="pull-right text-green fa fa-file-excel-o" style="font-size:20px; margin-left:20px" data-toggle="tooltip" data-placement="left" title="Export Semua"></i></a>
                    <div class="pull-right" style="margin-left:20px">
                        <!-- <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#modalTambah"><i class="fa fa-plus-square"></i>    Kontrak Baru </button> -->
                        <div class="dropdown">
                            <button class="btn btn-primary btn-xs dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-plus-square"style="margin-right:5px"> </i>  Kontrak  <span class="caret" style="margin-left:3px"></span>
                            </button>
                            <ul class="dropdown-menu pull-right">
                                <li><a href="javascript:void(0)" data-toggle="modal" data-target="#modalTambah"><i class="fa fa-user-plus text-blue"></i> Karyawan Baru</a></li>
                                <li class="divider"></li> 
                                <li><a href="javascript:void(0)" data-toggle="modal" data-target="#modalTambahOld"><i class="fa fa-user-secret text-red"></i> Karyawan Lama</a></li>
                            </ul>                                
                        </div>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body ">
                    <div class="table-responsive no-padding">
                        <table class="table table-hover" id="tablehistory">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NIP</th>
                                    <th>Nama </th>
                                    <th width="20px">Status</th>
                                    <th width="20px">PKWT</th>
                                    <th>Awal</th>
                                    <th>Akhir</th>
                                    <th width="20px">Waktu</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $no = 1;
                            foreach($rowkon as $data) {
                            ?>
                                <tr <?= $data['periodepkwt'] == "II" ? "class='warning'" : null ?>>
                                    <td><?= $no++; ?></td>
                                    <td><?=$data['nip'] ?>
                                    </td>
                                    <td><?php $badge = site_url('/assets/images/bluebadge.png'); if($data['stat_kar'] == "T") {echo $data['nickname']." "."<img src='$badge' style='height:15px' class='pull-right'>";} else {echo $data['nickname'];} ?></td>
                                    <!-- <td><?=$data['nickname'] ?></td> -->
                                    <td width="20px"><?=$data['stat_kar'] == "T" ? "Tetap" : "Kontrak" ?></td>
                                    <td width="20px" class="text-center"><?=$data['periodepkwt'] == "" ? "-" : $data['periodepkwt'] ?></td>
                                    <td><?=date("d M Y",strtotime($data['start'])) ?></td>
                                    <td><?= $data['end'] == "0000-00-00" ? "-" : date("d M Y",strtotime($data['end'])) ?></td>
                                    <td width="20px"><?=$data['durasi'] == "Null" ? "-" : $data['durasi']." bln" ?></td>
                                    <td><a href="#" class="eoc-detail" id="detailEoc" data-toggle="modal" data-target="#modalDetail" data-idkon=<?=$data['id_kon']?> data-periode="<?=$data['periodepkwt']?>"  data-kontrak=<?=$data['kontrak']?> data-start=<?=date("d-m-Y",strtotime($data['start']))?> data-end=<?=date("d-m-Y",strtotime($data['end']))?> data-nip=<?=$data['nip']?> data-fullname="<?=$data['fullname']?>" data-statkar="<?=$data['stat_kar']?>" data-foto="<?=$data['foto']?>" data-email=<?=$data['email']?> data-durasi=<?=$data['durasi']?>> 
                                    <i class="icon fa fa-edit text-primary" data-toggle="tooltip" title="Update"></i></a>
                                    </td>
                                    <!-- <td><?php $tgl= strtotime($data['end']);
                                    $today = strtotime (gmdate("Y-m-d", time()+60*60*7));
                                    $diff = $today - $tgl;
                                    echo floor ($diff / (60 * 60 * 24)); ?></td> -->
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div> <!-- ./ Box body -->
            </div>
        </div>
        <!-- Table Kanan -->
        <div class="col-md-4">
            <div class="box box-danger">
                <div class="box-header">
                    <h3 class="box-title">Daftar EOC <small>Kurang 60 hari</small></h3> 
                    <a href="<?= site_url('LaporanPdf/laporanEockontrak')?>" target="_window"><i class="pull-right text-red fa  fa-file-pdf-o" style="font-size:20px; margin-left:20px" data-toggle="tooltip" data-placement="left" title="Print Semua"></i></a>
                    <a href="javascript:void(0);" onclick="kontrakEOC()"><i class="pull-right text-green fa fa-file-excel-o" style="font-size:20px; margin-left:20px" data-toggle="tooltip" data-placement="left" title="Export Semua"></i></a>
                    <!-- <button class="btn btn-danger btn-xs pull-right" type="button"><i class="fa fa-exclamation-circle"style="margin-right:5px"> </i>  EOC Khusus</button> -->
                </div><!-- /.box-header -->
                <div class="box-body ">
                    <div class="table-responsive no-padding">
                        <table class="table table-hover" id="table3">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NIP</th>
                                    <th>Nama </th>
                                    <!-- <th>Tanggal</th> -->
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $no = 1;
                            foreach($roweoc as $data) {
                            ?>
                                <tr class="danger">
                                    <td><?= $no++; ?> </td>
                                    <td> <?=$data['nip'] ?></td>
                                    <td><?=$data['nickname'] ?></td>
                                    <!-- <td><?=date("d-M-y",strtotime($data['end'])) ?></td> -->
                                    <td><?php if($data['periodepkwt'] != "II") {?> <a href="javascript:void(0)"  data-tooltip="tooltip" title="Update" id="updateEoc" data-toggle="modal" data-target="#modalEOC" data-idkon=<?=$data['id_kon']?> data-email=<?=$data['email']?> data-pkwt="<?=$data['periodepkwt']?>" data-kontrak=<?=$data['kontrak']?> data-start=<?=$data['start']?> data-end=<?=$data['end']?> data-nip=<?=$data['nip']?> data-end=<?=$data['end']?> data-waktu=<?=$data['durasi']?>>
                                    <i class="fa fa-edit text-blue"></i> </a><?php } else { ?>                                    
                                    <a href="<?=site_url('Hrd/endContract/').encrypt_url($data['nip']).'/'.encrypt_url($data['email']) ?>" data-email=<?=$data['email']?> class="tombol-eoc">
                                    <i class="fa fa-trash text-red" data-tooltip="tooltip" title="Finish EOC" id="updateEoc" ></i></a>  <?php } ?></td>
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
<!-- Row Table -->


<!-- ./ Row Table -->

</section>

<!-- Edit Data Kontrak kerja EOC -->
    <div id= "modalEOC" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><i class="icon fa fa-edit text-red"></i>  Update Kontrak Kerja</h4>
                </div>
                <form action="<?=site_url('Hrd/updateContract') ?>" method="post">
                    <div class="modal-body" id="detailEoc">
                        <div class="box box-danger">
                            <div class="box-body">
                                <div class="form-group">                                    
                                    <input type="hidden" class="form-control" name="idkon" id="idkon"> 
                                    <input type="hidden" class="form-control" name="nip" id="nip"> 
                                </div>
                                <div class="form-group" style="margin-top:15px">
                                    <label for="pkwt">Periode PKWT </label><small class="text-danger"> *</small> 
                                    <label for="statpkwt" style="margin-left:180px">Status PKWT </label><small class="text-danger"> *</small> 
                                    <div class="form-inline">
                                        <select class="form-control" name="pkwt" id="pkwt" style="width:270px" required>
                                            <!-- <option disabled >I</option> -->
                                            <option >II</option>
                                        </select>
                                        <select class="form-control" name="statpkwt" id="statpkwt" style="width:270px;margin-left:5px" required>
                                            <!-- <option disabled>Baru</option> -->
                                            <option value="R">Perpanjangan</option>
                                        </select>                                    
                                    </div>                                   
                                </div>                                
                                <div class="form-group" id="sandbox-tanggal" >
                                    <label for="tglmulai" >Mulai Kontrak </label> <small class="text-danger"> *</small> 
                                    <label for="tglakhir" style="margin-left:100px" >Akhir Kontrak </label> <small class="text-danger"> *</small> 
                                    <label for="selisih" style="margin-left:100px" >Durasi Kontrak </label> <small class="text-danger"> *</small> 
                                    <div class="form-inline">
                                        <div class="input-group date" id="tgl1">
                                            <input type="text" class="form-control datepicker" name="tglmulai"  id="tglmulai" readonly placeholder="Tgl.." style="width:150px" required>
                                            <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                            </div>
                                        </div>
                                        <div class="input-group date" id="tgl2">
                                            <input type="text" class="form-control datepicker" name="tglakhir" id="tglakhir" readonly placeholder="Tgl.." style="margin-left:5px;width:150px" required>
                                            <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                            </div>
                                        </div>
                                        <div class="input-group" style="margin-left:5px">
                                            <input type="text" class="form-control" id="hitbeda" name="hitbeda" style="width:95px" placeholder="Durasi.." value="" readonly required>
                                            <div class="input-group-addon"> Bulan</div>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- ./ box body -->
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-default pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Tutup</button>
                        <?php foreach($rowkon as $data) {}?>
                        <button type="submit" name="update" class="btn btn-success" <?php if($data['periodepkwt'] == "II") { ?> disabled <?php } ?>  ><i class="fa fa-check"></i> Update</button>
                        
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="<?php echo base_url(); ?>assets/js/jquery-2.2.3.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).on("click","#updateEoc",function(){
            var idkon = $(this).data('idkon');
            var pkwt = $(this).data('pkwt');
            var waktu = $(this).data('waktu');
            var kontrak = $(this).data('kontrak');
            var start = $(this).data('start');
            var end = $(this).data('end');
            var nip = $(this).data('nip');

            $("#detailEoc #idkon").val(idkon);
            $("#detailEoc #nip").val(nip);
            $("#detailEoc #pkwt").val(pkwt);
            $("#detailEoc #statpkwt").val(kontrak);
            $("#detailEoc #tglmulai").val(start);
            $("#detailEoc #tglakhir").val(end);
            $("#detailEoc #hitbeda").val(waktu);
        });
    
        $(function(){
            $('#tgl1').datetimepicker({
                locale:'id',
                format:'DD-MM-YYYY'
            });

            $('#tgl2').datetimepicker({
                useCurrent: false,
                locale:'id',
                format:'DD-MM-YYYY'
            });

            $('#tgl1').on("dp.change",function(e){
                $('#tgl2').data("DateTimePicker").minDate(e.date);
            });

            $('#tgl2').on("dp.change",function(e){
                $('#tgl1').data("DateTimePicker").maxDate(e.date);
                CalcDiff()
            });
        });

        function CalcDiff(){
            var a = $('#tgl1').data("DateTimePicker").date();
            var b = $('#tgl2').data("DateTimePicker").date();
            var timeDiff = 0;
            if (b){
                timeDiff = (b-a)/1000;
            }

            $('#hitbeda').val(Math.round(timeDiff/(86400)/30));
        }
    </script>
<!-- ./ Edit Data Kontrak Kerja EOC-->

<!-- Modal Detail  -->
    <div id= "modalDetail" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><i class="fa fa-paperclip"></i> Detail Kontrak Karyawan</h4>
                </div>
                <form action="<?=site_url('Hrd/updateCont2')?>" method="post" id="mainForm">
                    <div class="modal-body" id="detailCon">
                        <div class="box-body">
                            <div class="row" id="headModal">                            
                            </div>
                            <table class="table table-bordeless">
                                <tr>
                                    <td>NIP</td>
                                    <td>:</td>
                                    <td><input type="text" name="nip" id="nip" class="form-control"  style="height:20px" readonly>
                                    <input type="hidden" name="idkon" id="idkon" class="form-control"  style="height:20px" readonly>
                                    <input type="hidden" name="email" id="email" class="form-control"  style="height:20px" readonly></td>
                                </tr>
                                <tr>
                                    <td>Nama Lengkap</td>
                                    <td>:</td>
                                    <td><input type="text" id="fullname" class="form-control" style="height:20px" readonly></td>
                                </tr>
                                <tr>
                                    <td>Status Karyawan</td>
                                    <td>:</td>
                                    <td id="rowStatus"></td>
                                </tr>
                                <tr id="rowalasan">
                                    <td colspan="3">
                                        <div class="form-group has-error" >
                                            <label class="control-label" for="alasan"><i class="fa fa-times-circle-o"></i> Alasan EOC</label>
                                            <input type="text" class="form-control" id="alasan" name="alasan" placeholder="Enter ...">
                                        </div>
                                    </td>   
                                </tr>
                                <tr >
                                    <td>Periode PKWT</td>
                                    <td>:</td>
                                    <td id="rowPeriode">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Awal Kontrak</td>
                                    <td>:</td>
                                    <td class="form-group" id="sandbox-tanggal" >
                                            <div class="input-group date" id="tgl3">
                                                <input type="text" class="form-control datepicker" name="tglawal" id="tglawal" readonly >
                                                <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                                </div>
                                            </div>
                                    </td>
                                </tr>
                                <tr >
                                    <td>Akhir Kontrak</td>
                                    <td>:</td>
                                    <td class="form-group" id="sandbox-tanggal">
                                            <div class="input-group date" id="tgl4">
                                                <input type="text" class="form-control datepicker" name="tglakhir" id="tglakhir" readonly>
                                                <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                                </div>
                                            </div>
                                    </td>
                                </tr>
                                <tr >
                                    <td>Waktu / Durasi</td>
                                    <td>:</td>
                                    <td>
                                        <div class="input-group" ">
                                            <input type="text" name="durasi" id="durasi" class="form-control" readonly >
                                            <div class="input-group-addon" > Bulan</div>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer" id="btnUpdate" >
                        <button type="reset" class="btn btn-default pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Tutup</button>
                        <button type="submit" name="update"  class="btn btn-success pull-right" ><i class="fa fa-check" ></i> Update</button>
                    </div>
                </form>
            </div>
            <script src="<?=base_url();?>assets/js/jquery-2.1.1.min.js" type="text/javascript"></script>
            <script type="text/javascript" > 
                $(document).on("click","#detailEoc",function(){
                    $('#rowalasan').hide();
                    var nip = $(this).data('nip');
                    var idkon = $(this).data('idkon');
                    var email = $(this).data('email');
                    var fullname = $(this).data('fullname');
                    var periode = $(this).data('periode');
                    var start = $(this).data('start');
                    var end = $(this).data('end');
                    var durasi = $(this).data('durasi');

                    if($(this).data('statkar') == "T"){
                        $("#rowStatus").html('<select name="statkar" id="statkar" class="form-control" onchange="muncul()"><option value="T" selected>Tetap</option><option value="F">Finish</option></select><input type="hidden" name="today" value="<?=gmdate("Y-m-d",time()+60*60*7)?>" class="form-control" style="height:20px" readonly> ');
                    }else if ($(this).data('statkar') == "K"){
                        $("#rowStatus").html('<select name="statkar" id="statkar" class="form-control" onchange="muncul()"><option value="K" >Kontrak</option><option value="T">Tetap</option><option value="F">Finish</option></select><input type="hidden" name="today" value="<?=gmdate("Y-m-d",time()+60*60*7)?>" class="form-control" style="height:20px" readonly> ');
                        
                    };

                    if($(this).data('periode')=="I"){
                        $("#rowPeriode").html('<select name="periode" id="periode" class="form-control"><option class="label-success" value="I" selected>Ke - I</option><option value="II">Ke - II</option></select><input type="hidden" name="tipekon" value="R" class="form-control" style="height:20px" readonly>');
                        $("#tglawal,#tglakhir").attr("disabled",false);
                        
                        
                    }else if ($(this).data('periode')=="II"){
                        $("#rowPeriode").html('<input type="text" name="periode" value="II" class="form-control" style="height:20px" readonly> <input type="hidden" name="tipekon" value="R" class="form-control" style="height:20px" readonly>');
                        // $("#tglawal,#tglakhir").attr("disabled",true);
                        $("#tglawal,#tglakhir").attr("disabled",false);
                    };
                    

                    $("#detailCon #nip").val(nip);
                    $("#detailCon #fullname").val(fullname);
                    $("#detailCon #idkon").val(idkon);
                    $("#detailCon #email").val(email);
                    $("#detailCon #tglawal").val(start);
                    $("#detailCon #tglakhir").val(end);
                    $("#detailCon #durasi").val(durasi);
                });
                $('.eoc-detail').on("click", function(){
                    // var idkon = $(this).data('id');
                    var fullname = $(this).data('fullname');
                    var foto = $(this).data('foto');
                    var email = $(this).data('email');
                    var statkar = $(this).data('statkar');
                    if($(this).data('statkar')=="T"){isi="Tetap";
                    }
                    else if ($(this).data('statkar')=="K"){isi="Kontrak";
                        $("#btnUpdate").attr("disabled",false);
                    };
                    $("#headModal").html('<div class="col-sm-2"><img style="width:70px;height:relative" src="<?php echo base_url();?>uploads/image/'+foto+'" class="img-rounded"  alt="User Image" /></div><div class="col-sm-7" style="text-align:left"><h3>'+fullname+'</h3><p><small>'+email+'</small></p></div><div><input type="text" class="btn btn-primary" style="height:30px;width:100px" value="'+isi+'" disabled></div>');
                    $(document).ready(function(){
                        $('#rowalasan').hide();
                    });                                        
                });

                

                $(function(){
                    $('#tgl3').datetimepicker({
                        locale:'id',
                        format:'DD-MM-YYYY'
                    });

                    $('#tgl4').datetimepicker({
                        useCurrent: false,
                        locale:'id',
                        format:'DD-MM-YYYY'
                    });

                    $('#tgl3').on("dp.change",function(e){
                        $('#tgl4').data("DateTimePicker").minDate(e.date);
                    });

                    $('#tgl4').on("dp.change",function(e){
                        $('#tgl3').data("DateTimePicker").maxDate(e.date);
                        hitDeft()
                    });
                });

                function hitDeft(){
                    var c = $('#tgl3').data("DateTimePicker").date();
                    var d = $('#tgl4').data("DateTimePicker").date();
                    var timeDiff = 0;
                    if (d){
                        timeDiff = (d-c)/1000;
                    }
                    // $("#detailCon #durasi").val(durasi);
                    $('#durasi').val(Math.round(timeDiff/(86400)/30));
                };    
                
                function muncul(){
                    var status = $("#statkar").val();
                    if(status != "K"){
                        $("#btnUpdate").show();
                    }else{
                        $("#btnUpdate").hide();
                    }
                    if(status == "F"){
                        $("#rowalasan").show();
                    }else {
                        $("#rowalasan").hide();
                    }
                }

                function muncul2(){
                    var pkwt = $("#periode").val();
                    if(pkwt != "I"){
                        $("#btnUpdate").show();
                    }else{
                        $("#btnUpdate").hide();
                    }                    
                }
            </script>
        </div>
    </div>

<!-- ./ Modal Detail  -->

<!-- Modal tambah Kontrak Baru -->
    <div id= "modalTambah" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><i class="fa fa-user-plus text-blue"></i> Tambah Kontrak Baru</h4>
                </div>
                <div class="modal-body">
                <?php echo form_open_multipart('Hrd/addKar') ?>
                    <div class="box box-danger">
                        <?php 
                            $bl = gmdate("md", time()+60*60*7);
                            $th = substr(gmdate("Y", time()+60*60*7),2);
                            $prefix = $th.$bl; // variable pertama tahun bulan tanggal
                            foreach ($rownip as $data){                     
                                $ngurut= sprintf("%02s",$data['no_urut'] + 1) ; //variable ke dua untuk urutan
                            }
                        ?>  
                        <div class="box-body">
                            <div class="form-inline">
                                    <input type="hidden" name="urutan" value="<?=$ngurut?>">
                                    <input type="text" class="form-control" value="NIP  :" readonly  style="width:220px;font-size:30px;text-align:right;border:0px;background:white">
                                    <input type="text" class="form-control" id="nip" name="nip" value="<?=$prefix.$ngurut?>" readonly  style="width:200px;font-size:30px;text-align:left;border:0px;background:white;margin-bottom:5px">
                            </div> 
                            <div class="form-group" id="sandbox-tanggal" >
                                <label for="tglmulai" >Mulai Kontrak </label> <small class="text-danger"> *</small> 
                                <label for="tglakhir" style="margin-left:100px" >Akhir Kontrak </label> <small class="text-danger"> *</small> 
                                <label for="tglakhir" style="margin-left:100px" >Durasi Kontrak </label> <small class="text-danger"> *</small> 
                                <div class="form-inline">
                                    <div class="input-group date" id="tgl10">
                                        <input type="text" class="form-control datepicker" name="tglmulai"  id="tglmulai" readonly placeholder="Tgl.." style="width:150px">
                                        <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                        </div>
                                    </div>
                                    <div class="input-group date" id="tgl11">
                                        <input type="text" class="form-control datepicker" name="tglakhir" id="tglakhir" readonly placeholder="Tgl.." style="margin-left:5px;width:150px">
                                        <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                        </div>
                                    </div>
                                    <div class="input-group" style="margin-left:5px">
                                        <input type="text" class="form-control" id="selisih" name="selisih" style="width:95px" placeholder="Durasi.." readonly required>
                                        <div class="input-group-addon"> Bulan</div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group" style="margin-top:10px">
                                <label for="grup" >Grup</label> <small class="text-danger">*</small>
                                <label for="sbu" style="margin-left:50px">SBU</label> <small class="text-danger">*</small>
                                <label for="subunit" style="margin-left:60px">Sub Unit</label> <small class="text-danger">*</small>
                                <label for="departemen" style="margin-left:130px">Departemen</label> <small class="text-danger">*</small>
                                <div class="form-inline">
                                    <select class="form-control" id="grup" name="grup" required style="width:90px">
                                        <option selected disabled>Pilih..</option>
                                        <?php foreach($rowgrup as $data){ ?>
                                        <option value="<?=$data['id_grup']?>"><?=$data['kode_grup']?></option>
                                        <?php } ?>
                                    </select>
                                    <select class="sbu form-control" id="sbu" name="sbu" required style="width:90px;margin-left:5px">
                                        <option selected disabled>Pilih..</option>
                                        <!-- <?php foreach($rowsbu as $data){ ?>
                                        <option value="<?=$data['kode']?>"><?=$data['kode']?></option>
                                        <?php } ?> -->
                                    </select>
                                    <select class="subunit form-control" id="subunit" name="subunit" required style="width:190px;margin-left:5px">
                                        <option selected disabled>Pilih Satu..</option>
                                    </select>
                                    <select class="departemen form-control" id="departemen" name="departemen" required style="width:150px;margin-left:5px">
                                        <option selected disabled>Pilih Satu..</option>
                                    </select>
                                    <small class="text-muted" id="text_sub" style="margin-left:200px"><a href="<?=site_url('Hrd/sbu')?>"><em style="font-size:10px"> Klik disini untuk tambah data</em></a></small>
                                    <small class="text-muted" id="text_dept" style="margin-left:60px"><a href="<?=site_url('Hrd/departemen')?>"><em style="font-size:10px"> Klik disini untuk tambah data</em></a></small>
                                </div>                                    
                            </div>
                            <div class="form-group" style="margin-top:10px">
                                <label for="level">Level Jabatan</label> <small class="text-danger">*</small>
                                <label for="dejab" style="margin-left:105px">Jabatan</label><small class="text-danger">*</small>
                                <div class="form-inline">
                                    <select class="form-control" name="level" id="level" style="width:190px" required>
                                        <option selected disabled>Pilih Satu..</option>
                                        <?php foreach ($rowjab as $data) {?>
                                            <option value="<?=$data['id_jab']?>"><?=$data['nama_jab']?></option>
                                        <?php } ?>
                                    </select> 
                                    <select  class="dejab form-control" name="dejab" id="dejab" style="width:350px;margin-left:5px" required>
                                        <option value="">Pilih Satu..</option>
                                    </select>
                                    <small class="text-muted" id="text_jab" style="margin-left:200px"><a href="<?=site_url('Hrd/jabatan')?>"><em style="font-size:10px"> Klik disini untuk tambah data</em></a></small>
                                </div>                                    
                            </div>
                        </div> 
                    </div><!-- ./ Box Danger -->
                    <div class="box box-primary">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="fullname">Nama Lengkap</label> <small class="text-danger">*</small>
                                <label for="nickname" style="margin-left:200px">Nama Panggilan</label> <small class="text-danger">*</small>
                                <div class="form-inline">
                                    <div class="input-group" style="margin-right:5px">
                                        <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Nama Lengkap.." style="width:268px" required>
                                        <div class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                        </div>
                                    </div>
                                    <div class="input-group">
                                        <input type="text" class="form-control pull-right" id="nickname" name="nickname" style="width:200px" placeholder="Nama Panggilan.." required>
                                        <div class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="emailku">Email</label> <small class="text-danger">*</small>
                                <label for="telpon" style="margin-left:265px">Nomor Telp.</label> <small class="text-danger">*</small>
                                <div class="form-inline">
                                    <div class="input-group" style="margin-right:5px">
                                        <input type="email" class="form-control" id="emailku" name="emailku" placeholder="Email.." onblur="checkDbEmail()" style="width:265px" data-validate= "Email tidak valid (cth: ex@abc.xyz)" required>
                                        <div class="input-group-addon">
                                        <i class="fa fa-at"></i>
                                        </div>
                                    </div>
                                    <div class="input-group" >
                                        <input type="number" class="form-control" id="telpon" name="telpon" placeholder="Nomor Telp.." style="width:203px" required>
                                        <div class="input-group-addon">
                                        <i class="fa fa-phone"></i>
                                        </div>
                                    </div>
                                </div>
                                <span id="emailCheckStatus"></span><span class="text-warning" ></span>
                                <p><img src="<?=base_url();?>assets/images/48x48.gif" id="loaderIcon" style="display:none"></p>
                            </div>
                            <div class="form-group">
                                <label for="genre">Jenis Kelamin</label> <small class="text-danger">*</small>
                                <label style="margin-left: 55px" for="status">Status</label> <small class="text-danger">*</small>
                                <label for="keluarga" style="margin-left: 100px">Keluarga</label> <small class="text-danger">*</small>
                                <label for="pendidikan" style="margin-left:40px">Pendidikan</label> <small class="text-danger">*</small>
                                <div class="form-inline">
                                    <select class="form-control" style="width:145px" name="genre" id="genre">
                                        <option selected disabled>Pilih ..</option>
                                        <option value="L">Laki-Laki</option>
                                        <option value="P">Perempuan</option>
                                    </select>
                                    <select class="form-control" style="width:150px; margin-left:5px" name="status" id="status">
                                        <option selected disabled class="text-muted">Pilih ..</option>
                                        <option value="1">Menikah</option>
                                        <option value="2">Belum Menikah</option>
                                    </select>
                                    <select class="form-control" style="width:105px; margin-left:5px" name="keluarga" id="keluarga">
                                        <option selected disabled>Pilih ..</option>
                                        <option value="TK">TK</option>
                                        <option value="K0">K0</option>
                                        <option value="K1">K1</option>
                                        <option value="K2">K2</option>
                                        <option value="K3">K3</option>
                                        <option value="K4">K4</option>
                                        <option value="K5">K5</option>
                                    </select>
                                    <select class="form-control" style="width:120px; margin-left:5px" name="pendidikan" id="pendidikan">
                                        <option selected disabled>Pilih..</option>
                                        <?php foreach($rowedu as $data){ ?>
                                        <option value="<?=$data['kode_edu']?>"><?=$data['kode_edu']?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="agama" >Agama</label> <small class="text-danger">*</small>
                                <label for="tempat" style="margin-left:95px">Tempat Lahir</label> <small class="text-danger">*</small>
                                <label for="tgllahir" style="margin-left:60px">Tanggal Lahir</label> <small class="text-danger">*</small>
                                <div class="form-inline">
                                    <select class="form-control" name="agama" id="agama" style="width:145px" required>
                                        <option selected disabled>Pilih Satu..</option>
                                        <option value="Islam" >Islam</option>
                                        <option value="Katolik" >Katolik</option>
                                        <option value="Protestan" >Protestan</option>
                                        <option value="Budha" >Budha</option>
                                        <option value="Hindu" >Hindu</option>
                                        <option value="Lainnya" >Lainnya</option>
                                    </select> 
                                    <div class="input-group" style="margin-left:5px;margin-top:10px">
                                        <input type="text" class="form-control" id="tempat" name="tempat" placeholder="Tempat Lahir.." style="width:115px" required>
                                        <div class="input-group-addon">
                                        <i class="fa fa-globe"></i>
                                        </div>
                                    </div>
                                    <div class="form-group" id="sandbox-tanggal" style="margin-left:5px;margin-top:10px">
                                        <div class="input-group date" id="tgllahir">
                                            <input type="text" class="form-control datepicker" name="tgllahir"  id="tgllahir" readonly placeholder="Tgl Lahir.." style="width:195px">
                                            <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                            </div>
                                        </div>
                                    </div>                                    
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat</label> <small class="text-danger">*</small>        
                                <label for="negara" style="margin-left: 255px">Warga Negara</label> <small class="text-danger">*</small>
                                <!-- <label for="statkar" style="margin-left:80px">Status Karyawan</label> <small class="text-danger">*</small> -->
                                <div class="form-inline">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat.." style="width:270px" required>
                                        <div class="input-group-addon">
                                        <i class="fa fa-map-marker"></i>
                                        </div>
                                    </div>
                                    <div class="input-group" style="margin-left:5px">
                                        <input type="text" class="form-control" id="negara" name="negara" style="width:200px" placeholder="Warga Negara.." required>
                                        <div class="input-group-addon">
                                        <i class="fa fa-globe"></i>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                            <div class="form-group">
                                <label for="filefoto">Foto</label>
                                <input type="file" name="filefoto" class="dropify" data-height="250">
                            </div>
                        </div><!-- Box Karyawan -->
                        <div class="modal-footer">
                            <button type="reset" class="btn btn-default pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Tutup</button>
                            <button type="submit" name="submit" class="btn btn-primary"><i class="fa fa-send"></i> Simpan</button>
                        </div> 
                    <?php echo form_close() ?>
                    </div>                    
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            $('#grup').change(function(){
                var id = $(this).val();
                $.ajax({
                    url : "<?php echo base_url();?>index.php/Hrd/cariSbu",
                    method : "POST",
                    data : {id: id},
                    async : false,
                    dataType : 'json',
                    success : function(data){
                        var html = '<option selected disabled>Pilih..</option>';
                        var i;
                        for(i=0; i<data.length; i++){
                            html += '<option value='+data[i].kode+'>'+data[i].kode+'</option>';
                        }
                        $('.sbu').html(html);
                        // $('#text_sub').show();
                    }
                });
            });
        });

        // link select bar dari SBU ke SUb UNIT
        $(document).ready(function(){
            $('#text_sub').hide();
            $('#sbu').change(function(){
                var id = $(this).val();
                $.ajax({
                    url : "<?php echo base_url();?>index.php/Hrd/subUnit",
                    method : "POST",
                    data : {id: id},
                    async : false,
                    dataType : 'json',
                    success : function(data){
                        var html = '<option selected disabled>Pilih..</option>';
                        var i;
                        for(i=0; i<data.length; i++){
                            html += '<option value='+data[i].id_sub+'>'+data[i].sub+'</option>';
                        }
                        $('.subunit').html(html);
                        $('#text_sub').show();
                    }
                });
            });
        });

        // link select bar dari Sub Unit  ke Departemen
        $(document).ready(function(){
            $('#text_dept').hide();
            $('#subunit').change(function(){
                var id = $(this).val();
                $.ajax({
                    url : "<?php echo base_url();?>index.php/Hrd/getDept",
                    method : "POST",
                    data : {id: id},
                    async : false,
                    dataType : 'json',
                    success : function(data){
                        var html = '<option selected disabled>Pilih Satu..</option>';
                        var i;
                        for(i=0; i<data.length; i++){
                            html += '<option value='+data[i].id_dept+'>'+data[i].kode_dept+'</option>';
                        }
                        $('.departemen').html(html);
                        $('#text_dept').show();
                    }
                });
            });
        });
        
        // link select bar dari Level Jabatan ke Detail Jabatan 
        $(document).ready(function(){
            $('#text_jab').hide();
            $('#level').change(function(){
                var id = $(this).val();
                $.ajax({
                    url : "<?php echo base_url();?>index.php/Hrd/detailJab",
                    method : "POST",
                    data : {id: id},
                    async : false,
                    dataType : 'json',
                    success : function(data){
                        var html = '<option selected disabled>Pilih..</option>';
                        var i;
                        for(i=0; i<data.length; i++){
                            html += '<option value='+data[i].kode_jail+'>'+data[i].nama_jail+'</option>';
                        }
                        $('.dejab').html(html);
                        $('#text_jab').show();
                    }
                });
            });
        });
        $(function(){
            $('#tgl10').datetimepicker({
                locale:'id',
                format:'DD-MM-YYYY'
            });

            $('#tgl11').datetimepicker({
                useCurrent: false,
                locale:'id',
                format:'DD-MM-YYYY'
            });

            $('#tgl10').on("dp.change",function(e){
                $('#tgl11').data("DateTimePicker").minDate(e.date);
            });

            $('#tgl11').on("dp.change",function(e){
                $('#tgl10').data("DateTimePicker").maxDate(e.date);
                hitDeff()
            });
        });

        function hitDeff(){
            var a = $('#tgl10').data("DateTimePicker").date();
            var b = $('#tgl11').data("DateTimePicker").date();
            var timeDiff = 0;
            if (b){
                timeDiff = (b-a)/1000;
            }

            $('#selisih').val(Math.round(timeDiff/(86400)/30));
        }
        
    </script>
<!-- ./ Modal tambah Kontrak Baru -->

<!-- Modal tambah Kontrak Baru Karyawan Lama -->
    <div id= "modalTambahOld" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><i class="fa fa-user-secret text-red"></i> Tambah Kontrak Baru</h4>
                </div>
                <div class="modal-body">
                <?php //echo form_open_multipart('Hrd/updateKonKarOld') ?>
                <form action="<?=site_url('Hrd/updateKonKarOld')?>" id="myForm" role="form" method="post">
                    <div class="box box-danger" id="boxNip">
                        <?php 
                            $bl = gmdate("md", time()+60*60*7);
                            $th = substr(gmdate("Y", time()+60*60*7),2);
                            $prefix = $th.$bl; // variable pertama tahun bulan tanggal
                            foreach ($rownip as $data){                     
                                $ngurut= sprintf("%02s",$data['no_urut'] + 1) ; //variable ke dua untuk urutan
                            }
                        ?>  
                        <div class="box-body">
                            <div class="form-inline">
                                    <input type="hidden" name="urutan" value="<?=$ngurut?>">
                                    <input type="text" class="form-control" value="NIP  :" readonly  style="width:220px;font-size:30px;text-align:right;border:0px;background:white">
                                    <input type="text" class="form-control" id="nip" name="nip" value="<?=$prefix.$ngurut?>" readonly  style="width:200px;font-size:30px;text-align:left;border:0px;background:white;margin-bottom:5px">
                                    <small class="error"></small>
                            </div> 
                            <div class="form-group" id="sandbox-tanggal" >
                                <label for="tglmulai" >Mulai Kontrak </label> <small class="text-danger"> *</small> 
                                <label for="tglakhir" style="margin-left:100px" >Akhir Kontrak </label> <small class="text-danger"> *</small> 
                                <label for="tglakhir" style="margin-left:100px" >Durasi Kontrak </label> <small class="text-danger"> *</small> 
                                <div class="form-inline">
                                    <div class="input-group date" id="tgl7">
                                        <input type="text" class="form-control datepicker" name="tglmulai"  id="tglmulai" readonly placeholder="Tgl.." style="width:150px" required>
                                        <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                        </div>
                                    </div>
                                    <div class="input-group date" id="tgl8">
                                        <input type="text" class="form-control datepicker" name="tglakhir" id="tglakhir" readonly placeholder="Tgl.." style="margin-left:5px;width:150px" required>
                                        <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                        </div>
                                    </div>
                                    <div class="input-group" style="margin-left:5px">
                                        <input type="text" class="form-control" id="selisih78" name="selisih78" style="width:95px" placeholder="Durasi.." readonly required>
                                        <div class="input-group-addon"> Bulan</div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group" style="margin-top:10px">
                                <label for="grupOld" >Grup</label> <small class="text-danger">*</small>
                                <label for="sbuOld" style="margin-left:50px">SBU</label> <small class="text-danger">*</small>
                                <label for="subunitOld" style="margin-left:60px">Sub Unit</label> <small class="text-danger">*</small>
                                <label for="departemenOld" style="margin-left:130px">Departemen</label> <small class="text-danger">*</small>
                                <div class="form-inline">
                                    <select class="form-control" id="grupOld" name="grupOld" required style="width:90px">
                                        <option selected disabled>Pilih..</option>
                                        <?php foreach($rowgrup as $data){ ?>
                                        <option value="<?=$data['id_grup']?>"><?=$data['kode_grup']?></option>
                                        <?php } ?>
                                    </select>
                                    <select class="sbuOld form-control" id="sbuOld" name="sbuOld" required style="width:90px;margin-left:5px">
                                        <option selected disabled>Pilih..</option>
                                        <!-- <?php foreach($rowsbu as $data){ ?>
                                        <option value="<?=$data['kode']?>"><?=$data['kode']?></option>
                                        <?php } ?> -->
                                    </select>
                                    <select class="subunitOld form-control" id="subunitOld" name="subunitOld" required style="width:190px;margin-left:5px">
                                        <option selected disabled>Pilih Satu..</option>
                                    </select>
                                    <select class="departemenOld form-control" id="departemenOld" name="departemenOld" required style="width:150px;margin-left:5px">
                                        <option selected disabled>Pilih Satu..</option>
                                    </select>
                                    <small class="text-muted" id="text_subOld" style="margin-left:200px"><a href="<?=site_url('Hrd/sbu')?>"><em style="font-size:10px"> Klik disini untuk tambah data</em></a></small>
                                    <small class="text-muted" id="text_deptOld" style="margin-left:60px"><a href="<?=site_url('Hrd/departemen')?>"><em style="font-size:10px"> Klik disini untuk tambah data</em></a></small>
                                </div>                                    
                            </div>
                            <div class="form-group" style="margin-top:10px">
                                <label for="levelOld">Level Jabatan</label> <small class="text-danger">*</small>
                                <label for="dejabOld" style="margin-left:105px">Jabatan</label><small class="text-danger">*</small>
                                <div class="form-inline">
                                    <select class="form-control" name="levelOld" id="levelOld" style="width:190px" required>
                                        <option selected disabled>Pilih Satu..</option>
                                        <?php foreach ($rowjab as $data) {?>
                                            <option value="<?=$data['id_jab']?>"><?=$data['nama_jab']?></option>
                                        <?php } ?>
                                    </select> 
                                    <select  class="dejabOld form-control" name="dejabOld" id="dejabOld" style="width:350px;margin-left:5px" required>
                                        <option value="">Pilih Satu..</option>
                                    </select>
                                    <small class="text-muted" id="text_jabOld" style="margin-left:200px"><a href="<?=site_url('Hrd/jabatan')?>">Klik disini jika data kosong/tidak ada</a></small>
                                </div>                                   
                            </div>
                        </div> 
                    </div>
                    <!-- ./ Box Danger -->
                    <div class="box box-primary">
                        <div class="box-body">
                            <div class="form-group form-group-lg">
                                <label for="id_kar" style="margin-text:auto"> <h3> Pilih Karyawan</h3></label>
                                <select name="id_kar" id="id_kar"  class="form-control" required >
                                    <option value=""selected disabled> Pilih Satu ..</option>
                                    <?php foreach ($rowusreoc as $data) {?>
                                        <option value="<?=$data['id_kar']?>" ><?=$data['email']?></option>
                                    <?php } ?>
                                </select>
                                <select  class="emailNya form-control" name="email" id="emailnya" style="width:350px;margin-left:5px" required>
                                    <!-- <option value="">Pilih Satu..</option> -->
                                </select>
                            </div>                                                       
                        </div><!-- Box Karyawan -->
                        <div class="modal-footer">
                            <button type="reset" class="btn btn-default pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Tutup</button>
                            <button type="submit" name="submit" class="btn btn-primary"><i class="fa fa-send"></i> Simpan</button>
                        </div>
                    </div>  
                </form>                  
                </div>
            </div>
        </div>
    </div>
    <!-- <script src="<?=base_url();?>assets/js/jquery.js" type="text/javascript"></script> -->
    <script type="text/javascript">     
        $(document).ready(function(){
            $('#grupOld').change(function(){
                var id = $(this).val();
                $.ajax({
                    url : "<?php echo base_url();?>index.php/Hrd/cariSbu",
                    method : "POST",
                    data : {id: id},
                    async : false,
                    dataType : 'json',
                    success : function(data){
                        var html = '<option selected disabled>Pilih..</option>';
                        var i;
                        for(i=0; i<data.length; i++){
                            html += '<option value='+data[i].kode+'>'+data[i].kode+'</option>';
                        }
                        $('.sbuOld').html(html);
                        // $('#text_sub').show();
                    }
                });
            });
        });

        // link select bar dari SBU ke SUb UNIT
        $(document).ready(function(){
            $('#text_subOld').hide();
            $('#sbuOld').change(function(){
                var id = $(this).val();
                $.ajax({
                    url : "<?php echo base_url();?>index.php/Hrd/subUnit",
                    method : "POST",
                    data : {id: id},
                    async : false,
                    dataType : 'json',
                    success : function(data){
                        var html = '<option selected disabled>Pilih..</option>';
                        var i;
                        for(i=0; i<data.length; i++){
                            html += '<option value='+data[i].id_sub+'>'+data[i].sub+'</option>';
                        }
                        $('.subunitOld').html(html);
                        $('#text_subOld').show();
                    }
                });
            });
        });

        // link select bar dari Sub Unit  ke Departemen
        $(document).ready(function(){
            $('#text_deptOld').hide();
            $('#subunitOld').change(function(){
                var id = $(this).val();
                $.ajax({
                    url : "<?php echo base_url();?>index.php/Hrd/getDept",
                    method : "POST",
                    data : {id: id},
                    async : false,
                    dataType : 'json',
                    success : function(data){
                        var html = '<option selected disabled>Pilih Satu..</option>';
                        var i;
                        for(i=0; i<data.length; i++){
                            html += '<option value='+data[i].id_dept+'>'+data[i].kode_dept+'</option>';
                        }
                        $('.departemenOld').html(html);
                        $('#text_deptOld').show();
                    }
                });
            });
        });
        
        // link select bar dari Level Jabatan ke Detail Jabatan 
        $(document).ready(function(){
            $('#text_jabOld').hide();
            $('#levelOld').change(function(){
                var id = $(this).val();
                $.ajax({
                    url : "<?php echo base_url();?>index.php/Hrd/detailJab",
                    method : "POST",
                    data : {id: id},
                    async : false,
                    dataType : 'json',
                    success : function(data){
                        var html = '<option selected disabled>Pilih..</option>';
                        var i;
                        for(i=0; i<data.length; i++){
                            html += '<option value='+data[i].kode_jail+'>'+data[i].nama_jail+'</option>';
                        }
                        $('.dejabOld').html(html);
                        $('#text_jabOld').show();
                    }
                });
            });
        });
        $(function(){
            $('#tgl7').datetimepicker({
                locale:'id',
                format:'DD-MM-YYYY'
            });

            $('#tgl8').datetimepicker({
                useCurrent: false,
                locale:'id',
                format:'DD-MM-YYYY'
            });

            $('#tgl7').on("dp.change",function(e){
                $('#tgl8').data("DateTimePicker").minDate(e.date);
            });

            $('#tgl8').on("dp.change",function(e){
                $('#tgl7').data("DateTimePicker").maxDate(e.date);
                hitDiff()
            });
        });

        function hitDiff(){
            var a = $('#tgl7').data("DateTimePicker").date();
            var b = $('#tgl8').data("DateTimePicker").date();
            var timeDiff = 0;
            if (b){
                timeDiff = (b-a)/1000;
            }

            $('#selisih78').val(Math.round(timeDiff/(86400)/30));
        };

        // Isi Email Karyawan EOC
        $(document).ready(function(){
            $('#emailnya').hide();
            $('#id_kar').change(function(){
                var id = $(this).val();
                $.ajax({
                    url : "<?php echo base_url();?>index.php/Hrd/cekEmailEoc",
                    method : "POST",
                    data : {id: id},
                    async : false,
                    dataType : 'json',
                    success : function(data){
                        var html = '';
                        var i;
                        for(i=0; i<data.length; i++){
                            html += '<option value='+data[i].email+'>'+data[i].email+'</option>';
                        }
                        $('.emailNya').html(html);
                    }
                });
            });
        });       

    </script>
<!-- ./ Modal tambah Kontrak Baru Karyawan Lama -->
