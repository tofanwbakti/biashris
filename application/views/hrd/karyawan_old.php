<!-- DASHBOARD Karyawan LIST -->
<!-- ditampilkan hanya untuk anggota HR Departement -->
<!-- ================================================ -->
<script src="<?=base_url();?>assets/js/jquery-2.1.1.min.js" type="text/javascript"></script>
<script> // komponenn untuk pengecekan duplikat email
function checkDbEmail() {
	$("#loaderIcon").show();
	jQuery.ajax({
	url: "<?=base_url();?>Hrd/cekDbEmail",
	data:'email='+$("#emailku").val(),
	type: "POST",
	success:function(data){
		$("#emailCheckStatus").html(data);
		$("#loaderIcon").hide();
	},
	error:function (){}
	});
};


</script>
<!-- Breadcumb section -->
<section class="content-header">
    <h1>
        <div class="icon"> 
            <i class="icon fa fa-users" style="margin-right:5px"></i>Manajemen Karyawan
            <small>Pusat Informasi HR Department</small>
        </div>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>Hrd"><i class="fa fa-dashboard"></i> Central Info HR</a></li>
        <li><a href="<?php echo base_url();?>Hrd/karyawan"><i class="fa fa-user"></i> Karyawan</a></li>
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
            Berikut Daftar Karyawan di Bias Mandiri Group
        </div><!-- /.box-body -->
        <!-- <div class="box-footer">
            <small><i>Pastikan sudah memiliki <strong><a href="<?=site_url('Hrd/kontrak')?>">Kontrak Kerja</a></strong> untuk penambahan karyawan baru !</i></small>
        </div> -->
        <!-- /.box-footer-->
    </div>
<!-- /.box -->

<!-- Flash Data -->
<div class="karyflash" data-flashdata="<?=$this->session->flashdata('flash'); ?>"></div>
<!-- ./ Flash Data -->

<div class="row">
    <div class="col-xs-12">
        <!-- Nav Tabs -->
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs" role="tablist">
                <li class="active"><a href="#karAktif" data-toggle="tab"><i class="fa fa-user"></i> Karyawan Aktif </a></li>
                <li class=""><a href="#karEoc" data-toggle="tab"><i class="fa  fa-user-times"></i> Karyawan EOC </a></li>
            </ul>
            
            <div class="tab-content">
                <!-- tab content -->
                <div class="tab-pane active" id="karAktif">
                    <div class="box">
                        <div class="box-header">
                        <h2 class="box-title"> Daftar Karyawan Aktif</h2>
                            <div class="pull-right">
                                <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#addModal"><i class="fa fa-user-plus"></i>
                                    Tambah</button>
                            </div>
                        </div>
                        <div class="box-body table-responsive">
                            <table id="tablehistory" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>NIP</th>
                                    <th>Nama</th>
                                    <th>L/P</th>
                                    <th>Alamat</th>
                                    <th>Telp.</th>
                                    <th width="25px">Status</th>
                                    <th width="25px">Negara</th>
                                    <th width="25px" >Jabatan</th>
                                    <th>SBU</th>
                                    <!-- <th class="text-center">Action</th> -->
                                </tr>
                                </thead>
                                <tbody>
                                <?php $no = 1;
                                foreach($rowkar as $data){ ?>
                                <tr <?= $data['stat_kar'] == "T" ? "class='info'" : null?>>
                                    <td><?=$no++ ?></td>
                                    <td><?php $email = $data['email'];
                                    $this->db->select('*');
                                    $this->db->from('tb_kontrak');
                                    $this->db->where('email',$email); 
                                    $this->db->where('status','Y');                            
                                    $query =  $this->db->get();
                                    foreach($query->result() as $row){
                                        echo $row->nip;
                                    }
                                    ?></td>
                                    <td><?php echo $data['fullname']; 
                                    if($data['id_jab'] != "J000" ) echo "<a href='".site_url('Hrd/infoKar/').encrypt_url($data['id_kar'])."' class='pull-right' data-tooltip='tooltip' title='Detail'><i class='icon fa fa-question-circle'></i></a>"; ?> </td>
                                    <td><?=$data['genre'] ?> </td>
                                    <td><?=$data['alamat'] ?> </td>
                                    <td><?=$data['telp'] ?> </td>
                                    <td><?php if($data['martial'] == "1") echo "Menikah"; else echo "Belum Menikah"; ?> </td>
                                    <td><?=$data['negara'] ?> </td>
                                    <td><?=$data['nama_jab'] ?> </td>
                                    <td><?=$data['kode'] ?> </td>
                                    
                                    <!-- <td>
                                    
                                    <a href="#" class="text-success" data-tooltip="tooltip" title="Edit"><i class="icon fa fa-edit"></i></a>
                                    </td> -->
                                </tr>
                                <?php } ?>
                                
                                </tbody>
                            </table>
                        </div>
                    </div> <!-- ./ Tab box -->
                </div>
                <div class="tab-pane" id="karEoc">
                    <div class="box">
                        <div class="box-header">
                            <h2 class="box-title"> Daftar Karyawan EOC</h2>
                        </div>
                        <div class="box-body table-responsive">
                            <table id="tablehistory2" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th width="10px">NIP</th>
                                    <th>Nama</th>
                                    <th width="10px">Jabatan</th>
                                    <th width="10px">SBU</th>
                                    <th>Tgl EOC</th>
                                    <th width="200px">Alasan</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $no = 1;
                                foreach($rowkareoc as $data){ ?>
                                <tr>
                                    <td><?=$no++ ?></td>
                                    <td width="10px"><?php $email = $data['email'];
                                    $this->db->select('*');
                                    $this->db->from('tb_kontrak');
                                    $this->db->join('tb_karyawan','tb_karyawan.email=tb_kontrak.email','left');
                                    $this->db->where('tb_kontrak.email',$email); 
                                    $this->db->where('tb_karyawan.stat_kar','F');                           
                                    $this->db->where('tb_kontrak.kontrak','F');
                                    $this->db->limit(1);
                                    $this->db->order_by('tb_kontrak.id_kon','DESC');                           
                                    $query =  $this->db->get();
                                    foreach($query->result() as $row){
                                        echo $row->nip;
                                    }
                                    ?></td>
                                    <td><?php echo $data['fullname']?></td>
                                    <td><?=$data['nama_jab'] ?> </td>
                                    <td><?=$data['kode'] ?> </td>
                                    <td>
                                    <?php $email = $data['email'];
                                    $this->db->select('*');
                                    $this->db->from('tb_kontrak_eoc');
                                    $this->db->where('email',$email); 
                                    $this->db->order_by('id_eoc','DESC');
                                    $this->db->limit(1);                            
                                    $query =  $this->db->get();
                                    foreach($query->result() as $row){ 
                                        echo date("d M Y",strtotime($row->tgl));
                                    } ?>
                                    </td>
                                    <td><?=$row->alasan?> </td>
                                </tr>
                                <?php } ?>                                
                                </tbody>
                            </table>
                        </div>
                    </div> <!-- Tab box -->
                </div> <!-- Tab pane -->
            </div> <!-- Tab Content -->
        </div>
    </div>
</div><!-- row -->

</section>
<!-- /.content -->

<!-- Modal Tambah Data -->
    <div id="addModal" class="modal fade"role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"> <i class="fa fa-tags text-primary"></i>  Entry Karyawan Baru</h4>
                </div>
                <div class="modal-body">
                <?php echo form_open_multipart('Hrd/addKar') ?>
                <!-- Box Kontrak -->
                    <div class="box box-danger">
                    <?php 
                        $bl = gmdate("md", time()+60*60*7);
                        $th = substr(gmdate("Y", time()+60*60*7),2);
                        $prefix = $th.$bl; // variable pertama tahun bulan tanggal
                        foreach ($rownip as $data){                     
                            $ngurut= sprintf("%02s",$data['no_urut'] + 1) ; //variable ke dua untuk urutan
                        }
                    ?>  
                        <div class="box-body">
                            <div class="form-inline">
                                <!-- <label for="nip" style="text-align:center">NIP</label> <small class="text-danger">*</small> -->
                                <!-- <div class="input-group"> -->
                                    <input type="hidden" name="urutan" value="<?=$ngurut?>">
                                    <input type="text" class="form-control" value="NIP  :" readonly  style="width:220px;font-size:30px;text-align:right;border:0px;background:white">
                                    <input type="text" class="form-control" id="nip" name="nip" value="<?=$prefix.$ngurut?>" readonly  style="width:200px;font-size:30px;text-align:left;border:0px;background:white;margin-bottom:5px">
                                    <!-- <div class="input-group-addon">
                                    <i class="fa fa-barcode"></i>
                                    </div>
                                </div> -->
                            </div> 
                            <div class="form-group" id="sandbox-tanggal" >
                                <label for="tglmulai" >Mulai Kontrak </label> <small class="text-danger"> *</small> 
                                <label for="tglakhir" style="margin-left:100px" >Akhir Kontrak </label> <small class="text-danger"> *</small> 
                                <label for="tglakhir" style="margin-left:100px" >Durasi Kontrak </label> <small class="text-danger"> *</small> 
                                <div class="form-inline">
                                    <div class="input-group date" id="tgl1">
                                        <input type="text" class="form-control datepicker" name="tglmulai"  id="tglmulai" readonly placeholder="Tgl.." style="width:150px">
                                        <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                        </div>
                                    </div>
                                    <div class="input-group date" id="tgl2">
                                        <input type="text" class="form-control datepicker" name="tglakhir" id="tglakhir" readonly placeholder="Tgl.." style="margin-left:5px;width:150px">
                                        <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                        </div>
                                    </div>
                                    <div class="input-group" style="margin-left:5px">
                                        <input type="text" class="form-control" id="selisih" name="selisih" style="width:95px" placeholder="Durasi.." readonly required>
                                        <div class="input-group-addon"> Bulan</div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group" style="margin-top:10px">
                                <label for="grup" >Grup</label> <small class="text-danger">*</small>
                                <label for="sbu" style="margin-left:50px">SBU</label> <small class="text-danger">*</small>
                                <label for="subunit" style="margin-left:60px">Sub Unit</label> <small class="text-danger">*</small>
                                <div class="form-inline">
                                    <select class="form-control" id="grup" name="grup" required style="width:90px">
                                        <option selected disabled>Pilih..</option>
                                        <?php foreach($rowgrup as $data){ ?>
                                        <option value="<?=$data['id_grup']?>"><?=$data['kode_grup']?></option>
                                        <?php } ?>
                                    </select>
                                    <select class="sbu form-control" id="sbu" name="sbu" required style="width:90px;margin-left:5px">
                                        <option selected disabled>Pilih..</option>
                                        <!-- <?php foreach($rowsbu as $data){ ?>
                                        <option value="<?=$data['kode']?>"><?=$data['kode']?></option>
                                        <?php } ?> -->
                                    </select>
                                    <select class="subunit form-control" id="subunit" name="subunit" required style="width:350px;margin-left:5px">
                                        <option selected disabled>Pilih Satu..</option>
                                    </select>
                                    <small class="text-muted" id="text_sub" style="margin-left:200px"><a href="<?=site_url('Hrd/sbu')?>">Klik disini jika data kosong/tidak ada</a></small>
                                </div>                                    
                            </div>
                            <div class="form-group" style="margin-top:10px">
                                <label for="level">Level Jabatan</label> <small class="text-danger">*</small>
                                <label for="dejab" style="margin-left:105px">Jabatan</label><small class="text-danger">*</small>
                                <div class="form-inline">
                                    <select class="form-control" name="level" id="level" style="width:190px" required>
                                        <option selected disabled>Pilih Satu..</option>
                                        <?php foreach ($rowjab as $data) {?>
                                            <option value="<?=$data['id_jab']?>"><?=$data['nama_jab']?></option>
                                        <?php } ?>
                                    </select> 
                                    <select  class="dejab form-control" name="dejab" id="dejab" style="width:350px;margin-left:5px" required>
                                        <option value="">Pilih Satu..</option>
                                    </select>
                                    <small class="text-muted" id="text_jab" style="margin-left:200px"><a href="<?=site_url('Hrd/jabatan')?>">Klik disini jika data kosong/tidak ada</a></small>
                                </div>                                    
                            </div>                                
                        </div><!-- ./Box body -->
                    </div><!-- ./Box Kontrak -->
                    <!-- Box Karyawan -->
                    <div class="box box-primary">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="fullname">Nama Lengkap</label> <small class="text-danger">*</small>
                                <label for="nickname" style="margin-left:200px">Nama Panggilan</label> <small class="text-danger">*</small>
                                <div class="form-inline">
                                    <div class="input-group" style="margin-right:5px">
                                        <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Nama Lengkap.." style="width:270px" required>
                                        <div class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                        </div>
                                    </div>
                                    <div class="input-group">
                                        <input type="text" class="form-control pull-right" id="nickname" name="nickname" style="width:200px" placeholder="Nama Panggilan.." onkeyup="isiNamaFoto();" required>
                                        <div class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                        </div>
                                    </div>
                                    <!-- <input type="hidden" class="form-control pull-right" id="gabung" name="gabung" style="width:200px" placeholder="Nama foto.." > -->
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="emailku">Email</label> <small class="text-danger">*</small>
                                <label for="telpon" style="margin-left:265px">Nomor Telp.</label> <small class="text-danger">*</small>
                                <div class="form-inline">
                                    <div class="input-group" style="margin-right:5px">
                                        <input type="email" class="form-control" id="emailku" name="emailku" placeholder="Email.." onblur="checkDbEmail()" style="width:265px" data-validate= "Email tidak valid (cth: ex@abc.xyz)" required>
                                        <div class="input-group-addon">
                                        <i class="fa fa-at"></i>
                                        </div>
                                    </div>
                                    <div class="input-group" >
                                        <input type="number" class="form-control" id="telpon" name="telpon" placeholder="Nomor Telp.." style="width:203px" required>
                                        <div class="input-group-addon">
                                        <i class="fa fa-phone"></i>
                                        </div>
                                    </div>
                                </div>
                                <span id="emailCheckStatus"></span><span class="text-warning" ></span>
                                <p><img src="<?=base_url();?>assets/images/48x48.gif" id="loaderIcon" style="display:none"></p>
                            </div>
                            <div class="form-group">
                                <label for="genre">Jenis Kelamin</label> <small class="text-danger">*</small>
                                <label style="margin-left:45px" for="status">Status</label> <small class="text-danger">*</small>
                                <label for="keluarga" style="margin-left: 100px">Keluarga</label> <small class="text-danger">*</small>
                                <label for="pendidikan" style="margin-left:40px">Pendidikan</label> <small class="text-danger">*</small>
                                <div class="form-inline">
                                    <select class="form-control" style="width:145px" name="genre" id="genre">
                                        <option selected disabled>Pilih Satu..</option>
                                        <option value="L">Laki-Laki</option>
                                        <option value="P">Perempuan</option>
                                    </select>
                                    <select class="form-control" style="width:150px; margin-left:5px" name="status" id="status">
                                        <option selected disabled>Pilih Satu..</option>
                                        <option value="1">Menikah</option>
                                        <option value="2">Belum Menikah</option>
                                    </select>
                                    <select class="form-control" style="width:105px; margin-left:5px" name="keluarga" id="keluarga">
                                        <option selected disabled>Pilih ..</option>
                                        <option value="TK">TK</option>
                                        <option value="K0">K0</option>
                                        <option value="K1">K1</option>
                                        <option value="K2">K2</option>
                                        <option value="K3">K3</option>
                                        <option value="K4">K4</option>
                                        <option value="K5">K5</option>
                                    </select>
                                    <select class="form-control" style="width:120px; margin-left:5px" name="pendidikan" id="pendidikan">
                                        <option selected disabled>Pilih..</option>
                                        <?php foreach($rowedu as $data){ ?>
                                        <option value="<?=$data['kode_edu']?>"><?=$data['kode_edu']?></option>
                                        <?php } ?>
                                    </select>                                    
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="agama" >Agama</label> <small class="text-danger">*</small>
                                <label for="tempat" style="margin-left:95px">Tempat Lahir</label> <small class="text-danger">*</small>
                                <label for="tgllahir" style="margin-left:60px">Tanggal Lahir</label> <small class="text-danger">*</small>
                                <div class="form-inline">
                                    <select class="form-control" name="agama" id="agama" style="width:145px" required>
                                        <option selected disabled>Pilih Satu..</option>
                                        <option value="Islam" >Islam</option>
                                        <option value="Katolik" >Katolik</option>
                                        <option value="Protestan" >Protestan</option>
                                        <option value="Budha" >Budha</option>
                                        <option value="Hindu" >Hindu</option>
                                        <option value="Lainnya" >Lainnya</option>
                                    </select> 
                                    <div class="input-group" style="margin-left:5px">
                                        <input type="text" class="form-control" id="tempat" name="tempat" placeholder="Tempat Lahir.." style="width:115px" required>
                                        <div class="input-group-addon">
                                        <i class="fa fa-globe"></i>
                                        </div>
                                    </div>
                                    <div class="form-group" id="sandbox-tanggal" style="margin-left:5px">
                                        <div class="input-group date" id="tgllahir">
                                            <input type="text" class="form-control datepicker" name="tgllahir"  id="tgllahir" readonly placeholder="Tgl Lahir.." style="width:195px">
                                            <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                            </div>
                                        </div>
                                    </div>                                    
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat</label> <small class="text-danger">*</small>        
                                <label for="negara" style="margin-left: 255px">Warga Negara</label> <small class="text-danger">*</small>
                                <!-- <label for="statkar" style="margin-left:80px">Status Karyawan</label> <small class="text-danger">*</small> -->
                                <div class="form-inline">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat.." style="width:270px" required>
                                        <div class="input-group-addon">
                                        <i class="fa fa-map-marker"></i>
                                        </div>
                                    </div>
                                    <div class="input-group" style="margin-left:5px">
                                        <input type="text" class="form-control" id="negara" name="negara" style="width:200px" placeholder="Warga Negara.." required>
                                        <div class="input-group-addon">
                                        <i class="fa fa-globe"></i>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                            <div class="form-group">
                                <label for="filefoto">Foto</label>
                                <input type="file" name="filefoto" class="dropify" data-height="250">
                            </div>
                        </div><!-- Box Karyawan -->
                        <div class="modal-footer">
                            <button type="reset" class="btn btn-default pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Tutup</button>
                            <button type="submit" name="submit" class="btn btn-primary"><i class="fa fa-send"></i> Simpan</button>
                        </div> 
                    <?php echo form_close() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- MEnghitung Selisih Tanggal -->
    <script>
        $(document).ready(function(){
            $('#grup').change(function(){
                var id = $(this).val();
                $.ajax({
                    url : "<?php echo base_url();?>index.php/Hrd/cariSbu",
                    method : "POST",
                    data : {id: id},
                    async : false,
                    dataType : 'json',
                    success : function(data){
                        var html = '<option selected disabled>Pilih..</option>';
                        var i;
                        for(i=0; i<data.length; i++){
                            html += '<option value='+data[i].kode+'>'+data[i].kode+'</option>';
                        }
                        $('.sbu').html(html);
                        // $('#text_sub').show();
                    }
                });
            });
        });

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
                        var html = '<option selected disabled>Pilih Satu..</option>';
                        var i;
                        for(i=0; i<data.length; i++){
                            html += '<option value='+data[i].sub+'>'+data[i].namasub+'</option>';
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
                        var html = '<option selected disabled>Pilih..</option>';
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
        };
        
        // function isiNamaFoto(){
        //     var nip = document.getElementById('nip').value;
        //     var nama = document.getElementById('nickname').value;

        //     document.getElementById('gabung').value = nama+'_'+nip;
        // }
    </script>
<!-- ./Modal Tambah Data -->

<!-- Modal Detail EOC -->
    <div class="modal fade" id="detailEoc" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="modalLabel">Modal Title</h4>
                </div>
                <div class="modal-body">
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
<!-- ./ Modal Detail EOC -->