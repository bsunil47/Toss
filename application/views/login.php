<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from thevectorlab.net/slicklab/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 21 Dec 2015 07:05:44 GMT -->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Admin Template">
    <meta name="keywords" content="admin dashboard, admin, flat, flat ui, ui kit, app, web app, responsive">
    <link rel="shortcut icon" href="img/ico/favicon.png">
    <title>Login</title>

    <!-- Base Styles -->
    <link href="<?php echo base_url() ?>css/style.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>css/style-responsive.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="http://localhost/toss/js/html5shiv.min.js"></script>
    <script src="http://localhost/toss/js/respond.min.js"></script>
    <![endif]-->


</head>

  <body class="login-body">

      <div class="login-logo">
          <img src="<?php echo base_url() ?>img/logo-icon2.png" alt=""/>
		  <span class="brand-name"></span>
      </div>

      <h2 class="form-heading">login</h2>
      <div class="container log-row">
         <form action="<?php echo base_url() ?>admin" name="loginfrm" class="form-signin" method="POST" >
		  
              <div class="login-wrap">
			  
                 <input type="text" class="form-control" name="email1" value="<?php if(!empty($this->input->post('email1'))){echo $this->input->post('email1');}else{echo "";}?>" placeholder="Username" autofocus autocomplete="off">
				 <?php echo form_error('email1'); ?>
                  <input type="password" class="form-control" name="password1" placeholder="Password">
				  <?php echo form_error('password1'); ?>
				  <?php
					if($this->session->flashdata('error')){?>
				<div class="error"><?php echo  $this->session->flashdata('error');?></div>
				
			<?php }?>
			
                  <input type="submit" name="loginsubmit" class="btn btn-lg btn-success btn-block" value="LOGIN" />
                  <!--<div class="login-social-link">
                      <a href="index-2.html" class="facebook">
                          Facebook
                      </a>
                      <a href="index-2.html" class="twitter">
                          Twitter
                      </a>
                  </div>-->
                  <label class="checkbox-custom check-success">
                      <input type="checkbox" value="remember-me" id="checkbox1"> <label for="checkbox1">Remember me</label>
                      <a class="pull-right" data-toggle="modal" href="#forgotPass"> Forgot Password?</a>
                  </label>

                  <!--<div class="registration">
                      Don't have an account yet?
                      <a class="" href="registration.html">
                          Create an account
                      </a>
                  </div>-->

              </div>

              <!-- Modal -->
              <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="forgotPass" class="modal fade">
                  <div class="modal-dialog">
                      <div class="modal-content">
                          <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                              <h4 class="modal-title">Forgot Password ?</h4>
                          </div>
                          <div class="modal-body">
                              <p>Enter your e-mail address below to reset your password.</p>
                              <input type="text" name="email" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix">

                          </div>
                          <div class="modal-footer">
                              <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
                              <button class="btn btn-success" type="button">Submit</button>
                          </div>
                      </div>
                  </div>
              </div>
              <!-- modal -->

          </form>
      </div>


      <!--jquery-1.10.2.min-->
      <script src="<?php echo base_url() ?>js/jquery-1.11.1.min.js"></script>
      <!--Bootstrap Js-->
      <script src="<?php echo base_url() ?>js/bootstrap.min.js"></script>
      <script src="<?php echo base_url() ?>js/jrespond..min.html"></script>

  </body>

<!-- Mirrored from thevectorlab.net/slicklab/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 21 Dec 2015 07:05:47 GMT -->
</html>
