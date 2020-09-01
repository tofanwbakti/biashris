<!-- DASHBOARD Karyawan LIST -->
<!-- ditampilkan hanya untuk anggota HR Departement -->
<!-- ================================================ -->
<!-- Breadcumb section -->
<section class="content-header">
    <h1>
        Daftar Jabatan
        <small>Pusat Informasi HR Department</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>Hrd"><i class="fa fa-dashboard"></i> Central Info HR</a></li>
        <li><a href="<?php echo base_url();?>Hrd/jabatan"><i class="fa fa-circle-o"></i> Jabatan</a></li>
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
            Berikut Daftar Jabatan di Bias Mandiri Group
        </div><!-- /.box-body -->
        <!-- <div class="box-footer">
            Footer
        </div>/.box-footer -->
    </div>
<!-- /.box -->
<!-- =========================================================== -->

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

<div class="row">
    <div class="col-md-4">
        <div class="box box-danger">
            <div class="box-header">
                <h3 class="box-title">Daftar Level Jabatan</h3>
                <div class="pull-right">
                    <button type="button" class="btn btn-danger btn-xs" data-toggle="collapse" data-target="#tambah"><i class="fa fa-plus-square"></i>  Tambah</button>
                </div>
                <div class="collapse" id="tambah" style="margin-top:15px">
                    <form action="<?=site_url('Hrd/addJab') ?>" method="post" class="form-inline">
                        <div class="form-group">
                            <input type="text" class="form-control" name ="kodejab" style="width:60px;height:30px" value="<?= $kodejab; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <input type="text" name="namajab" class="form-control" style="width:210px;height:30px;margin-left:3px" placeholder="Nama Jabatan.." onkeyup="this.value = this.value.toUpperCase()" required>
                        </div>
                        <button type="submit" data-tooltip="tootltip" title="Simpan" class="btn btn-success" style="height:30px;margin-left:3px"><i class="icon fa fa-check-square" style="font-size:15px"></i></button>
                    </form>
                </div>
            </div><!-- /.box-header -->
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <!-- <th>No</th> -->
                                <th>Kode</th>
                                <th>Nama Jabatan</th>
                                <th>Total Kar</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $no=1; 
                        foreach($rowjab as $data){ ?>
                        <tr>
                            <!-- <td><?=$no++;?></td> -->
                            <td><?=$data['id_jab'] ?></td>
                            <td><?=$data['nama_jab'] ?></td>
                            <td style="text-align:center"><a href="#" data-tooltip="tooltip" title="Members">
                            <?php 
                                $this->db->where('id_jab',$data['id_jab']);
                                $this->db->from('tb_karyawan');
                                echo $this->db->count_all_results(); ?></a>
                                </td>
                            <td><?php if($data['id_jab'] != "J000" ){ ?>
                            <a href="#" id="gantiLevel" data-toggle="modal" data-target="#editLevel" data-id="<?=$data['id_jab'] ?>" data-nama="<?=$data['nama_jab'] ?>"><i class="icon fa fa-edit text-danger" data-toggle="tooltip" title="Edit"></i></a>
                            <!-- <a href="<?=site_url('Hrd/delJab/').$data['id_jab'] ?>" class="tombol-del"><i class="icon fa fa-trash text-danger"></i></a> -->
                            <?php } ?>
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
                <h3 class="box-title">Daftar Detail Jabatan Karyawan </h3>
                <div class="pull-right">
                    <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#tambahJail"><i class="fa fa-plus-square"></i>  Tambah</button>
                </div>
            </div><!-- /.box-header -->
            <div class="box-body ">
                <div class="table-responsive no-padding">
                    <table class="table table-hover" id="tablehistory">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode</th>
                                <th>Detail Jabatan</th>
                                <th>Jabatan</th>
                                <!-- <th>SBU</th> -->
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $no=1; 
                        foreach($rowjail as $data){ ?>
                        <tr>
                            <td><?=$no++;?></td>
                            <td><?=$data['kode_jail'] ?></td>
                            <td><?=$data['nama_jail'] ?></td>
                            <td><?=$data['nama_jab'] ?></td>
                            <!-- <td><?=$data['sbu'] ?></td> -->
                            <td>
                            <a href="#" id="updateJail" data-toggle="modal" data-target="#editJail" data-id="<?=$data['id_jail'] ?>" data-kode="<?=$data['kode_jail'] ?>" data-nama="<?=$data['nama_jail'] ?>" data-jab="<?=$data['id_jab'] ?>" ><i class="icon fa fa-edit text-info"></i></a>
                            <a href="<?=site_url('Hrd/delJail/').$data['id_jail'] ?>" class="tombol-del"><i class="icon fa fa-trash text-info"></i></a>
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

<!-- Edit Level Jabatan Modal -->
    <div id= "editLevel" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"> <i class="fa fa-tags text-primary"></i>  Edit Data SBU</h4>
                </div>
            <form role="form" action="<?=site_url('Hrd/updateJab')?>" method="POST">
                <div class="modal-body" id="ubahLvl">                
                        <div class="box-body">
                            <div class="form-group">
                                <label for="kodejab">Kode Jabatan</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="kodejab" name="kodejab" readonly>
                                    <div class="input-group-addon">
                                    <i class="fa fa-tags"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="namajab" >Nama Jabatan</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="namajab" name="namajab" placeholder="Nama Jabatan.." onkeyup="this.value = this.value.toUpperCase()" required>
                                    <div class="input-group-addon">
                                    <i class="fa fa-tags"></i>
                                    </div>
                                </div>
                            </div>                            
                        </div><!-- /.box-body -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Tutup</button>
                            <button type="submit" class="btn btn-primary"><i class="fa fa-send"></i> Update</button>
                        </div>                           
                </div>
            </form>      
            </div>
        </div>
    </div>
    <script src="<?php echo base_url();?>assets/js/jquery-1.10.0.min.js" type="text/javascript"></script>
    <script type="text/javascript" >
        $(document).on("click","#gantiLevel",function(){
            var id = $(this).data('id');
            var nama = $(this).data('nama');

            $("#ubahLvl #kodejab").val(id);
            $("#ubahLvl #namajab").val(nama);
        });
    </script>
<!-- ./ Edit Level Jabatan Modal -->

<!-- Add DEtail Jabatan Modal -->
    <div id= "tambahJail" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
            <form role="form" action="<?= site_url('Hrd/addJail') ?>" method="POST">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"> <i class="fa fa-tags text-primary"></i>  Tambah Detail Jabatan Karyawan</h4>
                </div>
                
                <div class="modal-body">                
                        <div class="box-body">
                            <div class="form-group">
                                <label for="subkode">Kode Jabatan</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="kodejail" name="kodejail" value="<?= $kodejail;?>" readonly>
                                    <div class="input-group-addon">
                                    <i class="fa fa-tags"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="namajail" >Deskripsi Detail Jabatan</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="namajail" name="namajail" placeholder="Deskripsi Detail Jabatan.." onkeyup="this.value = this.value.toUpperCase()" required>
                                    <div class="input-group-addon">
                                    <i class="fa fa-tags"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="jabatan">Level Jabatan</label>
                                <select class="form-control" id="jabatan" name="jabatan" required>
                                    <option selected disabled>Pilih Satu..</option>
                                    <?php  
                                    foreach($rowjab as $data){ ?>
                                    <option value="<?=$data['id_jab']?>"><?=$data['nama_jab']?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <!-- <div class="form-group">
                                <label for="sbu">SBU</label>
                                <select class="form-control" id="sbu" name="sbu" required>
                                    <option selected disabled>Pilih Satu..</option>
                                    <?php  
                                    foreach($rowsbu as $data){ ?>
                                    <option value="<?=$data['kode']?>"><?=$data['kode']?></option>
                                    <?php } ?>
                                </select>
                            </div> -->
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


<!-- Edit Detail Jabatan Modal -->
    <div id= "editJail" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"> <i class="fa fa-tags text-primary"></i>  Edit Detail Jabatan Karyawan</h4>
                </div>
            <form role="form" action="<?=site_url('Hrd/updateJail')?>" method="POST">
                <div class="modal-body" id="ubahJail">                
                        <div class="box-body">
                            <div class="form-group">
                                <label for="kodejail">Kode Jabatan</label>
                                <div class="input-group">
                                    <input type="hidden" class="form-control" id="idjail" name="idjail" >
                                    <input type="text" class="form-control" id="kodejail" name="kodejail" readonly>
                                    <div class="input-group-addon">
                                    <i class="fa fa-tags"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="namajail" >Deskripsi Detail Jabatan</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="namajail" name="namajail" onkeyup="this.value = this.value.toUpperCase()" placeholder="Deskripsi Sub Unit.." required>
                                    <div class="input-group-addon">
                                    <i class="fa fa-tags"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="jabatan">Level Jabatan</label>
                                <select class="form-control" id="jabatan" name="jabatan" required>
                                    <option selected disabled>Pilih Satu..</option>
                                    <?php  
                                    foreach($rowjab as $data){ ?>
                                    <option value="<?=$data['id_jab']?>"><?=$data['nama_jab']?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <!-- <div class="form-group">
                                <label for="sbu">Pilih Level:</label>
                                <select class="form-control" id="sbu" name="sbu" required>
                                    <option selected disabled>Pilih Satu..</option>
                                    <?php foreach($rowsbu as $data){ ?>
                                    <option value="<?=$data['kode']?>"><?=$data['kode']?></option>
                                    <?php } ?>
                                </select>
                            </div> -->
                        </div><!-- /.box-body -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Tutup</button>
                            <button type="submit" class="btn btn-primary"><i class="fa fa-send"></i> Update</button>
                        </div>                           
                </div>
            </form>      
            </div>
        </div>
    </div>
    <script src="<?php echo base_url();?>assets/js/jquery-1.10.0.min.js" type="text/javascript"></script>
    <script type="text/javascript" >
        $(document).on("click","#updateJail",function(){
            var id = $(this).data('id');
            var kode = $(this).data('kode');
            var nama = $(this).data('nama');
            var jab = $(this).data('jab');
            var sbu = $(this).data('sbu');

            $("#ubahJail #idjail").val(id);
            $("#ubahJail #kodejail").val(kode);
            $("#ubahJail #namajail").val(nama);
            $("#ubahJail #jabatan").val(jab);
            $("#ubahJail #sbu").val(sbu);
        });
    </script>
<!-- ./ Edit Sub Unit Modal -->