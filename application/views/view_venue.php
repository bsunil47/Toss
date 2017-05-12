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
                    View Venue
                </h3>
                <!--<span class="sub-title">Welcome to Static Table</span>-->
                <div class="state-information">
                    <ol class="breadcrumb m-b-less bg-less">
                        <li><a href="<?php echo base_url();?>admin/dashboard">Home</a></li>
                        <li><a href="#" onclick="window.history.back();return false;">Venues</a></li>
                        <li class="active">View Venue</li>
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
                                <strong>Venue Information</strong>
                                <!--<span class="tools pull-right">
                                    <a class="fa fa-repeat box-refresh" href="javascript:;"></a>
                                    <a class="t-close fa fa-times" href="javascript:;"></a>
                                </span>-->
                            </header>
                            <table class="datatable-2 table responsive-data-table data-table">
                            
                            
							<?php //echo "<pre>";print_r($viewvendordetails);echo "object";
								$viewvenue=(array)$viewvenueinfo;
								//echo "<pre>";print_r($viewvenue);exit;
								//echo "<pre>";print_r($workinghours);exit;
							?>
                            <tr>
                                <td>
                                    &nbsp;
                                </td>
                                <td>
                                    &nbsp;
                                </td>
                                <td>
                                    
									<img src="<?php echo base_url();?>images/profiles/<?php echo $viewvenue['vendorid']."_user";?>.jpg" style="width:auto;height:160px;"/>
                                </td>
                                
                          </tr>
						  <tr>
                                <td>
                                    Display Name
                                </td>
                                <td>
                                    :
                                </td>
                                <td>
                                    <?php echo ucfirst($viewvenue['venue_display_name']);?>
									</td>
                                
                          </tr>
							
							<tr>
                                <td>
                                    Address
                                </td>
                                <td>
                                    :
                                </td>
                                <td>
                                    <?php echo $viewvenue['venueaddress'];?>
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
                                    <?php echo $viewvenue['venueaddresstwo'];?>
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
                                    <?php echo $viewvenue['venuecity'];?>
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
                                    <?php echo $viewvenue['venuestate'];?>
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
                                    <?php echo $viewvenue['venuecountry'];?>
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
                                    <?php echo $viewvenue['venuepincode'];?>
                                </td>
                          </tr>
							
							
						  
							
							
                            </tbody>
                            </table>
                        </section>
						</div>
						<div class="col-sm-6" style="float:right;">
						<section class="panel">
                            <header class="panel-heading ">
                                <strong>Venue Information</strong>
                                <!--<span class="tools pull-right">
                                    <a class="fa fa-repeat box-refresh" href="javascript:;"></a>
                                    <a class="t-close fa fa-times" href="javascript:;"></a>
                                </span>-->
                            </header>
                            <table class="table responsive-data-table data-table">
						<tbody>
						<tr>
                                <td>
                                    Venue Image 1
                                </td>
                                <td>
                                    :
                                </td>
                                <td>
                                    <a data-toggle="modal" href="#myModal2">Image 1</a>
                                </td>
								<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title">Venue Image 1</h4>
                                </div>
                                <div class="modal-body">

                                    <img src="<?php echo base_url()?>images/vendors/<?php echo $viewvenue['vendorid'];?>/<?php echo $viewvenue['venueid'];?>/<?php echo $viewvenue['venue_pic_1'];?>" style="width:auto;height:100px"/>

                                </div>
                                <div class="modal-footer">
                                   <!--<button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                                    <button class="btn btn-warning" type="button"> Confirm</button>-->
                                </div>
                            </div>
                        </div>
                    </div>
                          </tr>
							<tr>
                                <td>
                                    Venue Image 2
                                </td>
                                <td>
                                    :
                                </td>
                                <td>
                                   <a data-toggle="modal" href="#myModal3"> Image 2 </a>
                                </td>
								<div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title">Venue Image 2</h4>
                                </div>
                                <div class="modal-body">

                                    <img src="<?php echo base_url()?>images/vendors/<?php echo $viewvenue['vendorid'];?>/<?php echo $viewvenue['venueid'];?>/<?php echo $viewvenue['venue_pic_2'];?>" style="width:auto;height:100px"/>

                                </div>
                                <div class="modal-footer">
                                    <!--<button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                                   <button class="btn btn-warning" type="button"> Confirm</button>-->
                                </div>
                            </div>
                        </div>
                    </div>
                          </tr>
							<tr>
                                <td>
                                    Venue Image 3
                                </td>
                                <td>
                                    :
                                </td>
                                <td>
                                   <a data-toggle="modal" href="#myModal4">Image 3</a>
                                </td>
								<div class="modal fade" id="myModal4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title">Venue Image 3</h4>
                                </div>
                                <div class="modal-body">

                                    <img src="<?php echo base_url()?>images/vendors/<?php echo $viewvenue['vendorid'];?>/<?php echo $viewvenue['venueid'];?>/<?php echo $viewvenue['venue_pic_3'];?>" style="width:auto;height:100px"/>

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
                                    Venue Image 4
                                </td>
                                <td>
                                    :
                                </td>
                                <td>
                                    <a data-toggle="modal" href="#myModal5">Image 4</a>
                                </td>
								<div class="modal fade" id="myModal5" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title">Venue Image 4</h4>
                                </div>
                                <div class="modal-body">

                                    <img src="<?php echo base_url()?>images/vendors/<?php echo $viewvenue['vendorid'];?>/<?php echo $viewvenue['venueid'];?>/<?php echo $viewvenue['venue_pic_4'];?>" style="width:auto;height:100px"/>

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
                                    Venue Image 5
                                </td>
                                <td>
                                    :
                                </td>
                                <td>
                                    <a data-toggle="modal" href="#myModal6">Image 5</a>
                                </td>
								<div class="modal fade" id="myModal6" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title">Venue Image 5</h4>
                                </div>
                                <div class="modal-body">
										
                                    <img src="<?php echo base_url()?>images/vendors/<?php echo $viewvenue['vendorid'];?>/<?php echo $viewvenue['venueid'];?>/<?php echo $viewvenue['venue_pic_5'];?>" style="width:auto;height:100px"/>

                                </div>
                                <div class="modal-footer">
                                    <!--<button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                                    <button class="btn btn-warning" type="button"> Confirm</button>-->
                                </div>
                            </div>
                        </div>
                    </div>
                          </tr>
						
						  <tr>
                                <td>
                                    Location
                                </td>
                                <td>
                                    :
                                </td>
                                <td>
                                    <?php echo $viewvenue['location'];?>
                                </td>
                          </tr>
						  <tr>
                                <td>
                                    Latittude
                                </td>
                                <td>
                                    :
                                </td>
                                <td>
                                    <?php echo $viewvenue['lat'];?>
                                </td>
                          </tr>
						  <tr>
                                <td>
                                    Longittude
                                </td>
                                <td>
                                    :
                                </td>
                                <td>
                                    <?php echo $viewvenue['lng'];?>
                                </td>
                          </tr>
						  <tr>
                                <td>
                                    Contact Person
                                </td>
                                <td>
                                    :
                                </td>
                                <td>
                                    <?php echo ucfirst($viewvenue['contact_person']);?>
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
                                    <?php echo $viewvenue['phone'];?>
                                </td>
                          </tr>
						  <tr>
                                <td>
                                    E-mail
                                </td>
                                <td>
                                    :
                                </td>
                                <td>
                                    <?php echo $viewvenue['email'];?>
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
                                    <?php echo $viewvenue['created_on'];?>
                                </td>
                          </tr>
						  </tbody>
                            </table>
							</section>
							</div>
                    </div>

                </div>

                <!-- working hours and facilities -->
				
				
				<div class="row">
                    <div class="col-sm-12">
					<div class="col-sm-6" style="float:left;">
                        <section class="panel">
                            <header class="panel-heading ">
                                <strong>Working Hours Information</strong>
                                <!--<span class="tools pull-right">
                                    <a class="fa fa-repeat box-refresh" href="javascript:;"></a>
                                    <a class="t-close fa fa-times" href="javascript:;"></a>
                                </span>-->
                            </header>
                            <table class="datatable-2 table responsive-data-table data-table">
                            
                            
							<?php //echo "<pre>";print_r($viewvendordetails);echo "object";
								$viewvenue=(array)$viewvenueinfo;
								//echo "<pre>";print_r($viewvenue);exit;
								//echo "<pre>";print_r($workinghours);exit;
							?>
                            
						  <tr>
                                <td>
                                    Monday
                                </td>
                                <td>
                                    :
                                </td>
                                <td>
                                    <?php if(isset($workinghours[0]->start_time)){echo substr($workinghours[0]->start_time,0,5);?> AM<?php }?><strong>&nbsp;&nbsp; to &nbsp;&nbsp;</strong><?php if (isset($workinghours[0]->end_time)){echo substr($workinghours[0]->end_time,0,5);?> PM<?php }?>
									</td>
                                
                          </tr>
							<tr>
                                <td>
                                    Tuesday
                                </td>
                                <td>
                                    :
                                </td>
                                <td>
                                    <?php if(isset($workinghours[1]->start_time)){echo substr($workinghours[1]->start_time,0,5);?> AM<?php }?><strong>&nbsp;&nbsp; to &nbsp;&nbsp;</strong><?php if (isset($workinghours[1]->end_time)){echo substr($workinghours[1]->end_time,0,5);?> PM<?php }?>
                                </td>
                          </tr>
							<tr>
                                <td>
                                    Wednesday
                                </td>
                                <td>
                                    :
                                </td>
                                <td>
                                    <?php if(isset($workinghours[2]->start_time)){echo substr($workinghours[2]->start_time,0,5);?> AM<?php }?><strong>&nbsp;&nbsp; to &nbsp;&nbsp;</strong><?php if (isset($workinghours[2]->end_time)){echo substr($workinghours[2]->end_time,0,5);?> PM<?php }?>
                                </td>
                         </tr>
							<tr>
                                <td>
                                    Thursday
                                </td>
                                <td>
                                    :
                                </td>
                                <td>
                                     <?php if(isset($workinghours[3]->start_time)){echo substr($workinghours[3]->start_time,0,5);?> AM<?php }?><strong>&nbsp;&nbsp; to &nbsp;&nbsp;</strong><?php if (isset($workinghours[3]->end_time)){echo substr($workinghours[3]->end_time,0,5);?> PM<?php }?>
                                </td>
                         </tr>
							<tr>
                                <td>
                                    Friday
                                </td>
                                <td>
                                    :
                                </td>
                                <td>
                                    <?php if(isset($workinghours[4]->start_time)){echo substr($workinghours[4]->start_time,0,5);?> AM<?php }?><strong>&nbsp;&nbsp; to &nbsp;&nbsp;</strong><?php if (isset($workinghours[4]->end_time)){echo substr($workinghours[4]->end_time,0,5);?> PM<?php }?>
                                </td>
                         </tr>
							<tr>
                                <td>
                                    Saturday
                                </td>
                                <td>
                                    :
                                </td>
                                <td>
                                    <?php if(isset($workinghours[5]->start_time)){echo substr($workinghours[5]->start_time,0,5);?> AM<?php }?><strong>&nbsp;&nbsp; to &nbsp;&nbsp;</strong><?php if (isset($workinghours[5]->end_time)){echo substr($workinghours[5]->end_time,0,5);?> PM<?php }?>
                                </td>
                          </tr>
							
							<tr>
                                <td>
                                    Sunday
                                </td>
                                <td>
                                    :
                                </td>
                                <td>
                                    <?php if(isset($workinghours[6]->start_time)){echo substr($workinghours[6]->start_time,0,5);?> AM<?php }?><strong>&nbsp;&nbsp; to &nbsp;&nbsp;</strong><?php if (isset($workinghours[6]->end_time)){echo substr($workinghours[6]->end_time,0,5);?> PM<?php }?>
                                </td>
                          </tr>
						  
							
							
                            </tbody>
                            </table>
                        </section>
						</div>
						<div class="col-sm-6" style="float:right;">
						<section class="panel">
                            <header class="panel-heading ">
                                <strong>Facilities Information</strong>
                                <!--<span class="tools pull-right">
                                    <a class="fa fa-repeat box-refresh" href="javascript:;"></a>
                                    <a class="t-close fa fa-times" href="javascript:;"></a>
                                </span>-->
                            </header>
                            <table class="table responsive-data-table data-table">
						<tbody>
						
						<?php for($i=0;$i<count($facilities);$i++){?>
						  <tr>
                                <td>
                                    Facility <?php echo $i+1;?>
                                </td>
                                <td>
                                    :
                                </td>
                                <td>
                                    <?php echo stripslashes(ucfirst($facilities[$i]->facility_name));?>
                                </td>
                          </tr>
						 <?php } ?>
						  </tbody>
                            </table>
							</section>
							</div>
                    </div>

                </div>
				<!-- end of working hours and facilities-->

            </div>
            <!--body wrapper end-->


            <?php $this->load->view("includes/admin_footer");?>
