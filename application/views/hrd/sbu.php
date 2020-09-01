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
                <h3 class="box-title">Daftar SBU</h3>
                <div class="pull-right">
                    <button type="button" class="btn btn-danger btn-xs" data-toggle="collapse" data-target="#addUnit"><i class="fa fa-plus-square"></i>  Tambah</button>
                </div>
                <div class="collapse" id="addUnit" style="margin-top:15px">
                    <form action="<?=site_url('Hrd/addSbu') ?>" method="post" class="form-inline">
                        <div class="form-group">
                            <input type="text" class="form-control" name ="kodesbu" onkeyup="this.value = this.value.toUpperCase()" style="width:50px;height:30px" placeholder="SBU" required>
                        </div>
                        <div class="form-group">
                            <input type="text" name="namasbu" class="form-control" style="width:210px;height:30px;margin-left:3px" placeholder="Nama SBU.."  required>
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
                                $this->db->where('sub_unt',$data['sub']);
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
                                <label for="sbu">Pilih SBU:</label>
                                <select class="form-control" id="sbu" name="sbu" required>
                                    <option selected disabled>Pilih Satu..</option>
                                    <?php foreach($rowsbu as $data){ ?>
                                    <option value="<?=$data['kode']?>"><?=$data['kode']?> - <?=$data['nama']?></option>
                                    <?php } ?>
                                </select>
                            </div>
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
                                    <input type="text" class="form-control" id="namasub" name="namasub" placeholder="Deskripsi Sub Unit.." required>
                                    <div class="input-group-addon">
                                    <i class="fa fa-tags"></i>
                                    </div>
                                </div>
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
                                    <input type="text" class="form-control" id="namasub" name="namasub" placeholder="Deskripsi Sub Unit.." required>
                                    <div class="input-group-addon">
                                    <i class="fa fa-tags"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="sbu">Pilih Level:</label>
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
                            <button type="submit" class="btn btn-primary"><i class="fa fa-send"></i> Update</button>
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