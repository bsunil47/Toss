            <!-- page head start-->
            <div class="page-head">
                <h3 class="m-b-less">
                    Venues List
                </h3>
                <!--<span class="sub-title">Welcome to Static Table</span>-->
                <div class="state-information">
                    <ol class="breadcrumb m-b-less bg-less">
                        <li><a href="#">Home</a></li>
                        <li><a href="#">Data Table</a></li>
                        <li class="active">Dynamic Data Table</li>
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
                                Responsive Data Table
                                <span class="tools_new pull-right">
                                    <!-- <a class="btn btn-success" href="<?php //echo base_url()?>admin/addvenue"><i class="fa fa-plus"></i>Add Venue</a>
                                   <a class="t-close fa fa-times" href="javascript:;"></a>-->
                                </span>
                            </header>
                            <table class="table responsive-data-table data-table">
                            <thead>
                            <tr>
								   <th>
                                    S.No
                                </th>
                               
                                <th>
                                    Venue Name
                                </th>
                                
									<th>
                                    Status
                                </th>
								<th>
                                    Action
                                </th>
                            </tr>
                            </thead>
                            <tbody>
							
							<?php 
							//echo "<pre>";print_r($getallcategories);exit;
							foreach($venuesbyvendor as $venuebyvendor) { ?>
                            <tr>
                                <td>
                                    <?php echo $venuebyvendor->venue_id;?>
                                </td>
                                <td>
                                    <?php echo $venuebyvendor->venue_display_name;?>
                                </td>
                                <td>
								<?php if($venuebyvendor->status == 1){?>
								<i class='fa fa-check' title='Active'></i>
								
								<?php } else { ?>
								<i class='fa fa-remove' title='Inactive'></i>
								<?php } ?>
                                   
                                </td>
                                
								<td>
                                    <?php if($venuebyvendor->status == 1){?>
								<a href="<?php echo base_url()?>vendors/updatestatus/<?php echo $venuebyvendor->venueid;?>/<?php echo $venuebyvendor->venuestatus;?>/66" style="color:black;margin-right:5px;"><i class="fa fa-remove"></i></a>
                                    <?php } else { ?>
                                        <a href="<?php echo base_url()?>vendors/updatestatus/<?php echo $venuebyvendor->venueid;?>/<?php echo $venuebyvendor->venuestatus;?>/66" style="color:black;margin-right:5px;"><i class="fa fa-check"></i></a>
                                    <?php } ?>
								<a href="<?php echo base_url()?>vendors/viewvenueinfo/<?php echo $venuebyvendor->venueid;?>" style="color:black;margin-right:5px;"><i class="fa fa-eye"></i></a>
                                                                <a href="<?php echo base_url()?>vendors/manageimages/<?php echo $venuebyvendor->venueid;?>/<?php echo $venuebyvendor->vendorid;?>" title="Images" style="color:black;margin-right:5px;"><i class="fa fa-picture-o"></i></a>
								<!--class="label label-danger" -->
								
								<!--class="btn btn-success btn-xs" -->
								<a href="<?php echo base_url()?>vendors/editvendor/<?php echo $venuebyvendor->vendorid;?>" style="color:black;margin-right:5px;"><i class="fa fa-pencil"></i></a>
								<!--class="btn btn-primary btn-xs" -->
								
								</td>
                                
                            </tr>
							<?php } ?>
                            </tbody>
                            </table>
                        </section>
                    </div>

                </div>

                

            </div>
            <!--body wrapper end-->
