            <!-- page head start-->
            <div class="page-head">
                <h3 class="m-b-less">
                    Edit Slot
                </h3>
                <!--<span class="sub-title">Welcome to Static Table</span>-->
                <div class="state-information">
                    <ol class="breadcrumb m-b-less bg-less">
                        <li><a href="<?php echo base_url();?>vendors/dashboard">Home</a></li>
						<li><a href="<?php echo base_url();?>vendors/managevenues">Venue List</a></li>
                        <li><a href="<?php echo base_url();?>vendors/manageslots/<?php echo $venueid;?>">Venue Slots</a></li>
                        <li class="active">Edit Slot</li>
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
                    <form action="<?php echo  base_url() ?>vendors/editslotdetails" name="add_slots" method="POST" id="add_slots" class="form-horizontal tasi-form" enctype="multipart/form-data">
                    
						<?php if($this->session->flashdata('success_slot')){?>
						<div class="alert alert-success alert-block fade in">
                        <button type="button" class="close close-sm" data-dismiss="alert">
                            <i class="fa fa-times"></i>
                        </button>
                        <h4>
                            <i class="fa fa-ok-sign"></i>
                            Success!
                        </h4>
                        <p><?php echo  $this->session->flashdata('success_slot');?></p>
                    </div>
								
						<?php }?>
						
						<div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Venue Name</label>
                            <div class="col-sm-10">
                                <select class="form-control m-b-10 venue" name="venue_id" id="venue_id" readonly>
									   <option value="">-- Select Venue --</option>
									   <?php foreach($getallvenues as $getallvenue) { ?>
									   <option value="<?php echo $getallvenue->venue_id;?>"<?php if($getallvenue->venue_id == $editslotinfo->venue_id){?>selected<?php } ?>><?php echo $editslotinfo->venue_display_name;?></option>
									   <?php } ?>
                                    
                                </select>
								<?php echo form_error('venue_id')?>
                            </div>
							</div>
						<!--	<div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label" >Venue Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="company_id" id="company_id" >
								<?php //echo form_error('company_id')?>
                            </div>
							
                        </div>-->
							<div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">categories</label>
                            <div class="col-sm-10">
                                <select class="form-control m-b-10 category" name="cat_id" id="cat_id" readonly>
									   <option value="">--Select Category--</option>
									   <?php foreach($getallcategories as $getcategory) { ?>
                                    <option value="<?php echo $getcategory->category_id;?>"<?php if($getcategory->category_id == $editslotinfo->category_id){?>selected<?php } ?>><?php echo $getcategory->category_name;?></option>
									   <?php } ?>
                                    
                                </select>
								<?php echo form_error('cat_id')?>
                            </div>
							</div>
							<div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Venue Subcategory </label>
                            <div class="col-sm-10">
                                <select class="form-control m-b-10 subcategory" name="subcat_id" id="subcat_id" readonly>
									   <option value="">--Select Sub Category--</option>
									   <?php foreach($getallsubcategories as $getsubcategory) { ?>
                                    <option value="<?php echo $getsubcategory->sub_category_id;?>"<?php if($getsubcategory->sub_category_id == $editslotinfo->sub_category_id){?>selected<?php } ?>><?php echo $getsubcategory->sub_category_name;?></option>
									   <?php } ?>
                                    
                                </select>
								<?php echo form_error('subcat_id')?>
                            </div>
                        </div>
                                                <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Venue SubSubcategory </label>
                            <div class="col-sm-10">
                                <select class="form-control m-b-10 subcategory" name="subsubcat_id" id="subsubcat_id" readonly>
									   <option value="">--Select Sub Sub Category--</option>
									   <?php foreach($getallsubsubcategories as $getsubsubcategory) { ?>
                                    <option value="<?php echo $getsubsubcategory->sub_sub_category_id;?>"<?php if($getsubsubcategory->sub_sub_category_id == $editslotinfo->sub_sub_category_id){?>selected<?php } ?>><?php echo $getsubsubcategory->sub_sub_category_name;?></option>
									   <?php } ?>
                                    
                                </select>
								<?php echo form_error('subsubcat_id')?>
                            </div>
                        </div>
						<!--<div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Days</label>
                            <div class="col-sm-10">
                                <select class="form-control m-b-10" name="day_id" id="day_id">
									   <option value="">-- Select Day --</option>
									   <?php //$dayarray=array("1"=>"Monday","2"=>"Tuesday","3"=>"Wednesday","4"=>"Thursday","5"=>"Friday","6"=>"Saturday","7"=>"Sunday");?>
									   <?php //for($i=1;$i<8;$i++){?>
									   <option value="<?php //echo $i;?>"<?php //if($editslotinfo->day_id==$i){?>selected<?php //}?>><?php //echo $dayarray[$i];?></option>
									   <?php //} ?>
                                </select>
								<?php //echo form_error('day_id')?>
                            </div>
                        </div>-->
						
						<div class="input_fields_wrap clearfix">
						
						<div class="form-group clearfix">
                            <label class="col-sm-2 col-sm-2 control-label">Slot Time</label>
								
                            <div class="col-sm-5">
                              From
								<div class="input-group bootstrap-timepicker">
                                        <input type="text" name="frm_dte" id="frm_dte" value="<?php if(isset($editslotinfo->slot_from_time)){echo $editslotinfo->slot_from_time;}?>" class="form-control timepicker-24">
                                        <span class="input-group-btn">
                                        <button type="button" class="btn btn-default"><i class="fa fa-clock-o"></i></button>
                                        </span>
                             </div> 
							 <?php echo form_error('frm_dte');?>
							 </div>
							 <div class="col-sm-5">
							 To 
							 <div class="input-group bootstrap-timepicker">
                                        <input type="text" name="to_dte" id="to_dte" value="<?php if(isset($editslotinfo->slot_to_time)){echo $editslotinfo->slot_to_time;}?>" class="form-control timepicker-24_to">
                                        <span class="input-group-btn">
                                        <button type="button" class="btn btn-default"><i class="fa fa-clock-o"></i></button>
                                        </span>
                             </div>
							 
								<?php echo form_error('to_dte');?>
                            </div>
                        </div>
						<div class="form-group clearfix">
                            <label class="col-sm-2 col-sm-2 control-label">Max Limit </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="max_limit" id="max_limit" value="<?php if(isset($editslotinfo->quantity)){echo $editslotinfo->quantity;}?>">
								<?php echo form_error('max_limit')?>
                           </div>
							
							</div>
							
						<!--<div class="form-group clearfix">
                            <label class="col-sm-2 col-sm-2 control-label"> </label>
                            <div class="col-sm-10"><div class="col-sm-8">
                                
                            </div><br/><div class="col-sm-2" style="margin-bottom:5px;float:right;"><button class="add_field_button btn btn-success" id="add"><i class="fa fa-plus"></i>&nbsp;&nbsp; Add More Slots</button></div></div><br />
							
							</div>-->	
							
    
						</div>
						<?php if($this->session->flashdata('error_slot')){ ?>
							
							<div class="form-group clearfix">
                            <label class="col-sm-2 col-sm-2 control-label"> </label>
                            <div class="col-sm-10"><?php echo "<strong color='red'>".$this->session->flashdata('error_slot')."</strong>";?>
							
                            </div>
							</div>
							
							<?php }?>
							<?php if($this->session->flashdata('error_slot_time')){ ?>
							
							<div class="form-group clearfix">
                            <label class="col-sm-2 col-sm-2 control-label"> </label>
                            <div class="col-sm-10"><?php echo "<strong><style='color:red;'>".$this->session->flashdata('error_slot_time')."</style></strong>";?>
							
                            </div>
							</div>
							
							<?php }?>
						<!-- vendor details form close -->
						<div class="form-group" style="margin-top:10px;">
                            <label class="col-lg-2 col-sm-2 control-label">&nbsp;</label>
                            <div class="col-lg-10">
							<input type="hidden" name="slot_id" value="<?php echo $editslotinfo->slot_id;?>">
							<input type="hidden" name="rdirtvenueid" value="<?php echo $venueid;?>"/>
						<button class="btn btn-info" type="submit" id="timeslotsubmit" name="timeslotsubmit">Submit</button>
						</div>
                        </div>
                        
							
                    </form>
                </div>
            </section>
            
            

            

            </div>
            </div>

            </div>
            <!--body wrapper end-->
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
