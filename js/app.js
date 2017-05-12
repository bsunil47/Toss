/**
 * Created by Kesav on 6/6/2016.
 */
jQuery(document).on('change','.category',function(){
    //alert("I M HERE");
    var catid=jQuery(this).val();
    //alert(catid);
    //var datastring='catid'+catid;
    var url=base_url+'ajax/categorychange';
    jQuery.ajax({
        type:'POST',
        url:url,
        data:{'catid': catid },
        dataType:"JSON",
        success: function(data){
            //jQuery(".subcategory option[value='x']").remove();
            jQuery('.subappend').html(data);
			var first="Select One";
			jQuery('.subappend').append('<select id="multiple1" class="select2 form-control m-b-10 subcategory" name="sub_cat_id[]" multiple><option value="">' +  first + '</option>');
			for(i in data){
			jQuery('.subcategory').append('<option  value="'+ data[i].sub_category_id + '">' + data[i].sub_category_name +'</option>');
			}
			jQuery('.subcategory').append('</select>');
			var placeholder = "Select One";
				jQuery('select.subcategory').select2({
						placeholder: placeholder
				});
                    }
    });
});
jQuery(document).on('change','.subcategory',function(){
    //alert("I M HERE");
    var catid=jQuery('#multiple').val();
    var subcatid=jQuery(this).val();
    var url=base_url+'ajax/subcategorychange';
    jQuery.ajax({
        type:'POST',
        url:url,
        data:{'catid': catid,'subcatid':subcatid },
        dataType:"JSON",
        success: function(data){
            //jQuery(".subcategory option[value='x']").remove();
            jQuery('.subsubappend').html(data);
			var first="Select One";
			jQuery('.subsubappend').append('<select id="multiple2" class="select2 form-control m-b-10 subsubcategory" name="sub_sub_cat_id[]" multiple><option value="">' +  first + '</option>');
			for(i in data){
			jQuery('.subsubcategory').append('<option  value="'+ data[i].sub_sub_category_id + '">' + data[i].sub_sub_category_name +'</option>');
			}
			jQuery('.subsubcategory').append('</select>');
			var placeholder = "Select One";
				jQuery('select.subsubcategory').select2({
						placeholder: placeholder
				});
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
/*
 * Edit venue JS Start
 * 
 */
jQuery(document).ready(function(){
var placeholder = "Select One";
	jQuery('select.select2').select2({
		placeholder: placeholder
	});
	
jQuery(document).on('change','.category',function(){
	var catid=jQuery(this).val();
	 jQuery('.fac_cls').hide();
	 jQuery('.cat_'+catid).show();
	
	var url='<?php echo base_url()?>admin/categorychange';
	
	jQuery.ajax({
		type:'POST',
		url:url,
		data:{'catid': catid },
		dataType:"JSON",
		success: function(data){
			//jQuery(".subcategory option[value='x']").remove();
			jQuery('.subappend').html(data);
			var first="Select One";
			jQuery('.subappend').append('<select id="multiple1" class="select2 form-control m-b-10 subcategory" name="sub_cat_id[]" multiple><option value="">' +  first + '</option>');
			for(i in data){
			jQuery('#multiple1').append('<option  value="'+ data[i].sub_category_id + '">' + data[i].sub_category_name +'</option>');
			}
			jQuery('#multiple1').append('</select>');
			var placeholder = "Select One";
				jQuery('select#multiple1').select2({
						placeholder: placeholder
				});
		}
		
	});

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
	var url='<?php echo base_url()?>admin/subcategorychange';
	
	jQuery.ajax({
		type:'POST',
		url:url,
		data:{'catid': catid,'subcatid': subcatid },
		dataType:"JSON",
		success: function(data){
			//jQuery(".subcategory option[value='x']").remove();
			jQuery('.subsubappend').html(data);
			var second="Select One";
			jQuery('.subsubappend').append('<select id="multiple2" class="select2 form-control m-b-10 subsubcategory" name="sub_sub_cat_id[]" multiple><option value="">' +  second + '</option>');
			for(j in data){
				jQuery('#multiple2').append('<option  value="'+ data[j].sub_sub_category_id + '">' + data[j].sub_sub_category_name +'</option>');
			}
			jQuery('#multiple2').append('</select>');
			var placeholder = "Select One";
				jQuery('select#multiple2').select2({
						placeholder: placeholder
				});
		}
		
	});
		//jQuery('select.select2').select2();

});
});
/*
 * Add Pricing JS 
 */
 jQuery(document).on('change','#scategory',function(){ 
        var v = jQuery(this).val();
	var url=base_url+"ajax/getvenuesubsubcategories";
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
	     
});
/**
 * Addon js
 */
jQuery(document).on('change','#facility',function(){
    var e = jQuery(this).val();
	               if(e=='other'){
                        document.getElementById('other').style.display='block';
                    }else{
                        document.getElementById('other').style.display='none';
                    }
                });
 jQuery(document).on('change','#ptype',function(){                     
     var v=  jQuery(this).val();   
     if(v=='2'){
   var url=base_url+'ajax/getasubcategories';
    var first="Select Sub Category";
    jQuery.ajax({
		type:'POST',
		url:url,
		data:{'venue_id':venue_id },
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
	var url=base_url+'ajax/getasubsubcategories';
    var first="Select Sub SubCategory";
    jQuery.ajax({
		type:'POST',
		url:url,
		data:{'venue_id':venue_id },
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
});
/*
 *JS For FAcilities 
 */
jQuery(document).on('change','#fatype',function(){
    var f=jQuery(this).val();   
    if(f=='1'){
    jQuery('#dis').css("display","block");
    var url=base_url+'ajax/getcategories';
    var first="Select  Category";
    jQuery.ajax({
		type:'POST',
		url:url,
		data:{'id': f },
		dataType:"JSON",
		success: function(data){
			//jQuery(".subcategory option[value='x']").remove();
			jQuery('#ftype').html(data);
			jQuery('#ftype').append('<option value="">' +  first + '</option>');
			for(i in data){
				jQuery('#ftype').append('<option  value="'+ data[i].category_id + '">' + data[i].category_name +'</option>');
			}
		
		}
		
	});    
    }else if(f=='2'){
    jQuery('#dis').css("display","block");
    var url=base_url+'ajax/getsubcategories';
    var first="Select Sub Category";
    jQuery.ajax({
		type:'POST',
		url:url,
		data:{'id': f },
		dataType:"JSON",
		success: function(data){
			//jQuery(".subcategory option[value='x']").remove();
			jQuery('#ftype').html(data);
			jQuery('#ftype').append('<option value="">' +  first + '</option>');
			for(i in data){
				jQuery('#ftype').append('<option  value="'+ data[i].sub_category_id + '">' + data[i].sub_category_name +'</option>');
			}
		
		}
		
	});    
    }else if(f=='3'){
   jQuery('#dis').css("display","block");
    var url=base_url+'ajax/getsubsubcategories';
    var first="Select Sub Sub Category";
    jQuery.ajax({
		type:'POST',
		url:url,
		data:{'id': f },
		dataType:"JSON",
		success: function(data){
			//jQuery(".subcategory option[value='x']").remove();
			jQuery('#ftype').html(data);
			jQuery('#ftype').append('<option value="">' +  first + '</option>');
			for(i in data){
				jQuery('#ftype').append('<option  value="'+ data[i].sub_sub_category_id + '">' + data[i].sub_sub_category_name +'</option>');
			}
		
		}
		
	});
}	else if(f=='4'){
		jQuery('#dis').css("display","none");
		
	}
});