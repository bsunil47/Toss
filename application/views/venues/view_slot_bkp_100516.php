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
   <?php $this->load->view("includes/admin_header_links.php")?>
</head>

<body class="sticky-header">

    <section>
        <!-- sidebar left start-->
        <?php $this->load->view("includes/venues_leftmenu.php");?>
        <!-- sidebar left end-->

        <!-- body content start-->
        <div class="body-content" style="min-height: 1000px;">

            <!-- header section start-->
            <?php $this->load->view("includes/admin_header.php");?>
            <!-- header section end-->

            <!-- page head start-->
            <div class="page-head">
                <h3 class="m-b-less">View Slot </h3>
                <div class="state-information">
                    <ol class="breadcrumb m-b-less bg-less">
                        <li><a href="<?php echo base_url();?>venues/dashboard">Home</a></li>
                        <li><a href="<?php echo base_url();?>venues/manageslots">Slots</a></li>
                        <li class="active">View Slot</li>
                    </ol>
                </div>
            </div>
            <!-- page head end-->

            <!--body wrapper start-->
            <div class="wrapper">
				<div class="row">
                    <div class="col-sm-12">
					<div class="col-sm-12" style="float:left;">
                        <section class="panel">
                            <header class="panel-heading ">
<!--                                <strong>Pricing Information</strong>-->
                            </header>
                            <table class="datatable-2 table responsive-data-table data-table">
                                
							<?php //echo "<pre>";print_r($getdetails);exit; ?>
                            <tr>
                                <td>Venue Name</td> <td>:</td>
                                <td><?php  echo $editslotinfo->venue_display_name;?> </td>
                            </tr>
							<tr>
                                <td> Category Name </td>
                                <td> : </td>
                                <td><?php echo $editslotinfo->category_name;?></td>
							</tr>
							<tr>
                                <td> Sub Category Name</td>
                                <td> :</td>
                                <td> <?php echo $editslotinfo->sub_category_name;?>                                    
                                   </td>
							</tr>
							<tr>
                                <td> Day </td>
                                <td> : </td>
                                <td> <?php $dayarray=array('1'=>'Monday','2'=>'Tuesday','3'=>'Wednesday','4'=>'Thursday','5'=>'Friday','6'=>'Saturday','7'=>'Sunday');
                                echo $dayarray[$editslotinfo->day_id];?> </td>
							</tr>
							<tr>
                                <td> Slot From Time</td>
                                <td>:</td>
                                <td><?php echo $editslotinfo->slot_from_time;?>
                                </td>
							</tr>
							<tr>
                                <td>Slot To Time</td>
                                <td>:</td>
                                <td><?php echo $editslotinfo->slot_to_time;?></td>
							</tr>
                                                        <tr>
                                <td>Max Limit</td>
                                <td>:</td>
                                <td><?php echo $editslotinfo->quantity;?></td>
							</tr>
				            </tbody>
                            </table>
                        </section>
						</div>			
                    </div>
                </div>    
            </div>
            <!--body wrapper end-->
<?php $this->load->view("includes/admin_footer.php");?>

<!--Add more jquery-->
<script>
/*	jQuery('.timepicker-24').timepicker({ 
	//jQuery(this).timepicker({ 
	defaultTime: false,
	autoclose: true,
    minuteStep: 15,
    showSeconds: true,
    showMeridian: false
	//});	 
	
	
	//});
});

//jQuery('.timepicker-24_to').click(function(){  	
	jQuery('.timepicker-24_to').timepicker({
	//jQuery(this).timepicker({
		
	defaultTime: false,
	autoclose: true,
    minuteStep: 15,
    showSeconds: true,
    showMeridian: false
		
		//});
		
});
var id = 1;
$("#add").on('click', function () {
    id++;
    //$(".well").append('<div id="datetimepicker' + id + '" class="input-append span12"><input type="text"/><span class="add-on"><i data-time-icon="icon-time" data-date-icon="icon-calendar" class="icon-calendar"></i></span><button name="remove" class="btn btn-danger btn-small"><i class="icon-white icon-trash"></i></button></div>');
	//$(".well").append('<div><div class="form-group clearfix"><label class="col-sm-2 col-sm-2 control-label">Slot Time</label><div class="col-sm-5">From<div class="input-group bootstrap-timepicker"><input type="text" name="frm_dte[]" id="frm_dte'+x+'" value="5:00 AM" class="form-control timepicker-24"><span class="input-group-btn"><button type="button" class="btn btn-default"><i class="fa fa-clock-o"></i></button></span></div><?php //echo form_error('frm_dte');?></div><div class="col-sm-5">To<div class="input-group bootstrap-timepicker"><input type="text" name="to_dte[]" id="to_dte'+x+'" value="5:00 PM" class="form-control timepicker-24_to"><span class="input-group-btn"><button type="button" class="btn btn-default"><i class="fa fa-clock-o"></i></button></span></div><?php //echo form_error('to_dte');?></div></div><div class="form-group clearfix"><label class="col-sm-2 col-sm-2 control-label">Max Limit </label><div class="col-sm-10"><input type="text" class="form-control" name="max_limit[]" id="max_limit'+x+'"><?php //echo form_error('max_limit')?></div></div><a href="#" class="remove_field">Remove</a></div>');
});*/
</script>
<script>
jQuery('.input_fields_wrap').on('hover', 'div[id^="frm_dte"]', function () {		
	jQuery('.timepicker-24').timepicker({ 
	defaultTime: false,
	autoclose: true,
    minuteStep: 15,
    showSeconds: true,
    showMeridian: false
	//});	 
	
	
	});
});
jQuery('.input_fields_wrap').on('hover', 'div[id^="to_dte"]', function () {
//jQuery('.timepicker-24_to').click(function(){  	
	jQuery('.timepicker-24_to').timepicker({
	//jQuery(this).timepicker({
		
	defaultTime: false,
	autoclose: true,
    minuteStep: 15,
    showSeconds: true,
    showMeridian: false
		
		});
		
});
	//jQuery('.timepicker-24').timepicker({

    var max_fields      = 10; //maximum input boxes allowed
    var wrapper         = jQuery(".input_fields_wrap"); //Fields wrapper
    var add_button      = jQuery(".add_field_button"); //Add button ID
   
    var x = 1; //initlal text box count
    jQuery("#add").on('click',function(e){ //on add input button click
	
        e.preventDefault();
		
        //if(x < max_fields){ //max input box allowed
            x++; //text box increment
           // jQuery(wrapper).append('<div><div class="form-group clearfix"><label class="col-sm-2 col-sm-2 control-label">Slot Time</label><div class="col-sm-5">From<div class="input-group bootstrap-timepicker"><input type="text" name="frm_dte[]" id="frm_dte" value="5:00 AM" class="form-control timepicker-24"><span class="input-group-btn"><button type="button" class="btn btn-default"><i class="fa fa-clock-o"></i></button></span></div><?php //echo form_error('frm_dte');?></div><div class="col-sm-5">To<div class="input-group bootstrap-timepicker"><input type="text" name="to_dte[]" id="to_dte" value="5:00 PM" class="form-control timepicker-24_to"><span class="input-group-btn"><button type="button" class="btn btn-default"><i class="fa fa-clock-o"></i></button></span></div><?php //echo form_error('to_dte');?></div></div><div class="form-group clearfix"><label class="col-sm-2 col-sm-2 control-label">Max Limit </label><div class="col-sm-10"><input type="text" class="form-control" name="max_limit" id="max_limit"><?php //echo form_error('max_limit')?></div></div><a href="#" class="remove_field">Remove</a></div>'); //add input box
		   jQuery(".input_fields_wrap").append('<div><div class="form-group clearfix"><label class="col-sm-2 col-sm-2 control-label">Slot Time</label><div class="col-sm-5">From<div class="input-group bootstrap-timepicker" id="frm_dte['+x+']"><input type="text" id="frm_dte['+x+']" name="frm_dte['+ x +']" value="5:00:00" class="form-control timepicker-24"><span class="input-group-btn"><button type="button" class="btn btn-default"><i class="fa fa-clock-o"></i></button></span></div><?php //echo form_error('frm_dte');?></div><div class="col-sm-5">To<div class="input-group bootstrap-timepicker" id="to_dte['+x+']"><input type="text" id="frm_dte['+x+']" name="to_dte['+ x +']"  value="5:00:00" class="form-control timepicker-24_to"><span class="input-group-btn"><button type="button" class="btn btn-default"><i class="fa fa-clock-o"></i></button></span></div><?php //echo form_error('to_dte');?></div></div><div class="form-group clearfix"><label class="col-sm-2 col-sm-2 control-label">Max Limit </label><div class="col-sm-10"><input type="text" class="form-control" name="max_limit['+ x +']" id="max_limit'+x+'"><?php //echo form_error('max_limit')?></div></div><a href="#" style="float:right;" class="remove_field btn btn-danger btn-sm">Remove</a></div>'); //add input box 
        //}
    });
   
    jQuery(".input_fields_wrap").on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); jQuery(this).parent('div').remove(); x--;
    })

</script>


<script type="text/javascript">
jQuery(document).on('change','.venue',function(){
	//alert("I M HERE");
	
	var venueid=jQuery(this).val();
	
	//alert(catid);
	//var datastring='catid'+catid;
	var url='<?php echo base_url()?>admin/venuechange';
	jQuery.ajax({
		type:'POST',
		url:url,
		data:{'venueid': venueid },
		dataType:"JSON",
		success: function(data){
			//jQuery(".subcategory option[value='x']").remove();
			jQuery('.category').html(data);
			var first="Select Category";
			jQuery('.category').append('<option value="">' +  first + '</option>');
			for(i in data){
				jQuery('.category').append('<option  value="'+ data[i].venuecategoryid + '" id="cat_id">' + data[i].categoryname +'</option>');
			}
		
		}
		
	});
	
	jQuery('.category').change(function(){
		var catid=jQuery(this).val();
	
	//alert(catid);
	//var datastring='catid'+catid;
	var url='<?php echo base_url()?>admin/categorychange';
	jQuery.ajax({
		type:'POST',
		url:url,
		data:{'catid': catid },
		dataType:"JSON",
		success: function(data){
			//jQuery(".subcategory option[value='x']").remove();
			jQuery('.subcategory').html(data);
			var first="Select Sub Category";
			jQuery('.subcategory').append('<option value="">' +  first + '</option>');
			for(i in data){
				jQuery('.subcategory').append('<option  value="'+ data[i].sub_category_id + '" id="subcat_id">' + data[i].sub_category_name +'</option>');
			}
		
		}
		
	});
		
	});
	
jQuery('#timeslotsubmit').submit(function(e){
	//e.preventDefault();
	//return false;
	//alert('testing');
var venueid=jQuery('#venue_id').val();
var categoryid=jQuery('#cat_id').val();
var subcategoryid=jQuery('#subcat_id').val();


//var slottotime=jQuery('#to_dte1').val();

var dayid=jQuery('#day_id').val();

var url ='<?php echo base_url() ?>admin/addslots';
jQuery('[id^=frm_dte]').each(function(i, item) {
         var slotfromtime =  jQuery(item).val();
         //alert(slotfromtime);
     });
//var slotfromtime=jQuery('#frm_dte1').val();
jQuery('[id^=to_dte]').each(function(i1, item1) {
         var slottotime =  jQuery(item1).val();
        // alert(slottotime);
     });
jQuery.ajax({
	type:'POST',
	url:url,
	data:{'venueid':venueid,'categoryid':categoryid,'subcategoryid':subcategoryid,'dayid':dayid,'slotfromtime':slotfromtime,'slottotime':slottotime },
	dataType:"JSON",
	success: function(data){
		//alert(data);
		if(data == "notmatch"){	
		alert("Slot Timings should match the working hours");
		
		 }
		 if(data == "notequal"){	
		alert("From Time Should less than To Time");
		
		 }
		 if(data == "Fail"){	
		alert("Unable to create Slot");
		
		 }
		 if(data == "slotexists"){
			alert("Please check the slot timinings"); 
		 }
		 
		}
	
});
    
  });
	
});




</script>

<style>
       .ui-autocomplete {
            max-height: 200px;
            overflow-y: auto;
            overflow-x: hidden;
            padding-right: 20px;
        } 
</style>
</body>

<!-- Mirrored from thevectorlab.net/slicklab/form-layout.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 21 Dec 2015 07:04:39 GMT -->
</html>
