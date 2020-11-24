<!DOCTYPE html>
<html lang="en">

<head>
	<title>Add User</title>
	<!-- Required meta tags -->
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="<?php echo base_url()?>assets/css/bootstrap.min.css" />
	<link rel="stylesheet" href="<?php echo base_url()?>assets/css/jquery-ui.min.css" />

</head>

<body>
	<div class="container">
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
		<div class="row">
			<div class="col-12 col-sm-8 col-md-6 col-lg-4 offset-sm-2 offset-md-3 offset-lg-4">
				<h1 class="mb-3 text-center">Add User</h1>
			
				<form class="mb-3" name="add_user" id="add_user"  method="post" action="<?php echo base_url()?>AuthLogin/insert_guest_user">
					<div class="form-group"> 	
						<label for="name">Name:</label>
						<input type="text" class="form-control" placeholder="Enter Your Name" name="name"  id="name" required />
					</div>
					<div class="form-group">
						<label for="email">Email:</label>
						<input type="email" class="form-control" placeholder="Enter Your Email Id" id="email" name="email" required />
					</div>
					<div class="form-group">
						<label for="name">Region:</label>
						<input type="text" class="form-control" placeholder="Enter User Name" id="region" name="region" required />
					</div>
					<div class="form-group">
						<label for="name">Country:</label>
						<input type="text" class="form-control" placeholder="Enter User Name" id="country" name="country" required />
					</div>
					<div class="form-group">
						<label for="name">Division:</label>
						<input type="text" class="form-control" placeholder="Enter User Name" id="division" name="division" required />
					</div>
					<div class="form-group">
						<label for="inputName">Role</label>
						<select class="form-control custom-select" id="brand_status" name="role_id" required>                    
							<option selected disabled>Select one</option>
							<option value="2">Guest User</option>
							<option value="1">Admin</option>
						</select>
					</div>
					<button type="submit" class="btn btn-primary btn-block mb-3">
						Register
					</button>

					
				</form>
			</div>
		</div>
	</div>

	<script src="<?php echo base_url()?>assets/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url()?>assets/js/jquery.min.js"></script>
	<script src="<?php echo base_url()?>assets/js/jquery-ui.min"></script>
</body>

</html>