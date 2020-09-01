<!-- DASHBOARD HRD -->
<!-- ditampilkan hanya untuk anggota HR Departement -->
<!-- ================================================ -->
<!-- Breadcumb section -->
<section class="content-header">
    <h1>
        <div class="icon">
        <i class="fa fa-dashboard"></i> Dashboard
        <small>Developer Mode</small>
        </div>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>Developer"><i class="fa fa-dashboard"></i> Developer</a></li>
</section>

<!-- Main content -->
<section class="content">

<!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Hello Bos! <b> </b> Welcome Back</h3> 
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
            </div>
        </div>
        <div class="box-body">
            Enjoy your day.. every day is improvement! 
        </div><!-- /.box-body -->
        <div class="box-footer">
            We working on version <b>19.03</b> now.
        </div>
        <!-- /.box-footer -->
    </div>
<!-- /.box -->
<div class="row">
    <div class="col-md-12">
        <!-- TABLE: LATEST ORDERS -->
        <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">Latest Development</h3>
            <a href="javascript:(void)" id="newOrder" data-toggle="modal" data-target="#orderModal" class="btn btn-sm btn-info btn-flat pull-right">Place New Order</a>
        </div><!-- /.box-header -->
        <div class="box-body">
            <div class="table-responsive">
            <table class="table no-margin" id="tablehistory">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Date</th>
                    <th>Description</th>
                    <!-- <th>On Version</th> -->
                </tr>
                </thead>
                <tbody>
                <?php $no=1; foreach($rowjob as $data){ ?>
                <tr>
                    <td><?=$no++?></td>
                    <td><?=$data->tgl?></td>
                    <td><?=$data->rinci?></td>
                </tr>
                <?php }?>
                </tbody>
            </table>
            </div><!-- /.table-responsive -->
        </div><!-- /.box-body -->
        <div class="box-footer clearfix">
            
            <!-- <a href="javascript::;" class="btn btn-sm btn-default btn-flat pull-right">View All Orders</a> -->
        </div><!-- /.box-footer -->
        </div><!-- /.box -->
    </div><!-- /.col -->
    <div class="col-md-4">
        <!-- PRODUCT LIST -->
        
    </div><!-- /.col -->
</div>
<!-- =========================================================== -->

</section><!-- /.content -->

<!-- Modal Detail  -->
<div id= "orderModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><i class="ion ion-ios-gear-outline text-danger"></i> Add History Development </h4>
                </div>
                <form action="<?= site_url('Developer/addJob')?>" method="post">
                <div class="modal-body" id="detailBody">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="job" >Job Updating </label> <small class="text-danger"> *</small>
                            <div class="input-group">
                                <textarea name="job" id="job" class="form-control" cols="30" rows="2"></textarea>
                                <div class="input-group-addon bg-aqua">
                                    <i class="ion ion-ios-gear-outline "></i>                      
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-default pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Tutup</button> 
                    <button type="submit" name="simpan" class="btn btn-info pull-right" ><i class="fa fa-send"></i> Simpan</button> 
                </div>
                </form>
            </div>            
        </div>
    </div>

<!-- ./ Modal Detail  -->