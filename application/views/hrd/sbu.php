<!-- DASHBOARD Karyawan LIST -->
<!-- ditampilkan hanya untuk anggota HR Departement -->
<!-- ================================================ -->

<!-- Breadcumb section -->
<section class="content-header">
    <h1>
        SBU dan Sub Unit
        <small>Pusat Informasi HR Department</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>Hrd"><i class="fa fa-dashboard"></i> Central Info HR</a></li>
        <li><a href="<?php echo base_url();?>Hrd/sbu"><i class="fa fa-user"></i> Perusahaan</a></li>
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
            Berikut Daftar SBU dan Sub Unit di Bias Mandiri Group
        </div><!-- /.box-body -->
        <!-- <div class="box-footer">
            Footer
        </div>/.box-footer -->
    </div>
<!-- /.box -->


<!-- Flash Data -->
<div class="flash-unit" data-flashdata="<?=$this->session->flashdata('flash'); ?>"></div>
<div class="flash-err" data-flashdata="<?=$this->session->flashdata('flash_error'); ?>"></div>
<?php if($this->session->flashdata('flash_error')) : ?>
    <div class="alert alert-danger alert-dismissable" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon fa fa-ban"></i> Alert!</h4>
        Data <strong>gagal</strong> <?= $this->session->flashdata('flash_error'); ?>, terdapat duplikat data.
    </div>
<?php endif; ?>

<!-- =========================================================== -->
<!-- Box COllapsable -->
    
    <div class="box box-default box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><img src="<?=base_url(); ?>assets/images/icons/iconbmg.png" style="height:25px" alt="" class="img-fluid"> Grup Perusahaan</h3>
            <button class="btn btn-box-tool btn-primary" type="button" style="margin-left:10px" data-toggle="modal" data-target="#modGrup"><font color="white"> <i class="fa fa-plus-circle" style="margin-right:5px"></i> Tambah</font></button>
            <div class="box-tools pull-right">
                <!-- <small style="margin-right:50px">Tahun <?=gmdate("Y") ?></small> -->
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div><!-- /.box-tools -->
        </div><!-- /.box-header -->
        <div class="box-body table-responsive" style="display:block;background-color:#dbdbfa">
            <table class="table" >
                <thead class="">
                    <tr class="">
                        <th width="50px">#</th>
                        <th width="50px">ID</th>
                        <th width="100px" >Kode Grup</th>
                        <th>Nama</th>
                        <th>Status</th>
                        <th class="text-center">SBU</th>
                        <th width="100px" class="text-center"><i class="fa fa-cogs"></i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($rowgrup as $data){ ?>
                        <tr class="">
                            <td><?=$no++?></td>
                            <td><?=$data['id_grup'] ?></td>
                            <td><?=$data['kode_grup'] ?></td>
                            <td><?=$data['nama_grup'] ?></td>
                            <td><?= $data['status_grup'] == "A" ? "Aktif" : "Nonaktif" ?></td>
                            <td class="text-center"><a href="#" data-toggle="tooltip" title="Item">
                            <?php 
                                $this->db->where('grup',$data['id_grup']);
                                $this->db->from('tb_sbu');
                                echo $this->db->count_all_results(); ?></a></td>
                            <td class="text-center">
                                <!-- Tombol Update -->
                                <a href="javascript:void(0);" id="updateGrup" data-toggle="modal" data-target="#editGrup" data-id="<?=$data['id_grup'] ?>" data-kode="<?=$data['kode_grup'] ?>" data-nama="<?=$data['nama_grup'] ?>"><i class="icon fa fa-edit text-info" data-toggle="tooltip" title="Edit" style="margin-right:5px"></i></a>
                                <!-- tombol update status -->
                                <?php if($data['status_grup'] == "A"){
                                    echo "<a href='".site_url('Hrd/updatestatus/').encrypt_url($data['id_grup']).'/'.encrypt_url('N')."'><i class='icon fa fa-power-off text-success' data-toggle='tooltip' title='Nonaktif' style='margin-right:5px'></i></a>";
                                }else{
                                    echo "<a href='".site_url('Hrd/updatestatus/').encrypt_url($data['id_grup']).'/'.encrypt_url('A')."'><i class='icon fa fa-flash text-aqua' data-toggle='tooltip' title='Aktifkan' style='margin-right:5px'></i></a>";
                                }?>
                                <!-- Tombol Hapus -->
                                <?php if($data['status_grup'] != "A"){
                                    echo "<a href='".site_url('Hrd/delGrup/').encrypt_url($data['id_grup'])."' class='tombol-del'><i class='icon fa fa-trash text-danger' data-toggle='tooltip' title='Hapus'></i></a>";
                                }?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div><!-- /.box-body -->        
    </div>


<div class="row">
    <div class="col-md-4">
        <div class="box box-danger">
            <div class="box-header">
                <h3 class="box-title">Daftar SBU</h3>
                <div class="pull-right">
                    <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#addSBU"><i class="fa fa-plus-square"></i>  Tambah</button>
                </div>
                <!-- <div class="collapse" id="addUnit" style="margin-top:15px">
                    <form action="<?=site_url('Hrd/addSbu') ?>" method="post" class="form-inline">
                        <div class="form-group">
                            <input type="text" class="form-control" name ="kodesbu" onkeyup="this.value = this.value.toUpperCase()" style="width:50px;height:30px" placeholder="SBU" required>
                        </div>
                        <div class="form-group">
                            <input type="text" name="namasbu" class="form-control" style="width:210px;height:30px;margin-left:3px" placeholder="Nama SBU.."  required>
                        </div>
                        <button type="submit" data-tooltip="tootltip" title="Simpan" class="btn btn-success" style="height:30px;margin-left:3px"><i class="icon fa fa-check-square" style="font-size:15px"></i></button>
                    </form>
                </div> -->
            </div><!-- /.box-header -->
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <!-- <th>No</th> -->
                                <th>Kode</th>
                                <th>Nama SBU</th>
                                <th>Unit</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $no=1; 
                        foreach($rowsbu as $data){ ?>
                        <tr>
                            <!-- <td><?=$no++;?></td> -->
                            <td><?=$data['kode'] ?></td>
                            <td><?=$data['nama'] ?></td>
                            <td><a href="#" data-toggle="tooltip" title="Item">
                            <?php 
                                $this->db->where('kode',$data['kode']);
                                $this->db->from('tb_subunit');
                                echo $this->db->count_all_results(); ?></a>
                                </td>
                            <td> <a href="#" id="updateSbu" data-toggle="modal" data-target="#editUnit" data-id="<?=$data['kode'] ?>" data-nama="<?=$data['nama'] ?>"><i class="icon fa fa-edit text-danger"></i></a>
                            <a href="<?=site_url('Hrd/delSbu/').$data['kode'] ?>" class="tombol-del"><i class="icon fa fa-trash text-danger"></i></a>
                            </td>
                        </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div><!-- /.box-body -->
        
        </div><!-- /.box -->
    </div><!-- /.col -->
    
    <div class="col-md-8">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Daftar Sub Unit</h3>
                <div class="pull-right">
                    <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#addSubunit"><i class="fa fa-plus-square"></i>  Tambah</button>
                </div>
            </div><!-- /.box-header -->
            <div class="box-body ">
                <div class="table-responsive no-padding">
                    <table class="table table-hover" id="tablehistory">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Sub Unit</th>
                                <th>Nama Sub Unit</th>
                                <th>Personil</th>
                                <th>SBU</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $no=1; 
                        foreach($rowsub as $data){ ?>
                        <tr>
                            <td><?=$no++;?></td>
                            <td><?=$data['sub'] ?></td>
                            <td><?=$data['namasub'] ?></td>
                            <td align="center"><a href="#" data-toggle="tooltip" title="Item">
                            <?php 
                                $this->db->where('sub_unt',$data['id_sub']);
                                $this->db->where('stat_kar !=',"F");
                                $this->db->from('tb_karyawan');
                                echo $this->db->count_all_results(); ?></a></td>
                            <td><?=$data['kode'] ?></td>
                            <td>
                            <a href="#" id="updateSub" data-toggle="modal" data-target="#editSubunit" data-id="<?=$data['id_sub'] ?>" data-sub="<?=$data['sub'] ?>" data-nama="<?=$data['namasub'] ?>" data-kode="<?=$data['kode'] ?>" ><i class="icon fa fa-edit text-info"></i></a>
                            <a href="<?=site_url('Hrd/delSub/').$data['id_sub'] ?>" class="tombol-del"><i class="icon fa fa-trash text-info"></i></a>
                            </td>
                        </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div><!-- /.box-body -->        
        </div><!-- /.box -->
    </div><!-- /.col -->

</div><!-- /.row -->

</section>
<!-- /.content -->

<!-- Tambah Grup Modal -->
    <div id="modGrup" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"> <img src="<?=base_url(); ?>assets/images/icons/iconbmg.png" style="height:25px" alt="" class="img-fluid">  Tambah Grup  <a href="javascript:void(0)" style="margin-left:5px;font-size:17px">ID - <?=$idgrup?></a> </h4>
                </div>
                <form action="<?=site_url('Hrd/addGrup') ?>" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="hidden" class="form-control" id="idgrup" name="idgrup" value="<?=$idgrup?>" readonly>
                            <label for="kodegrup">Kode Grup </label> <small class="text-danger">*<sup> Maks. 10 Karakter </sup></small>
                            <div class="input-group">
                                <input type="text" class="form-control" id="kodegrup" name="kodegrup" onkeyup="this.value = this.value.toUpperCase()" placeholder="Kode Grup.." maxlength="10" required>
                                <div class="input-group-addon">
                                    <i class="fa fa-tags"></i>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="namagrup">Nama Grup</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="namagrup" name="namagrup" onkeyup="this.value = this.value.toUpperCase()" placeholder="Nama Grup.." required>
                                <div class="input-group-addon">
                                <i class="fa fa-tags"></i>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for=""> Status : <small class="text-danger">*</small></label>
                            <div>
                                <label style="margin-right:10px">
                                    <input type="radio" class="option-input radio" name="status" value="N" checked style="margin-right:5px" />
                                    Nonaktif
                                </label>
                                <label>
                                    <input type="radio" class="option-input radio" name="status" value="A" style="margin-right:5px" />
                                    Aktifkan
                                </label>
                            </div>
                        </div>                        
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-default pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Tutup</button>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-send"></i> Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<!-- /. Tambah Grup Modal -->

<!-- Edit Grup Modal -->
    <div id="editGrup" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"> <img src="<?=base_url(); ?>assets/images/icons/iconbmg.png" style="height:25px" alt="" class="img-fluid">  Edit Data Grup  </h4>
                </div>
                <form action="<?=site_url('Hrd/updateGrup') ?>" method="post">
                    <div class="modal-body" id="bodyGrup">
                        <div class="form-group">
                            <label for="id_grup">ID Grup </label> 
                            <div class="input-group">
                                <input type="text" class="form-control" id="id_grup" name="id_grup" readonly>
                                <div class="input-group-addon">
                                    <i class="fa fa-tags"></i>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="kode_grup">Kode Grup </label> <small class="text-danger">*<sup> Maks. 10 Karakter </sup></small>
                            <div class="input-group">
                                <input type="text" class="form-control" id="kode_grup" name="kode_grup" onkeyup="this.value = this.value.toUpperCase()" placeholder="Kode Grup.." maxlength="10" required>
                                <div class="input-group-addon">
                                    <i class="fa fa-tags"></i>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nama_grup">Nama Grup</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="nama_grup" name="nama_grup" onkeyup="this.value = this.value.toUpperCase()" placeholder="Nama Grup.." required>
                                <div class="input-group-addon">
                                <i class="fa fa-tags"></i>
                                </div>
                            </div>
                        </div>                
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-default pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Tutup</button>
                        <button type="submit" class="btn btn-success"><i class="fa fa-send"></i> Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="<?php echo base_url();?>assets/js/jquery-1.10.0.min.js" type="text/javascript"></script>
    <script type="text/javascript" >
        $(document).on("click","#updateGrup",function(){
            var id = $(this).data('id');
            var kode = $(this).data('kode');
            var nama = $(this).data('nama');

            $("#bodyGrup #id_grup").val(id);
            $("#bodyGrup #kode_grup").val(kode);
            $("#bodyGrup #nama_grup").val(nama);
        });
    </script>
<!-- /. Edit Grup Modal -->

<!-- Add SBU Modal -->
    <div id= "addSBU" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"> <i class="fa fa-tags text-primary"></i>  Edit Data SBU</h4>
                    </div>
                <form role="form" action="<?=site_url('Hrd/addSbu')?>" method="POST">
                    <div class="modal-body">                
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="kode_sbu">Kode SBU</label> <small class="text-danger">*<sup> Maks. 3 Karakter </sup></small>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="kode_sbu" name="kode_sbu" onkeyup="this.value = this.value.toUpperCase()" placeholder="Kode SBU.." maxlength="3" required>
                                        <div class="input-group-addon">
                                        <i class="fa fa-tags"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="nama_sbu" >Deskripsi SBU</label> <small class="text-danger">*</small>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="nama_sbu" name="nama_sbu" onkeyup="this.value = this.value.toUpperCase()" placeholder="Nama SBU.." required>
                                        <div class="input-group-addon">
                                        <i class="fa fa-tags"></i>
                                        </div>
                                    </div>
                                </div> 
                                <div class="form-group">
                                    <label for="grup_sbu">Grup</label> <small class="text-danger">*</small>
                                    <select class="form-control" id="grup_sbu" name="grup_sbu" required>
                                        <option selected disabled>Pilih Satu..</option>
                                        <?php foreach($grupAkt as $data){ ?>
                                        <option value="<?=$data['id_grup']?>"><?=$data['kode_grup']. ' - '. $data['nama_grup']?>  </option>
                                        <?php } ?>
                                    </select>
                                </div>
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

<!-- /. Add SBU Modal -->

<!-- Edit SBU Modal -->
    <div id= "editUnit" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"> <i class="fa fa-tags text-primary"></i>  Edit Data SBU</h4>
                </div>
            <form role="form" action="<?=site_url('Hrd/updateSbu')?>" method="POST">
                <div class="modal-body" id="ubahSbu">                
                        <div class="box-body">
                            <div class="form-group">
                                <label for="subkode">Kode SBU</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="kodesbu" name="kodesbu" onkeyup="this.value = this.value.toUpperCase()" placeholder="Kode SBU.." readonly>
                                    <div class="input-group-addon">
                                    <i class="fa fa-tags"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="namasub" >Deskripsi SBU</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="namasbu" name="namasbu" placeholder="Deskripsi Sub Unit.." required>
                                    <div class="input-group-addon">
                                    <i class="fa fa-tags"></i>
                                    </div>
                                </div>
                            </div> 
                            <div class="form-group">
                                <label for="grupsbu">Grup</label>
                                <select class="form-control" id="grupsbu" name="grupsbu" required>
                                    <option selected disabled>Pilih Satu..</option>
                                    <?php foreach($grupAkt as $data){ ?>
                                    <option value="<?=$data['id_grup']?>"><?=$data['kode_grup']. ' - '. $data['nama_grup']?>  </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div><!-- /.box-body -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Tutup</button>
                            <button type="submit" class="btn btn-success"><i class="fa fa-send"></i> Update</button>
                        </div>                           
                </div>
            </form>      
            </div>
        </div>
    </div>
    <script src="<?php echo base_url();?>assets/js/jquery-1.10.0.min.js" type="text/javascript"></script>
    <script type="text/javascript" >
        $(document).on("click","#updateSbu",function(){
            var id = $(this).data('id');
            var nama = $(this).data('nama');

            $("#ubahSbu #kodesbu").val(id);
            $("#ubahSbu #namasbu").val(nama);
        });
    </script>
<!-- ./ Edit SBU Modal -->

<!-- Add Sub Unit Modal -->
    <div id= "addSubunit" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
            <form role="form" action="<?= site_url('Hrd/addSub') ?>" method="POST">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"> <i class="fa fa-tags text-primary"></i>  Tambah Sub Unit - Untuk <a href="javascript:void(0)">Id Sub : <?=$kodesub?></a> </h4> 
                </div>
                <div class="modal-body">
                    <div class="box-body">
                        <input type="hidden" id="idsub" name="idsub" value="<?=$kodesub?>" class="form-control" readonly>
                        <div class="form-group">
                            <label for="subkode">Kode Sub Unit</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="subkode" name="subkode" onkeyup="this.value = this.value.toUpperCase()" placeholder="Kode Sub Unit.." required>
                                <div class="input-group-addon">
                                <i class="fa fa-tags"></i>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="namasub" >Deskripsi Sub Unit</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="namasub" name="namasub" onkeyup="this.value = this.value.toUpperCase()" placeholder="Deskripsi Sub Unit.." required>
                                <div class="input-group-addon">
                                <i class="fa fa-tags"></i>
                                </div>
                            </div>
                        </div> 
                        <div class="form-group">
                            <label for="sbu">Pilih SBU:</label>
                            <select class="form-control" id="sbu" name="sbu" required>
                                <option selected disabled>Pilih Satu..</option>
                                <?php foreach($rowsbu as $data){ ?>
                                <option value="<?=$data['kode']?>"><?=$data['kode']?> - <?=$data['nama']?></option>
                                <?php } ?>
                            </select>
                        </div>                           
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
<!-- ./ Add Sub Unit Modal -->


<!-- Edit Sub Unit Modal -->
    <div id= "editSubunit" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"> <i class="fa fa-tags text-primary"></i>  Edit Sub Unit</h4>
                </div>
            <form role="form" action="<?=site_url('Hrd/updateSub')?>" method="POST">
                <div class="modal-body" id="ubahSub">                
                        <div class="box-body">
                            <div class="form-group">
                                <label for="subkode">Kode Sub Unit</label>
                                <div class="input-group">
                                    <input type="hidden" class="form-control" id="idsub" name="idsub" >
                                    <input type="text" class="form-control" id="subkode" name="subkode" onkeyup="this.value = this.value.toUpperCase()" placeholder="Kode Sub Unit.." required>
                                    <div class="input-group-addon">
                                    <i class="fa fa-tags"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="namasub" >Deskripsi Sub Unit</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="namasub" name="namasub" onkeyup="this.value = this.value.toUpperCase()" placeholder="Deskripsi Sub Unit.." required>
                                    <div class="input-group-addon">
                                    <i class="fa fa-tags"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="sbu">Pilih SBU:</label>
                                <select class="form-control" id="sbu" name="sbu" required>
                                    <option selected disabled>Pilih Satu..</option>
                                    <?php foreach($rowsbu as $data){ ?>
                                    <option value="<?=$data['kode']?>"><?=$data['kode']?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div><!-- /.box-body -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Tutup</button>
                            <button type="submit" class="btn btn-success"><i class="fa fa-send"></i> Update</button>
                        </div>                           
                </div>
            </form>      
            </div>
        </div>
    </div>
    <script src="<?php echo base_url();?>assets/js/jquery-1.10.0.min.js" type="text/javascript"></script>
    <script type="text/javascript" >
        $(document).on("click","#updateSub",function(){
            var id = $(this).data('id');
            var sub = $(this).data('sub');
            var nama = $(this).data('nama');
            var kode = $(this).data('kode');

            $("#ubahSub #idsub").val(id);
            $("#ubahSub #subkode").val(sub);
            $("#ubahSub #namasub").val(nama);
            $("#ubahSub #sbu").val(kode);
        });
    </script>
<!-- ./ Edit Sub Unit Modal -->