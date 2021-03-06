            <!-- page head start-->
            <div class="page-head">
                <h3 class="m-b-less">
                   Edit Facility
                </h3>
                <!--<span class="sub-title">Welcome to Static Table</span>-->
                <div class="state-information">
                    <ol class="breadcrumb m-b-less bg-less">
                       <li><a href="<?php echo base_url();?>admin/dashboard">Home</a></li>
                        <li><a href="<?php echo base_url();?>admin/managefacilities">Facilities</a></li>
                        <li class="active">Edit Facility</li>
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
                    
                </header>
                <div class="panel-body">
                    <form action="<?php echo  base_url() ?>admin/editfacilitydetails" name="add_cat" method="POST" id="cat_frm" class="form-horizontal tasi-form" enctype="multipart/form-data">
                    
						<?php if($this->session->flashdata('facility_success')){ ?>
						<div class="alert alert-success alert-block fade in">
                        <button type="button" class="close close-sm" data-dismiss="alert">
                            <i class="fa fa-times"></i>
                        </button>
                        <h4>
                            <i class="fa fa-ok-sign"></i>
                            Success!
                        </h4>
                        <p><?php echo  $this->session->flashdata('facility_success');?></p>
                    </div>
				
						<?php } ?>
						<?php //echo "<pre>";print_r($editfacilities);exit;?>
						<div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Select Facility Type</label>
                            <div class="col-sm-10">
                               <select name="ftype" id="fatype" onchange="getval(this.value)" class="form-control m-b-10">
                                    <option value="">-Select Facility Type-</option>
                                    <option value="1"<?php if($editfacilities->base_type==1){?>selected<?php } ?>>Category</option>
                                    <option value="2"<?php if($editfacilities->base_type==2){?>selected<?php } ?>>Subcategory</option>
                                     <option value="3"<?php if($editfacilities->base_type==3){?>selected<?php } ?>>SubSubcategory</option>
                                    <option value="4"<?php if($editfacilities->base_type==4){?>selected<?php } ?>>None</option>
                                </select>
                                <?php echo form_error('ftype')?>
                                
                            </div>
							
                        </div>
						
			<div class="form-group" id="dis">
                            <label class="col-sm-2 col-sm-2 control-label">Select Category/Subcategory</label>
                            <div class="col-sm-10">
                                <select name="type"  id="ftype" class="form-control m-b-10">
								<?php if($editfacilities->base_type== 1) { ?>
								<option value="">--select category--</option>
								<?php foreach($categories as $category){?>
									<option value="<?php echo $category->category_id;?>"<?php if($editfacilities->base_type_id == $category->category_id){?>selected<?php } ?>><?php echo $category->category_name;?></option>
								<?php }} ?>
								<?php if($editfacilities->base_type== 2) { ?>
								<option value="">--select Sub category--</option>
								<?php foreach($subcategories as $subcategory){?>
									<option value="<?php echo $subcategory->sub_category_id;?>"<?php if($editfacilities->base_type_id == $subcategory->sub_category_id){?>selected<?php } ?>><?php echo $subcategory->sub_category_name;?></option>
								<?php }} ?>
                                                                        <?php if($editfacilities->base_type== 3) { ?>
								<option value="">--select Sub Sub category--</option>
								<?php foreach($subsubcategories as $subsubcategory){?>
									<option value="<?php echo $subsubcategory->sub_sub_category_id;?>"<?php if($editfacilities->base_type_id == $subsubcategory->sub_sub_category_id){?>selected<?php } ?>><?php echo $subsubcategory->sub_sub_category_name;?></option>
								<?php }} ?>
								</select>
                                <?php echo form_error('type')?>
                            </div>
							
                        </div>
						
						<div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Facility Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="faclty_name" value="<?php echo $editfacilities->facility_name;?>">
								<?php echo form_error('faclty_name')?>
                            </div>
							
                        </div>
						<div class="form-group clearfix">
						<?php if($this->session->flashdata('error')){?>
						<div id="msg"><?php echo  $this->session->flashdata('error');?></div>
						<?php }?>
						
                            <label class="col-lg-2 col-sm-2 control-label">Facility Image</label>
                            <div class="col-lg-10">
							<!--<input type="file" id="file-2" name="s_pan" class="file"  multiple=true>-->
							<div class="col-lg-5">
                                <input type="file" name="facility_image" multiple=true>
								</div>
								<div class="col-lg-5">
								<img src="<?php echo base_url()?>images/facilities/<?php echo $editfacilities->facility_image;?>" name="facility_image" width="auto" height="100"/>
								</div>
                            </div>
                        </div>
                      <div class="form-group">
                            <label class="col-lg-2 col-sm-2 control-label">&nbsp;</label>
                            <div class="col-lg-10">
							<input type="hidden" name="facilityid" value="<?php echo $editfacilities->facility_id;?>">
						<button class="btn btn-info" type="submit" name="faclsubmit">Submit</button>
						</div>
                        </div>
                        
							
                    </form>
                </div>
            </section>
            
            

            

            </div>
            </div>

            </div>
         