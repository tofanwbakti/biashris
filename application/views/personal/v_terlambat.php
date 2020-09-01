<!-- View Template Ijen Keluar  -->
<!-- ================================================ -->
<!-- Breadcumb section -->
<section class="content-header">
    <h1>
        <img src="<?=base_url()?>/assets/images/medical.svg" style="height:50px; margin-right:10px" alt=""> Izin Terlambat
        <small>Masuk Kerja Terlambat</small>
        
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
            Kamu bisa melihat history izin terlambat masuk kerja kamu disini.
        </div><!-- /.box-body -->
        <!-- <div class="box-footer">
            Footer
        </div>/.box-footer -->
    </div>
<!-- /.box -->
<!-- Flash Data -->
    <div class="comment-flash" data-flashdata="<?=$this->session->flashdata('flash'); ?>"></div>
    <div class="Apvflash" data-flashdata="<?=$this->session->flashdata('flashApv'); ?>"></div>
<!--/.  Flash Data -->


<!-- Tables  -->
    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title"> Riwayat Izin Terlambat</h3>        
            <!-- <div class="pull-right">            
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAjukan"><i class="fa fa-plus"></i>
                Ajukan</button>                    
            </div> -->
        </div>
        <div class="box-body table-responsive">
            <table id="tablehistory" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th >#</th>
                    <!-- <th>Nomor</th> -->
                    <th >Nama</th>
                    <th>Hari</th>
                    <th>Tanggal </th>
                    <th>Masuk </th>
                    <th>Alasan</th>
                    <th style='text-align:center'> Action</th>
                    <?php if($this->fungsi->user_login()->id_lvl != "A5") {?>
                    <th>Atasan</th>
                    <?php } ?>
                    <?php if(($this->fungsi->user_login()->id_lvl == "A2") || ($this->fungsi->user_login()->id_lvl == "A1") ) {?>
                    <th>Hrd</th>
                    <?php }?>
                </tr>
                </thead>
                <tbody>
                <?php $no = 1;
                foreach ($row as $data) { ?>
                    <tr <?= $data['status'] == "N" ? "class='danger'" : null ?>>
                        <td><?= $no++ ?></td>
                        <td><?=$data['nickname'] ?></td>
                        <td><?php if($data['hari']=="Monday") echo "Senin";
                            elseif ($data['hari']=="Tuesday") echo "Selasa";
                            elseif ($data['hari']=="Wednesday") echo "Rabu";
                            elseif ($data['hari']=="Thursday") echo "Kamis";
                            elseif ($data['hari']=="Friday") echo "Jumat";
                            elseif ($data['hari']=="Saturday") echo "Sabtu";
                            elseif ($data['hari']=="Monday") echo "Minggu";
                            ?>
                        </td>
                        <td><?=date('d M Y',strtotime($data['tgl']))?></td>
                        <td><?=$data['jam_masuk'] ?></td>
                        <td><?=$data['keterangan'] == "NULL" || $data['keterangan'] == "" ? "-" : $data['keterangan']?></td>
                        <td class="text-center"> <!-- Action -->
                        <?php if(($data['keterangan'] == "NULL") || ($data['keterangan'] == "")) {
                            if($data['status'] == "W"){
                                echo "<a href='javascript:void(0)' id='comment' data-toggle='modal' data-target='#alasan' class='btn btn-danger btn-xs btn-comment' data-id='".$data['id_ila']."'  >Alasan <i class='fa fa-comment'></i> </a>";
                            }
                        }
                        ?>
                        <a href="#" id="permit" data-toggle="modal" data-target="#detail" class="btn btn-info btn-xs btn-detail" data-id="<?=$data['id_ila']?>" data-hari="<?=$data['hari']?>" data-tgl="<?= date("d F Y",strtotime($data['tgl']))?>" data-jam="<?=$data['jam_masuk']?>" data-alasan="<?=$data['keterangan']?>" data-apv1="<?=$data['apv1']?>" data-apv2="<?=$data['apv2']?>" data-comment="<?=$data['comment']?>" data-status="<?=$data['status']?>"  data-fullname="<?=$data['fullname']?>"  data-foto="<?=$data['foto']?>"  data-email="<?=$data['email']?>">Detail <i class="fa fa-question-circle" ></i> </a>
                        </td>
                         <!-- Aproval Atasan -->
                        <?php if($this->fungsi->user_login()->id_lvl == "A4")  { ?> 
                        <td><?php if(($data['apv1'] == "NULL") && ($data['status'] == "W")) {
                                if($data['id_kar'] == $this->fungsi->user_login()->id_kar) {
                                    echo "<button class='btn btn-default btn-xs' disabled> Action <span class='caret' style='margin-left:3px'></span></button>";
                                    } else { ?> 
                                        <div class="dropdown">
                                            <button class="btn btn-primary btn-xs dropdown-toggle" type="button" data-toggle="dropdown"> </i>  Action  <span class="caret" style="margin-left:3px"></span>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a href="<?=site_url('C_Personal/apvLambat/').encrypt_url($data['id_ila'])."/".encrypt_url("W") ?>"  class="tombol-apv"><i class="fa fa-thumbs-o-up text-blue"></i> Setuju</a></li>
                                                <li class="divider"></li> 
                                                <li><a href="<?=site_url('C_Personal/apvLambat/').encrypt_url($data['id_ila'])."/".encrypt_url("N") ?>"  class="tombol-tolak"><i class="fa fa-thumbs-o-down text-red"></i> Tolak</a></li>
                                            </ul>                                
                                        </div>
                                    <?php } ?>
                            <?php }   else echo $data['apv1'] ?>
                        </td>
                        <!-- tampilkan nama aprover jika sudah di aproval -->
                        <?php } else if($this->fungsi->user_login()->id_lvl != "A5") {
                            if($data['apv1'] == "NULL") echo "<td>-</td>"; else {
                                echo "<td>".$data['apv1']."</td>";
                            }
                        } ?>
                        <!-- Batas tampil hanya Admin dan Developer -->
                        <?php if(($this->fungsi->user_login()->id_lvl == "A2") || ($this->fungsi->user_login()->id_lvl == "A1") ) {?>
                        <td><?php if(($data['apv2'] == "NULL") && ($data['status'] != "N")) { ?>
                            <div class="dropdown">
                                <button class="btn btn-primary btn-xs dropdown-toggle" type="button" data-toggle="dropdown"> </i>  Action  <span class="caret" style="margin-left:3px"></span>
                                </button>
                                <ul class="dropdown-menu pull-right">
                                    <li><a href="<?=site_url('C_Personal/apvLambat/').encrypt_url($data['id_ila'])."/".encrypt_url("Y") ?>" class="tombol-apv"><i class="fa fa-thumbs-o-up text-blue"></i> Setuju</a></li>
                                    <li class="divider"></li> 
                                    <!-- <li><a href="<?=site_url('C_Personal/apvLambat/').encrypt_url($data['id_ila'])."/".encrypt_url("N") ?>"><i class="fa fa-thumbs-o-down text-red"></i> Tolak</a></li> -->
                                    <li><a href="javascript:void(0)" id="comment2" data-toggle="modal" data-target="#alasanTolak" data-id="<?= $data['id_ila'] ?>"><i class="fa fa-thumbs-o-down text-red"></i> Tolak</a></li>
                                </ul>                                
                            </div>
                            <?php }   else echo $data['apv2'] ?>
                        </td>
                        <?php } ?>
                    </tr>
                <?php } ?>
            </table>
        </div>
                
    </div><!-- </div> -->
</section><!-- /.content -->

<!-- Modal Input Alasan Terlambat  -->
    <div id= "alasan" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><i class="fa fa-comment-o"></i> Alasan Terlambat </h4>
                </div>
                <form action="<?=site_url('C_Personal/addComment')?>" method="post">
                <div class="modal-body" id="commentBody">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="alasan"> Alasan </label> <small class="text-danger"> *</small>
                            <div class="input-group">
                                <input type="hidden" name="id_ila" id="id_ila" class="form-control" required>
                                <input type="text" name="alasan" id="alasan" class="form-control" required>
                                <div class="input-group-addon"><i class="fa fa-comment"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-default pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Tutup</button> 
                    <button type="submit" name="simpan" class="btn btn-primary"><i class="fa fa-check"></i> Simpan</button>
                </div>
                </form>
            </div>            
        </div>
    </div>
    <script src="<?php echo base_url();?>assets/js/jquery-1.10.0.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).on("click","#comment",function(){
            var id = $(this).data('id');

            $("#commentBody #id_ila" ).val(id);
        })
    </script>

<!-- ./ Modal Input Alasan Terlambat  -->

<!-- Modal Input Alasan DItolak  -->
    <div id= "alasanTolak" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><i class="fa fa-comment-o"></i> Alasan Ditolak </h4>
                </div>
                <form action="<?=site_url('C_Personal/addCommentTolak')?>" method="post">
                <div class="modal-body" id="commentTolak">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="commentTolak"> Alasan </label> <small class="text-danger"> *</small>
                            <div class="input-group">
                                <input type="hidden" name="id_ila" id="id_ila" class="form-control" required>
                                <input type="text" name="commentTolak" id="commentTolak" class="form-control" required>
                                <div class="input-group-addon"><i class="fa fa-comment"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-default pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Tutup</button> 
                    <button type="submit" name="simpan" class="btn btn-primary"><i class="fa fa-check"></i> Simpan</button>
                </div>
                </form>
            </div>            
        </div>
    </div>
    <script src="<?php echo base_url();?>assets/js/jquery-1.10.0.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).on("click","#comment2",function(){
            var id = $(this).data('id');

            $("#commentTolak #id_ila" ).val(id);
        })
    </script>

<!-- ./ Modal Input Alasan DItolak  -->

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
                                <td>Jam Masuk</td>
                                <td>:</td>
                                <td><input type="text" id="masuk" class="form-control" style="height:20px" disabled></td>
                            </tr>
                            <tr>
                                <td>Alasan</td>
                                <td>:</td>
                                <td><input type="text" id="alasan" class="form-control" style="height:20px" disabled></td>
                            </tr>
                            <tr class="info">
                                <td>Aproval Atasan</td>
                                <td>:</td>
                                <td><input type="text" id="atasan" class="form-control" style="height:20px" disabled></td>
                            </tr>
                            <tr class="info">
                                <td>Diproses oleh</td>
                                <td>:</td>
                                <td><input type="text" id="hrd" class="form-control" style="height:20px" disabled></td>
                            </tr>
                            <tr class="info">
                                <td>Alasan Ditolak</td>
                                <td>:</td>
                                <td><input type="text" id="alasanhrd" class="form-control" style="height:20px" disabled></td>
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
                    // var hari = $(this).data('hari');
                    var tgl = $(this).data('tgl');
                    var jam = $(this).data('jam');
                    var alasan = $(this).data('alasan');
                    var bos = $(this).data('apv1');
                    var hrd = $(this).data('apv2');
                    var comment = $(this).data('comment');
                    // var apv = $(this).data('status');
                    if ($(this).data('status') == "Y") { isi ="DISETUJUI";}
                    else if ($(this).data('status') == "N") {isi = "DITOLAK";}
                    else {isi = "MENUNGGU";}

                    if($(this).data('hari') == "Monday") { hari = "Senin";}
                    else if ($(this).data('hari') == "Tuesday") { hari = "Selasa";}
                    else if ($(this).data('hari') == "Wednesday") { hari = "Rabu";}
                    else if ($(this).data('hari') == "Thursday") { hari = "Kamis";}
                    else if ($(this).data('hari') == "Friday") { hari = "Jumat";}
                    else if ($(this).data('hari') == "Saturday") { hari = "Sabtu";}
                    else if ($(this).data('hari') == "Sunday") { hari = "Minggu";}

                    $("#detailBody #idsakit").val(id);
                    $("#detailBody #hariijin").val(hari);
                    $("#detailBody #tglijin").val(tgl);
                    $("#detailBody #masuk").val(jam+" WIB");
                    $("#detailBody #alasan").val(alasan);
                    $("#detailBody #apv").val(isi);
                    $("#detailBody #atasan").val(bos);
                    $("#detailBody #hrd").val(hrd);
                    $("#detailBody #alasanhrd").val(comment);
                });
                $('.btn-detail').on("click", function(){
                    var id = $(this).data('id');
                    var fname = $(this).data('fullname');
                    var foto = $(this).data('foto');
                    var email = $(this).data('email');
                    $("#headModal").html('<div class="col-sm-2"><img style="width:70px;height:relative" src="<?php echo base_url();?>uploads/image/'+foto+'" class="img-rounded"  alt="User Image" /></div><div class="col-sm-7" style="text-align:left"><h3>'+fname+'</h3><p><small>'+email+'</small></p></div><div class="col-sm-3" ><input type="text" class="btn btn-primary" style="height:6px;width:120px" id="apv" disabled></div>');
                    
                });
            </script>
        </div>
    </div>

<!-- ./ Modal Detail  -->

