<?php
include 'header.php';
?>		
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/datatables/datatables.css">

<h3>Table without DataTable Header</h3>


<a href="<?php echo base_url();?>index.php/adminneon_c/ch_admin_insert" class="btn btn-primary">
    <i class="entypo-plus"></i>
    Add New
</a>
<br></br>
<table class="table table-bordered table-striped datatable" id="table-2">
    <thead>
        <tr>
            <th>
    <div class="checkbox checkbox-replace">
        <input type="checkbox" id="chk-1">
    </div>
</th>

<th>Name</th>
<th>Image</th>
<th>Mobile no</th>
<th>Password</th>
<th>Email Id</th>
<th>Profile</th>
<th>Actions</th>

</tr>

<?php foreach($ADMINS as $admin){?>
</thead>

<tbody>

    <tr>
        <td>
            <div class="checkbox checkbox-replace">
                <input type="checkbox" id="chk-1">
            </div>
        </td>
        
        <td><?php echo $admin->admin_firstname;?></td>
<!--        <td><img src="<?php echo base_url('uploads/image/'.$admin->admin_image );?>" height="100px" width="100px" /></td>-->
        <td><?php echo $admin->admin_contact;?></td>
        <td><?php echo $admin->admin_password;?></td>
        <td><?php echo $admin->admin_email;?></td>
        <td><?php echo $admin->admin_password;?></td>
        <td>
            <a href="<?php echo base_url();?>index.php/adminneon_c/update_admin/<?php echo $admin->admin_id; ?>" class="btn btn-default btn-sm btn-icon icon-left">
                <i class="entypo-pencil"></i>
                Edit
            </a>

            <a href="<?php echo base_url();?>index.php/adminneon_c/delete/<?php echo $admin->admin_id; ?>" class="btn btn-danger btn-sm btn-icon icon-left">
                <i class="entypo-cancel"></i>
                Delete
            </a>

            <a href="#" class="btn btn-info btn-sm btn-icon icon-left">
                <i class="entypo-info"></i>
                Profile
            </a>
        </td>
    </tr>

   <?php }?>
</tbody>
</table>

<br />


<br />
<br />

<script src="<?php echo base_url(); ?>assets/js/datatables/datatables.js"></script>


<?php
include 'footer.php';
?>