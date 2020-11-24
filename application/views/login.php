<!DOCTYPE html>
<html lang="en">

<head>
    <title>Bioquest User Login</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/bootstrap.min.css" />

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
                <h1 class="mb-3 text-center">User Login</h1>
                <form class="mb-3" name="login" id="login" method="post" action="<?php echo base_url()?>AuthLogin/UserLogin">
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" placeholder="Enter Your Email Id" name="user_email" id="email" required />
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" class="form-control" id="password" placeholder="Minimum 8 charcter with alphanumerical" name="user_password" pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$" required />
                    </div>
                    <button type="submit" class="btn btn-primary btn-block mb-3">
                        Next
                    </button>
                    <div class="text-center">
                        <p>or ...</p>
                        <a href="#" class="btn btn-success">Signup</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="<?php echo base_url() ?>assets/js/bootstrap.min.js"></script>

</body>

</html>