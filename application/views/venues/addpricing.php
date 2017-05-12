            <!-- page head start-->
            <div class="page-head">
                <h3 class="m-b-less">Add Pricing</h3>
                <!--<span class="sub-title">Welcome to Static Table</span>-->
                <div class="state-information">
                    <ol class="breadcrumb m-b-less bg-less">
                        <li><a href="<?php echo base_url();?>venues/dashboard">Home</a></li>
			<li><a href="<?php echo base_url();?>venues/managepricing">Pricing</a></li>
                        <li class="active">Add Pricing</li>
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
<!--                    Add Pricing-->
                </header>
                <div class="panel-body">
                    <form action="<?php echo  base_url() ?>venues/addpricing" name="add_price" method="POST" id="add_price" class="form-horizontal tasi-form" enctype="multipart/form-data">
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
					<?php }?>
						<!--<div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Select Venue</label>
                            <div class="col-sm-10">
                                <select name="venue" id="venue" class="form-control m-b-10" >
                                    <option value="">-Select Venue-</option>
                                    <?php  //foreach($venuedetails as $venue){?>
                                    <option value="<?php //echo $venue->venue_id;?>"><?php //echo $venue->venue_display_name;?></option>
                                    <?php                                 
                                   //}?>
                                </select>
                                <?php //echo form_error('venue')?>
                            </div>
						</div>-->
				<?php //echo"<pre>";print_r($venuesubcategorydata); ?>		
			 <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label ">Select Venue Subcategory</label>
                            <div class="col-sm-10">
                               <select name="scategory" id="scategory" class="form-control m-b-10">
                                    <option value="">-Select Sub Category-</option>
                                    <?php foreach($venuesubcategorydata as $venuecategory){?>
                                    <option value="<?php echo $venuecategory->sub_category_id;?>"><?php echo $venuecategory->sub_category_name;?></option>
                                    <?php }?>
                                   </select>
                                <?php echo form_error('scategory')?>
                                
                            </div>
							
                        </div>
                                                <?php if(!empty($venuesubsubcategorydata)){?>
                                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Select Venue Sub Sub category</label>
                            <div class="col-sm-10">
                               <select name="sscategory" id="sscategory"  class="form-control m-b-10">
                                   
                                    </select>
                                <?php echo form_error('sscategory')?>
                                
                            </div>
							
                        </div>        
                                                    <?php }?>
                       
                            <div class="form-group">
                                <label class="col-sm-2 col-sm-2 control-label">Price per Selected day<input type="hidden" name="type[]" value="1"></label>
                            <div class="col-sm-3">
                                Amount
                                <input type="text" class="form-control" name="amount[]" id="damount">
								<?php echo form_error('amount')?>
                            </div>
                                <div class="col-sm-3">
                                    Discount Type
                                    <input type="text" class="form-control" name="dtype[]" id="damount" value="flat" readonly="">
								<?php echo form_error('dtype')?>
                            </div>
                                <div class="col-sm-3">
                                    Discount Amount
                                <input type="text" class="form-control" name="damount[]" id="damount">
								<?php echo form_error('damount')?>
                            </div>
							
                        </div>
                                                <div class="form-group">
                                <label class="col-sm-2 col-sm-2 control-label">Price per Week<input type="hidden" name="type[]" value="2"></label>
                            <div class="col-sm-3">
                                Amount
                                <input type="text" class="form-control" name="amount[]" id="damount">
								<?php echo form_error('amount')?>
                            </div>
                                <div class="col-sm-3">
                                    Discount Type
                                    <input type="text" class="form-control" name="dtype[]" id="damount" value="flat" readonly="">
								<?php echo form_error('dtype')?>
                            </div>
                                <div class="col-sm-3">
                                    Discount Amount
                                <input type="text" class="form-control" name="damount[]" id="damount">
								<?php echo form_error('damount')?>
                            </div>
							
                        </div>
                                                <div class="form-group">
                                <label class="col-sm-2 col-sm-2 control-label">Price per  Month<input type="hidden" name="type[]" value="3"></label>
                            <div class="col-sm-3">
                                Amount
                                <input type="text" class="form-control" name="amount[]" id="damount">
								<?php echo form_error('amount')?>
                            </div>
                                <div class="col-sm-3">
                                    Discount Type
                                    <input type="text" class="form-control" name="dtype[]" id="damount" value="flat" readonly="">
								<?php echo form_error('dtype')?>
                            </div>
                                <div class="col-sm-3">
                                    Discount Amount
                                <input type="text" class="form-control" name="damount[]" id="damount">
								<?php echo form_error('damount')?>
                            </div>
							
                        </div>
                                                <div class="form-group">
                                <label class="col-sm-2 col-sm-2 control-label">Price per  Quarter<input type="hidden" name="type[]" value="4"></label>
                            <div class="col-sm-3">
                                Amount
                                <input type="text" class="form-control" name="amount[]" id="damount">
								<?php echo form_error('amount')?>
                            </div>
                                <div class="col-sm-3">
                                    Discount Type
                                    <input type="text" class="form-control" name="dtype[]" id="damount" value="flat" readonly="">
								<?php echo form_error('dtype')?>
                            </div>
                                <div class="col-sm-3">
                                    Discount Amount
                                <input type="text" class="form-control" name="damount[]" id="damount">
								<?php echo form_error('damount')?>
                            </div>
							
                        </div>
                                                <div class="form-group">
                                <label class="col-sm-2 col-sm-2 control-label">Price per Half Year<input type="hidden" name="type[]" value="5"></label>
                            <div class="col-sm-3">
                                Amount
                                <input type="text" class="form-control" name="amount[]" id="damount">
								<?php echo form_error('amount')?>
                            </div>
                                <div class="col-sm-3">
                                    Discount Type
                                    <input type="text" class="form-control" name="dtype[]" id="damount" value="flat" readonly="">
								<?php echo form_error('dtype')?>
                            </div>
                                <div class="col-sm-3">
                                    Discount Amount
                                <input type="text" class="form-control" name="damount[]" id="damount">
								<?php echo form_error('damount')?>
                            </div>
							
                        </div>
                                                <div class="form-group">
                                <label class="col-sm-2 col-sm-2 control-label">Price per Year<input type="hidden" name="type[]" value="6"></label>
                            <div class="col-sm-3">
                                Amount
                                <input type="text" class="form-control" name="amount[]" id="damount">
								<?php echo form_error('amount')?>
                            </div>
                                <div class="col-sm-3">
                                    Discount Type
                                    <input type="text" class="form-control" name="dtype[]" id="damount" value="flat" readonly="">
								<?php echo form_error('dtype')?>
                            </div>
                                <div class="col-sm-3">
                                    Discount Amount
                                <input type="text" class="form-control" name="damount[]" id="damount">
								<?php echo form_error('damount')?>
                            </div>
							
                        </div>
                                                
                                                
                        <div class="form-group">
                            <label class="col-lg-2 col-sm-2 control-label">&nbsp;</label>
                            <div class="col-lg-10">
							<input type="hidden" name="venue" value="<?php echo $venueid;?>"/>
						<button class="btn btn-info" type="submit" name="usersubmit">Submit</button>
						</div>
                        </div>                  
					</form>
                </div>
            </section>          
            </div>
            </div>
            </div>
            <!--body wrapper end-->
<script type="text/javascript">
    var venue_id=<?php echo $venueid;?>;


                                   
</script>
