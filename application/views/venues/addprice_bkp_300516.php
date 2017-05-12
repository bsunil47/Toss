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
        <?php $this->load->view("includes/venues_leftmenu");?>
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
               <!--<header class="panel-heading">
                    Add Pricing
                </header>-->
                <div class="panel-body">
                    <form action="<?php echo  base_url();?>venues/addpricing" name="add_price" method="POST" id="add_price" class="form-horizontal tasi-form" enctype="multipart/form-data">
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
						<div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Select Venue</label>
                            <div class="col-sm-10">
                                <select name="venue" id="venue" class="form-control m-b-10" >
                                    <option value="">-Select Venue-</option>
                                    <?php  foreach($venuedetails as $venue){?>
                                    <option value="<?php echo $venue->venue_id;?>"><?php echo $venue->venue_display_name;?></option>
                                    <?php                                 
                                   }?>
                                </select>
                                <?php echo form_error('venue')?>
                            </div>
						</div>
						
						<div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Select Pricing Type</label>
                            <div class="col-sm-10">
                               <select name="ptype" id="ptype" onchange="getval(this.value)" class="form-control m-b-10">
                                    <option value="">-Select Pricing Type-</option>
                                    <option value="1">Memebership</option>
                                    <option value="2">Category</option>
                                    <option value="3">Subcategory</option>
									<option value="4">Facility</option>
                                </select>
                                <?php echo form_error('ptype')?>
                                
                            </div>
							
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Select Pricing By</label>
                            <div class="col-sm-10">
                                <select name="type"  id="type" class="form-control m-b-10"></select>
                                <?php echo form_error('type')?>
                            </div>
							
                        </div>
                            <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Amount</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="amount" id="amount">
								<?php echo form_error('amount')?>
                            </div>
							
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Discount Type</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="dtype" id="dtype" value="flat" readonly="">
								<?php echo form_error('dtype')?>
                            </div>
						</div>
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Discount Amount</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="damount" id="damount" onkeyup="getdiscount(this.value);"  >
								<?php echo form_error('damount')?>
                            </div>
						</div>
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Amount After Discount</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="adamount" id="adamount"  readonly="">
								<?php echo form_error('adamount')?>
                            </div>
						</div>
						<div class="form-group">
                            <label class="col-lg-2 col-sm-2 control-label">&nbsp;</label>
                            <div class="col-lg-10">
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
function getval(v){
	//alert(v);
        if(v=='1'){
        var url='<?php echo base_url()?>venues/getmembership';
        var first="Select Membership type";
        jQuery.ajax({
		type:'POST',
		url:url,
		data:{'id': v },
		dataType:"JSON",
		success: function(data){
			//jQuery(".subcategory option[value='x']").remove();
			jQuery('#type').html(data);
			jQuery('#type').append('<option value="">' +  first + '</option>');
			for(i in data){
				jQuery('#type').append('<option  value="'+ data[i].membership_type_id + '">' + data[i].membership_name +'</option>');
			}
		
		}
		
	});    
    }else if(v=='2'){
    var url='<?php echo base_url()?>venues/getcategories';
    var first="Select  Category";
    jQuery.ajax({
		type:'POST',
		url:url,
		data:{'id': v },
		dataType:"JSON",
		success: function(data){
			//jQuery(".subcategory option[value='x']").remove();
			jQuery('#type').html(data);
			jQuery('#type').append('<option value="">' +  first + '</option>');
			for(i in data){
				jQuery('#type').append('<option  value="'+ data[i].category_id + '">' + data[i].category_name +'</option>');
			}
		
		}
		
	});    
    }else if(v=='3'){
    var url='<?php echo base_url()?>venues/getsubcategories';
    var first="Select Sub Category";
    jQuery.ajax({
		type:'POST',
		url:url,
		data:{'id': v },
		dataType:"JSON",
		success: function(data){
			//jQuery(".subcategory option[value='x']").remove();
			jQuery('#type').html(data);
			jQuery('#type').append('<option value="">' +  first + '</option>');
			for(i in data){
				jQuery('#type').append('<option  value="'+ data[i].sub_category_id + '">' + data[i].sub_category_name +'</option>');
			}
		
		}
		
	});    
    }else if(v=='4'){
    var url='<?php echo base_url()?>venues/getfacilities';
    var first="Select Facility";
    jQuery.ajax({
		type:'POST',
		url:url,
		data:{'id': v },
		dataType:"JSON",
		success: function(data){
			//jQuery(".subcategory option[value='x']").remove();
			jQuery('#type').html(data);
			jQuery('#type').append('<option value="">' +  first + '</option>');
			for(i in data){
                             data[i].facility_name=data[i].facility_name.replace(/\\/g, '');
				jQuery('#type').append('<option  value="'+ data[i].facility_id + '">' + data[i].facility_name +'</option>');
			}
		
		}
		
	});    
    }
}

function getdiscount(d){
    var ad=document.getElementById('amount').value;
    var dis=ad-d;
    document.getElementById('adamount').value=dis;
    }
</script>

</body>
<!-- Mirrored from thevectorlab.net/slicklab/form-layout.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 21 Dec 2015 07:04:39 GMT -->
</html>
