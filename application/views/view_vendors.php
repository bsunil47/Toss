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
                <h3 class="m-b-less">
                    View Vendor
                </h3>
                <!--<span class="sub-title">Welcome to Static Table</span>-->
                <div class="state-information">
                    <ol class="breadcrumb m-b-less bg-less">
                        <li><a href="<?php echo base_url();?>admin/dashboard">Home</a></li>
                        <li><a href="<?php echo base_url();?>admin/managevendors">Vendors</a></li>
                        <li class="active">View Vendor</li>
                    </ol>
                </div>
            </div>
            <!-- page head end-->

            <!--body wrapper start-->
            <div class="wrapper">
				<div class="row">
                    <div class="col-sm-12">
					<div class="col-sm-6" style="float:left;">
                        <section class="panel">
                            <header class="panel-heading ">
                                <strong>Vendor Information</strong>
                                <!--<span class="tools pull-right">
                                    <a class="fa fa-repeat box-refresh" href="javascript:;"></a>
                                    <a class="t-close fa fa-times" href="javascript:;"></a>
                                </span>-->
                            </header>
                            <table class="datatable-2 table responsive-data-table data-table">
                            
                            
							<?php //echo "<pre>";print_r($viewvendordetails);echo "object";
								$viewvendor=(array)$viewvendordetails;
								//echo "<pre>";print_r($viewvendor);exit;
							?>
                            <tr>
                                <td>
                                    &nbsp;
                                </td>
                                <td>
                                    &nbsp;
                                </td>
                                <td>
                                    
									<img src="<?php echo base_url();?>images/profiles/<?php echo $viewvendor['vendor_id']."_user";?>.jpg" style="width:auto;height:160px;"/>
                                </td>
                                
                          </tr>
						  <tr>
                                <td>
                                    Company Name
                                </td>
                                <td>
                                    :
                                </td>
                                <td>
                                    <?php echo ucfirst($viewvendor['company_name']);?>
									</td>
                                
                          </tr>
							<tr>
                                <td>
                                    Category_type
                                </td>
                                <td>
                                    :
                                </td>
                                <td>
                                    <?php echo $viewvendor['venuecategory'];?>
                                </td>
                          </tr>
						  <tr>
                                <td>
                                    Phone
                                </td>
                                <td>
                                    :
                                </td>
                                <td>
                                    <?php echo $viewvendor['vendorphone'];?>
                                </td>
                         </tr>
							<tr>
                                <td>
                                    Address1
                                </td>
                                <td>
                                    :
                                </td>
                                <td>
                                    <?php echo $viewvendor['venueaddress'];?>
                                </td>
                         </tr>
							<tr>
                                <td>
                                    Address2
                                </td>
                                <td>
                                    :
                                </td>
                                <td>
                                    <?php echo $viewvendor['venueaddresstwo'];?>
                                </td>
                          </tr>
							<tr>
                                <td>
                                    City
                                </td>
                                <td>
                                    :
                                </td>
                                <td>
                                    <?php echo $viewvendor['venuecity'];?>
                                </td>
                         </tr>
							<tr>
                                <td>
                                    State
                                </td>
                                <td>
                                    :
                                </td>
                                <td>
                                    <?php echo $viewvendor['venuestate'];?>
                                </td>
                         </tr>
							<tr>
                                <td>
                                    Country
                                </td>
                                <td>
                                    :
                                </td>
                                <td>
                                    <?php echo $viewvendor['venuecountry'];?>
                                </td>
                         </tr>
							<tr>
                                <td>
                                    Pincode
                                </td>
                                <td>
                                    :
                                </td>
                                <td>
                                    <?php echo $viewvendor['venuepin'];?>
                                </td>
                          </tr>
							<tr>
                                <td>
                                    Venue Display Name
                                </td>
                                <td>
                                    :
                                </td>
                                <td>
                                    <?php echo $viewvendor['venue_display_name'];?>
                                </td>
                          </tr>
							
						  
							
							
                            </tbody>
                            </table>
                        </section>
						</div>
						<div class="col-sm-6" style="float:right;">
						<section class="panel">
                            <header class="panel-heading ">
                                <strong>Vendor Information</strong>
                                <!--<span class="tools pull-right">
                                    <a class="fa fa-repeat box-refresh" href="javascript:;"></a>
                                    <a class="t-close fa fa-times" href="javascript:;"></a>
                                </span>-->
                            </header>
                            <table class="table responsive-data-table data-table">
						<tbody>
						<tr>
                                <td>
                                    PAN
                                </td>
                                <td>
                                    :
                                </td>
                                <td>
                                    <a data-toggle="modal" href="#myModal2"><?php echo $viewvendor['pan'];?></a>
                                </td>
								<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title">PAN Image</h4>
                                </div>
                                <div class="modal-body">

                                    <img src="<?php echo base_url()?>images/vendors/<?php echo $viewvendor['vendor_id'];?>/<?php echo $viewvendor['pan_image'];?>" style="width:auto;height:100px"/>

                                </div>
                                <div class="modal-footer">
                                   <!-- <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                                    <button class="btn btn-warning" type="button"> Confirm</button>-->
                                </div>
                            </div>
                        </div>
                    </div>
                          </tr>
							<tr>
                                <td>
                                    VAT
                                </td>
                                <td>
                                    :
                                </td>
                                <td>
                                   <a data-toggle="modal" href="#myModal3"> <?php echo $viewvendor['vat'];?></a>
                                </td>
								<div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title">VAT Image</h4>
                                </div>
                                <div class="modal-body">

                                    <img src="<?php echo base_url()?>images/vendors/<?php echo $viewvendor['vendor_id'];?>/<?php echo $viewvendor['vat_image'];?>" style="width:auto;height:100px"/>

                                </div>
                                <div class="modal-footer">
                                   <!-- <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                                    <button class="btn btn-warning" type="button"> Confirm</button>-->
                                </div>
                            </div>
                        </div>
                    </div>
                          </tr>
							<tr>
                                <td>
                                    CST
                                </td>
                                <td>
                                    :
                                </td>
                                <td>
                                   <a data-toggle="modal" href="#myModal4"><?php echo $viewvendor['cst'];?></a>
                                </td>
								<div class="modal fade" id="myModal4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title">CST Image</h4>
                                </div>
                                <div class="modal-body">

                                    <img src="<?php echo base_url()?>images/vendors/<?php echo $viewvendor['vendor_id'];?>/<?php echo $viewvendor['cst_image'];?>" style="width:auto;height:100px"/>

                                </div>
                                <div class="modal-footer">
                                   <!-- <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                                    <button class="btn btn-warning" type="button"> Confirm</button>-->
                                </div>
                            </div>
                        </div>
                    </div>
                          </tr>
							<tr>
                                <td>
                                    TAN
                                </td>
                                <td>
                                    :
                                </td>
                                <td>
                                    <a data-toggle="modal" href="#myModal5"><?php echo $viewvendor['tan'];?></a>
                                </td>
								<div class="modal fade" id="myModal5" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title">TAN Image</h4>
                                </div>
                                <div class="modal-body">

                                    <img src="<?php echo base_url()?>images/vendors/<?php echo $viewvendor['vendor_id'];?>/<?php echo $viewvendor['tan_image'];?>" style="width:auto;height:100px"/>

                                </div>
                                <div class="modal-footer">
                                   <!-- <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                                    <button class="btn btn-warning" type="button"> Confirm</button>-->
                                </div>
                            </div>
                        </div>
                    </div>
                         </tr>
							<tr>
                                <td>
                                    Servie Tax
                                </td>
                                <td>
                                    :
                                </td>
                                <td>
                                    <a data-toggle="modal" href="#myModal6"><?php echo $viewvendor['service_tax'];?></a>
                                </td>
								<div class="modal fade" id="myModal6" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title">Service Tax Image</h4>
                                </div>
                                <div class="modal-body">

                                    <img src="<?php echo base_url()?>images/vendors/<?php echo $viewvendor['vendor_id'];?>/<?php echo $viewvendor['service_tax_image'];?>" style="width:auto;height:100px"/>

                                </div>
                                <div class="modal-footer">
                                   <!-- <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                                    <button class="btn btn-warning" type="button"> Confirm</button>-->
                                </div>
                            </div>
                        </div>
                    </div>
                          </tr>
						<tr>
                                <td>
                                    Cancelled Cheque
                                </td>
                                <td>
                                    :
                                </td>
                                <td>
                                    <a data-toggle="modal" href="#myModal7">Cheque</a>
                                </td>
								<div class="modal fade" id="myModal7" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title">Cancelled Cheque Image</h4>
                                </div>
                                <div class="modal-body">

                                    <img src="<?php echo base_url()?>images/vendors/<?php echo $viewvendor['vendor_id'];?>/<?php echo $viewvendor['cancelled_cheque_image'];?>" style="width:auto;height:100px"/>

                                </div>
                                <div class="modal-footer">
                                   <!-- <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                                    <button class="btn btn-warning" type="button"> Confirm</button>-->
                                </div>
                            </div>
                        </div>
                    </div>
                          </tr>
						  <tr>
                                <td>
                                    Vendor Address
                                </td>
                                <td>
                                    :
                                </td>
                                <td>
                                    <?php echo $viewvendor['vendoraddress'];?>
                                </td>
                          </tr>
						  <tr>
                                <td>
                                    Vendor Address2
                                </td>
                                <td>
                                    :
                                </td>
                                <td>
                                    <?php echo $viewvendor['vendoraddresstwo'];?>
                                </td>
                          </tr>
						  <tr>
                                <td>
                                    Vendor City
                                </td>
                                <td>
                                    :
                                </td>
                                <td>
                                    <?php echo $viewvendor['vendorcity'];?>
                                </td>
                          </tr>
						  <tr>
                                <td>
                                    Vendor State
                                </td>
                                <td>
                                    :
                                </td>
                                <td>
                                    <?php echo $viewvendor['vendorstate'];?>
                                </td>
                          </tr>
						  <tr>
                                <td>
                                    Vendor Country
                                </td>
                                <td>
                                    :
                                </td>
                                <td>
                                    <?php echo $viewvendor['vendorcountry'];?>
                                </td>
                          </tr>
						  <tr>
                                <td>
                                    Vendor Pincode
                                </td>
                                <td>
                                    :
                                </td>
                                <td>
                                    <?php echo $viewvendor['vendorpin'];?>
                                </td>
                          </tr>
						  <tr>
                                <td>
                                    Beneficiary Name
                                </td>
                                <td>
                                    :
                                </td>
                                <td>
                                    <?php echo ucfirst($viewvendor['beneficiary_name']);?>
                                </td>
                          </tr>
						  <tr>
                                <td>
                                    Accont Number
                                </td>
                                <td>
                                    :
                                </td>
                                <td>
                                    <?php echo $viewvendor['account_number'];?>
                                </td>
                          </tr>
						  <tr>
                                <td>
                                    Account Type
                                </td>
                                <td>
                                    :
                                </td>
                                <td>
                                    <?php echo $viewvendor['account_type'];?>
                                </td>
                          </tr>
						  <tr>
                                <td>
                                    IFSC Code
                                </td>
                                <td>
                                    :
                                </td>
                                <td>
                                    <?php echo $viewvendor['ifsc_code'];?>
                                </td>
                          </tr>
						  <tr>
                                <td>
                                    Website Url
                                </td>
                                <td>
                                    :
                                </td>
                                <td>
                                    <?php echo $viewvendor['web_url'];?>
                                </td>
                          </tr>
						  <tr>
                                <td>
                                    Ohter Website
                                </td>
                                <td>
                                    :
                                </td>
                                <td>
                                    <?php echo $viewvendor['web_url2'];?>
                                </td>
                          </tr>
						  <tr>
                                <td>
                                    Other Info One
                                </td>
                                <td>
                                    :
                                </td>
                                <td>
                                    <?php echo $viewvendor['other_info_one'];?>
                                </td>
                          </tr>
						  <tr>
                                <td>
                                    Other Info Two
                                </td>
                                <td>
                                    :
                                </td>
                                <td>
                                    <?php echo $viewvendor['other_info_two'];?>
                                </td>
                          </tr>
						  <tr>
                                <td>
                                    Other Info Three
                                </td>
                                <td>
                                    :
                                </td>
                                <td>
                                    <?php echo $viewvendor['other_info_three'];?>
                                </td>
                          </tr>
						  <tr>
                                <td>
                                    Registerd Date
                                </td>
                                <td>
                                    :
                                </td>
                                <td>
                                    <?php echo $viewvendor['created_on'];?>
                                </td>
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