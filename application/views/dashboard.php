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
        <!-- <div class="box-footer">
            Footer
        </div>/.box-footer -->
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

<!-- Small boxes (Stat box) -->
<?php if($this->fungsi->user_login()->id_lvl != "SC"){ ?>
    <div class="row">
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
          <div class="inner">
            <h3><?php $user = $this->fungsi->user_login()->id_kar;
            $this->db->where('id_kar',$user);
            $this->db->where('status',"Y");
            $this->db->from('tb_ijinsakit');
              echo $this->db->count_all_results(); ?></h3>
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
            $this->db->where('id_kar',$user);
            $this->db->from('tb_ijinpulcep');
              echo $this->db->count_all_results(); ?><sup style="font-size: 20px"></sup></h3>
            <p>Izin Pulang Cepat</p>
          </div>
          <div class="icon">
            <i class="fa fa-umbrella "></i>
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
            $this->db->where('id_kar',$user);
            $this->db->from('tb_ijinkeluar');
              echo $this->db->count_all_results(); ?></h3>
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
            $this->db->where('id_kar',$user);
            $this->db->where('absen_status',"2");
            $this->db->from('tb_absensi');
              echo $this->db->count_all_results(); ?>  <sup style="font-size:20px">X</sup></h3>
            <p>Terlambat</p>
          </div>
          <div class="icon">
            <i class="fa fa-briefcase"></i>
          </div>
          <a href="#" class="small-box-footer">
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
                    <td><?= $data->alasan ?> </td>
                    <td> <?php if($data->status == "N"){
                        echo "<i class='fa fa-thumbs-o-down text-red' style='font-size:20px'></i>";
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
    <div class="box box-success" >
      <div class="box-header">
        <!-- <i class="icon fa fa-archive"></i> -->
        <small style="text-align:center"><?php $hari= date("D"); switch ($hari) {
          case 'Sun' : $hari = "Minggu"; break;
          case 'Mon' : $hari = "Senin"; break;
          case 'Tue' : $hari = "Selasa"; break;
          case 'Wed' : $hari = "Rabu"; break;
          case 'Thu' : $hari = "Kamis"; break;
          case 'Fri' : $hari = "Jumat"; break;
          case 'Sat' : $hari = "Sabtu"; break;}  
          echo $hari, " - ", gmdate("d M Y", time()+60*60*7); ?></small>
        <!-- <small class="pull-right">Jam : <?= gmdate("G:i", time()+60*60*7); ?></small> -->
        <small id="clock" class="pull-right"></small>
        <h2 style="margin-top:5px;margin-bottom:5px;text-align:center" >Absensi</h2>
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
  </section>  <!-- Left col Tombol Absensi -->
  <!-- Right Colomn -->
  <section class="col-lg-9">
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
  </section><!-- ./ Right col -->
</div>
<?php } ?>
</section><!-- /.content -->