<!-- Halaman Absensi Karyawan -->
<!-- ditampilkan untuk HRD -->
<!-- ================================================ -->
<!-- Validasi Cek Kartu-->
<script src="<?=base_url();?>assets/js/jquery-2.1.1.min.js" type="text/javascript"></script>
<script type="text/javascript">
    // Untuk Proses pencarian RFID
    function cekKartu(){
    $("#loaderIcon").show();
    jQuery.ajax({
        url     : "<?= site_url('Hrd/cekKartuId')?>",
        data    : 'id_kartu='+$("#rfid").val(),
        type    : "POST",
        success : function(data){
            $("#hasilCheck").html(data);
            $("#loaderIcon").hide();
        },
        error:function(){}
    });
}    
</script>
<!-- Breadcumb section -->
<section class="content-header">
    <h1> 
        <div class="icon">
            <i class="fa fa-credit-card" ></i>
                Daftar Kartu ID
                <!-- <small>Selamat Datang</small> -->
        </div>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
</section>

<!-- FLASH DATA -->
<div class="flash-unit" data-flashdata="<?=$this->session->flashdata('flash'); ?>"></div>
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
            Berikut Daftar Kartu ID karyawan di Bias Mandiri Group
        </div>
    </div>
    <!-- /.box -->


    <div class="row">
    <!-- Col Tombol -->
        <div class="col-lg-12">
        <!-- Box pencarian RFID -->
            <div class="box box-danger">
                <div class="box-header">
                </div>
                <div class="box-body">
                	<form action="<?=site_url('Hrd/regKartu')?>" method="post">
                        <div class="form-inline">
                            <select name="id_kar" id="id_kar" class="form-control" style="width:40%;height:60px;font-size:15px;margin-left:10px" >
                                <option value=""selected disabled> Pilih Satu Karyawan..</option>
                                <?php foreach ($rowusrall as $data) {?>
                                    <option value="<?=$data['id_kar']?>" ><?=$data['email']?></option>
                                <?php } ?>
                            </select>
                            <div class="input-group" style="width:48%;margin-top:10px">
                                <input type="text" name="rfid" id="rfid" class="form-control"  placeholder="Scan Kartu.." style="height:60px;font-size:30px;margin-left:10px" onblur="cekKartu()" required>
                                <div class="input-group-addon">
                                <i class="fa fa-credit-card-alt" style="font-size:30px"></i>
                                </div>
                            </div>
                            <!-- <button type="reset" id="reset" onclick="location.reload()" class="btn btn-app" style="margin-top:10px"><i class="fa fa-repeat" style="margin-left:5px;font-size:30px"></i></button>                 -->
                            
                            <button type="submit" id="submit"  class="btn btn-app" style="margin-top:10px"><i class="fa fa-check-square-o text-green" style="margin-left:5px;font-size:30px"></i></button>
                        </div>
                        <p><span id="hasilCheck"></span><img src="<?=base_url();?>assets/images/48x48.gif" id="loaderIcon" style="display:none"></<img> </p>
                    </form>
                </div>
            </div>
        <!-- ./ Box pencarian RFID -->
        </div>
    </div>
    <!-- row table -->
    <div class="row">
        <div class="col-lg-8">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Daftar Kartu ID Aktif</h3>
                </div>
            <div class="box-body table-responsive">
                <table id="tablehistory" class="table table-bordered table-striped">
                    <thead class="">
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>No Kartu ID</th>
                            <th>Tgl Daftar</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody class="">
                    <?php $no=1;
                    foreach($rowCard as $data) { ?>
                        <tr class="">
                            <td><?=$no++ ?></td>
                            <td><?=$data['fullname'] ?></td>
                            <td><?=$data['id_kartu'] ?></td>
                            <td><?=date("d M Y",strtotime($data['addtgl'])) ?></td>
                            <td><a href="<?=site_url('Hrd/delKartu/').encrypt_url($data['id_kartu']) ?>"><i class="fa fa-trash"></i></a></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
            </div>
        </div>
        <!-- Col Table ke 2 -->
        <div class="col-lg-4">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Kartu Baru <?=date("F") ?> </h3>
                </div>
                <div class="box-body table-responsive">
                    <table id="table3" class="table table-bordered table-striped">
                        <thead>
                            <tr class="">
                                <th>No</th>
                                <th>No Kartu ID</th>
                                <th>Tgl</th>
                            </tr>
                        </thead>
                        <tbody class="">
                        <?php $no = 1; 
                        foreach($cardSort as $data) { ?>
                            <tr class="">
                                <td><?= $no++ ?></td>
                                <td><?=$data['id_kartu'] ?></td>
                                <td><?=date("d M Y",strtotime($data['addtgl'])) ?></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    

</section>


