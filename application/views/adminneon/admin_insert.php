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

                <form role="form" enctype="multipart/form-data" name="admininsert" class="form-horizontal form-groups-bordered" method="post" action="<?php echo base_url(); ?>index.php/adminneon_c/adminform_insert">

                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label">First Name</label>

                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="admin_firstname" placeholder="First Name">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label">Last Name</label>

                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="admin_lastname" placeholder="Last Name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label">Image</label>

                        <div class="col-sm-5">
                            <input type="file" class="form-control" name="admin_image" placeholder="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label">Email id</label>

                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="admin_email" placeholder="Email id">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label">Contact</label>

                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="admin_contact" placeholder="Contact">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="field-3" class="col-sm-3 control-label">Password</label>

                        <div class="col-sm-5">
                            <input type="password" class="form-control" name="admin_password" placeholder="Password">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">Date</label>

                        <div class="col-sm-3">
                            <div class="input-group">
                                <input type="text" name="date" class="form-control datepicker" data-format="D, dd MM yyyy">

                                <div class="input-group-addon">
                                    <a href="#"><i class="entypo-calendar"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="panel-body">
                        <input type="submit" class="btn btn-blue" name="submit" value="SUBMIT">
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