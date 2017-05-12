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
                <h3 class="m-b-less">Edit Pricing</h3>
                <!--<span class="sub-title">Welcome to Static Table</span>-->
                <div class="state-information">
                    <ol class="breadcrumb m-b-less bg-less">
                        <li><a href="<?php echo base_url();?>venues/dashboard">Home</a></li>
                        <li><a href="<?php echo base_url();?>venues/managepricing">Pricing</a></li>
                        <li class="active">Edit pricing</li>
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
                    Edit Pricing
                </header>-->
                <div class="panel-body">
                    <form action="<?php echo  base_url() ?>venues/editprice/<?php echo $this->uri->segment(3);?>" name="edit_price" method="POST" id="edit_price" class="form-horizontal tasi-form" enctype="multipart/form-data">
                    
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
						<?php //print_r($getdetails);?>
						<div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Select Pricing Type</label>
                            <div class="col-sm-10">
                               <select name="ptype" id="ptype" onchange="getval(this.value)" class="form-control m-b-10">
                                    <option value="">-Select Pricing Type-</option>
                                    <option value="1" <?php if($getdetails->price_type==1){?> selected=""<?php }?>>Memebership</option>
                                    <option value="2" <?php if($getdetails->price_type==2){?> selected=""<?php }?>>Category</option>
                                    <option value="3" <?php if($getdetails->price_type==3){?> selected=""<?php }?>>Subcategory</option>
									<option value="4" <?php if($getdetails->price_type==4){?> selected=""<?php }?>>Facility</option>
                                </select>
                                <?php echo form_error('ptype')?>
                                
                            </div>
							
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Select Pricing By</label>
                            <div class="col-sm-10">
                                <select name="type"  id="type" class="form-control m-b-10">
                                <?php if($getdetails->price_type==1){?>
                                     <option value="">-Select Membership type-</option>
                                  <?php  foreach($membershiptype as $member){?>
                                     <option value="<?php echo $member->membership_type_id;?>" <?php if($getdetails->base_type_id==$member->membership_type_id){?>selected=""<?php }?>><?php echo $member->membership_name;?></option>
                                
                                  <?php  }
                                }?>
                                      <?php if($getdetails->price_type==2){?>
                                     <option value="">-Select Category type-</option>
                                  <?php  foreach($categories as $category){?>
                                     <option value="<?php echo $category->category_id;?>" <?php if($getdetails->base_type_id==$category->category_id){?>selected=""<?php }?>><?php echo $category->category_name;?></option>
                                
                                  <?php  }
                                }?>
                                     <?php if($getdetails->price_type==3){?>
                                     <option value="">-Select Sub Category type-</option>
                                  <?php  foreach($subcategories as $subcategory){?>
                                     <option value="<?php echo $subcategory->sub_category_id;?>" <?php if($getdetails->base_type_id==$subcategory->sub_category_id){?>selected=""<?php }?>><?php echo $subcategory->sub_category_name;?></option>
                                
                                  <?php  }
                                }?>
								    <?php if($getdetails->price_type==4){?>
                                     <option value="">-Select Facility-</option>
                                  <?php  foreach($facilities as $facility){?>
                                     <option value="<?php echo $facility->facility_id;?>" <?php if($getdetails->base_type_id==$facility->facility_id){?>selected=""<?php }?>><?php echo stripslashes($facility->facility_name);?></option>
                                
                                  <?php  }
                                }?>
                                </select>
                                <?php echo form_error('type')?>
                            </div>
							
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Select Venue</label>
                            <div class="col-sm-10">
                                <select name="venue" id="venue" class="form-control m-b-10" >
                                   <option value="">-Select Venues-</option>
                                    <?php  foreach($venues as $venue){?>
                                    <option value="<?php echo $venue->venue_id;?>" <?php if($getdetails->venue_id==$venue->venue_id){?> selected=""<?php }?>><?php echo $venue->venue_display_name;?></option>
                                    <?php                                 
                                    }?> 
                                </select>
                                <?php echo form_error('venue')?>
                             </div>
							
                        </div>
                            <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Amount</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="amount" id="amount" value="<?php echo $getdetails->amount;?>">
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
                                <input type="text" class="form-control" name="damount" id="damount" value="<?php echo $getdetails->discount_amount;?>" onkeyup="getdiscount(this.value);"  >
								<?php echo form_error('damount')?>
                            </div>
							
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Amount After Discount</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="adamount" id="adamount"   value="<?php echo $getdetails->amount - $getdetails->discount_amount;?>" readonly="">
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
				jQuery('#type').append('<option  value="'+ data[i].facility_id + '">' + data[i].facility_name +'</option>');
			}
		
		}
		
	});    
    }
   
    
}
function getvenues(e){
var url='<?php echo base_url()?>venues/getvenues';
    var title="Select Venue";
    jQuery.ajax({
		type:'POST',
		url:url,
		data:{'id': e },
		dataType:"JSON",
		success: function(data){
			//jQuery(".subcategory option[value='x']").remove();
			jQuery('#venue').html(data);
			jQuery('#venue').append('<option value="">' +  title + '</option>');
			for(i in data){
				jQuery('#venue').append('<option  value="'+ data[i].venue_id + '">' + data[i].venue_display_name +'</option>');
			}
		
		}
		
	});    
}
function getdiscount(d){
    var ad=document.getElementById('amount').value;
    var dis=parseInt(ad)-parseInt(d);
	if (isNaN(dis) == true){
       dis=ad;
    }else{
	  dis=dis;
	}
	document.getElementById('adamount').value=dis;
 }
</script>
</body>

<!-- Mirrored from thevectorlab.net/slicklab/form-layout.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 21 Dec 2015 07:04:39 GMT -->
</html>
