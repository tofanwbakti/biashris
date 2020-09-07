<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <!-- //Auto refresh 60detik -->
        <!-- <meta http-equiv="refresh" content="60">  -->
        <title><?php echo $judul ?></title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
		<!--===============================================================================================-->	
		<link rel="icon" type="image/png" href="<?php echo base_url();?>assets/images/icons/iconbmg.png"/>
        <!-- Bootstrap 3.3.2 -->
        <!-- <link href="<?php echo base_url();?>assets/AdminLTE-2.0.5/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" /> -->
        <!-- Bottstrap 3.3.7 -->
        <link href="<?php echo base_url();?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- Font Awesome Icons -->
        <link href="<?php echo base_url();?>assets/font-awesome-4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css">

        <!-- <link href="<?php echo base_url();?>assets/fontawesome-5.12.0/css/all.min.css" rel="stylesheet" type="text/css" /> -->
        <!-- Ionicons -->
        <link href="<?php echo base_url();?>assets/ionicons-2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="<?php echo base_url();?>assets/AdminLTE-2.0.5/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
        <!-- AdminLTE Skins. Choose a skin from the css/skins 
            folder instead of downloading all of them to reduce the load. -->
        <link href="<?php echo base_url();?>assets/AdminLTE-2.0.5/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
        <!-- DATA TABLES -->
        <link href="<?php echo base_url();?>assets/AdminLTE-2.0.5/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
        <link href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
        <!-- Datepicker -->
        <link rel="stylesheet" href="<?= base_url();?>/assets/datepicker-1.9.0/css/bootstrap-datepicker3.css" type="text/css">
        <link rel="stylesheet" href="<?= base_url();?>/assets/css/bootstrap-datetimepicker.min.css" type="text/css">
        <!-- Date Range Picker -->
        <link href="<?php echo base_url();?>assets/css/daterangepicker.css" rel="stylesheet" type="text/css" />
        <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/3.1.3/css/bootstrap-datetimepicker.min.css"> -->
        <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"> -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.3/css/bootstrapValidator.min.css">
        <!-- Bootstrap time Picker -->
        <link href="<?php echo base_url();?>assets/AdminLTE-2.0.5/plugins/timepicker/bootstrap-timepicker.min.css" rel="stylesheet"/>
        <!-- Sweer Alert -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet" type="text/css"/>
        <!-- Accordion style -->
        <link href="<?php echo base_url();?>assets/css/style.css" rel="stylesheet" type="text/css" />
        <!-- Dropify -->
        <link href="<?php echo base_url();?>assets/dropify/dropify.min.css"  rel="stylesheet" type="text/css" />
        <!-- Validetta 1.0.1 -->
        <!-- <link href="<?php echo base_url();?>assets/css/validetta-1.0.1/validetta.min.css" rel="stylesheet" type="text/css" /> -->
        <!-- Morris charts -->
        <link rel="stylesheet" href="<?php echo base_url();?>assets/AdminLTE-2.0.5/plugins/morris/morris.css">
        <!-- Custom CSS -->
        <link href="<?php echo base_url();?>assets/css/mycustom.css" rel="stylesheet" type="text/css" />


        <!-- <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" /> -->
        <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" /> -->
</head>
<body class="skin-blue">
    <!-- Site wrapper -->
    <div class="wrapper">

        <header class="main-header">
            <a href="<?= site_url('Dashboard')?>" class="logo"><img src="<?php echo base_url();?>assets/images/biashris-white.png" alt="IMG" style="width:60%" class="responsive"></a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <!-- Messages: style can be found in dropdown.less-->
                        
                        <!-- Notifications: style can be found in dropdown.less -->
                        <li class="dropdown notifications-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-user-o" data-toggle="tooltip" data-placement="left" title="Online"></i>
                                <span class="label bg-aqua">
                                <?php 
                                    $level = $this->fungsi->user_login()->id_lvl;
                                    if($level != "A1"){                                
                                        $this->db->where('status',"ON");
                                        $this->db->where('email !=',"admin@batam-samudra.id");
                                        $this->db->from('tb_login');
                                        echo $this->db->count_all_results();
                                    }else{
                                        $this->db->where('status',"ON");
                                        $this->db->from('tb_login');
                                        echo $this->db->count_all_results();
                                    }
                                ?>
                                </span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">Online User</li>
                                <li>
                                    <ul class="menu">
                                        <?php   $level = $this->fungsi->user_login()->id_lvl;
                                            if($level != "A1"){
                                                $this->db->select('*');
                                                $this->db->from('tb_login');
                                                $this->db->join('tb_karyawan','tb_karyawan.email = tb_login.email','left');
                                                $this->db->where('status',"ON");
                                                $this->db->where('tb_login.email !=',"admin@batam-samudra.id");
                                                $this->db->limit(5);
                                                $this->db->order_by('time_login','DESC');
                                                $data = $this->db->get();
                                                if($data->num_rows() > 0){
                                                    foreach($data->result_array() as $row){
                                                        echo "<li><a href='javascrip:void(0)'><i class='fa fa-user text-aqua'></i> ".$row['nickname']." <small class='pull-right text-muted'> ".$row['time_login']."</small></a></li>";
                                                    }
                                                }else{
                                                    echo "not OK";
                                                }
                                            }else{
                                                $this->db->select('*');
                                                $this->db->from('tb_login');
                                                $this->db->join('tb_karyawan','tb_karyawan.email = tb_login.email','left');
                                                $this->db->where('status',"ON");
                                                $this->db->limit(5);
                                                $this->db->order_by('time_login','DESC');
                                                $data = $this->db->get();
                                                if($data->num_rows() > 0){
                                                    foreach($data->result_array() as $row){
                                                        echo "<li><a href='javascrip:void(0)'><i class='fa fa-user text-aqua'></i> ".$row['nickname']." <small class='pull-right text-muted'> ".$row['time_login']."</small></a></li>";
                                                    }
                                                }else{
                                                    echo "not OK";
                                                }
                                            }                                                
                                        ?>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        
                        <!-- Tasks: style can be found in dropdown.less -->
                        
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">                                
                                <img src="<?php echo base_url();?>uploads/image/<?=$this->fungsi->user_login()->foto ?>" class="user-image" alt="User Image"/> 
                                <span class="hidden-xs" id="namaUser"><?= $this->fungsi->user_login()->nickname ?> <span class="caret"></span></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header">
                                    <img src="<?php echo base_url();?>uploads/image/<?=$this->fungsi->user_login()->foto ?>" class="img-circle" alt="User Image" />
                                    <p>
                                    <?= $this->fungsi->user_login()->fullname ?> - <?= $this->fungsi->user_login()->nama_jab ?>
                                        <small><?php $email = $this->fungsi->user_login()->email;
                                        $this->db->select('*');
                                        $this->db->from('tb_kontrak');
                                        $this->db->where('email',$email); 
                                        $this->db->where('status','Y');                   
                                        $query =  $this->db->get();
                                        foreach($query->result() as $row){
                                            echo $row->nip;
                                        }?></small>
                                    </p>
                                </li>
                                <!-- Menu Body -->
                                
                                
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="<?=site_url('C_Personal/gantiPassword') ?>" class="btn btn-default btn-flat" >Ganti Password</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="<?=site_url('Auth/logout') ?>" class="btn btn-default btn-flat">Keluar</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>

        <!-- =============================================== --><!-- Left side column. contains the sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left image">
                <img src="<?php echo base_url();?>uploads/image/<?=$this->fungsi->user_login()->foto ?>" class="img-circle" alt="User Image" />
                </div>
                <div class="pull-left info">
                    <p style="word-wrap: break-all;width: 140px"><?=$this->fungsi->user_login()->fullname ?></p>

                    <a href="#"><i class="fa fa-circle text-aqua" id="blink-text"></i> Online</a>
                </div>
            </div>
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu">
                <li class="header">MENU UTAMA</li>
                <li>
                    <a href="<?= site_url('Dashboard')?>">
                        <!-- <i class="fa fa-envelope"></i> <span>Mailbox</span> -->
                        <i class="fa fa-dashboard"></i><span>Dashboard</span>
                        <!-- <small class="label pull-right bg-yellow">12</small> -->
                    </a>
                </li>
                
                <!-- PEMBATASAN MENU UNTUK SECURITY / SC  -->
                <?php if($this->fungsi->user_login()->id_lvl != "SC"){?>
                <!-- <li class="header">INFO PERSONAL</li> -->
                <li class="treeview">
                    <a href="<?= site_url('C_Personal/data_pri')?>"><i class="fa fa-user"></i> Info Pribadi </a>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-id-card"></i> </span>Kepegawaian</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="<?= site_url('C_Personal/kepeg')?>"><i class="fa fa-id-badge"></i> </span>Data Pegawai</span></a></li>
                        <!-- <li><a href="<?= site_url('C_Personal/nilai')?>"><i class="fa fa-id-badge"></i> </span>Penilaian</span></a></li> -->
                        <li><a href="<?= site_url('C_Personal/cuti')?>"><i class="fa fa-id-badge"></i> </span>Cuti</span></a></li>
                    </ul>
                </li>
                
                <li class="header">PERMOHONAN IZIN</li>   
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-book text-warning"></i> </span>Izin</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li>
                            <a href="<?= site_url('C_Personal')?>"><i class="fa fa-share text-warning"></i> Keluar Kantor</a> 
                        </li>
                        <li>
                            <a href="<?= site_url('C_Personal/ijinLambat')?>"><i class="fa fa-sign-in text-warning"></i> Lambat Masuk</a> 
                        </li>
                        <li>
                            <a href="<?= site_url('C_Personal/pulcep')?>"><i class="fa fa-share-square-o text-warning"></i> Pulang Cepat</a> 
                        </li>
                        <li>
                            <a href="<?= site_url('C_Personal/isak')?>"><i class="fa fa-user-md text-warning"></i> Sakit</a> 
                        </li>
                        <li>
                            <a href="<?= site_url('C_Personal/alpa')?>"><i class="fa fa-flag text-warning"></i> Tidak Masuk</a> 
                        </li>
                    </ul>
                </li> 
                <?php } else { ?>
                <li class="treeview">
                    <a href="<?= site_url('C_Personal/absenHome')?>"><i class="fa fa-user"></i> Absen Karyawan </a>
                </li>
                <?php } ?>
<!-- MENU Untuk HRD -->
                <?php if(($this->fungsi->user_login()->id_lvl == "A2") || ($this->fungsi->user_login()->id_lvl == "A1") )  { ?>
                <li class="header">HRD</li>
                <li><a href="<?= site_url('Hrd')?>"><i class="fa fa-pie-chart text-danger"></i> Central Informasi HR</a></li>
                <li class="treeview">
                    <a href="#"><i class="fa fa-tags text-danger"></i> Master Data <i class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                    <!-- <li><a href="<?= site_url('Hrd/karyawan')?>"><i class="fa fa-user text-danger"></i> Karyawan</a></li> -->
                        <li>
                        <a href="#"><i class="fa fa-building-o text-danger"></i> Perusahaan <i class="fa fa-angle-left pull-right"></i></a>
                            <ul class="treeview-menu">
                                <li><a href="<?php echo base_url();?>Hrd/sbu"><i class="fa fa-circle-o text-danger"></i> Data SBU & Unit </a></li>
                                <li><a href="<?= site_url('Hrd/jabatan')?>"><i class="fa fa-circle-o text-danger"></i> Data Jabatan</a></li>
                                <li><a href="<?= site_url('Hrd/departemen')?>"><i class="fa fa-circle-o text-danger"></i> Data Departemen</a></li>
                                <li><a href="<?= site_url('Hrd/datacuti')?>"><i class="fa fa-circle-o text-danger"></i> Data Cuti</a></li>
                                <!-- <li><a href="<?= site_url('Hrd/indexNilai')?>"><i class="fa fa-circle-o text-danger"></i> Data Index Penilaian</a></li>
                                <li><a href="<?= site_url('Hrd/struktur')?>"><i class="fa fa-circle-o text-danger"></i> Data Struktur Org.</a></li>  -->                               
                                <!--  <li><a href="#"><i class="fa fa-circle-o text-danger"></i> Jam Kerja</a></li> -->
                            </ul>
                        </li>
                        <li>
                        <a href="#"><i class="fa fa-cogs text-danger"></i> Aplikasi <i class="fa fa-angle-left pull-right"></i></a>
                            <ul class="treeview-menu">
                                <li><a href="<?= site_url('Hrd/user')?>"><i class="fa fa-circle-o text-danger"></i> Data User </a></li>
                                <li><a href="<?= site_url('Hrd/kartuId')?>"><i class="fa fa-circle-o text-danger"></i> Data Kartu ID</a></li>
                            </ul>
                        </li>                        
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#"><i class="fa fa-tags text-danger"></i> HR Manajemen <i class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                        <li><a href="<?= site_url('Hrd/karyawan')?>"><i class="fa fa-user text-danger"></i> Manajemen Karyawan</a></li>
                        <li><a href="<?= site_url('Hrd/kontrak')?>"><i class="fa fa-archive text-danger"></i> Manajemen Kontrak</a></li>
                        <li><a href="<?= site_url('Hrd/cuti')?>"><i class="fa fa-archive text-danger"></i> Manajemen Cuti</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#"><i class="fa fa-file-text text-danger"></i> Laporan<i class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                        <li><a href="<?= site_url('Hrd/laporanAbsensi')?>"><i class="fa fa-file-text-o text-danger"></i> Absensi</a></li>
                        <li><a href="<?= site_url('Hrd/laporanIzin')?>"><i class="fa fa-file-text-o text-danger"></i> Izin</a></li>
                        <li><a href="<?= site_url('Hrd/laporanKontrak')?>"><i class="fa fa-file-text-o text-danger"></i> Kontrak Karyawan</a></li>
                    </ul>
                </li>
                <?php } ?>
                <?php if($this->fungsi->user_login()->id_lvl == "A1") { ?>
                <!--<li class="header">HRD</li>
                    <li><a href="<?= site_url('Hrd')?>"><i class="fa fa-tags text-info"></i> Central Informasi HR</a></li>
                <li class="treeview">
                    <a href="#"><i class="fa fa-tags text-danger"></i> Master Data <i class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                        <li>
                        <a href="#"><i class="fa fa-user text-danger"></i> Manajemen User <i class="fa fa-angle-left pull-right"></i></a>
                            <ul class="treeview-menu">
                                <li><a href="<?= site_url('Hrd/karyawan')?>"><i class="fa fa-circle-o text-danger"></i> Daftar Karyawan</a></li>
                                <li><a href="<?= site_url('Hrd/user')?>"><i class="fa fa-circle-o text-danger"></i> Daftar User</a></li>
                            </ul>
                        </li>
                        <li>
                        <a href="#"><i class="fa fa-building-o text-danger"></i> Perusahaan <i class="fa fa-angle-left pull-right"></i></a>
                            <ul class="treeview-menu">
                                <li><a href="<?php echo base_url();?>Hrd/sbu"><i class="fa fa-circle-o text-danger"></i> Data SBU </a></li>
                                <li><a href="<?= site_url('Hrd/jabatan')?>"><i class="fa fa-circle-o text-danger"></i> Jabatan</a></li>
                                <li><a href="#"><i class="fa fa-circle-o text-danger"></i> Golongan</a></li>
                            </ul>
                        </li>
                    </ul>
                </li> -->
                <li class="header">DEVELOPER</li>
                <li><a href="<?= site_url('Developer')?>"><i class="fa fa-tags text-info"></i>Developer</a></li>
                <li><a href="<?= site_url('C_Personal/absenHome')?>"><i class="fa fa-user"></i> Absen Karyawan </a></li>
                <?php } ?>
                
            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- =============================================== -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper"><!-- Content Header (Page header) -->
    <?php echo $contents ?>
    </div><!-- /.content-wrapper -->

    <footer class="main-footer">
        <div class="pull-right hidden-xs">
        
            <b>Version</b> 20.08.5  <!-- [Tahun].[Bulan].[Upgrade ke]  -->
        </div>
        <strong>Copyright &copy; 2019 <a href="#">ICT Bias Mandiri Group</a>.</strong> All rights reserved.
    </footer>
    </div><!-- ./wrapper -->

    <!-- jQuery 2.2.3 -->
    <!-- <script src="<?php echo base_url(); ?>assets/AdminLTE-2.0.5/plugins/jQuery/jQuery-2.1.3.min.js"></script> -->
    <script src="<?php echo base_url(); ?>assets/js/jquery-2.2.3.min.js"></script>    
    
    <!-- Bootstrap 3.3.5 JS -->
    <script src="<?php echo base_url();?>assets/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- SlimScroll -->
    <script src="<?php echo base_url();?>assets/AdminLTE-2.0.5/plugins/slimScroll/jquery.slimScroll.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='<?php echo base_url();?>assets/AdminLTE-2.0.5/plugins/fastclick/fastclick.min.js'></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url();?>assets/AdminLTE-2.0.5/dist/js/app.min.js" type="text/javascript"></script><!--tambahkan custom js disini-->
    <!-- FLOT CHARTS -->
    <script src="<?php echo base_url();?>assets/AdminLTE-2.0.5/plugins/flot/jquery.flot.min.js" type="text/javascript"></script>
    <!-- FLOT RESIZE PLUGIN - allows the chart to redraw when the window is resized -->
    <script src="<?php echo base_url();?>assets/AdminLTE-2.0.5/plugins/flot/jquery.flot.resize.min.js" type="text/javascript"></script>
    <!-- FLOT PIE PLUGIN - also used to draw donut charts -->
    <script src="<?php echo base_url();?>assets/AdminLTE-2.0.5/plugins/flot/jquery.flot.pie.min.js" type="text/javascript"></script>
    <!-- FLOT CATEGORIES PLUGIN - Used to draw bar charts -->
    <script src="<?php echo base_url();?>assets/AdminLTE-2.0.5/plugins/flot/jquery.flot.categories.min.js" type="text/javascript"></script>
    <!-- DATA TABES SCRIPT -->
    <script src="<?php echo base_url();?>assets/AdminLTE-2.0.5/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>assets/AdminLTE-2.0.5/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>assets/datatables/Buttons-1.6.1/js/dataTables.buttons.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>assets/datatables/Buttons-1.6.1/js/buttons.flash.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>assets/datatables/Buttons-1.6.1/js/buttons.html5.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>assets/datatables/Buttons-1.6.1/js/buttons.print.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>assets/datatables/JSZip-2.5.0/jszip.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>assets/datatables/pdfmake-0.1.36/pdfmake.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>assets/datatables/pdfmake-0.1.36/vfs_fonts.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>assets/datatables/Scroller-2.0.1/js/dataTables.scroller.min.js" type="text/javascript"></script>
    <!-- bootstrap time picker -->
    <script src="<?php echo base_url();?>assets/AdminLTE-2.0.5/plugins/timepicker/bootstrap-timepicker.min.js" type="text/javascript"></script>
    <!-- DatePicker -->
    <script src="<?php echo base_url();?>assets/datepicker-1.9.0/js/bootstrap-datepicker.js"></script>
    <script src="<?php echo base_url();?>assets/datepicker-1.9.0/locales/bootstrap-datepicker.id.min.js"></script>
    <!-- Moment -->
    <script src="<?php echo base_url();?>assets/js/moment.js"></script>
    <script src="<?php echo base_url();?>assets/js/moment-with-locales.js"></script>
    <!-- Date Range Picker -->
    <script src="<?php echo base_url();?>assets/js/moment.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/daterangepicker.js"></script>
    <!-- Datetimepicker -->
    <script src="<?php echo base_url();?>assets/js/bootstrap-datetimepicker.js"></script>
    <!-- Sweet Alert -->
    <!-- <script src="<?php echo base_url();?>assets/sweetalert2/dist/sweetalert2.min.js" type="text/javascript"></script> -->
    <script src="<?php echo base_url();?>assets/sweetalert2/dist/sweetalert2.all.min.js" type="text/javascript"></script>
    <!-- Dropify -->
    <script src="<?php echo base_url();?>assets/dropify/dropify.min.js" type="text/javascript"></script>
    <!-- Filestyle -->
    <script src="<?php echo base_url();?>assets/dropify/bootstrap-filestyle.min.js" type="text/json"></script>
    <!-- Myscript -->
    <script src="<?php echo base_url();?>assets/js/myscript.js" type="text/javascript"></script>
    <!-- Morris.js charts -->
    <script src="<?php echo base_url();?>assets/AdminLTE-2.0.5/plugins/morris/raphael-min.js"></script>
    <script src="<?php echo base_url();?>assets/AdminLTE-2.0.5/plugins/morris/morris.min.js" type="text/javascript"></script>
    <!-- ChartJS 1.0.1 -->
    <script src="<?php echo base_url();?>assets/AdminLTE-2.0.5/plugins/chartjs/Chart.min.js" type="text/javascript"></script>
    <!-- show HIde Password -->
    <script src="<?php echo base_url();?>assets/dist/bootstrap-show-password.min.js" type="text/javascript"></script>
    <!-- MD5 -->
    <script src="<?php echo base_url();?>assets/js/md5.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>assets/js/md5.min.js" type="text/javascript"></script>

    <!-- Script Sections -->
    <script type="text/javascript">
        
    // Untuk Datatables
        $(document).ready(function(){
            $('#tablehistory').DataTable()
        });
        $(document).ready(function(){
            $('#tablehistory2').DataTable()
        });
        $(document).ready(function(){
            $('#tablehistory3').DataTable()
        });
        $(document).ready(function(){
            function getBase64FromImageUrl(url) {
            var img = new Image();
                img.crossOrigin = "anonymous";
            img.onload = function () {
                var canvas = document.createElement("canvas");
                canvas.width =this.width;
                canvas.height =this.height;
                var ctx = canvas.getContext("2d");
                ctx.drawImage(this, 0, 0);
                var dataURL = canvas.toDataURL("image/png");
                return dataURL.replace(/^data:image\/(png|jpg);base64,/, "");
            };
            img.src = url;
            }
            // DataTable initialisation
            $('#tablereport').DataTable(
                {
                    "dom": '<"dt-buttons"Bf><"clear">lirtp',
                    "paging": true,
                    "autoWidth": true,
                    "buttons": [
                        {
                            text: 'PDF',
                            extend: 'pdfHtml5',
                            filename: 'biashris',
                            orientation: 'portrait', //portrait
                            // orientation: 'landscape', //portrait
                            pageSize: 'A4', //A3 , A5 , A6 , legal , letter
                            exportOptions: {
                                columns: ':visible',
                                search: 'applied',
                                order: 'applied'
                            },
                            customize: function (doc) {
                                //Remove the title created by datatTables
                                doc.content.splice(0,1);
                                //Create a date string that we use in the footer. Format is dd-mm-yyyy
                                var now = new Date();
                                var jsDate = now.getDate()+'-'+(now.getMonth()+1)+'-'+now.getFullYear();
                                // Logo converted to base64
                                // var logo = getBase64FromImageUrl('https://datatables.net/media/images/logo.png');
                                // The above call should work, but not when called from codepen.io
                                // So we use a online converter and paste the string in.
                                // Done on http://codebeautify.org/image-to-base64-converter
                                // It's a LONG string scroll down to see the rest of the code !!!
                                var logo = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAusAAAH9CAYAAACjnjImAAAABGdBTUEAALGPC/xhBQAAACBjSFJNAAB6JgAAgIQAAPoAAACA6AAAdTAAAOpgAAA6mAAAF3CculE8AAAABmJLR0QA/wD/AP+gvaeTAAAACXBIWXMAAC4jAAAuIwF4pT92AAAAB3RJTUUH4wsTAS8cbqcE+QAAgABJREFUeNrs/Xf8LFld548/T1WnT7g5zJ2cM8MwQxwcYEiCgIAEgcW0suquu7q6u67u7tcN+nPdYFgVUVEMKCIqqCAqkuNIHhgGJud4872f2KHq/P6oqu7q6gqnqqu7qz+f9+s+PrerTq7qUK961eu8j0IgEAgqjptuflNcsor8Abj+HwCfuOHdcfUXgD3Afv/vgP+3H9gH7AV2+X9LwCLQAhpAE6gBtv8X9O0CGnCAHtAFOkAb2ADWgdP+30ngmP93BDgMHPX/jvllehnHEPSN32/Q/xCCugKBQCCYX6jxmxAIBIJyEUPOA1Js+ftDpDyCBnAGcDZwHnCh/3oucAiPlO/BI+L1WR+rD41H6lfxSPsR4FHgQeAB4H7gIT/tZMKxB+dH+e3puHJC4AUCgWC+IGRdIBDMFAmqeUA6A9U6jpw28Uj4JcBVwBXAZcD5eGS9ZdB9QGphWJlWCdtpacS0E93XMe0ozH6LNXAKeAS4B7gD+BZwu79/JKH9MIEfUeCFvAsEAkG1IWRdIBBMHTEE3WKgmjuMks5F4GLgycB1/utleOp5LaGbKDkNk+LoaxUQvmkI30QE47RT6p7GU9+/CXwVuMXffpTRG53gXAt5FwgEgjlAlS5UAoFgiyLB1hIovlFyroAz8Uj5M4FnAE/y06yY5sPKe5yPfasgicyH/ethbAB345H3zwNfwFPi1yLlgvouozcJQt4FAoFgxthqFzOBQFARpKjncbaWc/GI+XOBG4Ar8TzlYYSV4K1Myosg6lEPP6kIl3kc+ArwaeAzwNfwfPIBAgVfVHeBQCCoCOQiJxAISkOEoKep57vxyPkLgecB1+BFaQkjIPXRyaUCM0QJfJwC/xie6v5R4BN4/vdeKD+sug/dYAlxFwgEgulAyLpAIBgLhgRdAZcCLwZeAjwbL0xiGEH5cBuCchG2ukTJu4s3afVjwN8Dn8WLPBNMTk18MiLEXSAQCCYHuRgKBILcSLG4hAl6Dc93/grgZcC1DIdKDCvnQs5ng7DdJSDvwQ3TUeBTwPuBD+NNVg0Q934DQtwFAoGgbMjFUSAQGCEHQX8a8BrgO4HLGf6d6SHkvMoIbqCinvc1PI/7+4AP4oWPDIi9HarbJ+5C2gUCgaAcyMVSIBCkIsHmAh5JD9KuAb4bj6RfGSofrOopBH3+EH7vwmEj14BPAu/BI+7H/PSgnNhkBAKBoETIhVMgEIzAUEU/B3gd8CY8NT0g8QHJi4tIIphPRCeqBlaZE8DfAX+CN0F10y8Ta5MR0i4QCAT5IWRdIBD0EUPSA0U1UNFbeJNE/zneRNFFP10I+vZBEnG/F3g3HnG/3c8XtV0gEAjGhJB1gUAQZ3WxGVZFLwa+D/he4EIGBK1H9uqagq2LuJu0Lp7K/rt4Npl1Pz164wcIaRcIBIIsCFkXCLYpDKwuNvAC4EeBl+Kp6jBQSZNWzhRsT4Q/F+B9Nh4E/gh4B/CAny4WGYFAIMgBudAKBNsMCSQ9vNz8Tjwf+o8CT/bLiM1FYIqoTQZgA/gb4NeBm/20uCc4QtoFAoEgAiHrAsE2QYofPSDp5wD/EngLcIjhFTBFRRcUQfQpjMZbbOlXgL/Fs8wIaRcIBIIUyMVXINjiMCDpVwA/CfwzYJl4ZVQgGAdxT2a+Bfwq8C48X7uQdoFAIIiBkHWBYIvCgKRfC/wM8Fq8lUXF6iKYBoIJpoH96kHg/+H52k8jpF0gEAiGIGRdINiCiBD1qCf9euC/AK9iEHrPQawuguki+DwGn8/H8Ej77wCnGCykJSujCgSCbQ25MAsEWwgZJP0a4L8Br2Y49rWQdMEsEUfafxmPtK+G0iXko0Ag2JaQC7RAsAUQEyc9rEheDPx34I1ALZQufnRBlRAl7Q8BvwD8IdBGSLtAINimELIuEMwxEnzpwQTRM4D/DPwwXox0IemCeUCUtN8O/CzwXgaf3/AkaCHsAoFgS0PIukAwp4gQ9fDqkIvAjwP/EdjDKPkRCOYB0c/t54CfBj6D+NkFAsE2gly4BYI5Q4LlJbAGfDfwi8BFCEkvHSp0GqMnVA9t61Caji03+oYMWs/bzxZH+ImQBv4CL4rRfYg1RiAQbAPIBVwgmBNkWF6uw1to5qZQmpD0nAhIcnDSdP9V46LRWuN6W/6KUbpfL6hpobCUwsJC+dtqqMRo27rftv+nvV6CHrT2+1H027JQKBX0oobe6HDbWwgBIbeBNbxJqP/H3xZrjEAg2LKQC7lAMAdIiPLi4Nlcfg5v5dGanxao7YIEBLQ5TJxdXFyfjAd03CPFFnVl01A1WqpBy2rQUk0WrAYLVpOWatC0GrRUnYaqU1c1asrGxsJWNjUsLGWhIqTd69f752oXB42jXRwcHO3Q1T3aukdbd2nrDptuhw23zbrbZkO32XTbbLodOrpHV/dwcNFa+4TewkZhKcu/aRgcZ9DvHCP8Gb8X+A/AXyHWGIFAsEUhZF0gqDAyLC/fg6csnsmw6igIIUzMA63awQ2p12Bj0bDqLKomy9YCO+0ldlqL7LSX2GEtsGi1WFANmj4Zty0blahoD1R3hRoixjqirqvQf0FbYQ1eKT9FecUC9d3RLl3do6N7bOg2684mK+46p5w1TjmrnHbWOO2us+Zu0nY79HBAg6UUNja2svr9zCmBjz49+iDwE8DdDM/fAISwCwSC+YaQdYGgokiZQHoZ8FbgxYjlZQRhu4lnK3FxfGKugIaqs2S12GUvsdfeyR57B3vsZXbaSyyqJk2rgaeLe1Q2bIHRgFaasCc9yV/eT+8zchV5g/RQjTgPu1bRNoNXq2+FCVtulM++HVzausuau8FpZ43jzgpHe6c41jvFCWeFVWeDtu7gaj1E4AMNPmzxqTjCfvY14Ofx7DE9Bk+aRGUXCARzDbm4CwQVQ4yabjMgH/8B+K/AAmJ5AYaV80B17vmial3ZLFsL7LF3cMDexYHabvbaO9lhLbBgNbGV3afkTt8GA+FpnAO1W438YqqEn9Bhoh4eZdLoo8lJ5UfrDJNq1b83sHz7jR3YcICedth0O5x21jjqnOKJ7gme6B7nqHOS0846HbcLQE3Z1JQ9T+Q9/F34Kp4t7AuIyi4QCLYAhKwLBBVCijf9OuB3gacilpe+hcP1SbajHTTQVHV22UscsHdzqLaHg7U97LaXWbSa1PzT5eB6xBwISLkaajVNIY9JJyG9dKKerMIPjSXUb5Rge2zW89LbeD56V7usu5scd1Z4vHuMR7pHeLx7jOO9FTbdNpph8l5h4h48ZbLxviO/grdi7waisgsEgjmGkHWBoALIUNP/i/9X99NstuF3NyCkLi497eCiqSmbXdYSZ9T2cFZ9H4dqe9lj76ClGj6Zd+npQfSWYS949CTGk+RqKOrJSntSn0nloyReAZayvEmxykJr2NQdTvRWeLR7hAc7T/BI5wjHndN03B6WUp5v33+gU0HyHr6Z/RbwQ8BnkYgxAoFgTrHtLvgCQdUQo6ZbeKT8GuD3gaexDdX0MD11cOnpHgALVpMD9m7OrR/g7Np+9tV2smg1Uaghf3pAzkemgc6UqKeT9Ni8tLGNVMq2z4zk+zuagYveQvXVdK1hQ29yuHuSBztPcF/7UR7rHmXF3UBr3Y9+E57AWwFovO9MDY+c/x88lb2DqOwCgWDOIGRdIJghYiaRBhPm/h3wP4Em20xNVyMEXbHTWuTM+l7Or5/BWbV97LaXqWHjoumFTC2j8VkYj6hHMvIQ9Un409PGZkLU40h6Ur4O0W4bi5qqYSsLR7ucdFZ4qPMEd7cf5oH245xwVnG1GyHulaDt4QmoXwV+APg6AxIvKrtAIKg8tsXFXyCoGlJsL2fjqenfzjZS0wOK7eCFJAwI+jn1/VzYOJOzavvYYS2gUPS0gxPEQVfh6C9pa4KSajGpHlHPb3sxVtONCX40Z/C0oqZs6tTQwIq7zkPdJ7hz8yHubT/K8d4pXK1pWDVq2FVQ28Mqexv4aeDXGA2FKoRdIBBUEkLWBYIpI2US6avxJpHuZxuo6YFFxUXT1T1cNMvWAufU93Nx/SzOru9jh7UIKHrBoj/QX7Ezi0iPpCkzEl1Vol7U9hKvpmf72tPy+wRcKWpY1FUNpRSrzjoPdB7nWxsPcG/7EU72VkApGqqOjdVfBGpGCN/8/i3wFuAwYosB4LY33JCUpSKv0e0k6ITXIVz9nptnfegCQeWxZYmAQFBFxNheHLyJo78E/DjDj+23JALS2cOhpx2aqs6Ztb1c0jiL8+tnsMte8vK1O2RvCb8WIeqRapgS9cw+xvCo5ybqRqr4OGp6FokfjH0Y2v/Qeiu9ohSneivc3X6E2zbu5f72Y6y7m9RVzSP20F+QasoIq+yP4tliPsw2scUkEHIV+Qufq6HVYPMS60h/wZOMQdTRSPtF+xEItjqErAsEU0CK7eUS4F3AM/z9YILploMVUtE1sNfewcWNM7mkfhYHaruoYdPFxfEFUCvmNJhO+CziU58foj5ZNd2EpKfdIAQkvIZNw6rhapcnusf55ub93LZxL493j6HRNFUDa3Zqu8OAOP534H+wxWwxKcQ8TJiHblACkhypW8Nb12GH/7fk77eAhp9v+e108axGG8A6sAKcAlbxJvf2+wn1ER5TQN6HPhBC3gXbHULWBYIJIyXay3fh+dN3MwjTuKUQeNF7vhe9oeqcU9vPFc1zOa9+kEXV9CeSOv5qnapvj4lry98YTSMhbQKRX+aGqJelpieS9HSnezhcZl3Vqasa6+4m97Yf4Zb1O7lr82HW3U0aqk5dzcTbHhDVGvAh4HuBI/5+Lyg0D4TdkJgPWX1CqAMHgXOAC4DzgfP8/TOAvcAeYBGPoOd56tfGI+0n8SxHjwD3AncBt/uvj0fGFYgZscq7EHfBdoSQdYFggkiJ9vI/gf/EFrW99K0u2qGHw05rkYsbZ3FF4xwO1nZjYfs+ddcj58qKrT+yX5JPfWsR9Ww1fZokPW5P+1TcwqKp6mjg8d4xvrZ+F19fv4djvVPYyqKh6qHyU0HYFvMg8EbgZiruYzcg50OKeSh/P3AZcDXwJOAK4CLgTDwyboqg7egbFfa3m/CLNeAevEg9nwU+B9xB6GYJ770I3qc+hLQLthOErAsEE0KEqAdq3T7gT4CXsgVtLwHBDCaM7rd3cWXzXC5tnM1Oa7GvogdlB5xSjbQx0u4U7S9zS9RzqulZlhcTkq4yUqL5rh/FJ/Cvn3LWuG3jXr68djsPdw4D0OwvajU10u7g3TB3gR8DfoeKLaIUQ9CzyPkO4Eq8VY+fDlyLZ7vbmdBFVMlOIt55eEN4cml0omncb58D3Al8BHg/HoHfiJQfuokS0i7YDhCyLhCUjAhJhwFRfwrwl8DFbLFoLwG57OguoDirvpermxdwUf0QLdWgq3v0cAeRXPr1MCPq/cIG5UJtlkXU++kG5Hn2RN3MW26upucn6SqzsOp71WvYNK0GbbfDHZsP8oW127hn8xEc7dC0Gv25DlNA+CnX2xhM+J6Jjz1BPQ8I64jSjCcEXAfcCNyA93tzMKaNcN2kyaXTQkDigxuN6G/ig8D7gD8GvhIaczA5X0i7YFtgSxAFgaAqSJlI+jrgD/EmZwUq3twjTNKVUpxbO8A1zQs5r36QurLp+Ap7nBfdRFWfNlFPbX9aRH0sf3pBNb0wSU/ZU+Y1XVzPImM1cLTDve1H+afVb3D7xgP0dG+apD1si/kY8AbgKFPysSeo5+GJr+ETsIhHzp8P3ARcj+ctjzseGKjwVb/uB08Jwsq7i6ey/wbwN3iTVcNhb/sQ0i7Yiqj6l1YgmBukxE//z8AvMFCP5t72EibpForz6ge5tnkR59QPoJTyFzaKkvN8RL2flkGmp+tTz+MbNy87WX+6mZqeZXlJyk/n5KZudw/BjV1TNQC4v/MYn1v5Ot/cvI+e26NlNadljwkmfN+DNxH8ViZE2DPsLVGCfgEeOX8J8BzgrJFT6P2F25hnBMcTiBsKz9P+v4A/xSPtI3YlIeyCrYZ5/yILBJVAwkRSG8/7+oNsEdvLgKT3UMC59QM8pXkx59YPoFCeDUalhF3sb0M0XvesVXVTn3pliHoO28s4aroRSU9h7GYf+OFSwQTTpqpjobiv8xifWfka39y4DweXlk/mJzwRNXgCdhp4E/B3lDTxNAdBrwFPBl4GfAeeet4aOlVe+a1CztMQfUJwG/AzeAtchZ8+9CGkXbBVsJW/2ALBVJCw0NFu4C+AF7EFiHpgYelqBweXs2v7ua51MefXD2Jh+V51UH2SmkzEi6rqQtTLt72Yq+kmJD2fim5SPgj/2LIagOKe9sN86vRXuWPzAV+Br0865GMQjx3gR4HfZgzCHkPS4yZNNvDWXXgVHkm/MnJ6grJbanJ6DgRzCwLS/rfAv8ULCTmyuJUQdsFWwNySB4GgCkiI+HIB8AG80GhzHz/dQvXjpB+0d3Nd62IuqZ+Fpaxhu0ufd6aT6qiqXuak0iz7S7kTSqtK1NMsKsXV9HJIukHZmBVSAzLeUg00mm9t3M/HT3+Z+9uPUVc2dVXvr3Y7AYQnnv5P4L+QI1KMIUGv4RH01wHfiRe1ZXD420c9z4NARbfxFl36KbybqREvuxB2wbxDvvQCQUEkEPXr8UKOnc2cE3WFF7GjrbvstBZ5SusirmycT1PVaOseQdzsUAUzog7MdFKpqU89L1H3x2FqRTGdtDp83nKWj4xtOK+A5UVl5Mcig6ArZVDLQ7DM0oIfYegr63fw8dNf5nD3BC2rgY09KdIennj6+8AP+Wmehd5HQNgTbC6BPc4NpV0LvB54DV7M8wBxkywF8QjfyPw18BbgOJE5BkLYBfMMIesCQQEkEPUX4oUZ28kcR3wJTx6tqxpXNs/jKc2L2GUt0dZddD+6yxCbHqob116/WNmTSidqf0kmxUmk04TUT5Wo51bTsywv+Um6CUFXsS3E9xB8BhesJivuOp9euYXPrnyddWeTBavZL1MyNN73vI735OwNeDHAA+sbL/zKaV7zqePhOuEVi5Xfxnl4Cvqb8G7uwxFPhKAXQ/hm6h6883sLQtgFWwRC1gWCnIgQ9TreQiqvxYtO0GBwwZ07WCi6ODja5YL6QZ7eupxDtT19r7pFAtGesapelv3F1Kc+b0Q9TdsuYnlJvnCktG1A0BMtSQnqu+vHaW9ZDR7pHOHDpz7P19bvwkLRsBq4eiIqe/DE7DPAK4ETgL3RtJzPX/cn3PbGZ8ep6Et4E0S/D28ey4KfHpBMIejlIHhv1vBuhj6AEHbBFoCQdYEgBxIU9X+O92h8bkMzhi0ve6xlnt66jEubZwPeaqRqiKaPEvWRtNh9cqvqc2F/yUvUBycjtszkiHpONT2X5cVcRTch6CrRGpNM2huqjq0svrF+D/9w8mYe7hxmwWpOKj57QApvAV7mWOqx7/zcifprP3XcPby77uxc79ulnwz8APDdeNa4wDoTKO1z+fSt4ghPCv5BvPUthLAL5hpC1gUCQyQQ9X8NvJVh3+RcwULR0T0sZXF14zye2ryERatFm66fnx6GcZqqenZM9UnaX0yJenwPVSLq5mp6OSQ9i6ArZXIG08sHtpcFq8m62+YTp77MJ09/hbbbZcFqosun7AFhvx146fGdtQe+ftU7ue2Nz14CXo3nnX4Og3krXf81HBlKrsGTQVg4+SHg9xDCLphjyA+FQGCAEFEP1LAe8O+BX2Kg5MzV9ymspp9Z28uzWldwTm0/Xd3DUbqvpaf7xcksY0LU+2klqOpTI+r+GPIT9eRRRIqk951EZ42Jupmanoukp6joWQQ9rwUmqY6Li41Ny2ryQPsxPnDi09y+cf+kJqD2NNRqrr7zf/zBI//qnCOdV59etH/IdnWLgYqehnBEmeBeIkzklUEbgnhoBiEe/xnwboSwC+YU8iMgEGQgQVH/GeAXmVOibqFo6x51ZXNd82KubV5ETVmewo4KEb4swmyoqpewANKk7C/j+NRNlO7yiXoZ/vTx1fQkkp6mopsQ9Lwqe1wZjUZrTdPyQj1+ZuVrfOjkzaw5GyxYrdJUdg3UHe0+5e51rnxgw7r04c1vnXukc+vKor1sO9oCFvEWMQr+FoFlf7uJ2e9GQOgD8i8k3hzB29zDi1n/EUITgoWsC+YF8mUXCFKQQNT/E1685blb7Cispp9d28ezF67ikL2nH+UlTNSD8tH6oZ3MMpNU1bMoXS5VfUI+dbNY6pMg6tn+9FLU9ASSnldFN1bZDUl7EC3GxUUpxaLV4tHOEf76+Cf5xvo9vspulULZlQatcDYblt2tqdsO72m+rNZzHmx2Xeu9//WusIxfwyPoTbwJp7vwFk/bAxwEzgIO+a9n+9sHGF6xNIxgcioMBIO5+S2aIoIJ/4eBG4G7/H0XhLAL5gPyxRYIEpChqM8dUQ+86bayuK55Mdc1L8JSdl9Nz+Ur93Zyq+pFF0DKa3/pp0zNp15dom5meylueTEl6UUIehFrTBxcXJqqAcCnT3+Vvzv5OTacNgt2s7SIMUrjKo8EPmI7+kUPH2zc/tpPHm/8/O881P1/bzpTv/yfTtK1VSo5jMRnXwD2A+cAF+HFYb8CuBxv4bUdMU2EVzcV8j5AEEr388BNwCbeudEghF1QfcgXWSCIQQJRn0uPekCpNnWHg/Zubly4irNr+3w1fUCIchFrv0I1VHUTomymqo9jf1EZbUfHOAuinmZ7GcfyYmp1yVTY40aRcFOYWicGwQTUJWuBBzqP85dHP8Kdmw+yZC0M5Y+JgBTeD7zQtbh396pj/80LP+V8+fsuVgvt/o2BSnj1hjKwvQAemQwReQtPcb8Mb1GlZ+DFa78UL3RsuB1Z+XSAYELwrwP/FrHDCOYI2/3LKxCMwCDqy9xc+BQKBxdHu1zdPI9nti6noWoDb/oIYSzZAjMDVX3S9hdjoj44CTFtR+pNk6irpBJptSHL8mKqopsQ9MK+dQPF3dEuLauBox3+/uTNfOTk51EoGla9LJU9IOx34S2U9hAhYgiDlU4hdrXT8GkO/8Gw9SUMCzgfeDrwPOC5eCp8eAXlqGVmOyKwxLwC+CBC2AVzgu36hRUIYpFA1H8A+APmjKh7k0i7LFpNnt26iksbZ9PVPdz+4kYFibVfYRKrlZamqquUNjAh0+XaX4oT9YT6JRH1vGp6kuVFxUxITlXYMywxSWctqWxc3UApT4oYY2GxYDW5df1u3nP0wxztnmDRXiiLsAcq7q14iyAdJuSThmHCnoYEMh9Wy+MIvI2nvL8QeDmeV3s5Mr7tuBBTQNbvxHsicQqxwwjmAHNBOgSCaSCBqL8W+Eu8H/m58ICGbS/n1PbzvIUnsdtepq27qBijysRUddM2K6CqZ1LFkol6//9KEXUzNT2JkMcp7CPlM0i6CYlPO7N54WqXRXuBE73TvOfoP/LVtTtYtFpDZH8MBIT988CLgRVChN2UrMchgcCHyXfgXQ+I6JnAS4E34CnvwaTVwG6znRZnCt6X/403B0nUdUHlUXniIRBMAwlE/YV4j0qbDBSZSiOIgNHTLtc2L+TpzUuxlKLbV9NHqVqUmG0lVb3MSaXG9pc8lhZTm0xoHMNlyyXqpmp6FklPvZErQNDTifl4tN3VLnWrhoXFh07ezAdPfAYLRb0cW0xADD+MZ70IFkbSMB5hDyODvLsMxAYNXAi8Efh+vMmqwXgC+85W5wXBTcwGnm3oNiQ6jKDi2OpfSoEgExGiHqgs1wEfwwutNhdEPYj20lB1bly4isvqZ9MJJpGmkLwsYr2VVPVs5bss+8v4RD17HBMi6oZqemZaCgmfROhG70bJZB2iUWjtTz61F/ja2p2868jfc7K3wqLdwimPsL8bb3Eei8GCPaUR9jBiyLvC+20LiDtAHU/x/3H/NSCs20FpD25M3gV8D6KuCyoOIeuCbY0Eon4B8CngXAY/6pWGhWJTd9lv7+T5C09mv72Ltu7ExE0f/D+0NYtwjbNS1TOU70naX+IIdBWJepqanmmDMVTRi4ZujH6+zBGuoyPp3r6Ly5K1wBPd47zz8N9yx8YDLFuLZSyiFBD2XwN+gshKmpMg7AFiiHuguAdWGfCiyfw08Bp/bNuJtD8L+JJ/Tlwh64IqQsi6YFsjRNYDVWk38HHgKcwBUQ/o0abucEn9TJ6z8CSaqu7FU+8TyAyynjNiy9ZQ1SdrfzEl6qZjGE4zIOqGJH246HDZNOU8SSWfVmSYuOMoC452aVp1HO3y50c/zKdPf4UFq0kJPvaAsP808H+YImEPECHuimGVXwNPBv4H8OrgdDBHk+pzIvh9/xPgexF1XVBhbMUvoEBghBBRD74HFvC3eBOxggtrZeH50zU97XB982Ke2roEV2tv1caA9sSG20uzPZRggZkTVT2ThOdR1U0JeF6iPnL85RF1E9tLEcuLSpj7kIekxxP0FAtMIaU9Ga52sZRFSzX48Ml/4n3HPoaNRU3VcClsiwnip9vAm4E/ZQaEHWLV9kCUCBT15wG/DDyVrauyh73r1wF3IOq6oKIQsi7Ylkiwv/wO8MPMCVHv4WBhcWPrKq5onENbdwloTzIRS1NUs0jzdlfVs+wvBu3m6X9kDJMj6ia2lzyWlzIiw8RenmKfdERrFbusRVVz7acsWwt8de12/uiJD7DhtmlajXEmngYEcRPPJ/4ZUmKwTxoppD1Qnf818PPATuZw1WYDBL/1/wv4T4i6LqgoKj9pTiAoGzGRXxy8R9NzQdQtFF3dY0E1+I7Fp3JF4xw2dIc0mpJ4dTUNjWd6ec5Q1aNtGS10Y3IkJm0mHk6y9SR9LFntRtJMy8WOYfJEXQX/lEok6kGZaF5sfiQtXC9ad0DUVejPewmXGRlrzD9CZbIQLR/+Z2FhY7HqrHPd0hX8xNlv5kB9D+vOJrYqfOlUeEp1C/hz4CIGVpOp4+r33BwlpQ7D9r9fx7MEfoSBl72UQPQVQXDe3wgsMVjxVSCoFORDKdhWSAjR+BrgvcxBLPVgIuk+ewcvWnwKuy0vfro1QlQo3QIz7sTSKqvqlbO/ZEXviauXeHxxZUeJupecbXvJsxhSXJ1oGVLzYt+h1LJlQmuNwvOxL9gtTvRO83uPv487Nh5gh704TqSYgBB/CbgJWPNPxMQixJggxtMeKM0a+I/A/2Qwv2er2GKCaF+vBd4XHLMo64IqobKkRCCYBEJkPbgIXYsX+WUng0fUlURA1M+u7eOFi9fSokGHXih+epYX2ZxYD6Wp+DKFLDAZCvj0veom9pfRehO1v1SEqKd50/PEWU+OAJOUHnfGSbxhTCw/BuImkgYTT7tujz944m/40uo3WbYXx7HEBE/x/gx4EzO0w0QRIe1B9Jge3o3Fu4FDzMFTSEMEN04j74MQdkFVIDYYwbZBZEKpA+zBu/DspOKPPxWKDd3h4vqZvGTxehrU6MYQ9fi6xfrLX8lQpTfp08CGkrtNstskz8TGXPaXSRP1pHGUQ9TT7C2JaZH8UatLND3GMjNkgRm11cRZbNLKmNhnkurXlE1X97CVzY+c+Tqev/vprDrr/lOtQgie7L0R+Fm836A++Y08BZwqIiTVDY3tE8Azga8SmRw7xwh40AuAvVT8WiDYnhCyLtgWiFz4gh/iPwSuZDBxqpJQeKEZr26cx/MXrgHA8SO+JFdSI62MbuUbQ3Jeue3Ft2tCmPOSagPynqTmp7ahsjYN05JzR4l6/NOA4SLFiXqQHlc2INJFSXoaQY/mp3nMY206GZ+zrPaifVpY/grBDt938BV8597nsuZu9msXQOAD/zngu6iQWh3xs+vQ2B7EixbzYbYGYVd478FB4Dl+mnAjQaUgH0jBlkeMT93FiyX8Sip0cYyDQtHWXa5rXsyNratxcNHoRGJgTBdMJoKmNDhqUTBoL7WbqqrqCf1m3ABk3xTEpGVOKE0m6kntl0nUg31T9d2UpIfTsyalxpL2sPoe+UONmR86X8E/y79sbrhtXrf/xbz+wIvZcNup30tD/C5wBd5vkgWzVdcDRFT2QNhYAV4BfICtQdgDL9NLZj0QgSAOQtYF2wnBReVVwH/F+4GuLFEHaOsuT29ewjObl9HRPd9Ub24xKUP1HtcLXKR+lVT15ELKILuo/SV+FElEPd0vXx5RD/bj1PRw3mAcZiQ9nB5H0AeHYkaox/k3/Lak97XmbPCKvc/lew6+jI7uFiXswWqi+4B3AgsMJrtXkbAH0Wu6wOuAf2D+CXvAhZ7D4P0QK4ygMpAPo2BLI2aF0ouBz+E98gyiAFQKCu+Zc1f3eGbrcp7SuJBN3U1ebGboUT4RlXvw/9DWGFFgVJH2Moh1VFlPu12IV7cTaqQQ5myynNZvBknOsKeMpCXEU1cZbaeOIea4YpVyg4mkWYQ+nEdsWlLZbNtKnugw4dOQhzRrnb0yadykU601rnbZUVvik6e+xB898QFqysbCKrLaafCU7+3Aj1ChCacBYiaeusAy8FHgGczBqs8JCIIL9IAnIQskCSqGyhEVgaAsRCaUarwL4TvwiPrMYhunYUDUHW5oXcG1AVGPIUdxdc06MSfq47ZndsxpFpiqquom5hZz+4sxUc+TVoCo9/XlOPXcwMteREmPbofLpfnW0+wrmTcABop9lnIf1LMtmxVnnefteho/eMar6Wmnv4pwTgRrPvww8M+JTDitAmImntrAKp7C/pC/P49x2BWD832dn1a564Ng+0I+jIItiZgVSjXwC3gToyo7oTRM1K9pXEBbd1Iv+WVbYPK0X6S+mdd8vPFM1Kue2KbK2iSWYCuzdrOtNZEWChL1aJlgP832Mug5po8cJD3Tt17Q/hJXxqTu4FRm92srixVnnefsup63HPqucQh7cE3+NeDJVMy/DrGWmBoeUf9ef7yB5jBvCMb8tFkPRCCIQsi6YKvDxruAfCfeoh6V9ql3dY8bWpdzTeN8NnXHv9grc+atpkfeVUqeacfpqnpC9cqp6skWFZNTkZUW16RKq1EyUY+Wiyfqo4Q8Li2NpIfTkwh8tEzczeC4/9LaShtTTdmsOGvcuOu6PmEv4GEPFN4deBNOW1TMvw6xk05rwCeB/88f67yq6+CtvcGcHoNgi0LIumDLIeJTd4CzgLfNelxpUCg6vkf9msYFIaI+fsvDu5OzwMQd03ijHdNSMzVV3dyiMpxkZn8Z3sxQ3ydM1IN0Ly9ZTS9K0sPpqRaYDKIdbSfL5mJC0qN5cWO1lc1Kb50bd13HD5zxyqKTTgOB4Rl4K4ZC6FpdYcJuAf8bz78+5LefEwRv0iVEJvkKBLOGkHXBlkLCheytwDlU1qfuhWd8WvMSrg0R9SjlSyPXk7iilHKzYKKCm1U3rz8DVT29TExaXvtLjrQ0oh49l0WI+lC/CWp6sF+EpIfT04hyuE6a1zxaN64NFKltZN0whMdiK4tVZ52bdj+d7zn4CjbdTuK7nIIgxOxP4oVIrOTEzYTJlz8BrDOwH84LgrfoLODMSJpAMFNUjrgIBCUhuNj9GwaLjVTuYqfwFjy6tnkh1zcvGppMmr+xNItKOWNNbn9MFbzMiaUp9aelquceS2zf4Q0Doh7z1CTWllIiUQ/yTW0zefzs4f04JTuvb330XGfXMekv7nhs5U06ffGeZ/GGAy9h3d0Y5+b3bcAZhMIJVkVdhyHCHlgMvwH8aihtXhDYdxrA+UFaJAKOQDATCFkXbBlE7C894GrgF/20yhF1yyfqVzXO4xnNS2jrXvwFvfA1vqBFpRIWmPztjT55yG598qp6DMlOUNVVrnYjaTGhJ5NIeFzaOEQ92DeJvW5E3lMIc3j8sWQ8QSHPY4lJ6yPJQhM3dltZrLrrvGLfc3nVvuez6qxjqVyX3OB37Fzg/4XSgGoR9hAC68svAw8wf9FhgicB5/qvoqwLKgEh64ItgciFK4iZ+1a8GMCVW+DCI+pdLqmfyQ2ty+lqJ1XDTSOrxgeWg1xP1QIzoYmlqVlTU9XzaO2DnFxqfYxP3ciaUiJRj9bL6necyDBJxDn2qUFOxd3UChMtH5ev8FY7XXM3eN2BF/OivTew0lvDzkfYg3CObwS+jwqGc4QhdT0IkXuCgbo+T1aYYKwXxBybQDAzCFkXbDXU8H5wfwq4iQraXyw8j/rZtX08p3UVrtb+Airm5pVSyHsOTNQCU8IRmBDr9F4mp6oPJ8WfybHsLwwT9eg5ifWsT5CoB+mTjAyTZYGJHm/cGJPq5lHTTW8uNtw233vwFTxr55NZ6a3nJexB4f+Lp/hWLpxjBIG6/ofMp7oOA886YoMRVAFC1gVzjxj7y7XAf/fTKkXUFV7Ul732Dm5qPQmFVTQec6Rhc/I+DxaYZIXbrBEjIm7cZ0mquuGk0vRjiaSlWFvC20lENa1Mqkc9jowbqvimJD2cbmKBMSLeORX3LPIeLRN3LJZ/mXW0w7848zVcuXQRa85GHsKu8AjwQQZqdR9VIewx6vop4A/8tHkh68GbfzB0LALBzCFkXTDXiLG/gHdBW6Bi9heFwsFh0Wry/NY1tFQDBwerDPKcVbFkcp2n+yIWmMLt5SbNpn1mZ5RhiRnH/uIlpZDyMJnMQ9TVoE7UYhNHVEf6GnPSabSvuL7jrCm5/eqRz1gWeR/qK+PYLCwcXOqqxo+e9d2c2TjAhtvO42EPQiG+FvgeBquHVgqRyaYA7wI2GDzxnBfs81/nacyCLQwh64KtguBi8OPA86lYqDMFuGgUFs9rXc1ua4kO8RNKJ+JXzzXWyfY3ak8Yr4ci7aXXmJ6qHmuEybgBSLK/5In8Et5OI+ojk0YzbC8manq4/Eh+hgfchJiPvg851PaUOOxJ4wneiLRjAo+wd9weu2s7+ddnv5Ela4GumzCpPB7B9fp/AYeoaHQYH64/3ruBfwylVR3Bm7HDfxWyLqgEhKwL5hYx9peLGdhfKvbZVvS0w7Obl3OWvZc2vYiiPh9+dS9BJeaVodKPa4FJzTKdzJqYV66qHs7J1UbCexBLyhOI9lBenKKeUb+Iml5mZJgkIp2kisefz3xKfbhe1hjjzklNWWw4bS5onsUPnflatP/P8HOu8H7nziZmsaQKIjiov5j1QApgAe/cxk0mEgimjip/0QWCvPhFYA8Vs78EE0qvbVzAZfWzaOtuuvUlL1JilE/Er55naKn9jW+BMVHB0w9TmRTKXT+fqh4m4YO95JuEQb6JYh6Xlq6657fLmKrpI3klRYaJlisjfGOsmp4StjFu3CNllKJm2aw6Gzxtx9W88eBLWXc389zkButH/HPgJYSeIFZFXY+xwnwMOM18LZLUBOqzHoRAEEDIumAuEbowBZEGXgO8norZX4IQjRfVz+D65sXJsdTjUBZ5Lsmvblwylejm95vnOtQC7SUr+WaMvQxVPb3NuHGGtg0U86G01Emp5RD14DWsqEfLjhMZJpyfd4GkLAXexAozUi6aFzruuOOsWd6iSS/dcyMv2v0sVpzcIR3Biw7Torp2GI3HMR4DPu+nzYMVBjyiXpnriEAgZF0wdwhdkBTehWoHg8fClVHUFYoOPfbZO3h28woc7RIVlszNL3HtT2bMafumeUWPYRYWmLRK6US8ZFU9sU0V215+Ip6uumNQPg9R76erbMXZRG0P56VZYGLPT0Fvu0m/aWNOs8ZYSrHptnnzwZfzpKVLWHM2TCecBra/a4B/76dViliG1PXggD7uv86Lsm4h/EhQIciHUTDPCC5QPw1cTij+8KyhABeXBjWe27yaBvVBiEZlTtHzkedpHNhkyXvaQU3aAmPSXpYDOl8dc/97lqoe3k6yv6SFcYwS9TSVPm+M9lQvtwnhzSDK0TLh6C5JxDypTp7FmMLnJ3pzknaMQZqFhas0tmXxQ2e+ln313XTcrun3KPzbdxnVjb0ekPOAvVfi91kgmDfIF0cwV4iZVHoV8JN+WoXUJUVPu9zQvJx99o7EyC9Jdc27MSfvqf2XZrlJ7m9oP8cNS4GuR9ubysTSaANlqOphP3u6qh7eNs33yGMKuS6RqAf7WaqziQ2mbAuMiZqeOL44cm7g3QewsWi7XQ429vGWQ68B8BdIy0T4qeLPmVSYEQLbyzfxVjUNJm1WHXpOxinYJhCyLph3/BywSIUmlQYTSp/UOI+L64fKn1CaCjOS6pWcgF+9+EiLja3w/YfKXamIN70MVd3bjFHYY1R1r0yy7zyaH61vUn4coh68ppJ4Q4U9nB9ngSlC0JPazLTfJNh9TKLi1JTNmrPBdTuu4LX7X8S6uR0mmK/zBuClhGKvV0hdDwjvYeDeSFqV0WOwEqtAMHMIWRfMDWImlb4Mb5GQyiwQolC0dY8z7T1c37iITmhCaS7CO4PbjnyWm/IHqFIS0vsrYoFJ88ebMXYT8p42hrzkf+AsHyWBI9s5ferh/LRY4WUQ9SDdeNKpYbzzJNIePuZCfvU8xD3j3CWdr5qyWXXWecX+5/HMnU9m1VnPO+H05xksnFQJhHzrwW/znf7rPEwy7eARdoGgEhCyLphHBBFf/sesBxJG4FNfsBo8u3UFFipVQhrHCDKTRwg5VPp0y00Zlpd093mh/oyJuIGqrpRZ/RyqevS401TwxLIx9L9I2Me4NoeiokSipCTVj6rMJgr7UN0EMp7lWy/sV08g7iPnwdCvHz0fPe3wfYdeyZmN/bTdjslNsYX3e/g04If8tKqp68FB3DlWK9NFmwFZn4cnAYItDiHrgrlARFUHeAveBcqhMp9jz6f+jMal7LaW6OKMXmynNLl0Jip+qiA9vjKer79yD7hIe+OajJLovrlqns/+kjYB1ZSoJ5WJI+Uj/Wcp7CkKt+kCSaZ2mLS2w+fE5DhSn1BEzl/X7bG3tpMfOPRqvxcjnhj8/v0MsI8KWQIjeGjWAzBAcMLX/dcqnkfBNkRFSI5AYIRgUtVuvAtTkDZzBD71Kxpnj+lTz1Enh0KdS/meAswtKZOxwCS3X0QFN1PVDXuJdFRMNc+2x5i1ZRrGMY89Js0yU9YCSdGy4yyElDS2rJuRtONMOke2slhzNnnK8uV8576bWHU2TOwwCk8FPh/4CT+tSpFhAgL8WHhsFccp/7US1xeBYB6+NIJtjhhV/ceAC6lIqEaFoovDPnsH1zcupqtjFPUpjWR4tziZT2l1Osc2YZU+3R9fcGBGpcw6yqOqh89JVn64RdMJqGmqe9GY7GmKcxpJD6dnWmAyTrNJ/UTbiyJ2vHFjTToHSefKVhbrziav3P98P/76psmE0/Bv4wWEnjhWhLADHMt4S6qA4Mbi+ByMVbCNMHOiIxAYIlCPzgb+rZ9WiUmlGo1C8czGZTRUzY+nPjr4XEc6Y2Tbd5LLppLpEvzqfidxm6P7JYSINFbBU2qqQvXDpcxV82xVPb9PPbxdhMybqun99jLU9nBelgWGxHQS043aV/HnJs+xJ50zjcbG4vsOvZIlewEnWwAIfh93AT+V68M1QfiTTAMCvFaVcRng6ByNVbANIGRdUGlE4qqDF1N9H96FaeY/pBaKju5xTf08zrT3DEV/ScM4A5/5Qecer7kSPgnVvmwLTGr7yvBYE5tWiW2ZqOZpSnm0fVMrjUkYx7g28pDVLHXaxAYzfIxF/+KtMHF2mdRxJhxj9KlCEmG3lMWm2+GC1lm87sCL2XDbsVFsIgjEix/EW3+iaur6JtD1t6s+afOJYCMU1UYgmBmErAvmAUHEg4uAH/bTZq6qKxQdepxh7+aa+vl06EV86nlsKKNtF6+b6yDKOhkTGW8Zlpc8tSZrgTFT1dNvH8xV8zyqerh8kegw4xD14DWVxKcS9FHCHSTn8auPtoXROOLSR85P2o1KQr2a5cVff9GeZ/HU5atYy46/rvB+J1tUSF0Pocf8hEN8ONi47Q03zHosAoGQdUF1EVKDggvOT+Ct2FcJVd17VG3z9MYl2FjZKw+OYcnIY0vJqjvOjcBUkKpip9HdgufIVDXP6i8hrxB5T1TGzc5NnFKepap73aYr5qUsnlRC7PURNTyOiMeeg5jzlkjgkxT3dNI+XDbbFpN2TgC01vyzM17GTnuJXrYdJrimvxm4lmqp6/MQXz04f8Fk2Ko/ARBsEwhZF1Qdgap+CfDP/bSZq+qB/eVJ9XM5w95FBzP7SzpmY47JR95nfo+Ui1yb5xZrdFwLTFp7Q9tGE0ejban0ugZWGhN7TJbqnrqfYRcJpw3OSrwlZqh+lCjn+Bffdlhtz1DUDWOqj5zjmDqWsmjrDuc0D/GaAy9i08m0wwTqeh349zEfpVnCrtBY4qAZcKJHgjSxwQiqACHrgkoiRlX/MWCZCqjqnv3F4YC9k6vr59HRvYJhGic5yBLJ+8Qml07+nKX1mEulN1a3TfPMzlOiAk4C6U58r4q3Y6oEl0HUo/tpJD08vqhvPU/Yxqz2ktT2WHKPyn28WXm2sllz1nnh7mdy7fLlrGfbYYLMNxJR12eMmv9XdZwEHve3RVkXVAJV+AILBEkIVPULqZCqrtFYwFMbF1FTNm7k93wsCloxzj/umNMJcVbZgkp4aWMvWHGIhCVXMz0zedTwke2CqnpSO1lWm1wedQOCm0TS05TwLKU9jtwntTFUesTjnm6DSTruaLqJtSjYfuPBl7JgtXC0QwrC6vq/DaXN2gqzwICsV/GXLhwP/vg4DQkEZUPIuqByiFHVf5SKeNUVnv3l0tpZnGXvpWugqpepJ1fxCjcO8hxPLvJeVojIlLEWssAYlhrtK78aHnfLUFRVD2/nVt0NVfh4op7uD88K3Zh9zpPrJBL/BHtMUcKeVCdqh9nUbS5eOJfv2Hcj685m1mJJQeabgCuZkbruT84MDnTJf62qWh2M60E8f71V4bEKthmErAuqikAdOouKqOregFx2Wgs8uX4+XR1a1Xss28l4YyrcVhWZf44x5Tv2PGTazF9evIf8FpjR9rIJOCWr6uFtY9U9p11G9clvsiUmc4GkMf7FtRm3EFJ0HOMQdiN7DApL2aw7m3zH3udw0cI5bLrttM9I8PvZAv51eJAzVNf3+69VJcDBuO7wX4UfCSoD+TAKKoWY1UrfQmXiqisc7fDk+gUsWs3YxY/CZYv3kscOMrm2VEZbM0Fp5NncnlP0vSxK3ocU9hQ/utmk03JV9fB2okJekKiHx5snMkws4S7Lrx79lxIBpihhjysTX94TC5asFq878GLcbMobXN+/Bzif2XnXg4M66L9WPSrMbbMegEAQhZB1QRWh8Mj5TjyyDjP+rCoUXd3jrNpeLqqdYbz40aCBLB24zLbyHddU6s5gcunoeM2HkIu8K5VS00ylN72xMFbbJ6iqJ5U3DUVoQtSDdJWWFlXUE2KnZynp0brxE1zTLTtFCXtiWtw5RWErizV3k+uXr+JZO69h3U2dbBr8ju4C/oWfNsswjmfNotMcCASi2/3Xqj4BEGxDCFkXVAYxqvobmK0i1IdGYyuLa+sX+BdSzcyF/iRMKRJMVt18Kn6eutMn/mXeHiVnJZNyE5I9uj85VT2pbpICH5TJQ9T7deIU+hgFPZyXZI+JG2OaMj/SH8nHkJewJ6alnMsg39EOr97/QnbYSzjaSftUBb+lPwDsYbZPKC+YUb8mCH7QV4G7/DRXwjYKqgIh64KqIVCDLOBHQmkzHJA3qfTi2iHOsHfTLSWm+hbBGLaUPGdwPBW/4AGUZrlJ2zezwIweYoo9xqBc2ap6eDs/Gc1WoU3IdJYFBsXQa5YVJqmf6BjDEW0G5bMJe147TJBvoWjrDue3zuTFe25g3dnMUtcd4Bw88QN8Aj9FdT2wvZw/9IZXC4GKfh+DBZEEgspAyLqgagg+k98BPJXBrPyZwcVlyWpydf08kxUEi6OKl7BpYmLEf1qqvUquNQELTGKeMis3yZCQpjYPE6IeTTeJDBPOz/oXHmdW+9ExpavnBhaYcFtZinpo21IWG84m37732ZzTPIO22037XAcZP4T3WzpNdV3h/YbXGSjrVfylC24obvVfbcQGI6gQhKwLKoGQyhP8QP5wZH8m8LzqDlfUzmantUAvMjdq9k7sbYQJkflxiH8ZIRtHa5n50tPzDL3tBYh8miIc3o4joGFFuQhRHxlDigUmPH7TSaWJinlCetq4h47R6AlD9k1QeLw9HHbbO3j5vufS1d20JzEWHhm9Hk8ECdImikjYxrMYeNar/DP5pTkYo2AbQsi6oEoILipXM8WLShI8P47DHmuJy+pnGcVUj2ujzPGU1vZ2vxSVZHEZr9MUNbxAFJi0vCKRZJKVezO7RnQ7dkGhAkQ92E+cCJpAykfGlUDgh9pTJN4kZI0zycOedE6MbqJC27ayWXc3+bZdT+HyhQvYcNppv0+B6PGW8P4UrDDBgC7GWxTJpZq/PoG3/8v+q6jqgkpByLpg5ohZBOn78R6bzjhco8LVLlfVz6Wl6iMrlRZrMX2/3LaLt15mW+UuUDSlj0MO20pZqr2pHaZonnE5o5CQ2X3ktcfkIerBfpINJs3yYmKFSWo/z3iHt01tQebqOoCLpqEavHz/88jgl8G1/mV4iyRNy14YDPrJ/msVwzYGk0uPMQjbWMVxCrYxhKwLqoJgItQu4I1+2swWQQoeMx+wd3FB7eBQqMZRP3KZ2msef/V4bc+urTKPcVZ1y2k1jcwbe9RH9ouR9zK86mbtJCvMUQtN/OTNdIU92qeJZz3J7hLOix1n3tjpBZ5IpG3bymLD3eS65St48vJlrLubWPGXde9BITSBN/tp0wjjGNxBXD/JTsZEQMy/gUfYLUBLJBhBlSBkXVAVBJ/FVwLn4hH3mT4udbXmyvo51JWFzqWqT3DYFb0xqExbY8VzL7NuwWaix24YESYtL4+NJrFcThKZ3Ee2dzvJ697PS0vLUMzzLIQUrpc0lnzjz1DUC94UacDC4mV7n0NN2Wm/VcFv7BuBRSb45DLkV3f8pKdExlAlBCcsYOdVHKNgm0M+lIKZImZi6ffOekwKRZceZ9i7OdfeR2fcCDATXRAo0laZlpNSbwzKOwPj1Y3eCEyq5xxHrMon6FnHnZSX5fHO3M5BRGNJrYnqnhGZBZXuWw+PIzUCTB5F3TAKDibnM+eNkYViw9nk6qWLuW75Sk9djw/lGMwJupjpzAkKBnkhcOnICagOgnPwaf9V/OqCykHIuqAKCC4i1wAvCKXNFFfWz8ZWFpNfAKmK168pD3uce6ESh5VPBJ9OT/n86vltLll5JuXyqOpJddMsIklqeqxvPUFlz7TCGMRUN9nPOpZxz2PskxKl0MBL9n4bDVVD60TLdUBEvy+8PyErTDDQpwEtKvC0NOF8WMBJ4Ct+mvjVBZXDzAmRYPsidIEIPodvwPOpz2xiaV9Vt3ZzdqqqXrVrzhZHiWQ+l6tmjGHkqTta1pygp5Ytw0aTYs0pe6GlVNU9R+z1EQJvGL4xrr3UMWTETo8/h8XV9ZH3yc+zUGy6ba5YvMBX19tp6jrAi4BLmOxE02Dgz/Ffq6hYB8T8q8DjiF9dUFEIWRfMGuGJT6/z02b+ubyidjY2impeXwQTxYzIfHrZyVhlilhg0sZWVFUPlzeywiQo7UFaUtjGNC97XDtx9VIV9Tyx03Pe3KSVC6CBF++5gbqqoXXsb1fwe7sIvMZPK/X31ver4/cDA7I+89/1GAQn6eMVHqNAIB9MwcwRfAZvAi5nhiuWeqq6wwFrJ2fbe+lOcrVSwfZALuKfTsgLK+h5lPgCFhjTckVjso8Tez2OoMflJ9bPERUmzQ4zes7MLC5DY86wwlhYbLptLl+8gCcvXcZGcmSYIPH1/msPSrfCBH1cgbduxvBBVwdBxLGP+a+izggqCSHrgpkg5sLwBv91pj+WWmsuq52FTd4IMILJoyIm+TLbyuN7V9Hd6RL00aGbWWXyqOrhbRNfe6rCbvhvpF5GBBgTC4zJ8eU597nea6V40Z5nYiVHsQom4jwNeGYorUwE7T0fb82MKvrVgwWaHsSzwQRpAkHlIGRdMEsovB/xPcBL/bQZqereaqV77WXOtffRxUlVuSYygC3Z17xMzJ3kNNUck0lzqOnjnI9cVpk0RTfVspHdRhbRjU4YDddPs8gkWV3KiACTmJbbf57P4mKat+m2uWrxYq5cvJBNN3FV0yCk4mv911J+d0MWmID0vqyMdieEYIyfAdbxVHbxqwsqCSHrglki+Py9GDiTmaovCke7XGIf8qIpGKjqW5Zfz2vr0wyROaO2xplcWtTLnjWG5DwzMpqH8OaddJo0iTTcR54IMHF9GW9PIC5+3OdBo6mpGjfteoZJzPVX4c0X6gGqJCuMwiPCh4AbI/1VCcHJ+7tZD0QgyEIVv0CCLY6YC8Jri7RTJhxcdloLnFfbX9irvnUIdbSvyfWWh3xW6jgmGoN+DDKfY1zjWGWKWGDS2sxDdvNMAI2dVBpngzGIABM3hqT8POeo6I1RNCtoM/CuX7t8GRe0zqatu3HtBFaYy4AbQmllIGjnecBuqmmB0XhK+ikGk0vFAiOoLISsC2aFwAJzAM/XCDOcWNrTDhfYB1lUTdySfrOFvFe7r2nq8OOZaswV8sy6eawyE7DVmKrGphNQY6PAxKWZ2mByLNKUlJ917kyfPmS9H2llHVyWrAVu3HUdXd1Len8CK8x3UQJCFpgArynSzpQQ/Mh/FniUwc2LQFBJCFkXzArBZ++FeIR9ZuqLi6al6lxQO4ijgzlH5UMIdRl9TQ9z47YfQ+XPcyMwjlVmEpFkslT3OAuMkaIe54HPmkxa0Nc/ifMLYCnFpu7w9B1Xc6C+h67bS1LXwVvNtIn/GzymFSYQYc7A+20P91MlBMT8b8NjFL+6oKqo4pdIsL3wyll27qnqPc6297LbWqSHU7nntWUd56z6mibpnReCPdp2cfU8s60Z2WqKWGCifWZOQEUZ22PixmDqhR8Zl6mNpax4+DnfB4Wi5/bYV9/D03c8ibbbiWsjUJMvBZ4eSsuNkKoe1H8JsI/qWmBqeJNKP+SniQVGUGkIWRdMFb5qE6gvu4Cb/KwZfRY1lrK4sHYGWm8d5Ta779n1vlXO8VRvFMr0yI9JBFP3S4oyY1Iuyx4TvJqEbYytW8DuUs7E3Iz3wFCBV8oj7DfsfDKLdgtXx/LRwArzin5z4yFQrN8wViuTRTgKzL141x4h64JKQ8i6YBYIPnffhhcFZnLekxQoFF1c9lk7OGjtojdjEWi2BLpq4tfEDnRL9JVHxR6/7THaKngjYGqjMV08KcuvbhL9Jet4yoqoM07ZaL227nB+6yyuSA7jGPwWvxTvQzROVJiA9F4GvCDSfhXxV+ExigVGUGVU+Ysk2Pp4uf86M1XD1S4X2AeoKxuNnqpamoVtQp+30YFOD6Uq8TOy6BTytqeo5Wl+9bg6I9sT8vfnmWSaeX6jY9JgY3HDzmuTqgQc4Fr/b3RAGYixwLwOaOET/8IHMxkEUWBOMwjZKKq6oPIQsi6YGiIWmDoznoDk4rJkNTnH3kdPV9FaOcPxTHNBqCphqsr7FOcRTLCv8RZyMh+ncSSZFJU8XGaItJOuqMfVNz3mcWxH45yvIH/T7fCkpYs5s3GAjo6daNrzX8f5PQ5U+Trwz8ZoZ9IIiPnH8FYuFQuMYC5QxS+TYGsjuFI8Gbjc35765zAI13iWtYdlq4WDWzmqLthemOaKufMS376otSQpOkycDSZv25M83qy28ratUDjaYWdtmet2XEnH7cZ9zoKEF/uvxuQ1RlV/IXC130aV+cWfh49dLDCCqqPKXybB1kTwmbvJf+0VbGdMeBNLz6vtR2vz8LozJfSidm8rbNU5DNOy1ZgunhQ3hvIsLjmPZwLfcW+iqcPTlq9iwW7GTTQNfpOfDhzEn0OU07ce/Ii+JbJfJQQWmEeBv/fTRFUXzAWErAumjeDHMXjkOoOJpdDDZbda4oA/sXTbTLAUCCqOSZBfE2tMUv/TtBBNpA8Ubd3lvOaZXNQ6h7bbiU40VXi/y3sptpppYCW5HPjOAvWnhSDyzfuBk3jEvYo3FQLBCKr4hRJsQYT86i6wnzHj+o4HhaNdzq7tpaFqaPm9Fggqi7LIexIx3g436hqXhlXj+uUrcXDjntLlFlFiLDA/gLe4UhUnloJHzgHeFU4UC4xgHiBkXTBNBJ+3p+ER9pmEbNRoGqrG2dZe/5FwFa8rAoEAKO1mOsnuFm1/K968KxQdt8s1S5eyy17G0U60SPDb/Bz/1ZRwBxNL9wDf46fZBvWmjeCH/ot48dVhoLQLBJWHkHXBNBH8+D/Pf526X1Ch6OGw11pmj7VETyaWCgSVwjhkeYR4+wQ9SI/uG7WZY05L7vFOsO0wFIqu7nFGYx+XLZ7vW2Gs4SIersZb0RRSfOsxqvqbgXOo5oqlMLC7/In/WgNR1QXzAyHrgmkiUDJu9F9n8qPuas3Z9l5qfmz1PJip5jalC3vlsG0Pe3YHPsm+kwh12eOMI+jBvyA9WsZkTCNlSzxXE20bsFA8ZemKuFbDIXWf6adl8YOgTgP4l6G0qiGYWHoc+Es/TVR1wVxByLpg4gj51TXeiqVP9rOm/vnTaJqqzpn2Hhztbgu/qmA+MC2VFaZr/RhLKc9BXsN5cYr6yF+G2j7UXh4lvsSbkTLPpeVPNL1i8QL21HbS073or1/Q+HPT2klYBOlqPAJcRU4RPMH9K7xIMDKxVDB3qOIXS7A1EV4pbycz8KuHLTA71SK9ikftmql3VlT8KfQ1RXI+RSvHpIhtmvo9tJ2gqKf2SzxhT6ozzs1OqeQ9xxMBgJ7usa++m0sXzqOju6hhChDsPCMontF9oE7/mP9aVeUjOK4/CCeKBUYwTxCyLpgWgh/yZ/uvM2HKrtacae+mpixAZ15dtillnS7kJJeOSaq5k7Kt5CmbRJyjpFtr3f98xdpgwgp7jCUmz81DWl76cU/S+hJt21PYn7R4SZIVBuAK4EJ/2wr71kOqejCJ9FXAs6juIkiBh/7TwGcZWHcEgrlCFb9cgq2JgJwHfsiZRYE5ZO3GSYgCM0veuFU9yqN9zRBTVc4n2bQeSZlc2znqluT9NrWkxBHrEfKNjrXBxJaNscQk9ZfneMY5x2XeLFkoOrrHZYvns6u27K8x0UdAZJt4T0CDtDgEv+c/2R9mtfG7/VMgEMwh5IMrmCgi8dV3Atf4WVP97HlXIZdd1iK71CJOBaLAbJcbg1ny40n2PdW+ZmidGD7Gydg/TPOS7C5JZFtn/Iu2E7cfPc6idpg8eZN8T7pujwO1PVzQPIuO243O2wkqj4gqEVVdA6/Ai+zlUt1wjTZwL/C+UJpYYARzByHrgmkg+JxdgTfBFKaurHsLIZ1h7aIeigJTdTmoLEyXnG+PG4Fy256c1aRMpTxPvxiS07RjN7W7DKWF7C1xfvWgbNQSE20jXG5kXNpw/AU9+OO8D2nnOtivKZsrFy/CHV0gKdgJFq2LsysGaT/Vb7KaCMb5h8AaXrjGqo5VIEiFkHXBNBBcAK7zX7MmLk0AGltZnGHtxp3R5MnpEksh51Xuq8y2SyVyE7J5mEZWKWJ3iaZFSXs4PUreYy0xGe1njS/1mHSxG5o85zcLCujqHpctnMei1fIXhusj4ARXAbvwAwHEqOrfhRc1pqqqusYj5yfwyDr4XnVR1QXzCCHrgmniabPq2EGzpFrssZZ8C8zkhf2tQixH+9oaNwKTtLGU2fY0LRKFyxawsaTlZanrsSQ8hpwHZZP+4soO9ZPSd1J+1nmfhlUm7TwHCyQdauznUGM/Xd0L/x4GG2cClwRp7Xo/38Ej5z9DtRHcgbwLeAgJ1yiYcwhZF0wDwez7IL761EM2Otpln7VMi7r36HcCEHI+ftvl9jXBtkuNtpJ+TvINazJE3tSqMjqG4hFdRrYzFPAkMh3nUU+KDJPZXorqnrad9j4VP7cY50XhaJcFq8klC+d6ZH3YChM8+ezPLzrnSAcGCvqb8cI7VjWuuvbH2gZ+O5QmqrpgblHFL5pgayFYDGkvcLGfNpPP3UFrV/SiNBa2Ljmf09Ynam+apO6ep2YOgj2hVTnLiEWeh+yaesuj6WECntRvosKeZolJUd1NjzPILfLeFH2fwvtKefuXLZyPjZXUx3UASsOj+xtBpJhF4D8HzVBNBGrMe4Hb8Ih7tRfVEAgyIGRdMDH4kWCCz9glwD68K9RUf+S9kI02+6zlxJCNCRWnOcgt2ldVzSWTbLt4W+MtN1++bSW6n0V+TdrMNYE0Y7Gj2P0E1TzOAhMuP1Q3wcsee1OQosCnHePouzcBq0xiWS+E47nNQ+yqLeOMhnAEX1nv1ZTbs1Wgqv9L4HKqq6rD4AnAW/unAVHVBfONqn7ZBFsHwQ//Vf7rVBWOIGTjDrXADrVQiZCNgiqgGkp5npuZsiZ4ZpU1zitghSk8gTRD8Q4WP8qyvKSFbzSOBGNqjzF5emBogSnbKqPwVjPdU9vBWY2DdN1Y3/olCpY+/fRD7lNvX+vh+diDCDBV5Q6B5fIDwM3+OEVVF8w9qvqFE2w9PMl/nfIkH4WrXfZay0MhGwWCqSDHx22siaQ5rBKTsLiYlCsygTS8nUnYYxTx2AgwSYQ9SU03sOMkjj3xnI33RCKtnGmeRlNXNS5qnY0zHMIx2DhbwznQZWXJBviPwCEGq4JWEQGn+dXIsQgEcw0h64JJI1A1rvZfp//jqRT7rR0SC0BghlwEu3DVnGXLmWiYx8YybmjCoup6VvSXaHo4pnq4rTS7S1K5NIU9y4aTeAwFLUCZ5zrlJswszxMyLmydTU3Z4bEF/nSr5ujLf+qPHuCOc1tPBX7Uz68qbwhuIj4EfNwfp4RrFGwJVPVLJ9gaCFYurQEXhtKmBo2mQY091pIfBaas7oX5TxXjOE3GaKtMMq5zlS1JKS9j1dA0C0ZO8plnAqmpNz2urSTinha6MU9kmHEmoEJxIp/13gyVy8gL4q2f1TjATnsZRw/51jWAVlx5asmm2dU/BzSYD1X9l/zXqo5TIMgNIeuCSSL4sTwInBNJm0rnDi7LqsmSao3pV58kOZ9T4j8jAp1VtcypoemFp9NTPkJWpvKa3l9eu0vc2PJ6wbMit6TZYNI86+H6ae2b7I+MKYc9xuw8Rt6TAnHsA/S0w67aMoca++jqYR5uaTi5VDv01v93/wsU+mVUdwEkGFbVP4Ko6oItBiHrgonAjwQT/PJfACzhXa2nqHYoXK3ZbS3RwM6gR2VSvmhTE2w72laZ0VcmGEs8X90osZxWW1PS1Utadr6MEH+mVpgy1PWsCaSJqnmC8p2mpsedq8wFkgysL8aTUvvbJZ3DEm620OBqTV3VObdxyIsI4/vWFViOBbtXe8954FDzl1T19YSAy/wf/1VUdcGWgpB1wSQRJuswk1n5mr3Wkn8RCl+o5kMpH7nwlkqgze0Us2wrX+Vpuchz1M1luymfuOdVW2PL5SSQWeq6yQTSobSEyZ/BfpRgm5L32ImmWZYYEytMTBopx2d6/opYYFK/m3689fOah7Cw+t8fy9XWRtPixV8+9VTb1U/xa1SVLwSq+geAjyGqumALoqpfPsHWwmX+61T1GY3GVja71RJunvjqme1GEyZIzktsqypknLHampLppUyLT8GyRW0slEDiyiKR8dvJ1pchwhwzedQkWksaeU8k84z2M86iTHFlEtMmclNkdlMWhHA8s7GfBauJg8bSsNmwuODxNq+4+aRu1y0qrqxbeB+q/zXrgQgEk4KQdcEkEfzEnz+bzjUtVWdZtXDQhan6BE0rE227Km1N9inG9JHnPRyn7HBeCRYX03IlE8mAeKflx+5nEPQ4cp2mmmeR9qzIMJk3DqlE3MwGlHr+y4wk04+3rui5DntrO9lT24mjvTDlroLXf+I4i5uu6tmUuO5z6QhU9T8DPkdotVJR1QVbCULWBZNEcHW4yH+d4uRShYNmWbVoqnrGRSx9v4wTMIm2xmp7a/HnUo9/cp+HlJbzrBpaIM+4XMnqerLdJZ9SnUX2k0h3kmc9rlx47Fk2GJNxRol6or0nJb/Q+5Dz6YmLy6Ld4ozGXrTTY32hxo23rvLUO9ZYW7CwqrukkMYj523gF4dOtkCwxSBkXTAphMM2HgqlTQ1au+xUC9SUFblIldhHxv5YjQmGMQbBLqpoZ5bW5bU8qDW+il7EClO2up5lCSlC2JMU9aArU896pm/dMPZ62riHjjFVdTfIn2AkGa01NhZn1w/QrsG+0z1e+6njdGqq6vaXYLXSdwC3Iqq6YAtDyLpg0tiNF7oRZjBDf5e1OF631b5YzR5lertztDUOwU73yI9z+5VyQ2h4ozHaewGPuc5frmx1PWuyZdS/Pk5M9f52QStMeJxZNpi4MSVPQs1W3c3P02TeOwCUp66fVdtHt2Hz2k8e54zjXTrV9qprPCHoBIMIMNUdrUAwJoSsCyaFgCEfAHZOu3ONxlYWO9UC7hbzTM8r8tHeMQh2rvc7h1xf8NjS6X+66mmSV6TcJAlhmmIcT1SzCXuSyh7Oz1LSs/7i2soTe32YuBvYeAyfQEz6fVOA6zgs7zzAjXc7POeWk6wt2NhupX83A1X9/wEP4BF3UdUFWxZC1gWTQkDWD+F9zspcPjQTGk2dGkuqiYuL6nc9SRNMRdoa4+ZkhBTnaGscgq1zHf/0SUR5dqe0m4MUFb2AJ5kJELtEz7hh7PS4uuGxmvrD4/zp4bw4Aj/6TsSXHTf2ehZRz+ftn8x7Ft5WGrqW5ozNOt/3sZM4FZ5N6iOwV94D/JqfJqEaBVsaQtYFpSOyINIZ/uvUGJZnltcsqAZNVcctretxPB/l0b1x2spHqMurW4WIMEWtKZm5MT7s2P0JWGESy03Y+2zqsTZRj+MIexyBDsqO2FBiSLaJFWb4LUyuN7KdEnvdlKib2l9yT0DNPelUg+vitJrs/tsPsevR4/QaNVQFvq8pCAb3/wNO4XnVKz1ggWBcCFkXlI5P3PDu8O6Z/usUf0wVLpol1aSeuXJpGCUS6rG013FUZ0qsW0HkINjpur6pGaX4mcjzXCGx3JgRXSaprmeSy4TY6dHyw235FhKdrbJH+x/HChNtw4Skj0vU085H0ntR+o2X66IXF6nf8jVqH/s4vaUFlFvd8C94CroNfAb4QzxtRlR1wZaHkHVB6fCV9QCHirYzDrTW7LBaWNGVS4cLFW9/km2NUTdXW1Vk43nE+tTMfNQ9cb+k8RjfGqRYYYZbGIOEl0Dy8ijDQ/sJBDUa5YWUPFOCnfdfeOymJH3gT89P1NPOVaEJqHlVda2hZqNWVmm+5z0AIbtgZRFwlp+N7AsEWxryQRdMGvtn0alCsaxahfnoJDX22ej1E8QYhDaf+p2HcE/+MIf2TUM4lmyFmYW6ntdznUTY40j4cJ/xbSZ5y8P5cVaX+HMeT9pNI8OESXpeom7qUzd9D3K/v9rFbbZovu992A8/Aq3WWKLDFBAsgPRHwCfwFHZR1QXbAkLWBZNC8Kt/wH+domSjsZRiiWZqpIy4wY5zoGW0VU02Ps7h5DEh5Tn4kqwpOWw15rk6Z6n0kpMMsWjSTqLSa6gSx+4blNN9xTpdUQ/n5Q3dGD4feSLDJKnpRY67lAmoeVV110EvLVH/whdpfPJT6KUlcBwqDI1Hzk8A/z2UJhBsCwhZF0wKwQ/p3ll0XMNmQTVCF8n4wW1ZTCkiTC71u6xJtqVZU9LocrGxTtIKk5eQJ/U+rt0lLj+NdBYh7Ile9lB+maEbw+cjqa2RcSSo6XmPNzMv40Yptz1Ga6jXUUeP0vqz96BrNeYAgZH+F4H7kVCNgm0GIeuCSSH4cQ1irE9NWXfRNJTdjwQzdsdTY/bTMcjkIdg6o+6skY9SF7TRmGZN0ApjZneJtqXT6xa0u+QhloWU5pS0MFnujycjdGOef0ntppF0Ew9+6o1JxrnJek/y5Pf3ajVa734P1tGjUK9X3f7i4qnqXyUSqlEg2C4Qsi6YBAJ+3AKWp92xRtOk7keCibsIzcj0UmLIxTwX16oR7NHxZSWYHkvBc5SDpxur40NEybT9MKE3IV3J5yaO8OVR18fxTo9D2M0jwAxbZMJl4xTzxHOWqrRHbDgpJD3t2LLOQ+Y5Mbg5MsoHcDz7S+OjH6P+hS949pdqR3+BwfXkp4EOoVCNoqoLtguErAsmiSaw5G9PSVlXaDQtVcfGKoGoTkvtju6PU3dKh1ewnXzWlIJqeOH+xz/Ica0w2rit8SwsI9sGJDIuLS4WeBHCnqWyJ9tedOSPobGa2F+S2knzrWcq7AlKe9x+Ur3Ecx5TL66NoW3HQS+0sO+9l+Z734deWKi6og7Qw7t2/AHwYWRSqWCbQsi6YJJoAYvT7lQDLdXAQmXzq7HU7qy2ctTNeXxTxxhK/iQId3E1PG2sKTUnaIUxUde93fEsLNH208h2VlsmRDEPYc9S2UeIb0roxlHSbfrHSJvh8216E1H0HOQ9v6bvEYB2NdgWqtOh9c4/QW22wbarTtY1njf9ceD/89Mq/xhAIJgEhKwLJoGwDaYx7c619lYvHVfMH0exroTaPdaxT8hmMwFykNpiCZNay7bCmNcPlxrPwhLOz1PWlIwXjfaSpEibKOpFor+Y/Iu2nZekJx7XmBFyEtMynn5oAO2iFxZo/uV7se++G724MA/2l2CAPws8ithfBNsYQtYFk8QinjIyVSgFLeq5682d2p01ipKiuIxj0Sk48gwle3ylPq2/yVph8qv1Q9sFLCyj5yyd8BUh49HycWVMiWwWaR9qK4Fcm4ZszaprbINJOm8lEfW0tuLaGdru9dDLS9Q/dzONj3wUvbxc9TCNMFip9B+A38PjKmJ/EWxbCFkXTBItBp+xqUWDUSiaqh5DSEndT8XU2PhkVOpUgjuDOw1za8qEyHli+2ZWmNTPko5vz7CXSEfZdpdUohbdHpo8OdpWalqBSZBJJDdaNo7Ep5H2NDU9PN6iYRtNrDdJY8tz3KnpOaLtJKY5LrrVwn74YVrv+lN0o1F164t3KB5RXwd+ataDEQiqACHrgkkgIOZN/3WKVFdjoWhSmyIHHYdgT0r9ngGGyGz5hDtPtTLU8XHby3MrlZUap67nsbuEy5jaYdK80aaEPY74jtQzjABjYlWJ6zeP/SWp3ZG+TdR2w2gxSeclWi636q41WArV69L6gz9Cra5CrTYPZD2Q/X8O+AYSU10gELIumCim7lcHsLCoqyBsY3DfMA6dzVE3Fxkvb0RTQQ5bTdF2TA8y/amJmR3I3Apj9k6ZqOtpHeVR1/NONo0j4Fl2mOA1V+jFBJU8qX5WWhZZzrLCxJL5Akp7NC1pfHHpQ31GjiH2fCact7QysfVcF724QPMv/hL7jjvQi4vz4FN38Mj554BfwvsB7816UALBrCFkXTBJBH71qSrrNSxqiTHW4yoVp80TI9hlnbGSorjojLKlDDXH2MxrFmnfTLJPJ/TZYzCpH1c+j91lHDuMif2iKPHMpahnqNzRtGhe+Bh04o1bggUm5aYgaZxx6dFzUOR8Jb4Xce9hr4deXqb+qU/Pk089sL90gH+LR9z79klR1QXbGULWBZPE1CeXasBSFjVlDS5hY/DKPDS+ElaUVCU/jzVlliPNMTZTK4zpDZmxtcZMrTd6rpJDXY+zw4xsG6rvqQTQIFzjWJaOooq6oV89Ls/IApOUXiQyTMbThSLnM72Mv+046MUF7HvuofWn70Y3m/NgfYGB/eXngS8h9heBoA8h64JJIvh8TeVKEUgwNSzjBZGqQbCzRhXOMbN45D6W0pT85LEO7ZcQUjH9EMpQ2xMPzKyX3BNNM24AMuwu4W1TO8wQyYtTusdQzpP2s4hrFjEP52XFXc/7b3Cq09tOGl/q8SScC2PLUGYZPJtLrYZaXaP1jt+Hzc15iKcOw/aX/xVKEwgECFkXTBZT/3x5NhjbWxApNn+sxotmRorm0V/NyfhULsdl+daN+0tu39i6klgqf3vpveStY66uJ40sT7zt6HHGHa9J+UKKcAopHccGk0awU8M4arPyaf3E5adOjDWJiJPUlslNkfZT6zVa73wn9oMPwcJcxFMP7C9t4MfwPOqWny6qukCAkHXBloLyfvWV5ZP1LAKXh1zmoMZTmmQ6CaQRYp1Rtlh/yfvG7Re2wmRXSle+Dch5QXU9yw4TPj9xkVii+YPqyYSeoiQxbj+BgI+0b0jak4h7tEyUWIePcegvrkxCO2kqe9yYko4pLS3unIVJvtF74Djo5SUaf/N+6v/0BfSOpXnwqcNAQf9Z4CuI/UUgGIGQdcEkMQPuqX1dXcVejicx9Mm0mrdwSsUZquGp/VXQCmOs1hsT+qyW4hrKbmNAr4vZYYL9UUKfTfDzEHZTlT2NtJsQ9zLCN4aP10Rlz4pWE1cmMa3ATdDQfq+H3rFM/Z/+ieb7P4BeXgKn8oo6DOwvHwH+LxL9RSCIhZB1wSQRXC2mtiCS9zzVI+v5KpajfpdHP8ex1aSNx1SGLtbfaJMl3AxM0Qpj0lRucp5HXTe5CTCcbJpmh0lX4JMVexNymRai0DgCTAKBDo85rxXG9C+tj1SFPabsSBlDL3uucx5MKL3vPlp/+E50berz+osisL+cAP61nybRXwSCGAhZF0wSM3kGa8fNa83DfQtnjgNz9Vunlp3EyMoZW5EzUcQKk3rDlBi6L+2YsjsqQ13P1YahHSbNdjFUtyTCXkRl7/djSIDzKunJZz1baTeaaJp0w5ByfJnny5Souy7U61grKyy8/fdgY2NeFj6CgZjzH4A7EfuLQJAIIeuCSWImjzMtla6ql2++MGkpjzWlnB6LH0UJYzO1wmBGUouO14w4T6Z+PnXd/CbA1A6TO1xjQcIeZ2uJls1S2U2tJSZK+uj7YEbic080TSD1RscZrZdxoxOb7mpQChS0fu/3sR5+eF4mlIJ3bbCBdwG/72+L/UUgSICQdcEk0fFfp2aDAW8F0zDS6d841DiNkZZjqynOxpNvDlLV8Amwf13wPCUdztjkvMyJpiWo68lGngzFPcUOk6WemxLDKGEPE3NTK0fZEWCi+yYEfhz7S1KfSePPulnJe66SyqJd9EKL5nv+nNpXb5mXhY/AU89rwD14ix8FaYCo6gJBHISsCyaB4MrX9l+nStbT/ep5iGM5hLs4/83j3ZmuNcaY/Bc80nKtMGb1k/ssV13XieXjDqCYHWaQHU/+4sqbEPY89fISV9MIMIkkvaR/Se2Fz+m4kWHyPoUY2Xcc9I5lGh/6Rxof+jB6x9wQdaAfquuHgGN4qroGIeoCQRKErAsmiTbhJ/VTQh5d3RTTsaak+2uT9idh68nTX5ETMazmGx6BsbXGTNU2IvRlq+slTjbNa4cZIo45iXcewh5W36Nl85D2aF44f1y/ep66Rr71ApFhEs9TxjkMiHr9i1+k+Z4/Ry8umD8tmj16eGT9vwEfx1PYHRCiLhCkQci6YJJYZyY+RE9ZH7l8pZI946JjZCZbU3J1URTTDuE4ZvvpZzIvuTY7FxNX1zPHlmx9MbXDmJDxuLQyCLupyj5O2Ma4MkmedVMVPTi8pPay+o+OP+54ktLSznm/vD82XD/yyz330HrHH3irkyo1L2Q9CNP4IeDn8fiH+NQFAgMIWRdMAsGVY4OK/BhPQn3ObKlqvvWhnBx3LgbHl6bEFxtt/vbSyxQn22Wo63F2mGhpndpYPOWP2mGGWs4RrrEMwm6qEJuS9iRSHC0z8tkrGraR7PbTxpI29rRzFVdnpDzamzjabGIdO8bCb/0ObG7OW+QXG3gUz/4yBFHVBYJ0CFkXTBJtPHV9ysh78cpD8orZT6ZhjRkmz+P3P1srTHZ7Y5PzqanrWfWK2mGi5czIeJqKG7tvQNhNVfZxI8AUCd1Y5N/glBqq7Ck3F0XPz9A51y7UbNjcZOG3fgfr8GFoNecl8ksYPww8hEfcJUyjQGAIIeuCSWKTAVmfmvyjM1PKUcPzjWH8mpoSxjbHVhjj+iZKOPnK5FPX40cad6NQlh0mTNjDdhgvKcYCUwph10bKcfBqStpNI8BE65iEcYw90zkjxCSlpSruBuckKQ3tglJoy6L1jt/Hvusu9NLcrFAK3tNVC/g54IOEfOoCgcAMQtYFk8QmsDrtTlNJXY6s4taUHIqvqRo+B1aYXO0bdZtNnNP7nIG6nudGoUQ7zOiYh8c+RAbzhAdMKDeOyp5F2kf7yCbL0bxoO6aEPk1pz7pZiBunqe899fxqjdts0nrXn1L/4pfRO3bMU+SXHh45/zu8SaVDPnVR1QUCM8zNusSCuYLGm+XpAiuhtKnAjdCdpECOaXnFDjcuS3sTwCba//T60+h+aMxoe+G8pI6jZYb2E8ae/h6a9MlQj3GtmZTJajN/P2Zp/e3QxuhRhwfnnccgJSittUYp5ZFCTX9boWLLjNQJIZzXP36fYEbrh9P6dcPbMWWief20mLEEZYMzUwZSn2LFEHzT/NEnFJH8yE0QjoO7vEzrfX9F46Mfm7cQjUE89QeAt0QzhagLBOYQsi6YFIKr+Mlpd+zq+MfD6WQ1D60f7Cfn5O0/DeH+kslunrEk95RCpguNPH/9NNJr0t5wGQPSbHCTkN1mPJPPJPVDxDq59ChhjxtFaJQlEfZ+R6SXHdyLj9bPS9qj5YJ877BGyXtw5JOATnzyolPLjhD4GEIeT9IHJ1wHsdQ//BGaf/N+z/oyPx714KPXA74PeBzPpy5hGgWCAhCyLpgUAh5xxH+dmrLuDGnrAXJQ2ZLUaeOyI/0l3wwUQ6SVUH+p5Ne0c9P2EkeXra6nja0a6npyG5ntDh1zcqvZbUdaMCTskNAIJKrsUcIelE1S2b0uskl7tFy0bLiMd4jJPyvK5HPkH2sW2U/KN1HR48rGKexDdqZeD71jB/Wb/4nWu/4M3WqZHUt1EIRp/HfAp/ztSkQGEwjmEULWBZNCcKU8Ou1Onb4nND8JzaVOF85MziveX7jc7KwwKZWyybVZ9dmr6xpQGUQ8TgpP6nskLX0r2nYqiTcg7FlEvJgtxkvNQ9r7eRnEPXgv4jD0VKhgSMM8Fpi48smKedj/T2jOQqS846CXl6l9/ess/P4fQr02T7HUYeBTfwfwG3iKuvjUBYIxIBNMBaXjEze8O7z7xHR7V76y7g5RtSQUv/zpxP2RNksJqZhCICij/fj24vbjK5mNr9jR6sxC2qhMdptZZcqcbDqUlhIdJlar1SltRdNiFk3yknX6fko5k5jqXo/xdUwiqAy1GylfdBEkk3+D05bcV9rk07Tj0sH5jJmgGxB1d2kR++67WPztt3u2F9ueJ6IeKOo3A//GT+t7d4SoCwTFIMq6oHTcdPObwruP+a+lz6UchfaUde0mKuvl+dbHrZV9LMm++CI+8nKtMGl1pjHRdFbqevyxFJlsms8OM3zsoxNOM60zJSrsQHIaSdYYr0SW0h7NC/KD9zMMEytMGUi0wERvkXJNPI1R3x0Hd3EB++GHWfzN34Z2GxqNefKpBwsfPQa8GS8amIXEUxcIxoYo64LS4SvrwdXo8Wn330twrefSnUuJt55D009R3wt1XlK8+EGd8dqbd3V9mGZlqetxHWqjT2Q4Tnpa23EKu84sW1xhj6rmJip7ND9LaTcJh5ikuieVMYWR0h6Tbhq6Me0caEC7Du5CC+vIEZZ+421Yp07NG1EP7gMd4HuA+5CFjwSC0iBkXTApBFenwAZjT6NDhaKHi+ur7JmjM8gyJ8+zI/+FrDCm1pUCNwhFCVPW2JJJs0GbJuRc66wSMckZRDyPHWakXPJWdvtxZfMT9jRbTFZ5U9JuQnaTyHscQS9qfclqP2s8g9Mcd7wJNziug242UCdPsvQbv4l15Ah6oTVPRB08Uq6AHwM+hix8JBCUCiHrgknjCaa4iqnCC93Y087IRNEkFB+UGQHPRf6N2y+mj5fZXpYGnDUEM7JtMP6Jq+ujaf1+chFxw7QR/7opYU8i/8UJu8nCSElpeUh7OC88rqI+8nH+Db8V2X3FlR05Pp1wflwX3aij1tZY/o23YT/8CHpxcZ5WJwVv8qgN/BrwW8iEUoGgdAhZF0wKwRXrJIOIMFMg656y3sUdiSwRHVj8kNLU3QLqda4zZth+Ba0wZdWvkrqeReqL2mEyek8ZQ7T0ZAi7R5jjVfPgNUtlL0badX9sJmr64FD0xP7C7/WIyh7pO+5Ywudz5By4Drpeg81Nlt76W9j33e/FUp+fRY9gEPnlg8BPEvKogxB1gaAsCFkXTAqBh3GdgRVm4mQdvDjrvcQnsMWGYG6FScnMQf6LdDYLK8wIWTaxwlRUXc+2wyT0nnGaTO0qI2kJExKH90wV/Jj0GMJe1BYzLmlPJO6RMqZKehFktTcyjsSbDRJvNPp7PlHX3S5Lv/nb1O68C708d0Q9iPxyK55PPXxChKgLBCVCyLpgkgg+Xw9Mq8Mg0kVb90aihYySoeS84uTZjIBXwQozOvK8KnX+Y6quum5CzkdJ8LAdZgzrS9IoUiacxhJ2HZOW1rdPOsP0OImg55lMmoe0mxH3DCV95CjLtb+MRnJJUNCTVPTwnuuiazXo9lh+2+9Q/9bt6OXleSPqQeSXw8Dr8Z6gyoRSgWBCkNCNgkkiYMv3+a9TUNYVLpq27oa6nKMQjkMhFVMWaDJtMKU9o+EQDqlYpM/8YRyzz1/CQEzaHCqTEVAxEu4wqdZwX15+XB1Nfy2l7HKJ40oaTaQPBp3Fjdj730vNCu0IoyuZDioOL2SUukppwYWQgjrxPx+DcJ+T+XFJuTnNu0ASeF70mg2Ow/Jv/y71W29D75g7oh58TDrAG4E7kBVKBYKJQpR1wUQQWRjp7mn2rbWmTc98ufG0y3wpPvJqWGHMjjE/5cnbZ5XU9UyLTSE7TIZmblAuzpKTS2HvbwTWi/JsMVnWmDxKezQvvJ/mSx8+BtO/4nWSlPZ4L3v8EwMcB12z0dpl+bffTv1rX59Xoh5EfvkXwMeJEHVR1QWC8iFkXTAR+AsjBVe7e/3XqXzelFJs6k7kcXoYKf4XjLIySk7OClPEupKnPbPaBrUq6l3X6AyybGJPybLDGLSjR2qmtj8eYU9oM7b8YD/OFjNuBJg020sW8U0j70krmo4ea/rnrMhE02h63LHhut5kUu2w47d+l/otX0fv2DFvRB08n7oN/BfgjxGiLhBMBULWBRNBZGGk+4Eu3udtClYY2NBdA9KVlleMZpdCzsdcIGmE/pm0V+JE0yqr63EVs4i4aex1U+U+7l6hKoRdB/0UUNmLkPZkv3qCwp7wb/g06cJ/0ffThJynee412lvwqG6jez2W3/a71G/52rwS9SDyy28C/xMJ0SgQTA1C1gWTRHDVeozBSqYTJusaC09Zd/pPa9MHlzks0xCIM7LCpJFUk5wiav3cq+upbcTbYYxv/lLJsWla8jiGc8ok7MVV9iKkvcyFkPQE/qW1PThFaeNkaDLpzre9ncbXbp13ov5XwL9BQjQKBFOFkHXBJKHx2PIag4gwEyXrXoeKNj0c7aRMXCxmhSnDulJqe6YNmKr1ib3PmbpuchOg00uUY4dJbkXHlMu6tQifh/IJe1ydbJW9zAgwJpaX6NnJQ7zHqWviWw+fRe04uPU6dDrs/M3fof6NuZxMCgOi/hngzeFDBCHqAsE0IGRdMGnY/uu3/NeJ22AUio7u0dZdBjEkJkeeo/ulGGhKJNfF7Dflq+smh16Gup5r7AXsMPkJe4ZqbkCiJ0PY9YBxJRxTlspelLTH7hsuhFTEr25M4AsukDQyfqeHbjZQG+vs/I3fov7Nb81jeEYYxFK/DXgNsEHIzihEXSCYDiR0o2BauG1aHSmgi8MmXZZZIIsiJ4flC+2HwhGmthFtIqmkaXupOYN9TXb4w7T2UofdL50dxjFtHHF5JuMe7jf+vMUOJ3y6M/uOayEmLbb/0XJxbaf2ENmI+1yO1B8JLZn0aY7UD74OKqXtUKFBPT/N7zNoIiCsZYRtjJbvp4VCgUYRfl+1yc2hIbJu+uJDN4JyHdxWE+v0Crve+jvU7r1/nom6DTwMvBI44u/P3YEIBPMOIeuCSSO4on3Df5340xyFwsVhXXewUPQSCaEJRU2l8MYlwznG7Y15gzBCUE1irpvESE/rI/fZHS1s1m86mc118zLUtxFlN0rTaJRW5iR84oQdhmOrj/YH8aR9JCY7jEXao3lBPhCfFkOM0wh82Ui6CRjp23FwFhewjx7ziPrDj8zjyqRo7423FRwHXoEX0WuIqIuqLhBMD0LWBZNGcDW7E+8RaiB155WBc8EF1nQ7ZigJZDWDsCUfWglE1WB8Jj0VI85jqOvGh5V+A1COup54x2KmrmsSFhGKSUtZLCld4Z8dYSeSF98fyccQR+gLkvZoXlx+v0yKkm6iomettZBHiU+7KdCAchzcpQVqjz7Orre+HfvwYfTSHBJ1hbZclOXqtU7d+i6t+FrN0RKiUSCYIcSzLpgYIuEbH8EL4RhOmxgUsKo3E3zGw0j3QIe9xYaOc52/vSJe+UInMWcYx1TVUiclp/eRPeHTQC01iM5iOtlUR2oZHWhh/3py+/G+cgMvfWQ8MY7zSJ2Y/mL6jDd5JPjZDT3tRUM3ZkVnSfKh5wnVmNV+WhmcHs7SIrX7HmD3r74V+8gR9OLCPBJ1aj3tbDYUn7p2xy98+sk7PnX/oWYdIeoCwUwhyrpg0tAMHp9+A7iSiZN1L3zjmm7Tww0t8Z40vElaYeJzjJV3E+tKSmZYTS5LXU/rw+Q4irYRr4ynzTkoaocx1P/z+tcz2s+nsEesKcF4oCRbDKSr7IP8Qf0spd2vE1LbCeV7ufn86kGd8LkuE6lqenAcjouzY4nmbbez6+2/j7W+iW61wHFNu6kEtPIeLtVcrHe+5AB/feOef7r/nBbXf2vV/eNfuAcQoi4QzApC1gXTQHA1/TLweiZM1j2CoVinQ4ceDWoRVXHWVpi01osQZzMrzKC44Q1AYm/5JpoOOKCBH97UthJpL/Ps5rLDJLdjljbag1n7eQh7Svq4thhG+4UySPugTpwNJjhPYcSR93D5uDqTQLwKr8F1cXYu0/riV9j1+38CjoNuNsCdR6KuaHUc/buvOGh95podp2/8+sq3LnysjVZePHUh6gLB7CBkXTANBFe6L/mvE7dfWSjauseG7tBSdXr+AknZFHl0b5hhJRPdYV9z4k6kYwPiPEJKE2jYWOp62rjGm2hq2m+xiDbx793wUwwzn3x2BBdT/3r8MWf742P6mBBhH06J86Mzwt7LIO1BXlE1vUy/+uBUFfCta+8/d3mZxY9/ml1/+hdoy4J6fe6IevCG1tsd/vilh/RHr9+pdq317rr37ObjAK2O1kLUBYLZQjzrgmkguHp9E1ghFKd3UlAoHBxW9SZWQJASYTaUMnzlWe7oMnKKKY35vPBDfRh41weJBuPM4zFPUjzj6pieljz+8tAYTLzlcf74eG+4qYc9JT23jz3Ly57mZ08pE3jaI+OJettTY6knlB3Hr57kW8/sw/W23YUFlj/w9+x65595q5Ta9lwSdRdY2HD4ysuv5++etdvdse7gWOqWRlfT6OqaO9FQAAKBwARC1gUTRWiSqQIeA+7wsyb+7FoDp/VGTHcpxDSRg6YNNx/RHe3IjNwb9WlKnMucaJpSJmuyaWL5DMIeHacZZc9uN75/g5bzEva8BHwcwm6wgJKOaadM0m5K3IPzM0KQDYi2Lunf8OmL9Ok4aEuhG3V2vvsv2fne96MXWt5TqBJjvE8PCmttnVOvfhl3vPAp2KvrYFkA/zTrkQkEggGErAumhWAl0y/7rxOXoBRwSm8YE0Zjcm4axSWBRZup60X6NCPXuW8AEkuPMlojVT/jJqD4jcHono6rk4uwJ5HjZCU7rtRMCXtobHFK+mhKkkIev2NC2mPLpRD3NPI+9H02VM+L/g3BddCNOlq77P69d7L84Y/hLi8NHcNcQSms9XVOvPIlHH/5Czl66mG0UoE1dmq/0wKBIBtC1gXTxmf91wk/XNVYWKzqTTo4vhXGkKpro1KZ/WfXGVetL6Loh6uXrK4bqPq5xjkpO0zuNHPVPF7lTyPRWWWKEHYdT6B1HLlOu+kpm7Qnq+lR4h4tZ0Lgs2wxachszenhtFqo1VX2vfV3Wfz8l3F3LM+f7SWA8hT1E6/4dk5+50vorZ7mcO+UaysL7YXYvT04Nf7TUYFAMEMIWRdMC8FV7Uv+ts0ErTAab5Lpuu6wrttYWInKeSG1fYQcmthSxlTrCyn64eTybwCKKuNlqOumh55lhzFrMAdhJ5kCpyv9xQn7+LaYLGtMGaQ9nJuipoeJuwGBT+qvqPVlZJSOi7O8RP3Rx9n/q2+jccddHlGfs9CMfQSK+itezLFXvoT6+iYr7jonnBVtKxvgK3gL2E30N1ogEJhDyLpg4ogsjnSn/xdOmwgUih4Op/SGp6ynKZyxAzIbXhHia2aFKaJI51DCoRR1Pe9kU52Rn3SiTNX1ydhhkkc+kpO4ENekCPt4tpgslX1c0m5K3KMpicp7DImPqzvOX79PP4Z66xvfYv+vvo3a40fQS4tzt9gR4Pnq+0T92zn+qpdira9hWzbHnNOsuZvaxkKjPxPUmPWQBQKBBwndKJgWNIPFkf4JuAJPYZ/oDaMGTur1UIJOWZxHExcEO7QZux+Xk1wmrU9NNcI4FjmO5H6SC6W9F6E2ht6LIrHXR48idzjHlM9DkDJ8/nVCSMfRsqN9xLQXqQt+9EdM6sDIAkrBGCEmxCMJrYx+KkaGMLLD0JhHW472MFwqjujHHkPZ8Nt1lxdZ+uRn2f1n70NpjW4151NR978T1voGJ175Uo6/4sVY6+veD7Cyeax7DEc7tlI19MCqKKq6QFARiLIumCaC6+wnIvsT7FBxwl3DwY0hj/GaYvoVKt4KY25LydvneDmVV9cnYYcpGB0mcwx6UEFnNRQ6NlOFvT/ptN9PnPc8RknPVOUz8hJV9rSjjLezxFfVKTWTkGx0MVbGc6Jf13XRto3bbLLrvR9gzzvf493Q1Grz6VEPEfXjr/6OPlH3shSudnm0e9RVXmD6B/BWmgaZXCoQVAZC1gXTRPDj/zmgw8R96xobxareZIOub4UJ8pJrpe9n1U8uadSnNh9ZZh8FLSkm455WKMfYU2RI6ovYYcyOJZmEj6TlIOzxYypii0mn2rF5MVFZSCitU8rEknadXdPss2BOzwtbXxwHt9mAXo99v/dOdn7wH73QjJY1ORV/kvBDSlobmxx73Ss48fIXYq2tDSwxWKy5mzzRPa5r2Gj4PLCO/9ssk0sFgmpAyLpgmgjI+l3Arf72RK+AFopNupx2N/xJpjpy0U3pPlEsTiPXJsTZTF03U7mzB1+Guq5jjzVaJltdz+7blIhnqftxJNeMsGujz0SyUj1Twq6HNlJobIrKbuhnjy8zXNeMuOuElDwoQs+H/5Tj4C4tUjt6jAO/9tssfuErcx+aEa2x2h2OvvFVnHzJTVira0EcdVw0trI57pzmlLOqvUgw+mNB7VkPXyAQDCBkXTAVhBSaYJ7Ex/3XCT9qVbhojuvVFBPM6L5OLRmPoip1npZnpa4PkvLdBBRR1xPr5D15ecM5mqr3qSQ6gQhPgbDnV9kTQjwG4zWIGhOfk0zC4xOiifHkvRiJN4DW4Lo4O5ZZuO12DvzK22jc/xDOjqX5tL2AR9RdF9XtceR7XsupF9w4RNSDc2krxaOdI7rtdmsWqgd8ym9hTg9cINiaELIumDaC6+2H/deJfwYVcEyv4mAw6XFoiImbsftxOSbq+mhHBkR6aup6vhuNIgslmaj2safJWHEnMy23el85wq7jisbnJfSdSNpH8pOps04sm5CfyMSTKXqWRp4Lrou2LNylRXZ85BPsf9s7sFfX0Ast1DxOJAWwLJTjoLTm8D9/A6ef80xsn6iHz5HCW/jpoc5h7dnV1deBbwVnZtaHIRAIBhCyLpg2govA54HH8D6DE3vG7PnWLU67G2zQGfjWE6wwyer6aMuDzYIqda4+p6+um90oZJBcg74LtWvcfw4yHZNYZcKe2YbOUy8lP2GVUVJaJLFciuIeXywhw+yGIfXPdT1/OrD3j/+cPe9+L9q253ciKXhEvdNF2zZP/NCbWX3Gddgra2jLGnkvLCzWnU0e7R51Pb+6/ohfoAZDT0MFAsGMIWRdMDWE4q3bwCm8iaYwYRXHQrFBl5Pu+sC37sP8LkHnSC0hpwLqenwbxTBtO0xZ/vXMsc+MsGe3UUxlT7uR0SOfuTykXaekJlJwI35uTM/7f8p1cJcWqB07zoFffzvLn/gs7tJS3+c9j9CWhWq3cRdbPP6j38/ak6/CWlnDtaNEHbTW1LA53DvJSWfFspUF6A8NFRIIBJWBkHXBLBB4Uf5+Wt1pNEf1SkqM5lGKlLEZydAmLSXuVEpdn1Iox6x208sl9JWrXXPCnnruRllxah/h8eQh7MOhHVPajiPdxiq7QX5kUaJkBT2+ZZ1aJznVWGhPI/iuBlfjLC+x8LVvcvCX30bz7nsH/vR5Jeq2hb2xSW/Pbh77N29h49KLsFbX0XZwiQ+dBP9jZCmLh7qH3Y7bsyyshzV8IThLsz4egUAwDFkUSTALBBeDj+GFCVvEu35MKAKBxkJx1F2ha7uZvvXwQIYHFT9E84EPSibXCeXkXCTJpM2sxYrM2iBmsm7GfAANWqUvRNRvd+iYTBcqMl3kCIMUs/bjyyb3OtKTwcJJRPLSFlDCpJ2hemTUTcsPHQP0j4OhsqMpo+cvrkQcYU5eJInYNmLguOh6Dewauz7wj+z6238ES6EXFubXn45P1NfWaZ97Nk/88PfQ3b8Xa23DJ+rJN82Odri//Zi2vO/aJ4BV/IXrxAIjEFQLoqwLZgEX77p6H3BzKG0i8Hw3Fit6gxUdhHAczk+umbpJOn0wUbmrpa4PEvOp66btlmqHyZuWqGabWE+SFfw4hd1UMU9X2MuyxWSp7ObWmGJqe2btkRLp9fOXwnFxFhZQ65vsf/sfsfuvPoiu1+bbn45P1FfW2Lj8Eh77sR+ku3cPamNzmKgPi+q4QA2LU84qj3WPUVM1NPr9sz4WgUCQDCHrgqkipNjY/uvf+q8Tff6sUHRwOKpX/EmmwdUrniInE+eUYeb2kGeXmZZ3vfBCSRWywyQXySLspqQ4P2E36ScgufFU1mBsRvYWHV88lzVGG5QbHM9orfi20pBNz9NKadAuaBdnxxKtu+7m0C//Jotf+boXPz0Y67zC8oj66tOfwmP/6vu9m5F2G6zw79vwGfK2XWrK5pHuEb3qrts1rKMa/Qk/e37vXASCLQwh64JZIbgo/APQxbNkTZiww2H3NG6C8SAeZmRzPJV7+ur6tEI5xo/M8GbB9EbAgEzHHVcuwp6RFj+epH4SiHlRH/tIn2Yq+2gVQzKel7THEHc90pYZeU+qFUvoXRddq+E2m+z6h49yxm/8HrVjx3GXFudaTe+vPrq6xqkX3sgTP/gmsBSq2/WJ+vDpHD3XAIp724+6Go1S6pPAESa8orRAICgOIeuCWSGwwtzOVKwwXgjH4+4a6+EQjmCkro+2l7A3D+q6TspNb8OsbzN1fdqEfSTNcMJpv67OaC9xPPkIuAlhL0dl10lVkvMN2jEl7tE6yakFuaPr4iwuYK2uceDt72TPX7zfC1/YqM83Ube8xY6szTbHXvMyjrzhVahuBxzHy4uQ9LhvtI3FmrvBA53HqVFDa94X7kL86gJB9SBkXTB1xFhh/sp/naiqY2GxSYdj7gp2JIRjVucmJedDXU8nv6NNpNN2U1JteKIyi5XmX/fHbEyiYxJnQ9jLUtkT8nVyfZ3ZTgHinkne43JYe8eEAACAAElEQVRSevCJuLu8xOKt3+LQL7+NpbDtxZ1j4diyUN0eaM0T3/96TrzsBVgbG/45VCkkffi7WVM1Hu0e08d7K3ZN2Uc1Oligbo7vYgSCrQ0h64JZIrg4fBDYZApWGA087p4cvdRPKYxjXPlpqevJNwrh5CwintFu4pEUJ9lF/evFVzgdJbh5YrDHly9O2PPcUORX2RPyY3fyqe2jNZOqmJH39KcEGuU46GYDLMXe9/4tB3/rD6mdOIUz77YXQNsWarONs7jA4z/6/aw8+2nYK2t4DycHkXKSSHoAF7CU4p72w25PO1hKfUSjxQIjEFQcErpRMEu4eDeMdwGfBF7ip9njNJoEjaaGxVG9ygZtGtTJuj75mtXIdnQvPXU4Z6hMwk5yvwZtDuUm5wTnxCicosmRmoZcDFU37r9AOMckDI9DZ4ZPVBl95AnrGP+OJKRHwiLGzbLQfmo0vKOXFu0bcodqHCmc1U603KDEaErSG5TwnVSj7YTLOzuWaD7wMPv+7K9p3XmP500H1BYg6vbqOu1zz+SJH3wTnbPO6K9KOno+0p/62SjW3U3ubT+qasoG+PNwObHACATVhCjrgpkgdFEIPoN/MY1+LSzWdZuj7go1LH+y6QBmKndS+Wqp65n95NHRCkw2LSs6TO62dXq50XGYq97TUNjNbTFp7aWp7ObWmARxPbZcttoeX8f4YxhV4LWvptdq6GaDXR/9NGf+ym/TvOd+b5GjiFI/d1CqH/Fl/ZorePTH/wXdMw5gr254/nui38Dk5w7etktd2TzWOaqP9E5adVV7SGs+4mfP9x2NQLDFIcq6YNZw/NcPAseAfRjpo8Whgcfck5xr7YtkDNRbM5W7oup6CQslZanrie0OnUOzNyNrsaR+f5G2x1kwKWncs1fYIVFlVzkWPwr17aUphgsk14kbC9GqIzsJZeNP9kipOEqdqb5rcJYWqR8+yt73/i1LX/0GbquJXmjN9SJH3sEr0BprfYNTL/g2jr725d7NyWYb1w5rbOlKenhPa2/V0jvbDzkOTq2p6u93tLuCvxDSrA9ZIBAkQ8i6YNbQeBeLx4G/A76XKVhhjrgrrNOmScMnU8MDyl5dNHYzkpGXNI+/qmnRGwWjlU1jiXjWzYLpyqJmaSY3A4XbnxFhx6C//vgg1RaTbHwqYo0Jl4kpl8jih8vGtxvX/nDpJE1cuS66XkfXauz43JfY89d/T+3UKc/2ovX8+9MtC6vbBa05+t2v5OQLb0RtbILWfetLHpIebNpYrDkb3N1+xK5RA9SQ50UsMAJBdSE2GMHMEHNx+FP/dWKqOvhWGDocdk9Ti0aFKWmRpNzWF51dxsgqE3McmfV0Uq5pu+XYYcoK59hPN7CqJIV0nLglRg9tFLbFJBkfkuwlJtaYbDtLqismkmBqlUmqG6rl21qcpUXsU6c5+I53ceCP3oO9sYG76E8inWfbC3j+9M1N3IUFHvuR7+XEi56DWtsI3aRm212Gz5n356KpK5sHu4fdY71TqqbsL5/d2P9Zv8J8390IBNsAoqwLqoDgYvFR4JvAVQwmn04ECnjEPcH51n6KWlmqpa7nayN+a7Z2GJNbNFP1PqndKijsAKXYYiBhnMNtEslPt8ZAutI+XG5kL1ZOT1bck/uIlHEd3EYDbIsdn/0Cez/wj9SOn9wyajp4irq9uk77/HN4/Ae+m86Zh7BXVtF2spqepqQPNgdhPW/ffMB10ZatrHc92H4CPA7QE1VdIKg2hKwLqgCN91nsAu8Gfp4JknXPCmNz1F3ltN5gh1rADVth5sG7bnITkIfUG5Ll0fOTMt4J2WGSbB6mEWImQdgBlPZTVCR9LB97Rl6mlx3KIO2jbYfLJZSNZeWjial+ddcFy8JZXqLx6BPs/et/YOmWW9H1Bs7S4txHevEO1jtae3WNlWdcx5E3vhq31cBeXwsR9WGYkvQgqYbNSWdV39N+pFZXtdPAe4MzPOvDFwgE2RAbjGCmCCk6wUXjz4B1JhxzXaHo0ONR92TsAkmkdq6zNiMZOSwpBmWKtmFWr4gVxXSrHDvMIFFnlsljVRnHEpO3r/jyaRaWDFtMZsSY5PyRBZVGvC15LDIptpfMxNBnxVfL3VYL17bZ9eFPcdYv/xZLt3wDd3ERXbO3BFHXloXqOah2h2OvegmP/+Ab0HUb1W6H/OlJp2/U7uJtaoa/s5q6qnFP51H3tLtOXdkf6GnnQbx5QfN/EgWCbQBR1gVVQTCp9G68iaavY4ITTUFjoXjEPcGl9hmoqHJZWXU9p8XGVAVHg1bmk01N0/Kq2n75IvHXM9s3eHowjsKe1pfRxFPIUNlTbDGRsUK6Qh+XH6u0D40JstX2cNnR8iPNjTSkvQmktRpOq8nCnfex9/0fYuGOe3CbTdzFhS1heQE8f/r6Js6OJQ6/6dWsXn8N1tq6lxki6qkyQoySHoUCejjctnGfslBYWH/ohDi6WGAEgupDlHXBzBFzsXiH/zrR8I01LE7pdY74Mderrq7rhO3MNkpe2TTumFIbyDvpT6dlpR9fZj0DcjMLhT0tHvs4Knt83XSlPKrMxqvtpLYxWlnHpgw162hwNc7iItbGJvvf837O+vXfY+Gu+7xVSG1raxD1UPz0zQvP5eGf+CFWr3sS9uqal+ffcCWfteimJum3y/VV9ce6R92Hu4etuqp96dzGwY862gVR1QWCuYEo64IqIbh4/CPwVeA6JjrRVOGiecg9xpnWbiAqbFdLXY9tsYTJpvHjKbKyaEr/ef3rmtj464lHYTDhNE8M9mkr7PF10pR0A5UdMiagDupDstLu5SX52ofbiGtntM/hklprlNa4rSZozY7PfYm9f/8x6k8cwV1c8OKmbwWSDp5i7jhYm21OPfdZHH3ty9D1GtbaOq4V/ZnTGbvJpqdwGVtZ3LZ5n+7oLkvWwh/c235U28qqAb1Znw6BQGAGIeuCKsETvL2LyDuAt5Il3I3VmTfR9HH3FCt6gyXVwkGnUePknPhNsol1QpsDVwpJ5NvUjpLcd/rNQlnRYeLTJjDhdI4IOxhMPIUQMc6/IFJ0zLH5BqR9ZMyJFpnhdpLaCreqXBe3Xsdt1Fm4+372/t1HWfzmneh6HWd5ySPpW4Soa9vC2myj63UOv/m7OPWcZ6HabWh30+OnGzwNGq3p7dWwOO2s6ds3H7Tr1J6oKfvPe9oBfxEkscAIBPMBscEIKoHQRSNYSe89wBN4nvWJEXYLRZseD7vHsVGMXA5nEnc9n2Umy45iaFYZzjE849qg/6RxljnhNN7yk2FzmbYlZmxbTFrf41hj4ttIs8iMHNfIOEfbGiLxrgtK4SwvUTt1moN/+tec/evvYPFbd/sTSGtbR01Xqh+WsXPoIA//+Fs4+bwbUOvrfrQbNXqGRlwvGp35zg3vuWgaqs6dmw85J51V6lbtTzbdzlEm/JsqEAjKhyjrgqpB411MjgLvBH4Kj8BP6LOqsbF4yD3OxfYZfmSY+EFNQ103scPEqusm7eaZbGpohxkk5rfDGL49Rip/8nFXQ2EHGMsWA4YqO7Fj6I8bDJX2QTvx5VJsMkNjZbi9IBTj0iL26hp7/v7j7P7E56idOIW70EIvtLaMkg70bS/2ZpvTz7qeI697Oc7iQnz8dMObOYgrPlrWQtHWPf21jXtqFmqzhv0Of2KpBlHVBYJ5gijrgsogdPEIrjy/y4TDOHp3Bhan9AaPuSf7E01npa5n9RNXJle7eVYgNVS2dd62M9TvUTXbvGyc0j99hT0+/GLaxNPyVPb0MfTHnqm0j/aT9gXMVNxdF7SLu9gCS7Hzc1/inF95O/vf93dY6xveBNKg3BaBti3UZhuU4vCbXsXjP/B6dKOOtbnpEfWYxw4j53HkPCcr6WF4E0vrPNB93H20e5Smqr9vU3e+hYRrFAjmEqKsC6qIIGTjXcCfAz/ARMM4esrg/c5RzrX2JvpsJ6uup/vHMSldYLJp5jElF8hsxzzNbMJp0jiylP7EMuH0MRV2MFfZk8JIlquyG+QbKe1BOwy1lVw2orhrDa7CXWihtGb5a99kz4c/zcI993vhGZeXUFpvHcsL+BFdwF5Zo33BOTzxplezedF5WKt+WEZlGd0gDvKzU+JzNLes32U5uNRV7W2u7vZzRFUXCOYLEwuNJxAUxU03vwm8pz4u8HTg80z4s+rFIna5sX4ZZ6iddHFRUeqkwvvRrdD/apCjRnoJyiTmjG4p0nKLtauSW0vuf/QtUAXaTh5revuD4cR/FLLGktTHULoiX/lIP3FHEJ+ev8/0ekln2jSfhM9O8ihSy/rqvdtqglIs3Xkvez76WZa+eScahdtqekQ+b1jPikNbFlavh+p2OfWcZ3L0VS/BbTawNtp920sWOe+3ZZASl6O1pq5sDvdOOO88/iEb+McNt/2SRatlabyYjULWBYL5gijrgqoiCNn4ReD9wKvwvOsTUte9MI73OUc4o7YzsVQZ6no+/zgGIne8up7a7iSjw2S0PaicrX4be+YNxmJU19BTPq6PPatPSCbtySo7iX3FqeOJSjvkUNsjbYZJumWxcM8D7PnYZ1m+9XaU43rpsLWU9OCMWBb2+ga9XTs48ubXsPKMp6A226jNNq4dTCJNqZ8jNTanb23yolzdsnG3ausOO6ylX8cCjRZxTiCYU8iXV1BJ+Oq6jUfQnw98DGNTRnFo4Hn1y9mjluhNRF2PpKn4NmK3VGqucbuDMaar8CNpKvNohlswVe+VSmwrNl2Zl62Owp50huOPLavf9LoGKrpRGTBW27UGDW6zCbbFwn0PsecTN7Pja99Edbq4Cy2vrS1I0rG8xZrs9Q1Wr7mCw69/BZ0z9nurkfqLHCWethypibmROSA1ZXPKWXP+8Pjf213d++wnV7564wt3Pk052pWJpQLBnEKUdUGV4eCp6x8HPgS8hAmq6wpFlx73Okd4em05sdx46rp5G0V858n52cp25mg1sQsVmUVlSUnLEx99aDjFFk0y6qd0hT35nciKFtPPiz2+uLoGKrpRGYZ87cO1fHj8D7fV8JT0+x5izyc/z/LXvonV7uC2mujFBX+C6dayvIA3idTaaKPrNQ6/5js48cJvAw322noodnqofHwr2f2MJCS3VFM1btm4W626G+y0Fn/1+TueiqNdi0FYXIFAMGcQsi6oOgJe8Ct4ZH1iyrpGU8fmEfcEl+oz2KkW6OEyRJUKrmo6ycmmZLQbl5/fDhPeyh/OMfNMGBD2uEMpumhSWj+lEHZAx6rshraYSMUyrDGjY4kvE1suGmHHP5fuQhMFLNz7IHs+9XmWv357n6Q7iwtbalGjIfjvbW1ljY0Lz+Xw61/BxiUXeGo69Il6DhNLdomMmx0N2NicdFbdWzfusRqq9vkPPfOd733p57+ftu7KIkgCwRxDbDCCysK3woD3OdV46vq3M2F1vUOPS6yDXF+7gA5OrBUmGFS2HSUmLVp7UpNNI22XaYeJO6JomqkdJnkc2ZYb07EkjSep7lB6UUtMqK88tpi0vtP6j80f/uDGJyeMK66ccl208qO7uC6Ld9/Pnk99geVv3Inqdj0l3bK2pCc9gLYsrHYHFJy46dkce9nzcRsNLySjlRQNueikUlJJejjHxWXRavLJ1VvcT6zeYu20Fl/f1c5fanRgJxSyLhDMKSTOumAeEHxO/29kv3QE6vqD7nFO6Q1sFPnjrofK67iS0Yy4i3F8u8FO1uVb58kxXYE0u/OhMzU4BwnHkjGOicRgN+xnKF1jXN48HvsgVSe01c+M6T992XmdUH+wE9NsZFyhchpPHVcKZ2kRXbPZ8fXbOee3/4Rzf/Od7PjqbWjbwllcALbm5FHvwDz/eW11jc4Z+3n4X34vh1/7HWilUENEXcf8JSO2VBApJ8XuMvx7o6lhccpZc29Zv9uqU7v5H3/1j//SVpZCiLpAMPcQZV1QaYTU9SCU4weAVzBVdb2HwjJS16Np6ZNNC6jgIcW1+GTThK084Rz7Y5jshNO49mLTKqSwx48vTdVOV7zTVPascYzk51HatUZpjVur4Tab1NbW2XHrHez+3JdZvPfBftQXrdTWJejBqbAsrE4HpTUnbnwGR1/+Am8V1o0NtLJyXUnzqufJ9QYpLppFq8knVm9xP7l6i7XTWnp1V/f+RlR1gWBrQDzrgnnD/8Ij61NR1y/SB3N518OtZE82TfYvm7Sb5XHP7UufkH8991EUCek4Iw87QB4fe3J4R6+lvF72tHHHjjPD0w6gXI0C3EYdp16jfuIUez/9RXZ//qs0H3kCLAu32fDacD1Cv2UReNNX12mfdZDDr3kpq9dcgbXZ9oi6lf0zlHh2xiTo4ZSa51V3vrp+l91QtY99ef2Ov7l24WKlhagLBFsCoqwLKo+Quh6oRH8KvIkpqOsXWgd4eu1CA3U9biteXR8uGfQ23KZJu8MvGaVNfelT9K+ntx89F4Y+8Qkq7EN5s1bZEwpkTsxNaUO5Gm0pL/yiUrQeeZzdX/gaO79yG41jJ3DrNdxGY0suZhSHvjcdOPmcp3P0Zc/HWV7CXt/wJg9HPjepZyTH+TIh6GG4aBasJh9d+bL+7Nqtape19MKO7n1MVHWBYOtAlHXBPCG4av1P4LuAFmlREMfqyFPXH3KPc5E+0I+7Hqeu5wvlmBbULzttKCchOkyszm4aprFAOEcTRTtZzR7VkwuHdBwaVvx4CL2DaQp7uFxsf4aRYuLHOJ7K3h9b3NuXETVmpIw7sLo4Sw2sdoflb93N7s/fwo5v3oW9toHbaNBbWkRpveXtLkA/bnptdY3N887i8KtfwurVl2G121jrG7gGavp45Dw5NVoiiKt+tHfKuWXjLrup6u892jv1sZ32Uj9UoxB1gWD+Icq6YC4Qo67/GvDjQI8J3XQG6vo51h5uqF1CN26RJMB4oaT+RoZencc7rrLKZfniE7ZK8q8H5zFv+8llx1fY49LL8rHnGmOov6Qa8Wcmpr2cfvYgqotu1NG1GvWTK54f/YtfY+H+R1COg9tsom1r2yjpKIVWCntzE12rcfymGzj27c/BWWhhb2yOquljnJOy4q27uCyqpv7g6ZvVlzfu7Oy1dzxz0+3c4qKDOT5C1gWCLQBR1gXzhkDa+z94VpgDTFBdb2DzqHuSx91THLJ208UhjgJlqeCJcdbj0mK94wl9xYnsMT2bKvfjuOSLLlKUEFV+Ygp7XPmyfOxZdSDy6cmMyU7//YvmJ3vRk8p4Krq2bS9yi+uy8NBj7PrKbez82rdoHjmOtm3cZgNXNVCuuz2UdDzLi+o51Npt1i69kMOvejHrl1yAvbHp2V4CNb0AQR8n1np8qSBSj6ZJjUe6R51vbN5Xa6nG75521m+pq5rYXwSCLQZR1gVzg5C6XsNT1H8Kj7RP1Lvew2GfWua59ctxQ+ws6l/PUqCLqutxpeOV7fT+49pOVbUn5F8famXOFfahvHF87InnYnR0Sa3GKu0alA6r6HVqK2ss334Pu790K0t3P4C9sYnbaODWa9tHRe+fJ++LY61v4uxY4uiLn8OJ5z4DbdvYm+1Yb3oasoM0Fm1nNGSpRtNUdf0Xpz6p7mw/dORAbff1q87Gwy6uCioIWRcItgaErAvmCj5hDy5GC8AXgCfhKe4TiRAT2GGeVruQi6wDBgslxW2FyXJcTri34TbT2/W3Mu0wBds2JtMFCbtKIMtGZatP2I3rDSUWt8YEbQak263XcJt1VM9l4ZHH2XXLt9j59dtpPnEMALfZ8FTl7UbSCYVjdFxOX381R17+QtpnHsBe3wRXg5X8rMyg9XxjMUkN7bpoWqrOne2Hnfee+qTdUo2f6uH+koWqaXQPhKgLBFsJYoMRzCO8lbVhA/ivwPsm3Z2NxR3OY5xl7aaG3V+UZGBHmcBk01LtMCZt5w/nONJL3hCKsRNOR/uILzt9SwxAWbaYxLzQZ4mR5lKsMYHNxbJwmg2wLeonTrP7K7ex66vfZOmeBz0VvV7HWWh69dxtMmk0fAYtC+X4E0jPPsSRl7+A00+5CuU42KvrnuXFUqatFRuDaY6OK+GF1uzonvuZtVtt4OuXNM/+jfs6j9PRXbG/CARbEKKsC+YOMQsl/Q3wSqYQyvEK+0yebJ8bH8oR5tYOkz6S4bJGW8pMyU5WsUe3ksc9XYXduI0ctpjE/CxrjB7cxLj1Orpew95ss3j/I+z62rfY+c27aRw7iVZqW6vowJDlxV1ocfx5z+TYC56Ns7SItb4BI5aX8s5RLt96AkEP4E0qbfFP6990P7z6JWuntfTKnu59QKNtiasuEGxNiLIu2Ar4L8CL8WwxEw3leI9zmHOtvexSi6OhHPtlDdVtk9IZoRTH2TIJ01h4wqkGrbKV7PSQjgnjmaLCTtAfGPcJoUmfKiEvBokqu993+IGM0t5nz63bOI0GqufQeuwIu267i1233knrkSewul0v7OLigqfDb0MV3Tt3oNXA8rJy7ZUc+Y6b2Dj/LOyNNvb6emhxo/EJem7fegY5j6bXqXHCWXH+af2bdkPV/uKx7tEP7K/tsoSoCwRbF6KsC+YSMZNNfw74WSYcyrFLjzOt3Ty7dik9P5SjlxcumFddj6SFMvIp21Hf+MjIRv3zxm1DLiV+yEc/Xwp7XN5YPvbR4RdS2b2bBoVbs9GNOkprGkdPsOOO+9h1650s3fewF7mkVsNt1NFKbV8V3YdneXGwN9psnnuIIy99HqefcjVKu1jtDlpZha6CY/nWE5OzW3XRLKiG/sDpz6mvbd5z+oC962nrun2Xo10J1SgQbGGIsi6Ydzj+6/8GXgNczYQmmwaq1qPuSR50j3GBtb8/2XS0bKqmHWtbj9O084VXjPrGR1uIDedYwL+eNJqhWloZK9lVUtjj6hT1sffziqjsOkzQLZxGA1A0Tq6w/PU72HXrnSzf/QD1U6v+yqODxYsC//p2hbYUSkNtbZ3ezmWe+PbncPy5z8BZXMDe2PTLWP65Hru3Qtkm5DyMYFLpPZ1Hnds2768tquYvnHLX77KxAsFCiLpAsEUhyrpgbhGzUNLLgA8y0cgw4KBZUHWeX7+SOjX/opsWHSbLOz5IS3VHF/KNZ5dL9q8nbE06QozheJLHZKiwZ4wtdXyxYyymsg/l90m2p6C7jToKqJ9aZfneh9l1210s3/0AjROnvWgvjQZuzQY0yt2+5LyPYGGjjU10zebU057MkRff6EV52WijHCdkeclCzvOZydnHWUTJu3nUaPdPTnzYOtI7+cUX7rj+237uod/o3rTneQrQQtQFgq0LIeuCuUYMYf8D4AeYwsqmF1sHeWrtgv5kUy8vXHBWdhh/S5mVK2RzKXDjEHd0yUfMWIQ9qa/Y9JyEvUifI/lD8xh9gq4sdM3GrdcBTePkCkv3Pcyub97D8j0P0Th2EqU1bqPuE3S1PT3ocfBJutXuoByH1Ssv5uhLnsvapRegej2sTjcHSU+AIdceh5QntePismi1+OTq1/Sn176ud1vLN3V179Mu2tZo8aoLBFscYoMRbBUErOU/4U02PZsJr2x6n3uEs/RuDilvZdN0O0x82mTsMMM7WZNE+4aPCU84TbKemFtOUiwxseXLm3gKGI7RZBIpKNerqy2Frtdw6jWU49I4cZrl+x5h57fuZfneh2gcP+UR9Hodp9X0bgB1oKKLkg5+vPRuD7vTYePcMzn6ohs5fd1VaGVhr214C0JZVqmnqyxCbtKuv/gRj3aP9r64fnutpRq/espd+3RLNSSmukCwTSDKumDuEaOuvxn4EyYayhF6uOxUCzyvfgU2yqdh8VaJvHaYkXbGtMMktxqTM9YKp6ZjmT+FPXWMWf1qz4MOXhx0t16Hmo3V7dE8eoLlex9m5+33svTAozROrgIeQXfrvoK+zSeKxiE8ebRzYA/HnvdMTtxwHc6C70vXGgzV9EmR77L6tbHcd5/8mPVw9/DtFzbOfMYJZ3Vlw91UWlYqFQi2BYSsC7YEYgj7e4DvZgqx1y+zD/EU+7wSY69H0mLLTdC/nqf9LUrYc9VJ6jcg6EqhbRu3UQOlsNc3WXj8KDvvepAddz3A4iOHqa2tAwq3URtYXISgx0JbFsp1sTc26e1Y5vizr+f4c59OZ88u7M1NlOOOb3mZxLjz3BD4RV00i6rJZ9e/4X587avWLmvpJV3t/KMW+4tAsK0gNhjBVkNgh/l3wHOAM5lw7PW7nSc4ZO3iDLWLLg5xdG58O0y0nGEEl5xbuW0uiVaVlPpVt8SQPL6gDpF3OYhOo1zXI+eW5YVPrNmeveXkKksPPcbOux5k+b6HaR0+gdVueyS+XqO36C0RIBaXZAQkvba+gdNqcuy5T+fYTc9i89ABrHaH2poXL70KRL2QUh+p4qJpqBqP9I72bl6/rdZUjV8/6az944LVsDXaUSgh6gLBNoEo64Itgxh1/U3AnzJhO4yDy5JqcVP9CmrY/lJJk7PDDMqZTgiNs8MkbxVSzfPGYB96mb3CHpuXNfFUM7C2KAtdt3FrNRRgb2yycPg4y/c9wo57HmLp4Seon1r1VF+/3LZeTTQHgvNkbWyiG3VOPeVKjj3/BtbPOwur2/UmjxaMlz7WuMa9oTJYDMlCue8+9THr0e6xb17UOPNZp931lRVnXWn/QyNkXSDYHhBlXbAVEZDzdwMvBb6PCUWH0YCNzWm9wTd6D/O02oV0fHV9uGBY6c1aWTTYHG9105G0MSecmir9SWOpssIemzc0PkD71hQ0WvmhFWs1sCzsTpfmsVMsPfQ4O+59mOUHHqN59AT2ZgcshVuv4TQb/Qmi6G26mmgOBLHS7XU/DON1V3H0+c9k/aLzPK/62pr3PliKMPPNisiT2N8kn2bkjLUe2F8+sXaLerh7xN1tLf/oY71jK64W+4tAsB0hyrpgSyGkrgdX8L3A54FLmGj8dW9102fWLuY8a19/saRkdT1uK+obj0mLLVeOfz15HIYTTvOWnaHCntTfUPrQpFCFrtnoWh1tKaxuj8apVZYePcLy/Y+y/MBjLD5+lNraBrh6SD0P7C3ibDFDX0nfbKNti5WrLuHoTc9k7dILQGvszTZaqdj3dOYoIda6t/hRg/u7j/f+8uQnazVl/1xH9/5bQ9k1LYsfCQTbEhX8tRMIxkOMHeZFwIeZkHcdv1HX97DfVL+SRdXEwc0g7BlE2dQOE2p3uFzClqEdJk/7hctOk7DH1olOCPXJlGWhbW+yZ5+cn15l8bFj7HjwMZYfeIyFx49RX1nDclxc28Kt19C2hUwOLYYoSV+98hKOPu8ZrF56gTcxd7PtUV1rxpctg7e1qErvorGx6Oie866TH7FPOaufesvel73gV478hbu/tguxvwgE2xNC1gWl4LY33BDeDdTroef8V7/n5qmNJ0TYg6W4fw74WSa8WFKXHmdYu/i22qW4cSubAibRYfr/l+5f97e2PGHPGFtINUdZYFkeMbe9qQ1Wp0Pz5CqLjx9j+cHHWX7ocRaeOE59ZR3LcdC2V9617SFriyA/gomj1mYbXa+xcuXFHH3u01m79EK0Anuz7RHkCkwcHRn7WKuSxrfXVHX9gdOfU99s339yn73rho7u3t7VjqXRLghRFwi2I4SsC0pFhLQrPHU7CG8xNfIescMErx8Bns+Ewzm26XK1fTbX2OfSplfADhO0FE0cL5zjYC/fhNPhIRj2kVv1HoOwZ/WnA8+5v2S7b2nxbCreKqD19TatY6dZfOwoyw8/wdIjh2kdPUl9bQPlK+faJ/M6IPuItWUc9EMwbrZxG3VOX30px57zNFYvPg+UwuqTdPPLVFG/en9ME3xDdUaOi8uiavGljTucD69+2V6yWt/vaPedgCx+JBBscwhZF5SCEElv4YVMvAu4n4F3HAbkHTziPhKjrkwCHyLslt/fRcDNwEEmaIkBL0LMs2uXcpa128C/buIbNylNJplOJsdJLUdy85DwCRD2uPQRxRyGibntKeDa9mwWdrtL8/QqC0dO+uT8MAtPHKd5cgV7s+OtGFqzPUJvWaF2hZyPDaXQSnkTRDfbOIsLnLrmco7deD1rF5zj2WDandwkvUrQBXJdf5XSx3rHen9+8hM1DW9fcdZ+ZIe9aNdVzel5c0qFrAsE2xTz+WsoqBx8sh4Q8+cDb/W3/xpvguctwMOMXq0shm0zpRL4GDvMa4D3MtHJpuCgaVLjpsYVLOD510eWS5qEHcZvN7vV0NY8EnatQuRZo1SImNfsvv/Z7nRprKx7qvnjx1h67CiLjx+jdfw0tfVNrJ7jLUdfs/v+dPGcTwA+Sbe6PaxOh+7OZU5edyXHb7iO9XMO+TaYrve+q6SbtGrA/FNhVlL3feqO8+6TH7WPO6e/fEnz7OfuspbWb928T8I0CgSCyvz+CbYIbnvDDQFhPwi8C29ypwY2gDuBL+KR96/4+2sxzWQSeDAj8SGyDgPC/ovAzzAF//oBtZMb65cNPVoYFCpuhxlpKyeZjiPHJkQ6z+TO4hNBQ2PyT1zfXx6o5ZYFvlqulWdlqW12aayu0zp2isXDx1l6/DgLh4/TOr5CfW0Dq9sDhaey+4ReK+/jqjRCzicA7avjdruL6vVo79/Diaddw4lnXMPmGftQPQe73UmJ7lL1S9R4n5ngh62havr9pz+r7mg/dGqvvePGrna+0dU98akLBAKg+r+EgjlBygTTfwX8ErDI6KKdjwPfwCPuXwFuBe4DNmO6UH67wc1A+G8IURIf418H+Afg25kwYW/T5TL7ENfZ5xcM5xi0FE00968PqhmQ45jcaP2JEHbfvqL0IN1Tyi3/bzCR0+r0qK9v0jy9xsLRUywePsHC4RMsHDtF89RqXzFHKc9rHiL1Qsyng3BkF4CNs8/g+DOv5eR1V9LZvRO708XqdksOwVhWO5P5bMS16mqXRavJZ9e/4Xx67VZ72Vp4s6OdP9XiUxcIBCEIWReUhhjCbuGR4auBdwDPBLp4JL7B6OfPAR4Bbscj7l8DbsPzvh8PCl39npujfdkM3wSMEPkf/OmLaHVclO7718/E86+fz4Tjr3fo8dTaBVxincEmPewYOwykEWpT/3rQ43C7cW0Np/lbKRNOk8diSNi1Z1UB+u+KUngWFOUTcsvyJnz6SrnVcTxSvrJO68QKC8dOsXjkJK1jp2ieXKW+toHd6aJcHSL2w4o5GvGaTwthP3q7g1uvsXrxeRx75rWcvuoSnKUWVrvTtx6lR/KZX2R+1HQwoVSzoBrc2Xm49/7Tn6vVVe3/burOf2yqem1Td3ot1QCErAsEgq3z+yioCCIkGgaxzm3gp4D/hjcJtefnB0p5ePJpFMfxCPsdeEr87cA9wEPACb9+X1FPIvJawdKGq3/nlQetj16/s7u84d6oFR8F6qGxTAQazY31yzigdtLFqYx/faRGkQgx4VQ9XE4rBZantHqxy60+UVOui911qG12PFJ+as0j5cdP0zq+QuvECs3Ta9TWN7E7PW/Fz0AtD9ryPeaimM8OgdXF6vSwul16O5Y59aRLOP70J7N20Tm4to292Ua5brySbqisV+liZfwp0+kTSo86p3rvOfXxWlf3/uGTl/3xy555+xvVstXSrvjUBQJBCFX6/RNsIcSo7N68S7gC+A0GXnaXZHtL2PoSh+PAg8C9wN14EWju9dMOA6eDgn1rjH4rWv0bnvv577HrvZ6DUj8M/A5au6A8dX1YAPai/41xLhQKB5emqvG82hUsqSa96IRTQztM//9JEvb+lh6ka0ba9IgXHgn3VXHtx8JWCpQLynGxO11qGx0aaxs0V9ZpnvaU8tbJVVonV2msblBf38Rudz37itYhC4s1UMpFLa8OAhXddbHaHZSGjUP7OXH9lZy47irPj+5q7HbHez+Lxkiv4iqlUeS8QfQmlNp0dNd9z6mPW8ec03cfrO15dk/3jqy6m+JTFwgEI5iDX0LBvCIm5rqFR9gB3gj8H+BcBpNIk4h5NE57mgoPnmp/DM8T/yDwgP/6IJ7N5jGtOPE337Zv9XNXtTqPHmj9j7qj/6vfvqU0WK7G0mBpUP72kHLcv0BHVcLBgIeSlaKre+yxlnhO/XIsLDR62Hk+jn99qMPBYkzDYQ0TWg03GJBwy/OME2z79zHan/RpOa53jro96ptdau0OjbVN6mu+beXUGo2VdZorGwMyvtnB7jkox+0Tcm1buD7Rx7LQavgwhJRXC8FNUxDVxWk1Wb34XI4/7UmcvvIiestLWBl+9HFjoceibFI/oSc0QRx3W1n6r09/Vt3beWxlj718U087X+lqx9Z4MRqFqAsEgjCErAsmjhSVfQfwH4GfBJYYkHbTBYvi/OnhSDJJ6AEnNZywNI9pxROffvKO7zyxo9Y6vWizsmix1rJZa1lsNizaDUW7btGzFa4C11K41uhIggmSyieZwTZ+ugV0dI9zrb08q3YxbhB2MNyOSl76Z4Sw+57voB6oAScPSHeQFpDuKNnX3qRN5frk2/GsKXa3h93tUdvs0NhoU1vv0FhvU1/fpLG6SWNtk8b6JrWNNvXNDrVNTxXvK+P+c5Gw4q6tkBofOW9iX6kwwip6p4tyXdr7dnPymks5cf3VrJ97CG3b2O0OynEKTxqdCImfEZIWV/JWKG3oD69+Sd+yeY+1w1r4bgf3L1yt+xNKQci6QCAYxtb5dRRUGgle9kAtPw/478D34kVmyUvao9Ch1zCRT7TVLLbdPsF0LOjZip7tkfRNn6xvNC3Wm/5ry3vdbHivGw2Ldl3RqSs6Nct/9dpwLUXPBsfyCPOG6nFJ7Uyurp9LT3mqe39EaqCHD+vs3iGogNy6YGntEW3tepYTV2O5LpbrevaTnovVdbB7zjABb/eodbrU2l1qm/5r21PHa5td7E4Pu9PF7vawei6W46IcZ/iEBXHNVSiUYvjmIfROBJYaUcjnC30vereH1enitJqsXXA2x6+/ktNXXUxn9w4v9GKnG1rEaDKXlKoR+SIrnbpoFlWTz23c1vv02q21Rav1Mz3d+98KVXPRvcAWJ0RdIBBEUa1fQMGWR4I1JiDn1+BNQP2uULrLcLSXMhAl87hW6MbAt7+A92q5nkpuaXxyTMR24o0uUN2dQH0P9m3oWQrHVjiWR2i7lmbRbqGU5UdECWwnIa09ePEnTir/D9+a4yniA1VcuS7K0X2y3s/3lXPl6sEKn0MnQ/WJdmB90SFP+ogaHjpPQsS3GIYiuniLFG0e2Mupqy/hxFOuYP3cQ7g127O69HqpKnrVCPYsERD1r7fv7X1o5Yu1hqr/9oq7/q8WrZZdw3Jc/wskRF0gEMRBfk0FM0GCNSYg7U8F/gvwSgYKfBBRZqqfWc9SEtru7w8r3sFmNCKKCtk8wnHEFV6M5WgTyax3+LAH3u4BkdZqsK8Jq/WR/cQDDfckBHzbIGpzcVx6OxZZufg8jj/lclYuPZ/uzmXP5tTporTuTyTO+23cjgTexWVBNbmn82jv/Sufq1lYH/yOHc945V+e+pRethaQFUoFAkEWtt8vp6AySLDGwIC0PwX4D8DrgCYD20ygyM8Fhkl+GON//QYt6EhnAkEKAoKuvUnCqtvDbdZZO+cQJ6+5lFNXX8zmwb1oZSV60WOJd8GP9FYl8Q4uLdXg0d7R3vtOfabm4H5pv73zBYtWa+WR7lGJ/CIQCIywNX8hBXMFA9J+MfBjeJ72vZG8tNCOAoEgQGBt0hqr18Pq9NA1m40z9nHqyos4+aRLWD/nEG6z7vnUuz3vAYuV/fVKJNslfDOrSuSzfOuhWOrOe0992t50O/futBefp9EPb7gdIeoCgcAY1fwVFGxLGJD2/XiE/UeAy/28wCJjEgVGINheGCLojhdS0bJo79vN6cvO5+STLmH1grPoLS2gHAerv/iUNVY4xEyCPcUrT9pYikwUNYFH1GucdNbc957+tLXirB/ZYS8+39XubR3d64doBCHrAoEgG0LWBZVDDGkPh3sEb8XRFwP/Evh2PIsMTG5CqkAwP4gh6CiL9r5dnL74XE5efTGrF55Nd+eSF0HID8c46cmiRm1sgW+tqzUNVWPV3XDfe/rT1glnZXWHtfjtLu7NXe1IiEaBQJAbW+CnUbCVERM9xsYj7YEkdhGe2v5m4NJQ2YDYi01GsPUR8qAr38KibY+gr1x0LievvIjVC8+ms2sZtMbudP1wnMoPuThox6i7Er9Sudqa9Tc5Q4h30dSVzbrbdv9q5TPqaO9Ud9laeKWL/lBPiLpAICiIWf/0CQRGSAj5GF7VtAE8F4+4vxzYRz9yuhB3wdaD9uOaK9f1POY9B7dus7l/D6cvOZeTl1/A6vln0t25DIDd6WL13FDdYcR+MQzI+6Q95VX1rMOwjcbFU9TX3U391yuf5UjvlF6yWq/X8D4h6gKBYBxU91dQIIhBgkXGYlht3wN8B/BG4PnAMsPEPVhwST7/gvlBf1Va7S1W1e2iXE1vocnGGXs5fcl5nLrsfNbOOUhvadGzwXTjCXoWAS5K3E3bn8rpMhxDGb71YaL+OX2kd9JatFrfA/pdPe3WXNxeMB4h6gKBIC9m/4sq+P+3d94BrlzV/f/cmZG2vN783AtggwEDNh0cML0kPyCEZtozBAKB0MGUhEAowaTQWwjELHFwaAkl9GaKscFgsI2NC7jXZ/u1fVs1M/f3x5kjXc3OaCWtpNWu7xdkvZVGM7ee+73nnuLRJUq07SCEXFgNHIQQ96cBf0IzcVcbd++c6jF8qGeEzbTncYKpxRAY5tevYeqQ7ew7+jD23elQZg7cQjJalaRYtZggM3FZUiSXRjFKPuxs+RgGAt8PKFHfn87Yr07+3N4W7w3Gg9EXWuzpiU0jA7FPeuTh4bEUrE7p6XGHQoG2XW3blYwrcT8QcUx9EvBwYJvzG40qo6Tfzw2PgUOdPI21Ep2lFmNSSzJSZXbrRiaPPIi9dzmMqcMOYm7TOskmGut1mZNoRtC7Icft/GapWvdunjms0PCMe5Mp+9XJn9tdyb5gPBh9MdhPxTaNgNh6ou7h4bFErFwp6eFRgA6I+wbgocATgUcBx9CsXXev9+Tdoy+oR2CxliBJCeIYk6SkUcj8hrVMHbKNfUcdwuRRBzNzwBbi8VHAEtQS0bRb65jHOFjwZ3+Ie8GjnC8GFEFmmZCSMmKq3J7stV+bPNfuTaaC8aD6YjCfim0SgY3VwMYTdQ8Pj6VgeCWhh8cS0YK4qxZdEQF3Bx4JPBp4IBLT3YUn7x5LgzFYNR/JkXMbBsyvHWfmwC1MHnEQ+448iOmDt1Fbv5Y0DER7HseYROifNdTJcKcxzftJ3Aset6AN+t7MXU7NTmzXU1LGzAg3xren/zf5C6bT2WAsqL4AzGe8M6mHh0ev4QmHxx0CJcRdSXec+24DcD/EVObhwL2zz1y4hF/v4+eTRwMOOTc2xcSZ3XmakoYBtXXjzBywmf2HbWfy8AOZOnibmLZUoizCSyK251bu1ZPILD0g7t38btGrB0Die4UUy5ipcnXt5vSbk+eZmo3tSFB5nsF8zhN1Dw+PfmDlSEgPjx6hhLgreVcNuoutwAnAicBDgHvRbO+uSNKAEJvdsD/JET2GETmted0hNEkx1pJUK9TWjzOt5PzQ7UwfuIX5DWtJqhEmtYRxjIkTGTfGlIRX7FEcdNPFb5byvPaL0bKNlxcWa2EsqHLJ3LXp96fODyzMV030TIP5iifqHh4e/cJySz8Pj2XHIlr3IvK+HrgncH/EZOZ4C0cZGFk7kyRJYII4MiYODElARjJsnbx7Er/CkSfmWaZQkySY1GLDgHhshNlN65k+cDP7Dz2A/QdvY3bbRmprx0mjUDKHxgkmTjFWrKusAbPA9nzpGUUHTdx78fuSYi0bLBaDoWoq/Hr28uSn0xeHkQn3V0z4VAPfi23qibqHh0ffMEzy0MNjKNAJed+6N+aHx6+vPOOs27d9+KkHvmF6JHj1nW+cTQ7cVQs2TSZmfC4hTMTGOAkMSSjvad3m2JP4oUaRxjxJG8Q8CEhGq8ytX8PMto1MHbSVqYO2Mr19E3Mb15GMjmADg3Hs040V4ifOpdm9ix6dK0dpEXtJ3AuKs2zZSru6/9JgCz+zhAQEJuBn079Lzp+9IhwxlZ2BCZ5kML9IPFH38PDoMzxZ9/BYBIuQd/vvTzowuW00MXEU2IuOWf+G9VPJP43PJcmmycQcuKsWHHzbPIfcNs+Bu2ps3hezdiZhpGYJLKQtSLya04An8n1FRpitIw2NBZOmmDghSFKwDY353Ia1zGzdwNT2zUwfuIXpbRuZ37CO2vgoNgxEa55k0VrSrOOChRFbWv1V+k2PSHvb1/dB696Lsg8KGkN93sZ8f+r8+Ir5G6IxU/0jmD81hstSm0bW8XnxRN3Dw6MfGE4J6eExxHDJexwaRudS9q2Ngu+fsC742omb4zUzyfNrkfl0HJgwDk2aBoSBhdH5lHXTKZv3xWzfXePA3fNs31Vj256Yjftj1s6kjNRSwsxt1QYZkQ8gzYh8XcubI/NN//ZYCGNEa1pvpIYJi0lFY26SFJOmYAxpFNaJ+fQ2l5hvYn79GuLRqhBza+uE3qSNU5LmaC3N5VhQtDY+aec+zdf2KWHRgMj7cjwjjxTLqKmwK5nkO1O/jm+Jd0WjZuQ8i31SgLk5QeKo6/WeqHt4ePQLfn338FgiTjrnZPfPyFhiJPnSFw1swNoEY0JXix4HYgIRpDBSS1kzk7JhKmHr3hrb9sZs3ROzdW+NTZMx66dT1swmVGuWKBGNvM2Ie2IMaY7MCynN0Rs1tdE/VoOmXjXiTX8319lYm5mvZIQ8tfXPbBCQVoSUz68dY3bjOma2rGdm60Zmtm5gdtM65tetIRmpNGvMM2KOlUS4LjGXYixCtk2bWvR2SPui9+tjmEbTg3sMKSyWMTPCVbWb7fenzk+m0rlo1FS+XiM5OcRMWQkBWw//6om6h4dHP7GyJaqHx5AgT9gRjdtxwFeAO2V/R8326ZLQpk7iM026zVIzhYllpGYZn0tZO52wcX/Cpv0xmyZjNu9L2DgVs34qYe10yvh8yuhcSpRYotSSpAkpahtNPbOlNQ1b6fq7ioHFpEELgt+JILHd3kRPD5SA58m4TeXmwqGFjIcBSbVCPFaltmaU+XXjzG1Yw8zGdcxtXMvcxrXMr1tDbc0ocbWCjUKJgZ4Rc9G2N8qnxLy9TJ+L6MyXSNo7uV9ZedpBR79b4QTeYgkIqJiQ38z+MT175mJrIKwQffT82SteccLo0SRirFb3W/FE3cPDo98Yfunp4bFCUELYtwNfQsI+xohGbqFy1NV8Oxpba0RrrkQ+1SCTFsLUUokbhH58NmXtdMyWGcN95rawYTrFTE0zMjNPZbZGZWaeaK5GGCeENUlRH6SO1tnaOtF1YTH1z+p21wV23o3KFKi4cwy9vlmpb17UfsQu+KkhOzEIAmwgIQ3TKCKpRiSViGSkQm1shHh8hNr4KPNrx5hfO878WiHn+l0yUiWpRtggaM4aqiYwSvSz+kkERbcuCzc1Q0naF7lnu+Xu2e8WDUYzHMuQ2qfXbMJPpy9Kfjd3tRkxlSAgeF1kwvfVbBxK8EZP1D08PAaL4ZCSHh6rBDnCrkflFeCTwCkIYQ+yV1sQAt94VyiZ10gzqQEbGGJj2Ris4X7RUWwL1jOf1giTlDBJCeKUqJYQzseEtZhoPqYyWyOarxHOy99R9p1ckxH7JCHMQg0quQ00sokSfpuxXVtQA0e7nwYmI96i+bZhQBoFpGFIWgkbRLxaIalGxCMVkpEKSbVKPFohHqmSVoWkxyNV0iiU+0Rhg6QaA065TJrKxsRat1Xrm41CUl76SeekfVHTmPoH7Vy32LPau2e7Ze/XbztT2Pd3qbJYRk2VW5O9/GDqN/FN8a5ozFQnLTwnwHw9xUYWm+CMbk/UPTw8BgVP1j08eowcYdeoMQlwKvBeZMFPETLfE7iaeWOhRkJIwHHRYdwlOpDYpKRYAhPUTWFsYJrIrTVB/R76j/pGwXXGtIjpiftd/Ze2+ZQA1cw3tPOajdPimOZoWeqJgJqYcOOZ2X4gsA3bc/3MNDndZkcEdcfSTp09FyPNhuJ/dk+M29G2t+uMWvptH4l7L+8xiJXJYEhJCQiomohL56+zP5m+KJlLa1HVVC5PSZ9qMBdbrHck9fDwWFZ4su7h0QfkCLtBiHkM/ClwBrAx+zvqx/MNBoulRsKRwVbuHR3BiKlQIyawCwlVc2hI00TY5d0h0c2ssvFf45Bj96fu5bboMymtmve0IszGcSo1mILyUfDrFt8tGp2lg+8HSNrbKeei37aREbRXGu2+m7p0cfvUZmYvJJwzc0l60exVaWTCKCT4RkzyXIPZYzCeqHt4eCw7PFn38OgTcoQdGnbsdwG+ABxPCzv2XsBgmCdmgxnjhOhItocbmbcxou8Octc2/2sBYc9/XnZ9jtCXkcpWpiVtEe0F5eyMeHcWUrFz0t6tPXu75Wu3ZG192wZxb7dOnWLQNus22zGOmio3x7s5a+bC5OZ4lxk11QB494PG7/Z3v5y+zCSkAT7ii4eHxxDAk3UPjz6jxI59DPgYYseeIHOxbTv2TmAwxCQYDMdGB3O38GAMhoSkf4TdtEfRC7/rgrC3enb79+r8tws/7c4JtdV1nZiyDJK4d1K3paCXz0ixVAgxxnDh3FWcO/P7OLZJVDXRnhT7AoP5Smb20pSp2BN1Dw+P5YQn6x4eA0ALO/aXAB8ERhiAWcy8jdkebuD46Eg2BWuo2bhhUlK/tvlfvSLsRfcu/dx08ptOn92q9N39trScy0TaF6lhB79Z/DntlH05kVlXYYFRU2FPup+fTV+c/rF2U1o1lSjEnJeQngzmj0bmn3ck9fDwGCoMn2T18FilaGHHfgLwOeCuDMAspkZMhYh7RIdyl3A7BohJ+0PYoW0teyuy25VZTMGz27/XYr9t4/d9Iu2FTx4UcW/jWZ3Wpd9IsUSEhCbg9/PXcu7MpclUOmtGTSWw8JGajV8bk9RGTdUnOvLw8BhKeLLu4TFAtLBjXwt8BNiBHL9behgtxoVEwbDEJBwUbOTe0eFsCtYwn9Oyd0/Yi37TS7OY9v7ql5a9o9/n/1pm0t5Oadv/XfvP7KZuS4Vrm74n3c/PZ35v/zB/YxKZMIoIdqXYvwK+jMwzHz/dw8NjaOHJuofHMqDAjl3JwvMQ0r6eAWnZq0QcGx3C0eF2AgJqmX07tEPYC74r/c3SCXunv+unln2x3y/8tNTrdsUR90WvXAKB76Zd8tAERwCXzF3LL2cvS6fSWTtiKiHwo5T0FODaLNqLN3vx8PAYaniy7uGxTGhhFnNn4D+Ah9E4lu+zlj3mgGADx0WHcUCwnppNSR3TmKGwY3f+2R/n08Xu193vF72mx9r2wlJ0RdzLP+3sHu2XYamw2Hrc9J3JHs6dudReU7sliUwURQS1FPu2xKanVUxE6qO9eHh4rBB4su7hsYwoMItRu1kDvBH4B6DKQLTsCSGGO4fbOTY6mFGqzGdKR1Ng0T4Iwl74XRtmMUW/66k9+pCQ9nau7Ya4t1uD7u/TXZnKoCYvI6bCrK1xwdyVXDh7ZTpvY1s1lRDsRRZeYOHXxpu9eHh4rDB4su7hMQRoES3mPsCnESfUvmvZNWLM+mCMu0eHckSwFQN105ilEvbmSwdvFtPq+e3cr7Pft3GPok/6RNoLn7sk4t76m+7vWfaDhb+QKC+WahaO8cr5mzlv9nJ7a7I3GTGVyGBSi/1X4K0WO+fNXjw8PFYiPFn38BgStDCLqQBvyV4D0bInpCSkHBhs5B7RoWwz6+qfBfXH9tPxtM2/utSytypDO/db7Pft3qPldV3atbd7beEVHYVp7PybTtHqThLlJaCSmbz8avYKrqzdnAQEVEwYptiLgb+y8HPT2OB6sxcPD48VB0/WPTyGDAXOpyAk497AJ4AH0feIMfLfGjEhAUeG27hreDDrgzFqNiGtk/bWhL35X/m765+9MYtp/3cFZVi0HG3cs1+kfUEdO7Uj7z9xb12z9q9oB2KXbqiaCpPpNBfMXcXv56+1czZOMwfSmsX+M/BOYBYfO93Dw2OFw5N1D48hRIGWXZ3hAuCVwDuAdQwg+6nFUiNhlApHRwdy53A7o1SJibFYNAtqQYAYCklx2edLMYtx/tlrLXtn9+z+Hm3dfQna9k6u7wV5X7ym7V8BZGPNUDURc7bG7+ev48K5q9iXTicjpmIMJrDYc4G/Bn6L16Z7eHisEniy7uExxGihZT8SeD/wFBrOcmrr3nNI1JiUGgnrzRjHhAdxRLiNEUJqJMXx2Xtqx97mX33Usi92z87v0cG9ij5ZInHv5DelVy0pxnp7aJD0CjWb8MfajVwwdxW3JnuTiomICMIUuwd4q8F8zGJTZK7o6RPgibqHh8fKhSfrHh5DjhItuxKRJwHvQ8I99tU0Rh7esGffZNZwTHQghwVbqORIey/t2Jt/N0At+6JlWaxG5ffo5F6LlbzoZ/0k7q1LypIIvAtXk57YhKvjnVwwdxU3x7vT0AS2QhhaiQPzOeANwI14bbqHh8cqhCfrHh4rBC0ixowjZOXU7N99jhoj/41JSLFsMWs5OjqQQ4PNVIgy0m4bjqjd2LHDsmrZFyvLYiVo9x6d3Kud0vdC297tb3tF4NO6TXpEbBOuiXdy0dzV3BTvsgaTVkxkgMBifwu8BjiLhZtYwBN1Dw+P1QFP1j08VhBK4rKrGcxRwHuBp2ff9dmeXf7rkva7RNs5NNhMlQoxqeOIygLS3o1ZTMlVrb/rWMveflnaue+CT9sm7eX3a+vaHhL3bn/f1i+MASxiu2KomIiaTbg6voWL567hpng3BhKHpN8KvB34JI3ISD5uuoeHx6qFJ+seHisQi5jGPAz4J+CBNEjMwEj7JjPOncLtHBZuYdyMEGfRYwBMnaj2yiymzb9Me1eXfd8rB9IFn/ZA295OLXplKtOr3+svMzOWegjGGTvPVbWbuaR2HTvjPRiMS9LngI8B7wZup/l0qQ5P1D08PFYbPFn38FjBaGEaEwDPRKLG3IWBOKHKf5W0rzOjHBFu44hgG+vNKBZLTArGZkSvQx1511p25682TWPKvu9b1Jceadvbur4PxL3T+2jG0QoRgQmYTKf5Y+0mLqvdwK5kkqCZpKfAl4C/A66gMYa9yYuHh8cdAp6se3iscCxiGjMGvBh4M3Bg9nlCX5MqyX8TUmKbMGaqHBJu5qhwG1vNOgIMsRFC77qj9kPL3vxJ56YxZb9fmaS95NM+knf3fqpFV3v0FMttyT4ur93AVbWbmUxniEyYROJqEWaE/vsISf8FjdMhb/Li4eFxh4In6x4eqwSLkPaNwN8Arwa20CDtAX0yj4FGyMeYlIiAbcF6jgy3cVCwkTFTFUKvJjKlFLE9U5TeaNk7+H0bZWrnbqWf9pC4t/0bU/bb7pcK1aJHhEQmZNbOc0N8O1fUbuSG+HbmbY2KiZKQwFhskKnKfw68DSHr4O3SPTw87sDwZN3DY5VhEXv2rUhSpZcDmxmATbsUwmRmMBLecb0Z49BgM4eFW9gUrCEwhtjaum17sEA0dWoWs/CvkrsMHWlv937d3Lf1Fb0j70rQAwIqJiTFsjvZz1XxzVxVu4VdyX7AUjFRYjDGYnXsnYtkHv0WZIp4b5fu4eFxB4cn6x4eqxSLkPZtwMuy1wE0ay37GqcdyDTqCVUitgbrODzcwoHBRtYEo1hLZvWeNv2mUY0+aNlL/9mZiUvfQzUOjLi3+KbFLdXMpWJCDIapdJYbktu5snYLN8W7mLXzRCa0EWGC2KMrST8bcRz9Np6ke3h4eDTBk3UPj1WORUj7JuAvgVcAh2ef6auPpF3+W9e2WxgPqhwYbOTQcDNbg/WMmipYS4Latytx77WWPfdXV/bszX/1mrR3cs92a9z+78q/UQ26MYaIkMAYZm2Nnckerqnt5Pr4dibTaQAqJrIBJrHY0DYcRL+HRC76YXZLT9I9PDw8cvBk3cPjDoIC0h4ipMgCa4BnITbt98yu6bszqhREbp2SEtsUYwzrzCgHBhs5ONzElmAto6YClnrs9sYvTQda9oV/lX7fgWlMq2va1YwvKb56V8S99TPKrrLOfwMCokyDPmtr3Jbs47r4Vq5PbmdPup/UWiITEhIk8iurRHwW+F8k8+6vslt7ku7h4eFRAk/WPTzuYFiEtEfA4xDS/ggWpm/vm7ZdCtMwk0lsQmAC1ppRDgg2cFC4ka3BOsaoYgyk1jo6d8dBdVFC3MH3Aybt7T6nm/t2UnIX1jnVCAkIjViuzNg5bk32cX18Ozclu9iTTpHYlNAERIQWSDKCrqYutwITwCeAP2YP1Zcn6R4eHh4l8GTdw+MOikVIO8B9gL8GnoFEkwExXUjpu7Zd/2tJsCQ2wRjDGjPClmAdBwYb2BqsZ60ZFQdGS6ZzVwsek/HWVtR3qfbsxffo6Kn9DNXYBnEv+p11/i3a8wCDIbYpk3aGnckebox3sTPZw2Q6Q4rNCHoAmBRsamXTp7gQIehnAntodmb2JN3Dw8NjEXiy7uFxB8ciIR9BnFFPRmzb7+Vcp0Srb4mWwCXuqnGXYo2YiPXBONuCdWwL1rPJrGHMjBCaAJtFlkmx2IZhe72Qy0Pamz/pZ8SXdom7dai5wRBgCE1AgCHFMp3OsTvdzy3JHm5O9rA72c+snZcjGDFxkdtgE9scBnQK+Abwb8CPkbGiG0Ld8NXhSbqHh4dHOTxZ9/DwAEpJOzSbwDwUeCHwZBra9oHEbFco5daMqKlNCUzAmKmw0axhS7COLcFaNphxxk2VyITZzsPWX9RNO8op/MJPuiftra7rd3z1BhyduRFiHjhmLYlNmbZz7EmnuC3Zx63JXnal+5m2cyQ2dYh8E0FXAq74HfBZRIt+vVPI/KmNJ+geHh4ebcKTdQ8PjyYUkPYisrUV+HPgucBDaJg9LAtxBzGDSUhJrZhljFBhXTDKJrOWzcEaNgTjrDGjjJiKaN+hroG3TTrmhXcfBGlf8FfH2nYK6tDQmAcEBEbqlNqUOWL2p7PssVPcnkyyK51kbzrNjJ0nsanYqJtAtecA1mLd8J42K8ZO4GsISf85C/0bvKmLh4eHxxLgybqHh0cp2tC2A9wNeHr2uicNuTJQ4g4uvRYNeoIlzSLMRISMmQrrzBgbgnE2BOOsM2OsMSOMmAqVLPQggLUNTXyDyDe08dT/1YgeszAafPFf5Z+W/8q2kNTqWFsn5abxicUS24RZW2PKzrEvnWZPOsWedIp96TTTdo6ajevx0dUERp9usWXx9/cDP0A06N8G9jrF9qYuHh4eHj2EJ+seHh6LooW23SVlIXAC8DTgScBdWUjc1blwILLH1bzbuhmMaN8NEJqQqokYN1XWmFHWmlHWmVHWBCOMmRFGqFA1EWFdK+3czzZIfD04vcnrthuxasrLWFRiU/9LGiyj3yaj5bqpQLTkCSk1GzNna0zbOabsHJPpDJN2hv3pLNN2jjlbI7aJut8SGtG259vI6dO8icsU8DPgi4g9+s2oF7DXont4eHj0DZ6se3h4dIQC4q6ac9dMJgLui5D2JwLH0Uz89Fol7gOTRXlyWifxVv5tgCCLblI1EVVTYYwqo6bCmKkyauTfVRMxQkTFRESEdXvukABj3PRNEpmmIPdqVoam/2TEX8JSplgSmxJnZLxmY+aoMWtrzNgaM3aOGTvPrJ1nztaYszExSd0JV+sS1GPSN0dNt40iaJIsjfKjJi57gJ8AXwW+A9xAM0HXsItNuxRP0j08PDx6B0/WPTw8ukaJmUyewAXAsUj89icCDwDW5X4XO9cOxGTGxUIibetOqfX/ZZp0vTbINNMBhkhii9fjkIcZaVcC3zBPaX6OdTYJSs5jK9b3caYxj7OY80n9VCBtYsbGMX0JMIWbgpxFvkvOi9r7KuBHiPb8x8DtNAh60cYM8ATdw8PDo1/wZN3Dw2PJKDGTcbNSusRuO3Ai8BjgYcAxNGvd1WQGlkHzXlSRMndO6/zLOp/U3xdw5DLDGOcp2X/UDr1hENOqLAsIef7Brcj5XuDXiA36D4DfAnPO9/obb4fu4eHhsQzwZN3Dw6OnKCDuUE74IoSsnwichGjdj2IhoXTtqN3XUKEVme4czeS+gx+lzs+KklftBy4CzgbOAn6JZBd14U1cPDw8PIYEQ7fYeXh4rC60cE6FhvmLooqQ9wcgISHvBxwNjBfc2iX+Q03i+wCbe7Vy3L0FIefnAucA5yPOoS50M5Un+4An6B4eHh7LiTvCoubh4TEkKCHuSjRd8xf3+4MRB9UTEKfVewBHAKMlj8lr71cikbfOu6XZeqaMlFvEvvwK4ELgV8BvgMsQbboL3TB5cu7h4eEx5FgpC5eHh8cqxCLkHQrMMBCSeTCigb8nQt7vhpjPbAcqizx2ge01DVlYlAdpqXKyLJ6jLfiu3dCW+5DILH8ALkEyh14CXIlEcMmjpeYcPEH38PDwGFZ4su7h4TE0aGHvriS+SPuuGAUOQbTudwbughD4w4GDgM3A2i6LZnPv+c+LZKlp8d1iiBHHz1uB64FrgD9mryuB67Lv0oLfumZGSsw9Offw8PBYofBk3cPDY6jRQvvumrU0aeDPevCZ+d+NAFuArcCBCHnfnv37gOy7jcAGJKzkaPYaYXFN/WJIgXkkwsosMI0Q8b3AbuA2xK785uz9RoSI35pdUyfkBfVyHUg9Mffw8PBYhfBk3cPDY8WhRANfROIXmH0UEVfnfgYh6GOIU6tL2keyf0cIgXfDIOpzEqCWvZSc6/sMQtRncBxrFykPLAy36NbHE3MPDw+PVQ5P1j08PFYNSkg8NBP4IkfTtkh9j8tXZJ9eZM9eGL3Rk3IPDw+POwY8Wffw8LhDoQWhh9aOpd3IS9vGvxfAE3EPDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PD4/FYJa7AIPGSeec3NZ1Zz34zOUuqoeHh8cdEt3I6WGW7cNcNg8Pj+GHKRAiIcNL4q3zbp2/gdaCrkU9U20L5++0nXt6rD7kxokBguxdx1vqXrDaxkfBPNH632HawGP50IacDrL3uOQWJvuNuz7obxLns4GM2xb10fINzbpTsqEwuVensEi7L1u9PDxWA0wBORmoMOsUufK6grwlgXB+5wrH+rWLfe+x+lEwtpKCy3ThX3XjI1d/JelFbRBm9R9qWeGx8lC2HuVkdNN3uc9wf5O7Z+H3A6xPQPm6U/j9gMunZQhYIsleabzCw2PYkSfrEfCnwL2Wu2AOasAssBe4DdgJ3JC9zzvXhdl7oYApqOf/Ax4PHARUsvtfAHwOuIbcQuGxulGyaB4I3A/YDEwBFwGXswo3dAX1V83fkcC9gQ3AJDJHrsQvwB59gjMWA+DpwBOAbciYuxX4NvB5mhU0Oh4PAJ5NY96mwC3AWcAXkbXEAHbAZFjL92jgScARwAgypy4FzgQuYUDrTonGH5o35wHS7ocC27N/bwTGkDV0MU17AJwPfN390MsKD4/OEWXvSk7+FXglMmHDbm86AMwihP13wA8RYXAVjSPQFLAqkAqEwxnAM7PrVFNqs8/eBDwG+CU5TYfHHQJKwl8HvBNZmPS4OgG+B7wKIe117ftJ55y8Yhehko3KQcAHgacgm1ltgxT4JPA3Wd2LNJweHl0hG4s6r14PvJfm9SgBng8cAvwLsobpyeqdgR8Bh9EYr2TfvTB7PYGMsJ90zskDIew05tQ/Z3XKrzsGeAvwNOB/KT/V62UbK9TUT593EPBY4FHAfZDN+rouH6X1fB6y5oZnPfjMvtXLw2M1Q4+6U2ATopEg+zsewpfaHI4igvnJCKH4PfA/wPHZNVovoGkBANGmPzO7X5pdr685YD3wtuXuGI/BIlu01db1TxEiMErz+AiQ8XMOorlr2tS260Q2xFBScSjwE0SrqcRBXynwUuCN2W+GeVPvsTKhCpInZu8q+xMatupPcK5V4vtGhKjPsXDMzgMnAc/Nrg0HTNTvAbyWhnlJvmwB8A80iHNf/MZamLrdF9HuXw58Jmun42gQdW37Tl568v2Ekud7eHi0CZfUrgfGs39HQ/pynXOUaMdAFfhz4DzgH2lo+lyBp/++n/OZ3jPM/l3NPj8ua4uU4XW29eghcovIM7L3mMbYUFJaQ47XvwgcTIPEr0jkjulT5CThC8BdsrrqaZU7/0CIvLaRh0cvofJ7TfZeoSGnK7nvXNvq453r87Jd5+gD9CEDIo763HvTIOJufdw6HY1sNqAP607JCdoY8HFk7XxW1q7uRkL7Qtuxk5fWa1v27k/gPDy6RJ5kLCYg7DK/3HIGNAQINDTlb0bsGQPnWg+PdqBj7NDsvWh+VJCxdiSiiariHLmvJM1RweIN8O/Ag7M6Vlg4f/S6A2ho3fwc8+glWo2n1Uz4BjWPdGN+AGLL/1Iap+nQvMHJl6mbNXtu4C3p4bHK0ClZN8v8Ui2KEnO3XKpJmUds/z5As92iCo5fO3/nj1f12O53wDQNRzuPOxYW05RHyHh5GKKVsu5vVgJhL3C4ThDzr+dkdYsWuUXYRjt5eAwCeur12+y9xkLZruvFefqjAZnB6HMvzP4dZuVzTWFq2TVXANdn/+7XuqPr6AhiH3+/7PkBxU6jrkmsnjS3+1Jcmr17eeHh0SU6nTz7gD0Dfu1FInHENB/Ju04xCoNoOhPEAe6xNASkXvstxIShQkM7ry/1zn/HMvSFx8qCEvYXAqci46tOcIeZsBcQ9RjxV3l7vh4eHisASojfiwQeGKFZrgfIuvAT4D+za5MBzVG1qf8dokDSNSxfNktj/qnvTM+Qi7AD8HfAQxCiXnSCpooxJfG65qaIIqsdLjAN/AZRaACkK9UJ38NjudHOoqza6XnEQ/xyxM5tUFFSAkSYjCG2wkcBD0KiVBxBs4NRHqcC3y0o67MRu9zHI3bHEY3QjWcAV5MLzddP9GrR6LUg7PVitgoFtUYeei9wGfBVGuR3KCPEFMSSj5H59Knss3Y38AM3fRnWedKPMg5DfZZpw9nNuFKN7x8QR8nnAvenOXTjjxDzyI5DN/agHXQdeR2yHj0ZOBzZVOxHAiR8DiH0ZbkNegG99wGI6QsUcwA1YQmBa7Myn4to/m/NyjxP6/VR1889NMxr0mGSib0Y3wMcQ30tX0kZ3ROSjpJQ9gv9LONyKtjaKWcnGjQL3I7sqPef9eAzBx7SMGvMXwL/jRDxf0QEoGvuAo1j0YcDxyLCULUCKkS+BHypJHHGwEI2ltgNLyYETcG/7UnnnNyUqAZ6Mlldu0Ut14JJUYKm+gyToO4R3DE3gZjFXMjKCOmoJ1OHIiRGN+BDeVRdsMlYMNZzKDuST0865+SeLDxtzJcyn5tuUFQfS2PeN6FH9XGz1/a6PmXIy/JOf7cTCUFclhRp0VCjbbRDO3KwaIwGwHey16JJkfoA3Zw/HthKcYhmbcfdiP/XBGJzbs568Jlt93nZerqcsrBH87WtNW3Ac6lt2dBm+7vhPPPjd9G69wstuJJbxnbWhqL7ufXul7xbEnfr9Li7/qCTzjl5kJq1ogrGSMzag4GTWSh49Dj/oTSTdTfFsy0YcMuZ7Kad5y4YOCVZXROt32L1WCRBRtJNO2T3vCNE09G23oCQ3j9BkncNXYz+gsgvo8jG93CGP7eCi3YyK7YzT+r3ameelNxHMz5qrO+u5ksbaFUfNa2oR0Zptz4tMlhqNJDlXJC7aaO6n1HJYlw6Jwvij+umu+12cO5RpB3Xtado4R9kkrETnfIUle8mJHnTJTRMRU1uk9sueennxq4t9Gp9c9a0dp8zqLnUjmxIyU42FC2SRmrbjCOnUyENs6dh8eHTftiERDJMgF2I6VVT2O4W2ewXtA/9k9+wRO5mTjrnZF1ojkAcQUZZ6JhpkN31sUjyoWDQmvWCwaTmBo8EfsBCraA6yX0QeLVzvQrF+yCOqIdn3+1Bjvq+RKPD+540I6uX9sFJyGnBeIufxEhf7EWOJK9HjicvRjYl+7Pr8skuABYbuHnN/jbgBCSj7dHIxmgTooVtpYHVRXMK+FvkCDpgiG0Wc/3wI6QvOiGwOt6+hcRp13E2FFlwC4RCAnwWSVjSjkOpwtVgHoOMw460bksov/bPC4FXUL4RVOfxWURDuBM5zr8MmSdX0IhQ4caarqMNbVnR/DoAuCdwdyQPxEHAFiRqTpXuTy0sYls8ndXnZsRU71LEdOJqpxwL6lM29lrE3Nb6HZbV51jE/PDArD5raA6H2A9YZHzlZaHOyV8g5lt58hsgZiaPzMqaIOTz/xCb9QUZQtvo18OR9eKewJ2Qft2IrJVFmukKsia9luaY6RYJifqs7F19pH6DbPR30ad1Jzd/voeQ8SIFVwi8CPh0Vr55FtH4DTMK5J6GfQYZx/dEwmreFRnvW4G1LLTjd9e0NwBn46xpi8wlkCReOpfuRGMu6bOWKhumEMuHmxGO9ntENlxHc/hNt/55wq5zYy3wfuDPECVUgMieixFfwAtYPg6oY/h4hNvdA+nHFNlQfB14DcKDmtalNub51ux+Kr8Pzj5bh8yFpcq7BFmTuuJuK8aRrGAXqBW5BBF462jeZOi7xq3VyZYi9oxn05yZMQH+GjkifDaDzcyoz3kPsgB1q+W8OavXF5DFaZrcBHV3miUELkTSYb8IMevY0GWd9F5ap2HZkfcCReYiuhl8AuJI9iqGxH69xKH0rbQm6sNmEqNa0a1IJsjNdGcykSLk9iwk9OaPaIzV+lFkvr9KNrUJsgg/C5kzx9N9tsduUUM2Id8F/gtJ7w6LmGKVmBWlCJl4DjKO74EsUisBWt+30uyoSVavNyBy/UycTJot+nU7Yvv+dITMjXZQFk2C9B3gm8j8qiEmZ2cjmzo3I3CQle1htNa+LxV6z3Ul3+k4+Hn2WY0hUTZ0g5L1zSC+d6dk7wd1cEsdU+9ENoNlz3Ez6j4bUd5o7pZBYg4hgt9CfCIuofnEqC4bnMSRMfByZP1314YIOZH5APAIiq0SBgEdwx/KyuPO80pW7ksRU7jwpHNOjks2U9Dw33gG4gN5P7rnO0tFEXdrUp4O02LcLSaRHRUUCzhXMGl9/xTp2FmaE0CALFJbGZwJhwrmjYj2SuuRtni5Icn0ZZHd+lMRLc3vgRfT0O42hRYsEWT3RgbMV2nsqt3QXW5bLfbSvjgyu0+3tqjDiDITFw2B+ErgZeSI8HI4sJQQ9WchEY9SVgZRh8bYORIh6ouNQzc0njt+A0Sz9QJEw3geMufLMh+XLcabEM3OZUi22z9BZE0++3Mnc6ab+lQQjd1rgV8hBPE+tMiuWzL374wsFBcip2EnIES9aP73oj7tvDoZG6q8eUr2XpRJ86luG5TYi0dIpBTt1wfQyGTcbp+qQ+WxThuDkJwDWJhhNUGIxz2d+vQTi52K1twPVhFRfwDwM+D7yIb0IBqncO2Mb13TjqI4aaI+5xAkC+zFiJx9gHN9P+ZSkWxIkfl7AjKfL0Ci4N2Fctmg9buX83fedOPOiCZ7OdZz5UrrkFM39zO3nHd361Miv9cgVgyXAx9GNl95vtNL+b1k7jZsC/KgsDZ7dzOjKmmp0tgBD3IwupnsNKRX2cvNzKcvNw59gpwofBL4No2oCEHJcxMkA+y5wAOde+hAcdtpsbK5ZcT5zWpBDdFSlDmxqM3sh4DHMASEPYNqTR6AHHFD8fhW0vpF5FgVhuNURMuqWYZ1jC02R9x54mpaVQDfB9F+fqzgWUVtqMTqAmRTNkZjcczPl07nTDtzPl8f3dir0H8sQtrVBKOdTfrzsvo8Pbu+rD5hD+vTzqtTBDRnPc1n0lS5bwt+lyIL5lmI5nRdrh3y7b5YG8BCbbw+380I7JpADF2SsVVE1F+BrG8PoXl90xwt7Y5vaIytouc8CbgI2EEjgV6/51KRbNB1SGVDgJj9XgA8n9an9/q567QaON8t9/h0y1PkXFtmMaJ9dDxyAvlmZM652Xr7Jb+75W5bsrIFq4Gsj9MQgkWDaF8H91pOTCI2i9Ce1tDd+eni4yaHUg3JY5Aj8k0s1ASoXdRDkR3daHZPHUyurWXiPK/dHSSIfdbkcjduj6D2qP+MaN0MDS2aQideiIQBPdppU2BwhD0XW1k1Pl+gWCuEU87/QcjeoI9tW0HH+K00jrO7nScqkJWk1RATuP8kR+QK2vBhyHw6hIYPjM65ovnSyZzpds679dF596+ISUhK8aKsC9eLEd8FnfvGuVc/69NLzXp+jHQCNUXZgGzaHpyNh6J+zWtGFyv7LR2WZaA2wHcA6Bh/GaI80Xm02PrWqm9h4Zqmz3kaciq9geGTDbpWjSARfv6K1oR92NHphkFl4/GIP8ldaMxzJdCDkHf50w+3Pnnu9lhkrdkIpCuKrOc0Q1r2u1BsZqED9kqnMSj493JDid08os3Uui22O3N3fi5xcdunkt33BERYuXXXRcogziSqBcjvSvWerjaoE83YfyMDr+eJPpYRa5Fd+fdx7NIdqGA4ANkE6e59YOOuIPLLCNIXR5DTuGbQ6EmXIlqhYTOF0bF6BUKqtG7dzJN8qC+1KT4ZsW3WOZlvw60IsVVtej7jYz0aS8Gze6GRWWzO4zwrQY7gn8jCRVm/PwH4iNMeZfUx9L4+/dCs58N0tgN9znuQhXyeYufCfIKgsjbQxHy3IGZWOH20WNmGaV1a6dAxfk9EsQKNcewiP1/b0ax/mYaM0Hl4NPDv2fdqTjWoudSOnFMyqGX5CGKjXbQWrDao/F6DyO9NiPwuSgbWL/ld1FeqLMpHjnK5mzrSrpjQjU3PzjXwc7P3vAZJrzm/y+cMEtpZb0U0n3r0kUeALARrEeJwJCKMHkDDzj6/aalmnz8XOVr5qdNOCbJ7uz/FmSv1WGgS2eH9ArgG0SzM0xoBYkZxYa6OqwnPRSJMHMNCQqRmJ8cDpyNaFzeu6qCS2eii9W+I+UbZhixEIiI9C/FKLxuDywldfJ6J+FeMU26KNIqE9DoAsVG/N5IwZy0LyZO7kL0BEei30Dgl0TZ8NbLZ0ayP+bLpAj4D/Dp7/TG71z4KImu0AS3bGmSOH4HYlD4IidakR91B7jeKtyGbGyUK7vPfisiHxTbpe5D8Fr9BnHNvRWRCjf4hQeTVXenfxlH79VgkwhAs7Fdo9OuViEPyRcCNSJ/WnTBz11+KOI0NLLneakerE8kCWapz4A00b65dqNybQWzZz0X6+PbssyISdTvS/9As89+MaECLnuPKhknET+b87FnuXOpWNqxFZMFRiFnfA7OyuKYdbh2UqP49Yraz2qFr8UsQvrSY/J5HzIXOQ5RDN9GQ393OZV2TNiGnssciMvwYGqQ9L+M0s/HzgIlOyXo9xmq/Q7WVPTubsLrovBI54oJmoqSNvhshU9BnTWELQdIJ+bfAb/WPNmKjaztsQLSC76CxgDclgsnq/hyErLvfPdJt34LffBdxxrtRn9dh7ObVqC1yj7mfCfwYIYb5dlet+18A70YcffoaIabEofRvEW152UKiOAURUtCnk4CSedLJczSM7Ln6QQfz5CAk0sHrkZOGfPSoGJk/T0aIoh5vJ9n1z8yuLUskEyOnVB9EQqb1NAxfri7rEBvzdyIhxvLyTR2pHoCYuWmoOSX3dwYe16I+ASI/34kcm+/qdX3aqKOaMPZrrdFF8ilI/+bnhxu2+DVIlt+WcZg7TcDk0RolMdLz8iLNJf9RzfIWxHlcf9f0G6T/v4Nkc72aFuO7ZE3T5xxAg/SWyYZp4DRE+34L/ZUNmxG79L9HyGF+XdIyPhY5EbiC1atdd01Vn5Orfx4Bolg7DXE8BfqaGT5ENlbvQpzPiziqbihf2ClZX4fsDsaKsub1CXpsNIYMvIMRDdnTEK1lUQV15/glhGTqotuzAdkiAQI0dml1J8Q2O7xUsJck+FBMAp9ANiY/Z6FZkJbrIU776IA9quB+7mJ9CrKzrB+hdWBz3RTTdRViBNlcvYDG0SgsJOwJ8BZEAEzQJ8JeQtSfgQgDPZrNQ09UTkXsLassfmrSbZnyzkruPAHamictyc8i82QnEunjV8D/snDR178fjpB1N4zesYjJHTTLEb1mFiF936FhDhFmZeoVYXNtp/cD/4Fozb+NnBzkZaH+/RCErGv7p8giMcbCEyH9zXWIv8tlNJsb9bI+reDK635t+LUeDy55jvbtXyPztm7b2kYblDmge3SPetSfRbK/6onJPZDNd9m8+CVCsudxNgGL9K0teM7xOI6AuWsNoo1/PCJ3mkxq+iQbdiMhFr+JmGIdniubtuMIsplXsr4ax6vK76NoRInJcx2Vi89H/Jby8luv61V59H4pcA6iMP0X4HUsHEP67xPbIetuFIYfMnhzBrXfGcleeY1xkZNcBTmCfJdz3ZLRRoayogQJFaCSJZ/qF0zWNpcghEu9vSPne5CNzmYaWjIojh+sA/h6RAugR2d1rMQoAX2AauL+BzkGfQ/F2mvt+08Af0CIU8s42EuEHvvdHyF0UEx4tKz/gTjN6u+WhBbaMI1Ykp8nhizCQp/nic7XryObrPtQvNm/U/auWo2Uxqa2KJFMhAjb7yDzUI+0ezJnWpxGVBE59woaCX+KcNeCz3TjUbYIvQ4h6poYZ4HTZz9kgKMhbFW2XsAN93i485lCx8XlSPQn91Si7TZYxuhPqxEBspF+0EnnnLwZ6b+bkQg+v6FBzNwwr1BspgQSAWqeEgVFmyd20JhLRZuCENFw/4qGbOjZXGohG0aQsft6xLQ2D22DY1jd0D46HOE6+T5S+f1JhKhXafC5nnKekr5SZd4bgJMQRXR+YwVwWCeadYPsHpcbOtCLnJAsjWykT0OyFro77q7RIkOZluXOwPEnnXPyPbN/H4rYja1BBsAgQh5ZxBwDirWoo1l5dnVwP/fdYyH0lOI0hBSdwkLCrtrMUSQpy0MRzWVPxiYURi05GHFu1exuZQ6lP0U0h67DcS/KoWXRZ4HMg7si8+QeCAE+GDkJGqMxTwaBzbky4tRdQ+i5475V2D+QDRjkvPx7QWhLEhq58bAvRE6/NG50vg/dsut3Rck/9ERtDrHXhBWeGKcNBBRHPdJ+vjprg/pcXaXtMMzQtv8IYrLiyjMd069BtMmu/FjjXJO/HzSCTyya7XcRrC35XMtyTvauRL1nY6gN2fArxP5+jGLZMOgkbsuFMvmt7XFW9t7k8NnLuV6SZE+5QoysIXmyrgi6tVlfTpRFCtCBeDYSlugSHO3lUtCCgNwZMf5/MnLkVunszgNHUbSEWsl1IIv/JuQYT7O9WjozhSmDLfk3sOIWRCVnL0W0LPnMatAg0YchUVkehZhOGJbocFoQ+aWKbAqOKiiHljdEnIVPRrRKuiB2TdZLkk9YRACdghwF34nht480bX7mYmCJZApO79yoMEULcqf1UTv9gdRnCNCqLfp+muDREirTDkCc36F5vKu8ezHiK6KJwtpBr8Z4Kz4y0CRTBbIhHyIwj9XoU9ZNPbWPBqKYKOgnWORUu9toMMMG3Yl8D9Go70Mm7JKjFZQkWNiKmNicQrOjWj7G6SDbyz0CbPVcN9Y0yOmD+7neK0Xs/T6ORErYr8/oxUAusGXW0wqLOAw1EfghXyRdjeSzkQ3jYRQ7/cWIDfG/IU6fSuK7MocpifzyCSQeeJlDaYBoW04GbqAHm9qSeXI3xDzkiSyMYZt37hwU3AgvKxY5Yd9XJcqQzz2P1Q2dr+sR7TAsjJEOoiFeg6xTHaOPY7xJtg1iLg1SNnh0jxLCXopOyLobQ3g54DpL5hd3tSd8DBLN4lQkZnlPNOsZ9F4Pyu59KM3ZwfSafJu57/1Eu8/IC7kfISHpytr06YjZxpcQEnrtSeecrKEbu61XjBDbWWCKRuIBFxGObV8/Qx32CKqtvg6JGvJDxOylLELM8xGb4H+kS4fTEofSNyMOr0VE3S3nS5Hj2aI48UuBzpPnIJEPxmgcLbqxZl0M4zzpGkM+Tj08ViLKTv1cBZUnph5LxrDK705t1jvVxPcLunFw7cD1/QjEoeJfEKP9XtgFq8byvogT2XqaM326UK2ha64zjCcSSo6/hdi83ouFJhOqYT8YCZP5yuxzJV/dCkfd5Ewj/gU7EfvBCxEC+RtE86se2SmO6c0wTabc7ljtwM9BYrpOUJxBUjci70YI+5fpkLCXEPWnIeS/LGulEvh/RGKJNxH1Tnf6BVCi/lzEWUf7WRNAKNxISUVz2MPDw8OFlw0ed2i0Q75157oPsbUdaCbGrIxjiLPmNoSMH0CD8JArj0ZheD2iuX0rSyPsSljHkBicStRbJRFRzCNhFadYmia63XImwPasrYpsV/MIEVOh1yHx1HVTkre1Vg13PmPkUrEW6ctjEDtvxbXI6cVHgatotn8eOi17juTq2Pgs4kz5ForHi/bN6chG5Td0FyFGTWvum91L710UJSlCNgZ/Sy7CTw/aU8fO0Ui/KYrmST6T4AwyT2boLjlIp7CImdLYUm/k4eHh4eHRb3RC1ncCf4MspmaQSZFy2r61SLzM5wEvYqGpgZrJpEhM5W/TCJXXDZQMvQA4jnI7YCVI5wBfQaIpXINEXpllaZrodhBlz3k/YtZSlJE0DyXm30fMFiYQW3/Vumtb5sl5L+thnZe292HIBuJlSAbGf6bZ+3/oUEDYA4QUH4NovIsixCSIreXnkc3KTtrYWBZEfjkQOU3S7JxlkV9+SyNTY70de7Tx0fl3Kq03tAEiQ74H/F9WphuQ2MAaIrBffaxzdB4x/zqJYgdcDw8PDw+PoUE3ZjAJEAw4fqwu3poM5FdIQoMvIQv+WhY6rKmN7EtphFXrBkpc1RO9LHHGDUgUmm8ygEx/LnJ90ekJgpKVM5HkCJ9AtLRaLzcmbK/NFfJJctw6JIiX/z8hm7MXuM8dNu06lDr2vBCJgHICC4mhbgSPBs5Asu2p5rkwQkwu8oulEfnlTrROqX0rYku/j976cmhZEiRy0P9z6pYvR4BsYl+EmDwtxzzRsbaak3V5eHh4eKwidGqDriGTXE3ooKEEbwRJ8/5O4L0stNPVRflhSBzdaToPrahkdTti0+3eF5ozlD0SSUKgNrg2i2gyqHZaCpFWEvkrxIH2/yGE6kRES9rvyBlKHLX/VJNvES3oKUiCprfSe6LZUziEXf0WJpGN3s8Qk5+85lvtxh8DfBg5TSg0hymJ/PIxREPc6sQnRezIL6fATr0H0NOAeyFzJW+CpXX+NZJWeYrlmycKbwPr4eHh4bEi0LXD6HJoNR0S5JqUfB1xmAspDgd3CJLJ7BI6X6DdzJ8bcp9Bw7zg0wgRGkGinAy0nXLpcNsmPQXOkWob/r/Z6wBEy35vRPt7CGIPP05z+KxOESLmS+uQzYCSdNUqu32o8d3fgPhMXEwPkwn1GWnWTlcgZPnbLMyyB40Tq78GLgU+RM7hNAf97o3AX7J45JdXIj4J/SDqOHU5InvPm2DpmPxnhKgvyBg4wHniSbqHh4eHx4rCsER3aQs5DaMSgOsRW9+DcperRjFEHFP1s26gGe7KnDavzt77kvmqnygg7NBw3t2JRIv5VkGkkKIQmu1CTarWIprYeyDa5ycX3FPT1I8gdvVvYcjJeonD6feQtPAfpdhOWuv0fmTj922KwyrqZ09FsqYuFvnlY0jmv5D+EHUXZZn89CThaqds/SyHh4eHh4fHqsGKIuuKHBmaQexwy1JtQ3E66V5ipSXwaUKBmYWSqXqyImeDlDrvS6lrDMyedM7JtwG/Rxwkn4PYbuf7Uf/9kOx9aM1gFAWEPUSI810RTXeRw6mazpyBmCBdSrPZjxLu42kv8otuEHTjWi/bMqHp1GvI54mHx2rFUDrp5zFgvzgPj6HGiiTrXUziXiZ9GXZ0fcxf4MxYlgirydGzB+VVLf1/IVFgjqfZtts1R1LN8tAnwcgRdjXxeQ0SIebxLCTsaoe+BYkQ83AkDr0Scg3N+QXEfKgo8kve9EavWermyuOOgyYZMihn7gLnbG+y1B8sluG6LleHzJF/qOV9Cww0MEJBdvC+1WdQGECdhh4rjqwXkMM1iB01FJtQAOwddBmXKRIMLG4e0vZAb1GHngjNnLZeSedki2csxU5+WVDgcKrOnj8D7kZ5hJh7IdrzP3d+VwE+B9yFcodS16l1J4N1yF2sb5r8KpZ5nqzUhX8QcE+2BtJXBYvxcgYxWO1opYCJEEVA/bNBJ6MrUQCNI6aQZehnyNelYEGZ+jmXCja8hWVYIhYo6wYoG/pVp4GjU+62Ish6SWcpqTkK0TbCwuRIBgn1eIPzWTeoLfL9kbky9X0QFyxuSnaPdD7LI6bh2LfiB/tKgUPY1b78diSM4k8Qx+Uih9MYeAoSuvLU7POPIlGHFnMo/UvgfPrnUFqGmZLPtVxHAL/IyjUPA58nOkcqiLM0FM+TeVY/5go+U5I8jsTuvxbpqxr0p68KZLtuTNdmZSjDHaGPeg3t310l36vi4Jk0krRBLoM09H6+tljjQ6Svn5ErYx77kIhvy4GyuaRKqEOBi+ij3CsJQlBDzIPVl6hdWddqbm3OXvtonAQPSjYovzqARsCPIsw69R26U7ouuZvtlKyH2Y2DzERikMiHgtNdyMuz9/wkVgJ0Od2Tdb3+FmQA5BMw6fNehGhBL8MJSUcjLF2/2kNfGuLwkQjBg+IQk7sRswqgcDIsx4B2B2tKw7+gqCz9Tiw1CGiklAuRkJT/S7FA0Qgxb0BCHm4GXkw5UdfP/w7J/jpIoq7lvyl7z5vmuAmTvolsoHWeLCACPUZ+niRIcre7stCMSOtxY0k9VhNuKPlcN1Z/izh81+h/X+X7COBVCMkpkuvQ3EdD62w+ZNC2ugx4IgtlqY73NyJZlT9J81pXP23p03x1T3N0jU8QOfmWXBlxrgX4o1POvq8RORNHnUtl6+ebkMSD8/R3LrlrqSoYtd3KNjnX5n4PcF3JvROEA70ekaGWxlrUT9mQz43xehrJG4vqpLKBahphgUoajk5Hc6UPGY9HxmpBjBX/vH7zIFfegYyLExF5C8XcbW8nZN0ii3+KJDIZOGlyQq9ZRJC/A0mWYylPwvKN7O+I7sn6dYgwuAfNZF3LsgX4AUKmvqWf95sg5SbGC4APsDCEpVuPC5FNh7vA6WSoE+FB2ig6m5kUeBJwP6dc+fLfxAqxV8+jJELMVxBBfhrFJFwn7X84/25F1M8A3s1gIr+40L74HULE80nKdLzdF/ghg02KZDPha5GF5u0IEXXbN1+P80u+Xw3QOv4me8/LTQ3f+iRkY/VSZEHvW19lMkD7aA0i119LsVxX/Dp7HxqN2QqA9v2PEN+ZMrPRFPg3xK/mvUhbx9B/WeLIyBAJGXwqounPJ+bL1+nHJd/3s5xapgtoyOAiufcwGvzgMvo0l5x8FRY4HPg4sikrihimf6usc9dT/cwU/MYiCtJRRJG0u1/1KajTFuB9wPNL6qTy+ldaJ2ONMUBog7AVaQhsEBoMBhgAt81zt2chwSc0THWRhchv2iHr+sM1SIbFeQafwbSCEICtyFHB8cD9ES1skZOd7vj2IkSHkuvagWoov46Q9fx9dAwcjCxuPwP+B/jlSeecfA2iyZ6jkVBqKcJEQx6OIprWOwEPBp6OCDa12ysTaF/J3vPaqMS5fz+98LVsIdKnetx+dyQU4VNzdc2X/9zsvYmMrhSURIh5L+Jw+kLKI8SMtritaup/gWTQhcFHftE5cR0y/h9PcZKyFJm35yGhKb8O/Oakc06+ATlWnaexaVzqPKkAY0jY1mOQxFFPR0xxyuahlvdruXqtJujY+CWSs6BIpmlfPSG75muIbLvopHNOvgnZkNVYWl8FNProAOSk45HA0xATpVZyfQ7JXO3Wx2NxaFt9DzlxPobidlbN758jJ7VXIIT9spPOOflGhKDN0ru2DxB79I3IOnoMsrG/K42xWGgagIyHSeSEUuvY9zmbyXIt16XI2nQi5XLvT4DfIsrD/wMuyOTefrqTe/m1dC1i8nIcMm+fnH1WFoQgQOb2ec5nih8hirGiCHs6Nv4S2dB/GTk1+P1J55x8C5JHo0Y5F2mnTgGSi0P5wbHAYxF+sIVy2aBr0E+dOoXZl60JuJHvLdAnzbpytxGEux2JcLenIWN9Me72hU7I+kHAV/tQiW6hR9plMaYriIbmahpOdt1MYh3EHwdegqRULyLs2tgnZi8QgbabxuK2VOGmg3hdVo6q853WL9/ZSuYuQZIK6WeuJusjwANoaK37CXfDsYHmDKm6g84TdSXn/5V9tmIX6IIIMSBZS49GBHp+TLfqDxVGNyDapxmWzyxAy/k+hKzDwr50HWWflL1A5sceRNDHLP3UJESE4obs5cq5MjlQy8r1ZWQB07KuNrKu86mGnMT9e0mb6GnbGuDZ2csixGgPMtaW0leaGE37yB3zi8n1zyHhXlWue+16e9C+nwXeBXyWRvvlCZlxvjsmey1HecvGAsgYriLr19UsbZ3vFjpP3o+s+7bFNSPAX2QvS0PuTdPdXNK1dAzZ6Kyj2ZSorO20jT5EQ2nkhgfehfCddzhtXFSfbcjJ20sRWbk3e83SvcmqbkDGKOYHi8mGjyKKn3xghTIZEQBMRbPvttjX0J0FRjtwudtGmp2l88kgFVrXi4DPdmqzvtzxrV3b3oBi05cE6bQzEOJQd4IouE+rZ7j3DJGj4NchmvqiQaMDSgepLkYH0T+oXV9RW0BjIsZIvO1pGiRETwyeBeygtVDsN9w2y/smxMgg/wBy3DjI6CZ9QUGEmDngZODnyPFl0WYwD/3tPBKf/pp82wzITl2hC8D3kIXrNTTsnfNaWzcLcYhogNbSPyw2T5So34CYX6x2KAn7FKKFeyoyjio0jzU99tZNfIgsnus7eVgHZdIxne8jLUMF0fK+Mft8xW7aBw1H5ug8/U/goYgCqmieQrODqdvW/dwcqVwJKJ+vus5XEfOXf3A+HzS0Pf8HmU8vQuZSRHN76lxy5d667NXr8uj9i+aRku//peGT4K6n2obvBR6DKJBqLIzE5tZHZcOm7NWPNm6nTj8A/jVXj8Vg5Cb2EBpBBwYBnVPadnkod0sR/53potBvrbBcZK7diuvR6gRyTNMr22Ylsqcju733O59Ds0a7yBmqX6GTVKC5qCcsQibYLELmfkgx0b2HU5dBa6iK2gya+7OKLCynslCwrAbkteM/RLQKix0h6u9ehixY/XAo7XTcqvB5LXKE+RIaGy53rOYFVL/C9C02T3TMV5BMyH+GbMq7OZ1YUT4UDp6HaHn+lAYJyveVu070uq/KZIA+y+2jPyB9dCvFfdSPcdTL+y12r0GNIZ2nL0Xm5stptDUsPKEtmj/LAXdDV0EUA89AlB3drPW9am+V1S9FZPdzGLzcU81s2ebGXU+/gYQPblWXeWQT/zXEXMNt+yLZ0A+u00o2uGS3ikRWewbd+7QNKlRsp9ztuYhZUhg4pUwNxg77eaKMSCmpwbia9ggJifdixHt8weAx9f+VsyBTzo+UsH8AeBSN7JIBYAzGZmVy76CPCnr8qlehXid5umvzFQLnAA9Edv1NRN1pizArb6/L2FY9jLRdWX9OIrvK5+e7rB9a49AGhDbAYIIuxkdHyJVfTZXOJbM7Ny2eZDA6Fv8F+DT9IerGYEoXaIPBZv8rakpk4XohMifrWpkW86Qv44vW8yTKyvoFxLH5AnIksC5vwJb1iNFHLAO0D8rL5sjLZumubTCDmCO9Ofv3oPtqYR9JSd0+ChAFzAMRW+sFSb5ikzATzpeO2awdTGADAiuXJCZlLqxhMKbFbwL3N93AGUOLrTt9HUMFciFEono8A9mkLraeDQwl63xAwxft9cip0F4ccnbWg8902zvo55x12tPlGs/N2nQfg51L9Qq1WE9nkOgwT8r+3dRuDpSU34b4kfwzjTXKZLKwXp+mLuunbLB12eDWKQb+ETkF2NWiTouhX2vQUrjbAxCzzBBIAmONXRuPsnF+za2xiXcmxjaaZSj+544gS2xSakHMXFhjPqgZa2xqrLk8sMFbjDXHBtZ8yjSOaOpMIrABsYmZD2Jik96amBRjDYHzAohNvD+04d5MONsCUhUazA8N5vjABi8MrPmFhVotiE1WJmKTYk2DxBjoeXtYwBpLbBLmgxpzYc3UTGyAmcAGPwhs8OepsSeGNriQAvOIWqMtbsz6fPD9aaQ/5+v9GRtLvT/fHlhzt8CaDxX1Z68RWMNUNGumollik9ycGNs0Pox0qIlNnAK7Mpq6pPK4Y+uso78bA1FgzRmBDd5RM7GJTZqqeMrKgMWmtSAODeZLZz3ozDfMB7UgsKaXpi82siGVNNpXM/Fum7WN87IyD+M9d9l3yP4tcxswmPzClRoIA2tOD6w5NrDBmwNrLrPYdD6ombmwRi2ISUzaRPZ7OU8ahbGkxmZzX+ZJbBID7Als8PnABg+J0vCZxpoF2tqzHnwmibE2NgmJSXfFJkHIW5PMCGKTYLG3p8ZisQPTsBsMR+4/kLeff8p0bOI9+b4y1pCYlNgkt86FNebDmsmRTpvdxwQ2OC3rq/cazDWpsbbffVXUR3NBjbmgZmKTGgO3Bzb4z8AG9w9teIrB7Mn3EYCxxt46ttdMVWbS2MS3WiyBNdadu4nIyltnojlmwzljrLE3j+0y+yrTaWzi21r8Zqf+phvCLmMoJTYxiUlvi02atXdjPgEmNkli63JlIGNItXihwXzRYO4Z2OAlgTXnWZgvWs9c5jeYdaFGNv6MxSaBNRdnsuRugTX/aprrUkdiUluT9t6ZzdlBtLcsySL3PiplDN5urPmD7etccgtgSXL8KJW1/drABv+Uze/3mMbmtKneubUjRTY7tdAGpwbWHBfY4KMGc1NiUlOvj4nJ5F6P6rOwTqmx1EyjTonMoRsDG3wosOaegQ3+1ogCq2tLiv6M6eJ6tcvdojS8CIe7RQfObLZAGNlgdsP8ms/vHNvzxsnKTGrsUBx71asZ2oBKGlJNK4zHo6ytjc4FNvjO3urU+774iI//2FjDW7/8nmD3+GT19GO+PX/w9Bbue9sx3Dy2qz4In/+9V6VjyX7liI8AADhCSURBVAjA928Yv41do/sip2fT0aQaHjy99acz0dze2KShyRrprAefyVPP+iseeeMJTEezyZXrbqpsnltXm5necnpUnTr90u0XH7t1ZtMrAsyz9kczm/ZXZu18UDNxkJCalKRcA9lVewRW2iNKI0aSil1bGzPj8ehNSZCcftPYro+vrY1fH6Qhd993aHTD+G3B2tp4HNmAyzZcz9cf9mn+/T8/zY/3X2CraQVjOfvG8dvZV50KB3GuouUPbEAljaimEWviUdbWxqaMNV/bPTL5kS+f9G8/N9Zw2pfeF9w0vqt61kEXzK+pjXLE/u3cNH57X7TqP3zI53ju919pKmmExX7jlvHdz9hT3e9eklaTKDxoest5X7jzDy/l8MvMKd97Tfrjbh+Y4awHn8lf/OglfOab/8opD39P/PKLn1oZS0bedtvI3oNvHdvzot3VycSahu3omtpocPjUlp+vqY2efML/vS28Zu0t6XxYs2tqY5z5qI8suR0Ondpmd49MhlEa7t06u+HHt4ztfuZMNOdGOEjX1EaD7bObvjUVzSahDaJbD7qsrtXfPrOJHxx8vr3tgN8nrzjn5dVDprfufuPTX3Maf3fLaU971NtO3Di/9jWpSZ84WZkZnY5mmQ9ikiAhMRbbo3lisv8GNiC0IZUkZDSpsq42zmhSvXQunP/YZRuv/exYbWzvIdNbzMFTWys7x3Yn1TRKAxtw3dpb+daJnwHgTpMHpQdObyIgOPeSjdfcduvonq2psaoFSaM0DA6Y3Xjxx85+1UW/23Q1n77rtwZG1neNTNots+ujjx/7tfjQqW0/3Dm25x7T0lcqu4NNc2s5aHrLNzEwH9Tsfz76QwCcdM7JHDK1ld2jk7YWJOnddx1R3TA9fv07Hn3am9i47y3PPOtlj19XG39tLYgfPlmZiWaiOWpBTGxEpsnOufuqah+FNiCyIVESMpaMsLY2xmhSvWg2nP/IxVuv+FylNrr/2D1HmK2zG6q3jO2OozRMIxtw/Zrb+PaJEwAcMbWdrXPrw9CGcZgGP7xlfPeDpqJZt3Bmw/wats9s+raxhloQm4qN3N/84Jbx3Q8s+c13guw3Zzz6wx3X801ffSc3T96ebppbj7H8/I/rb5y8bXTvOmcM2Uoame0zm37zpYd94jICOPmHf9M322u1Xd82u5EvnvRxa41NXv7NN1eP3H/QzIWb//jJjfNrPnn12lvuum12w8sCGzx7qjK7dX80Y+fCmklk01qfq72EwRBkc7aSRIykFbumNmrWxKP7gC/vGpn8yHP/8OjzayM1rkt2BddvuaV60daraiNJZLfObOCGNbfV14WjJg+ym+fWAfz8ynU3lbX3b7900icutcby3O+/suvKaHseNL2ZP6y/0U5WppPH3nC/6tbZDbf+/VNP/QfgH55+1ksfuX5+zasTkz5usjJdnY7mqIU6l5Ym95QEBjYgshHVJGQsHmVdbSyupOFZk5WZD3z+Xp//NjObkn8478Vmd3Wy+rtNV9cqNrKbZ9c1tZvW5zFnP5eDp7cyE86liUnNYVMHVA32ii/e5Qd/E0dzr33ENQ9+ypp47NXzQe2Bk5WZQGVDYtIeyQa3TiGVJGIsHmFdbTytptHPp6KZD3z/sPO+Ol4bi19z0dPNtWt2Vq/YcH0tSkO7rjbOjeO38/2HntHRM+sK1j5K74XcrWrX1kabuVs8dn1sEu61607RTeO7gnW1sTi0AZdvuB4zMTFh9lan7BfudJZ52SVPPm9fdeq++yrTQxMFQSsYZUR9JKlQSUMiG1pjzWxq7M21ID53PognLtp85fc+9MR3p5/5z8+ExtE27tixA4DPnX5GVEmjODHpS/dXZj5+w5rbkqloNkxNSjWppNtmNwbbZjdcGdjgHqNJZXYqmjXPO+X5dmJiol4eiw1Hk2q6Nh6zN47fft9qEp1SSaNHhDY43MKaJEiC+SBmXjTFxEGyYCe9pPbIOrtiQ6pJhWoaUUkrRGmQAJNxkFxZC5LvzAe1z1TS6PLQBtqP9QVgx44d/NfpZ0SRDWOLffne6tRH9lT3JwbTd58EJeqRDammEdWkQiWNsv5kOjXpzbUg+WUtiD+3e2T/d6aj2drh+7eHQUF/9hKnf/Z0RpNqWEmjpBbEn9hXmX7JTeO3x1PRXGRlfNgtc+vNATObJiMb3jO0wbXzQS147inPW9LCqmNLtLQmMhDXguQZo0n1M/ujmbGbx3fZycq0SU3KWDzC9plNdsvcelML4r/fNrPxnfuq0+Fvt/whuduew3vSNp+d+KwZjat2JpobidLwottG9x5969iedDasBQBjcTXdPrMp2Dy37pcHzGx64GUbr2NtbYwdO3bQNE+MDU951NuSt/3ir4NDp7Y9uppGz6+k4YMCGxxkjR2LTWLmQ9F26zxJe0gCRCiG9Q1+NYmopBGhDWJr2B2b5NJaEH91Npw/o5JGt1TSMDSYppTl2TwJq2mUpMY+bDqa+/GN47fZfdVpE5uEShrZzXPrzIEzm+eqSXRcaIMr5sKlj4kO+oq9lSlz8PQWOxvOn3Pb6N4H7RzbncyFtdBYw5p4ND54emu0rjb+7igN/q4WJNE1a2+JD57e4t7GWGOD20b2JdbY6qa5dU+qptGzozS8b2DNAdbY0VqQ1PtpPoxJzNL7yqCyLKSSRowkIseqaUhgg5o1dndskotrQfK/M9Hc5yppdHs1iQr7aGJiAoMJxuORdD6ofef20cnH3jy2K2sHGEtG4oOntkYbauMfidLoFbUgjuaDWhwQ6G++e/vo5GPc34wnI/FB8psPR2n0yloQRzPRXPyXz3thx3V1xtDjp6PZb90wflu6rzodJCalmkZ289x6c+D0pslKGt0jtOF1c+F8X8dQfj3bML82PXL/dnvetsseWE2i51fS6OGhDQ4D1sZBEtSCGF3Tahlhd0+Oe4GmdSGJZM6mEaGsC1OJSW+Mg+Sc+SD+3O2j+34wFc0md548KDS25Zx93HQ0++0bxm9P91WngtSkRGlkt8ytM9unN09W0+ieoQ2vXWp75+Xe7zdcm2yaXxttnd3w+EoaPbeSRg8IrDkwm0umFsgJUq0Hcq9BALXdpO0qaUjGj3bGQXL+fBB/brIy9bXE2Lktc+vDwGk3d81w60ImG6ai2SQ2yZq18djTKkn0zIoN722s2ZoaW60FcV2TL5v5FJsR9m4hsiEgyhR6IxlHqKQRgTVzqbG3xUHy21oQ//d0NPs/FqbX1cab6qT1etzPnh8BcSWNnjVVmTnT5gJpGAy1IOYBO+/GoVPbqAVxTrffO9SVlHXulnGfAu42klYuD6wJssqkAGZiYiJAjq0PSbGXhTZcE9pgqXGOewqLRYwYbXYcZ+vHcsaKPVhW3rMR57ZfUuBMabGRNcTG8s+BDV5fsWFsrKk7SCQmNbUgmQZ7N+A6I/aP7iTWex6G2As/DQgs1gmYJBoCk1m46nvvmtPWj1G0HdLm51sjf80hYdneioSHaqqL0xYfCG3wqtCGZZkx+9Cb1PvPrUf2tduf5yNRRX6S789eE/aJiQlSY4OUNA1t8KPQBidFNkqMbUzsxKQ2DhJjsQ/GcC7WhKfs2NG1w2tOMGr9Hgz80Bo7GqaBjWxo9MTDGkhMQmwSmx1l/hXSx00260tpm4mJicBiU4M51GKvqNhoNEgDHVNYsEmQmNgkNxvMMRYmzcLjR63L/RAfj4cC1jqDs25ol82XrN972KPN46uuwTILZMYu4D1ZOfUodeE8gecF1nw2SqM4aMgMUmPTWhAHFvsoa/ihWeKY6LCvjMVagxm32MsiGx0apUFd0WINcWziKDHpf1tjTzbWhNlxsQvtq8chMu2eTX1laeon09O+aruPdiJh5D7W9GPqZN1YrB1Jq8FcMH9ZZMO7RGnotkMSmyRMTPLt1NgnZKZM1mJtNa0E80Ht8siGdy75zbdSY5+Y/SbtdG5NTEy4Y+ivAxt8rJI2rTukJrW1HsqVxcpT0Pd3R+ySnwCY4vXMtRuG3tODheuCrGuF68J5SDI5DZrQRDw/M/EZbe+XBTb4aIv2fgiGc5bS3iXteSIShOJ+FM2ljGD3ai5pf1mkzWz5PLoYiWj3HUrWU6c+aludIj4NpwFHMSDZ0EGd/oBEh1K/vKax0A5ZnwtqPPG6B3K3vYeJD0vfLAyWxt2ixm2IDCaQY65hDbjRGAYNodEUMeChiGH+62hk82x2qrT6c8tcUGuyw2sMtEKHI73Xo4HPI4HtUyA2mADHbEgXHhod0ZdoMA2xadwnaHtUEEeXJyCJLX6HQ9idtiA1lsTUBuUN7VbDuP2ZK78BTkAinZyKLCbdROloG4E1BNk8TowlCeYLx0fW3z19dFbnQ5GxNWqsSVJjwzlTw/WocYShRWLKXgGchTPWJyYmlkTYnXFlayaGiKJ2MECRI66W42VIHF/92xpMaCxOR8s8SeSGfYsG486TbMyrva5FYt4qUXk6OSelJpkBzAeN/tAPszFheqxsbLOCUkWDITYxca6vsk1RULIA6bh7N+J4Vg8tt6CvjCWmLtN6HvGhRR+BJMP7CBK//2QkPrUB6qeeAQHzQQ2DsbFJiKMkN2bVnLLRDgGBatLa/k23fdTgnNm6UzKG+imBS4jli7K2HcnaOylez5CvB6LCM3Wm6DSUG9Hk/kiYvn9Bsmjq5fXxoGNokfZe0opX0p5vAP4p+6xU7sWm53PJNPGj5nmk6+ndkWR070Hme309zWvUnX//G6IUqkcLEnkyKNlQWieVDXdGnDA/ioSn1vLbiYkJPscP2nkIcZBYOT3sJ1lvtG0H3O3PkTjrYV6Talrsmt3QTssJ9Zg1zt9aDy3f+5FkHpp6vbDcDuFfDLqoPRzJPjZCI9tkYUi4rB2bPLV7CJds5NtDn6nxR+8MfBdJefwHFhLea6QRTatgBf2CWw+3rdz+tIjw24cIjhBIlkpIF0Njse4PchqMFBlTZyKnNvXdv7vQ54qnyYU+BzwESQrSJHx70D6moS1pCzrXXooIz4ScJsNBChkHaMyTXqNsnhinTCkyTx6JzO1HI/kICp2VSvpjGNBtX70H0VLWaB3XOhWtj9F27BU66aM/QzRoTyQXos0xI2i7HZqd4kp/00sR4ES26OFdO4f2/auRtTKhfD0DsoNtlGH2FSb3UrgyQteF1yMx/19CY80ruGHf2ztP1N28BHn0S+7pHGoVXlHb7c1Z2d5IsQJM15dPAy+gEYe/LMFSphE2veY6edmgz8/LBg0/GiFrT+lYKIOxxhS7uPYcnXK37yEnNX/oxOzB7fRhgFbYHUBuoP53IVnuFoQtpPWAMgV/p4hQ+CRCqjSMkYu6d33Bd25q7qVA+0BDzrnPLsp8WcmefRBCdB9FY2Lq+xeQ0IjHIrFVB0HYNUVyXqDlfSX0WAskPNM3kHjYfdWw9xs5LYZuBD+BTMp2zZH0dwch2vhH0IJk9gH5caLlOY5GHoIiYufOW/c7FVC9UAjo2M8vMEXzRAXkPGKC9G7E9Errsxqh8vCJCFGvh2XLXadzLE8qetFXAdJH+Q3CYn30GOR4+G2s7j7qKRyZo212EjJPWyVmUW120dgYBFQjnJchus7XEK3vbxD52WnCvF7USdvzQYipiHKAornUD7mna2mRnIWF66nOr1ORU+tv5tpN//0CGkS9qP/dZEj55y41W3uZbCjifEp2a8im7adIpvOOxoI1dh5MPzO4l3E3bcu8Alq523bE/O+x7ZAC17bzwzSnqh8EtOBrkPS2hyHE8gAaBDnIXa+V/lfErm0P3XeCZgB9EZJyWbMd5ttIB9FO4PuIOc7l2d9TyEKz1DYLaKSsPRC4G5Jh7BHIZqLIMbiC9Nkjgf8HfJ3mgXwDEr/4APqj3cxDB+0oYoJwGGLu8qfIMV3eXyLI2n8zEsP2NFYwWc8RdbU1fxOSG6CMqBcJXmiMzQcgNm7PwSEw/T59yEH77A1I3xbVRcd/CFyJaA3Oy/59G92n3c4jRDbV6xHTonsi5OShyPwpmycgAv9jiHnRUDjZ9wE6nt7kfFZELlSWXoz01fnICc5uJE5zbQll0AzPG5A+Og6RUQ9Cxk2rPnoFony4keUhkSsZ2vfvyt7z5EehBCJCbGj/mL1uotH/vZLBOl83IsqHOwF3QRIMaVnyZXSJ4t8iCovdLN94eBONtSov93QuBQgn+B7wa0Tu7WJpci9CEtBtAo5E1tLHIMkOy/iR4s0IWU+c7xKkL07NPivbeKgi7ZeISdIFwHUI15rF8aHqsk5jiGw4Arg3omg8wXluvk46Fk5FTqjzSR4L29Zik0oahZdvuO7Nb/v1KZ/+xN2/snk8Hu2HAkC521qEu90VWY8eifSdziW3zJXs88cAf9EpWX83IqDNjh07BnqQlyM56xCS+jaEqOQ7TyfNkYjWWG1nu4F23NOz96J0t7qzexdiKz+ZfWb7RZay9vgmsiHZDvw9Yifcyjn4mQhZd6Flvx76E2mljXp8Hplkb0Y06Pk66L8fSUN7seJQQtT/HDFFcMMjulBBr//OExi9z7ORRF3vdD4bFGFXIb8VsbOD8nlyK0Loz8Qhe32cJ79EUmu/A9nc/guNbJ15gR8ji8STs+tWI1nXje69kMUCirVjAULOXgl8i4LIEb1CNi++jMjzeyEa30dS3kebkD78dzrXpt6RoW31MKTvy2SOkuPLgA8i/X9tdn0/56r+0yAbuMchpjr3oJiw6zp/KOKXdTrdr/PdlFXn0hEIodI2dqFmKTcgwS++nNWlH0ESfopk+zaIHP4gsukpOrEGOcm9N41kcCrHH4bIyqL1Rj/7BZKw8Bf0ketMTEz8HFkrQMw9P4yQ9iLO58q1n5IlxZKkcdn/Czi7AfZWp2573BNfvxeY+u5D/3MpG4126gQyp94PbEF4z2tovdF8XidmLXo0kQLBxMTEcljdqQZ7P0JUv5tV+tEUm4GApMz9EOW2s62gJjAHIQLDva+WRxeQp2Rl0aMbdXLoVzvVnWoQAvRyxBHh45ST3fvRIHL6W9d2Kk8o+w3XNrGGEPHnZG3tTkYt/+E0FpxBnu70GqoRvzeywLht4UK1NO9EtMSvolhzE2Vt8g5kgf0CgyXsKiiPQwh7XpDqGLsJ0XBrFsp6JKY+zRP3WDHN2ubPEIe6l1MuMx6SK/dqgvbV/SnWBGrf/RaRq7fjHEdn/dRzB1MafXQhokWbQBQtZXL7oQhZ92gf2tZKLMvIWIisI6+mYRqpGnjT5zVCzTSuBz4FfAZxAH81xfPRrdPpDGjOahSi7M97I9rt/FjV9r0SkXvX4ci9Hs8ld/1IEX50LqL1vg8L+1rL6mZuVjwoV/78b76FZEGNcUzk+iQb3Dr9HJHN30BkRFl7Pwgh6yY1qbVAFme/xWMw+yrTHLvncI2Q2E+43G034ntxMfAflHO3B3ZC1i3SOQlOeJxlgkGOFOYRbf+jWSh09O97IeYzt9L5JNbrD0K0+eTuobaepyMDuEqBvVY/wgwW1DVC7PaexsKBrGU+ANFK3Zor18AjwRTUQUn47U6Z8qiyQu1UC2xGtyInChsoJiRKor6CnJpUkEXhJIoJu473TyMa0V87bdpvwu5upmChkFcC8A6EqI8gc7dJgzGAeaIbmL9FNteHUL4phGLflNWCIxf5/k3IXFQ523OZVkL6tI/eiGysNtO8gBWNNY/2oDL1Xtl7kR1yiNj8voyG/5Wu94OUu2raYBGt42aKN29ah7s7dej7nM3Grj77qOw9v2bp33+HEPW+yL2SeVRFrCFORZSaeWjZ7lTw2VEl12t/vCmrg9pVD0o2VBCTrDch5pNanvw4PlL/sWluHdZYxuKRmavX3gxIsiX9RSqBIdk8t356LBlhsjKT7tixYyA5DjIodzsdiXT1GIq52/auB/WgzSVylVWnDBBt8u3IcUKRUN+E2EVrOvFuoLZzZbv232bvhYkGeo2CmKgu4bgAIetFZHcEsRPV9lm2DVdBHVaqlnxR5I539Vj0DMRurYh464JzAWLLDjLeTwZ+hniJF5kIpIhN3H8jR5y3MFj7/jUln7tjU+uyHPNENUF7EZv0Qyged2Nt3H6lo6ivdGzOICZV0EdTpZJkLHrqdzNiH58n64pxp8we7cENhVkEnacfzd711BgY3JqfjQXXuRXEj+T5lK/hG5B5O8PgT8OK5IXrC3Bx9t4XuVcyj3TeXob4zK2heB4VlX2cctxMFkGOPo6NFrIBRHbfRvk4Xpu924ffdG/W18YxmPQnB17IxZuuJnZM9A1wj91HcuLNx6XWWCYr03yppzUprlcJd7sIIetFMs2sOK1RPlMiEtJvFwvJutsQm/pcrL5q0lu1BbSMkdoT9PnYU01wlFRWW1y74rRoJZFfPojYY5Y5I4XIBvSZCLFUe8KbkQQVZyEnPWXOuHdBNgOPp2HzbgfscFqEpjDWyzxPPMkrhxvHuK++N4qcXNe+WXHzfYWgUvCZa9K5M/usrzbqZciNBR0DtyNa1RGKSWdZ2MlBoNWau+DUut8KCkfr386Jead8wZUNfa9Prk4dl3tdbQxjDdZYc+LNx3HsnsPZV5kmDhKiNGR9bQ1bZ9cDmCANWD+/pp3b9qRO0Bm3WpEOVLnBkbL48VwVj7YwMTGRf6m9akRz6KFevFyBUkOi0pyQFSVv8wyyiNRY5lOBTtrSgdqVvxyJZlEWLUU15M9BtCJ6DK3a9vORkFp6fb4d1Izg0YgzjmpLi8rk4bEoBr2pYvX5CQwbWsnOIt+ZgaNgzK1U/5GmtWoQcyn3jH6skwOtz1LqlBhLLYiJTWJTk7JtdiNH7zuEY/ccwdH7DmHb7AYSkxKbhFoQk5jh1Q+sOM06LCAco5QfvyvmBl2+ZdRgdryTLrGjUi1wz7UrBf13JOII/DpkY5UXzFqn87N3ddAcWpREfnks4uxcFi5NteqvQlJC151EMyjB/zLiQf4eWjuc/jVizvAhBh8hpgjWfR8CTb+Hxx0RbZPe5ZyfJRpVD4+2YZz/AtRMvEANOIBESD3BiiPrBfa/B2Qv/cyFdsuu7L3bXeb8It9vyT2vXs5hJyMFZhoavknNJw4D7jYxMXEXxMZ3K7I50qRGnWg89Noou8dGxHn3EBrOIq08/r/g3GelQDcWxyCmKWrukz/VUtL9MUQjXrYhibPvTgOOBl5IucOpRcJDXY6kme43YZ8p+Vz7VOdJPdmVJ+weHh4eHoOAZipeiRh6sl6ys9ZESXPAw2lkFc1nwjOI6cQ1zmedQK+/BSEiYzSTSSVcz0MI1j6kTet2XcsU4rItFBB1snY8GklA9KdIGMXRzu7cMTTSUFEChnlE234G8BNWQDSY3IYyQezL/xuJStQq8st3ERMZNYUBSp1SQDTnd0bmQJ6w6z3UmfWhiFlNPyLE6Bi/MXsPSr5/MY0kHPV54jiNe3h4eHh4eOTQCVlXjWiMxFlfrjJrxJU5JBnCW53y5a8LkQxbu2loGjuBXn8top28NwvJeopE9fg/hLRfQ7OdWj2GeZ+hmthunqUEbitiWrED2Qy5NtRFxly9ODtSG0l3LOpmxyJE/Vzgb5zvhhYFzr4WiRV8PK0jv1yOjB8l2AvMj5xjYbVDn0cixJyNhNsqShSRIBrtzyOkfi+9t/nXe12EbFjX0zxPVJP+lKwt/gbJleCWw0233E+s2Oy3Hh4eHh53THRC1lMaMTXtMmcw3YgE5X8nEm+3yYkug5bv09l7t0RANyhfQch6WeasP0ESevxndu3vkHCRCX3KWJZrG61fpynAldCdgGR6PDyrj4ZQC5xXP+BGflASFdIgb58H/gohgXVyN4ymEyV26v+I2OOXOZSGSMbbZyGnQO1mZNTN6E1IhJgfISGr8mZEbgKm/wD+wvm+VxFidE7cCPwQIeX57Ig6T3YgoUU/jdjlX4akqF5wktBr5DT4nrB7eHh4eKwItEPWdWHfgNjH1hhsBtMIMT/ZiNg3H40kddBQjUXOiDVEI/t5hDirOUI3Zj9KnP4NeCmwnXLCvg6J9vFyRHN4AxIPdB8w1+c2M8hpw32zv9vJ1qrlvhti07wtazuN+uK2qZsIq5cadTcuvrZpjGiL/wkxm1DiPrRa9RKivgNxBC0ae+7YPQX4DTmH0iLSmnO60vv+CpmbX6C4j/S+T0U2D2+h9/br+rz3IWS9yJ9BN4aHIKnl34acet2A+JVMArUByJaERmKYFRkRy8PDw8PjjoNOyPo2JEPmsEBTzuczJarpxLcRArNUqPbzJsSeWJ0c87bHamajpihrEfOYuy5T+7RDqJUUfYgGUc/H4HW13f1ADTHNuAG4BEkp/D1E4wqNdh14uKh2kSPqqsl+CI35UkQIlWi/Bfgf2iDq7ne5RBER8EUkM+e7aR0h5s1Z207QW8Ku8+GnyInXW5G+1VMSt31S5/pN9D8PQisMfxgADw8PD487NDrVNC+HY19ey6YEPSy4TjV3pyFkQQn9UjV1Siy+iGwAPkmD/EBD8+vaXltyJHNAbdWuyYom0HkYkjUrZSFRt85152SvK2kkqOimbrqhmUFOH/Yg5kL7cvdzI9PUMWxEPQcdf4chDqWjtI78MoH4CDRFfmmnjgWEPUS05kcjmvqyCDEgm4g/IKcXTQ6nS0SSPePvEafvU2lOU6596o7R5Zgnblk8PDw8PDyGGp2S9X5pV5cKJUQ/AZ6NaGm1rL0iAUrYT0cc6T4G3J/GUX/i/Dv/gsEQg3bCKLoOfSBE3W3DfJv+Ftmg/IY+ZDMs0EoXOrQOK0nPRX5JEYJ+JkLYiyK/qEb9bOAl2Wdd2WuXZPp7KRIh5k8Knu+W8XNIhJjr6a3TpdqqvxFxDH4fEkd/mOaJh4fHyoNd5DsvOzxWLYY+dGOb0El6PPAa4B2IprabCDBNKLARDhEb4QcjoQ3/ComysXa5G4HOhJW2y9EFv1WN+hTwdEQLWw+r2GObYlezupK06HmoVv0TCAku0mwrkb0WcSidY4lEuSBCzFx277MRklwWIeZwRPv/qOw3SzqBKtg4hIjD8neRiDUvAO7HHSCb8CBixxdEHVrR9fHwWASzSPSrEZqjniWITJljCckP+zzG6/NztcmG1YhhlXedkvXlcvBzj8l1B+0eY+v7GiQL5qMRIn0DPdAalhB2C3wtex2IkPcHIXHJj0BswNcigiRicJOmXQ2Dtud4i3tchZi9aBs29f8wDuhlgtp+vwVxKi2L/BIgi87JiEa7KfJLj6KyhEhUFo0Qs4byCDEPRTYXL6AH8etzGwedJ9PAp7LXnbJn3h84Fgm9ug0ZgxUGqzzotSau6V79FPgF5kq9li2uL5DPNuvAt8PAocn5bkAUEI+n2Az2mzR8ZNrlKb2aNx1lDR+QbOhlMIg7AgbWR3r/TtHp4rhcHV/0XJcQuNfVkDB1X0Xssafpgd16AWGHhmC4GdEi/m/2eYCQpHU0CHtRwp9eYiQrx2mIZrXIBGMeIYvtQus51A6eywwl6n+BOHfmQxYq9POXIE60bTuULoaSCDHnAX+JaM+LiKk+/xTgUuC9NPth9Kos6seRIhu/K5HwpmTtsRaJyz5OY570ExXEofnzwH0o9ikoysSqnxXlcwiAuwPfd+pqXYHcizlTIOAjRN4djigMispXVvbpgutUTo4hG6trsvaad5+/yuZ/SrFGVttqe+7v1doOQ4mcPHkO8CJEKbYJkS+3IAEJzsyuceWvrnVlOVia+nYJ/Vq0pqrJX4gEmbgQma9Nc6nL5zWhhPjpvL0zxQobxQx3DJTJb+U190J8Evsmv6Gwr9y157iSMgLYdsi6dvI8oq27iobjXL+htqwVZFHfimit7w88Agkn6S62eu08EsLwjUh4uJ5kvSzIJKn3dDX9uomYBCYHIdAnJib0ueuQeOlaJoWbzXW38xkUp7RXbEUm+mTWru4gbnfzs5pJfoiMtfsgMcyh2f5aoZr2dwOfpYdE3b1HQYSYzyNmTu+kWNuvkVlOQyLEfAUhzPNLLQs0xTXXurqOpRoRZi+wd0DzRE+IjkPClcLCeQJwndM+bmI0rYML/fuNwDeAP9Ks+bN0PmfyMAXvmvfCII7FekpTtNm5quCzq0uepbLiXcBjEVO4JodgxwyuHyet9RwAfbh3vp46Hm5ATkTzDu4gppWPQE6pNFFcO306tGFmVxJybbwbCeebl3fQPG70+utz3+XxPCQSV0ojo3I7czU//nV+5Z+jf78dGT+3UeBc30PZoP9OERk+jsxjvb8p+N2VXT53pcDNrq1rYD5hH8CrECuJ8+i9/Fbk+0rHaowo1h5DI/qgW34D7Ow0KdIFiJAPduzYMfCkIk7yH4sQyX9CjvDz2jGNavICxMFNszb2BC6xyB37K+qd0uFxh24q2kr8k2uPBwAfB44paA8dZL+mETlEy3hD7hotR4rEw34n8GoyYtBOMqxcnetmSKvwCHkeMeP4PKIdLiJLKiC+BPwduY1jL9ujJELMuxDC/nwWEnZ3TnwGOYm6sJflUWTlyjsOdzNPVNC1vdnJ3fspwEcRhUNRjgYQx1h9lvbVZcjJ1YG536lfzMFI2MpXA1/upHxtoD7ncnP+PkjY1T+h+ERHZcC5zn30Xr/K/l0UMShFQo/+HMk2+1P97QDsbQfpKKh1PR/ZmORlm5ZlAngakg27pZN9zuEcPGnvNSKaN4wqD9z1V7/7PRJxLJ8szs2o/C/IRjumxfpWsqbptRcgmtsxFsqGFDl1OwcJ/fxtCrJTLwFlsuFE4CMUJ3LE+fvX2buaG602aPtcgShS7kpzH7mKzu8joY0/jePH1UOZVzcpdJ67GeEFr3bKk/+NAX7ZCVk3NBaDINPmDhquALwdiVKyGXgyzURJNU+HIYP2G/Qp+UlJR7atecoJgRQRLOvIHcM49aogO+aNWf2OAx6JHA2qJrCsrp8vKOPPkAU5359KQl6V3f+/gPMmJiZuQjTtrTTyWtZJRFiuNmhbVbN2OYZizbWapJxPI+Z/nTD1g/iURIh5CWLWcCLFpmMJckr1eYSw30oPnLPz5SpAt/MEZPyPUTxPAqRv1iDy4UiE2D4WuCflydQi5Ej7K077qaZjD/B/yDF8PsmVCt4Dsza8FMnO+ivgqomJidsRDXXcZZuGNBLDHYoswI9C/GT02DY/5/WzK5AoWW59QKI8nYOQ8qKcESlyNPzjrB7fA347MTFxLaLhnGZxGbAUxCwMJdtraFt8HXhTQRtqvx6GbFi+DXwLuGRiYmIn0qdFGaNTJMlXP9vnDoEWp3Sl109MTOjYvx4Zv39KeUbl1yHZ0L8EnDsxMXEdMtfnWGg9kF/T9DlXAz8A/qzFc+6MjJ0LEKf78ycmJq6meS51Ixs0aeQmxBzueERDez8aPCg/rnW+n4NEedO2Xa1k3c1C/8aCNtF5vhZR5JyKyO9zgT9OTEzchvR5je7XRF2T1gMHICe7f4L4V26mMdbK+uCMTm3W9YbpoDXrBQtyBWm8TyBkvcyW9IEIWW93IC6HJkSPsF+InASUxYBWc5si217VWuYnpiY6+glix6/XKr6JHOMdRfEgVrOB07LPEooFWVE7psiO8TPknClXOLTtP4gIxlaRX3YCz0SEfC9DJJaiIEKMOrWejQj0fD+rw+ndEDOdJ2SfD5vw1vZ7L6KliimfJyEyT4pILBTPkyriCHsZzeNVZcK/IP4gaymfK5oR+G7OdwlyCrPASbuDelcozoNQZvqiMe//BdH6ufXRf5+GHP0WbV7csXr/7KWInfr0E+r83q8ss+pT8XOEsP8/FiaG036NEFL3JOe38yyUaTb7/S8Qze0ehm8erTh0odjQNn8/QtahPKPy0YhGVTFHMXnWNe1VyGmLayZ3WvYcQ/lcsshG+97OdzEy5rpdG5UPFK0/RYo793TtPdn7alqbi6B1+zBibXEAxUorvfYIJMrfX2WfqV9Lt/Jb7x8hfZWXByqr85+rLPoR8IUVE7qxwF5cd9gXIRqOMicKDU3ofjdMR5Oq2TTAa1loh18GFRxar6IkUaqdupXGwHMX4RAhkW8FzqCYyOj1WqaQ4ggyeej1r0PIeq8SVA0DdiOOmS+lPPKLmmo8Bwl92XM79Tahm4brEZ+THyL9l58rWr7HI2T4nxgukqHj8DDkJCh/5Nyq/rpAFSUM03lSRTTIb3F+l2/Dy5DN56coJsquPb4eK+ucGetBGxTN+aJNe4LM+88hCdzyZgK6OHwdUQ68FlkY8lE23PB4bhSuiOEM+9vkCN8mVCa9Bjmd3MbCOa2nTNoOi/VpgoTzfQLi+BiyNK2cR+fQMf4D4AM0TDnLMirrfA2RYA0jBffUNe0VCFl3N79nI+vou2goEdqRDb2aS4vxAX22yob3I/O/J/58Qw49Hb0BeBlyiqLrc/6E1B0P0FgzeiG/Fe79i2S4y91uy8rcN41F31BAcvZlrzx0Ed+83GVuE5toRHSA5vjjRS8dWBHNnZ3S0ApUEMe4xyFEI6/ZVYH2X0jWSR24ce46FSpBG+XKL5gHsLzp5HsJJT1PR7TqUC4UDfBKGhFCBkrUc89Qs41fIGYcWsY81KTiVIS8TPa9oO1D5/MhyGZDy7/YOFRipeNXf5PQPE/ORjRjegKSN1VSYv5p4K+zz8LcfRQ6X9Q3pN050+2c1/rohriCRNw5pUV7upvp92W/CZz7uPVxn9nL+rQrQzodI51A2+GPiBnDThpRkdx+ddt+MTmoY/OILsrj0TuoHH4NssHWE5Oy9a3JqZDy8XgAjbwquiYESACBv3fuNayyQTfonZz0DttGs9PyqPz+MpI4c57ieQ7Nm6hOOE+7L/f+rswq426XAuGKI+tQSESUCBV1YFEd1c5QJ63uOPWz+Rb36yc6eZ5b7phGJ+tASIB/R6Li/IbGjrHoPiHiSPoc5NhWB1Hq3DthACYcKwABYt+6jmLNrjp2fhBx+F0ujXr+WapFOBOJkKSmL0X1s4htn250h0nD3umczM8TXbR0nuxHHHweiRC1VguYCvxPIOZ1Z9PQjJTNl17KECWCuvjm66Paox2IQ3HTadaOHTvyY0I1Tmq3ewUNzeMg6tNraBQMnPJqHaARorEslN8vEXn5VYr71b1nO8i3Vdm6o2vPXMnvlg3dxINebhTI2AB4cfbaRWN9Uw1mL8a3u44+EnHUXy7ZoM/Jn+79ATEZfh2dxaPP13MY1oNWZV9Mfp+JzPPv09xHReOhH5ynHe72KSSy3/lZ+ZIVSdZzAmSM5l1uHm48Ye3gn2XvatPq2gtdgER9GLTJxm4kZqzCLPLScutuWrXiVyB2qvdCTF92URCBpGDDEyLH5ndHjvKupXkH6C7i7bwUbrjI1QD3iLEsROM3EW1O3yK/tIsCwh4iGX7PILeRyNWxyGRkOaFz8UZkTrvhWjuZJ2qS8Btk03VXRCOm2rG6cNa2K5krv0accR+DOJWqU26386Xdl9bFrc804kj3ImT+fpbGYtxKhukCHyJH4vdCbPK/Q+OEod/1aUeGtDM2dE7+PHsPnJfKRnW0NSX9GiCbnadkffsFRHa5be6uF636CBrhMXVM/RKZb6POdWrL+kdEg6b16ScWu39T269Ewp6rq46PTyG+JG8ELqbhfNju+NZ2uxnZ5Oc5gsqGHyEOnk9BfEL2MFjZ4GqFJ5H5fDIyv79GQ3GXHwfa71c5nymp1DF8C40T1+XaVO7L+sAtn2vKo2F2y+Z5iEQKegwyzz9Lg/Pl+6hf/bQYd3sxDdmTwHDaHZaiIHxSgjhGqplFProDyOKu36kt2TeQGKvPQxIjRMgA/DVirztIqCBJENu69zn1KFqwNL7yfqQzb0Z2zBcii8HFNDQ4umAvICD674LMrDsR27t3I05lJyIe5kci9pzraRyZt6qTvr/fKctqsY0rqruamvwe0Wqq1j1vTjFwlESI+SskQkxRNJCyOi4n1FzhOuBjiN2oxhnPQ8f8PCLYdyMk7HIkCsovEXLk2g02LV75/mqRxfj72WsDogm5HxKz+ygkvOxGxGxnKVmM9Sh7LqvP7Vk7XIpoXn5JIwSrbiab5lqLee/a3s8jG4/PI0f990c0UMcijslbs3qO0v8kbyCKmHbHofblqcjG6SREVqVZe30FGTcAsbsRy80NXZx/mr02I7bsD0IiCR0ObKFcDuoR9s+Q6B/QGKcXIprNlyK+FxVko3UJskjrJrTfJ5hlCbF043Z3hDgsSOKzUkLvthjjuxB/nH9F5ulDkHl7DMIFNiLjLj++3TXtw9m/i+y99TkxckLzVWS83A+ZS3dHzKO2tnhWJ9C6zSIhqm9DyOrvET7zKxpKwJayIYuiA3Ii/NisXXQdM8im493ZNcuxnrtc6R8Qy4FNTt+YrM7/nv2dlsxz16FT5/laJGLY/ZF5fieE72ykIb+XuiYuibsZJ1HIEYjwz8cf1n/PIQPNTT8/SLgEVhu6hky8N7CQcKiW89WISYKrRXR3xLqDqhV813fhVKC1WE/DxKIIaqYzi/RJ0XVqe9zUR23EBobGrq9I4zqCCJcRFpK7PAyyAWryJxhWYZ+1gY7rHyGLfVmkjTx0kd+LhGO6iJwwG4Z6O/3sOmuenb2349QMDXmwE1ng9kJ78fd7VHbFZhpOpkVljJH5MUtxkid34Wq6R6u+KiiHjo+ihUsdk0YojkzTLiwin7Q+ReECdd421afDGPRFDlYuImR90Pr0g6zrPWNEI3hvmsemzslfIAQ6r910/9YkRkVyvygPgItW/dpKDqoN820slKHu81XTqo6n7nrbc3mR1U/H+xmIyWPewU7b+TeI/NtHsxmH285dzfflkIMlY3zBvKfhNDyKjJ38+G65pnU4hvRZS51LFpFvKhvKTBtbyoaSaHt3Q/JHaOjaS2hENxq4EiqXw8AiioO7I4Q9RRSzvycnH5cwzwMa8m6EpZP1JXG3bjXrnR5TLhXuca6+p4jAeW32d74htRPOyf1Oy69/Jzt27EhyA0GF06AT+QQ4DrMdkmttE3dxotV98t/nEte4myLd4c1lr04IzXJs7AYJd1w9HyHqy2an3iZUg3YdjQgx7UZXGQYEiIYMaGueuGNZ6+/aMrfdR21mMXafMQVM9TileH5u6vwsPEHroD55Ypuf/zGiFdrfrzGdSxhS6/DnTeYKO3bsqLXIctmqHaA8O3VdDha1QcE6UrbupDt27JgvKJ/V+/ShjbX+v0DWzjxUVh+PmAz9JaKpzNcjf79WyCcQGjg6zKhcOL7bWdM6HEOlz+oUi8iGlM5lg1ohXJS98vde7vVc7bv30uB3bhlLNxNdyO9pYLpXc3Ep3K1TzfqxiD3TQDKY5ipWQcIzHowIk+cinrLa0C5cDcEJzjWuacJdEe3Bodm99yBH5GchO5+B7R4LJluZcMyj8JpelLfETrETIucSiZ6Vq19YgmZdtVOnAv/MkBP1XL9qWZ+DaNvaqe+waNaHYp60KJ+WsR9YbfUpekaKpP6+H51p1iPgochx9pbstzcjR92/pQO53sJWu1U7LJB7uc8PRxJaHYlo6/Yjx98/QJQ0fVl3cvLtGOTofYTiDbq2dw0x8foKQtqvQ+b7/GJlLNuE9LpeS2yPPBYb312tacstG9pt7xIe4pazpangIFCyMXHr3hXnWAZ517EMb4esuze/CEmwMUh7VkMja+dm5MjD3Y0UafmVQL0QOJ3GsZdOtrcBby+on0EcTJ9E5mA56ORPHsuDLsm6jrNPI859Q2f60qKuCiXsb0fmRVHceBc6T25BNrwDIesedwzkNOvtknWy6zciodkeSbHC6eNkMYsVA1LEqFx5EZIhsUqz4sggRPgpiA9CgGNv28NyQENGnY6E9swngVLkc25YxARkV/a+WFIstS++AHg9YqPr5YSHR5foxAzGIF6qwwA3GUEeKny+iQgktSFUIfUghJhYFtoppYiN5D8imnszYDMYj5UDdSj9MRJ3u246BcNL1LVsueRiITInjkZi0C5G2D08hgnq0PdGhKgXOR4bZJ7+ACH04Y4dOwbhIKdE/XAkeECVhXbFFvEb+SDi89JzQuvMeZVRf4to+A+jeL7nE2KFiD/V+g4eGyNOlVchEcbCiYmJeJhlo4fHsKLIk70V3DA5g3yp/ZAbhqkoc58S9QtZmBBEhffDsncVUPkXwIORI8KEwRz9eqwsqM33VQi5VXKw7JFf2kWujLqAvwg4l0as11ZYLCygh8egoGNVZbsbJk9fOsYfkb2bAYUk1PXjAUjggFbrzn2QpF9qk9sP6L1vBP4CcYTV07UiTbmGlyuygW5n3YaGKaqXFx4eXaJTgeDGmx3kKx/vEpqdntzsXN9BNAYa9zgvINZk70UkXD8bo/ho0GN1Q/t/Z/ZetLho2KdpJHbtjZQnnBpqOIRdF/AZ4JnA9ZQnTdI22Ys4T3p49Bqdkjq9fjx7byXbRwdcF33umjaurWavfkOVDechiindoOvpoBL3Irt7N359O2s3yCYFPFn38OgaLpl1w/6kQ/hyd+xq5+cKjKuAFwBPQOLq5r2WtZ6/z9XRdUrQ+l9FcdIDj1WKjLjqwvod56u8pkgXoBcidrNNWuiVoFUvgdbtWiRCzDQNjWReYwbieObGG/fw6BV0Hmo0mLycdr+Dxpy8InuPc9e7Jo+X648GNFe1vPrcfBhEt2w304iJ3RdTGAeqdPgDYnrzoqyMuqYWRS/Jn3S3s2aDBG/Qunt4eHQBJevqMPaD3HfD9HJ36wbZXFyGZJ96EhJv8zPkQi9CXUjp319FNAqqwXC9nvU48gNOG3jcAZAdievi8h/IWNJECO7pzjXAnyGJY5q0zyuRqJdkdzsHOZ36Pc3zL6CR8OVt2W9W3ImCx9BD5a4bli0fSODc3LUAH0IcH/Oy3SJmjVch6wVAMiAzGD31PQeJqqKb23zeEC3/NH3cABeYv6lS69PAcci8/zDi6DrJQqWYKwvbWbOhkTHck3UPjy6Rdyp5MZLZ7/jlLlgG1XZPI2GtdiJH9FciGoEraSQ8UbJdFqdSBeQMQrbegoR+PIBGBtPfI05A36LhmOpxx4GbCe2FwH8hKYm3ICctv0Cy32qykNWgUS/L7nYuEonjcUgovE1Zvc8G/o9ceFMPj14gG4u6AXwnYrbyBGT8GSSqyLdpZFJULXWAkMJHAG9CAgVsyL67DYkb/i4aacWXY9w+D3gdYit+MI0Mpn8EPoGET+37ulOQtdVdO3+YvQIkrPFdgbsgDrJuhs+ipEEu1LfslzQySiYrWU56eCwn/j+CiaqGeLsBkwAAACV0RVh0ZGF0ZTpjcmVhdGUAMjAxOS0xMS0xOVQwMTo0NzoyOC0wODowMNH+UBoAAAAldEVYdGRhdGU6bW9kaWZ5ADIwMTktMTEtMTlUMDE6NDc6MjgtMDg6MDCgo+imAAAAAElFTkSuQmCC';
                                // A documentation reference can be found at
                                // https://github.com/bpampuch/pdfmake#getting-started
                                // Set page margins [left,top,right,bottom] or [horizontal,vertical]
                                // or one number for equal spread
                                // It's important to create enough space at the top for a header !!!
                                doc.pageMargins = [40,70,30,40];
                                // Set the font size fot the entire document
                                doc.defaultStyle.fontSize = 10;
                                // Set the fontsize for the table header
                                doc.styles.tableHeader.fontSize = 10;
                                // Create a header object with 3 columns
                                // Left side: Logo
                                // Middle: brandname
                                // Right side: A document title
                                doc['header']=(function() {
                                    return {
                                        columns: [
                                            {
                                                image: logo,
                                                width: 70,
                                                margin:[35,0]
                                            },
                                            {
                                                alignment: 'left',
                                                italics: true,
                                                text: 'Bias HRIS | Laporan Kontrak Karyawan',
                                                fontSize: 18,
                                                margin: [40,0]
                                            },
                                            // {
                                            //     alignment: 'Center',
                                            //     fontSize: 12,
                                            //     text: 'Bias HRIS | Laporan Kontrak Karyawan'
                                            // }
                                        ],
                                        margin: 20,
                                    }
                                });
                                // Create a footer object with 2 columns
                                // Left side: report creation date
                                // Right side: current page and total pages
                                doc['footer']=(function(page, pages) {
                                    return {
                                        columns: [
                                            {
                                                alignment: 'left',
                                                text: ['Created on: ', { text: jsDate.toString() }]
                                            },
                                            {
                                                alignment: 'right',
                                                text: ['page ', { text: page.toString() },	' of ',	{ text: pages.toString() }]
                                            }
                                        ],
                                        margin: 20
                                    }
                                });
                                // Change dataTable layout (Table styling)
                                // To use predefined layouts uncomment the line below and comment the custom lines below
                                // doc.content[0].layout = 'lightHorizontalLines'; // noBorders , headerLineOnly
                                var objLayout = {};
                                objLayout['hLineWidth'] = function(i) { return .5; };
                                objLayout['vLineWidth'] = function(i) { return .5; };
                                objLayout['hLineColor'] = function(i) { return '#aaa'; };
                                objLayout['vLineColor'] = function(i) { return '#aaa'; };
                                objLayout['paddingLeft'] = function(i) { return 4; };
                                objLayout['paddingRight'] = function(i) { return 4; };
                                doc.content[0].layout = objLayout;
                        }
                        }]
                });
            });
        $(document).ready(function() { 
            $('#table3').DataTable( {
                scrollY:        '60vh',
                scrollCollapse: true,
                paging:         false
            } );
        } );

        // Multiple Table
        $(document).ready(function() {
            $('table.display').DataTable();
        } );

    // untuk time picker / pengambilan jam
        $(function(){
            $(".timepicker").timepicker({
            showInputs: false
            });
        });
    // untuk datepicker / pengambilan tanggal
        $('#sandbox-tanggal .input-group.date').datepicker({
            format: "dd-mm-yyyy",
            language: "id",
            todayHighlight: true,
            autoclose: true
        });
        
    // untuk Dropify
        $(document).ready(function(){
            $('.dropify').dropify({
                messages: {
                    default: 'Drag atau drop untuk memilih gambar',
                    replace: 'Ganti',
                    remove:  'Hapus',
                    error:   'error'
                }
            });
        });

        // Date range picker
        $(function() {

            var start = moment().subtract(29, 'days');
            var end = moment();

            function cb(start, end) {
                // $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                $('#reportrange span').html(start.format('YYYY-MM-DD') + ' - ' + end.format('YYYY-MM-DD'));
            }

            $('#reportrange').daterangepicker({
                startDate: start,
                endDate: end,
                // locale: id,
                ranges: {
                'Hari ini': [moment(), moment()],
                'Kemarin': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                '7 hari terakhir': [moment().subtract(6, 'days'), moment()],
                '30 hari terakhir': [moment().subtract(29, 'days'), moment()],
                'Bulan ini': [moment().startOf('month'), moment().endOf('month')],
                'Bulan Kemarin': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                }
            }, cb);

            cb(start, end);

        });
    // FLOT CHART
    $(function () {
        /*
        * DONUT CHART
        * -----------
        */
        // JENIS KELAMIN
        <?php $this->db->where('genre',"L");
            $this->db->from('tb_karyawan');
            $dataL = $this->db->count_all_results();
            
            $this->db->where('genre',"P");
            $this->db->from('tb_karyawan');
            $dataP = $this->db->count_all_results();
        ?>
        var donutData = [
        {label: "Laki-Laki", data: <?= $dataL  ?>, color: "#3c8dbc"},
        {label: "Perempuan", data: <?= $dataP  ?>, color: "#f3acb6"},
        // {label: "Series4", data: 50, color: "#00c0ef"}
        ];
        $.plot("#donut-chart", donutData, {
        series: {
            pie: {
            show: true,
            radius: 1,
            innerRadius: 0.4,
            label: {
                show: true,
                radius: 2 / 3,
                formatter: labelFormatter,
                threshold: 0.1
            }

            }
        },
        legend: {
            show: true,

        },
        grid: {
            hoverable: true,
            clickable: true
        }
        });
        // ./ JENIS KELAMIN END

        // STATUS PERNIKAHAN
        <?php $this->db->where('martial',"1"); //Menikah
            $this->db->from('tb_karyawan');
            $data1 = $this->db->count_all_results();
            
            $this->db->where('martial',"2"); //single
            $this->db->from('tb_karyawan');
            $data2 = $this->db->count_all_results();
        ?>
        var donutData2 = [
        {label: "Menikah", data: <?= $data1  ?>, color: "#da674a"},
        {label: "Single", data: <?= $data2  ?>, color: "#39998e"},
        // {label: "Series4", data: 50, color: "#00c0ef"}
        ];
        $.plot("#donut-chart2", donutData2, {
        series: {
            pie: {
            show: true,
            radius: 1,
            innerRadius: 0.4,
            label: {
                show: true,
                radius: 2 / 3,
                formatter: labelFormatter,
                threshold: 0.1
                }

            }
        },
        legend: {
            show: true,

        },
        grid: {
            hoverable: true,
            clickable: true
        }
        });

        // ./ STATUS PERNIKAHAN END
        /*
        * END DONUT CHART
        */

        });

        /*
        * Custom Label formatter
        * ----------------------
        */
        function labelFormatter(label, series) {
        return "<div style='font-size:13px; text-align:center; padding:2px; color: #fff; font-weight: 600;'>"
                // + label
                + "<br/>"
                + Math.round(series.percent) + "%</div>";
        };
        // ---------------------------
        // MORIS DONUT CHAT
        // CHART Untuk SBU
        $(function () {
            "use strict";            
            <?php $this->db->where('kode',"BDP");
            $this->db->where('kontrak !=',"F");
            $this->db->where('id_jab !=',"J000");
            $this->db->from('tb_karyawan');
            $this->db->join('tb_kontrak','tb_kontrak.email=tb_karyawan.email','left');
            $bdp = $this->db->count_all_results();
            
            $this->db->where('kode',"BM");
            $this->db->where('status',"Y");
            $this->db->from('tb_karyawan');
            $this->db->join('tb_kontrak','tb_kontrak.email=tb_karyawan.email','left');
            $bm = $this->db->count_all_results();

            $this->db->where('kode',"BS"); 
            $this->db->where('status',"Y");
            $this->db->from('tb_karyawan');
            $this->db->join('tb_kontrak','tb_kontrak.email=tb_karyawan.email','left');
            $bs = $this->db->count_all_results();

            $this->db->where('kode',"BSJ"); 
            $this->db->where('status',"Y");
            $this->db->from('tb_karyawan');
            $this->db->join('tb_kontrak','tb_kontrak.email=tb_karyawan.email','left');
            $bsj = $this->db->count_all_results();

            $this->db->where('kode',"PBS"); 
            $this->db->where('status',"Y");
            $this->db->from('tb_karyawan');
            $this->db->join('tb_kontrak','tb_kontrak.email=tb_karyawan.email','left');
            $pbs = $this->db->count_all_results();

            // $this->db->where('kode',"BSM"); 
            // $this->db->where('status',"Y");
            // $this->db->from('tb_karyawan');
            // $this->db->join('tb_kontrak','tb_kontrak.email=tb_karyawan.email','left');
            // $bsl = $this->db->count_all_results();

            $this->db->where('kode',"ESA"); 
            $this->db->where('status',"Y");
            $this->db->from('tb_karyawan');
            $this->db->join('tb_kontrak','tb_kontrak.email=tb_karyawan.email','left');
            $esa = $this->db->count_all_results();

            $this->db->where('kode',"BSM"); 
            $this->db->where('status',"Y");
            $this->db->from('tb_karyawan');
            $this->db->join('tb_kontrak','tb_kontrak.email=tb_karyawan.email','left');
            $bsm = $this->db->count_all_results();
        ?>
            //DONUT CHART
            var donut = new Morris.Donut({
            element: 'sbu-chart',
            resize: true,
            colors: ["#2294d6","#00a65a", "#f56954","#f0f02d","#4131f5","#fa3535","#ff5c38","#9e9593"],
            data: [
                {label: "BS", value: <?= $bs ?>},
                {label: "BM", value: <?= $bm ?>},
                {label: "BDP", value: <?= $bdp ?>},
                {label: "ESA", value: <?= $esa ?>},
                {label: "PBS", value: <?= $pbs ?>},
                {label: "BSJ", value: <?= $bsj ?>},
                {label: "BSM", value: <?= $bsm ?>}
            ],
            hideHover: 'auto'
            });            
        });        

        // Function untuk menghitung session timeout, dan otomatis update status (OFF) pada tb_login tanpa button logout
        var idSec = "<?= $this->fungsi->user_login()->id_lvl?>";
        if(idSec != "SC") {
            var mins = 15 * 60; //second 
            var active = setTimeout("logout()",(mins*1000)); //active minutes
            function logout()
            {
                location='<?=base_url();?>Auth/sessionOff'; // <-- put your controller function here to destroy the session object and redirect the user to the login page.
            }
        }

        // blink text
		var x=1;
		function blink(id) {
			document.getElementById(id).style.width="300px";
			if(x==1){
				document.getElementById(id).style.backgroundColor = "aqua";
				x=2;
			} else {
				document.getElementById(id).style.backgroundColor = "";
				x=1;
			}
		}
		// window.onload=function(){
		// setInterval("blink('alert')", 500);}

		var blink_speed = 500; // every 1000 == 1 second, adjust to suit
		var t = setInterval(function () {
            var ele = document.getElementById('blink-text');
            ele.style.visibility = (ele.style.visibility == 'hidden' ? '' : 'hidden');
		}, blink_speed);

        // Alert hilang sendiri 
        window.setTimeout(function () {
            $(".alert-dismissable").fadeTo(500, 0).slideUp(500, function () {
                $(this).remove();
            });
        }, 5000);

    </script>
</body>
</html>