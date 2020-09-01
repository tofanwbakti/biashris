<!-- DASHBOARD USER LIST -->
<!-- ditampilkan hanya untuk anggota HR Departement -->
<!-- ================================================ -->
<!-- Breadcumb section -->
<section class="content-header">
    <h1>
        Daftar User
        <small>Central Informasi HR Department</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>hrd"><i class="fa fa-dashboard"></i> Central Info HR</a></li>
        <li><a href="<?php echo base_url();?>hrd"><i class="fa fa-user"></i> User List</a></li>
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
<!-- TABLE row -->
    <div class="row">
        <div class="col-md-8">
            <!-- Tables  -->
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title"> Daftar User</h3>
                    <div class="pull-right">
                        <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#adduserModal"><i class="fa fa-user-plus"></i>
                            Tambah</button> -->
                        <a href="#tambahUser" class="btn btn-primary" data-toggle="collapse">    
                        <i class="fa fa-user-plus"></i> Ajukan
                        </a>
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
                            <!-- <?php if($this->fungsi->user_login()->id_lvl != "A3"){ ?>                            
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
                                <!-- <a href="#" class="btn btn-warning btn-xs" data-toggle="modal"data-target="#edituserModal"><i class="fa fa-edit"></i> Edit</a>
                                <a href="#" class="btn btn-danger btn-xs" ><i class="fa fa-trash"></i> Hapus</a> -->
                                <div class="btn-group">
                                    <!-- <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#gantiPass" data-id="<?= $data['id_uakses']?>"><i class="fa fa-pencil-square"></i> Password</button> -->
                                    <a href="#gantiPass" id="gantipwd" data-id='<?= $data['id_uakses'] ?>' class="btn btn-default btn-xs" data-toggle="collapse" ><i class="fa fa-edit"></i> Password </a>
                                    <a href="#editUser" class="btn btn-warning btn-xs" data-toggle="collapse" ><i class="fa fa-edit"></i> Edit </a>
                                    <a href="#hapusUser" class="btn btn-danger btn-xs" data-toggle="collapse" ><i class="fa fa-edit"></i> Hapus </a>
                                    <!-- <button type="button" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Hapus</button> -->
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
        <!-- row kanan -->
        <div class="col-md-4">
            <!-- Tables  -->
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title"> Online User</h3>
                    <div class="pull-right">
                        
                    </div>
                </div>                        
            </div>
        </div>
        <!-- /row kanan -->
    <!-- row kanan tambah user-->
        <div class="collapse" id="tambahUser">
            <div class="col-md-4">
                <!-- Tables  -->
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"> Tambah User</h3>
                    </div>  
                    <form action="#" method="post">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email User</label>
                                <div class="input-group">
                                    <input type="email" class="form-control" id="Email" placeholder="Email..">
                                    <div class="input-group-addon">
                                    <i class="fa fa-envelope"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password" >Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="passAdd" placeholder="Password..">
                                    <div class="input-group-addon">
                                    <i class="fa fa-unlock-alt"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="level">Pilih Level:</label>
                                <select class="form-control" id="level">
                                <option disable>Pilih Satu..</option>
                                <option>A2</option>
                                <option>A3</option>
                                <option>A4</option>
                                <option>SC</option>
                                </select>
                                <h5><small>* A2:Admin | A3:Member | A4:Atasan | SC:Security</small></h5>
                            </div>
                        </div><!-- /.box-body -->
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>                      
                </div>
            </div>
        </div>
    <!-- /row kanan tambah user-->

    <!-- row kanan ganti password user-->
        <div class="collapse" id="gantiPass">
            <div class="col-md-4">
                <!-- Tables  -->
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"> Ganti Password User</h3>
                    </div>  
                    <form action="#" method="post">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="password" >Password</label>
                                <input type="text" class="form-control" id="idakses" name="idakses">
                                <div class="input-group">
                                    <input type="password" class="form-control" id="Pass" placeholder="Password..">
                                    <div class="input-group-addon">
                                    <i class="fa fa-unlock-alt"></i>
                                    </div>
                                </div>
                            </div>                            
                        </div><!-- /.box-body -->
                        <div class="modal-footer">                            
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>                      
                </div>
            </div>
        </div>
        
    <!-- /row kanan ganti password user-->

    <!-- row kanan Edit user-->
        <div class="collapse" id="editUser">
            <div class="col-md-4">
                <!-- Tables  -->
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"> Edit User</h3>
                    </div>                        
                </div>
            </div>
        </div>
    <!-- /row kanan edit user-->
    </div>
    <div class="row">
        
    </div>
<!-- =========================================================== -->
</section>
<!-- /.content -->

