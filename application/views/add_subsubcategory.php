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
                    Add Sub Category
                </h3>
                <!--<span class="sub-title">Welcome to Static Table</span>-->
                <div class="state-information">
                    <ol class="breadcrumb m-b-less bg-less">
                        <li><a href="<?php echo base_url();?>admin/dashboard">Home</a></li>
                        <li><a href="<?php echo base_url();?>admin/managesubcategories">Sub Categories</a></li>
                        <li class="active">Add Sub Category</li>
                    </ol>
                </div>
            </div>
            <!-- page head end-->

            <!--body wrapper start-->
            <div class="wrapper">

            
            
            
            <div class="row">
            <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    <strong>Add Sub Category</strong>
                </header>
                <div class="panel-body">
                    <form action="<?php echo  base_url() ?>admin/addsubsubcategory" name="add_subsubcat" method="POST" id="subsubcat_frm" class="form-horizontal tasi-form" enctype="multipart/form-data">
                      
					 
						<?php if($this->session->flashdata('subcat_success')){?>
						<div class="alert alert-success alert-block fade in">
                        <button type="button" class="close close-sm" data-dismiss="alert">
                            <i class="fa fa-times"></i>
                        </button>
                        <h4>
                            <i class="fa fa-ok-sign"></i>
                            Success!
                        </h4>
                        <p><?php echo  $this->session->flashdata('subcat_success');?></p>
                    </div>
				
						<?php }?>
						<?php //echo "<pre>";print_r($getallcategories);exit; ?>
						<div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">categories</label>
                            <div class="col-sm-10">
                                <select id="multiple" class="select2-multiple form-control m-b-10" name="category_id[]" >
									   
									   <option value="">--Select Category--</option>
									   <?php //echo "<pre>";print_r($getallcategories);exit;?>
									   <?php foreach($getallcategories as $getcategory) { ?>
                                    <option value="<?php echo $getcategory->category_id;?>"><?php echo $getcategory->category_name;?></option>
									   <?php } ?>
                                    
                                </select>
								<?php echo form_error('category_id')?>
                            </div>
						</div>
						<div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">subcategories</label>
                            <div class="col-sm-10">
                                <select id="multiple" class="select2-multiple form-control m-b-10" name="sub_category_id[]" >
									   
									   <option value="">--Select SubCategory--</option>
									   <?php foreach($getallsubcategories as $getsubcategory) { ?>
                                    <option value="<?php echo $getsubcategory->sub_category_id;?>"><?php echo $getsubcategory->sub_category_name;?></option>
									   <?php } ?>
                                    
                                </select>
								<?php echo form_error('sub_category_id')?>
                            </div>
						</div>
						<div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Sub SubCategory Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="subsubcat_name">
								<?php echo form_error('subcat_name')?>
                            </div>
							
                        </div>
						<div class="form-group clearfix">
						<?php if($this->session->flashdata('error')){?>
						<div id="msg"><?php echo  $this->session->flashdata('error');?></div>
						<?php }?>
						
                            <label class="col-lg-2 col-sm-2 control-label">Subcategory Image</label>
                            <div class="col-lg-10">
							<!--<input type="file" id="file-2" name="s_pan" class="file"  multiple=true>-->
                                <input type="file" name="sub_sub_category_image" multiple=true>
                            </div>
                        </div>
                      <div class="form-group">
                            <label class="col-lg-2 col-sm-2 control-label">&nbsp;</label>
                            <div class="col-lg-10">
						<button class="btn btn-info" type="submit" name="subsubcatsubmit">Submit</button>
						</div>
                        </div>
                        
							
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
