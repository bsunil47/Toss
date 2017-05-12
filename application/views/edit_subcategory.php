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

    <title>TOSS</title>
	
<?php $this->load->view("includes/admin_header_links");?>

</head>

<body class="sticky-header">

    <section>
        <!-- sidebar left start-->
        <?php $this->load->view("includes/admin_leftmenu");?>
        <!-- sidebar left end-->

        <!-- body content start-->
        <div class="body-content" style="min-height: 1000px;">

            <!-- header section start-->
            <?php $this->load->view("includes/admin_header");?>
            <!-- header section end-->

            <!-- page head start-->
            <div class="page-head">
                <h3 class="m-b-less">
                    Edit Sub Category
                </h3>
                <!--<span class="sub-title">Welcome to Static Table</span>-->
                <div class="state-information">
                    <ol class="breadcrumb m-b-less bg-less">
                        <li><a href="<?php echo base_url();?>admin/dashboard">Home</a></li>
                        <li><a href="<?php echo base_url();?>admin/managesubcategories">Sub Categories</a></li>
                        <li class="active">Edit Sub Category</li>
                    </ol>
                </div>
            </div>
            <!-- page head end-->

            <!--body wrapper start-->
            <div class="wrapper">

            <?php if($this->session->flashdata('update_error_subcat')){?>
						<div class="alert alert-success alert-block fade in">
                        <button type="button" class="close close-sm" data-dismiss="alert">
                            <i class="fa fa-times"></i>
                        </button>
                        <h4>
                            <i class="fa fa-ok-sign"></i>
                            Success!
                        </h4>
                        <p><?php echo  $this->session->flashdata('update_error_subcat');?></p>
                    </div>
				
						<?php }?>
            <?php if($this->session->flashdata('update_subcat_error')){?>
						<div class="alert alert-block alert-danger fade in">
                        <button type="button" class="close close-sm" data-dismiss="alert">
                            <i class="fa fa-times"></i>
                        </button>
                        <h4>
                            <i class="fa fa-ok-sign"></i>
                            Warning!
                        </h4>
                        <p><?php echo  $this->session->flashdata('update_subcat_error');?></p>
                    </div>
				
						<?php }?>
            
            <div class="row">
            <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                   
                </header>
                <div class="panel-body">
                    <form action="<?php echo  base_url() ?>admin/editsubcategorydetails" name="add_subcat" method="POST" id="cat_frm" class="form-horizontal tasi-form" enctype="multipart/form-data">
                      
					  <!--<div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">User Type</label>
                            <div class="col-sm-10">
                                <select class="form-control m-b-10" name="usertype">
									   <option value="">--Select User--</option>
                                    <option value="1">Vendor</option>
									   <!--<option value="2">Manager</option>
                                    <option value="4">User</option>
                                </select>
								<?php //echo form_error('usertype')?>
                            </div>
							
                        </div>-->
						
						
						<div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">categories</label>
                            <div class="col-sm-10">
                                <select id="multiple" class="select2-multiple form-control m-b-10" name="category_id[]" multiple>
									   
									   <option value="">--Select Category--</option>
									   <?php foreach($getallcategories as $getcategory) { ?>
                                    <option value="<?php echo $getcategory->category_id;?>"<?php if($getcategory->category_id==$editsubcatinfo->category_id){?>selected<?php } ?>><?php echo $getcategory->category_name;?></option>
									   <?php } ?>
                                    
                                </select>
								<?php echo form_error('category_id')?>
                            </div>
						</div>
						<div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">SubCategory Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="subcat_name" value="<?php echo $editsubcatinfo->sub_category_name;?>">
								<?php echo form_error('subcat_name')?>
                            </div>
							
                        </div>
						<div class="form-group clearfix">
						<?php if($this->session->flashdata('error')){?>
						<div id="msg"><?php echo  $this->session->flashdata('error');?></div>
						<?php }?>
						
                            <label class="col-lg-2 col-sm-2 control-label">Sub Category Image</label>
                            <div class="col-lg-10">
							<!--<input type="file" id="file-2" name="s_pan" class="file"  multiple=true>-->
							<div class="col-lg-5">
                                <input type="file" name="sub_category_image" multiple=true>
								</div>
								<div class="col-lg-5">
								<img src="<?php echo base_url()?>images/categories/<?php echo $editsubcatinfo->sub_category_image;?>" name="facility_image" width="auto" height="100"/>
								</div>
                            </div>
                        </div>
                      <div class="form-group">
                            <label class="col-lg-2 col-sm-2 control-label">&nbsp;</label>
                            <div class="col-lg-10">
							<input type="hidden" name="subcat_id" value="<?php echo $editsubcatinfo->sub_category_id;?>">
						<button class="btn btn-info" type="submit" name="subcatsubmit">Submit</button>
						</div>
                        </div>
                        <!--<div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Disabled</label>
                            <div class="col-sm-10">
                                <input class="form-control" id="disabledInput" type="text" placeholder="Disabled input here..." disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Placeholder</label>
                            <div class="col-sm-10">
                                <input type="text"  class="form-control" placeholder="placeholder">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-lg-2 col-sm-2 control-label">Static control</label>
                            <div class="col-lg-10">
                                <p class="form-control-static">email@example.com</p>
                            </div>
                        </div>

                        
							
								
                        <div class="form-group">
                            <label class="col-lg-2 col-sm-2 control-label">Textarea</label>
                            <div class="col-lg-10">
                                <textarea name="" class="form-control" id="" cols="30" rows="10"></textarea>
                            </div>
                        </div>-->
							
                    </form>
                </div>
            </section>
            <!-- <section class="panel">
                <div class="panel-body">
                    
                       <div class="form-group has-success">
                            <label class="col-sm-2 control-label col-lg-2" for="inputSuccess">Input with success</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" id="inputSuccess">
                            </div>
                        </div>
                        <div class="form-group has-warning">
                            <label class="col-sm-2 control-label col-lg-2" for="inputWarning">Input with warning</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" id="inputWarning">
                            </div>
                        </div>
                        <div class="form-group has-error">
                            <label class="col-sm-2 control-label col-lg-2" for="inputError">Input with error</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" id="inputError">
                            </div>
                        </div>
                    
                </div>
            </section>
            <section class="panel">
                <div class="panel-body">
                    
                        <div class="form-group">
                            <label class="col-sm-2 control-label col-lg-2" for="inputSuccess">Control sizing</label>
                            <div class="col-lg-10">
                                <input class="form-control input-lg m-b-10" type="text" placeholder=".input-lg">
                                <input class="form-control m-b-10" type="text" placeholder="Default input">
                                <input class="form-control input-sm m-b-10" type="text" placeholder=".input-sm">

                                <select class="form-control input-lg m-b-10">
                                    <option>Option 1</option>
                                    <option>Option 2</option>
                                    <option>Option 3</option>
                                </select>
                                
                                <select class="form-control input-sm m-b-10">
                                    <option>Option 1</option>
                                    <option>Option 2</option>
                                    <option>Option 3</option>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
            </section>-->
            

            

            </div>
            </div>

            </div>
            <!--body wrapper end-->
<?php $this->load->view("includes/admin_footer")?>


</body>

<!-- Mirrored from thevectorlab.net/slicklab/form-layout.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 21 Dec 2015 07:04:39 GMT -->
</html>
