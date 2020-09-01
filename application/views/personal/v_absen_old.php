<!-- Halaman Absensi Karyawan -->
<!-- ditampilkan untuk semua akun security -->
<!-- ================================================ -->
<!-- Jam realtime -->
<script src="<?=base_url();?>assets/js/jquery-2.1.1.min.js" type="text/javascript"></script>
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

    // Untuk Proses pencarian RFID
    $(document).ready(function(){

        function cekRFID(){
            $("#loaderIcon").show();
            jQuery.ajax({
                url     : "<?= site_url('C_Personal/cekKartuId')?>",
                data    : 'id_kartu='+$("#rfid").val(),
                type    : "POST",
                success : function(data){
                    $("#hasilCheck").html(data);
                    $("#loaderIcon").hide();
                },
                error:function(){}
            });
        }

        $("#submit").on("click",function(){
            cekRFID();
        });

    });


    
</script>
<!-- Breadcumb section -->
<section class="content-header">
    <h1> <img src="<?=base_url()?>assets/images/fingerprint-black.png" alt="" style="height:30px">
        Halaman Absensi
        <small>Selamat Datang</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
</section>

<!-- FLASH DATA -->
<div class="punchflash" data-flashdata="<?=$this->session->flashdata('flash'); ?>"></div> 
<div class="gagalflash" data-flashdata="<?=$this->session->flashdata('flashGagal'); ?>"></div> 

<!-- Main content -->
<section class="content">
    <div class="row">
    <!-- Col Tombol -->
        <div class="col-lg-8">
        <!-- Box pencarian RFID -->
            <div class="box box-danger">
                <div class="box-header">
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
                </div>
                <div class="box-body">
                    <div class="form-inline">
                        <input type="password" name="rfid" id="rfid" class="form-control" style="width:72%;height:60px;font-size:30px" placeholder="Scan Kartu.." autofocus required autocomplete="off">
                        <button type="submit" id="submit"  class="btn btn-app" style="margin-top:10px"><i class="fa fa-check-square-o text-green" style="margin-left:5px;font-size:30px"></i></button>
                        <button type="reset" id="reset" onclick="location.reload()" class="btn btn-app" style="margin-top:10px"><i class="fa fa-repeat" style="margin-left:5px;font-size:30px"></i></button>                
                    </div>
                </div>
                <?php if(date('l')=="Friday"){
                    echo "<small style='margin-left:290px'>Jam Kantor : 07:30 - 17:30 WIB</small>";
                }else echo "<small style='margin-left:290px'>Jam Kantor : 08:00 - 17:00 WIB</small>"; ?>
                <div class="box-footer">
                <p><span id="hasilCheck"></span><img src="<?=base_url();?>assets/images/48x48.gif" id="loaderIcon" style="display:none"></<img> </p>
                </div>
            </div>
        <!-- ./ Box pencarian RFID -->
        </div>
    <!-- col table -->
        <div class="col-lg-4">
            <div class="box box-danger">
                <div class="box-header">
                    <h3 class="box-title">Kehadiran</h3>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="table3">
                            <thead class="">
                                <tr class="">
                                    <th style="width:20px">No</th>
                                    <th>Nama</th>
                                    <th>Masuk</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($dtabsen as $data){ ?>
                                <tr <?= $data['status'] == "2" ? "class='danger'" : null ?>>
                                    <td><?= $no++?></td>
                                    <td><?=$data['fullname'] ?></td>
                                    <td><?=$data['jam_masuk'] ?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>


