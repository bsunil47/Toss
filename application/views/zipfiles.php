<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from thevectorlab.net/slicklab/form-layout.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 21 Dec 2015 07:04:39 GMT -->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Mosaddek">
    <meta name="keyword" content="slick, flat, dashboard, bootstrap, admin, template, theme, responsive, fluid, retina">
    <link rel="shortcut icon" href="javascript:;" type="image/png">

    <title>form layout</title>

   <?php include_once("includes/admin_header_links.php");?>
</head>

<body class="sticky-header">

    <section>
        <!-- sidebar left start-->
        <?php include_once("includes/admin_leftmenu.php");?>
        <!-- sidebar left end-->

        <!-- body content start-->
        <div class="body-content" style="min-height: 1000px;">

            <!-- header section start-->
            <?php include_once("includes/admin_header.php");?>
            <!-- header section end-->

            <!-- page head start-->
            <!--<div class="page-head">
                <h3 class="m-b-less">
                    Form Layout
                </h3>
                <!--<span class="sub-title">Welcome to Static Table</span>
                <div class="state-information">
                    <ol class="breadcrumb m-b-less bg-less">
                        <li><a href="#">Home</a></li>
                        <li><a href="#">Form</a></li>
                        <li class="active">Form Layout</li>
                    </ol>
                </div>
            </div>-->
            <!-- page head end-->

            <!--body wrapper start-->
            <div class="wrapper">

            
            
            
            <div class="row">
            <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Vendor Zipfile Upload
                </header>
                <div class="panel-body">
                    <form action="<?php echo  base_url() ?>admin/zipfiles" name="upload_vendor" method="POST" id="add_price" class="form-horizontal tasi-form" enctype="multipart/form-data">
                      
						<?php if($this->session->flashdata('success')){?>
						<div class="alert alert-success alert-block fade in">
                        <button type="button" class="close close-sm" data-dismiss="alert">
                            <i class="fa fa-times"></i>
                        </button>
                        <h4>
                            <i class="fa fa-ok-sign"></i>
                            Success!
                        </h4>
                        <p><?php echo  $this->session->flashdata('success');?></p>
                    </div>
				
						<?php }if($this->session->flashdata('error')){ ?>
						<div class="alert alert-error alert-block fade in">
                        <button type="button" class="close close-sm" data-dismiss="alert">
                            <i class="fa fa-times"></i>
                        </button>
                        <h4>
                            <i class="fa fa-ok-sign"></i>
                            Error!
                        </h4>
                        <p><?php echo  $this->session->flashdata('error');?></p>
                    </div>
                                                <?php }?>
						<div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Upload Zip File</label>
                            <div class="col-sm-10">
                                <input type="file" name="vupload" id="vupload">
                                <?php echo form_error('vupload')?>
                                
                            </div>
							
                        </div>
                                                        
                      <div class="form-group">
                            <label class="col-lg-2 col-sm-2 control-label">&nbsp;</label>
                            <div class="col-lg-10">
						<button class="btn btn-info" type="submit" name="vendorsubmit">Submit</button>
						</div>
                        </div>
                        
							
                    </form>
                </div>
            </section>
            
            

            

            </div>
            </div>

            </div>
            <!--body wrapper end-->
<?php include_once("includes/admin_footer.php");?>


</body>

<!-- Mirrored from thevectorlab.net/slicklab/form-layout.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 21 Dec 2015 07:04:39 GMT -->
</html>
