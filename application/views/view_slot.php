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
                    View Slot
                </h3>
                <!--<span class="sub-title">Welcome to Static Table</span>-->
                <div class="state-information">
                    <ol class="breadcrumb m-b-less bg-less">
                        <li><a href="<?php echo base_url();?>admin/dashboard">Home</a></li>
						<li><a href="<?php echo base_url();?>admin/listvenue/<?php echo $venueid;?>">Venues List</a></li>
                        <li><a href="<?php echo base_url();?>admin/manageslots/<?php echo $venueid;?>">Slots</a></li>
                        <li class="active">View Slot</li>
                    </ol>
                </div>
            </div>
            <!-- page head end-->

            <!--body wrapper start-->
            <div class="wrapper">
				<div class="row">
                    <div class="col-sm-12">
					
                        <section class="panel">
                            <header class="panel-heading ">
                                
                                <!--<span class="tools pull-right">
                                    <a class="fa fa-repeat box-refresh" href="javascript:;"></a>
                                    <a class="t-close fa fa-times" href="javascript:;"></a>
                                </span>-->
                            </header>
                            <table class="table responsive-data-table data-table">
                            
                            
							<?php 
								//echo "<pre>";print_r($viewuserdetails);exit;
							?>
                            
						  <tr>
                                <td>
                                    Venue Name
                                </td>
                                <td>
                                    :
                                </td>
                                <td>
                                   <?php echo $viewslotinfo->venue_display_name;?>
									</td>
                                
                          </tr>
							<tr>
                                <td>
                                   Category Name
                                </td>
                                <td>
                                    :
                                </td>
                                <td>
                                    <?php echo $viewslotinfo->category_name;?>
                                </td>
                          </tr>
						  <tr>
                                <td>
                                    Subcategory Name
                                </td>
                                <td>
                                    :
                                </td>
                                <td>
                                    <?php echo $viewslotinfo->sub_category_name ?>
                                </td>
                         </tr>
							<!--<tr>
                                <td>
                                    Day
                                </td>
                                <td>
                                    :
                                </td>
                                <td>
                                   <?php
										//$dayarray=array("1"=>"Monday","2"=>"Tuesday","3"=>"Wednesday","4"=>"Thursday","5"=>"Friday","6"=>"Saturday","7"=>"Sunday");
								   //echo $dayarray[$viewslotinfo->day_id];?>
                                </td>
                         </tr>-->
							<tr>
                                <td>
                                    Slot From Time
                                </td>
                                <td>
                                    :
                                </td>
                                <td>
                                    <?php echo $viewslotinfo->slot_from_time;?>
                                </td>
                          </tr>
						  <tr>
                                <td>
                                    Slot To Time
                                </td>
                                <td>
                                    :
                                </td>
                                <td>
                                    <?php echo $viewslotinfo->slot_to_time;?>
                                </td>
                          </tr>
						  <tr>
                                <td>
                                    Max Limit
                                </td>
                                <td>
                                    :
                                </td>
                                <td>
                                    <?php echo $viewslotinfo->quantity;?>
                                </td>
                          </tr>
							</tbody>
                            </table>
                        </section>
						
						
                    </div>

                </div>

                

            </div>
            <!--body wrapper end-->


            <?php $this->load->view("includes/admin_footer");?>