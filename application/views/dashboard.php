<!-- DASHBOARD UMUM  --> 
<!-- ditampilkan untuk semua akun user -->
<!-- =================================================== -->
<!-- Jam realtime -->
<script type="text/javascript">
    var detik = <?php echo gmdate('s', time()+60*60*7); ?>;
    var menit = <?php echo gmdate('i', time()+60*60*7); ?>;
    var jam   = <?php echo gmdate('G', time()+60*60*7); ?>;
    
    function clock()
    {
        if (detik!=0 && detik%60==0) {
            menit++;
            detik=0;
        }
        second = detik;
        
        if (menit!=0 && menit%60==0) {
            jam++;
            menit=0;
        }
        minute = menit;
        
        if (jam!=0 && jam%24==0) {
            jam=0;
        }
        hour = jam;
        
        if (detik<10){
            second='0'+detik;
        }
        if (menit<10){
            minute='0'+menit;
        }
        
        if (jam<10){
            hour='0'+jam;
        }
        waktu = 'Jam : ' + hour+':'+minute+':'+second;
        
        document.getElementById("clock").innerHTML = waktu;
        detik++;
    }
    setInterval(clock,1000);

    function clock2()
    {
        if (detik!=0 && detik%60==0) {
            menit++;
            detik=0;
        }
        second = detik;
        
        if (menit!=0 && menit%60==0) {
            jam++;
            menit=0;
        }
        minute = menit;
        
        if (jam!=0 && jam%24==0) {
            jam=0;
        }
        hour = jam;
        
        if (detik<10){
            second='0'+detik;
        }
        if (menit<10){
            minute='0'+menit;
        }
        
        if (jam<10){
            hour='0'+jam;
        }
        waktu = 'Jam : ' + hour+':'+minute+':'+second;
        
        document.getElementById("clock2").innerHTML = waktu;
        detik++;
    }
    setInterval(clock2,1000);
</script>
<!-- Breadcumb section -->
<section class="content-header">
    <h1>
      <div class="icon">
        <i class="fa fa-dashboard"></i> Dashboard
        <small>semua berawal dari sini</small>
      </div>        
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>Dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
</section>

<!-- Main content -->
<section class="content">

<!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Hi! <b><?= $this->fungsi->user_login()->nickname ?></b> Selamat Datang </h3> 
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
            </div>
        </div>
        <div class="box-body">
            Semoga harimu menyenangkan
        </div><!-- /.box-body -->
        <div class="box-footer">
            <?php $today = gmdate("Y-m-d",time()+60*60*7);
                  $bday  = $this->fungsi->user_login()->tgllahir;
              if ($today == $bday ){
                echo " Selamat Ulang Tahun <i class='fa fa-birthday-cake'></i> semoga harapan kamu menjadi kenyataan hari ini dan tahun-tahun berikutnya. <img src='".base_url('assets/images/daco.png')."' style='height:16px'> ";
              }
            ?>
        </div><!-- .box-footer -->
        
    </div>
<!-- /.box -->
<!-- FLASH DATA -->
<?php if($this->session->flashdata('flash')) : ?>
    <div class="alert alert-success alert-dismissable" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon fa fa-check"></i> Alert!</h4>
        Proses absensi <strong>berhasil</strong> <?= $this->session->flashdata('flash'); ?>
    </div>
<?php endif; ?>

<?php if($this->session->flashdata('flash_error')) : ?>
    <div class="alert alert-danger alert-dismissable" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon fa fa-exclamation-circle"></i> Alert!</h4>
        Proses absensi <strong>gagal</strong> <?= $this->session->flashdata('flash_error'); ?>, Kamu sudah absen hari ini!
    </div>
<?php endif; ?>

<?php if($this->session->flashdata('flash_break')) : ?>
    <div class="alert alert-success alert-dismissable" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon fa fa-check"></i> Alert!</h4>
        Proses absen istirahat <strong>berhasil</strong> <?= $this->session->flashdata('flash_break'); ?>
    </div>
<?php endif; ?>

<?php if($this->session->flashdata('flash_break_error')) : ?>
    <div class="alert alert-danger alert-dismissable" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon fa fa-exclamation-circle"></i> Alert!</h4>
        Proses absen istirahat <strong>gagal</strong> <?= $this->session->flashdata('flash_break_error'); ?>, Kamu sudah absen hari ini!
    </div>
<?php endif; ?>

<!-- Small boxes (Stat box) -->
<?php if($this->fungsi->user_login()->id_lvl != "SC"){ ?>
    <div class="row">
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
          <div class="inner">
            <h3><?php $user = $this->fungsi->user_login()->id_kar;
            $thismonth = gmdate("Y-m",time()+60*60*7);
            $this->db->where('id_kar',$user);
            $this->db->where('status',"Y");
            $this->db->like('tgl',$thismonth);
            $this->db->from('tb_ijinsakit');
              echo $this->db->count_all_results(); ?> <sup style="font-size:15px"><?=gmdate("M-y",time()+60*60*7) ?></sup></h3>
            <p>Izin Sakit</p>
          </div>
          <div class="icon">
            <i class="fa fa-user-md"></i>
          </div>
          <a href="<?= site_url('C_Personal/isak')?>" class="small-box-footer">
            Info Lebih <i class="fa fa-arrow-circle-right"></i>
          </a>
        </div>
      </div><!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
          <div class="inner">
            <h3><?php $user = $this->fungsi->user_login()->id_kar;
            $thismonth = gmdate("Y-m",time()+60*60*7);
            $this->db->where('id_kar',$user);
            $this->db->like('tanggal',$thismonth);
            $this->db->from('tb_ijinpulcep');
              echo $this->db->count_all_results(); ?> <sup style="font-size:15px"><?=gmdate("M-y",time()+60*60*7) ?></sup></h3>
            <p>Izin Pulang Cepat</p>
          </div>
          <div class="icon">
            <i class="fa fa-share-square-o"></i>
          </div>
          <a href="<?= site_url('C_Personal/pulcep')?>" class="small-box-footer">
              Info Lebih <i class="fa fa-arrow-circle-right"></i>
          </a>
        </div>
      </div><!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
          <div class="inner">
            <h3><?php $user = $this->fungsi->user_login()->id_kar;
            $thismonth = gmdate("Y-m",time()+60*60*7);
            $this->db->where('id_kar',$user);
            $this->db->like('tanggal',$thismonth);
            $this->db->from('tb_ijinkeluar');
              echo $this->db->count_all_results(); ?> <sup style="font-size:15px"><?=gmdate("M-y",time()+60*60*7) ?></sup></h3>
            <p>Izin Keluar Kantor</p>
          </div>
          <div class="icon">
            <i class="fa fa-share"></i>
          </div>
          <a href="<?= site_url('C_Personal')?>" class="small-box-footer">
              Info Lebih <i class="fa fa-arrow-circle-right"></i>
          </a>
        </div>
      </div><!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
          <div class="inner">
            <h3><?php $user = $this->fungsi->user_login()->id_kar;
            $thismonth = gmdate("Y-m",time()+60*60*7);
            $this->db->where('id_kar',$user);
            $this->db->where('absen_status',"2");
            $this->db->like('tgl',$thismonth);
            $this->db->from('tb_absensi');
              echo $this->db->count_all_results(); ?>  <sup style="font-size:15px"><?=gmdate("M-y",time()+60*60*7) ?></sup></h3>
            <p>Terlambat</p>
          </div>
          <div class="icon">
            <i class="fa fa-briefcase"></i>
          </div>
          <a href="<?=site_url('C_Personal/ijinLambat') ?>" class="small-box-footer">
            Info Lebih <i class="fa fa-arrow-circle-right"></i>
          </a>
        </div>
      </div><!-- ./col -->
  </div><!-- /.row -->
<?php } if ($this->fungsi->user_login()->id_lvl == "SC") { ?>
<!-- Tables  -->
<!-- <div class="col-md-8"> -->
<div class="box">
    <div class="box-header">
        <h3 class="box-title"> Riwayat Ijin Keluar</h3>
        <!-- <div class="pull-right">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAjukan"><i class="fa fa-plus"></i>
            Ajukan</button>                    
        </div> -->
    </div>
    <div class="box-body table-responsive">
        <table id="tablehistory" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th style="width:15px">#</th>
                <th>Nama</th>
                <th>Tanggal</th>
                <th>Jam</th>
                <th>Keperluan</th>
                <th style="width:10px"></th>                
            </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                foreach ($row->result() as $key => $data ) { ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $data->nickname ?></td>
                    <td><?= date("d F Y",strtotime($data->tanggal) )?></td>
                    <td><?= $data->jam ?></td>
                    <td><?= $data->alasan ?>  <a href="#" id="permit" data-toggle="modal" data-target="#detail" class="btn-detail" data-id="<?=$data->id_ikel?>" data-tgl="<?= date("d F Y",strtotime($data->tanggal))?>" data-jam="<?=$data->jam?>" data-apv1="<?=$data->apv1?>" data-apv2="<?=$data->apv2?>" data-note="<?=$data->alasan?>" data-status="<?=$data->status?>"  data-fullname="<?=$data->fullname?>"  data-foto="<?=$data->foto?>"  data-email="<?=$data->email?>"    > <i class="fa fa-question-circle pull-right" data-toggle="tooltip" title="Detail"></i> </a></td>
                    <td> <?php if($data->status == "N"){
                        echo "<img class='fa fa-thumbs-o-down text-red' style='font-size:20px'></img>";
                    }else echo "<i class='fa fa-thumbs-o-up text-green' style='font-size:20px'></i>"; ?>  </td>                   
                </tr>
                <?php } ?>
            </tbody>
                
        </table>
    </div>
</div>
<?php } ?>

<!-- =========================================================== -->
<!-- Second row -->
<?php if($this->fungsi->user_login()->id_lvl != "SC"){ ?>
<div class="row">
<!-- Left col -->
  <section  class="col-lg-3"> 
    <div class="nav-tabs-custom">
      <ul class="nav nav-tabs" role="tablist">
          <li class="active">
              <a href="#kehadiran" data-toggle="tab"><i class="fa fa-power-off text-green" style="margin-right:10px"></i>Absensi</a>
          </li>
          <li>
              <a href="#istirahat" data-toggle="tab"><i class="fa fa-power-off text-red" style="margin-right:10px"></i>Istirahat</a>
          </li>
      </ul>
      <!-- Tab Absensi Kehadiran -->
      <div class="tab-content">
        <div class="tab-pane active" id="kehadiran">
          <div class="box box-success" >
            <div class="box-header">
              <!-- <i class="icon fa fa-archive"></i> -->
              <small class="pull-left" style="font-size:10px"><?php $hari= date("D"); switch ($hari) {
                case 'Sun' : $hari = "Minggu"; break;
                case 'Mon' : $hari = "Senin"; break;
                case 'Tue' : $hari = "Selasa"; break;
                case 'Wed' : $hari = "Rabu"; break;
                case 'Thu' : $hari = "Kamis"; break;
                case 'Fri' : $hari = "Jumat"; break;
                case 'Sat' : $hari = "Sabtu"; break;}  
                echo $hari, " - ", gmdate("d M Y", time()+60*60*7); ?></small>
              <!-- <small class="pull-right">Jam : <?= gmdate("G:i", time()+60*60*7); ?></small> -->
              <small id="clock" class="pull-right" style="font-size:10px"></small>
              <h2 style="margin-top:15px;margin-bottom:5px;text-align:center" >Absensi</h2>
            </div>
            <div class="box-body text-center">
            <!-- KOndisi untuk pengaturan tombol absen -->
              <?php
              foreach ($rowpab as $data) {}
                if(date("D")=="Fri"){ $jam = strtotime('07:30');} else $jam = strtotime('08:00'); //nilai default jam masuk kerja
                if(date("D")=="Fri"){ $pulang = strtotime('17:30');} else $pulang = strtotime('17:00'); //nilai default jam pulang kerja
                $sekarang =  strtotime(gmdate("G:i", time()+60*60*7)); 
                // $kurang = $sekarang - $pulang;
                if ($sekarang <= $jam ){ echo 
                  "<a href='". site_url('C_Personal/absenHadir')."' class='btn btn-info ' style='width:170px;height:170px;padding: 10px 16px;font-size: 75px;line-height: 1.33;border-radius:135px'><img src='".base_url('assets/images/fp.png')."' alt='' style='height:90px;margin-top:30px' data-toggle='tooltip' title='Masuk'></a>";
                }else if($sekarang >=$jam && $sekarang <= $pulang ){echo
                  "<a href='". site_url('C_Personal/absenHadir')."' class='btn btn-warning tombol-in' style='width:170px;height:170px;padding: 10px 16px;font-size: 75px;line-height: 1.33;border-radius:135px'><img src='".base_url('assets/images/fp.png')."' alt='' style='height:90px;margin-top:30px' data-toggle='tooltip' title='Masuk Telat' ></a>";
                } else if($sekarang >= $pulang) { echo 
                  "<a href='". site_url('C_Personal/absenPulang/').$data["id_absen"]."' type='button' class='btn btn-success ' style='width:170px;height:170px;padding: 10px 16px;font-size: 75px;line-height: 1.33;border-radius:135px'><img src='".base_url('assets/images/fp.png')."' alt='' style='height:90px;margin-top:30px' data-toggle='tooltip' title='Pulang' ></a>";
                }  ?>
            </div>
            <div class="">
              <div class="loader"></div>
            </div>
            <div class="box-footer" style="text-align:center">
                <?php if(date('l')=="Friday"){
                  echo "<small>Jam Kantor : 07:30 - 17:30 WIB</small>";
                }else echo "<small>Jam Kantor : 08:00 - 17:00 WIB</small>"; ?>
                <div><small>Alamat IP : <?= $this->input->ip_address();?></small></div>
            </div>
          </div>
        </div><!--/.  Tab Absensi Kehadiran -->
        <!-- Tab Istirahat -->
        <div class="tab-pane" id="istirahat">
          <div class="box box-danger" >
            <div class="box-header">
              <!-- <i class="icon fa fa-archive"></i> -->
              <small class="pull-left" style="font-size:10px"><?php $hari= date("D"); switch ($hari) {
                case 'Sun' : $hari = "Minggu"; break;
                case 'Mon' : $hari = "Senin"; break;
                case 'Tue' : $hari = "Selasa"; break;
                case 'Wed' : $hari = "Rabu"; break;
                case 'Thu' : $hari = "Kamis"; break;
                case 'Fri' : $hari = "Jumat"; break;
                case 'Sat' : $hari = "Sabtu"; break;}  
                echo $hari, " - ", gmdate("d M Y", time()+60*60*7); ?></small>
              <!-- <small class="pull-right">Jam : <?= gmdate("G:i", time()+60*60*7); ?></small> -->
              <small id="clock2" class="pull-right" style="font-size:10px"></small>
              <h2 style="margin-top:15px;margin-bottom:5px;text-align:center" >Istirahat</h2>
            </div>
            <div class="box-body text-center">
            <!-- KOndisi untuk pengaturan tombol absen -->
              <?php
              foreach ($rowbreak as $data) {}
              // if(date("D")=="Fri"){ $breakOut = strtotime('11:30');} else $breakOut = strtotime('14:39'); //nilai default jam Istirahat Keluar
              // if(date("D")=="Fri"){ $breakIn = strtotime('13:29');} else $breakIn = strtotime('14:55'); //nilai default jam Istirahat Masuk
              // if(date("D")=="Fri"){ $limitOut = strtotime('11:45');} else $limitOut = strtotime('14:43'); //nilai default batas jam Istirahat Keluar
              // if(date("D")=="Fri"){ $limitIn = strtotime('13:19');} else $limitIn = strtotime('14:45'); //nilai default batas jam Istirahat Masuk
              
                if(date("D")=="Fri"){ $breakOut = strtotime('11:30');} else $breakOut = strtotime('12:00'); //nilai default jam Istirahat Keluar
                if(date("D")=="Fri"){ $breakIn = strtotime('13:29');} else $breakIn = strtotime('13:00'); //nilai default jam Istirahat Masuk
                if(date("D")=="Fri"){ $limitOut = strtotime('11:45');} else $limitOut = strtotime('12:15'); //nilai default batas jam Istirahat Keluar
                if(date("D")=="Fri"){ $limitIn = strtotime('13:19');} else $limitIn = strtotime('12:45'); //nilai default batas jam Istirahat Masuk
                $sekarang =  strtotime(gmdate("G:i", time()+60*60*7)); 
                // $kurang = $sekarang - $pulang;
                if ($sekarang <= $breakOut ){ echo 
                  "<a href='javascript:void(0)' class='btn btn-default ' style='width:170px;height:170px;padding: 10px 16px;font-size: 75px;line-height: 1.33;border-radius:135px'><img src='".base_url('assets/images/fp.png')."' alt='' style='height:90px;margin-top:30px'></a>";
                }else if($sekarang >= $breakOut && $sekarang <= $limitOut ){echo //aktifkan tombol start istirahat (breakout)
                  "<a href='". site_url('C_Personal/breakOn')."' class='btn btn-danger tombol-in' style='width:170px;height:170px;padding: 10px 16px;font-size: 75px;line-height: 1.33;border-radius:135px'><img src='".base_url('assets/images/fp.png')."' alt='' style='height:90px;margin-top:30px' data-toggle='tooltip' title='Break Start' ></a>";
                } else if($sekarang >= $limitOut && $sekarang <= $limitIn ) { echo //matikan tombol start istirahat jika melewati batas 15 menit dari breakOut
                  "<a href='javascript:void(0)' class='btn btn-default ' style='width:170px;height:170px;padding: 10px 16px;font-size: 75px;line-height: 1.33;border-radius:135px'><img src='".base_url('assets/images/fp.png')."' alt='' style='height:90px;margin-top:30px'></a>";
                } else if($sekarang >= $limitIn && $sekarang <= $breakIn){ echo //aktifkan tombol start istirahat masuk jika sudah masuk batas 15 menit sebelum breakIn
                  "<a href='". site_url('C_Personal/breakOff/').encrypt_url($data["id_break"])."' class='btn btn-danger tombol-in' style='width:170px;height:170px;padding: 10px 16px;font-size: 75px;line-height: 1.33;border-radius:135px'><img src='".base_url('assets/images/fp.png')."' alt='' style='height:90px;margin-top:30px' data-toggle='tooltip' title='Break End' ></a>";
                }else if($sekarang >= $breakIn){ echo //matikan tombol start istirahat seteelah melewati batas waktu istirahat
                  "<a href='javascript:void(0)' class='btn btn-default ' style='width:170px;height:170px;padding: 10px 16px;font-size: 75px;line-height: 1.33;border-radius:135px'><img src='".base_url('assets/images/fp.png')."' alt='' style='height:90px;margin-top:30px'></a>";
                } ?>
            </div>
            <div class="">
              <div class="loader"></div>
            </div>
            <div class="box-footer" style="text-align:center">
                <?php if(date('l')=="Friday"){
                  echo "<small>Jam Kantor : 11:30 - 13:30 WIB</small>";
                }else echo "<small>Jam Kantor : 12:00 - 13:00 WIB</small>"; ?>
                <div><small>Alamat IP : <?= $this->input->ip_address();?></small></div>
            </div>
          </div>
        </div>
        <!-- /. Tab Istirahat -->
      </div>
    </div>

    
  </section>  <!-- Left col Tombol Absensi -->
  <!-- Right Colomn -->
  <section class="col-lg-9">
    <div class="nav-tabs-custom">
      <ul class="nav nav-tabs" role="tablist">
          <li class="active">
              <a href="#recordHadir" data-toggle="tab"><i class="fa fa-folder-o text-green" style="margin-right:10px"></i>Absensi</a>
          </li>
          <li>
              <a href="#recordBreak" data-toggle="tab"><i class="fa fa-folder-o text-red" style="margin-right:10px"></i>Istirahat</a>
          </li>
      </ul>
      <div class="tab-content">
      <!-- Tab Recor Absensi -->
        <div class="tab-pane active" id="recordHadir">
          <div class="box box-success">
            <div class="box-header"> 
              <h3 class="box-title" >Record Absensi</h3>
            </div>
            <div class="box-body table-responsive">
              <table id="tablehistory"  class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Hari</th>
                    <th>Tanggal</th>
                    <th>Masuk</th>
                    <th>Pulang</th>
                    <th>Terlambat</th>
                    <th>IP Address</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $no=1;
                  foreach ($rowabs as $data) { ?>
                    <tr <?= $data['absen_status'] == "2" ? "class='danger'" : null ?>>
                      <td><?= $no++; ?></td>
                      <td><?= $data['nickname']?></td>
                      <td><?php if($data['hari']=="Monday") echo "Senin";
                                elseif ($data['hari']=="Tuesday") echo "Selasa";
                                elseif ($data['hari']=="Wednesday") echo "Rabu";
                                elseif ($data['hari']=="Thursday") echo "Kamis";
                                elseif ($data['hari']=="Friday") echo "Jumat";
                                elseif ($data['hari']=="Saturday") echo "Sabtu";
                                elseif ($data['hari']=="Monday") echo "Minggu";
                      ?></td>
                      <td><?= date("d F Y", strtotime($data['tgl']))?></td>
                      <td><?= $data['jam_masuk']?></td>
                      <td><?= $data['jam_pulang']?></td>
                      <td>
                        <?php 
                          $jmIn = date_create($data['jam_masuk']);//jam realtime karyawan masuk
                          $jmDef = date_create('8:00:00'); //defualt jam masuk
                          $jmFdy = date_create('07:30:00'); //default jam masuk hari jumat
                          if($data['hari']=="Friday"){
                            $beda = date_diff($jmIn,$jmFdy);
                          }else {
                            $beda = date_diff($jmIn,$jmDef);}
                          echo $beda->h,'jam, '. $beda->i.'menit';
                        ?>
                      </td>
                      <td><?= $data['ipaddress']?></td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <!-- Tab Record Itirahat -->
        <div class="tab-pane" id="recordBreak">
          <div class="box box-danger">
            <div class="box-header"> 
              <h3 class="box-title" >Record Istirahat</h3>
            </div>
            <div class="box-body table-responsive">
              <table id="tablehistory2"  class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Tanggal</th>
                    <th>Mulai</th>
                    <th>Selesai</th>
                    <th>IP Address</th>
                  </tr>
                </thead>
                <tbody>
                <?php $no=1;
                  foreach ($rowDtBreak as $data) { ?>
                    <tr>
                      <td><?= $no++; ?></td>
                      <td><?= $data['nickname']?></td>                      
                      <td><?= date("d F Y", strtotime($data['tgl_break']))?></td>
                      <td><?= $data['start_break']?></td>
                      <td><?= $data['end_break']?></td>                      
                      <td><?= $data['ipaddress']?></td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>    
  </section><!-- ./ Right col -->
</div>
<?php } ?>
</section><!-- /.content -->


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
                        $("#headModal").html('<div class="col-sm-2"><img style="width:70px;height:relative" src="<?php echo base_url();?>uploads/image/'+foto+'" class="img-rounded"  alt="User Image" /></div><div class="col-sm-7" style="text-align:left"><h3>'+fname+'</h3><p><small>'+email+'</small></p></div><div class="col-sm-3" ><input type="text" class="btn btn-primary" style="height:6px;width:100px" id="apv" disabled></div>');
                        
                    });
                // })
            </script>
        </div>
    </div>

<!-- ./ Modal Detail  -->