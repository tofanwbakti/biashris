<!-- View Template Ijen Alpa  -->
<!-- ================================================ -->
<script type="text/javascript">
function alertCuti(){
    Swal.fire({
        type: 'error',
        title: 'Oops...',
        text: 'Sorry, sisa cuti sudah habis !',
        // footer: '<a href>Why do I have this issue?</a>'
    });
}
</script>
<!-- Breadcumb section -->
<section class="content-header">
    <h1>
        <div class="icon">
        <i class="fa fa-calendar"></i> Kalender Cuti
        <!-- <small>Tidak Masuk Kerja / Alpa</small> -->
        </div>
        
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>Dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li> 
        <li><a href="<?= site_url('C_Personal/cuti') ?>"><i class="fa fa-calendar"></i> Cuti</a></li>
        
</section>

<!-- Flash Data -->
<div class="flashCuti" data-flashdata="<?=$this->session->flashdata('flash'); ?>"></div>
<div class="flash-unit" data-flashdata="<?=$this->session->flashdata('flash'); ?>"></div>
<div class="flash-err" data-flashdata="<?=$this->session->flashdata('flash_error'); ?>"></div>

<!-- Main content -->
<section class="content">

<!-- Box COllapsable -->
    <div class="box box-default box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><i class="icon fa fa-calendar-check-o"></i> Kalender Cuti Bersama</h3>        
            <small class="pull-right" style="margin-right:50px">Tahun <?=gmdate("Y") ?></small>  
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div><!-- /.box-tools -->
        </div><!-- /.box-header -->
        <div class="box-body table-responsive" style="display:block;background-color:#dbdbfa">
            <table class="table" >
                <thead class="">
                    <tr class="">
                        <th width="40px">#</th>
                        <th>Uraian Cuti</th>
                        <th width="200px">Tanggal Awal Cuti</th>
                        <th width="200px">Tanggal Akhir Cuti</th>
                        <th width="150px">Jumlah Cuti</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach($rowcutibr as $data) { ?>
                    <tr>
                        <td><?=$no++;?></td>
                        <td><?=$data['uraian'] ?> </td>
                        <td><?=date("d F Y", strtotime($data['awal_cuti']))?></td>
                        <td><?=date("d F Y", strtotime($data['akhir_cuti']))?></td>
                        <td><?=$data['jml_hari'] ?> Hari</td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div><!-- /.box-body -->
        <div class="box-footer">
            <div class="row">
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box" style="height:10px">
                        <span class="info-box-icon bg-aqua"><i class="fa fa-star"></i></span>
                        <div class="info-box-content">
                        <span class="info-box-text">Cuti Tahunan</span>
                        <span class="info-box-number"><?php foreach($rowjtct as $data) echo $data['ttl_cuti'];?> Hari</span>
                        <span>Jatah pertahun</span>
                        </div><!-- /.info-box-content -->
                    </div><!-- /.info-box -->
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-green"><i class="fa fa-star-half-o"></i></span>
                        <div class="info-box-content">
                        <span class="info-box-text">Cuti Digunakan</span>
                        <span class="info-box-number"><?php foreach($rowjtct as $data) {
                            $tc= $data['ttl_cuti'];
                            $sc= $data['sisa_cuti'];
                            $cb= $data['jml_hari'];
                            $cp= $data['c_pribadi'];
                        } 
                        if(!empty($tc)) {
                            echo 0 + $cb + ($cp-$sc);
                        }else { 
                            echo 0;} ?>  
                        Hari</span>
                        <span>Dari seluruh cuti</span>
                        </div><!-- /.info-box-content -->
                    </div><!-- /.info-box -->
                    </div><!-- /.col -->
                    <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-yellow"><i class="fa fa-star-half-o"></i></span>
                        <div class="info-box-content">
                        <span class="info-box-text">Sisa Cuti</span>
                        <span class="info-box-number" id="numberSisa"><?php foreach($rowjtct as $data){
                            $tc= $data['ttl_cuti'];
                            $sc= $data['sisa_cuti'];
                            $cb= $data['jml_hari'];
                            $cp= $data['c_pribadi'];
                            $hasil = $cb + ($cp-$sc);
                        }if(!empty($tc)) {
                            echo 0 + ($tc - $hasil);
                        }else {
                            echo 0;
                        } ?> Hari</span>
                        <span>Dapat digunakan</span>
                        </div><!-- /.info-box-content -->
                    </div><!-- /.info-box -->
                    </div><!-- /.col -->
                    <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-red"><i class="fa fa-star-o"></i></span>
                        <div class="info-box-content">
                        <span class="info-box-text">Cuti Khusus</span>
                        <span class="info-box-number"><?php if(empty($rowctks)){ echo 0;}else echo $rowctks; ?> Hari</span>
                        <span>Pengajuan</span>
                        </div><!-- /.info-box-content -->
                    </div><!-- /.info-box -->
                </div><!-- /.col -->
            </div>
        </div>
    </div>

    <!-- Tables  -->
    <div class="row">
        <div class="col-xs-12">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="active">
                        <a href="#historyCuti" data-toggle="tab">
                        <i class="fa fa-calendar text-blue" style="margin-right:10px;font-size:20px"></i> Cuti Pribadi
                        </a>
                    </li>
                    <?php if($this->fungsi->user_login()->id_lvl != "A5"){?>
                        <li>
                            <a href="#aprovalCuti" data-toggle="tab">
                            <i class="fa fa-calendar text-red" style="margin-right:10px;font-size:20px"></i> Cuti Bawahan
                            </a>
                        </li>
                    <?php } ?>
                </ul>
                <!-- Tab Content -->
                <div class="tab-content">
                    <!-- Tab Content Pertama -->
                    <div class="tab-pane active" id="historyCuti">
                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title"> Riwayat Pengajuan Cuti </h3>       
                                <div class="pull-right"> 
                                    <div class="drop-down">
                                    <?php foreach($rowjtct as $data){
                                        if($data['c_status'] == "A"){
                                            echo "<button id='btnAddCuti' type='button' class='btn btn-primary dropdown-toggle' data-toggle='dropdown' ><i class='fa fa-plus'></i>
                                            Ajukan <span class='caret' style='margin-left:3px'></span></button>
                                            <ul class='dropdown-menu pull-right'>";
                                            $scuti = $data['sisa_cuti'];
                                            if($scuti == 0){
                                                echo "<li><a href='#' onclick='alertCuti();' ><i class='fa fa-calendar-plus-o text-primary'></i> Cuti Tahunan </a></li>";
                                            }else{                                
                                                echo "<li><a href='#' data-toggle='modal' data-target='#cutiTahunan'><i class='fa fa-calendar-plus-o text-primary'></i> Cuti Tahunan </a></li>";
                                            }
                                            echo "<li class='divider'></li><li><a href='#' data-toggle='modal' data-target='#cutiKhusus'><i class='fa fa-calendar-plus-o text-danger'></i> Cuti Khusus</a></li></ul>";
                                        }
                                    }?>
                                        
                                            <!-- <?php foreach($rowjtct as $data){
                                                $scuti = $data['sisa_cuti'];
                                            }
                                                if($scuti == 0){
                                                    echo "<li><a href='#' onclick='alertCuti();' ><i class='fa fa-calendar-plus-o text-primary'></i> Cuti Tahunan </a></li>";
                                                }else{                                
                                                    echo "<li><a href='#' data-toggle='modal' data-target='#cutiTahunan'><i class='fa fa-calendar-plus-o text-primary'></i> Cuti Tahunan </a></li>";
                                                }
                                            ?>
                                            <li class="divider"></li>
                                            <li><a href="#" data-toggle="modal" data-target="#cutiKhusus"><i class="fa fa-calendar-plus-o text-danger"></i> Cuti Khusus</a></li>
                                        </ul>                     -->
                                    
                                    </div>                 
                                </div>
                            </div>
                            <div class="box-body table-responsive">
                                <table id="tablehistory" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th width="30px">#</th>
                                            <th width="120px">No. Pengajuan</th>
                                            <th>Keterangan Cuti</th>
                                            <th width="80px">Awal Cuti </th>
                                            <th width="80px">Akhir Cuti </th>
                                            <th width="70px">Total Hari </th>
                                            <th width="70px">Status</th>
                                            <th width="50px" class="text-center"><i class="fa fa-cogs"></i></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php $no = 1;
                                    foreach($rowcuti as $data){?>
                                        <tr class="">
                                            <td><?=$no++;?></td>
                                            <td><?=$data['noform']?></td>
                                            <td><?=$data['ket_cukar']?></td>
                                            <td><?=date("d-m-Y",strtotime($data['awal_cukar']));?></td>
                                            <td><?=date("d-m-Y",strtotime($data['akhir_cukar']));?></td>
                                            <td class="text-center"><?=$data['totalhr_cukar']?></td>
                                            <td><?php if($data['stat_cukar'] == "MENUNGGU"){
                                                echo "<span class='badge bg-yellow'>$data[stat_cukar]</span>";
                                            }else if($data['stat_cukar'] == "DITOLAK"){
                                                echo "<span class='badge bg-red'>$data[stat_cukar]</span>";
                                            }else {
                                                echo "<span class='badge bg-green'>$data[stat_cukar]</span>";
                                            }?>
                                            </td>
                                            <td class="text-center">
                                            <!-- Tombol Edit -->
                                            <?php if($data['tipe_cukar'] =="TAHUNAN") { 
                                                // UNTUK CUTI TAHUNAN
                                                if(($data['stat_cukar'] == "MENUNGGU") && ($data['apv1'] == "")){ ?>
                                                    <span data-toggle="tooltip" title="Edit" class="btnTh"  style="margin-right:5px"><a href="#" id="editTh"  data-toggle="modal" data-target="#editCutiTh" data-id="<?=$data['id_cukar']?>" data-noform="<?=$data['noform']?>" data-awal="<?=date("m/d/Y",strtotime($data['awal_cukar']))?>" data-akhir="<?=date("m/d/Y",strtotime($data['akhir_cukar']))?>" data-ket="<?=$data['ket_cukar']?>" data-totalhr="<?=$data['totalhr_cukar']?>" data-status="<?=$data['stat_cukar'] ?>" ><i class="fa fa-pencil-square-o text-primary"></i></a></span>
                                                <?php } 
                                            } else {
                                                // UNTUK CUTI KHUSUS
                                                if(($data['stat_cukar'] == "MENUNGGU") && ($data['apv1'] == "")){ ?>
                                                    <span data-toggle="tooltip" title="Edit" class="btnKs" style="margin-right:5px"><a href="#" id="editKs" data-toggle="modal" data-target="#editCutiKs" data-id="<?=$data['id_cukar']?>" data-noform="<?=$data['noform']?>" data-awal="<?=date("m/d/Y",strtotime($data['awal_cukar']))?>" data-akhir="<?=date("m/d/Y",strtotime($data['akhir_cukar']))?>" data-ket="<?=$data['ket_cukar']?>" data-totalhr="<?=$data['totalhr_cukar']?>" data-status="<?=$data['stat_cukar'] ?>" ><i class="fa fa-pencil-square-o text-primary"></i></a></span>
                                                <?php }
                                            } ?>
                                            <!-- Tombol Hapus -->
                                            <?php foreach($rowjtct as $dt){ $dtct = $dt['sisa_cuti'];} if($data['stat_cukar'] == "MENUNGGU")  { ?>
                                                <span data-toggle="tooltip" title="Batal"><a href="<?=site_url('C_Personal/delCutiKar/').encrypt_url($data['id_cukar']).'/'.encrypt_url($data['totalhr_cukar']).'/'.encrypt_url($data['tipe_cukar']).'/'.encrypt_url($data['nip']).'/'.encrypt_url($dtct) ?>"><i class="fa fa-trash-o text-danger"></i></a></span>
                                            <?php }?>
                                            <span data-toggle="tooltip" title="Detail" style="margin-left:5px"><a href="<?=site_url('LaporanPdf/detailCuti/').encrypt_url($data['id_cukar']) ?>" target="_BLANK"><i class="fa fa-print"></i></a></td></span>                         
                                            
                                        </tr>
                                    <?php } ?>
                                    </tbody>                                                
                                </table>
                            </div>            
                        </div><!-- </div> Box -->
                    </div><!-- ./ COntent Pertama -->
                    <!-- Tab Content Kedua -->
                    <div class="tab-pane" id="aprovalCuti">
                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title"> Pengajuan Cuti Bawahan </h3> 
                            </div>
                            <div class="box-body table-responsive">
                                <table id="tablehistory2" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th width="20px">#</th>
                                            <th width="150px">No. Pengajuan</th>
                                            <th width="70px">Nama</th>
                                            <th width="60px">NIP</th>
                                            <th width="200px">Keterangan Cuti</th>
                                            <th width="80px">Awal </th>
                                            <th width="80px">Akhir</th>
                                            <th width="50px">Total </th>
                                            <th width="20px"><i class="fa fa-random" syle="fomt-size:20px"></i></th>
                                            <th width="70px" class="text-center"><i class="fa fa-cogs"></i></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php $no = 1;
                                    // dari table cuti karyawan "tb_cuti_karyawan"
                                    foreach($ctbawahan as $data){ ?>
                                        <tr class="">
                                            <td><?= $no++; ?></td>
                                            <td><?=$data['noform']?></td>
                                            <td><?=$data['nickname']?></td>
                                            <td><?=$data['nip']?></td>
                                            <?php $this->db->select('*');
                                            $this->db->from('tb_cuti_jatah');
                                            $this->db->where('nip',$data['nip']);
                                            $this->db->where('c_status',"A");
                                            $get = $this->db->get()->result();
                                            ?>
                                            <td><?=$data['ket_cukar']?></td>
                                            <td><?=date("d-m-Y",strtotime($data['awal_cukar']));?></td>
                                            <td><?=date("d-m-Y",strtotime($data['akhir_cukar']));?></td>
                                            <td class="text-center"><?=$data['totalhr_cukar']?> Hari</td>
                                            <td class="text-center"><?php if($data['stat_cukar'] == "MENUNGGU"){
                                                echo "<i class='fa fa-hand-paper-o text-yellow' style='font-size:20px' data-toggle='tooltip' title='MENUNGGU'></i>";
                                            }else if($data['stat_cukar'] == "DITOLAK"){
                                                echo "<i class='fa fa-thumbs-o-down text-red' style='font-size:20px' data-toggle='tooltip' title='DITOLAK'></i>";
                                            }else {
                                                echo "<i class='fa fa-thumbs-o-up text-green' style='font-size:20px' data-toggle='tooltip' title='DISETUJUI'></i>";
                                            }?>
                                            </td>
                                            <td align="center">
                                            <?php
                                                foreach($get as $datajt){$dtget = $datajt->sisa_cuti;} // untuk mendapatkan data sisa cuti dari table Jatah Cuti
                                                $level = $this->fungsi->user_login()->id_lvl;
                                                $nickname = $this->fungsi->user_login()->nickname;
                                                $jabatan = $this->fungsi->user_login()->nama_jab;
                                                if(($data['stat_cukar'] == "MENUNGGU") && ($data['apv1'] == "")){
                                                    
                                                    echo "<a href='".site_url('C_Personal/apvCuti/').encrypt_url($data['id_cukar']).'/'.encrypt_url($data['noform']).'/'.encrypt_url($level).'/'.encrypt_url($nickname).'/'.encrypt_url($jabatan)."' data-toggle='tooltip' title='Setujui' class='tombol-apv' ><i class='fa fa-thumbs-o-up text-green' style='margin-right:2px'></i> </a> |
                                                    
                                                    <a href=".site_url('C_Personal/rejectCuti/').encrypt_url($data['id_cukar']).'/'.encrypt_url($data['noform']).'/'.encrypt_url($level).'/'.encrypt_url($nickname).'/'.encrypt_url($jabatan).'/'.encrypt_url($dtget).'/'.encrypt_url($data['totalhr_cukar']).'/'.encrypt_url($data['nip']).'/'.encrypt_url($data['tipe_cukar'])."' data-toggle='tooltip' title='Tolak'><i class='fa fa-thumbs-o-down text-red' style='margin-right:2px'></i> </a> |" ;
                                                    
                                            }?>
                                                <a href="<?=site_url('LaporanPdf/detailCuti/').encrypt_url($data['id_cukar'])."/".encrypt_url($data['noform']) ?>" target="_BLANK"><i class="fa fa-print"></i></a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    <tbody>                                                
                                </table>
                            </div>            
                        </div><!-- </div> Box -->
                    </div><!-- ./ COntent Kedua -->
                </div>
            </div>
        </div>
    </div>


        
</section><!-- /.content -->


<!-- Modal Pengajuan Cuti Tahunan-->
    <div class="modal fade" id="cutiTahunan" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" type="button" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><i class="fa fa-calendar-plus-o text-primary"></i> Form Pengajuan Cuti</h4>
                </div>
                <form action="<?=site_url('C_Personal/addCutiKar')?>" method="post">
                <div class="modal-body">                
                    <div class="box box-primary">
                        <div class="box-header">
                            <div class="col-sm-2">
                                <img style="width:70px;height:relative" src="<?php echo base_url();?>uploads/image/<?=$this->fungsi->user_login()->foto?>" class="img-rounded"  alt="User Image" />
                            </div>
                            <div class="col-sm-7" style="text-align:left">
                            <p ><?php foreach($rownip as $data) echo $data['nip'];?></p>
                            <p style="font-size:20px"><strong><?=$this->fungsi->user_login()->fullname?></strong></p>
                            <p><small><?=$this->fungsi->user_login()->email?></small></p>
                            </div>
                            <div class="col-sm-3 pull-right">
                                <a class="btn btn-block btn-social btn-dropbox" data-toggle="tooltip" title="Hak Cuti" >
                                    <i class="fa fa-info-circle"></i> <?php foreach($rowjtct as $data) echo $data['sisa_cuti'];?> Hari
                                </a>
                            </div>
                        </div>                        
                        <div class="box-body" >
                            <div class="form-group">
                                <label for="nocuti">No Pengajuan</label>
                                <!-- Nomor Pengajuan -->
                                <?php 
                                    function getRomawi($bln){
                                        switch ($bln){
                                            case 1: 
                                                return "I";
                                                break;
                                            case 2:
                                                return "II";
                                                break;
                                            case 3:
                                                return "III";
                                                break;
                                            case 4:
                                                return "IV";
                                                break;
                                            case 5:
                                                return "V";
                                                break;
                                            case 6:
                                                return "VI";
                                                break;
                                            case 7:
                                                return "VII";
                                                break;
                                            case 8:
                                                return "VIII";
                                                break;
                                            case 9:
                                                return "IX";
                                                break;
                                            case 10:
                                                return "X";
                                                break;
                                            case 11:
                                                return "XI";
                                                break;
                                            case 12:
                                                return "XII";
                                                break;
                                        }
                                    };
                                    // Baris Format No Pengajuan
                                    
                                    $tipe   = "CT";
                                    $sbu    = $this->fungsi->user_login()->kode;
                                    $romawi = getRomawi(date('n'));
                                    $tahun  = date('y');
                                    foreach ($noform as $data){
                                        $ngurut = sprintf("%04s",$data['urutan'] + 1);
                                    }
                                    $hasil  = $ngurut."/".$tipe."-".$sbu."/".$romawi."/".$tahun;
                                ?>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="nocuti" id="nocuti" readonly value="<?=$hasil;?>" > 
                                    <div class="input-group-addon"><i class="fa fa-barcode"></i></div>
                                </div>
                                <!-- Hidden Element -->
                                
                                    <input type="hidden" class="form-control" name="nourut" id="nourut" readonly value="<?=$ngurut;?>" > 
                                    <input type="hidden" class="form-control" name="tipect" id="tipect" readonly value="TAHUNAN" > 
                                    <input type="hidden" class="form-control" name="statct" id="statct" readonly value="MENUNGGU" > 
                                    <input type="hidden" class="form-control" name="nip" id="nip" readonly value="<?php foreach($rownip as $data) echo $data['nip'];?>" > 
                                    <input type="hidden" class="form-control" name="sbu" id="sbu" readonly value="<?=$this->fungsi->user_login()->kode; ?>" > 
                                    <input type="hidden" class="form-control" name="idkar" id="idkar" readonly value="<?=$this->fungsi->user_login()->id_kar; ?>" > 
                                <!-- ./ Hidden Element -->
                            </div>
                            <div class="form-group">
                                <label for="perawal" >Awal Cuti </label> <small class="text-danger"> *</small> 
                                <label for="perawal" style="margin-left:100px" >Akhir Cuti </label> <small class="text-danger"> *</small> 
                                <label for="perawal" style="margin-left:95px" >Total Hari </label> <small class="text-danger"> *</small> 
                                <label for="perawal" style="margin-left:20px" >Sisa Cuti</label> <small class="text-danger"> *</small> 
                                <div class="form-inline">
                                    <div class="input-group date" id="tgl3" style="margin-right:5px" >
                                        <input type="text" class="form-control datepicker" name="perawal"  id="perawal" style="width:125px" onkeydown="event.preventDefault()" placeholder="Tgl..">
                                        <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                        </div>
                                    </div>
                                    <div class="input-group date" id="tgl4">
                                        <input type="text" class="form-control datepicker" name="perakhir" id="perakhir" style="width:130px" onkeydown="event.preventDefault()" placeholder="Tgl..">
                                        <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                        </div>
                                    </div>
                                    <div class="input-group" style="margin-left:5px">
                                        <input type="text" name="totalhr" id="totalhr" class="form-control" onkeydown="event.preventDefault()" style="width:60px">
                                        <div class="input-group-addon">
                                        <i class="fa fa-map-marker"></i></div>
                                    </div>
                                    <div class="input-group" style="margin-left:5px">
                                        <input type="text" name="sisact" id="sisact" class="form-control" onkeydown="event.preventDefault()" style="width:60px">
                                        <div class="input-group-addon">
                                        <i class="fa fa-ticket"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="stockct" id="stockct" class="form-control" value="<?php foreach($rowjtct as $data) echo $data['sisa_cuti'];?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="ketcuti">Keterangan Cuti</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="ketcuti" id="ketcuti" required > 
                                    <div class="input-group-addon"><i class="fa fa-pencil"></i></div>
                                </div>
                            </div>
                        </div>                        
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Tutup</button>
                    <button type="submit" class="btn btn-primary btn-add"><i class="fa fa-paper-plane"></i> Simpan</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <script src="<?=base_url();?>assets/js/jquery-2.1.1.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(function(){
            $('#tgl3').datepicker({
                locale:'id',
                autoclose: true,
                todayHighlight: true,
            });

            $('#tgl4').datepicker({
                useCurrent: false,
                locale:'id',
                autoclose: true,
            });

            $("#tgl3").on('changeDate', function(selected){
                var startDate = new Date(selected.date.valueOf());
                $("#tgl4").datepicker('setStartDate', startDate);
                if($("#tgl3").val() > $("#tgl4").val()){
                    $("#tgl4").val($("#tgl3").val());
                }
            });    

            $("#tgl4").on('changeDate', function(){
                hitDeff();  
                hitCuti();    
                batas();
            })        
        });
        // Menghitung selisih tanggal
        function hitDeff(){
            if ( ($("#perawal").val() != "") && ($("#perakhir").val() != "")) {
                var oneDay = 24*60*60*1000; // hours*minutes*seconds*milliseconds
                var firstDate = new Date($("#perawal").val());
                var secondDate = new Date($("#perakhir").val());
                var diffDays = Math.round(Math.round((secondDate.getTime()- firstDate.getTime()) / (oneDay) +1));
                $("#totalhr").val(diffDays);                
            }
        };

        // hitung sisa Cuti
        function hitCuti(){
            var stock = $("#stockct").val();
            var hari = $("#totalhr").val();
            var hasil = parseInt(stock) - parseInt(hari);
            if(!isNaN(hasil)){
                $("#sisact").val(hasil);
            }else $("#sisact").val(0);
        };

        // Batas Hak Cuti
        function batas(){
            var stokct = document.getElementById('stockct').value;
            var ttlct = document.getElementById('totalhr').value;

            if(parseInt(stokct) < parseInt(ttlct)){
                Swal.fire({
                    type: 'error',
                    title: 'Oops...',
                    text: 'Sorry, Total hari melebihi hak cuti !',
                    // footer: '<a href>Why do I have this issue?</a>'
                });
                $(".btn-add").attr('disabled',true);
            }else{
                $(".btn-add").attr('disabled',false);
            }
        }

        
        
    </script>

<!-- ./ Modal Pengajuan Cuti Tahunan -->

<!-- Modal Pengajuan Cuti Khusus -->
    <div class="modal fade" id="cutiKhusus" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" type="button" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><i class="fa fa-calendar-plus-o text-danger"></i> Form Pengajuan Cuti</h4>
                </div>
                <form action="<?=site_url('C_Personal/addCutiKar')?>" method="post">
                <div class="modal-body">                
                    <div class="box box-danger">
                        <div class="box-header">
                            <div class="col-sm-2">
                                <img style="width:70px;height:relative" src="<?php echo base_url();?>uploads/image/<?=$this->fungsi->user_login()->foto?>" class="img-rounded"  alt="User Image" />
                            </div>
                            <div class="col-sm-6" style="text-align:left">
                            <p ><?php foreach($rownip as $data) echo $data['nip'];?></p>
                            <p style="font-size:20px"><strong><?=$this->fungsi->user_login()->fullname?></strong></p>
                            <p><small><?=$this->fungsi->user_login()->email?></small></p>
                            </div>
                            <div class="col-sm-4 pull-right">
                                <a class="btn btn-block btn-social btn-google-plus" data-toggle="tooltip" title="Hak Cuti" >
                                    <i class="fa fa-info-circle"></i> Cuti Khusus
                                </a>
                            </div>
                        </div>                        
                        <div class="box-body" id="bodyCuti">
                            <div class="form-group">
                                <label for="nocuti">No Pengajuan</label>
                                <!-- Nomor Pengjuan -->
                                <?php 
                                    function getRomawi2($bln){
                                        switch ($bln){
                                            case 1: 
                                                return "I";
                                                break;
                                            case 2:
                                                return "II";
                                                break;
                                            case 3:
                                                return "III";
                                                break;
                                            case 4:
                                                return "IV";
                                                break;
                                            case 5:
                                                return "V";
                                                break;
                                            case 6:
                                                return "VI";
                                                break;
                                            case 7:
                                                return "VII";
                                                break;
                                            case 8:
                                                return "VIII";
                                                break;
                                            case 9:
                                                return "IX";
                                                break;
                                            case 10:
                                                return "X";
                                                break;
                                            case 11:
                                                return "XI";
                                                break;
                                            case 12:
                                                return "XII";
                                                break;
                                        }
                                    };
                                    // Baris Format No Pengajuan
                                    
                                    $tipe   = "CK";
                                    $sbu    = $this->fungsi->user_login()->kode;
                                    $romawi = getRomawi2(date('n'));
                                    $tahun  = date('y');
                                    foreach ($noformKs as $data){
                                        $ngurut = sprintf("%04s",$data['urutan'] + 1);
                                    }
                                    $hasil  = $ngurut."/".$tipe."-".$sbu."/".$romawi."/".$tahun;
                                ?>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="nocuti" id="nocuti" readonly value="<?=$hasil;?>" > 
                                    <div class="input-group-addon"><i class="fa fa-barcode"></i></div>
                                </div>
                                <!-- Hidden Element -->
                                    <input type="hidden" class="form-control" name="nourut" id="nourut" readonly value="<?=$ngurut;?>" > 
                                    <input type="hidden" class="form-control" name="tipect" id="tipect" readonly value="KHUSUS" > 
                                    <input type="hidden" class="form-control" name="statct" id="statct" readonly value="MENUNGGU" > 
                                    <input type="hidden" class="form-control" name="nip" id="nip" readonly value="<?php foreach($rownip as $data) echo $data['nip'];?>" > 
                                    <input type="hidden" class="form-control" name="sbu" id="sbu" readonly value="<?=$this->fungsi->user_login()->kode; ?>" > 
                                    <input type="hidden" class="form-control" name="idkar" id="idkar" readonly value="<?=$this->fungsi->user_login()->id_kar; ?>" > 
                                <!-- ./ Hidden Element -->
                            </div>
                            <div class="form-group">
                                <label for="awalct" >Awal Cuti </label> <small class="text-danger"> *</small> 
                                <label for="akrct" style="margin-left:120px" >Akhir Cuti </label> <small class="text-danger"> *</small> 
                                <label for="totalct" style="margin-left:120px" >Total Hari </label> <small class="text-danger"> *</small>
                                <div class="form-inline">
                                    <div class="input-group date" id="tgl5" style="margin-right:5px" >
                                        <input type="text" class="form-control datepicker" name="awalct"  id="awalct" style="width:150px" onkeydown="event.preventDefault()" placeholder="Tgl..">
                                        <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                        </div>
                                    </div>
                                    <div class="input-group date" id="tgl6">
                                        <input type="text" class="form-control datepicker" name="akrct" id="akrct" style="width:150px" onkeydown="event.preventDefault()" placeholder="Tgl..">
                                        <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                        </div>
                                    </div>
                                    <div class="input-group" style="margin-left:5px">
                                        <input type="text" name="totalct" id="totalct" class="form-control" onkeydown="event.preventDefault()" style="width:123px">
                                        <div class="input-group-addon">
                                        <i class="fa fa-map-marker"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="ketcuti">Keterangan Cuti</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="ketcuti" id="ketcuti" required > 
                                    <div class="input-group-addon"><i class="fa fa-pencil"></i></div>
                                </div>
                            </div>
                        </div>                        
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Tutup</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane"></i> Simpan</button>
                </div>
                </form>
            </div>
        </div>        
    </div>
    <script src="<?=base_url();?>assets/js/jquery-2.1.1.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(function(){
            $('#tgl5').datepicker({
                locale:'id',
                autoclose: true,
                todayHighlight: true,
            });

            $('#tgl6').datepicker({
                useCurrent: false,
                locale:'id',
                autoclose: true,
            });

            $("#tgl5").on('changeDate', function(selected){
                var startDate = new Date(selected.date.valueOf());
                $("#tgl6").datepicker('setStartDate', startDate);
                if($("#tgl5").val() > $("#tgl6").val()){
                    $("#tgl6").val($("#tgl5").val());
                }
            });    

            $("#tgl6").on('changeDate', function(){
                hitDeff2();   
            })        
        });
        // Menghitung selisih tanggal
        function hitDeff2(){
            if ( ($("#awalct").val() != "") && ($("#akrct").val() != "")) {
                var oneDay = 24*60*60*1000; // hours*minutes*seconds*milliseconds
                var firstDate = new Date($("#awalct").val());
                var secondDate = new Date($("#akrct").val());
                var diffDays = Math.round(Math.round((secondDate.getTime()- firstDate.getTime()) / (oneDay) +1));
                $("#totalct").val(diffDays);                
            }
        };
    </script>

<!-- ./ Modal Pengajuan Cuti Khusus -->

<!-- Modal Edit Cuti  TAHUNAN-->
    <div class="modal fade" id="editCutiTh" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" type="button" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><i class="fa fa-calendar-plus-o text-Primary"></i> Edit Pengajuan Cuti</h4>
                </div>
                <form action="<?=site_url('C_Personal/updateCutiThKar') ?>" method="post">
                <div class="modal-body">
                    <div class="box box-primary">
                        <div class="box-header">
                            <div class="col-sm-2">
                                <img style="width:70px;height:relative" src="<?php echo base_url();?>uploads/image/<?=$this->fungsi->user_login()->foto?>" class="img-rounded"  alt="User Image" />
                            </div>
                            <div class="col-sm-7">
                                <p ><?php foreach($rownip as $data) echo $data['nip'];?></p>
                                <p style="font-size:20px"><strong><?=$this->fungsi->user_login()->fullname?></strong></p>
                                <p><small><?=$this->fungsi->user_login()->email?></small></p>
                            </div>
                            <div class="col-sm-3">
                                <a class="btn btn-block btn-social btn-dropbox" data-toggle="tooltip" title="Hak Cuti" >
                                    <i class="fa fa-info-circle"></i> <?php foreach($rowjtct as $data) echo $data['sisa_cuti'];?> Hari
                                </a>
                            </div>
                        </div>
                        <div class="box-body" id="bodyCutiTh">
                            <div class="form-group">
                                <label for="nocutith">No. Pengajuan</label>
                                    <input type="hidden" class="form-control" name="idcutith" id="idcutith" readonly > 
                                <div class="input-group">
                                    <input type="text" class="form-control" name="nocutith" id="nocutith" readonly > 
                                    <div class="input-group-addon"><i class="fa fa-barcode"></i></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="awalth" >Awal Cuti </label> <small class="text-danger"> *</small> 
                                <label for="akhirth" style="margin-left:100px" >Akhir Cuti </label> <small class="text-danger"> *</small> 
                                <label for="totalth" style="margin-left:95px" >Total Hari </label> <small class="text-danger"> *</small> 
                                <label for="sisath" style="margin-left:20px" >Sisa Cuti</label> <small class="text-danger"> *</small> 
                                <div class="form-inline">
                                    <div class="input-group date" id="tgl3th" style="margin-right:5px" >
                                        <input type="text" class="form-control datepicker" name="awalth"  id="awalth" style="width:125px" onkeydown="event.preventDefault()" placeholder="Tgl.." required>
                                        <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                        </div>
                                    </div>
                                    <div class="input-group date" id="tgl4th">
                                        <input type="text" class="form-control datepicker" name="akhirth" id="akhirth" style="width:130px" onkeydown="event.preventDefault()" placeholder="Tgl.." required>
                                        <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                        </div>
                                    </div>
                                    <div class="input-group" style="margin-left:5px">
                                        <input type="text" name="totalth" id="totalth" class="form-control" onkeydown="event.preventDefault()" style="width:60px">
                                        <div class="input-group-addon">
                                        <i class="fa fa-map-marker"></i></div>
                                    </div>
                                    <div class="input-group" style="margin-left:5px">
                                        <input type="text" name="sisath" id="sisath" class="form-control" onkeydown="event.preventDefault()" style="width:60px" required>
                                        <div class="input-group-addon">
                                        <i class="fa fa-ticket"></i></div>
                                    </div>
                                </div>
                                <small class="text-muted">*format : bulan / hari / tahun</small>
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="akhirth_old" id="akhirth_old" class="form-control"readonly>
                                <input type="hidden" name="totalthold" id="totalthold" class="form-control"readonly>
                                <input type="hidden" name="hasilhitung" id="hasilhitung" class="form-control" " readonly>
                                <input type="hidden" name="stockth" id="stockth" class="form-control" value="<?php foreach($rowjtct as $data) echo $data['sisa_cuti'];?>" readonly>
                                <input type="hidden" name="hitstockth" id="hitstockth" class="form-control" " readonly>
                                <input type="hidden" class="form-control" name="nip" id="nip" readonly value="<?php foreach($rownip as $data) echo $data['nip'];?>" >
                            </div>
                            <div class="form-group">
                                <label for="ketcuti">Keterangan Cuti</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="ketth" id="ketth" required > 
                                    <div class="input-group-addon"><i class="fa fa-pencil"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Tutup</button>
                        <button type="submit" class="btn btn-success btn-edit"><i class="fa fa-check-square-o"></i> Update</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <script src="<?=base_url();?>assets/js/jquery-2.1.1.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        // $(".btn-edit").attr('disabled',true);
        $(document).on("click",".btnTh",function(){
            var isi = '';
            $("#bodyCutiTh #sisath").val(isi);
        });

        $(document).on("click","#editTh", function(){
            var id = $(this).data('id');
            var noform = $(this).data('noform');
            var awal = $(this).data('awal');
            var akhir = $(this).data('akhir');
            var ket = $(this).data('ket');
            var totalhr = $(this).data('totalhr');
            var status = $(this).data('status');

            $("#bodyCutiTh #idcutith").val(id);
            $("#bodyCutiTh #nocutith").val(noform);
            $("#bodyCutiTh #awalth").val(awal);
            $("#bodyCutiTh #akhirth").val(akhir);
            $("#bodyCutiTh #totalth").val(totalhr);
            $("#bodyCutiTh #ketth").val(ket);
            $("#bodyCutiTh #totalthold").val(totalhr);
            $("#bodyCutiTh #akhirth_old").val(akhir);

        });
        $(function(){
            $('#tgl3th').datepicker({
                locale:'id',
                autoclose: true,
                todayHighlight: true,
                // format: 'dd/mm/yyyy'
            });

            $('#tgl4th').datepicker({
                useCurrent: false,
                locale:'id',
                autoclose: true,
                // format: 'dd/mm/yyyy'
            });

            $("#tgl3th").on('changeDate', function(selected){
                var startDate = new Date(selected.date.valueOf());
                $("#tgl4th").datepicker('setStartDate', startDate);
                if($("#tgl3th").val() > $("#tgl4th").val()){
                    $("#tgl4th").val($("#tgl3th").val());
                }
            });    

            $("#tgl4th").on('changeDate', function(){
                hitDeffTh();  
                hitCutiTh();
                infobatas();
                // $(".btn-edit").attr('disabled',false);
            })        
        });

        // Menghitung selisih tanggal
        function hitDeffTh(){
            if ( ($("#awalth").val() != "") && ($("#akhirth").val() != "")) {
                var oneDay = 24*60*60*1000; // hours*minutes*seconds*milliseconds
                var firstDate = new Date($("#awalth").val());
                var secondDate = new Date($("#akhirth").val());
                // var isisisa = $("#sisath").val();
                var diffDays = Math.round(Math.round((secondDate.getTime()- firstDate.getTime()) / (oneDay) +1));
                $("#totalth").val(diffDays);
                if(secondDate < firstDate){
                    Swal.fire({
                        type: 'error',
                        title: 'Oops...',
                        text: 'Sorry, Tanggal kurang dari awal cuti !',
                        // footer: '<a href>Why do I have this issue?</a>'
                    });
                }
            }
        };
        // hitung sisa Cuti
        function hitCutiTh(){
            var a = $("#totalth").val();
            var b = $("#totalthold").val();
            var d = $("#stockth").val();
            var batas = parseInt(b) + parseInt(d);

            var akhir = new Date($("#akhirth").val());
            var akhir_old = new Date($("#akhirth_old").val());

            if(akhir > akhir_old){
                var c = parseInt(a) - parseInt(b);
                var hasil = parseInt(d) - parseInt(c);
                $("#sisath").val(hasil);
                $("#hasilhitung").val(c);
                $("#hitstockth").val(batas);              
            }else if(akhir < akhir_old){
                var c = parseInt(b) - parseInt(a);
                var hasil = parseInt(d) + parseInt(c);
                    $("#sisath").val(hasil);
                    $("#hasilhitung").val(c);
                    $("#hitstockth").val(batas);              
            }else if(akhir = akhir_old){
                var c = parseInt(b) - parseInt(a);
                var hasil = parseInt(d) + parseInt(c);
                $("#sisath").val(hasil);
                $("#hasilhitung").val(c);
                $("#hitstockth").val(batas);              
            }
        };
        // hitung perbandingan stock cuti dengan total hari pengajuan

        function infobatas(){
            var stok = document.getElementById('hitstockth').value;
            var ttl = document.getElementById('totalth').value;

            if(parseInt(stok) < parseInt(ttl)){
                Swal.fire({
                    type: 'error',
                    title: 'Oops...',
                    text: 'Sorry, Total hari melebihi hak cuti !',
                    // footer: '<a href>Why do I have this issue?</a>'
                });
                $(".btn-edit").attr('disabled',true);
            }else{
                $(".btn-edit").attr('disabled',false);
            }
        }
    </script>
    
<!-- ./ Modal Edit Cuti  TAHUNAN-->

<!-- Modal Edit Cuti  Khusus-->
    <div class="modal fade" id="editCutiKs" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" type="button" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><i class="fa fa-calendar-plus-o text-danger"></i> Edit Pengajuan Cuti</h4>
                </div>
                <form action="<?=site_url('C_Personal/updateCutiKs')?>" method="post">
                <div class="modal-body">
                    <div class="box box-danger">
                        <div class="box-header">
                            <div class="col-sm-2">
                                <img style="width:70px;height:relative" src="<?php echo base_url();?>uploads/image/<?=$this->fungsi->user_login()->foto?>" class="img-rounded"  alt="User Image" />
                            </div>
                            <div class="col-sm-6">
                                <p ><?php foreach($rownip as $data) echo $data['nip'];?></p>
                                <p style="font-size:20px"><strong><?=$this->fungsi->user_login()->fullname?></strong></p>
                                <p><small><?=$this->fungsi->user_login()->email?></small></p>
                            </div>
                            <div class="col-sm-4">
                                <a class="btn btn-block btn-social btn-google-plus" data-toggle="tooltip" title="Hak Cuti" >
                                    <i class="fa fa-info-circle"></i> Cuti Khusus
                                </a>
                            </div>
                        </div>
                        <div class="box-body" id="bodyCutiKs">
                            <div class="form-group">
                                <label for="nocuti">No Pengajuan</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="nocuti" id="nocuti" readonly>
                                    <div class="input-group-addon"><i class="fa fa-barcode"></i></div>
                                </div>
                            <!-- Hidden ELement -->
                                    <input type="hidden" class="form-control" name="idcutiks" id="idcutiks">
                                    <input type="hidden" class="form-control" name="nip" id="nip" readonly value="<?php foreach($rownip as $data) echo $data['nip'];?>" >
                            <!-- ./ Hidden ELement -->
                            </div>
                            <div class="form-group">
                                <label for="awalctks" >Awal Cuti </label> <small class="text-danger"> *</small> 
                                <label for="akrctks" style="margin-left:120px" >Akhir Cuti </label> <small class="text-danger"> *</small> 
                                <label for="totalctks" style="margin-left:120px" >Total Hari </label> <small class="text-danger"> *</small>
                                <div class="form-inline">
                                    <div class="input-group date" id="tgl5ks" style="margin-right:5px" >
                                        <input type="text" class="form-control datepicker" name="awalctks"  id="awalctks" style="width:150px" onkeydown="event.preventDefault()" placeholder="Tgl..">
                                        <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                        </div>
                                    </div>
                                    <div class="input-group date" id="tgl6ks">
                                        <input type="text" class="form-control datepicker" name="akrctks" id="akrctks" style="width:150px" onkeydown="event.preventDefault()" placeholder="Tgl..">
                                        <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                        </div>
                                    </div>
                                    <div class="input-group" style="margin-left:5px">
                                        <input type="text" name="totalctks" id="totalctks" class="form-control" onkeydown="event.preventDefault()" style="width:123px">
                                        <div class="input-group-addon">
                                        <i class="fa fa-map-marker"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="ketcutiks">Keterangan Cuti</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="ketcutiks" id="ketcutiks" required > 
                                    <div class="input-group-addon"><i class="fa fa-pencil"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Tutup</button>
                    <button type="submit" class="btn btn-success"><i class="fa fa-check-square-o"></i> Update</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <script src="<?=base_url();?>assets/js/jquery-2.1.1.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).on("click","#editKs",function(){
            var id      = $(this).data('id');
            var noform  = $(this).data('noform');
            var awal  = $(this).data('awal');
            var akhir  = $(this).data('akhir');
            var ket  = $(this).data('ket');
            var totalhr  = $(this).data('totalhr');
            var status  = $(this).data('status');

            $("#bodyCutiKs #nocuti").val(noform);
            $("#bodyCutiKs #idcutiks").val(id);
            $("#bodyCutiKs #awalctks").val(awal);
            $("#bodyCutiKs #akrctks").val(akhir);
            $("#bodyCutiKs #totalctks").val(totalhr);
            $("#bodyCutiKs #ketcutiks").val(ket);

        });
        $(function(){
            $('#tgl5ks').datepicker({
                locale:'id',
                autoclose: true,
                todayHighlight: true,
            });

            $('#tgl6ks').datepicker({
                useCurrent: false,
                locale:'id',
                autoclose: true,
            });

            $("#tgl5ks").on('changeDate', function(selected){
                var startDate = new Date(selected.date.valueOf());
                $("#tgl6ks").datepicker('setStartDate', startDate);
                if($("#tgl5ks").val() > $("#tgl6ks").val()){
                    $("#tgl6ks").val($("#tgl5ks").val());
                }
            });    

            $("#tgl6ks").on('changeDate', function(){
                hitDeffKs();   
            })        
        });
        // Menghitung selisih tanggal
        function hitDeffKs(){
            if ( ($("#awalctks").val() != "") && ($("#akrctks").val() != "")) {
                var oneDay = 24*60*60*1000; // hours*minutes*seconds*milliseconds
                var firstDate = new Date($("#awalctks").val());
                var secondDate = new Date($("#akrctks").val());
                var diffDays = Math.round(Math.round((secondDate.getTime()- firstDate.getTime()) / (oneDay) +1));
                $("#totalctks").val(diffDays);                
            }
        };
    </script>
<!-- ./ Modal Edit Cuti  Khusus-->

