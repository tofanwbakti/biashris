<!-- DASHBOARD Departemen -->
<!-- ditampilkan hanya untuk anggota HR Departement -->
<!-- ================================================ -->
<!-- Breadcumb section -->
<section class="content-header">
    <h1>
        Daftar Departemen
        <small>Pusat Informasi HRD</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>Hrd"><i class="fa fa-dashboard"></i> Central Info HR</a></li>
        <li><a href="#"><i class="fa fa-circle-o"></i> Departemen</a></li>
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
            Berikut Daftar Departemen di Bias Mandiri Group
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
<!-- /. Flash data -->

<!-- Table -->
    <div class="row">
        <div class="col-md-4">
            <div class="box box-danger">
                <div class="box-header">
                    <h3 class="box-title">Daftar Sub Unit</h3>
                    
                </div><!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-responsive" id="table3">
                            <thead>
                                <tr>
                                    <!-- <th>No</th> -->
                                    <th>Sub Unit</th>
                                    <th>SBU</th>
                                    <th>Dept</th>
                                </tr>
                            </thead>
                            <?php 
                            $no = 1;
                            foreach($rowsub as $data){ ?>
                            <tr class="">
                                <!-- <td><?= $no ++; ?></td> -->
                                <td><a href="javascript:void(0)" data-toggle="tooltip" data-placement="right" title="<?=$data['namasub']?>"><?=$data['sub']?></a></td>
                                <td class="text-center"><?=$data['kode']?></td>
                                <td class="text-center"><?php 
                                    $this->db->where('id_sub',$data['id_sub']);
                                    $this->db->from('tb_departemen');
                                    echo $this->db->count_all_results(); ?></td>
                            </tr>
                            <?php } ?>
                            <tbody>
                            
                            </tbody>
                        </table>
                    </div>
                </div><!-- /.box-body -->
            
            </div><!-- /.box -->
        </div><!-- /.col -->
        
        <div class="col-md-8">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Daftar Departemen Aktif </h3>
                    <div class="pull-right">
                        <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#tambah"><i class="fa fa-plus-square"></i>  Tambah</button>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body ">
                    <div class="table-responsive no-padding">
                        <table class="table table-hover" id="tablehistory">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode</th>
                                    <th>Detail Departemen</th>
                                    <th>Total Kar.</th>
                                    <!-- <th>SBU</th> -->
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $no = 1;
                            foreach($rowdept as $data) { ?>
                                <tr class="">
                                    <td><?=$no++;?></td>
                                    <td><?=$data['kode_dept'] ?></td>
                                    <td><?=$data['nama_dept'] ?></td>
                                    <td class="text-center"><?php 
                                    $this->db->where('id_dept',$data['id_dept']);
                                    $this->db->from('tb_karyawan');
                                    echo $this->db->count_all_results(); ?></td>
                                    <td class="text-center">
                                        <a href="#" id="update" data-toggle="modal" data-target="#editDept" data-id="<?=$data['id_dept'] ?>" data-kode="<?=$data['kode_dept'] ?>" data-nama="<?=$data['nama_dept'] ?>" data-sub="<?=$data['id_sub'] ?>" ><i class="icon fa fa-edit text-info"></i></a>
                                        <a href="<?=site_url('Hrd/delDept/').encrypt_url($data['id_dept']) ?>" class="tombol-del"><i class="icon fa fa-trash text-info"></i></a>
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
<!-- /. Table -->
</section>
<!-- /.content -->

<!-- MODAL -->
    <!-- Add DEtail Jabatan Modal -->
        <div id= "tambah" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                <form role="form" action="<?= site_url('Hrd/addDept') ?>" method="POST">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"> <i class="fa fa-tags text-primary"></i>  Tambah Departemen</h4>
                    </div>
                    
                    <div class="modal-body">                
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="iddept">Id Departemen</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="iddept" name="iddept" value="<?=$idDept;?>" readonly>
                                        <div class="input-group-addon">
                                        <i class="fa fa-tags"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="kodedept" >Kode Departemen</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="kodedept" name="kodedept" placeholder="Deskripsi Kode Departemen.." onkeyup="this.value = this.value.toUpperCase()" required>
                                        <div class="input-group-addon">
                                        <i class="fa fa-tags"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="namadept" >Deskripsi Departemen</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="namadept" name="namadept" placeholder="Deskripsi Detail Departemen.." onkeyup="this.value = this.value.toUpperCase()" required>
                                        <div class="input-group-addon">
                                        <i class="fa fa-tags"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="subunit">Sub Unit</label>
                                    <select class="form-control" id="subunit" name="subunit" required>
                                        <option selected disabled>Pilih Satu..</option>
                                        <?php  
                                        foreach($rowsub as $data){ ?>
                                        <option value="<?=$data['id_sub']?>"><?=$data['namasub']?></option>
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

    <!-- Edit Departemen -->
        <div id= "editDept" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"> <i class="fa fa-tags text-primary"></i>  Edit Detail Departemen</h4>
                    </div>
                <form role="form" action="<?=site_url('Hrd/updateDept')?>" method="POST">
                    <div class="modal-body" id="ubahDept">                
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="kodedept">Kode Departemen</label>
                                    <div class="input-group">
                                        <input type="hidden" class="form-control" id="iddept" name="iddept" >
                                        <input type="text" class="form-control" id="kodedept" name="kodedept" onkeyup="this.value = this.value.toUpperCase()" required>
                                        <div class="input-group-addon">
                                        <i class="fa fa-tags"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="namadept" >Deskripsi Detail Departemen</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="namadept" name="namadept" onkeyup="this.value = this.value.toUpperCase()" placeholder="Deskripsi Departemen.." required>
                                        <div class="input-group-addon">
                                        <i class="fa fa-tags"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="subunit">Sub Unit</label>
                                    <select class="form-control" id="subunit" name="subunit" required>
                                        <option selected disabled>Pilih Satu..</option>
                                        <?php  
                                        foreach($rowsub as $data){ ?>
                                        <option value="<?=$data['id_sub']?>"><?=$data['namasub']?></option>
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
            $(document).on("click","#update",function(){
                var id = $(this).data('id');
                var kode = $(this).data('kode');
                var nama = $(this).data('nama');
                var sub = $(this).data('sub');

                $("#ubahDept #iddept").val(id);
                $("#ubahDept #kodedept").val(kode);
                $("#ubahDept #namadept").val(nama);
                $("#ubahDept #subunit").val(sub);
            })
        </script>
    <!-- /. Edit Departemen -->

<!-- ./MODAL -->

