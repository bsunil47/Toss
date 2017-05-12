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
                      			
						<div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">categories</label>
                            <div class="col-sm-10">
                                <select id="multiple" class="select2-multiple form-control m-b-10" name="category_id[]" >
									   
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
                        							
                    </form>
                </div>
            </section>
             </div>
            </div>

            </div>
            <!--body wrapper end-->
