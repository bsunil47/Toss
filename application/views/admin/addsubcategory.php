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
                    <form action="<?php echo  base_url() ?>admin/addsubcategory" name="add_subcat" method="POST" id="cat_frm" class="form-horizontal tasi-form" enctype="multipart/form-data">
                      
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
						
						<div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">categories</label>
                            <div class="col-sm-10">
                                <select id="multiple" class="select2-multiple form-control m-b-10" name="category_id[]">
									   
									   <option value="">--Select Category--</option>
									   <?php foreach($getallcategories as $getcategory) { ?>
                                    <option value="<?php echo $getcategory->category_id;?>"><?php echo $getcategory->category_name;?></option>
									   <?php } ?>
                                    
                                </select>
								<?php echo form_error('category_id')?>
                            </div>
						</div>
						<div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">SubCategory Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="subcat_name">
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
                                <input type="file" name="sub_category_image" multiple=true>
                            </div>
                        </div>
                      <div class="form-group">
                            <label class="col-lg-2 col-sm-2 control-label">&nbsp;</label>
                            <div class="col-lg-10">
						<button class="btn btn-info" type="submit" name="subcatsubmit">Submit</button>
						</div>
                        </div>
                       							
                    </form>
                </div>
            </section>
            </div>
            </div>

            </div>
            <!--body wrapper end-->
