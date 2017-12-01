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

<th>EMP_ID</th>
<th>EMP_NAME</th>

</tr>

<?php foreach($EMP as $admin){?>
</thead>

<tbody>

    <tr>
        <td>
            <div class="checkbox checkbox-replace">
                <input type="checkbox" id="chk-1">
            </div>
        </td>
        
        <td><?php echo $admin->emp_id;?></td>
        <td><?php echo $admin->emp_name;?></td>
        <td>
            <a href="<?php echo base_url();?>index.php/adminneon_c/Update_emp_master/<?php echo $admin->emp_id; ?>" class="btn btn-default btn-sm btn-icon icon-left">
                <i class="entypo-pencil"></i>
                Edit
            </a>

            <a href="<?php echo base_url();?>index.php/adminneon_c/empdelete/<?php echo $admin->emp_id; ?>" class="btn btn-danger btn-sm btn-icon icon-left">
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