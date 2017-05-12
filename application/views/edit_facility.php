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

    <title>form layout</title>
<?php $this->load->view("includes/admin_header_links");?>
</head>

<body class="sticky-header" onload="return getval();">

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
                               <select name="ftype" id="ftype" onchange="getval(this.value)" class="form-control m-b-10">
                                    <option value="">-Select Facility Type-</option>
                                    <option value="1"<?php if($editfacilities->base_type==1){?>selected<?php } ?>>Category</option>
                                    <option value="2"<?php if($editfacilities->base_type==2){?>selected<?php } ?>>Subcategory</option>
										<option value="3"<?php if($editfacilities->base_type==3){?>selected<?php } ?>>None</option>
                                </select>
                                <?php echo form_error('ftype')?>
                                
                            </div>
							
                        </div>
						
						<div class="form-group" id="dis">
                            <label class="col-sm-2 col-sm-2 control-label">Select Category/Subcategory</label>
                            <div class="col-sm-10">
                                <select name="type"  id="type" class="form-control m-b-10">
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
            <!--body wrapper end-->
<?php $this->load->view("includes/admin_footer")?>
<script>
var va=jQuery("#ftype").val();
if(va == 3){
	jQuery('#dis').css("display","none");
}

function getval(v){
	//var value=jQuery("#ftype").val();
	//alert(value);
    if(v=='1'){
		jQuery('#dis').css("display","block");
    var url='<?php echo base_url()?>admin/getcategories';
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
    }else if(v=='2'){
		jQuery('#dis').css("display","block");
    var url='<?php echo base_url()?>admin/getsubcategories';
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
    }
	
	else if(v=='3'){
		jQuery('#dis').css("display","none");
		
	}
	
}

</script>

</body>

<!-- Mirrored from thevectorlab.net/slicklab/form-layout.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 21 Dec 2015 07:04:39 GMT -->
</html>
