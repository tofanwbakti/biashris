<!-- View Template Ijen Alpa  -->
<!-- ================================================ -->
<!-- Breadcumb section -->
<section class="content-header">
    <h1>
        <div class="icon">
        <i class="fa fa-calendar"></i> Manajemen Cuti Karyawan
        <!-- <small>Tidak Masuk Kerja / Alpa</small> -->
        </div>
        
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>Hrd"><i class="fa fa-dashboard"></i> Dashboard</a></li> 
        <li><a href="<?= site_url('Hrd/cuti') ?>"><i class="fa fa-calendar"></i> Cuti</a></li>
        
    
</section>
<!-- Flash Data -->
<div class="flashCuti" data-flashdata="<?=$this->session->flashdata('flash'); ?>"></div>
<div class="flash-err" data-flashdata="<?=$this->session->flashdata('flash_error'); ?>"></div>

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
            Berikut Daftar pengajuan cuti karyawan di Bias Mandiri Group
        </div><!-- /.box-body -->
        <!-- <div class="box-footer">
            <small><i>Pastikan sudah memiliki <strong><a href="<?=site_url('Hrd/kontrak')?>">Kontrak Kerja</a></strong> untuk penambahan karyawan baru !</i></small>
        </div> -->
        <!-- /.box-footer-->
    </div>
    <!-- /.box -->

<!-- widget -->
    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-aqua">
            <span class="info-box-icon"><i class="fa fa-bookmark-o"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Total</span>
                    <!-- Item Category Qty -->
                    <span class="info-box-number">
                        <?php $this->db->where('stat_cukar !=',"BATAL");
                        $this->db->from('tb_cuti_karyawan');
                        echo $this->db->count_all_results();?>
                    </span>
                    <div class="progress">
                        <div class="progress-bar" style="width: 100%"></div>
                    </div>
                    <span class="progress-description">
                    Pengajuan Cuti
                    </span>
                </div><!-- /.info-box-content -->
            </div><!-- /.info-box -->
        </div><!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-green">
                <span class="info-box-icon"><i class="fa fa-thumbs-o-up"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Disetujui</span>
                    <!-- Item Category Qty -->
                    <span class="info-box-number">
                        <?php $this->db->where('stat_cukar',"DISETUJUI");
                        $this->db->from('tb_cuti_karyawan');
                        echo $this->db->count_all_results();?>
                    </span>
                    <div class="progress">
                        <div class="progress-bar" style="width: 100%"></div>
                    </div>
                    <span class="progress-description">
                    Pengajuan Cuti
                    </span>
                </div><!-- /.info-box-content -->
            </div><!-- /.info-box -->
        </div><!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-yellow">
                <span class="info-box-icon"><i class="fa fa-hand-paper-o"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Menunggu</span>
                    <!-- Item Category Qty -->
                    <span class="info-box-number">
                        <?php $this->db->where('stat_cukar',"MENUNGGU");
                        $this->db->from('tb_cuti_karyawan');
                        echo $this->db->count_all_results();?>
                    </span>
                    <div class="progress">
                    <div class="progress-bar" style="width: 100%"></div>
                    </div>
                    <span class="progress-description">
                    Pengajuan Cuti
                    </span>
                </div><!-- /.info-box-content -->
            </div><!-- /.info-box -->
        </div><!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-red">
                <span class="info-box-icon"><i class="fa fa-thumbs-o-down"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Ditolak</span>
                    <!-- Item category qty  -->
                    <span class="info-box-number">
                    <?php $this->db->where('stat_cukar',"DITOLAK");
                    $this->db->from('tb_cuti_karyawan');
                    echo $this->db->count_all_results();?>
                    </span>
                    <div class="progress">
                    <div class="progress-bar" style="width: 100%"></div>
                    </div>
                    <span class="progress-description">
                    Pengajuan Cuti
                    </span>
                </div><!-- /.info-box-content -->
            </div><!-- /.info-box -->
        </div><!-- /.col -->
    </div><!-- /.row --> 
<!-- ./widget -->

<!-- Tables  -->
<!-- NAV TABS -->
    <div class="row">
        <div class="col-xs-12">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs" role="tablist">
                <li class="active">
                    <a href="#cutiTahunan" data-toggle="tab">
                        <i class="fa fa-calendar text-blue" style="margin-right:10px;font-size:20px"></i> Cuti Tahunan 
                        <span class="badge bg-yellow" style="margin-left:15px" data-toggle="tooltip" title="MENUNGGU">
                        <?php $this->db->where('tipe_cukar',"TAHUNAN");
                        // $this->db->where('stat_cukar !=',"BATAL");
                        $this->db->where('stat_cukar',"MENUNGGU");
                        $this->db->from('tb_cuti_karyawan');
                        echo $this->db->count_all_results(); ?>
                        </span>
                    </a>
                </li>
                <li>
                    <a href="#cutiKhusus" data-toggle="tab">
                        <i class="fa fa-calendar text-red" style="margin-right:10px;font-size:20px"></i> Cuti Khusus
                        <span class="badge bg-yellow" style="margin-left:15px" data-toggle="tooltip" title="MENUNGGU">
                        <?php $this->db->where('tipe_cukar',"KHUSUS");
                        // $this->db->where('stat_cukar !=',"BATAL");
                        $this->db->where('stat_cukar',"MENUNGGU");
                        $this->db->from('tb_cuti_karyawan');
                        echo $this->db->count_all_results(); ?>
                        </span>
                    </a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="cutiTahunan">
                    <div class="box">
                        <div class="box-header">
                            <h2 class="box-title"> Pengajuan Cuti Karyawan</h2>
                            <div class="pull-right">
                                <div class="drop-down">
                                    <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#cutiKaryawan"><i class="fa fa-calendar-plus-o" style="margin-right:5px;font-size:20px"></i> Potong Cuti Karyawan</button>
                                </div>
                            </div>
                        </div>
                        <div class="box-body table-responsive">
                            <table id="tablehistory" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th width="20px">#</th>
                                        <th>No. Pengajuan</th>
                                        <th>Nama</th>
                                        <th>NIP</th>
                                        <th>Keterangan Cuti</th>
                                        <th>Periode Cuti </th>
                                        <th>Total Hari</th>
                                        <th>Status</th>
                                        <th><i class="fa fa-cogs"></i></th>
                                    </tr>
                                </thead>                                                       
                                <tbody class="">
                                <?php $no=1;
                                foreach($rowcutiTh as $data){?>
                                    <tr class="">
                                        <td><?=$no++; ?></td>
                                        <td><?=$data['noform']?></td>
                                        <td><?=$data['nickname']?></td>
                                        <td><?=$data['nip']?></td>
                                        <td><?=$data['ket_cukar']?></td>
                                        <td><?=date("d M y",strtotime($data['awal_cukar']))." - ".date("d M y",strtotime($data['akhir_cukar']))?></td>
                                        <td><?=$data['totalhr_cukar']?> hari</td>
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
                                        $this->db->select('*');
                                        $this->db->from('tb_cuti_jatah');
                                        $this->db->where('nip',$data['nip']);
                                        $this->db->where('c_status',"A");
                                        $get = $this->db->get()->result();
                                        foreach($get as $datajt){$dtget = $datajt->sisa_cuti;} // untuk mendapatkan data sisa cuti dari table Jatah Cuti
                                        $level = $this->fungsi->user_login()->id_lvl;
                                        $nickname = $this->fungsi->user_login()->nickname;
                                        $jabatan = $this->fungsi->user_login()->nama_jab;
                                        if($data['stat_cukar'] == "MENUNGGU"){
                                            echo "<a href='".site_url('Hrd/apvCuti/').encrypt_url($data['id_cukar']).'/'.encrypt_url($data['noform']).'/'.encrypt_url($level).'/'.encrypt_url($nickname).'/'.encrypt_url($jabatan)."' data-toggle='tooltip' title='Setujui' class='tombol-apv' ><i class='fa fa-thumbs-o-up text-green' style='margin-right:3px'></i> </a> |  
                                            <a href=".site_url('Hrd/rejectCuti/').encrypt_url($data['id_cukar']).'/'.encrypt_url($data['noform']).'/'.encrypt_url($level).'/'.encrypt_url($nickname).'/'.encrypt_url($jabatan).'/'.encrypt_url($dtget).'/'.encrypt_url($data['totalhr_cukar']).'/'.encrypt_url($data['nip']).'/'.encrypt_url($data['tipe_cukar'])."' data-toggle='tooltip' title='Tolak' ><i class='fa fa-thumbs-o-down text-red' style='margin-right:3px'></i> </a> |" ;
                                        }?>
                                            <a href="<?=site_url('LaporanPdf/detailCuti/').encrypt_url($data['id_cukar'])."/".encrypt_url($data['noform']) ?>" target="_BLANK"><i class="fa fa-print"></i></a>
                                        </td>
                                    </tr>
                                <?php } ?>
                                </tbody>                                            
                            </table>
                        </div>
                    </div> <!-- ./ Box -->
                </div><!-- ./ pane cutiTahunan -->
                <div class="tab-pane" id="cutiKhusus">
                    <div class="box">
                        <div class="box-header">
                            <h2 class="box-title"> Pengajuan Cuti Karyawan</h2>
                        </div>
                        <div class="box-body table-responsive">
                            <table id="tablehistory3" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th width="10px">#</th>
                                        <th width="130px">No. Pengajuan</th>
                                        <th width="70px">Nama</th>
                                        <th width="70px">NIP</th>
                                        <th width="200px">Keterangan Cuti</th>
                                        <th width="160px">Periode Cuti </th>
                                        <th width="70px">Total</th>
                                        <th width="70px">Status</th>
                                        <th width="70px"><i class="fa fa-cogs"></i></th>
                                    </tr>
                                </thead>
                                <tbody class="">
                                <?php $no=1;
                                foreach($rowcutiKs as $data){?>
                                    <tr class="">
                                        <td><?=$no++; ?></td>
                                        <td><?=$data['noform']?></td>
                                        <td><?=$data['nickname']?></td>
                                        <td><?=$data['nip']?></td>
                                        <td><?=$data['ket_cukar']?></td>
                                        <td><?=date("d M y",strtotime($data['awal_cukar']))." - ".date("d M y",strtotime($data['akhir_cukar']))?></td>
                                        <td><?=$data['totalhr_cukar']?> hari</td>
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
                                        $level = $this->fungsi->user_login()->id_lvl;
                                        $nickname = $this->fungsi->user_login()->nickname;
                                        $jabatan = $this->fungsi->user_login()->nama_jab;
                                        if($data['stat_cukar'] == "MENUNGGU"){
                                            echo "<a href='".site_url('Hrd/apvCuti/').encrypt_url($data['id_cukar']).'/'.encrypt_url($data['noform']).'/'.encrypt_url($level).'/'.encrypt_url($nickname).'/'.encrypt_url($jabatan)."' data-toggle='tooltip' title='Setujui' class='tombol-apv' ><i class='fa fa-thumbs-o-up text-green' style='margin-right:3px'></i> </a> |  
                                            <a href=".site_url('Hrd/rejectCuti/').encrypt_url($data['id_cukar']).'/'.encrypt_url($data['noform']).'/'.encrypt_url($level).'/'.encrypt_url($nickname).'/'.encrypt_url($jabatan).'/'.encrypt_url($dtget).'/'.encrypt_url($data['totalhr_cukar']).'/'.encrypt_url($data['nip']).'/'.encrypt_url($data['tipe_cukar'])."' data-toggle='tooltip' title='Tolak' ><i class='fa fa-thumbs-o-down text-red' style='margin-right:3px'></i> </a> |" ;
                                        }?>
                                            <a href="<?=site_url('LaporanPdf/detailCuti/').encrypt_url($data['id_cukar'])."/".encrypt_url($data['noform']) ?>" target="_BLANK"><i class="fa fa-print"></i></a>
                                        </td>
                                    </tr>
                                <?php } ?>
                                </tbody>                                            
                            </table>
                        </div>
                    </div> <!-- ./ Box -->
                </div>
            </div>
        </div>
            
        </div>
    </div>
</section><!-- /.content -->

<!-- Modal Tambah Cuti Karyawan -->
    <div class="modal fade" id="cutiKaryawan" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" type="button" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><i class="fa fa-calendar-plus-o text-primary"></i> Form Potong Cuti Karyawan</h4>
                </div>
                <form action="<?=site_url('Hrd/potCuti')?>" method="post">
                <div class="modal-body">
                    <div class="box box-primary">
                        <div class="box-header">
                            <div class="form-group">
                                <label for="karyawan">Pilih Karyawan</label>
                                <div class="input-group">
                                    <select class="form-control" name="karyawan" id="karyawan" style="width:550px" onchange="cekJT();">
                                    <option selected disabled> Pilih Satu..</option>
                                    <?php foreach ($rownik as $dtnik){ 
                                        ?>
                                        <option value="<?=$dtnik['id_cutijt']?>"> <?=$dtnik['email']?> - <?=$dtnik['nip']?></option>
                                        <?php
                                    } ?>                                        
                                    </select>
                                </div>                                
                            </div>
                            <!-- No urut -->
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
                            $romawi = getRomawi(date('n')); // ROmawi untuk bulan
                            $tipe   = "CT"; //Jenis Cuti
                            foreach ($noform as $data){
                                $ngurut = sprintf("%04s",$data['urutan'] + 1);
                            } 
                            $tahun  = date('y');
                            $hasil_dpn = $ngurut.'/'.$tipe.'-';      
                            $hasil_blk = '/'.$romawi.'/'.$tahun ;        

                            ?>
                            <input type="hidden" id="no_dpn" value="<?=$hasil_dpn?>" >
                            <input type="hidden" id="no_blk" value="<?=$hasil_blk?>" >
                            <input type="hidden" id="sisaCuti" >
                            <!-- NIP Karyawan -->
                            <input type="hidden" id="nip" name="nip" > 
                            <input type="hidden" id="idkar" name="idkar" > 
                            <input type="hidden" id="sbu" name="sbu" > 
                            <input type="hidden" id="urutan" name="urutan" value="<?=$ngurut?>" > 
                            <input type="hidden" id="apv2" name="apv2" value="<?=$this->fungsi->user_login()->nickname?>" > 
                            <input type="hidden" id="jabapv2" name="jabapv2" value="<?=$this->fungsi->user_login()->nama_jab?>" > 
                            <!-- widget detail cuti  -->
                            <div class="row" id="widget" style="margin-left:3px">
                            </div> <!-- /.row Widget -->
                            <div class="form-group">
                                <label for="nocuti">No Pengajuan</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="nocuti" id="nocuti" readonly > 
                                    <div class="input-group-addon"><i class="fa fa-barcode"></i></div>
                                </div>
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
                    <button type="submit" class="btn btn-primary btn-add" id="btn_simpan"><i class="fa fa-paper-plane"></i> Simpan</button>
                </div>
                </form>
            </div>
        </div>
    </div>
<!-- ./ Modal Tambah Cuti Karyawan -->
<script src="<?=base_url();?>assets/js/jquery-2.1.1.min.js" type="text/javascript"></script>
<script type="text/javascript">
    $('#perawal').prop('disabled',true);
    $('#perakhir').prop('disabled',true);
    $('#ketcuti').prop('disabled',true);
    $('#btn_simpan').prop('disabled',true);

    function cekJT(){
        var id = document.getElementById("karyawan").value;
        // alert(id);
        $.ajax({
            url     : '<?=base_url()?>Hrd/cariJatah',
            method  : 'POST',
            data    : {id: id},
            dataType: 'json',
            success : function(response){
                var leng = response.length;
                if (leng > 0){
                    var hak     = response[0].ttl_cuti;
                    var sisa    = response[0].sisa_cuti;
                    var pakai   = hak - sisa;

                    // Format nomor cuti
                    var nip     = response[0].nip;
                    var idkar   = response[0].id_kar;
                    var sbu     = response[0].kode;
                    var nodpn   = document.getElementById("no_dpn").value;
                    var noblk   = document.getElementById("no_blk").value;

                    var hasilno = nodpn+sbu+noblk;

                    $('#nocuti').val(hasilno);
                    $('#sisaCuti').val(sisa);
                    $('#nip').val(nip);
                    $('#idkar').val(idkar);
                    $('#sbu').val(sbu);

                    // alert(sbu);

                    // $('#nocuti').val(hak);
                    $("#widget").html('<ul class="fc-color-picker" ><li style="font-size:20px">Detail Cuti </li><li style="margin-left:50px"><a class="btn btn-app"><span class="badge bg-aqua" id="ctTtl" style="font-size:15px">'+hak+'</span><i class="fa fa-star" style="font-size:25px"></i>Jatah</a></li><li style="margin-left:50px"><a class="btn btn-app"><span class="badge bg-green" id="ctUse" style="font-size:15px">'+pakai+'</span><i class="fa fa-star-half-o" style="font-size:25px"></i>Diambil</a></li><li style="margin-left:50px"><a class="btn btn-app" data-toggle="tooltip" title="Sisa"><span class="badge bg-yellow" id="ctSis" style="font-size:15px">'+sisa+'</span><i class="fa fa-star-half-o" style="font-size:25px"></i>Sisa</a></li></ul>');

                    $('#perawal').prop('disabled',false);
                    $('#perawal').val('');
                    $('#perakhir').prop('disabled',false);
                    $('#perakhir').val('');
                    $('#ketcuti').prop('disabled',false);
                    $('#totalhr').val('');
                    $('#sisact').val('');
                    $('#ketcuti').val('');
                    $('#btn_simpan').prop('disabled',false);
                }
            }
        });
        
    };

    $(function(){
            $('#tgl3').datepicker({
                locale:'id',
                autoclose: true,
                todayHighlight: true,
            });

            $('#tgl4').datepicker({
                autoclose: true,
                useCurrent: false,
                locale:'id',
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
            var stock = $("#sisaCuti").val();
            var hari = $("#totalhr").val();
            var hasil = parseInt(stock) - parseInt(hari);
            if(!isNaN(hasil)){
                $("#sisact").val(hasil);
            }else $("#sisact").val(0);
        };

        // Batas Hak Cuti
        function batas(){
            var stokct = document.getElementById('sisaCuti').value;
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
