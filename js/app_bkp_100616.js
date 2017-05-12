/**
 * Created by Kesav on 6/6/2016.
 */
jQuery(document).on('change','.category',function(){
    //alert("I M HERE");
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
                jQuery('.subcategory').append('<option  value="'+ data[i].sub_category_id + '">' + data[i].sub_category_name +'</option>');
            }

        }

    });
});
/*
 * slots JS start
 */
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
      
    jQuery("#add").on('click',function(e){ //on add input button click
            e.preventDefault();
       
            var clone_div = jQuery('#Extra-slot').clone().insertBefore('#Submit-button');
            jQuery(clone_div).find('#remove_block').show();
            jQuery(clone_div).find('#add_extra_block').remove();
            jQuery(clone_div).find('.timepicker-24').val(jQuery(clone_div).prev().find('.timepicker-24_to').val());
            jQuery(clone_div).find('.timepicker-24_to').val(jQuery(clone_div).find('.timepicker-24').val());
            jQuery(clone_div).find('.max_limit').val(jQuery(clone_div).prev().find('.max_limit').val());
            jQuery('.timepicker-24, .timepicker-24_to').timepicker({
		defaultTime: false,
		//pick12HourFormat: false
                autoclose: true,
                minuteStep: 15,
                showSeconds: true,
                showMeridian: false
		});
                
           
    });
   
    jQuery(document).on("click",".remove_field", function(e){ //user click on remove text
         jQuery(this).parent('div').parent('div').remove(); 
    })
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

//var dayid=jQuery('#day_id').val();

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
	data:{'venueid':venueid,'categoryid':categoryid,'subcategoryid':subcategoryid,'slotfromtime':slotfromtime,'slottotime':slottotime },
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
/*
 * slots JS END
 */