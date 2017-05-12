<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from thevectorlab.net/slicklab/table-dynamic.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 21 Dec 2015 07:04:27 GMT -->
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
                <h3 class="m-b-less">View Pricing</h3>
               <!--<span class="sub-title">Welcome to Static Table</span>-->
                <div class="state-information">
                    <ol class="breadcrumb m-b-less bg-less">
                        <li><a href="<?php echo base_url();?>admin/dashboard">Home</a></li>
						<li><a href="<?php echo base_url();?>admin/listvenue/<?php echo $venueid;?>">Venues List</a></li>
                        <li><a href="<?php echo base_url();?>admin/managepricing/<?php echo $venueid;?>">Pricing</a></li>
                        <li class="active">View Pricing</li>
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
                                <td>Vendor Name</td> <td>:</td>
                                <td><?php  echo $getdetails->company_name;?> </td>
                            </tr>
							<tr>
                                <td> Venue Name </td>
                                <td> : </td>
                                <td><?php echo $getdetails->venue_display_name;?></td>
							</tr>
							<tr>
                                <td> Pricing Type</td>
                                <td> :</td>
                                <td> <?php 
                                        echo $getdetails->membership_name;
                                    
                                    ?>                                    
                                   </td>
							</tr>
							<tr>
                                <td> Price </td>
                                <td> : </td>
                                <td> <?php echo $getdetails->amount; ?> </td>
							</tr>
							<tr>
                                <td> Discount Type</td>
                                <td>:</td>
                                <td><?php if($getdetails->discount_type==1){
                                        echo "percentage";
                                    }else if($getdetails->discount_type==2){
                                        echo "Flat";
                                    }?>
                                </td>
							</tr>
							<tr>
                                <td>Discount Amount</td>
                                <td>:</td>
                                <td><?php echo $getdetails->discount_amount;?></td>
							</tr>
				            </tbody>
                            </table>
                        </section>
						</div>			
                    </div>
                </div>    
            </div>
<!--body wrapper end-->
<?php $this->load->view("includes/admin_footer");?>
<script>

    var max_fields      = 10; //maximum input boxes allowed
    var wrapper         = jQuery(".input_fields_wrap"); //Fields wrapper
    var add_button      = jQuery(".add_field_button"); //Add button ID
   
    var x = 1; //initlal text box count
    jQuery(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            jQuery(wrapper).append('<div><div class="form-group clearfix"><label class="col-sm-2 col-sm-2 control-label">Slot Time</label><div class="col-sm-5">From<div class="input-group  bootstrap-timepicker"><input type="text" name="frm_dte['+x+']" id="frm_dte'+x+'" value="" class="form-control timepicker-24"><span class="input-group-btn"><button type="button" class="btn btn-default"><i class="fa fa-clock-o"></i></button></span></div><?php //echo form_error('frm_dte');?></div><div class="col-sm-5">To<div class="input-group  bootstrap-timepicker"><input type="text" name="to_dte['+x+']" id="to_dte'+x+'" value="" class="form-control timepicker-24_to"><span class="input-group-btn"><button type="button" class="btn btn-default"><i class="fa fa-clock-o"></i></button></span></div><?php //echo form_error('to_dte');?></div></div><div class="form-group clearfix"><label class="col-sm-2 col-sm-2 control-label">Max Limit </label><div class="col-sm-10"><input type="text" class="form-control" name="max_limitx['+x+']" id="max_limit'+x+'"><?php //echo form_error('max_limit')?></div></div><a href="#" class="remove_field">Remove</a></div>'); //add input box
        }
    });
   
    jQuery(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); jQuery(this).parent('div').remove(); x--;
    })

</script>
</body>
<!-- Mirrored from thevectorlab.net/slicklab/table-dynamic.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 21 Dec 2015 07:04:39 GMT -->
</html>
