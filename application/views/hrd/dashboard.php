<!-- DASHBOARD HRD -->
<!-- ditampilkan hanya untuk anggota HR Departement -->
<!-- ================================================ -->

<!-- Breadcumb section -->
<section class="content-header">
    <h1>
        <div class="icon">
        <i class="fa fa-dashboard"></i> Dashboard
        <small>Pusat Informasi HRD Department</small>
        </div>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>Hrd"><i class="fa fa-dashboard"></i> Central Info HR</a></li>
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
            Kamu berada dalam mode khusus HRD. Semoga harimu menyenangkan
        </div><!-- /.box-body -->
        <!-- <div class="box-footer">
            Footer
        </div>/.box-footer -->
    </div>
<!-- /.box -->
<!-- =========================================================== -->

<div class="row">
<!-- Donat chart -->
    <div class="col-md-6">
        <!-- Chart Jenis Kelamin -->
        <div class="box box-primary">
            <div class="box-header">
            <i class="fa fa-pie-chart "></i><h3 class="box-title">Jenis Kelamin</h3>
            </div><!-- /.box-header -->
            <div class="container pull-left">
                <small>Laki-Laki : 
                <?php $this->db->where('status',"Y"); //Menikah
                $this->db->where('tb_karyawan.genre',"L");
                $this->db->where('tb_karyawan.email !=',"admin@batam-samudra.id"); //Menikah
                $this->db->from('tb_karyawan');
                $this->db->join('tb_kontrak','tb_kontrak.email=tb_karyawan.email','left');
                echo $this->db->count_all_results() ?> orang
                </small>                
            </div>
            <div class="container pull-left">
                <small>Perempuan : 
                <?php $this->db->where('status',"Y"); //Menikah
                $this->db->where('tb_karyawan.genre',"P");
                $this->db->where('tb_karyawan.email !=',"admin@batam-samudra.id"); //Menikah
                $this->db->from('tb_karyawan');
                $this->db->join('tb_kontrak','tb_kontrak.email=tb_karyawan.email','left');
                echo $this->db->count_all_results() ?> orang
                </small>                
            </div>
            <div class="box-body">
                <div id="donut-chart" style="width:100%;height: 200px;"></div>                
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <!-- Chart Status Pernikahan -->
        <div class="box box-primary">
            <div class="box-header">
            <i class="fa fa-pie-chart "></i><h3 class="box-title">Status Pernikahan</h3>
            </div><!-- /.box-header -->
            <div class="container pull-left">
                <small>Menikah : 
                <?php $this->db->where('status',"Y"); //Menikah
                $this->db->where('tb_karyawan.martial',"1");
                $this->db->where('tb_karyawan.email !=',"admin@batam-samudra.id"); //Menikah
                $this->db->from('tb_karyawan');
                $this->db->join('tb_kontrak','tb_kontrak.email=tb_karyawan.email','left');
                echo $this->db->count_all_results() ?> orang
                </small>                
            </div>                                                             
            <div class="container pull-left">
                <small>Single : 
                <?php $this->db->where('status',"Y"); //Single
                $this->db->where('tb_karyawan.martial',"2");
                $this->db->where('tb_karyawan.email !=',"admin@batam-samudra.id"); //Single
                $this->db->from('tb_karyawan');
                $this->db->join('tb_kontrak','tb_kontrak.email=tb_karyawan.email','left');
                echo $this->db->count_all_results() ?> orang
                </small>                
            </div>
            
            <div class="box-body">
                <div id="donut-chart2" style="width:100%;height: 200px;"></div>                
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <!-- DONUT CHART -->
        <div class="box box-danger">
            <div class="box-header">
            <i class="fa fa-pie-chart "></i><h3 class="box-title">Jumlah Karyawan per SBU</h3>
            </div>
            <div class="container">
                <small>Total Karyawan : 
                <?php $this->db->where('status',"Y"); //Menikah
                $this->db->where('email !=',"admin@batam-samudra.id"); //Menikah
                $this->db->from('tb_kontrak');
                echo $this->db->count_all_results() ?> orang
                </small>
            </div>
            <div class="box-body chart-responsive">
                <div class="chart" id="sbu-chart" style="height: 500px; position: relative;"></div>
            </div><!-- /.box-body -->
        </div><!-- /.box -->

    </div>
</div>

</section><!-- /.content -->
