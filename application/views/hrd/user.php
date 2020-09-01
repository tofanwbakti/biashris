<!-- DASHBOARD USER LIST -->
<!-- ditampilkan hanya untuk anggota HR Departement -->
<!-- ================================================ -->
<!-- Breadcumb section -->
<section class="content-header">
    <h1>
        <div class="icon">
            <i class="fa fa-user"></i> Daftar User <small>Pusat Informasi HRD Department</small>
        </div>
        
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>Hrd"><i class="fa fa-dashboard"></i> Central Info HR</a></li>
        <li><a href="<?php echo base_url();?>Hrd/user"><i class="fa fa-user"></i> User List</a></li>
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
            Berikut Daftar User yang dapat menggunakan aplikasi BiasHRIS
        </div><!-- /.box-body -->
        <!-- <div class="box-footer">
            Footer
        </div>/.box-footer -->
    </div>
<!-- /.box -->

<!-- Flash Data -->
<div class="accflash" data-flashdata="<?=$this->session->flashdata('flash'); ?>"></div>
<div class="flash-err" data-flashdata="<?=$this->session->flashdata('flash_error'); ?>"></div>
<?php if($this->session->flashdata('flash_error')) : ?>
    <div class="alert alert-danger alert-dismissable" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon fa fa-ban"></i> Alert!</h4>
        Data <strong>gagal</strong> <?= $this->session->flashdata('flash_error'); ?>, terdapat duplikat data.
    </div>
<?php endif; ?>
<!-- ./ Flash Data -->

<!-- TABLE row -->
    <div class="row">
        <div class="col-md-12">
            <!-- Tables  -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title"> Daftar User</h3>
                    <div class="pull-right">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#adduserModal"><i class="fa fa-user-plus"></i>
                            Tambah</button>
                        <!-- <a href="#tambahUser" class="btn btn-primary" data-toggle="collapse">    
                        <i class="fa fa-user-plus"></i> Ajukan
                        </a> -->
                    </div>
                </div>
                <div class="box-body table-responsive">
                    <table id="tablehistory" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Email</th>
                            <th>Nama</th>
                            <th>Level</th>
                            <!-- <?php if($this->fungsi->user_login()->id_lvl != "A5"){ ?>                            
                                <th> Atasan</th>
                                <th> HRD</th>
                            <?php } ?> -->
                            <th class="text-center">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $no = 1;
                        foreach($rowuser as $data) {?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $data['email'] ?></td>
                            <td><?= $data['fullname'] ?></td>
                            <td><?= $data['level'] ?></td>
                            <td class="text-center" width="180px">
                            <?php if($data['id_uakses'] != "1") {?>
                                <div class="btn-group">
                                    <a href="javascript:void(0)" class="btn btn-default btn-xs" id="edit_pass" data-toggle="modal" data-target="#pwdModal" data-uid="<?= $data['id_uakses'] ?>" data-email="<?= $data['email'] ?>" data-passwd="<?= $data['password'] ?>" style="margin-right:10px"><i class="fa fa-key" data-toggle="tooltip" title="Ganti Password" ></i> </a>
                                    <a href="javascript:void(0)" class="btn btn-warning btn-xs" id="edit_usr" data-toggle="modal" data-target="#editUser" data-uid="<?= $data['id_uakses'] ?>" data-email="<?= $data['email'] ?>" data-ulvl="<?= $data['id_lvl']?>" style="margin-right:10px"><i class="fa fa-edit" data-toggle="tooltip" title="Edit Data" ></i></a>
                                    <a href="<?= site_url('Hrd/hapususer/').encrypt_url($data['id_uakses']) ?>" data-toggle="tooltip" title="Hapus Data" class="btn btn-danger btn-xs tombol-del" id="del_usr"><i class="fa fa-trash"></i></a>                                    
                                    <!-- <a href="#" class="btn btn-danger btn-xs" id="del_usr" data-toggle="modal" data-target="#delUser" data-uid="<?= $data['id_uakses'] ?>"><i class="fa fa-trash"></i> Hapus </a>                                     -->
                                    <!-- <a href="#" onclick="deluser()" class="btn btn-danger btn-xs" id="del_usr" data-uid="<?= $data['id_uakses'] ?>"><i class="fa fa-trash"></i> Hapus </a>                                     -->

                                </div>
                            <?php } ?>
                            </td>
                        </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
                        
            </div>
        </div>
<!-- =========================================================== -->
</section>
<!-- /.content -->
<!-- MODAL ADD -->
    <div id= "adduserModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
            <form role="form" action="<?= site_url('Hrd/tambahuser') ?>" method="POST">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><i class="fa fa-unlock-alt" style="margin-right:5px"></i> Form Tambah User</h4>
                </div>
                <div class="modal-body">                
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email User</label>
                                <div class="input-group">
                                    <!-- <input type="email" class="form-control" id="InputEmail" name="InputEmail" placeholder="Email.." required> -->
                                    <select name="InputEmail" class="form-control" required>
                                    <?php  
                                        foreach($rowakses as $data){ ?>
                                        <option value="<?=$data['email']?>"><?=$data['email']?></option>
                                    <?php } ?>
                                    </select>
                                    <div class="input-group-addon">
                                    <i class="fa fa-envelope"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password" >Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="Password1" name="Password1" placeholder="Password.." required>
                                    <div class="input-group-addon">
                                    <i class="fa fa-unlock-alt"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="level">Pilih Level:</label>
                                <select class="form-control" id="level" name="level" required>
                                <option disable>Pilih Satu..</option>
                                <option>A2</option>
                                <option disabled class="label-danger">A3</option>
                                <option>A4</option>
                                <option>A5</option>
                                <option>SC</option>
                                </select>
                                <h5><small>* A2:Admin | A4:Atasan | A5:Karyawan | SC:Security</small></h5>
                            </div>
                        </div><!-- /.box-body -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Tutup</button>
                            <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Simpan</button>
                        </div>                           
                </div>
            </form>      
            </div>
        </div>
    </div>

<!-- MODAL EdIT -->
<div id= "editUser" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
        <form role="form" method="POST" action="<?= site_url('Hrd/updateuser') ?>">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Form Edit User</h4>
            </div>
            <div class="modal-body" id="dataUser">                
                    <div class="box-body">
                        <div class="form-group">
                            <label for="email">Email User</label>
                            <input type="hidden" id="idakses1" name="idakses1">
                            <div class="input-group">                                
                                <input type="email" class="form-control" id="Email2" name="Email2" placeholder="Email.." readonly>
                                <div class="input-group-addon">
                                <i class="fa fa-envelope"></i>
                                </div>
                            </div>
                        </div>                        
                        <div class="form-group">
                            <label for="level">Pilih Level:</label>
                            <select class="form-control" id="Level" name="Level" >
                            <option disable>Pilih Satu..</option>
                            <option>A2</option>
                            <option disabled class="label-danger">A3</option>
                            <option>A4</option>
                            <option>A5</option>
                            <option>SC</option>
                            </select>
                            <h5><small>* A2:Admin | A4:Atasan | A5:Karyawan | SC:Security</small></h5>
                        </div>
                    </div><!-- /.box-body -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Tutup</button>
                        <button type="submit" class="btn btn-warning"><i class="fa fa-check"></i> Update</button>
                    </div>                             
            </div>
            <script src="<?php echo base_url();?>assets/js/jquery-1.10.0.min.js" type="text/javascript"></script>
            <script type="text/javascript" >
                $(document).on("click","#edit_usr",function(){
                    var id = $(this).data('uid');
                    var email = $(this).data('email');
                    var lev = $(this).data('ulvl');
                    $("#editUser #idakses1").val(id);
                    $("#editUser #Email2").val(email);
                    $("#editUser #Level").val(lev);
                });
            </script>
        </form>
        </div>
    </div>
</div>

<!-- MODAL Ganti PASS -->
<div id= "pwdModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
        <form role="form" action="<?= site_url('Hrd/gantipass') ?>" method="POST">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Ganti Password User</h4>
            </div>
            <div class="modal-body" id="passEdit">                
                    <div class="box-body">
                        <div class="form-group">
                            <label for="email">Email User</label>
                            <input type="hidden" id="idakses2" name="idakses2">
                            <div class="input-group">
                                <input type="email" class="form-control" id="Email3" name="Email3" placeholder="Email.." readonly>
                                <div class="input-group-addon">
                                <i class="fa fa-envelope"></i>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password" >Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="Password2" name="Password2" placeholder="Password.." required>
                                <div class="input-group-addon">
                                <i class="fa fa-unlock-alt"></i>
                                </div>
                            </div>
                        </div>
                        
                    </div><!-- /.box-body -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Tutup</button>
                        <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Update</button>
                    </div>                            
            </div>
            <script src="<?php echo base_url();?>assets/js/jquery-1.10.0.min.js" type="text/javascript"></script>
            <script type="text/javascript" >
                $(document).on("click","#edit_pass",function(){
                    var id = $(this).data('uid');
                    var email = $(this).data('email');
                    var pass = $(this).data('passwd');
                    $("#passEdit #idakses2").val(id);
                    $("#passEdit #Email3").val(email);
                    $("#passEdit #Password2").val(pass);
                });
            </script>
        </form>     
        </div>
    </div>
</div>

<!-- Modal Hapus-->
<!-- <div class="modal fade" id="delUser" role="dialog">
    <div class="modal-dialog modal-sm">
    <div class="modal-content">
        <form action="<?= site_url('Hrd/hapususer') ?>" method="POST">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Hapus User</h4>
            </div>
            <div class="modal-body" id="hapus">
            <p>Kamu yakin menghapus akses akun ini?  </p>
            <input type="hidden" id="idakses3" name="idakses3">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Tutup</button>
                <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> Hapus</button>
            </div> 
            <script src="<?php echo base_url();?>assets/js/jquery-1.10.0.min.js" type="text/javascript"></script>
            <script type="text/javascript" >
                $(document).on("click","#del_usr",function(){
                    var id = $(this).data('uid');
                    $("#hapus #idakses3").val(id);
                });
            </script>
        </form>
      </div>
    </div>
</div>

<!-- Sweet alert -->
<!--<script>
    function deluser(){
        swal("Good job!", "You clicked the button!", "success");
    }
    
</script> -->


