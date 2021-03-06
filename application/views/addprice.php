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
                <h3 class="m-b-less">Add Pricing</h3>
                <!--<span class="sub-title">Welcome to Static Table</span>-->
                <div class="state-information">
                    <ol class="breadcrumb m-b-less bg-less">
                        <li><a href="<?php echo base_url();?>admin/dashboard">Home</a></li>
						<li><a href="<?php echo base_url();?>admin/listvenue/<?php echo $venueid;?>">Venues List</a></li>
                        <li><a href="<?php echo base_url();?>admin/managepricing/<?php echo $venueid;?>">Pricing</a></li>
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
                    <form action="<?php echo  base_url() ?>admin/addpricing/<?php echo $venueid;?>" name="add_price" method="POST" id="add_price" class="form-horizontal tasi-form" enctype="multipart/form-data">
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
                            <label class="col-sm-2 col-sm-2 control-label">Select Venue Subcategory</label>
                            <div class="col-sm-10">
                               <select name="scategory" id="scategory" <?php if(!empty($venuesubsubcategorydata)){?>onchange="getval(this.value)"<?php }?> class="form-control m-b-10">
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
                                <label class="col-sm-2 col-sm-2 control-label">Price per Slot per day<input type="hidden" name="type[]" value="1"></label>
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
                                <label class="col-sm-2 col-sm-2 control-label">Price per Slot per Week<input type="hidden" name="type[]" value="2"></label>
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
                                <label class="col-sm-2 col-sm-2 control-label">Price per Slot per Month<input type="hidden" name="type[]" value="3"></label>
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
                                <label class="col-sm-2 col-sm-2 control-label">Price per Slot per Quarter<input type="hidden" name="type[]" value="4"></label>
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
                                <label class="col-sm-2 col-sm-2 control-label">Price per Slot per Half Year<input type="hidden" name="type[]" value="5"></label>
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
                                <label class="col-sm-2 col-sm-2 control-label">Price per Slot per Year<input type="hidden" name="type[]" value="6"></label>
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
<?php $this->load->view("includes/admin_footer");?>

<script type="text/javascript">
    var venue_id=<?php echo $venueid;?>;
function getval(v){
	var url='<?php echo base_url()?>ajax/getvenuesubsubcategories';
        var first="Select Sub Sub Category type";
        jQuery.ajax({
		type:'POST',
		url:url,
		data:{'id': v ,'venue_id':venue_id},
		dataType:"JSON",
		success: function(data){
                    //jQuery(".subcategory option[value='x']").remove();
			jQuery('#sscategory').html(data);
			jQuery('#sscategory').removeAttr('multiple');
			jQuery('#sscategory').append('<option value="">' +  first + '</option>');
			var placeholder = "Select One";
				jQuery('select#type').select2({
						placeholder: placeholder
				});
			for(i in data){
				jQuery('#sscategory').append('<option  value="'+ data[i].sub_sub_category_id + '">' + data[i].sub_sub_category_name +'</option>');
			}
			
	} 
    })
	     
}

                                   
</script>

</body>
<!-- Mirrored from thevectorlab.net/slicklab/form-layout.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 21 Dec 2015 07:04:39 GMT -->
</html>
