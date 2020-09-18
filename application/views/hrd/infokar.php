<!-- Halaman Detail Karyawan  -->
<!-- ditampilkan hanya untuk anggota HR Departement -->
<!-- ================================================ -->
<script src="<?=base_url();?>assets/js/jquery-2.1.1.min.js" type="text/javascript"></script>
<!-- Breadcumb section -->

<section class="content-header">
    <h1>
        <div class="icon">
        <i class="fa fa-user"></i> Detail Karyawan
        <small>Pusat Informasi HR Department</small>
        </div>        
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>Hrd"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="<?php echo base_url();?>Hrd/karyawan"><i class="fa fa-user"></i> Karyawan</a></li>
        <li class="active"><a href="#"><i class="fa fa-user"></i> Detail Karyawan</a></li>
</section>

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
            Berikut informasi detail <strong><?php foreach($rowkar as $data) echo $data['fullname']; ?></strong> di Bias Mandiri Group
        </div><!-- /.box-body -->
        <!-- <div class="box-footer">
            Footer
        </div>/.box-footer -->
    </div>
<!-- /.box -->

<!-- Flash Data -->
<div class="karyflash" data-flashdata="<?=$this->session->flashdata('flash'); ?>"></div>
<!-- ./ Flash Data -->

<!-- Main Row -->
    <div class="row">
        <!-- left column -->
        <div class="col-md-2">
            <!-- general form elements -->
            <div class="box box-danger">
                <div class="box-header with-border" style="text-align:center">
                    <h3 class="box-title" ><strong><?php foreach($rowkar as $data) echo $data['fullname']; ?></strong></h3>
                </div><!-- /.box-header -->
                <div class="small-box" style="text-align:center">
                <img style="width:150px;height:relative" src="<?php echo base_url();?>uploads/image/<?php foreach($rowkar as $data) echo $data['foto']; ?>" class="img-thumbnail"  alt="User Image" />
                    <a href="#" id="gantifoto" class="small-box-footer" style="color:blue" data-toggle="modal" data-target="#fotoProfile" ><?php foreach($rowkon as $data) echo $data['nip']; ?>
                    <i class="fa fa-arrow-circle-right text-primary"></i>
                    </a>
                </div>
                <div class="box-footer" style="text-align:center">
                    <a href="<?=site_url('Hrd/karyawan') ?>" class="btn btn-info btn-xs"> <i class="fa fa-undo"></i> Kembali</a>
                </div>
            </div><!-- /.box -->
        </div><!-- /.left column -->

        <!-- right column -->
        <div class="col-md-10">
            <!-- general form elements -->
            <div class="box box-danger">
                <div class="acc-kontainer">
                    <!-- Accordion#1  -->
                    <div>
                        <input class="acc-kontainer-input" type="radio" name="acc" id="acc1" checked>
                        <label class="acc-kontainer-label" for="acc1"><i class="fa fa-chevron-circle-right"></i> Data Karyawan </label>
                        <div class="acc-body table-responsive">
                            <div class="pull-left">
                                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editKar"><i class="icon fa fa-edit"></i>  Edit Data</button>
                            </div>
                            <!-- DATA Karyawan -->
                            <table class="table table-borderless">                                
                                <tbody>
                                    <tr>
                                        <td width="170px">Nama</td>
                                        <td width="10px">:</td>
                                        <td><strong><a href="javascript:void(0);" class="custom"><?php foreach($rowkar as $data) echo $data['fullname']; ?></a></strong></td>
                                    </tr>
                                    <tr>
                                        <td >Alamat</td>
                                        <td>:</td>
                                        <td><a href="javascript:void(0);" class="custom"><?php foreach($rowkar as $data) echo $data['alamat']; ?></a></td>
                                    </tr>
                                    <tr>
                                        <td >Handphone</td>
                                        <td>:</td>                                        
                                        <td><a href="javascript:void(0);" class="custom"><?php foreach($rowkar as $data) echo $data['telp']?></a></td> 
                                    </tr>
                                    <tr>
                                        <td >Jenis Kelamin</td>
                                        <td>:</td>
                                        <td><a href="javascript:void(0);" class="custom"><?php foreach($rowkar as $data) if($data['genre'] == "L"){ echo "Laki-Laki";} else echo "Perempuan";  ?></a></td> 
                                    </tr>
                                    <tr>
                                        <td >Tempat, Tgl Lahir</td>
                                        <td>:</td>
                                        <td><a href="javascript:void(0);" class="custom"><?php foreach($rowkar as $data) echo $data['tempat'],", ", date("d F Y",strtotime($data['tgllahir']));  ?></a></td> 
                                    </tr>                                    
                                    <tr>
                                        <td >Status</td>
                                        <td>:</td>
                                        <td><a href="javascript:void(0);" class="custom"><?php foreach($rowkar as $data) if($data['martial'] == "1"){ echo "Menikah";} else echo "Belum Menikah";  ?></a></td>
                                    </tr>
                                    <tr>
                                        <td >Status Keluarga</td>
                                        <td>:</td>
                                        <td><a href="javascript:void(0);" class="custom"><?php foreach($rowkar as $data) echo $data['stat_kel']?></a></td>
                                    </tr>
                                    <tr>
                                        <td >Agama</td>
                                        <td>:</td>
                                        <td><a href="javascript:void(0);" class="custom"><?php foreach($rowkar as $data) echo $data['agama']?></a></td>
                                    </tr>
                                    <tr>
                                        <td >Pendidikan</td>
                                        <td>:</td>
                                        <td><a href="javascript:void(0);" class="custom"><?php foreach($rowkar as $data) echo $data['pendidikan']?></a></td>
                                    </tr>
                                    <tr>
                                        <td >Warga Negara</td>
                                        <td>:</td>
                                        <td><a href="javascript:void(0);" class="custom"><?php foreach($rowkar as $data) echo $data['negara']; ?></a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div><!-- ./ Accordion#1  -->
                    <!-- Accordion#2  -->
                    <div>
                        <input class="acc-kontainer-input" type="radio" name="acc" id="acc2">
                        <label class="acc-kontainer-label" for="acc2"><i class="fa fa-chevron-circle-right"></i> Data Kepegawaian </label>
                        <div class="acc-body table-responsive">
                            <div class="pull-left">
                                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editPeg"><i class="icon fa fa-edit"></i>  Edit Data</button>
                                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#hisPeg"><i class="icon fa fa-info-circle"></i>  Histori Jabatan</button>
                            </div>
                            <!-- DATA Kepegawaian -->
                            <table class="table table-borderless">                                
                                <tbody>
                                    <tr>
                                        <td width="170px" >NIP</td>
                                        <td width="10px">:</td>
                                        <?php //rowkon get join all data from table kontrak?>
                                        <td><a href="javascript:void(0);" class="custom"><strong><?php foreach($rowkon as $data) echo $data['nip']; ?></strong></a></td> 
                                    </tr>
                                    <tr>
                                        <td>Nama</td>
                                        <td>:</td>
                                        <td><a href="javascript:void(0);" class="custom"><?php foreach($rowkar as $data) echo $data['fullname']; ?></a></td>
                                    </tr>
                                    <tr>
                                        <td >Level Jabatan</td>
                                        <td>:</td>
                                        <td><a href="javascript:void(0);" class="custom"><?php foreach($rowkar as $data) echo $data['nama_jab']; ?></a></td>
                                    </tr>
                                    <tr>
                                        <td >Jabatan Definitif</td>
                                        <td>:</td>
                                        <td><a href="javascript:void(0);" class="custom"><?php foreach($rowkar as $data) echo $data['nama_jail']; ?></a></td>
                                    </tr>
                                    <tr>
                                        <td >Status Pegawai</td>
                                        <td>:</td>                                        
                                        <td ><a href="javascript:void(0);" class="custom"><?php foreach($rowkar as $data) if($data['stat_kar'] == "T") echo "Tetap"; else echo "Kontrak"; ?></a> </td> 
                                    </tr>
                                    <tr>
                                        <td >Tanggal Bergabung</td>
                                        <td>:</td>
                                        <?php //rowjoin get join date from table kontrak?>
                                        <td><a href="javascript:void(0);" class="custom"><?php foreach($rowkar as $data) echo date("d F Y",strtotime($data['join_date'])); ?></a> <a href="" data-toggle="modal" data-target="#editJoinDate" id="updateJoin" data-id="<?= $data['id_kar']?>"><i class="fa fa-calendar"></i></a></td> 
                                    </tr>
                                    <tr>
                                        <td >SBU</td>
                                        <td>:</td>
                                        <td><a href="javascript:void(0);" class="custom"><?php foreach($rowkar as $data) echo $data['nama']; ?></a></td>
                                    </tr>
                                    <tr>
                                        <td >Sub Unit</td>
                                        <td>:</td>
                                        <td><a href="javascript:void(0);" class="custom"><?php foreach($rowkar as $data) echo $data['namasub']; ?></a></td>
                                    </tr>
                                    <tr>
                                        <td >Departemen</td>
                                        <td>:</td>
                                        <td><a href="javascript:void(0);" class="custom"><?php foreach($rowkar as $data) echo $data['nama_dept']; ?></a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div><!-- ./ Accordion#2  -->
                    <!-- Accordion#3  -->
                    <?php foreach($rowkar as $data) if($data['stat_kar'] != "T" ){ //jika status karyawan Kontrak tampilkan TAB KONTAK?> 
                    <div>
                        <input class="acc-kontainer-input" type="radio" name="acc" id="acc3">
                        <label class="acc-kontainer-label" for="acc3"><i class="fa fa-chevron-circle-right"></i> Kontrak Kerja </label>
                        <div class="acc-body table-responsive">
                            <div class="pull-left">
                                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editKon"><i class="icon fa fa-edit"></i>  Edit Kontrak</button>
                                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#histKon"><i class="icon fa fa-info-circle"></i>  Histori Kontrak</button>
                            </div>
                            <table class="table table-borderless">                                
                                <tbody>
                                    <tr>
                                        <td width="120px" >PKWT</td>
                                        <td width="10px">:</td>
                                        <td><a href="javascript:void(0);" class="custom"> Ke - <?php foreach($rowkon as $data) echo $data['periodepkwt']; ?></a></td> 
                                    </tr>                                    
                                    <tr>
                                        <td >Status PKWT</td>
                                        <td>:</td>
                                        <td><a href="javascript:void(0);" class="custom"><?php foreach ($rowkon  as $data) if($data['kontrak'] == "N") echo "BARU"; elseif($data['kontrak'] == "R") echo "PERPANJANGAN"; elseif($data['kontrak'] == "P") echo "TETAP"; else echo "FINISH"; ?></a></td> 
                                    </tr>
                                    <tr>
                                        <td>Durasi Kontrak </td></td>
                                        <td>:</td>
                                        <td><a href="javascript:void(0);" class="custom"><?php foreach($rowkon as $data) echo $data['durasi']; ?> Bulan</a></td>
                                    </tr>
                                    <tr>
                                        <td >Dari Tgl.</td>                                        
                                        <td>:</td>
                                        <td style="width:200px"><a href="javascript:void(0);" class="custom"><?php foreach($rowkon as $data) if(($data['start'] == "NULL") || ($data['start'] == "0000-00-00")) echo "-"; else echo date("d F Y",strtotime($data['start'])); ?></a></td>
                                        <td style="width:30px">s/d</td>
                                        <td style="width:150px" >Sampai Tgl.</td>                                        
                                        <td style="width:10px">:</td>
                                        <td style="width:200px"><a href="javascript:void(0);" class="custom"><?php foreach($rowkon as $data) if(($data['end'] == "NULL") || ($data['end'] == "0000-00-00")) echo "-"; else echo date("d F Y",strtotime($data['end'])); ?></a></td>
                                    </tr>
                                    <tr>
                                        <td >SBU</td>
                                        <td>:</td>
                                        <td><a href="javascript:void(0);" class="custom"><?php foreach($rowkar as $data) echo $data['kode']; ?></a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div><!-- ./ Accordion#3  -->
                    <?php } ?>
                    <!-- Accordion#4  -->
                    <div>
                        <input class="acc-kontainer-input" type="radio" name="acc" id="acc4">
                        <label class="acc-kontainer-label" for="acc4"><i class="fa fa-chevron-circle-right"></i> Dokumen Kepegawaian </label>
                        <div class="acc-body table-responsive">
                            <div class="pull-left">
                                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#uploadDoc"><i class="icon fa fa-edit"></i>  Upload Dokumen</button>
                            </div>
                            <table class="table table-borderless">   
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>No Dokumen</th>
                                        <th>Jenis Dokumen</th>                                        
                                        <th>Nama Dokumen</th>                                        
                                        <th>Total Hal.</th>                                        
                                    </tr>
                                </thead>
                                <tbody>
                                <?php $no = 1;
                                foreach ($rowdok as $data) { ?>
                                    <tr>
                                        <td><?=$no++;?> <a href="<?=site_url('HRD/docKary/').encrypt_url($data['id_doc'])?>" class="pull-right" data-tooltip="tooltip" title="Detail"><i class="fa fa-question-circle"></i></a></td>
                                        <td><a href="javascript:void(0);" class="custom"><?=$data['nodoc'] ?></a></td>
                                        <td><?=$data['typedoc'] ?></td>
                                        <td><?=$data['namadoc'] ?></td>
                                        <td><?=$data['halaman'] ?></td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div><!-- ./ Accordion#4  -->
                </div>
            </div>
        </div>
    </div><!-- ./ Main Row -->   

</section> 

<!-- Edit Data Karyawan -->
    <div id= "editKar" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><i class="icon fa fa-edit text-blue"></i>  Edit Data Karyawan</h4>
                </div>
                <?php foreach($rowkar as $data) echo form_open_multipart('Hrd/updateKar/'.encrypt_url($data['id_kar'])); ?>
                <div class="modal-body">
                    <div class="box box-primary">
                        <div class="box-body">
                            <div class="form-group">
                                <input type="hidden" class="form-control" name="idpri" value="<?php foreach($rowkar as $data) echo $data['id_kar']; ?>" > 
                                <label for="nama">Nama Lengkap</label><small class="text-danger"> *</small>  
                                <div class="input-group"> 
                                    <input type="text" class="form-control" name="fullname" value="<?php foreach($rowkar as $data) echo $data['fullname']; ?>" required placeholder="Nama Lengkap.." required> 
                                    <div class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                    </div>
                                </div><!-- /.input group -->
                                <input type="hidden" name="nickname" value="<?php foreach($rowkar as $data) echo $data['nickname']; ?>">
                            </div>
                            <div class="form-group" style="margin-top:15px">
                                <label for="alamat">Alamat</label><small class="text-danger"> *</small>  
                                <div class="input-group">
                                    <input type="text" class="form-control" name="alamat" value="<?php foreach($rowkar as $data) echo $data['alamat']; ?>" required placeholder="Alamat.." required>
                                    <!-- <input type="text" class="form-control" name="alamat" required>  -->
                                    <div class="input-group-addon">
                                        <i class="fa fa-map-marker"></i>
                                    </div>
                                </div><!-- /.input group -->
                            </div>
                            <div class="form-group">
                                <label for="tempat">Tempat Lahir</label> <small class="text-danger">*</small>
                                <label for="tgllahir" style="margin-left:60px">Tanggal Lahir</label> <small class="text-danger">*</small>
                                <label for="negara" style="margin-left:55px">Warga Negara</label><small class="text-danger"> *</small> 
                                <div class="form-inline">                                                                      
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="tempat" name="tempat" value="<?php foreach($rowkar as $data) echo $data['tempat']; ?>" placeholder="Tempat Lahir.." style="width:115px" required>
                                        <div class="input-group-addon">
                                        <i class="fa fa-globe"></i>
                                        </div>
                                    </div>
                                    <div class="form-group" id="sandbox-tanggal"  style="margin-left:5px">
                                        <div class="input-group date" id="tgllahir" >
                                            <input type="text" class="form-control datepicker" name="tgllahir"  id="tgllahir" value="<?php foreach($rowkar as $data) echo date('d-m-Y', strtotime($data['tgllahir'])); ?>" readonly placeholder="Tgl Lahir.." style="width:110px">
                                            <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="input-group"> 
                                        <input type="text" class="form-control" name="negara" id="negara" value="<?php foreach($rowkar as $data) echo $data['negara']; ?>" placeholder="Warga Negara" style="width:190px; margin-left:5px"  required> 
                                        <div class="input-group-addon">
                                            <i class="fa fa-globe"></i>
                                        </div>
                                    </div><!-- /.input group --> 
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="genre">Jenis Kelamin</label>
                                <label style="margin-left:55px" for="status">Status </label>
                                <label for="keluarga" style="margin-left: 115px">Keluarga</label><small class="text-danger"> *</small> 
                                <div class="form-inline">
                                    <select class="form-control" style="width:150px" name="genre" id="genre">
                                        <?php  foreach($rowkar as $data)
                                            if($data['genre'] == "L"){
                                            echo "<option value='L' selected>Laki - Laki</option> <option value='P'>Perempuan</option>";
                                        }else echo "<option value='P' selected>Perempuan</option> <option value='L'>Laki - Laki</option>";  ?>
                                    </select>
                                    <select class="form-control" style="width:150px; margin-left:5px" name="status" id="status" required>
                                    <?php foreach($rowkar as $data)
                                        if($data['martial'] == "1"){
                                    echo "<option value='1' selected>Menikah</option> <option value='2'>Belum Menikah</option>";
                                    } else echo "<option value='2' selected>Belum Menikah</option> <option value='1'>Menikah</option>";?>
                                    </select>
                                    <select class="form-control" style="width:230px; margin-left:5px" name="keluarga" id="keluarga">
                                        <option selected disabled class="bg-red"><?php foreach($rowkar as $data) echo $data['stat_kel'] ?></option>
                                        <option value="TK">TK</option>
                                        <option value="K0">K0</option>
                                        <option value="K1">K1</option>
                                        <option value="K2">K2</option>
                                        <option value="K3">K3</option>
                                        <option value="K4">K4</option>
                                        <option value="K5">K5</option>
                                    </select>
                                </div>                                
                            </div>
                            <div class="form-group">
                                <label for="pendidikan">Pendidikan</label><small class="text-danger"> *</small> 
                                <label for="agama" style="margin-left: 65px">Agama</label><small class="text-danger"> *</small> 
                                <label for="telp" style="margin-left: 115px">No Telp.</label><small class="text-danger"> *</small> 
                                <div class="form-inline">
                                    <select class="form-control" style="width:150px" name="pendidikan" id="pendidikan">
                                        <option selected disabled class="bg-red"><?php foreach($rowkar as $data) echo $data['pendidikan'] ?></option>
                                        <?php foreach($rowedu as $data){ ?>
                                        <option value="<?=$data['kode_edu']?>"><?=$data['kode_edu']?></option>
                                        <?php } ?>
                                    </select> 
                                    <select class="form-control" name="agama" id="agama" style="width:150px; margin-left:5px" required>                                        
                                        <option selected class="bg-red"><?php foreach($rowkar as $data) echo $data['agama'] ?></option>
                                        <option value="Islam" >Islam</option>
                                        <option value="Katolik" >Katolik</option>
                                        <option value="Protestan" >Protestan</option>
                                        <option value="Budha" >Budha</option>
                                        <option value="Hindu" >Hindu</option>
                                        <option value="Lainnya" >Lainnya</option>
                                    </select>
                                    <div class="input-group"> 
                                        <input type="number" class="form-control" name="telp" value="<?php foreach($rowkar as $data) echo $data['telp']; ?>" style="width:195px; margin-left:5px" placeholder="No Telp.."> 
                                        <div class="input-group-addon">
                                            <i class="fa fa-phone"></i>
                                        </div>
                                    </div><!-- /.input group -->
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label for="foto">Foto</label>
                                        <div class="small-box" style="text-align:center;border:1px;padding:1px">
                                            <img src="<?php echo base_url();?>uploads/image/<?php foreach($rowkar as $data) echo $data['foto']; ?>" class="img-thumbnail" alt="User Image" style="height:260px; border:0" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label for="filefoto">Ganti Foto</label>
                                        <input type="file" name="filefoto" class="dropify" data-height="250">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-default pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Tutup</button>
                    <button type="submit" name="update" class="btn btn-success"><i class="fa fa-check"></i> Update</button>
                </div>
                <?php echo form_close() ?>
            </div>
        </div>
    </div>
<!-- ./ Edit Data Karyawan -->

<!-- Edit Data Kepegawaian -->
    <div id= "editPeg" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><i class="icon fa fa-edit text-blue"></i>  Edit Data Kepegawaian</h4>
                </div>
                <?php  foreach($rowkar as $data) echo form_open_multipart('Hrd/updatePeg/'.encrypt_url($data['id_kar'])); ?>
                <div class="modal-body">
                    <div class="box box-primary">
                        <div class="box-body">
                            <div class="form-group">
                                <input type="hidden" class="form-control" name="idpri" value="<?php foreach($rowkar as $data) echo $data['id_kar']; ?>" > 
                                <label for="nip">NIP</label><small class="text-danger"> *</small>  
                                <div class="input-group"> 
                                    <input type="text" class="form-control" name="nip" value="<?php foreach($rowkon as $data) echo $data['nip']; ?>" readonly> 
                                    <div class="input-group-addon">
                                        <i class="fa fa-barcode"></i>
                                    </div>
                                </div><!-- /.input group -->
                            </div>
                            <div class="form-group">
                                <label for="level">Level Jabatan</label><small class="text-danger"> * <sup><em> Tukar isi untuk menampilkan data berikutnya</em> </sup></small> 
                                <div class="input-group"> 
                                    <select class="form-control" name="level" id="level" required>
                                        <?php foreach ($rowkar as $data) ?>
                                        <option selected value="<?=$data['id_jab']?>"  style="background:#8bd9df"><?= $data['nama_jab'] ?></option>
                                        <?php foreach ($rowjab as $data) { ?>
                                            <option value="<?=$data['id_jab']?>"><?=$data['nama_jab']?></option>
                                            <?php } ?>
                                    </select>
                                    <div class="input-group-addon bg-blue">
                                        <i class="fa fa-tag"></i>
                                    </div>
                                </div><!-- /.input group -->
                            </div>
                            <div class="form-group" style="margin-top:15px">
                                <label for="dejab">Jabatan Definitif </label><small class="text-danger"> *</small> 
                                <div class="input-group"> 
                                    <select class="dejab form-control" name="dejab" id="dejab" required>
                                        <?php foreach ($rowkar as $data) { ?>
                                        <option selected value="<?= $data['kode_jail'] ?>" ><?= $data['nama_jail'] ?></option>
                                        <?php } ?>
                                    </select>
                                    <div class="input-group-addon">
                                        <i class="fa fa-tag"></i>
                                    </div>
                                </div>
                                <small class="text-muted" id="text_jab"><a href="<?=site_url('Hrd/jabatan')?>">Klik disini jika data kosong/tidak ada</a></small>
                            </div>
                            <div class="form-group" style="margin-top:15px">
                                <label for="grup">Grup Perusahaan</label><small class="text-danger"> * <sup><em> Tukar isi untuk menampilkan data berikutnya</em> </></small> 
                                <div class="input-group"> 
                                    <select class="form-control" name="grup" id="grup" required>
                                        <?php foreach ($rowkar as $data) { 
                                            echo "<option value=$data[id_grup] class='label-danger'>$data[kode_grup]</option>"; 
                                            } 
                                        ?>
                                        <?php foreach($rowgrup as $data){ ?>
                                        <option value="<?= $data['id_grup'] ?>"><?= $data['kode_grup'] ?></option>
                                        <?php } ?>
                                    </select>
                                    <div class="input-group-addon bg-blue">
                                        <i class="fa fa-tag"></i>
                                    </div>
                                </div>
                            </div>   
                            <div class="form-group" style="margin-top:15px">
                                <label for="sbu">SBU</label><small class="text-danger"> *</small> 
                                <div class="input-group"> 
                                    <select class="sbu form-control" name="sbu" id="sbu" required>
                                        <?php foreach ($rowkar as $data) { ?>
                                        <option selected><?= $data['kode'] ?></option>
                                        <?php } ?>
                                    </select>
                                    <div class="input-group-addon">
                                        <i class="fa fa-tag"></i>
                                    </div>
                                </div>
                            </div> 
                            <div class="form-group" style="margin-top:15px">
                                <label for="subUnit">Sub Unit</label><small class="text-danger"> * <sup id="text_sub2"><em> Tukar isi untuk menampilkan data berikutnya</em> </sup></small> 
                                <div class="input-group"> 
                                    <select class="subUnit form-control" name="subUnit" id="subUnit" required>
                                        <?php foreach ($rowkar as $data) { ?>
                                        <option selected value="<?=$data['id_sub']?>"><?= $data['sub'] ?></option>
                                        <?php } ?>
                                    </select>
                                    <div class="input-group-addon">
                                        <i class="fa fa-tag"></i>
                                    </div>
                                </div>
                                <small class="text-muted" id="text_sub"><a href="<?=site_url('Hrd/sbu')?>">Klik disini jika data kosong/tidak ada</a></small>
                            </div> 
                            <div class="form-group" style="margin-top:15px">
                                <label for="departemen">Departemen</label><small class="text-danger"> *</small> 
                                <div class="input-group"> 
                                    <select class="departemen form-control" name="departemen" id="departemen" required>
                                        <?php foreach ($rowkar as $data) { ?>
                                        <option selected value="<?=$data['id_dept']?>"><?= $data['nama_dept'] ?></option>
                                        <?php } ?>
                                    </select>
                                    <div class="input-group-addon">
                                        <i class="fa fa-tag"></i>
                                    </div>
                                </div>
                                <small class="text-muted" id="text_dept"><a href="<?=site_url('Hrd/departemen')?>">Klik disini jika data kosong/tidak ada</a></small>
                            </div> 
                        </div> <!-- ./ box body -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-default pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Tutup</button>
                    <button type="submit" name="update" class="btn btn-success"><i class="fa fa-check"></i> Update</button>
                </div>
                <?php echo form_close() ?>
            </div>
        </div>
    </div>
    <!-- <script src="<?php echo base_url(); ?>assets/js/jquery-2.2.3.min.js"></script> -->
    <script>
    // LINK GRUP to SBU
        $(document).ready(function(){
            $("#grup").change(function(){
                var id = $(this).val();
                $.ajax({
                    url : "<?php echo base_url();?>index.php/Hrd/cariSbu",
                    method : "POST",
                    data : {id: id},
                    async : false,
                    dataType : 'json',
                    success : function(data){
                        var html = '<option selected disabled>Pilih Satu..</option>';
                        var i;
                        for(i=0; i<data.length; i++){
                            html += '<option value='+data[i].kode+'>'+data[i].nama+'</option>';
                        }
                        $('.sbu').html(html);
                    }
                });
            });
        });

    // link select bar dari SBU ke SUb UNIT
        $(document).ready(function(){            
            $('#text_sub').hide();
            $('#text_sub2').hide();
            $('#sbu').change(function(){
                var id = $(this).val();
                $.ajax({
                    url : "<?php echo base_url();?>index.php/Hrd/subUnit",
                    method : "POST",
                    data : {id: id},
                    async : false,
                    dataType : 'json',
                    success : function(data){
                        var html = '<option selected disabled>Pilih Satu..</option>';
                        var i;
                        for(i=0; i<data.length; i++){
                            html += '<option value='+data[i].id_sub+'>'+data[i].sub+'</option>';
                        }
                        $('.subUnit').html(html);
                        $('#text_sub').show();
                        $('#text_sub2').show();
                    }
                });
            });
        });

        // link select bar dari Sub Unit  ke Departemen
        $(document).ready(function(){
            $('#text_dept').hide();
            $('#subUnit').change(function(){
                var id = $(this).val();
                $.ajax({
                    url : "<?php echo base_url();?>index.php/Hrd/getDept",
                    method : "POST",
                    data : {id: id},
                    async : false,
                    dataType : 'json',
                    success : function(data){
                        var html = '<option selected>Pilih Satu..</option>';
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
                        var html = '<option selected disabled>Pilih Satu..</option>';
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
        
    </script>
<!-- ./ Edit Data Kepegawaian -->

<!-- Get Data History Kepegawaian Jabatan dan SBU -->
    <div id= "hisPeg" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><i class="icon fa fa-info-circle text-blue"></i>  Histori Kepegawaian </h4>
                </div>
                <div class="modal-body">
                    <div class="box box-primary">
                        <div class="box-body">
                            <div class="acc-body table-responsive">
                                <table id="tablehistory" class="table table-borderless">   
                                    <thead>
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>Jabatan</th>
                                            <th>Jabatan Definitif</th>                                        
                                            <th>SBU</th>                                        
                                            <th>Sub Unit</th> 
                                            <th>Dept</th>                                       
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php $no = 1;
                                    foreach($rowhispeg as $data) { ?>
                                    <tr>
                                        <!-- <td><?=$no++; ?></td> -->
                                        <td><?=date("d M Y",strtotime ($data['tgl'])); ?> </td>
                                        <td><?= $data['nama_jab']?> </td>
                                        <td><?= $data['nama_jail']?> </td>
                                        <td><?= $data['sbu']?> </td>                                    
                                        <td><?= $data['sub']?> </td>  
                                        <td><?= $data['kode_dept']?></td>                                  
                                    </tr>
                                    <?php }?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-default pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Tutup</button>
                </div>
            </div>
        </div>
    </div>
<!-- ./ Get Data History Kepegawaian Jabatan dan SBU -->

<!-- Edit Data Kontrak kerja -->
    <div id= "editKon" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><i class="icon fa fa-edit text-blue"></i>  Edit Data Kontrak Kerja</h4>
                </div>
                <?php  foreach($rowkar as $data) echo form_open_multipart('Hrd/updateKon/'.encrypt_url($data['email'])); ?>
                <div class="modal-body">
                    <div class="box box-primary">
                        <div class="box-body">
                            <div class="form-group">
                                <input type="hidden" class="form-control" name="idpri" value="<?php foreach($rowkar as $data) echo $data['id_kar']; ?>" > 
                                <input type="hidden" class="form-control" name="email" value="<?php foreach($rowkar as $data) echo $data['email']; ?>" > 
                                <input type="hidden" class="form-control" name="nip" value="<?php foreach($rowkon as $data) echo $data['nip']; ?>" > 
                            </div>
                            <div class="form-group" style="margin-top:15px">
                                <label for="pkwt">Periode PKWT </label><small class="text-danger"> *</small> 
                                <div class="input-group"> 
                                    <select class="form-control" name="pkwt" id="pkwt" required>
                                        <?php foreach ($rowkon as $data) { ?>
                                        <!-- <option value="<?=$data['periodepkwt']  ?>" selected disabled>Ke - <?=$data['periodepkwt']?></option> -->
                                        <?php if($data['periodepkwt'] == "I") echo "<option value='II'>Ke - II</option>"; else if($data['periodepkwt']=="")echo "<option value='I'>Ke - I</option>"; } ?>                                        
                                    </select>
                                    <div class="input-group-addon">
                                        <i class="fa fa-tag"></i>
                                    </div>
                                </div><!-- /.input group -->
                            </div>
                            <div class="form-group" style="margin-top:15px">
                                <label for="statpkwt">Status PKWT </label><small class="text-danger"> *</small> 
                                <div class="input-group"> 
                                    <select class="form-control" name="statpkwt" id="statpkwt" required>
                                        <?php foreach ($rowkon as $data) { ?>
                                        <option selected value="<?= $data['kontrak'] ?>" ><?= $data['kontrak'] == "N" ?  "Baru" : "Perpanjangan"  ?></option>
                                        <?php if($data['kontrak'] == "N") echo "<option value='R'>Perpanjangan</option>";} ?>
                                    </select>
                                    <div class="input-group-addon">
                                        <i class="fa fa-tag"></i>
                                    </div>
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
                                        <input type="text" class="form-control" id="selisih" name="selisih" style="width:95px" placeholder="Durasi.." value="<?php foreach ($rowkon as $data) echo $data['durasi']; ?>" readonly required>
                                        <div class="input-group-addon"> Bulan</div>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- ./ box body -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-default pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Tutup</button>
                    <button type="submit" name="update" class="btn btn-success" <?php if($data['periodepkwt']== 'II' ) { ?> disabled <?php } ?> ><i class="fa fa-check"></i> Update</button>
                </div>
                <?php echo form_close() ?>
            </div>
        </div>
    </div>
    <script src="<?php echo base_url(); ?>assets/js/jquery-2.2.3.min.js"></script>
    <script>
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
                        var html = '';
                        var i;
                        for(i=0; i<data.length; i++){
                            html += '<option value='+data[i].sub+'>'+data[i].sub+'</option>';
                        }
                        $('.subunit').html(html);
                        $('#text_sub').show();
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
                        var html = '';
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

            $('#selisih').val(Math.round(timeDiff/(86400)/30));
        }
    </script>
<!-- ./ Edit Data Kontrak Kerja -->

<!-- Get Data History Kontrak kerja -->
    <div id= "histKon" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><i class="icon fa fa-info-circle text-blue"></i>  Histori Kontrak Kerja</h4>
                </div>
                <div class="modal-body">
                    <div class="box box-primary">
                        <div class="box-body">
                            <div class="acc-body table-responsive">
                                <table class="table table-borderless">   
                                    <thead>
                                        <tr>
                                            <th>PKWT</th>
                                            <th>Awal Kontrak</th>
                                            <th>Akhir Kontrak</th>                                        
                                            <th>Durasi Kontrak</th>                                        
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php $no = 1;
                                    foreach($rowhiskon as $data) { ?>
                                    <tr>
                                        <!-- <td><?=$no++; ?></td> -->
                                        <td><?="Ke - ".$data['pkwt']?> </td>
                                        <td><?=date("d F Y",strtotime ($data['awal']));?> </td>
                                        <td><?=date("d F Y",strtotime ($data['akhir']));?> </td>
                                        <td><?=$data['durasi']?> Bulan </td>                                    
                                    </tr>
                                    <?php }?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-default pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Tutup</button>
                </div>
            </div>
        </div>
    </div>
<!-- ./ Get Data History Kontrak kerja -->


<!-- Add Document  -->
    <div id= "uploadDoc" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><i class="icon fa fa-plus-square text-blue"></i>  Upload Dokumen</h4>
                </div>
                <div class="modal-body">
                <?php echo form_open_multipart('Hrd/addPegDoc') ?>
                    <div class="box box-primary">
                        <div class="form-group">
                            <label for="nodoc">Nomor Dokumen</label>
                            <div class="input-group"> 
                                <input type="hidden" class="form-control" name="idkar" id="idkar" value="<?php foreach($rowkar as $data) echo $data['id_kar']; ?>">
                                <!-- <input type="hidden" class="form-control" name="tgl" id="tgl" value="<?php echo gmdate("Y-m-d", time()+60*60*7); ?>"> -->
                                <input type="text" class="form-control" name="nodoc" id="nodoc" placeholder="Nomor Dokumen.." onkeyup="this.value = this.value.toUpperCase()" required>
                                <div class="input-group-addon bg-blue">
                                    <i class="fa fa-barcode"></i>
                                </div>
                            </div><!-- /.input group -->
                        </div>
                        <div class="form-group">
                            <label for="namadoc"> Nama Dokumen</label>
                            <div class="input-group"> 
                                <input type="text" class="form-control" name="namadoc" id="namadoc" placeholder="Nama Dokumen.." onkeyup="this.value = this.value.toUpperCase()" required>
                                <div class="input-group-addon bg-blue">
                                    <i class="fa fa-star-o"></i>
                                </div>
                            </div><!-- /.input group -->
                            </div>
                        <div class="form-group">
                            <label for="jenisdoc"> Jenis Dokumen</label>
                            <label for="lampiran" style="margin-left:355px" > Lampiran</label>
                            <div class="form-inline">
                                <div class="input-group"> 
                                    <input type="text" class="form-control" name="jenisdoc" id="jenisdoc" placeholder="Jenis Dokumen.." style="width:405px" onkeyup="this.value = this.value.toUpperCase()" required>
                                    <div class="input-group-addon">
                                        <i class="fa fa-file-pdf-o text-red"></i>
                                    </div>
                                </div><!-- /.input group -->
                                <div class="input-group"> 
                                    <input type="number" class="form-control" name="lampiran" id="lampiran" style="width:80px;margin-left:5px" required>
                                    <div class="input-group-addon bg-blue">
                                        <i class="fa fa-star-o"></i>
                                    </div>
                                </div><!-- /.input group -->
                            </div>                            
                        </div>
                        <div class="form-group">
                            <label for="filedoc"> Upload Dokumen</label>
                            <div class="input-group"> 
                                <div class="input-group-addon"> 
                                    <input type="file" name="filedoc" id="filedoc" onchange="return validasiFile()" required> 
                                </div>
                            </div><!-- /.input group --> 
                            <small id="text-pdf" class="text-muted text-red" style="font-style:italic"> Format file harus .pdf !!!</small>
                            <small id="text-pdf-success" class="text-muted text-green" style="font-style:italic"> Format file sesuai !!!</small>
                        </div>
                    </div>
                    <div class="form-group" id="pratinjauGambar"></div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-default pull-left" data-dismiss="modal" onclick="location.reload()" ><i class="fa fa-times"></i> Tutup</button>
                        <button type="submit" name="simpan" class="btn btn-primary"><i class="fa fa-send"></i> Simpan</button>
                    </div>
                <?php echo form_close() ?>
                </div>
            </div>
        </div>
    </div>
    <script>
        $("#text-pdf").hide();
        $("#text-pdf-success").hide();
        function validasiFile(){
            // $("#loaderIcon").show();
        var inputFile = document.getElementById('filedoc');
        var pathFile = inputFile.value;
        // var ekstensiOk = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
        var ekstensiOk = /(\.pdf)$/i;
        if(!ekstensiOk.exec(pathFile)){
            // alert('Silakan upload file yang memiliki ekstensi .pdf');
            // $("#loaderIcon").hide();
            $("#text-pdf").show();
            inputFile.value = '';
            return false;
        }else{
            //Pratinjau gambar
            if (inputFile.files && inputFile.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                            // document.getElementById('pratinjauGambar').innerHTML = '<img src="'+e.target.result+'"/>';
                            document.getElementById('pratinjauGambar').innerHTML = '<embed src="'+e.target.result+'" type="application/pdf" width ="100%" height = "300px"/>';
                        };
                        reader.readAsDataURL(inputFile.files[0]);
                    }
                $("#text-pdf").hide();
                $("#text-pdf-success").show();
            }
    }
    </script>
<!-- ./ Add Document  -->

<!-- Modal Edit Join Date -->
    <div id= "editJoinDate" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><i class="icon fa fa-edit text-blue" style="margin-right:10px"></i> Edit Tanggal Bergabung </h4>
                </div>
                <form action="<?=site_url('Hrd/updateJoinDate') ?>" method="post">
                    <div class="modal-body">
                        <div class="box box-primary">
                            <div class="form-group">
                                <input type="hidden" class="form-control" name="idKar" value="<?php foreach($rowkar as $data) echo $data['id_kar']; ?>" > 
                                <label for="nip">NIP</label><small class="text-danger"> *</small>  
                                <div class="input-group"> 
                                    <input type="text" class="form-control" name="nip" value="<?php foreach($rowkon as $data) echo $data['nip']; ?>" readonly> 
                                    <div class="input-group-addon">
                                        <i class="fa fa-barcode"></i>
                                    </div>
                                </div><!-- /.input group -->
                            </div>
                            <div class="form-group" id="sandbox-tanggal" >
                                <label for="tglJoin"> Tanggal Bergabung</label>
                                <div class="input-group date" >
                                    <input type="text" class="form-control datepicker" name="tglJoin"  id="tglJoin" value="<?php foreach($rowkar as $data) echo date('d-m-Y', strtotime($data['join_date'])); ?>" readonly placeholder="Tgl Bergabung..">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                </div>
                            </div>                                                
                        </diV>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-default pull-left" data-dismiss="modal" onclick="location.reload()" ><i class="fa fa-times"></i> Tutup</button>
                        <button type="submit" name="simpan" class="btn btn-primary"><i class="fa fa-send"></i> Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<!-- /. Modal Edit Join Date -->
