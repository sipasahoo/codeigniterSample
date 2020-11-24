<!DOCTYPE html>
<html>
<head>
   <title>Manage User</title>
   <script src="<?php echo base_url()?>assets/js/jquery.min.js"></script>
   <script src="<?php echo base_url()?>assets/js/bootstrap.min.js"></script>

   <link rel="stylesheet" type="text/css" href="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/css/jquery.dataTables.css">
   <script type="text/javascript" charset="utf8" src="https://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/jquery.dataTables.min.js"></script>
   <link rel="stylesheet" href="<?php echo base_url()?>assets/css/bootstrap.min.css" />
	<link rel="stylesheet" href="<?php echo base_url()?>assets/css/jquery-ui.min.css" />
</head>
<body>


<div class="container ">
<?php if($this->session->flashdata('success')){ ?>
          <div class="alert alert-success">
              <a href="#" class="close" data-dismiss="alert">&times;</a>
              <strong>Success!</strong> <?php echo $this->session->flashdata('success'); ?>
          </div>

      <?php } else if($this->session->flashdata('error')){  ?>

          <div class="alert alert-danger">
              <a href="#" class="close" data-dismiss="alert">&times;</a>
              <strong>Error!</strong> <?php echo $this->session->flashdata('error'); ?>
          </div>

      <?php } else if($this->session->flashdata('warning')){  ?>

          <div class="alert alert-warning">
              <a href="#" class="close" data-dismiss="alert">&times;</a>
              <strong>Warning!</strong> <?php echo $this->session->flashdata('warning'); ?>
          </div>

      <?php } else if($this->session->flashdata('info')){  ?>

          <div class="alert alert-info">
              <a href="#" class="close" data-dismiss="alert">&times;</a>
              <strong>Info!</strong> <?php echo $this->session->flashdata('info'); ?>
          </div>
      <?php } ?>
  <h2>User DashBoard
  <a class="btn btn-primary" style="float:right" href="<?php echo base_url()?>AuthLogin/AddUser">Add User</a></h2>
  <table id="my-example" border="1">
    <thead>
      <tr>
          <th>Id</th>          
          <th>Name</th>
          <th>User Name</th>
          <th>Email</th>
          <th>User Role</th>
          <th>Country</th>
          <th>Region</th>
          <th>Division</th>
      </tr>     
    </thead>
    <tbody>
        <?php
        $count=1; 
        for($i=0;$i<count($getallusers);$i++) {
        ?>
        <tr>
            <td><?php echo $count;?></td>
            <td><?php echo $getallusers[$i]->name;?></td>
            <td><?php echo $getallusers[$i]->user_name;?></td>
            <td><?php echo $getallusers[$i]->user_email;?></td>
            <td><?php echo $getallusers[$i]->user_role==1?'Admin':'Guest User';?></td>
            <td><?php echo $getallusers[$i]->user_country;?></td>
            <td><?php echo $getallusers[$i]->user_region;?></td>
            <td><?php echo $getallusers[$i]->user_division;?></td>
        </tr>
        <?php 
        $count++ ; }
        ?>
    </tbody>
  </table>
</div>


</body>


<script type="text/javascript">
  $(document).ready(function() {
      $('#my-example').dataTable({
        "responsive": true,
      "autoWidth": false,
      });  
  });
</script>
</html>