<!-- View Template Ijen Keluar  -->
<!-- ================================================ -->
<!-- Breadcumb section -->
<section class="content-header">
    <h1>
        <div class="icon">
        <i class="fa fa-user-md text-warning"></i> Izin Sakit
        <small>Tidak Masuk Kerja Karena Sakit</small>
        </div>
        
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>Dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li> 
        <li><a href="<?= site_url('C_Personal/isak') ?>"><i class="fa fa-user-md"></i> Izin  Sakit</a></li>
        
</section>

<!-- Main content -->
<section class="content">

<!-- Default box -->

    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Hi! <b> <?= $this->fungsi->user_login()->nickname ?> </b> </h3> 
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
            </div>
        </div>
        <div class="box-body">
            Kamu bisa melihat history izin tidak masuk kerja kamu karena sakit disini.
        </div><!-- /.box-body -->
        <!-- <div class="box-footer">
            Footer
        </div>/.box-footer -->
    </div>
<!-- /.box -->
<div class="flash-data" data-flashdata="<?=$this->session->flashdata('flash'); ?>"></div>
<?php if($this->session->flashdata('flash')) : ?>
    <!-- <div class="alert alert-success alert-dismissable" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon fa fa-check"></i> Alert!</h4>
        Pengajuan ijin sakit <strong>berhasil</strong> <?= $this->session->flashdata('flash'); ?>
    </div> -->
<?php endif; ?>

<?php if($this->session->flashdata('flash_error')) : ?>
    <div class="alert alert-danger alert-dismissable" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon fa fa-ban"></i> Alert!</h4>
        Pengajuan ijin sakit <strong>gagal</strong> <?= $this->session->flashdata('flash_error'); ?>
    </div>
<?php endif; ?>

<!-- Tables  -->
<!-- <div class="col-md-8"> -->
<div class="box box-primary">
    <div class="box-header">
        <h3 class="box-title"> Riwayat Izin Sakit</h3>        
        <div class="pull-right">            
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAjukan"><i class="fa fa-plus"></i>
            Ajukan</button>                    
        </div>
    </div>
    <div class="box-body table-responsive">
        <table id="tablehistory" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th width="40px">#</th>
                <!-- <th>Nomor</th> -->
                <th width="120px">Nama</th>
                <th width="90px">Hari</th>
                <th width="120px">Tanggal </th>
                <th>Keterangan Sakit</th>
                <th width="90px">Surat MC</th>
                <th width='110px' style='text-align:center'> Action</th>
                <?php if(($this->fungsi->user_login()->id_lvl == "A2") || ($this->fungsi->user_login()->id_lvl == "A1" ) ) {
                    echo "<th width='20px'>HRD</th>";}?>
            </tr>
            </thead>
            <tbody>
            <?php $no = 1;
                foreach ($row->result() as $key => $data ) { ?>
                    <tr <?= $data->status =="Y" ? "class='success'" : null ?>">
                        <td><?= $no++; ?>.</td>
                        <td><?= $data->nickname ?> </td>
                        <td><?= $data->hari ?></td>
                        <td><?= date("d F Y",strtotime($data->tgl) )?> </td>
                        <td><?= $data->keterangan ?></td>
                        <td><a href="<?=site_url('C_Personal/suratMC/').$data->id_sakit ?>">Lihat <i class="icon fa fa-eye"></i> </a> </td>
                        <td><a href="#" id="permit" data-toggle="modal" data-target="#detail" class="btn btn-info btn-xs btn-detail" data-id="<?=$data->id_sakit?>" data-tgl="<?= date("d F Y",strtotime($data->tgl))?>" data-hari="<?=$data->hari?>" data-hrd="<?=$data->apv?>" data-suratmc="<?=$data->suratmc?>" data-note="<?=$data->keterangan?>" data-status="<?=$data->status?>"  data-fullname="<?=$data->fullname?>"  data-foto="<?=$data->foto?>"  data-email="<?=$data->email?>" >Detail <i class="fa fa-question-circle"></i> </a>
                        <?php if ($data->status == "N"){
                                if($data->id_kar != $this->fungsi->user_login()->id_kar ){
                                    echo "<a href='javascript:void(0);' class='btn btn-default btn-xs' disabled>Batal <i class='fa fa-trash'></i> </a>";
                                }else{
                                    echo "<a href='".site_url('C_Personal/batalIsak/').$data->id_sakit."' class='btn btn-danger btn-xs tombol-hapus'>Batal <i class='fa fa-trash'></i> </a>";
                                }
                            }else if  ($data->status == "C"){
                            echo "<a href='#' class='btn btn-default btn-xs tombol-ccl'>Batal <i class='fa fa-trash'></i> </a>";} ?>
                        </td>
                        <?php if(($this->fungsi->user_login()->id_lvl == "A2") || ($this->fungsi->user_login()->id_lvl == "A1" ) ) {
                            if($data->status == "N"){
                                echo "<td><a href='".site_url('C_Personal/apvIsak/').$data->id_sakit."' class='btn btn-success btn-xs tombol-apv' style='color:#e4edfe'  >OK <i class='fa fa-thumbs-up'></i></a></td>";
                            }else if($data->status == "Y"){ echo "<td class='text-center'> <span class='btn btn-primary btn-xs' disabled'> $data->apv </span></td>";
                            }else echo "<td><a href='#' class='btn btn-default btn-xs tombol-ccl' >OK <i class='fa fa-thumbs-up'></i></a></td>";
                        }?>
                    </tr>                
            <?php } ?>                
            </tbody>
        </table>
    </div>
            
</div><!-- </div> -->
</section><!-- /.content -->

<!--Modal FORM PENGAJUAN  -->
    <div id= "modalAjukan" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><i class="fa fa-user-md"></i> Form Izin Sakit </h4>
                </div>
                <div class="modal-body">
                    <?php echo form_open_multipart('C_Personal/addisak') ?>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1"><small class="text-danger">*</small> User</label>
                                <input type="hidden" name="InputIdKar" value="<?= $this->fungsi->user_login()->id_kar ?>" >
                                <!-- <input type="hidden" class="form-control" name="InputEmail" value="<?= $this->fungsi->user_login()->email?>"> -->
                                <div class="input-group">
                                    <input type="text" class="form-control" readonly="" value="<?= $this->fungsi->user_login()->nickname?>">
                                    <div class="input-group-addon">
                                        <i class="fa fa-user"></i>                      
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="level"><small class="text-danger">*</small>  Pilih Hari:</label>
                                    <select class="form-control" id="hari" name="Hari" required>
                                        <option disabled selected>Pilih Satu..</option>
                                        <option>Senin</option>
                                        <option>Selasa</option>
                                        <option>Rabu</option>
                                        <option>Kamis</option>
                                        <option>Jumat</option>
                                    </select>
                            </div>
                            <div class="form-group" id="sandbox-tanggal">
                                <label for="tanggal" ><small class="text-danger">*</small> Tanggal</label>
                                <div class="input-group date" >
                                    <input type="text" class="form-control" name="Tanggal" readonly value="<?php $tgl = date('d-m-Y'); echo $tgl;?>">
                                    <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label><small class="text-danger">*</small> Keterangan Sakit</label>
                                <textarea class="form-control" rows="3" placeholder="Enter  ..." name="InputAlasan" required></textarea>
                                <!-- <input type="hidden" name="Apv1" value="" > -->
                            </div>
                            <div class="form-group">
                                <label for="suratmc"><small class="text-danger">*</small>  Upload Surat MC</label>
                                <input type="file" name="suratmc" id="suratmc" required>
                                <small class="text-muted">maks. upload 2MB, format file .pdf</small> 
                            </div>
                        </div><!-- /.box-body -->
                        <div class="modal-footer">
                            <button type="reset" class="btn btn-default pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Tutup</button>
                            <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Simpan</button>
                        </div>
                    <?php echo form_close() ?>
                    <!-- </form>              -->
                </div>
                
            </div>
        </div>
    </div>
<!-- ./ Modal FORM PENGAJUAN=========================================================== -->

<!-- Modal Aproval -->
    
<!-- ./Modal Aproval -->

<!-- Modal Detail  -->
    <div id= "detail" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><i class="fa fa-user-md"></i> Detail Pengajuan Izin </h4>
                </div>
                <div class="modal-body" id="detailBody">
                    <div class="box-body">
                        <div class="row" id="headModal">                            
                        </div>
                        <table class="table table-bordeless">
                            <tr>
                                <td>Hari</td>
                                <td>:</td>
                                <td><input type="text" id="hariijin" class="form-control"  style="height:20px" disabled></td>
                            </tr>
                            <tr>
                                <td>Izin Tanggal</td>
                                <td>:</td>
                                <td><input type="text" id="tglijin" class="form-control" style="height:20px" disabled></td>
                            </tr>
                            <tr>
                                <td>Keterangan</td>
                                <td>:</td>
                                <td><input type="text" id="alasan" class="form-control" style="height:20px" disabled></td>
                            </tr>
                            <tr class="info">
                                <td>Diproses oleh</td>
                                <td>:</td>
                                <td><input type="text" id="hrd" class="form-control" style="height:20px" disabled></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-default pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Tutup</button>
                </div>
            </div>
            <script src="<?php echo base_url();?>assets/js/jquery-1.10.0.min.js" type="text/javascript"></script>
            <script type="text/javascript" >
                $(document).on("click","#permit",function(){
                    var id = $(this).data('id');
                    var hari = $(this).data('hari');
                    var tgl = $(this).data('tgl');
                    var hrd = $(this).data('hrd');
                    var alasan = $(this).data('note');
                    // var apv = $(this).data('status');
                    if ($(this).data('status') == "Y") { isi ="DISETUJUI";}
                    else if ($(this).data('status') == "N") {isi = "MENUNGGU";}
                    else {isi = "DIBATALKAN";}

                    $("#detailBody #idsakit").val(id);
                    $("#detailBody #hariijin").val(hari);
                    $("#detailBody #tglijin").val(tgl);
                    $("#detailBody #alasan").val(alasan);
                    $("#detailBody #apv").val(isi);
                    $("#detailBody #hrd").val(hrd);
                });
                $('.btn-detail').on("click", function(){
                    var id = $(this).data('id');
                    var fname = $(this).data('fullname');
                    var foto = $(this).data('foto');
                    var email = $(this).data('email');
                    $("#headModal").html('<div class="col-sm-2"><img style="width:70px;height:relative" src="<?php echo base_url();?>uploads/image/'+foto+'" class="img-rounded"  alt="User Image" /></div><div class="col-sm-7" style="text-align:left"><h3>'+fname+'</h3><p><small>'+email+'</small></p></div><div class="col-sm-3" ><input type="text" class="btn btn-primary" style="height:6px;width:100px" id="apv" disabled></div>');
                    
                });
            </script>
        </div>
    </div>

<!-- ./ Modal Detail  -->


