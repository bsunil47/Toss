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
 <?php $this->load->view('includes/admin_header_links');?>
</head>

<body class="sticky-header">

    <section>
        <!-- sidebar left start-->
      <?php $this->load->view('includes/admin_leftmenu');?>
        <!-- sidebar left end-->

        <!-- body content start-->
        <div class="body-content" style="min-height: 1000px;">

            <!-- header section start-->
            <?php $this->load->view('includes/admin_header');?>
            <!-- header section end-->

            <!-- page head start-->
            <div class="page-head">
                <h3 class="m-b-less">
                    Add Addon
                </h3>
                <!--<span class="sub-title">Welcome to Static Table</span>-->
                <div class="state-information">
                    <ol class="breadcrumb m-b-less bg-less">
                        <li><a href="<?php echo base_url();?>admin/dashboard">Home</a></li>
						<li><a href="<?php echo base_url();?>admin/listvenue/<?php echo $venueid;?>">Venues List</a></li>
                        <li><a href="<?php echo base_url();?>admin/manageaddons">Addons</a></li>
                        <li class="active">Add Addon</li>
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
                <!--    Form Elements-->
                </header>
                <div class="panel-body">
                    <form action="<?php echo  base_url() ?>admin/addaddon/<?php echo $venueid;?>" name="add_addon" method="POST" id="cat_frm" class="form-horizontal tasi-form">
                   	
						<div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Select Addon Type</label>
                            <div class="col-sm-10">
                               <select name="ptype" id="ptype" onchange="getval(this.value)" class="form-control m-b-10">
                                    <option value="">-Select Addon Type-</option>
                                    <!--<option value="2">Category</option>-->
                                    <option value="2">Subcategory</option>
									   <option value="3">Sub Subcategory</option>
									
                                </select>
                                <?php echo form_error('ptype')?>
                                
                            </div>
							
                        </div>
						<div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Select Addon Type Name</label>
                            <div class="col-sm-10">
                                <select name="type"  id="type" class="form-control m-b-10"></select>
                                <?php echo form_error('type')?>
                        </div>
							
                        </div>
                        
                          <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Select Addon Facility</label>
                            <div class="col-sm-10">
                                <select name="addon" id="facility" class="form-control" onchange="getvalone(this.value);">
                                    <option value="">-Select -</option>
                                     <?php foreach($facilities as $facility ){?>
                                    <option value="<?php echo $facility->facility_id;?>"><?php echo stripslashes($facility->facility_name);?></option>
                                     <?php }?>
                                    <option value="other">Other</option>
                                </select>
								<?php echo form_error('addon')?>
                            </div>
							
                        </div>
                                                <div id="other" style="display: none;">			
			<div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Add On Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="addon_name">
								<?php echo form_error('addon_name')?>
                            </div>
							
                        </div>
				     <div class="clearfix"></div>
                                                </div>
                        
                                   <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Amount</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="amount">
								<?php echo form_error('amount')?>
                            </div>
							
                        </div>            
                                                
                      <div class="form-group">
                            <label class="col-lg-2 col-sm-2 control-label">&nbsp;</label>
                            <div class="col-lg-10">
							<input type="hidden" name="venue_id" value="<?php echo $venueid;?>" />
						<button class="btn btn-info" type="submit" name="addonsubmit">Submit</button>
						</div>
                        </div>
                        
							
                    </form>
                </div>
            </section>
            
            

            

            </div>
            </div>

            </div>
            <!--body wrapper end-->
<?php $this->load->view('includes/admin_footer');?>

            <script>
                function getvalone(e){
					
                    if(e=='other'){
                        document.getElementById('other').style.display='block';
                    }else{
                        document.getElementById('other').style.display='none';
                    }
                }
				
                </script>
<!--<script type="text/javascript">
jQuery(document).ready(function(){
	var placeholder = "Select One";
	jQuery('select.select2').select2({
		placeholder: placeholder
	});

jQuery(document).on('change','.subcategory',function(){
	//alert("i am coming");
	//var catid=jQuery(this).val();
	var catid = jQuery("#multiple").val();
	var subcatid = jQuery(this).val();
	
	//alert(catid);
	//alert(subcatid);
     //jQuery('.fac_cls').hide();
	 //jQuery('.cat_'+catid).show();
	//alert(catid);
	//var datastring='catid'+catid;
	var url='<?php //echo base_url()?>admin/subcategorychangeaddon';
	
	jQuery.ajax({
		type:'POST',
		url:url,
		data:{'subcatid': subcatid },
		dataType:"JSON",
		success: function(data){
			//jQuery(".subcategory option[value='x']").remove();
			jQuery('.subsubappend').html(data);
			var second="Select One";
			jQuery('.subsubappend').append('<select id="multiple2" class="select2 form-control m-b-10 subsubcategory" name="sub_sub_cat_id[]" multiple><option value="">' +  second + '</option>');
			for(j in data){
				jQuery('#multiple2').append('<option  value="'+ data[j].sub_sub_category_id +'">' + data[j].sub_sub_category_name +'</option>');
			}
			jQuery('#multiple2').append('</select>');
		}
		
		});
		//jQuery('select.select2').select2();
	/*var clone_temp = jQuery(".select2").clone();
jQuery("#multiple1").append(clone_temp);
clone_temp.select2();*/
	});
	
});
</script>-->
<script type="text/javascript">
	function getval(v){
		
	if(v=='2'){
		
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
			jQuery('#type').removeAttr('multiple');
			jQuery('#type').append('<option value="">' +  first + '</option>');
			for(i in data){
				jQuery('#type').append('<option  value="'+ data[i].sub_category_id + '">' + data[i].sub_category_name +'</option>');
			}
		
		}
		
	});    
    }else if(v=='3'){
	var url='<?php echo base_url()?>admin/getsubsubcategories';
    var first="Select Sub SubCategory";
    jQuery.ajax({
		type:'POST',
		url:url,
		data:{'id': v },
		dataType:"JSON",
		success: function(data){
			//jQuery(".subcategory option[value='x']").remove();
			jQuery('#type').html(data);
			jQuery('#type').removeAttr('multiple2');
			jQuery('#type').append('<option value="">' +  first + '</option>');
			for(i in data){
				jQuery('#type').append('<option  value="'+ data[i].sub_sub_category_id + '">' + data[i].sub_sub_category_name +'</option>');
			}
		
		}
		
	});
	}
}
</script>			
</body>

<!-- Mirrored from thevectorlab.net/slicklab/form-layout.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 21 Dec 2015 07:04:39 GMT -->
</html>
