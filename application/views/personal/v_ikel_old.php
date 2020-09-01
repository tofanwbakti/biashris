<!-- View Template Ijen Keluar  -->
<!-- ================================================ -->
<!-- Breadcumb section -->
<section class="content-header">
    <h1>
        <div class="icon">
        <i class="fa fa-share text-warning"></i> Izin Keluar
        <small>Karyawan</small>
        </div>
        
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>Dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li> 
        <li><a href="<?= site_url('C_Personal') ?>"><i class="fa fa-share"></i> Izin  Keluar</a></li>
        
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
            Kamu bisa melihat history izin keluar kamu disini.
        </div><!-- /.box-body -->
        <!-- <div class="box-footer">
            Footer
        </div>/.box-footer -->
    </div>
<!-- /.box -->
<!-- Flash Data -->
<div class="flash-data" data-flashdata="<?=$this->session->flashdata('flash'); ?>"></div> <!-- Swal pengajuan -->
<div class="flash-data" data-flashdata="<?=$this->session->flashdata('flash_apv'); ?>"></div>
<?php if($this->session->flashdata('flash')) : ?>
    <!-- <div class="alert alert-success alert-dismissable" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon fa fa-check"></i> Alert!</h4>
        Pengajuan ijin keluar <strong>berhasil</strong> <?= $this->session->flashdata('flash'); ?>
    </div> -->
<?php endif; ?>
<!-- ./ Flash Data -->
<!-- Tables  -->
<!-- <div class="col-md-8"> -->
<div class="box box-primary">
    <div class="box-header">
        <h3 class="box-title"> Riwayat Izin Keluar</h3>
        <div class="pull-right">            
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAjukan"><i class="fa fa-plus"></i>
            Ajukan</button>                    
        </div>
    </div>
    <div class="box-body table-responsive">
        <table id="tablehistory" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>Nama</th>
                <th>Tanggal</th>
                <th>Jam</th>
                <th>Keperluan</th>
                <th width="110px">Action</th>
                    <?php if (($this->fungsi->user_login()->id_lvl == "A4" ) || ($this->fungsi->user_login()->id_lvl == "A1" )) {
                        echo "<th width='70px' style='text-align:center'> Atasan</th>";
                    }?>
                    <?php if (($this->fungsi->user_login()->id_lvl == "A2" ) || ($this->fungsi->user_login()->id_lvl == "A1" )){  
                        echo "<th width='70px' style='text-align:center'> HRD</th>";
                    }?>
            </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                foreach ($row->result() as $key => $data ) { ?>
                <tr <?= $data->status == "BISA" ? "class='success'" : null ?>>
                    <td><?= $no++; ?>.</td>
                    <!-- <td><?= $data->id_ikel ?></td> -->
                    <td><?= $data->nickname ?></td>
                    <td><?= date("d M Y",strtotime($data->tanggal) )?></td>
                    <td><?= $data->jam ?></td>
                    <td><?= $data->alasan ?></td>
                    <td><a href="#" id="permit" data-toggle="modal" data-target="#detail" class="btn btn-info btn-xs btn-detail" data-id="<?=$data->id_ikel?>" data-tgl="<?= date("d F Y",strtotime($data->tanggal))?>" data-jam="<?=$data->jam?>" data-apv1="<?=$data->apv1?>" data-apv2="<?=$data->apv2?>" data-note="<?=$data->alasan?>" data-status="<?=$data->status?>"  data-fullname="<?=$data->fullname?>"  data-foto="<?=$data->foto?>"  data-email="<?=$data->email?>"    >Detail <i class="fa fa-question-circle"></i> </a>
                    <?php if (($data->status == "N")){
                            if (($data->apv1 == "null") && ($data->apv2 == "null")){
                                echo "<a href='".site_url('C_Personal/batalIkel/').encrypt_url($data->id_ikel)."' class='btn btn-danger btn-xs tombol-hapus'>Batal <i class='fa fa-trash'></i> </a>";}
                            else if(($this->fungsi->user_login()->id_lvl == "A2")||($this->fungsi->user_login()->id_lvl == "A1")&&($data->apv1 != "null") && ($data->apv2 == "null")){
                                echo "<a href='".site_url('C_Personal/batalIkel/').$data->id_ikel."' class='btn btn-danger btn-xs tombol-hapus'>Batal <i class='fa fa-trash'></i> </a>";
                            } 
                        } else if  ($data->status == "C"){
                        echo "<a href='#' class='btn btn-default btn-xs tombol-ccl'>Batal <i class='fa fa-trash'></i> </a>";} ?>
                    </td>
                    <!-- Proses aproval Atasan  -->
                    <?php if (($this->fungsi->user_login()->id_lvl == "A4")||($this->fungsi->user_login()->id_lvl == "A1")) {
                        if(($data->status == "N") && ($data->apv1 == "null")){ 
                            if($data->id_kar == $this->fungsi->user_login()->id_kar ){
                                echo "<td style='text-align:center'> <a href='javascript:void(0)' class='btn btn-default btn-xs tombol-apv' disabled >OK <i class='fa fa-thumbs-up'></i></a> </td>";
                            }else {
                                echo "<td style='text-align:center'> <a href='".site_url('C_Personal/apv1/').encrypt_url( $data->id_ikel)."' class='btn btn-success btn-xs tombol-apv'  >OK <i class='fa fa-thumbs-up'></i></a> </td>";
                            }
                            }else if(($data->status == "C") && ($data->apv1 == "null")){
                            echo "<td style='text-align:center'> <a href='#' class='btn btn-default btn-xs tombol-ccl'  >OK <i class='fa fa-thumbs-up'></i></a> </td>";
                            }else if($data->status == "Y"){echo "<td style='text-align:center'>$data->apv1</td>";
                            }else if (($data->status == "N") &&($data->apv1 != "null"))
                            {echo "<td style='text-align:center'>$data->apv1</td>"; 
                            } else if (($data->status == "C") &&($data->apv1 != "null"))
                            {echo "<td style='text-align:center'> <span class='label label-default'>$data->apv1</span></td>"; } 
                    }?>
                    <!-- Proses Aproval HRD -->
                    <?php if (($this->fungsi->user_login()->id_lvl == "A2") || ($this->fungsi->user_login()->id_lvl == "A1")) { 
                        if (($data->status == "N") && ($data->apv2 == "null")){
                            echo "<td style='text-align:center'> <a href='".site_url('C_Personal/apv2/').$data->id_ikel."' class='btn btn-success btn-xs tombol-apv'  >OK <i class='fa fa-thumbs-up'></i></a> </td>";
                            }else if($data->status == "C"){
                            echo "<td style='text-align:center'> <a href='#' class='btn btn-default btn-xs tombol-ccl'  >OK <i class='fa fa-thumbs-up'></i></a> </td>";
                            } else if ($data->apv2 != "null")
                            echo "<td  style='text-align:center'>$data->apv2</td>"; 
                    }?>  
                </tr>
                <?php } ?>
            </tbody>
                
        </table>
    </div>
            
</div>
<!-- </div> -->
</section><!-- /.content -->
<!-- FORM PENGAJUAN  -->
    <div id= "modalAjukan" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><i class="icon fa fa-plus-square"></i> Form Pengajuan Izin Keluar</h4>
                </div>
                <div class="modal-body">
                    <form role="form" method="post" action="<?= site_url('C_Personal/addikel') ?>">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email User</label>
                                <input type="hidden" name="InputIdKar" value="<?= $this->fungsi->user_login()->id_kar ?>" >
                                <input type="text" class="form-control" readonly="" value="<?= $this->fungsi->user_login()->nickname?>">
                            </div>
                            <div class="form-group">
                                <label for="tanggal" >Tanggal</label>
                                <div class="input-group" data-date-format="dd.mm.yyyy">
                                    <input type="text" class="form-control" name="Tanggal" readonly value="<?php $tgl = date('d-m-Y'); echo $tgl;?>">
                                    <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="bootstrap-timepicker">
                                <div class="form-group">
                                    <label>Jam </label>
                                    <div class="input-group">
                                        <input type="text" class="form-control timepicker" name="Jam" >
                                        <div class="input-group-addon">
                                        <i class="fa fa-clock-o"></i>
                                        </div>
                                    </div><!-- /.input group -->
                                </div><!-- /.form group -->
                            </div>
                            <div class="form-group">
                                <label>Alasan</label>
                                <textarea class="form-control" rows="3" placeholder="Enter ..." name="InputAlasan" ></textarea>
                            
                            </div>
                        </div><!-- /.box-body -->
                        <div class="modal-footer">
                            <button type="reset" class="btn btn-default pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Tutup</button>
                            <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Simpan</button>
                        </div>
                    </form>             
                </div>
                
            </div>
        </div>
    </div>
<!-- =========================================================== -->


<!-- Modal Detail  -->
    <div id= "detail" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><i class="fa fa-share"></i> Detail Pengajuan Izin </h4>
                </div>
                <!-- <form action="<?=site_url('C_Personal/delIsak/')?>" method="post" name="delForm"> -->
                <div class="modal-body" id="detailBody">
                    <div class="box-body">
                        <div class="row" id="headModal">
                            <!-- <div class="col-sm-2"><img style="width:70px;height:relative" src="<?php echo base_url();?>uploads/image/<?=$this->fungsi->user_login()->foto ?>" class="img-thumnail"  alt="User Image" /></div> -->
                            <!-- <div class="col-sm-7" style="text-align:left"><h3><?=$this->fungsi->user_login()->fullname ?></h3> <p><small><?=$this->fungsi->user_login()->email ?></small></p></div> -->
                            <input type="hidden" id="idsakit" name="idsakit">
                            <!-- <div class="col-sm-3 detail" ><input type="text" class="btn btn-primary" style="height:6px;width:100px" id="apv" disabled></div> -->
                        </div>
                        <table class="table table-bordeless">
                            <tr>
                                <td>Izin Tanggal</td>
                                <td>:</td>
                                <td><input type="text" id="tglijin" class="form-control" style="height:20px" disabled></td>
                            </tr>                            
                            <tr>
                                <td>Jam</td>
                                <td>:</td>
                                <td><input type="text" id="jamijin" class="form-control"  style="height:20px" disabled></td>
                            </tr>
                            <tr>
                                <td>Keterangan</td>
                                <td>:</td>
                                <td><input type="text" id="alasan" class="form-control" style="height:20px" disabled></td>
                            </tr>
                            <tr>
                                <td>Aproval Atasan</td>
                                <td>:</td>
                                <td><input type="text" id="bos" class="form-control" style="height:20px" disabled></td>
                            </tr>
                            <tr class="info">
                                <td>Diproses Oleh</td>
                                <td>:</td>
                                <td><input type="text" id="hrd" class="form-control" style="height:20px" disabled></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                <button type="reset" class="btn btn-default pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Tutup</button> 
                <!-- <a href="<?=site_url('C_Personal/batalIkel/')?>'+id+'" class="btn btn-danger tombol-hapus"><i class="icon fa fa-trash"></i>Batal</a> -->
                </div>
                <!-- </form> -->
            </div>
            <script src="<?php echo base_url();?>assets/js/jquery-1.10.0.min.js" type="text/javascript"></script>
            <script type="text/javascript" >
                $(document).on("click","#permit",function(){
                    var id = $(this).data('id');
                    var jam = $(this).data('jam');
                    var tgl = $(this).data('tgl');
                    var hrd = $(this).data('hrd');
                    var alasan = $(this).data('note');
                    var apv1 = $(this).data('apv1');
                    var apv2 = $(this).data('apv2');
                    // var apv = $(this).data('status');
                    if ($(this).data('status') == "Y") { isi ="DISETUJUI";}
                    else if ($(this).data('status') == "N") {isi = "MENUNGGU";}
                    else {isi = "DIBATALKAN";}

                    $("#detailBody #idsakit").val(id);
                    $("#detailBody #jamijin").val(jam);
                    $("#detailBody #tglijin").val(tgl);
                    $("#detailBody #alasan").val(alasan);
                    $("#detailBody #apv").val(isi);
                    $("#detailBody #bos").val(apv1);
                    $("#detailBody #hrd").val(apv2);
                });

                // $(document).ready(function(){
                    $('.btn-detail').on("click", function(){
                        var id = $(this).data('id');
                        var fname = $(this).data('fullname');
                        var foto = $(this).data('foto');
                        var email = $(this).data('email');
                        $("#headModal").html('<div class="col-sm-2"><img style="width:70px;height:relative" src="<?php echo base_url();?>uploads/image/'+foto+'" class="img-rounded"  alt="User Image" /></div><div class="col-sm-7" style="text-align:left"><h3>'+fname+'</h3><p><small>'+email+'</small></p></div><div class="col-sm-3" ><input type="text" class="btn btn-primary" style="height:6px;width:120px" id="apv" disabled></div>');
                        
                    });
                // })
            </script>
        </div>
    </div>

<!-- ./ Modal Detail  -->

