<?php
include 'header.php';
?>

<div class="row">
    <div class="col-md-12">

        <div class="panel panel-primary" data-collapsed="0">

            <div class="panel-heading">
                <div class="panel-title">
                    Default Form Inputs
                </div>

                <div class="panel-options">
                    <a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
                    <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
                    <a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
                    <a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
                </div>
            </div>

            <div class="panel-body">

                <form role="form" enctype="multipart/form-data" name="emp" class="form-horizontal form-groups-bordered" method="post" action="<?php echo base_url(); ?>index.php/adminneon_c/Update_emp_master">

                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label">EMP NAME</label>

                        <div class="col-sm-5">
                             <input type="hidden" class="form-control" name="emp_id" value="<?php echo $empDetails->emp_id; ?>" placeholder="">
                            <input type="text" class="form-control" name="emp_name" value="<?php echo $empDetails->emp_name; ?>" placeholder="name">
                        </div>
                    </div>

                    <div class="panel-body">

                        <input type="submit" class="btn btn-blue" name="submit" value="Update">

                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<script src="<?php echo base_url(); ?>assets/js/bootstrap-datepicker.js"></script>
<?php
include 'footer.php';
?>