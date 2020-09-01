<section class="content-header">
    <h1>
        <div class="icon">
        <i class="fa fa-github"></i> Data Kepegawaian
        <!-- <small>semua berawal dari sini</small> -->
        </div>        
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>Dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"><a href="#"><i class="fa fa-github"></i> Kepegawaian</a></li>

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
            Berikut ini informasi data kepegawaian kamu.
        </div><!-- /.box-body -->
        <!-- <div class="box-footer">
            Footer
        </div>/.box-footer -->
    </div>
<!-- /.box -->

<!--  Flash Data -->

<!-- /. Flash Data -->

    <div class="row">
        <!-- left column -->
        <div class="col-md-2">
            <!-- general form elements -->
            <div class="box box-danger">
                <div class="box-header with-border" style="text-align:center" >
                    <h3 class="box-title"><strong><?=$this->fungsi->user_login()->fullname ?></strong></h3>
                </div><!-- /.box-header -->
                <div class="small-box" style="text-align:center">
                <img style="width:150px;height:relative" src="<?php echo base_url();?>uploads/image/<?=$this->fungsi->user_login()->foto ?>" class="img-thumbnail"  alt="User Image" />
                    <a href="javascript:void(0);" class="small-box-footer" style="color:blue" "><strong>
                    <?php foreach($rownip as $data) echo $data['nip']; ?></strong> <i class="fa fa-arrow-circle-right text-primary"></i>
                    </a>
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
                        <label class="acc-kontainer-label" for="acc1"><i class="fa fa-chevron-circle-right"></i> Data Kepegawaian </label>
                        <div class="acc-body table-responsive">
                            <div class="pull-left">
                                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#hisPeg"><i class="icon fa fa-info-circle"></i>  Histori Jabatan</button>
                            </div>
                            <!-- DATA Kepegawaian -->
                            <table class="table table-borderless">                                
                                <tbody>
                                    <tr>
                                        <td width="170px" >NIP</td>
                                        <td width="10px">:</td>
                                        <td><a href="javascript:void(0);" class="custom"><strong><?php foreach($rownip as $data) echo $data['nip']; ?></strong></a></td> 
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
                                        <td><a href="javascript:void(0);" class="custom"><?php foreach($rowkar as $data) if($data['stat_kar'] == "T") echo "Tetap"; else echo "Kontrak"; ?></a></td> 
                                    </tr>
                                    <tr>
                                        <td >Tanggal Bergabung</td>
                                        <td>:</td>
                                        <td><a href="javascript:void(0);" class="custom"><?php foreach($rownip as $data) echo date("d F Y",strtotime($data['start'])); ?></a></td> 
                                    </tr>
                                    <tr>
                                        <td >SBU</td>
                                        <td>:</td>
                                        <td><a href="javascript:void(0);" class="custom"><?php foreach($rowkar as $data) echo $data['kode']; ?></a></td>
                                    </tr>
                                    <tr>
                                        <td >Sub Unit</td>
                                        <td>:</td>
                                        <td><a href="javascript:void(0);" class="custom"><?php foreach($rowkar as $data) echo $data['sub_unt']; ?></a></td>
                                    </tr>
                                    <tr>
                                        <td >Departemen</td>
                                        <td>:</td>
                                        <td><a href="javascript:void(0);" class="custom"><?php foreach($rowkar as $data) echo $data['nama_dept']; ?></a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div><!-- ./ Accordion#1  -->
                    <!-- Accordion#2  -->
                    <div>
                        <input class="acc-kontainer-input" type="radio" name="acc" id="acc2">
                        <label class="acc-kontainer-label" for="acc2"><i class="fa fa-chevron-circle-right"></i> Kontrak Kerja </label>
                        <div class="acc-body table-responsive">
                            <div class="pull-left">
                                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#histKon"><i class="icon fa fa-info-circle"></i>  Histori Kontrak</button>
                            </div>
                            <table class="table table-borderless">                                
                                <tbody>
                                    <tr>
                                        <td width="120px" >PKWT</td>
                                        <td width="10px">:</td>
                                        <td><a href="javascript:void(0);" class="custom"> Ke - <?php foreach($rownip as $data) echo $data['periodepkwt']; ?></a></td> 
                                    </tr>                                    
                                    <tr>
                                        <td >Status PKWT</td>
                                        <td>:</td>
                                        <td><a href="javascript:void(0);" class="custom"><?php foreach ($rownip  as $data) if($data['kontrak'] == "N") echo "BARU"; elseif($data['kontrak'] == "R") echo "PERPANJANGAN"; elseif($data['kontrak'] == "P") echo "TETAP"; else echo "FINISH"; ?></a></td> 
                                    </tr>
                                    <tr>
                                        <td>Periode </td></td>
                                        <td>:</td>
                                        <td><a href="javascript:void(0);" class="custom"><?php foreach($rownip as $data) echo $data['durasi']; ?></a></td>
                                    </tr>
                                    <tr>
                                        <td >Dari Tgl.</td>                                        
                                        <td>:</td>
                                        <td style="width:200px"><a href="javascript:void(0);" class="custom"><?php foreach($rownip as $data) if(($data['start'] == "NULL") || ($data['start'] == "0000-00-00")) echo "-"; else echo date("d F Y",strtotime($data['start'])); ?></a></td>
                                        <td style="width:30px">s/d</td>
                                        <td style="width:150px" >Sampai Tgl.</td>                                        
                                        <td style="width:10px">:</td>
                                        <td style="width:200px"><a href="javascript:void(0);" class="custom"><?php foreach($rownip as $data) if(($data['end'] == "NULL") || ($data['end'] == "0000-00-00")) echo "-"; else echo date("d F Y",strtotime($data['end'])); ?></a></td>
                                    </tr>
                                    <tr>
                                        <td >SBU</td>
                                        <td>:</td>
                                        <td><a href="javascript:void(0);" class="custom"><?php foreach($rowkar as $data) echo $data['kode']; ?></a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- ./ Accordion#2  -->
                    <!-- Accordion#3  -->
                    <div>
                        <input class="acc-kontainer-input" type="radio" name="acc" id="acc3">
                        <label class="acc-kontainer-label" for="acc3"><i class="fa fa-chevron-circle-right"></i> Dokumen Kepegawaian </label>
                        <div class="acc-body table-responsive">
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
                                        <td><?=$no++;?> <a href="<?=site_url('C_Personal/docEmp/').$data['id_doc']?>" class="pull-right" data-tooltip="tooltip" title="Detail"><i class="fa fa-question-circle"></i></a></td>
                                        <td><a href="javascript:void(0);" class="custom"><?=$data['nodoc'] ?></a></td>
                                        <td><?=$data['typedoc'] ?></td>
                                        <td><?=$data['namadoc'] ?></td>
                                        <td><?=$data['halaman'] ?></td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- ./ Accordion#3  -->
                </div>                
            </div><!-- /.box -->
        </div><!-- /.right column -->
    </div><!-- /.row -->

</section>
    



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
                            <label for="nodoc">Nomor Dokumen</label>
                            <div class="input-group"> 
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
                            <input type="hidden" class="form-control" name="idkar" id="idkar" value="<?=$this->fungsi->user_login()->id_kar?>">
                            <div class="input-group"> 
                                <input type="file" class="form-control" name="filedoc" required> 
                                <div class="input-group-addon bg-blue">
                                    <i class="fa fa-picture-o"></i>
                                </div>
                            </div><!-- /.input group -->
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
                                        <td><?= $data['kode_dept']?> </td>                                   
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
                                        <td><?= "Ke - ".$data['pkwt']?> </td>
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