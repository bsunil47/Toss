<!-- page head start-->
            <div class="page-head">
                <h3 class="m-b-less">Add Venue Image</h3>
                <!--<span class="sub-title">Welcome to Static Table</span>-->
                <div class="state-information">
                    <ol class="breadcrumb m-b-less bg-less">
                        <li><a href="<?php echo base_url();?>vendors/dashboard">Home</a></li>
                         <li><a href="<?php echo base_url();?>vendors/managevenues">Venues List</a></li>
                        <li><a href="<?php echo base_url();?>vendors/manageimages/<?php echo $venueid;?>">Manage Images</a></li>
                        <li class="active">Add Image</li>
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
                    Venue Image Upload
                </header>
                <div class="panel-body">
                    <form action="<?php echo  base_url() ?>vendors/addimages/<?php echo $venueid;?>/<?php echo $vendorid;?>" name="upload_vendor" method="POST" id="add_price" class="form-horizontal tasi-form" enctype="multipart/form-data">
                      
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
                            <label class="col-sm-2 col-sm-2 control-label">Upload Image</label>
                            <div class="col-sm-10">
                                <input type="file" name="iupload" id="iupload">
                                <?php echo form_error('iupload')?>
                                
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
 