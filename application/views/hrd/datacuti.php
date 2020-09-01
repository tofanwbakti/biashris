<!-- View Template Ijen Alpa  -->
<!-- ================================================ -->
<!-- Breadcumb section -->
<section class="content-header">
    <h1>
        <div class="icon">
        <i class="fa fa-calendar"></i> Data Cuti Karyawan
        <!-- <small>Tidak Masuk Kerja / Alpa</small> -->
        </div>
        
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>Hrd"><i class="fa fa-dashboard"></i> Dashboard</a></li> 
        <li><a href="<?= site_url('Hrd/cuti') ?>"><i class="fa fa-calendar"></i> Cuti</a></li>
        
</section>

<!-- Flash Data -->
<div class="flash-unit" data-flashdata="<?=$this->session->flashdata('flash'); ?>"></div>
<div class="flash-err" data-flashdata="<?=$this->session->flashdata('flash_error'); ?>"></div>

<!-- Main content -->
<section class="content">

<!-- Box COllapsable -->
    <div class="box box-default box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><i class="icon fa fa-calendar-check-o"></i> Pengaturan Cuti Bersama</h3>
            <button class="btn btn-box-tool btn-primary" type="button" style="margin-left:10px" data-toggle="modal" data-target="#modCutiBer"><font color="white"> <i class="fa fa-plus-circle" style="margin-right:5px"></i> Tambah</font></button>
            <div class="box-tools pull-right">
                <small style="margin-right:50px">Tahun <?=gmdate("Y") ?></small>
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
                        <th width="50px" class="text-center"><i class="fa fa-cogs"></i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach($rowcutibr as $data) { ?>
                    <tr>
                        <td><?=$no++;?></td>
                        <td><?=$data['uraian'] ?></td>
                        <td><?=date("d F Y", strtotime($data['awal_cuti']))?></td>
                        <td><?=date("d F Y", strtotime($data['akhir_cuti']))?></td>
                        <td><?=$data['jml_hari'] ?> Hari</td>
                        <td><span data-toggle="modal" data-target="#modUpdateCB">
                        <a href="#" id="editData" data-toggle="tooltip" title="Edit"  data-id="<?=$data['id_cuti']?>" data-ket="<?=$data['uraian']?>"  data-tglawal="<?=date("m/d/yy", strtotime($data['awal_cuti']))?>" data-tglakhir="<?=date("m/d/yy", strtotime($data['akhir_cuti']))?>" data-tahun="<?=$data['tahun']?>" data-jmlhari="<?=$data['jml_hari']?>" data-kategori="<?=$data['kategori']?>"><i class="fa fa-pencil-square-o"></i></a></span>
                        <span><a href="<?=site_url('Hrd/delCutiBersama/').encrypt_url($data['id_cuti']) ?>" style="margin-left:5px" data-toggle="tooltip" title="Hapus" class="tombol-del"><i class="fa fa-trash-o text-red"></i></a></span>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div><!-- /.box-body -->        
    </div>

<!-- Tables  -->
<!-- NAV TABS -->
    <div class="row">
        <div class="col-xs-12">

            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="active"><a href="#cutiAktif" data-toggle="tab"><i class="fa fa-unlock-alt text-green" style="margin-right:10px;font-size:20px"></i> Cuti Aktif </a></li>
                    <li class=""><a href="#cutiNonAktif" data-toggle="tab"><i class="fa fa-lock text-red" style="margin-right:10px;font-size:20px"></i> Cuti Non Aktif</a></li>
                    <li class=""><a href="#cutiBaru" data-toggle="tab"><i class="fa fa-lock text-blue" style="margin-right:10px;font-size:20px"></i> Cuti Baru</a></li>
                </ul>
                
                <div class="tab-content">
                    <div class="tab-pane active" id="cutiAktif">
                        <div class="box ">
                            <div class="box-header">
                                <div class="pull-right">
                                    <div class="dropdown">
                                        <button class="btn btn-primary btn-xs dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-plus-circle"style="margin-right:5px"> </i>  Atur Cuti  <span class="caret" style="margin-left:3px"></span>
                                        </button>
                                        <ul class="dropdown-menu pull-right">
                                            <!-- <li><a href="javascript:void(0)" data-toggle="modal" data-target="#modalCb"><i class="fa fa-calendar-plus-o text-aqua"></i> Cuti Bersama</a></li>
                                            <li class="divider"></li>  -->
                                            <li><a href="javascript:void(0)" data-toggle="modal" data-target="#modalAddCuti"><i class="fa fa-calendar-plus-o text-red"></i> Cuti Baru</a></li>
                                        </ul>                                
                                    </div>
                                </div>
                            </div>
                            <div class="box-body table-responsive">
                                <table id="tablehistory" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>NIP</th>
                                            <th>Total Cuti</th>
                                            <th data-tooltip="tooltip" title="Cuti Bersama">CB</th>
                                            <th data-tooltip="tooltip" title="Cuti Pribadi">CP</th>
                                            <th>Sisa Cuti</th>
                                            <th>Tahun Cuti</th>
                                            <th>Awal Cuti</th>
                                            <th>Batas Cuti</th>
                                            <th><i class="fa fa-cogs"></i></th>
                                        </tr>
                                    </thead>                                                     
                                    <tbody class="">
                                    <?php $no = 1;
                                    $today = gmdate("Y-m-d", time()+60*60*7);
                                    foreach($rowjtct as $data) { ?>
                                        <tr <?= $data['per_akhir'] < $today ? "class='danger'" : null ?>>
                                            <td><?= $no++ ; ?></td>
                                            <td ><a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="<?=$data['email']?>"><?=$data['nip'] ?></a></td>
                                            <td><?=$data['ttl_cuti'] ?> hari</td>
                                            <td><?php if ($data['jml_hari'] > 0 ){ echo $data['jml_hari']; } else { echo "0"; } ?> hari</td>
                                            <td><?=$data['c_pribadi'] ?> hari</td>
                                            <td><?=$data['sisa_cuti'] ?> hari</td>
                                            <td><?=$data['cuti_thn'] ?></td>
                                            <td><?=date("d M Y",strtotime($data['per_awal'])) ?> </td>
                                            <td><?=date("d M Y",strtotime($data['per_akhir'])) ?> </td>
                                            <td><span data-toggle="modal" data-target="#modalEditCuti" id="btnEditCuti"><a href="javascript:void(0)" class="tombolEdit" data-toggle="tooltip" data-title="Edit" id="editCuti"  data-id="<?=$data['id_cutijt']?>" data-ttl="<?=$data['ttl_cuti']?>" data-cb="<?=$data['c_bersama']?>" data-cp="<?=$data['c_pribadi']?>" data-sc="<?=$data['sisa_cuti']?>" data-thn="<?=$data['cuti_thn']?>" data-awl="<?=date("m/d/y",strtotime($data['per_awal']))?>" data-akr="<?=date("m/d/y",strtotime($data['per_akhir']))?>" data-stt="<?=$data['c_status']?>" data-email="<?=$data['email']?>" data-start="<?=date("d M Y",strtotime($data['start']))?>" data-end="<?=date("d M Y",strtotime($data['end']))?>" data-nip="<?=$data['nip']?>"><i class="fa fa-pencil-square-o text-blue" data-tooltip="tooltip" title="Edit"></i></a></span>                               
                                            <span style="margin-left:3px"><a href="<?=site_url('Hrd/nonAktifCuti/').encrypt_url($data['id_cutijt']); ?>" class="tombol-cuti" data-toggle="tooltip" title="Nonaktifkan"><i class="fa fa-power-off text-red"></i></a></span>
                                            </td>                                
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                                
                                </table>
                            </div>
                        </div>
                    </div><!-- Tab content -->
                    <div class="tab-pane" id="cutiNonAktif">
                        <div class="box ">
                            <div class="box-header">
                                <div class="pull-right">
                                    <div class="dropdown">
                                        <button class="btn btn-primary btn-xs dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-plus-circle"style="margin-right:5px"> </i>  Atur Cuti  <span class="caret" style="margin-left:3px"></span>
                                        </button>
                                        <ul class="dropdown-menu pull-right">
                                            <li><a href="javascript:void(0)" data-toggle="modal" data-target="#modalAddCuti"><i class="fa fa-calendar-plus-o text-red"></i> Cuti Baru</a></li>
                                        </ul>                                
                                    </div>
                                </div>
                            </div>
                            <div class="box-body table-responsive">
                                <table id="tablehistory2" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>NIP</th>
                                            <th>Total Cuti</th>
                                            <th data-tooltip="tooltip" title="Cuti Bersama">CB</th>
                                            <th data-tooltip="tooltip" title="Cuti Pribadi">CP</th>
                                            <th>Sisa Cuti</th>
                                            <th>Tahun Cuti</th>
                                            <th>Awal Cuti</th>
                                            <th>Batas Cuti</th>
                                            <th><i class="fa fa-cogs"></i></th>
                                        </tr>
                                    </thead>                                                     
                                    <tbody class="">
                                    <?php $no = 1;
                                    $today = gmdate("Y-m-d", time()+60*60*7);
                                    foreach($rowjtct2 as $data) { ?>
                                        <tr <?= $data['status'] == "D" ? "class='danger'" : null ?>>
                                            <td><?= $no++ ; ?></td>
                                            <td ><a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="<?=$data['email']?>"><?=$data['nip'] ?></a></td>
                                            <td><?=$data['ttl_cuti'] ?> hari</td>
                                            <td><?php if ($data['jml_hari'] > 0 ){ echo $data['jml_hari']; } else { echo "0"; } ?> hari</td>
                                            <td><?=$data['c_pribadi'] ?> hari</td>
                                            <td><?=$data['sisa_cuti'] ?> hari</td>
                                            <td><?=$data['cuti_thn'] ?></td>
                                            <td><?=date("d M Y",strtotime($data['per_awal'])) ?> </td>
                                            <td><?=date("d M Y",strtotime($data['per_akhir'])) ?> </td>
                                            <td><span><a href="<?=site_url('Hrd/delCutiNonaktif/').encrypt_url($data['id_cutijt']) ?>" style="margin-left:5px" data-toggle="tooltip" title="Hapus" class="tombol-del"><i class="fa fa-trash-o text-red"></i></a></span>                            
                                            </td>                                
                                        </tr>
                                    <?php } ?>
                                    </tbody>                                                
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- TAB CONTENT CUTI BARU -->
                    <div class="tab-pane" id="cutiBaru">
                        <div class="box ">
                            <div class="box-header">
                                <div class="pull-right">
                                    <div class="dropdown">
                                        <button class="btn btn-primary btn-xs dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-plus-circle"style="margin-right:5px"> </i>  Atur Cuti  <span class="caret" style="margin-left:3px"></span>
                                        </button>
                                        <ul class="dropdown-menu pull-right">
                                            <!-- <li><a href="javascript:void(0)" data-toggle="modal" data-target="#modalCb"><i class="fa fa-calendar-plus-o text-aqua"></i> Cuti Bersama</a></li>
                                            <li class="divider"></li>  -->
                                            <li><span data-toggle="tooltip" title="Khusus Cuti Expired"><a href="javascript:void(0)" data-toggle="modal" data-target="#modalAddCuti" ><i class="fa fa-calendar-plus-o text-red"></i> Cuti Baru</a></span></li>
                                        </ul>                                
                                    </div>
                                </div>
                            </div>
                            <div class="box-body table-responsive">
                                <table id="tablehistory3" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>NIP</th>
                                            <th>Total Cuti</th>
                                            <th data-tooltip="tooltip" title="Cuti Bersama">CB</th>
                                            <th data-tooltip="tooltip" title="Cuti Pribadi">CP</th>
                                            <th>Sisa Cuti</th>
                                            <th>Tahun Cuti</th>
                                            <th>Awal Cuti</th>
                                            <th>Batas Cuti</th>
                                            <th><i class="fa fa-cogs"></i></th>
                                        </tr>
                                    </thead>                                                     
                                    <tbody class="">
                                    <?php $no = 1;
                                    $today = gmdate("Y-m-d", time()+60*60*7);
                                    foreach($rowjtct3 as $data) { ?>
                                        <tr>
                                            <td><?= $no++ ; ?></td>
                                            <td ><a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="<?=$data['email']?>"><?=$data['nip'] ?></a></td>
                                            <td><?=$data['ttl_cuti'] ?> hari</td>
                                            <td>0 hari</td>
                                            <td><?=$data['c_pribadi'] ?> hari</td>
                                            <td><?=$data['sisa_cuti'] ?> hari</td>
                                            <td><?=$data['cuti_thn'] ?></td>
                                            <td><?=date("d M Y",strtotime($data['per_awal'])) ?> </td>
                                            <td><?=date("d M Y",strtotime($data['per_akhir'])) ?> </td>
                                            <td><span data-toggle="modal" data-target="#modalEditCuti" id="btnCutiBaru"><a href="javascript:void(0)"  data-toggle="tooltip" data-title="Edit" id="editCuti"  data-id="<?=$data['id_cutijt']?>" data-ttl="<?=$data['ttl_cuti']?>" data-cb="<?=$data['c_bersama']?>" data-cp="<?=$data['c_pribadi']?>" data-sc="<?=$data['sisa_cuti']?>" data-thn="<?=$data['cuti_thn']?>" data-awl="<?=date("m/d/y",strtotime($data['per_awal']))?>" data-akr="<?=date("m/d/y",strtotime($data['per_akhir']))?>" data-stt="<?=$data['c_status']?>" data-email="<?=$data['email']?>" data-start="<?=date("d M Y",strtotime($data['start']))?>" data-end="<?=date("d M Y",strtotime($data['end']))?>" data-nip="<?=$data['nip']?>"><i class="fa fa-pencil-square-o text-blue" data-tooltip="tooltip" title="Edit"></i></a> </span>                             
                                            </td>                                
                                        </tr>
                                    <?php } ?>
                                    </tbody>                                                
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</section><!-- /.content -->

<!-- Modal TAMBAH Cuti Bersama -->
    <div id= "modCutiBer" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"> <i class="fa fa-calendar-plus-o text-primary"></i>  Tambah Kalender Cuti Bersama</h4>
                </div>
            <form role="form" action="<?=site_url('Hrd/addCutiBersama')?>" method="POST">
                <div class="modal-body" id="ubahLvl">                
                        <div class="box-body">
                            <div class="form-group">
                                <label for="kodejab">Uraian Cuti</label> <small class="text-danger"> *</small>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="uraian" name="uraian" required>
                                    <div class="input-group-addon">
                                    <i class="fa fa-tags"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="tglmulai" >Mulai Cuti </label> <small class="text-danger"> *</small> 
                                <label for="tglakhir" style="margin-left:115px" >Akhir Cuti </label> <small class="text-danger"> *</small> 
                                <label for="selisih" style="margin-left:115px" >Jumlah </label> <small class="text-danger"> *</small> 
                                <div class="form-inline">
                                    <div class="input-group date" id="tgl5">
                                        <input type="text" class="form-control datepicker" name="tglmulai"  id="tglmulai" readonly placeholder="Tgl.." style="width:150px">
                                        <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                        </div>
                                    </div>
                                    <div class="input-group date" id="tgl6">
                                        <input type="text" class="form-control datepicker" name="tglakhir" id="tglakhir" readonly placeholder="Tgl.." style="margin-left:5px;width:150px">
                                        <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                        </div>
                                    </div>
                                    <div class="input-group" style="margin-left:5px">
                                        <input type="text" class="form-control" id="selisih" name="selisih" style="width:105px" placeholder="Durasi.." required>
                                        <div class="input-group-addon"> Hari</div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-inline">
                                <label for="kategori">Kategori Cuti</label> <small class="text-danger"> *</small>
                                <label for="periode" style="margin-left:185px">Periode Tahun Cuti</label> <small class="text-danger"> *</small>
                                <div class="input-group" style="width:270px">
                                    <select name="kategori" id="kategori" class="form-control" required>
                                        <option value="" selected disabled> Pilih satu ..</option>
                                        <option value="M"> Cuti Muslim</option>
                                        <option value="N"> Cuti Nasrani</option>
                                        <option value="U"> Cuti Umum</option>
                                    </select>
                                </div>                           
                                <div class="input-group" style="width:270px;margin-left:5px">
                                    <select name="periode" id="periode" class="form-control" required>
                                        <option value="" selected disabled> Pilih satu ..</option>
                                        <?php 
                                        $thnskrg = gmdate("Y");
                                        for ($x = $thnskrg; $x >= 2018; $x--){
                                            ?>
                                            <option value="<?= $x ?>"><?= $x ?></option>
                                        <?php } ?>
                                    </select>
                                </div>                           
                            </div>
                            <input type="hidden" class="form-control" id="status" name="status" value="A">                            
                        </div><!-- /.box-body -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Tutup</button>
                            <button type="submit" class="btn btn-primary"><i class="fa fa-send"></i> Simpan</button>
                        </div>                           
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
                hitDeff();
            })
            
        });
        // Menghitung selisih tanggal
        function hitDeff(){
            if ( ($("#tglmulai").val() != "") && ($("#tglakhir").val() != "")) {
                var oneDay = 24*60*60*1000; // hours*minutes*seconds*milliseconds
                var firstDate = new Date($("#tglmulai").val());
                var secondDate = new Date($("#tglakhir").val());
                var diffDays = Math.round(Math.round((secondDate.getTime()- firstDate.getTime()) / (oneDay) +1));
                $("#selisih").val(diffDays);
            }
        }
    </script>
<!-- ./ Modal TAMBAH Cuti Bersama -->

<!-- Modal EDIT Cuti Bersama -->
    <div id= "modUpdateCB" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"> <i class="fa fa-calendar-plus-o text-primary"></i>  Edit Data Kalender Cuti Bersama</h4>
                </div>
            <form role="form" action="<?=site_url('Hrd/updateCutiBersama')?>" method="POST">
                <div class="modal-body" id="ubahCutiBr">                
                        <div class="box-body" >
                            <input type="hidden" class="form-control" id="idcuti" name="idcuti">
                            <div class="form-group">
                                <label for="uraian">Uraian Cuti</label> <small class="text-danger"> *</small>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="uraian" name="uraian" required>
                                    <div class="input-group-addon">
                                    <i class="fa fa-tags"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="tglmulai" >Mulai Cuti </label> <small class="text-danger"> *</small> 
                                <label for="tglakhir" style="margin-left:115px" >Akhir Cuti </label> <small class="text-danger"> *</small> 
                                <label for="tglakhir" style="margin-left:115px" >Jumlah </label> <small class="text-danger"> *</small> 
                                <div class="form-inline">
                                    <div class="input-group date" id="tgl1">
                                        <input type="text" class="form-control datepicker" name="tglmulaiE"  id="tglmulaiE" readonly placeholder="Tgl.." style="width:150px">
                                        <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                        </div>
                                    </div>
                                    <div class="input-group date" id="tgl2">
                                        <input type="text" class="form-control datepicker" name="tglakhirE" id="tglakhirE" readonly placeholder="Tgl.." style="margin-left:5px;width:150px">
                                        <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                        </div>
                                    </div>
                                    <div class="input-group" style="margin-left:5px">
                                        <input type="text" class="form-control" id="selisihE" name="selisihE" style="width:105px" placeholder="Durasi.." required>
                                        <div class="input-group-addon"> Hari</div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-inline bg-info" id="coret" style="height:40px" >                                
                                <p style="margin-left:15px" > 
                                <!-- Element hanya ditampilkan -->
                                    <input type="text" class="form-control" id="cb" name="cb" readonly data-toggle="tooltip" title="Total Cuti Bersama"  style="margin-right:5px;width:50px"> 
                                    <input type="text" class="form-control bg-green" id="sc" name="sc"  data-toggle="tooltip" title="Total Sisa Cuti"style="margin-right:5px;width:50px"">        
                                    <input type="text" class="form-control bg-aqua" id="cp" name="cp"  data-toggle="tooltip" title="Total Cuti Pribadi"style="width:50px"">        
                                    <input type="text" class="form-control bg-red" id="hasil" name="hasil"  data-toggle="tooltip" title="Hasil"style="width:50px"">
                                <!-- Element untuk disimpan  -->
                                    <input type="text" class="form-control bg-aqua" id="cpbaru" name="cpbaru"  data-toggle="tooltip" title="Total Cuti Pribadi Baru"style="width:50px"">        
                                    <input type="text" class="form-control bg-green" id="scbaru" name="scbaru"  data-toggle="tooltip" title="Total Sisa Cuti Baru"style="width:50px"">        
                                </p>                        
                            </div>
                            <div class="form-inline">
                                <label for="kategori">Kategori Cuti</label> <small class="text-danger"> *</small>
                                <label for="periode" style="margin-left:185px">Periode Tahun Cuti</label> <small class="text-danger"> *</small>
                                    <div class="input-group" style="width:270px">
                                        <select name="kategori" id="kategori" class="form-control" required>
                                            <option value="" selected disabled> Pilih satu ..</option>
                                            <option value="M"> Cuti Muslim</option>
                                            <option value="N"> Cuti Nasrani</option>
                                            <option value="U"> Cuti Umum</option>
                                        </select>
                                    </div>                           
                                    <div class="input-group" style="width:270px;margin-left:5px">
                                        <select name="periode" id="periode" class="form-control" required>
                                            <option value="" selected disabled> Pilih satu ..</option>
                                            <?php 
                                            $thnskrg = gmdate("Y");
                                            for ($x = $thnskrg; $x >= 2018; $x--){
                                                ?>
                                                <option value="<?= $x ?>"><?= $x ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>                           
                            </div>                                                
                        </div><!-- /.box-body -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Tutup</button>
                            <button type="submit" class="btn btn-success btn-edit"><i class="fa fa-check"></i> Update</button>
                        </div>                           
                </div>
            </form>      
            </div>
        </div>
    </div>
    <script src="<?=base_url();?>assets/js/jquery-2.1.1.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        $("#coret").hide();
        // Retrieve Data to Form
        $(document).on("click","#editData", function(){
            var id = $(this).data('id');
            var ket = $(this).data('ket');
            var tglawal = $(this).data('tglawal');
            var tglakhir = $(this).data('tglakhir');
            var tahun = $(this).data('tahun');
            var jmlhari = $(this).data('jmlhari');
            var kategori = $(this).data('kategori');

            $("#ubahCutiBr #idcuti").val(id);
            $("#ubahCutiBr #uraian").val(ket);
            $("#ubahCutiBr #tglmulaiE").val(tglawal);
            $("#ubahCutiBr #tglakhirE").val(tglakhir);
            $("#ubahCutiBr #selisihE").val(jmlhari);
            $("#ubahCutiBr #kategori").val(kategori);
            $("#ubahCutiBr #periode").val(tahun);

            // menampilkan isi jatah cuti
            $.ajax({
                url : '<?=base_url()?>Hrd/cekJatahCt',
                method : 'POST',
                data : {id:id},
                dataType: 'json',
                success: function(response){
                    var leng = response.length;
                    if(leng > 0){
                        // var hak = response[0].ttl_cuti;
                        var cp = response[0].c_pribadi;
                        var sc = response[0].sisa_cuti;
                        var cb = response[0].jml_hari;

                        // $('#total').val(hak);
                        $('#cp').val(cp);
                        $('#sc').val(sc);
                        $('#cb').val(cb);
                    }
                }
            });
        });

        // Untuk Date Picker
        $(function(){
            $('#tgl1').datepicker({
                locale:'id',
                autoclose: true,
                todayHighlight: true,
            });

            $('#tgl2').datepicker({
                useCurrent: false,
                locale:'id',
                autoclose: true,
            });
            $("#tgl1").on('changeDate', function(selected){
                var startDate = new Date(selected.date.valueOf());
                $("#tgl2").datepicker('setStartDate', startDate);
                if($("#tgl1").val() > $("#tgl2").val()){
                    $("#tgl2").val($("#tgl1").val());
                }
            });
            $("#tgl2").on('changeDate', function(){
                hitDef();
                stopLower()
            })
            
        });
        // Menghitung selisih tanggal
        function hitDef(){
            if ( ($("#tglmulaiE").val() != "") && ($("#tglakhirE").val() != "")) {
                var oneDay = 24*60*60*1000; // hours*minutes*seconds*milliseconds
                var firstDate = new Date($("#tglmulaiE").val());
                var secondDate = new Date($("#tglakhirE").val());

                
                var diffDays = Math.round(Math.round((secondDate.getTime()- firstDate.getTime()) / (oneDay) +1));
                var cbasli = document.getElementById('cb').value;
                var cpasli = document.getElementById('cp').value;
                var scasli = document.getElementById('sc').value;
                $("#selisihE").val(diffDays);

                // mengecek perbakdingan
                if(diffDays > cbasli){
                    var hsl = diffDays - parseInt(cbasli);
                    var cpbaru = cpasli - hsl;
                    var scbaru = scasli - hsl;
                    if(!isNaN(hsl)){
                        document.getElementById('hasil').value = hsl;
                        document.getElementById('cpbaru').value = cpbaru;
                        document.getElementById('scbaru').value = scbaru;
                    }
                }else if(diffDays < cbasli){
                    var hsl = parseInt(cbasli) - diffDays;
                    var cpbaru = parseInt(cpasli) + hsl;
                    var scbaru = parseInt(scasli) + hsl;
                    if(!isNaN(hsl)){
                        document.getElementById('hasil').value = hsl;
                        document.getElementById('cpbaru').value = cpbaru;
                        document.getElementById('scbaru').value = scbaru;
                    }
                }
            }
        };

        // Blok jika isi lebih kecil
        function stopLower(){
            var tglakhir = new Date($("#tglakhirE").val());
            var tglawal = new Date($("#tglmulaiE").val());
            if (tglakhir < tglawal){
                // $("#alertInfo").show();
                $('.btn-edit').attr('disabled',true);
                Swal.fire({
                    type: 'error',
                    title: 'Oops...',
                    text: 'Sorry, kurang dari tanggal awal !',
                    // footer: '<a href>Why do I have this issue?</a>'
                });
            }else{
                // $("#alertInfo").hide();
                $('.btn-edit').attr('disabled',false);

            }
        };

        
    </script>
<!-- ./ Modal EDIT Cuti Bersama -->

<!-- Modal EDIT Cuti  -->
    <div id= "modalEditCuti" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"> <i class="fa fa-calendar-plus-o text-primary"></i>  Edit Data Cuti Karyawan</h4>
                </div>
                <form action="<?=site_url('Hrd/updateCutiKar')?>" method="post">
                    <div class="modal-body" id="ubahCutiKar"> 
                        <div id="headModal">
                        </div>                          
                        <div class="box box-danger">
                            <div class="box-body">    
                                <input type="hidden" class="form-control" id="idcuti" name="idcuti">
                                <div class="form-group">
                                    <label for="cutibrs"> Kategori Cuti Bersama</label>
                                    <select name="cutibrs" id="cutibrs" class="form-control" required>
                                        <option selected disabled>Pilih Jenis Cuti..</option>
                                        <?php foreach($rowcutibr as $data){
                                            echo "<option value='".$data['id_cuti']."' >".$data['uraian']."</option>";
                                        }?>
                                    </select>
                                </div>
                                    <!-- <input type="text" name="jmlhari" id="jmlhari" > -->
                                <div class="form-inline bg-info" style="height:60px" id="detailCuti">
                                    <small class="text-danger" style="margin-left:300px">* Edit isian jika melanjutkan jatah cuti lama</small>
                                    <p style="margin-left:15px" >
                                        <input type="text" class="form-control" id="ttlcuti" name="ttlcuti" required readonly data-toggle="tooltip" title="Total Jatah Cuti" style="margin-right:15px;width:100px"> 
                                        <i class="fa fa-minus" style="margin-right:15px"></i>
                                        <input type="text" class="form-control" id="cutiber" name="cutiber" required readonly data-toggle="tooltip" title="Total Cuti Bersama"  style="margin-right:15px;width:100px"> 
                                        <i class="fa fa-arrow-right" style="margin-right:15px"></i>
                                        <input type="number" class="form-control" id="sisact" name="sisact" required  data-toggle="tooltip" title="Total Sisa Cuti"style="margin-right:15px">        
                                        <i class="fa fa-exclamation-triangle text-red" style="margin-right:15px;font-size:15px"></i>                        
                                        <input type="hidden" class="form-control" id="cutipri" name="cutipri" required  data-toggle="tooltip" title="Total Cuti Pribadi"style="margin-right:15px">        
                                    </p>                        
                                </div>
                                <div class="form-group">
                                    <label for="periode"> Tahun Cuti</label>
                                    <select name="periode" id="periode" class="form-control" required>
                                        <option selected disabled> Pilih satu ..</option>
                                        <?php 
                                        $thnskrg = gmdate("Y");
                                        for ($x = $thnskrg; $x >= 2018; $x--){
                                            ?>
                                            <option value="<?= $x ?>"><?= $x ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="perawal" >Periode Awal Cuti </label> <small class="text-danger"> *</small> 
                                    <label for="perawal" style="margin-left:140px" >Periode Akhir Cuti </label> <small class="text-danger"> *</small> 
                                    <div class="form-inline">
                                        <div class="input-group date" id="tgl3" style="margin-right:5px" >
                                            <input type="text" class="form-control datepicker" name="perawal"  id="perawal" style="width:225px" readonly placeholder="Tgl..">
                                            <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                            </div>
                                        </div>
                                        <div class="input-group date" id="tgl4">
                                            <input type="text" class="form-control datepicker" name="perakhir" id="perakhir" style="width:230px" readonly placeholder="Tgl.." >
                                            <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                            </div>
                                        </div>
                                            <small id="alertInfo" class="text-muted text-danger" style="display:none"> Stop !</small>
                                    </div>
                                </div>
                                <div class="form-group" id="aktifasiCuti">
                                    <label for="sts" >Opsi Cuti </label> <small class="text-danger"> *</small> 
                                    <select name="sts" id="sts" class="form-control">
                                        <option selected disabled>Pilih Satu..</option>
                                        <option value="A"> Aktifkan</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Tutup</button>
                        <button type="submit" class="btn btn-success btn-edit"><i class="fa fa-check"></i> Update</button>
                    </div>  
                </form>
            </div>
        </div>
    </div>
    <script src="<?=base_url();?>assets/js/jquery-2.1.1.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        $("#detailCuti").hide();   
        $("#btnEditCuti").on("click",function(){
            $("#aktifasiCuti").hide();
            $("#detailCuti").hide(); 
        })
        $(document).on("click","#editCuti", function(){
            var id = $(this).data('id');
            var ttl = $(this).data('ttl');
            var cb = $(this).data('cb');
            var cp = $(this).data('cp');
            var sc = $(this).data('sc');
            var thn = $(this).data('thn');
            var awl = $(this).data('awl');
            var akr = $(this).data('akr');
            var stt = $(this).data('stt');
            // if($(this).data('status') == "D"){ isist = "Nonaktif";
            // }else if($(this).data('status') == "A"){ isist = "Aktif"};

            $("#ubahCutiKar #idcuti").val(id);
            $("#ubahCutiKar #cutibrs").val(cb);
            $("#ubahCutiKar #ttlcuti").val(ttl);
            $("#ubahCutiKar #cutiber").val(cb);
            $("#ubahCutiKar #sisact").val(sc);
            $("#ubahCutiKar #periode").val(thn);
            $("#ubahCutiKar #perawal").val(awl);
            $("#ubahCutiKar #perakhir").val(akr);
            $("#ubahCutiKar #sts").val(stt);

        });

        $(function(){
            $('#tgl3').datepicker({
                locale:'id',
                autoclose: true,
                todayHighlight: true,
            });

            $('#tgl4').datepicker({
                // useCurrent: false,
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
                blockLower();                
            }) 
        });

        // Blok untuk penghitungan cuti dari select jenis cuti bersama
        $(document).ready(function(){
            $('#cutibrs').change(function(){
                var id_cuti = $(this).val();
                $.ajax({
                    url: '<?=base_url()?>Hrd/cekCutiBrsm',
                    method: 'POST',
                    data: {id_cuti: id_cuti},
                    dataType: 'json',
                    success: function(response){
                        var len = response.length;
                        $('#jmlhari').val('');
                        if(len > 0){
                            // read values
                            var jmlhari = response[0].jml_hari;

                            // $('#jmlhari').val(jmlhari);
                            $('#cutiber').val(jmlhari);
                            var hasil = parseInt(12) - parseInt(jmlhari);
                            $('#sisact').val(hasil);
                            $('#cutipri').val(hasil);
                        }
                    }
                })
            })
        });

        // Blok jika isi lebih kecil
        function blockLower(){
            var tglakhir = new Date($("#perakhir").val());
            var tglawal = new Date($("#perawal").val());
            if (tglakhir < tglawal){
                // $("#alertInfo").show();
                $('.btn-edit').attr('disabled',true);
                Swal.fire({
                    type: 'error',
                    title: 'Oops...',
                    text: 'Sorry, Tanggal kurang dari periode awal !',
                    // footer: '<a href>Why do I have this issue?</a>'
                });
            }else{
                // $("#alertInfo").hide();
                $('.btn-edit').attr('disabled',false);

            }
        };

        $('.tombolEdit').on("click",function(){
            var id = $(this).data('id');
            var email = $(this).data('email');
            var nip = $(this).data('nip');
            var start = $(this).data('start');
            var end = $(this).data('end');
            $("#headModal").html('<div class="box box-danger"><div class="box-body"><p>NIP : '+nip+'</p><p>Email : '+email+'</p><p>Kontrak : '+start+' - '+end+'</p></div></div>');

            $("#aktifasiCuti").hide();
            $("#detailCuti").hide(); 
        });

        $("#btnCutiBaru").on("click",function(){
            $("#detailCuti").show();
            $("#aktifasiCuti").show();
        });
    </script>

<!-- ./ Modal Edit Cuti  -->

<!-- Modal Tambah CUti Baru  -->
    <div id= "modalAddCuti" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"> <i class="fa fa-calendar-plus-o text-primary"></i>  Pengaturan Cuti Baru</h4>
                </div>
                <form action="<?=site_url('Hrd/addCutiBaru')?>" method="post">
                    <div class="modal-body">                        
                        <div class="box box-danger">
                            <div class="box-body">    
                                <div class="form-group">
                                    <label for="nip"> Pilih NIP Karyawan</label> <small class="text-red"> *</small>
                                    <select name="nip" id="nip" class="form-control" required onchange="fill();">
                                        <option selected disabled> Pilih satu ..</option>
                                        <?php 
                                        foreach($rowjtct2 as $data) {
                                            ?>
                                            <option value="<?= $data['nip'] ?>"><?= $data['nip']." - ". $data['email'] ?></option>
                                        <?php } ?>
                                    </select>
                                    <!-- <small id="infoKontrak" class="text-muted text-danger"></small>  -->
                                    <small class="text-muted">* NIP karyawan yang cutinya sudah nonaktif</small>
                                </div>
                                <div class="form-group">
                                    <label for="periode"> Tahun Cuti</label>
                                    <label for="cutibersama" style="margin-left:200px">Cuti Bersama</label>
                                    <div class="form-inline">
                                        <select name="periode" id="periode" class="form-control" style="width:200px;margin-right:5px" required>
                                            <option selected disabled> Pilih satu ..</option>
                                            <?php 
                                            $thnskrg = gmdate("Y");
                                            for ($x = $thnskrg; $x >= 2018; $x--){
                                                ?>
                                                <option value="<?= $x ?>"><?= $x ?></option>
                                            <?php } ?>
                                        </select>
                                        <select name="cutibersama" id="cutibersama" class="form-control" style="width:340px" required>
                                            <option selected disabled>Pilih Jenis Cuti..</option>
                                                <?php foreach($rowcutibr as $data){
                                                    echo "<option value='".$data['id_cuti']."' >".$data['uraian']."</option>";
                                                }?>
                                        </select>
                                    </div>                                       
                                    <small class="text-muted">* Satu periode cuti tahunan jatah 12 hari</small>
                                </div>
                                <div class="form-inline bg-info" style="height:60px;margin-bottom:15px">
                                    <small class="text-danger" style="margin-left:300px">* Edit isian jika melanjutkan jatah cuti lama</small>
                                    <p style="margin-left:15px" >
                                        <input type="text" class="form-control" id="totalct" name="totalct" required readonly data-toggle="tooltip" title="Total Jatah Cuti" style="margin-right:15px;width:100px"> 
                                        <i class="fa fa-minus" style="margin-right:15px"></i>
                                        <input type="text" class="form-control" id="ctber" name="ctber" required readonly data-toggle="tooltip" title="Total Cuti Bersama"  style="margin-right:15px;width:100px"> 
                                        <i class="fa fa-arrow-right" style="margin-right:15px"></i>
                                        <input type="number" class="form-control" id="ssct" name="ssct" required  data-toggle="tooltip" title="Total Sisa Cuti"style="margin-right:15px">        
                                        <i class="fa fa-exclamation-triangle text-red" style="margin-right:15px;font-size:15px"></i>                        
                                        <input type="hidden" class="form-control" id="ctpri" name="ctpri" required readonly data-toggle="tooltip" title="Total Cuti Pribadi"  style="margin-right:15px;width:100px"> 
                                    </p>                        
                                </div>
                                <div class="form-group">
                                    <label for="perawal" >Periode Awal Cuti </label> <small class="text-danger"> *</small> 
                                    <label for="perakhir" style="margin-left:140px" >Periode Akhir Cuti </label> <small class="text-danger"> *</small> 
                                    <div class="form-inline">
                                        <div class="input-group date" id="tgl7" style="margin-right:5px" >
                                            <input type="text" class="form-control datepicker" name="perawal"  id="perawal" style="width:225px" onkeydown="event.preventDefault()" placeholder="Tgl..">
                                            <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                            </div>
                                        </div>
                                        <div class="input-group date" id="tgl8">
                                            <input type="text" class="form-control datepicker" name="perakhir" id="perakhir" style="width:230px" onkeydown="event.preventDefault()" placeholder="Tgl.." >
                                            <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Tutup</button>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-send"></i> Simpan</button>
                    </div>  
                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="<?=base_url();?>assets/js/jquery-2.1.1.min.js"></script>
    <script type="text/javascript">
        $(function(){
            $('#tgl7').datepicker({
                locale:'id',
                autoclose: true,
                todayHighlight: true
            });

            $('#tgl8').datepicker({
                useCurrent: false,
                locale:'id',
                autoclose: true
            });
            $("#tgl7").on('changeDate', function(selected){
                var startDate = new Date(selected.date.valueOf());
                $("#tgl8").datepicker('setStartDate', startDate);
                if($("#tgl7").val() > $("#tgl8").val()){
                    $("#tgl8").val($("#tgl7").val());
                }
            });            
        });

        // Blok untuk penghitungan cuti dari select jenis cuti bersama
        $(document).ready(function(){
            $('#cutibersama').change(function(){
                var id_cuti = $(this).val();
                $.ajax({
                    url: '<?=base_url()?>Hrd/cekCutiBrsm',
                    method: 'POST',
                    data: {id_cuti: id_cuti},
                    dataType: 'json',
                    success: function(response){
                        var len = response.length;
                        // $('#jmlhari').val('');
                        if(len > 0){
                            // read values
                            var jmlhari = response[0].jml_hari;

                            // $('#jmlhari').val(jmlhari);
                            $('#ctber').val(jmlhari);
                            var hasil = parseInt(12) - parseInt(jmlhari);
                            $('#ssct').val(hasil);
                            $('#ctpri').val(hasil);
                        }
                    }
                })
            })
        });

        
        function fill(){
            document.getElementById('totalct').value = 12;           
        }
    </script>
    

<!-- ./ Modal Tambah CUti Baru  -->



