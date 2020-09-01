<section class="content-header">
    <h1>
        <div class="icon">
        <i class="fa fa-user"></i> Data Pribadi
        <!-- <small>semua berawal dari sini</small> -->
        </div>        
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>Dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"><a href="<?php echo base_url();?>C_Personal/data_pri"><i class="fa fa-user"></i> Pribadi</a></li>

</section>

<!-- Main content -->
<section class="content">
<!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Hi! <b><?= $this->fungsi->user_login()->nickname ?></b> Selamat Datang</h3> 
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
            </div>
        </div>
        <div class="box-body">
            Berikut ini informasi data pribadi kamu.
        </div><!-- /.box-body -->
        <!-- <div class="box-footer">
            Footer
        </div>/.box-footer -->
    </div>
<!-- /.box -->

<!--  Flash Data -->
<div class="privflash" data-flashdata="<?=$this->session->flashdata('flash'); ?>"></div> <!-- Swal pengajuan -->
<?php if($this->session->flashdata('flashdoc')) : ?>
    <div class="alert alert-success alert-dismissable" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon fa fa-check"></i> Alert!</h4>
        Dokumen pribadi <strong>berhasil</strong> <?= $this->session->flashdata('flashdoc'); ?>
    </div>
<?php endif; ?>
<?php if($this->session->flashdata('flash_old')) : ?>
    <div class="alert alert-success alert-dismissable" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon fa fa-check"></i> Alert!</h4>
        Profil user <strong>berhasil</strong> <?= $this->session->flashdata('flash'); ?>
    </div>
<?php endif; ?>
<?php if($this->session->flashdata('flashfam')) : ?>
    <div class="alert alert-success alert-dismissable" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon fa fa-check"></i> Alert!</h4>
        Data anggota keluarga <strong>berhasil</strong> <?= $this->session->flashdata('flashfam'); ?>
    </div>
<?php endif; ?>
<?php if($this->session->flashdata('flashjob')) : ?>
    <div class="alert alert-success alert-dismissable" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon fa fa-check"></i> Alert!</h4>
        Data pengalaman kerja <strong>berhasil</strong> <?= $this->session->flashdata('flashjob'); ?>
    </div>
<?php endif; ?>
<!-- /. Flash Data -->

    <div class="row">
        <!-- left column -->
        <div class="col-md-2">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border" style="text-align:center">
                    <h3 class="box-title"><strong><?=$this->fungsi->user_login()->fullname ?></strong></h3>
                </div><!-- /.box-header -->
                <div class="small-box" style="text-align:center">
                <img style="width:150px;height:relative" src="<?php echo base_url();?>uploads/image/<?=$this->fungsi->user_login()->foto ?>" class="img-thumbnail"  alt="User Image" />
                    <!-- <div class="inner">
                        <h3>150</h3>
                        <p>Ijin Sakit</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-user-md"></i>
                    </div>
                    <!-- Untuk Ganti Foto -->
                    <!-- <a href="javascript:void(0);" id="gantifoto" class="small-box-footer" style="color:blue" data-toggle="modal" data-target="#fotoProfile" data-id="<?=$this->fungsi->user_login()->id_kar ?>">
                        Ganti Foto <i class="fa fa-arrow-circle-right text-primary"></i>
                    </a> -->
                    <!-- ./ Untuk Ganti Foto -->
                    <a href="javascript:void(0);" class="small-box-footer" style="color:blue" "><strong>
                    <?php foreach($rownip as $data) echo $data['nip']; ?></strong> <i class="fa fa-arrow-circle-right text-primary"></i>
                    </a>
                </div>
            </div><!-- /.box -->
        </div><!-- /.left column -->
        <!-- right column -->
        <div class="col-md-10">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="acc-kontainer">
                    <div>
                        <input class="acc-kontainer-input" type="radio" name="acc" id="acc1" checked>
                        <label class="acc-kontainer-label" for="acc1"><i class="fa fa-chevron-circle-right"></i> Data Pribadi </label>
                        <div class="acc-body table-responsive">
                            <div class="pull-left">
                                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editPri"><i class="icon fa fa-edit"></i>  Edit Data</button>
                            </div>
                            <!-- DATA Pribadi -->
                            <table class="table table-borderless">                                
                                <tbody>
                                    <tr>
                                        <td width="170px" >Nama Lengkap</td>
                                        <td width="10px">:</td>
                                        <td><a href="javascript:void(0);" class="custom"><strong><?=$this->fungsi->user_login()->fullname ?></strong></a></td> 
                                    </tr>
                                    <tr>
                                        <td>Alamat</td>
                                        <td>:</td>
                                        <td><a href="javascript:void(0);" class="custom"><?=$this->fungsi->user_login()->alamat?></a></td>
                                    </tr>
                                    <tr>
                                        <td >Handphone</td>
                                        <td>:</td>
                                        <td><a href="javascript:void(0);" class="custom"><?=$this->fungsi->user_login()->telp ?></a></td>
                                    </tr>
                                    <tr>
                                        <td >Jenis Kelamin</td>
                                        <td>:</td>
                                        <?php if ($this->fungsi->user_login()->genre == "L") { ?>
                                        <td><a href="javascript:void(0);" class="custom">Laki - Laki</a></td> <?php } else { ?> 
                                        <td><a href="javascript:void(0);" class="custom">Perempuan</a></td>
                                        <?php } ?>
                                    </tr>
                                    <tr>
                                        <td >Tempat, Tgl Lahir</td>
                                        <td>:</td>
                                        <td><a href="javascript:void(0);" class="custom"><?= $this->fungsi->user_login()->tempat, ", ", date('d F Y', strtotime($this->fungsi->user_login()->tgllahir))?></a></td> 
                                    </tr> 
                                    <tr>
                                        <td >Status</td>
                                        <td>:</td>
                                        <?php if ($this->fungsi->user_login()->martial == "1") { ?>
                                        <td><a href="javascript:void(0);" class="custom">  Menikah </a></td> <?php } else { ?>
                                        <td><a href="javascript:void(0);" class="custom">  Belum Menikah</a></td>                                         
                                        <?php } ?>
                                    </tr>
                                    <tr>
                                        <td >Status Keluarga</td>
                                        <td>:</td>
                                        <td><a href="javascript:void(0);" class="custom"><?=$this->fungsi->user_login()->stat_kel ?></a></td>
                                    </tr>
                                    <tr>
                                        <td >Agama</td>
                                        <td>:</td>
                                        <td><a href="javascript:void(0);" class="custom"><?=$this->fungsi->user_login()->agama ?></a></td>
                                    </tr>
                                    <tr>
                                        <td >Pendidikan</td>
                                        <td>:</td>
                                        <td><a href="javascript:void(0);" class="custom"><?=$this->fungsi->user_login()->pendidikan ?></a></td>
                                    </tr>
                                    <tr>
                                        <td >Warga Negara</td>
                                        <td>:</td>
                                        <td><a href="javascript:void(0);" class="custom"><?=$this->fungsi->user_login()->negara ?></a></td>
                                    </tr>
                                </tbody>
                            </table>
                            <!-- ./ DATA Pribadi -->
                        </div>
                    </div>
                    <div>
                        <input class="acc-kontainer-input" type="radio" name="acc" id="acc2">
                        <label class="acc-kontainer-label" for="acc2"><i class="fa fa-chevron-circle-right"></i> Data Keluarga </label>
                        <div class="acc-body table-responsive">
                            <div class="pull-left">
                                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addFam"><i class="icon fa fa-plus"></i>  Tambah Data</button>
                            </div>
                            <!-- DATA Keluarga -->
                            <table class="table table-borderless ">   
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>L/P</th>
                                        <th>Hubungan</th>
                                        <th>Alamat</th>
                                        <th>No Tlp</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>                                 
                                <tbody>
                                <?php foreach ($rowfam as $data) { ?>
                                    <tr>
                                        <td><a href="javascript:void(0);" class="custom"><?= $data['nama'] ?></a></td>
                                        <td><?= $data['jenkel']?></td>
                                        <td><?php if ($data['hubungan'] == "1" )  {echo "Ayah";} 
                                                elseif ($data['hubungan'] == "2") {echo "Ibu";} 
                                                elseif ($data['hubungan'] == "3") {echo "Suami";} 
                                                elseif ($data['hubungan'] == "4") {echo "Istri";} 
                                                elseif ($data['hubungan'] == "5") {echo "Anak Pertama";} 
                                                elseif ($data['hubungan'] == "6") {echo "Anak Kedua";} 
                                                elseif ($data['hubungan'] == "7") {echo "Anak Ketiga";} 
                                                elseif ($data['hubungan'] == "8") {echo "Anak Keempat";} 
                                                elseif ($data['hubungan'] == "9") {echo "Anak Kelima";} 
                                            ?></td>
                                        <td><?= $data['rumah'] ?></td>
                                        <td><?= $data['hp'] == "0" ? '-' : $data['hp'] ; ?></td>
                                        <td><a href="#" id="editkel" data-tooltip="tooltip" title="Edit" data-toggle="modal" data-target="#updateFam" data-id="<?= $data['id_kel'] ?>" data-kel="<?= $data['nama'] ?>" data-hub="<?= $data['hubungan'] ?>" data-rumah="<?= $data['rumah'] ?>" data-hp="<?= $data['hp'] ?>" data-kar="<?= $data['id_kar'] ?>" data-genre="<?= $data['jenkel'] ?>"><i class="icon fa fa-edit"></i></a></td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                            <!-- ./ DATA Keluarga -->
                        </div>
                    </div>
                    <div>
                        <input class="acc-kontainer-input" type="radio" name="acc" id="acc3">
                        <label class="acc-kontainer-label" for="acc3"><i class="fa fa-chevron-circle-right"></i> Pengalaman Kerja</label>
                        <div class="acc-body table-responsive">
                            <div class="pull-left">
                                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addJob"><i class="icon fa fa-plus"></i>  Tambah Data</button>
                            </div>
                            <!-- DATA Pengalaman Kerja -->
                            <table class="table table-borderless ">   
                                <thead>
                                    <tr>
                                        <th>Perusahaan</th>
                                        <th>Posisi Terakhir</th>
                                        <th>Lama Bekerja</th>
                                        <th>Tahun</th>
                                        <?php if ($this->fungsi->user_login()->id_lvl == "A1" || "A2"){ ?>
                                        <th>Aksi</th>
                                        <?php } ?>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach($rowplam as $data) { ?>
                                    <tr>
                                        <td><a href="javascript:void(0);" class="custom"><?= $data['perusahaan'] ?></a></td>
                                        <td><?= $data['posisi'] ?></td>
                                        <td><?= $data['durasi'] ?></td>
                                        <td><?= $data['tahun_masuk'] ?> - <?= $data['tahun_keluar'] ?> </td>
                                        <?php if ($this->fungsi->user_login()->id_lvl == "A1" || "A2"){ ?>
                                        <td><a href="#" id="editjob" data-tooltip="tooltip" title="Edit" data-toggle="modal" data-target="#updateJob" data-id="<?=$data['id_plam'] ?>" data-company="<?=$data['perusahaan'] ?>" data-jabatan="<?=$data['posisi'] ?>" data-durasi="<?=$data['durasi'] ?>" data-awal="<?=$data['tahun_masuk'] ?>" data-akhir="<?=$data['tahun_keluar'] ?>"><i class="icon fa fa-edit"></i></a></td>
                                        <?php } ?>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div>
                        <input class="acc-kontainer-input" type="radio" name="acc" id="acc4">
                        <label class="acc-kontainer-label" for="acc4"><i class="fa fa-chevron-circle-right"></i> Dokumen Pribadi</label>
                        <div class="acc-body table-responsive">
                            <div class="pull-left">
                                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addDoc"><i class="icon fa fa-plus"></i>  Tambah Dokumen</button>
                            </div>
                            <!-- DATA Dokume Pribadi -->
                            <table class="table table-borderless ">   
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>No Dokumen</th>
                                        <th>Jenis Dokumen</th>
                                        <th style="width:70px;text-align:center">Aksi</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                <?php $no = 1;
                                foreach ($rowdoc as $data) { ?>
                                    <tr>
                                        <td><?=$no++;?> <a href="<?=site_url('C_Personal/myDoc/').encrypt_url($data['id_doc']) ?>" class="pull-right" data-tooltip="tooltip" title="Detail"><i class="fa fa-question-circle"></i></a></td>
                                        <td><a href="javascript:void(0);" class="custom"><?=$data['nodoc'] ?></a></td>
                                        <td><?=$data['typedoc'] ?></td>
                                        <td>
                                        
                                        <a href="#" id="editDoc" data-tooltip="tooltip" title="Edit" data-toggle="modal" data-target="#ubahDok" data-id="<?=$data['id_doc'] ?>" data-number="<?=$data['nodoc'] ?>" data-type="<?=$data['typedoc'] ?>" data-name="<?=$data['namadoc'] ?>" data-idkar="<?=$data['id_kar'] ?>" ><i class="icon fa fa-edit"></i></a>
                                        <a href="<?=site_url('C_Personal/delDoc/').$data['id_doc']?>" data-tooltip="tooltip" title="Hapus" class="tombol-del"><i class="icon fa fa-trash"></i> </a>

                                        </td>
                                    </tr>
                                <?php } ?>
                                
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                
            </div><!-- /.box -->
        </div><!-- /.right column -->
    </div><!-- /.row -->
    
<!-- Edit Data Pribadi -->
    <div id= "editPri" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><i class="icon fa fa-edit"></i>  Edit Data Pribadi</h4>
                </div>
                <form action="<?=site_url('C_Personal/updatePri')?>" method="post">
                <div class="modal-body">
                    <div class="box box-primary">
                        <div class="box-body">
                            <div class="form-group">
                                <input type="hidden" class="form-control" name="idpri" value="<?=$this->fungsi->user_login()->id_kar?>" > 
                                <label for="nama">Nama Lengkap</label><small class="text-danger">*</small>  
                                <div class="input-group"> 
                                    <input type="text" class="form-control" name="nama" value="<?=$this->fungsi->user_login()->fullname?>" required placeholder="Nama Lengkap.." required> 
                                    <div class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                    </div>
                                </div><!-- /.input group -->
                            </div>
                            <div class="form-group" style="margin-top:15px">
                                <label for="alamat">Alamat</label><small class="text-danger">*</small>  
                                <div class="input-group">
                                    <input type="text" class="form-control" name="alamat" value="<?=$this->fungsi->user_login()->alamat?>" required placeholder="Alamat.." required>
                                    <!-- <input type="text" class="form-control" name="alamat" required>  -->
                                    <div class="input-group-addon">
                                        <i class="fa fa-map-marker"></i>
                                    </div>
                                </div><!-- /.input group -->
                            </div>
                            <div class="form-group">
                                <label for="telp">No Telp.</label><small class="text-danger">*</small>  
                                <div class="input-group"> 
                                    <input type="number" class="form-control" name="telp" value="<?=$this->fungsi->user_login()->telp?>" placeholder="No Telp.."> 
                                    <div class="input-group-addon">
                                        <i class="fa fa-phone"></i>
                                    </div>
                                </div><!-- /.input group -->
                            </div>
                            <div class="form-group">
                                <label for="tempat">Tempat Lahir</label> <small class="text-danger">*</small>
                                <label for="tgllahir" style="margin-left:60px">Tanggal Lahir</label> <small class="text-danger">*</small>
                                <label for="negara" style="margin-left:55px">Warga Negara</label><small class="text-danger"> *</small> 
                                <div class="form-inline">
                                    <div class="input-group" style="margin-right:5px">
                                        <input type="text" class="form-control" id="tempat" name="tempat" value="<?=$this->fungsi->user_login()->tempat?>" placeholder="Tempat Lahir.." style="width:115px" required>
                                        <div class="input-group-addon">
                                        <i class="fa fa-globe"></i>
                                        </div>
                                    </div>
                                    <div class="form-group" id="sandbox-tanggal" >
                                        <div class="input-group date" id="tgllahir">
                                            <input type="text" class="form-control datepicker" name="tgllahir"  id="tgllahir" value="<?= date('d-m-Y', strtotime($this->fungsi->user_login()->tgllahir)); ?>" readonly placeholder="Tgl Lahir.." style="width:110px">
                                            <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="input-group"> 
                                        <input type="text" class="form-control" name="negara" id="negara" value="<?=$this->fungsi->user_login()->negara?>" placeholder="Warga Negara" style="width:190px; margin-left:5px"  required> 
                                        <div class="input-group-addon">
                                            <i class="fa fa-globe"></i>
                                        </div>
                                    </div><!-- /.input group --> 
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="genre">Jenis Kelamin</label>
                                <label style="margin-left:60px" for="status">Status </label>
                                <label for="agama" style="margin-left: 110px">Agama</label><small class="text-danger"> *</small> 
                            
                                <div class="form-inline">
                                    <select class="form-control" style="width:150px" name="genre" id="genre">
                                        <?php if($this->fungsi->user_login()->genre == "L"){
                                            echo "<option value='L' selected>Laki - Laki</option> <option value='P'>Perempuan</option>";
                                        }else echo "<option value='P' selected>Perempuan</option> <option value='L'>Laki - Laki</option>";  ?>
                                    </select>

                                    <select class="form-control" style="width:150px; margin-left:5px" name="status" id="status" required>
                                    <?php if($this->fungsi->user_login()->martial == "1"){
                                        echo "<option value='1' selected>Menikah</option> <option value='2'>Belum Menikah</option>";
                                    } else echo "<option value='2' selected>Belum Menikah</option> <option value='1'>Menikah</option>";?>
                                    </select>
                                    <select class="form-control" name="agama" id="agama" style="width:230px; margin-left:5px" required>                                        
                                            <option selected class="bg-green"><?=$this->fungsi->user_login()->agama?></option>
                                            <option value="Islam" >Islam</option>
                                            <option value="Katolik" >Katolik</option>
                                            <option value="Protestan" >Protestan</option>
                                            <option value="Budha" >Budha</option>
                                            <option value="Hindu" >Hindu</option>
                                            <option value="Lainnya" >Lainnya</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-default pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Tutup</button>
                    <button type="submit" name="update" class="btn btn-success"><i class="fa fa-check"></i> Update</button>
                </div>
                </form>
            </div>
        </div>
    </div>
<!-- ./ Edit Data Pribadi -->

<!-- Edit foto user Modal -->
    <div id= "fotoProfile" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><i class="icon fa fa-edit"></i>  Ganti Foto Profil</h4>
                </div>
                <div class="modal-body" id="ubahFotoData">
                    <!-- <form action=""> -->
                    <?php echo form_open_multipart('C_Personal/gantiFoto') ?>
                        <div class="box box-primary">
                            <div class="small-box" style="text-align:center">
                                <img src="<?php echo base_url();?>uploads/image/<?=$this->fungsi->user_login()->foto ?>" class="img-thumbnail" alt="User Image" style="width:215px; height:relative; border:0" />
                            </div>
                            <div class="form-group">
                                <input type="hidden" class="form-control" name="id" id="id" readonly>
                                <!-- <input type="text" class="form-control" name="oldFoto" id="oldFoto"> -->
                                <div class="input-group"> 
                                    <input type="file" class="form-control" name="fotoku"> 
                                    <div class="input-group-addon bg-green">
                                        <i class="fa fa-picture-o"></i>
                                    </div>
                                </div><!-- /.input group -->
                            </div>
                        </div><!-- /.box -->   
                        <div class="modal-footer">
                            <button type="reset" class="btn btn-default pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Tutup</button>
                            <button type="submit" name="submit" class="btn btn-primary"><i class="fa fa-upload"></i> Upload</button>
                        </div>                 
                        <!-- <div class="box-body"> 
                        </div>-->
                    <?php echo form_close() ?>
                    <!-- </form> -->
                </div> 
            </div>
        </div>
    </div>
    <script src="<?php echo base_url();?>assets/js/jquery-1.10.0.min.js" type="text/javascript"></script>
    <script type="text/javascript" >
        $(document).on("click","#gantifoto",function(){
            var id = $(this).data('id');
            // var fotolama = $(this).data('foto');
            
            $("#ubahFotoData #id").val(id);
            // $("#ubahFotoData #oldFoto").val(fotolama);
        });
    </script>
<!-- ./ Edit foto user Modal -->

<!-- Add Family Modal -->
    <div id= "addFam" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><i class="icon fa fa-plus-square"></i>  Tambah Anggota Keluarga</h4>
                </div>
                <div class="modal-body">
                <form action="<?=site_url('C_Personal/addFamily') ?>" method="post">
                    <div class="box box-primary">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="nama">Nama Lengkap</label><small class="text-danger">*</small>  
                                <div class="input-group"> 
                                    <input type="text" class="form-control" name="nama" required placeholder="Anggota Keluarga.."> 
                                    <div class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                    </div>
                                </div><!-- /.input group -->
                            </div>
                            <div class="form-group">
                                <label for="">Jenis Kelamin</label>
                                <div class="container">
                                    <label for="" class="radio-inline">
                                        <input type="radio" name="genre" value="L"> Laki-laki
                                    </label>
                                    <label for="" class="radio-inline">
                                        <input type="radio" name="genre" value="P"> Perempuan
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="hubungan">Hubungan Keluarga</label><small class="text-danger">*</small>  
                                    <select class="form-control" id="hubungan" name="hubungan" required>
                                        <option disabled selected>Pilih Satu..</option>
                                        <option value="1">Ayah</option>
                                        <option value="2">Ibu</option>
                                        <option value="3">Suami</option>
                                        <option value="4">Istri</option>
                                        <option value="5">Anak Pertama</option>
                                        <option value="6">Anak Kedua</option>
                                        <option value="7">Anak Ketiga</option>
                                        <option value="8">Anak Keempat</option>
                                        <option value="9">Anak Kelima</option>
                                    </select>
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat</label><small class="text-danger">*</small>  
                                <div class="input-group">
                                    <textarea class="form-control" name="alamat" id="alamat" rows="2" required placeholder="Alamat.."></textarea>
                                    <!-- <input type="text" class="form-control" name="alamat" required>  -->
                                    <div class="input-group-addon">
                                        <i class="fa fa-map-marker"></i>
                                    </div>
                                </div><!-- /.input group -->
                            </div>
                            <div class="form-group">
                                <label for="telp">No Telp.</label><small class="text-danger">*</small>  
                                <div class="input-group"> 
                                    <input type="hidden" class="form-control" name="idkar" value="<?=$this->fungsi->user_login()->id_kar ?>" required> 
                                    <input type="number" class="form-control" name="telp" placeholder="No Telp.."> 
                                    <div class="input-group-addon">
                                        <i class="fa fa-phone"></i>
                                    </div>
                                </div><!-- /.input group -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-default pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Tutup</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Simpan</button>
                </div>
                </form>
            </div>
        </div>
    </div>
            
<!-- ./ Add Family MOdal -->

<!-- Edit Modal Anggota Keluarga -->
    <div id= "updateFam" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><i class="icon fa fa-edit"></i>  Edit Anggota Keluarga</h4>
                </div>
                <div class="modal-body" id="ubahKel">
                <form action="<?=site_url('C_Personal/updateFamily') ?>" method="post">
                    <div class="box box-primary">
                        <div class="box-body">
                            <div class="form-group">
                                <input type="hidden" class="form-control" name="idkel" id="idkel" > 
                                <label for="nama">Nama Lengkap</label><small class="text-danger">*</small>  
                                <div class="input-group"> 
                                    <input type="text" class="form-control" name="nama" id="nama" required placeholder="Anggota Keluarga.." required> 
                                    <div class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                    </div>
                                </div><!-- /.input group -->
                            </div>
                            <div class="form-group">
                                <label for="">Jenis Kelamin</label>
                                <label style="margin-left: 150px" for="">Hubungan Keluarga</label>
                                </select>
                            </div>
                            <div class="form-inline">
                                <!-- <label for="">Jenis Kelamin</label> -->
                                <select class="form-control" style="width:200px" name="genre" id="genre">
                                    <option value="L">Laki - Laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                                <!-- <label for="hubungan">Hubungan Keluarga</label><small class="text-danger">*</small>   -->
                                <select class="form-control" style="width:200px; margin-left:35px" name="hubungan" id="hubungan" required>
                                    <option disabled selected>Pilih Satu..</option>
                                    <option value="1">Ayah</option>
                                    <option value="2">Ibu</option>
                                    <option value="3">Suami</option>
                                    <option value="4">Istri</option>
                                    <option value="5">Anak Pertama</option>
                                    <option value="6">Anak Kedua</option>
                                    <option value="7">Anak Ketiga</option>
                                    <option value="8">Anak Keempat</option>
                                    <option value="9">Anak Kelima</option>
                                </select>
                            </div>
                            <div class="form-group" style="margin-top:15px">
                                <label for="alamat">Alamat</label><small class="text-danger">*</small>  
                                <div class="input-group">
                                    <textarea class="form-control" name="alamat" id="alamat" rows="2" required placeholder="Alamat.."></textarea>
                                    <!-- <input type="text" class="form-control" name="alamat" required>  -->
                                    <div class="input-group-addon">
                                        <i class="fa fa-map-marker"></i>
                                    </div>
                                </div><!-- /.input group -->
                            </div>
                            <div class="form-group">
                                <label for="telp">No Telp.</label><small class="text-danger">*</small>  
                                <div class="input-group"> 
                                    <input type="number" class="form-control" name="telp" id="telp" placeholder="No Telp.."> 
                                    <input type="hidden" class="form-control" name="idkar" id="idkar" placeholder="No Telp.."> 
                                    <div class="input-group-addon">
                                        <i class="fa fa-phone"></i>
                                    </div>
                                </div><!-- /.input group -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-default pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Tutup</button>
                    <button type="submit" name="update" class="btn btn-success"><i class="fa fa-check"></i> Update</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <script src="<?php echo base_url();?>assets/js/jquery-1.10.0.min.js" type="text/javascript"></script>
    <script type="text/javascript" >
        $(document).on("click","#editkel",function(){
            var id = $(this).data('id');
            var nama = $(this).data('kel');
            var kel = $(this).data('hub');
            var rumah = $(this).data('rumah');
            var hp = $(this).data('hp');
            var kar = $(this).data('kar');
            var genre = $(this).data('genre');
            
            $("#ubahKel #idkel").val(id);
            $("#ubahKel #nama").val(nama);
            $("#ubahKel #hubungan").val(kel);
            $("#ubahKel #alamat").val(rumah);
            $("#ubahKel #telp").val(hp);
            $("#ubahKel #idkar").val(kar);
            $("#ubahKel #genre").val(genre);
            
        });
    </script>
<!-- ./ Edit Modal Anggota Keluarga -->

<!-- AddJob Modal / Tambah Pengalaman Kerja  -->
    <div id= "addJob" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><i class="icon fa fa-plus-square"></i>  Tambah Pengalaman Kerja</h4>
                </div>
                <div class="modal-body">
                <form action="<?=site_url('C_Personal/addJobstory') ?>" method="post">
                    <div class="box box-primary">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="nama">Nama Perusahaan</label><small class="text-danger">*</small>  
                                <div class="input-group"> 
                                    <input type="text" class="form-control" name="nama" required placeholder="Nama Perusahaan.."> 
                                    <div class="input-group-addon">
                                        <i class="fa fa-building"></i>
                                    </div>
                                </div><!-- /.input group -->
                            </div>
                            <div class="form-group">
                                <label for="nama">Jabatan Terakhir</label><small class="text-danger">*</small>  
                                <div class="input-group"> 
                                    <input type="text" class="form-control" name="jabatan" required placeholder="Jabatan Terakhir.."> 
                                    <div class="input-group-addon">
                                        <i class="fa fa-star"></i>
                                    </div>
                                </div><!-- /.input group -->
                            </div>
                            <div class="form-group">
                                <label for="nama">Lama Bekerja</label><small class="text-danger">*</small>  
                                <div class="input-group"> 
                                    <input type="text" class="form-control" name="durasi" required placeholder="Lama Bekerja.."> 
                                    <div class="input-group-addon">
                                        <i class="fa fa-history"></i>
                                    </div>
                                </div><!-- /.input group -->
                            </div>
                            <div class="form-inline">
                                <label for="hubungan">Dari Tahun</label><small class="text-danger">*</small>  
                                <label style="margin-left:50px" for="hubungan">Ke Tahun</label><small class="text-danger">*</small>  
                                <input type="hidden" class="form-control" name="idkar" value="<?=$this->fungsi->user_login()->id_kar ?>"> 
                            </div>     
                            <div class="form-group">
                                <div class="form-inline">
                                <?php $now= date('Y'); echo "<select class='form-control' style='width:90px;height:30px' id='awal' name='awal'>";
                                    for ($a=2000; $a <= $now; $a++){
                                        echo "<option value='$a'> $a </option>";
                                    }
                                echo "</select>";?>
                                <?php $now= date('Y'); echo "<select class='form-control' style='width:90px;height:30px;margin-left:30px'  id='akhir' name='akhir'>";
                                    for ($a=2000; $a <= $now; $a++){
                                        echo "<option value='$a'> $a </option>";
                                    }
                                echo "</select>";?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!--./ Modal Body -->
                <div class="modal-footer">
                    <button type="reset" class="btn btn-default pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Tutup</button>
                    <button type="submit" name="simpan" class="btn btn-primary"><i class="fa fa-check"></i> Simpan</button>
                </div>
                </form>
            </div>
        </div>
    </div>
            
<!-- ./ AddJob Modal / Tambah Pengalaman Kerja  -->

<!-- Edit Job Modal -->
    <div id= "updateJob" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><i class="icon fa fa-edit"></i>  Edit Pengalaman Kerja</h4>
                </div>
                <div class="modal-body" id="ubahJOb">
                <form action="<?=site_url('C_Personal/updateJobstory') ?>" method="post">
                    <div class="box box-primary">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="nama">Nama Perusahaan</label><small class="text-danger">*</small>  
                                <div class="input-group"> 
                                    <input type="hidden" class="form-control" name="idplam" id="idplam" > 
                                    <input type="text" class="form-control" name="nama" id="nama" required placeholder="Nama Perusahaan.."> 
                                    <div class="input-group-addon">
                                        <i class="fa fa-building"></i>
                                    </div>
                                </div><!-- /.input group -->
                            </div>
                            <div class="form-group">
                                <label for="jabatan">Jabatan Terakhir</label><small class="text-danger">*</small>  
                                <div class="input-group"> 
                                    <input type="text" class="form-control" name="jabatan" id="jabatan" required placeholder="Jabatan Terakhir.."> 
                                    <div class="input-group-addon">
                                        <i class="fa fa-star"></i>
                                    </div>
                                </div><!-- /.input group -->
                            </div>
                            <div class="form-group">
                                <label for="nama">Lama Bekerja</label><small class="text-danger">*</small>  
                                <div class="input-group"> 
                                    <input type="text" class="form-control" name="durasi" id="durasi" required placeholder="Lama Bekerja.."> 
                                    <div class="input-group-addon">
                                        <i class="fa fa-history"></i>
                                    </div>
                                </div><!-- /.input group -->
                            </div>
                            <div class="form-inline">
                                <label for="hubungan">Dari Tahun</label><small class="text-danger">*</small>
                                <label style="margin-left:50px" for="hubungan">Ke Tahun</label><small class="text-danger">*</small>
                                <input type="hidden" class="form-control" name="idkar" value="<?=$this->fungsi->user_login()->id_kar ?>">
                            </div>        
                            <div class="form-group">
                                <?php $now= date('Y'); echo "<select style='width:90px;height:30px' id='awal' name='awal'>";
                                    for ($a=2000; $a <= $now; $a++){
                                        echo "<option value='$a'> $a </option>";
                                    }
                                echo "</select>";?>  
                                <?php $now= date('Y'); echo "<select style='width:90px;height:30px;margin-left:30px'  id='akhir' name='akhir'>";
                                    for ($a=2000; $a <= $now; $a++){
                                        echo "<option value='$a'> $a </option>";
                                    }
                                echo "</select>";?> 
                            </div>
                        </div>
                    </div>
                </div> <!--./ Modal Body -->
                <div class="modal-footer">
                    <button type="reset" class="btn btn-default pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Tutup</button>
                    <button type="submit" name="update" class="btn btn-success"><i class="fa fa-check"></i> Update</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <script src="<?php echo base_url();?>assets/js/jquery-1.10.0.min.js" type="text/javascript"></script>
    <script type="text/javascript" >
        $(document).on("click","#editjob",function(){
            var id = $(this).data('id');
            var perusahaan = $(this).data('company');
            var jabatan = $(this).data('jabatan');
            var durasi = $(this).data('durasi');
            var awal = $(this).data('awal');
            var akhir = $(this).data('akhir');
            
            $("#ubahJOb #idplam").val(id);
            $("#ubahJOb #nama").val(perusahaan);
            $("#ubahJOb #jabatan").val(jabatan);
            $("#ubahJOb #durasi").val(durasi);
            $("#ubahJOb #awal").val(awal);
            $("#ubahJOb #akhir").val(akhir);
        });
    </script>
            
<!-- ./ Edit Job Modal -->

<!-- Add Document  -->
    <div id= "addDoc" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><i class="icon fa fa-plus-square"></i>  Tambah Dokumen</h4>
                </div>
                <div class="modal-body">
                <?php echo form_open_multipart('C_Personal/addDok') ?>
                    <div class="box box-primary">
                        <div class="form-group">
                            <label for="nodoc">Nomor Identitas</label>
                            <div class="input-group"> 
                                <input type="text" class="form-control" name="nodoc" id="nodoc" placeholder="Nomor Dokumen.." onkeyup="this.value = this.value.toUpperCase()" required>
                                <div class="input-group-addon bg-blue">
                                    <i class="fa fa-barcode"></i>
                                </div>
                            </div><!-- /.input group -->
                            <h5><small class="text-muted">Contoh: No KTP/Passpor</small></h5>
                        </div>
                        <div class="form-group">
                            <label for="jenisdoc"> Jenis Dokumen</label>
                            <select name="jenisdoc" id="jenisdoc" class="form-control" required>
                                <option selected disabled>Pilih satu..</option>
                                <option value="KTP">KTP</option>
                                <option value="KK">KK</option>
                                <option value="PASSPORT">Passport</option>
                                <option value="KITAS">KITAS</option>
                                <option value="BPJS">BPJS</option>
                                <option value="SIM">SIM</option>
                                <option value="LAINNYA">Lainnya</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="hidden" class="form-control" name="idkar" id="idkar" value="<?=$this->fungsi->user_login()->id_kar?>">
                            <div class="input-group"> 
                                <input type="file" class="form-control" name="filedoc" required> 
                                <div class="input-group-addon bg-red">
                                    <i class="fa fa-file-pdf-o"></i>
                                </div>
                            </div><!-- /.input group -->
                            <h5><small class="text-muted">Format file PDF</small></h5>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-default pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Tutup</button>
                        <button type="submit" name="simpan" class="btn btn-primary"><i class="fa fa-send"></i> Simpan</button>
                    </div>
                <?php echo form_close() ?>
                </div>
            </div>
        </div>
    </div>
<!-- ./ Add Document  -->

<!-- Edit Document Modal -->
    <div id= "ubahDok" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><i class="icon fa fa-plus-square"></i>  Tambah Dokumen</h4>
                </div>
                <div class="modal-body" id="gantiDoc">
                <?php echo form_open_multipart('C_Personal/updateDok') ?>
                    <div class="box box-primary">
                        <div class="form-group">
                            <label for="nodoc">Nomor Dokumen</label>
                            <div class="input-group">
                                <input type="hidden" name="iddoc" id="iddoc">
                                <input type="text" class="form-control" name="nodoc" id="nodoc" placeholder="Nomor Dokumen.." onkeyup="this.value = this.value.toUpperCase()" required>
                                <div class="input-group-addon bg-blue">
                                    <i class="fa fa-barcode"></i>
                                </div>
                            </div><!-- /.input group -->
                        </div>
                        <div class="form-group">
                            <label for="jenisdoc"> Jenis Dokumen</label>
                            <select name="jenisdoc" id="jenisdoc" class="form-control" required>
                                <option selected disabled>Pilih satu..</option>
                                <option value="KTP">KTP</option>
                                <option value="KK">KK</option>
                                <option value="PASSPORT">Passport</option>
                                <option value="KITAS">KITAS</option>
                                <option value="BPJS">BPJS</option>
                                <option value="SIM">SIM</option>
                                <option value="LAINNYA">Lainnya</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="hidden" class="form-control" name="idkar" id="idkar" >
                            
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-default pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Tutup</button>
                        <button type="submit" name="update" class="btn btn-primary"><i class="fa fa-send"></i> Update</button>
                    </div>
                <?php echo form_close() ?>
                </div>
            </div>
        </div>
    </div>
    <script src="<?php echo base_url();?>assets/js/jquery-1.10.0.min.js" type="text/javascript"></script>
    <script type="text/javascript" >
        $(document).on("click","#editDoc",function(){
            var id = $(this).data('id');
            var number = $(this).data('number');
            var type = $(this).data('type');
            var name = $(this).data('name');
            var idkar = $(this).data('idkar');
            
            $("#gantiDoc #iddoc").val(id);
            $("#gantiDoc #nodoc").val(number);
            $("#gantiDoc #jenisdoc").val(type);
            $("#gantiDoc #idkar").val(idkar);
            $("#gantiDoc #filedoc").val(name);
        });
    </script>

<!-- ./ Edit Document Modal -->


