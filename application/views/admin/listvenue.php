            <!-- page head start-->
            <div class="page-head">
                <h3 class="m-b-less">
                    Venues List
                </h3>
                <!--<span class="sub-title">Welcome to Static Table</span>-->
                <div class="state-information">
                    <ol class="breadcrumb m-b-less bg-less">
                        <li><a href="<?php echo base_url();?>admin/dashboard">Home</a></li>
                        <li><a href="<?php echo base_url();?>admin/managevendors">Vendors</a></li>
                        <li class="active">Venues List</li>
                    </ol>
                </div>
            </div>
            <!-- page head end-->

            <!--body wrapper start-->
            <div class="wrapper">
			<?php if($this->session->flashdata('venue_success')){?>
						<div class="alert alert-success alert-block fade in">
                        <button type="button" class="close close-sm" data-dismiss="alert">
                            <i class="fa fa-times"></i>
                        </button>
                        <h4>
                            <i class="fa fa-ok-sign"></i>
                            Success!
                        </h4>
                        <p><?php echo  $this->session->flashdata('venue_success');?></p>
                    </div>
								
						<?php }?>  
			<?php if($this->session->flashdata('update_venue')){?>
						<div class="alert alert-success alert-block fade in">
                        <button type="button" class="close close-sm" data-dismiss="alert">
                            <i class="fa fa-times"></i>
                        </button>
                        <h4>
                            <i class="fa fa-ok-sign"></i>
                            Success!
                        </h4>
                        <p><?php echo  $this->session->flashdata('update_venue');?></p>
                    </div>
				
						<?php }?>
				<div class="row">
                    <div class="col-sm-12">
                        <section class="panel">
                           <!-- <header class="panel-heading ">
                                
                                <span class="tools_new pull-right">
                                     <a class="btn btn-success" href="<?php //echo base_url()?>admin/addvenue"><i class="fa fa-plus"></i>Add Venue</a>
                                   <a class="t-close fa fa-times" href="javascript:;"></a>
                                </span>
                            </header>-->
							 <div class="tbl-head clearfix">
                           <div class="ColVis">
						   
                            <a class="btn btn-success" href="<?php echo base_url()?>admin/addvenue/<?php echo $this->uri->segment(3);?>"><i class="fa fa-plus"></i>Add Venue</a>  
                           </div>
                           </div>
						   
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
								if(!empty($venuesbyvendor)){
							//echo "<pre>";print_r($venuesbyvendor);exit;
							$i=1;
							foreach($venuesbyvendor as $venuebyvendor) { ?>
                            <tr>
                                <td>
                                    <?php echo $i;//echo $venuebyvendor->venueid;?>
                                </td>
                                <td>
                                    <?php echo ucfirst($venuebyvendor->venue_display_name);?>
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
								<a href="<?php echo base_url()?>admin/updatestatus/<?php echo $venuebyvendor->venueid;?>/<?php echo $venuebyvendor->venuestatus;?>/66" title="Inactive" style="color:black;margin-right:5px;"><i class="fa fa-remove"></i></a>
                                <?php } else { ?>
                             <a href="<?php echo base_url()?>admin/updatestatus/<?php echo $venuebyvendor->venueid;?>/<?php echo $venuebyvendor->venuestatus;?>/66" title="Active" style="color:black;margin-right:5px;"><i class="fa fa-check"></i></a>
                                <?php } ?>
								<a href="<?php echo base_url()?>admin/viewvenueinfo/<?php echo $venuebyvendor->venueid;?>" title="View" style="color:black;margin-right:5px;"><i class="fa fa-eye"></i></a>
								<!-- class="label label-danger" -->
								
								<!--class="btn btn-success btn-xs" -->
								<a href="<?php echo base_url()?>admin/editvenueinfo/<?php echo $venuebyvendor->venueid;?>/2/<?php echo $this->uri->segment(3);?>" title="Edit" style="color:black;margin-right:5px;"><i class="fa fa-pencil"></i></a>
								<a href="<?php echo base_url()?>admin/viewvenueusersinfo/<?php echo $venuebyvendor->venueid;?>" title="User" style="color:black;margin-right:5px;"><i class="fa fa-user"></i></a>
								<a href="<?php echo base_url()?>admin/manageslots/<?php echo $venuebyvendor->venueid;?>" title="Slots" style="color:black;margin-right:5px;"><i class="fa fa-clock-o"></i></a>
								<a href="<?php echo base_url()?>admin/managevenuefacilities/<?php echo $venuebyvendor->venueid;?>" title="Facilities" style="color:black;margin-right:5px;"><i class="fa fa-glass"></i></a>
								<a href="<?php echo base_url()?>admin/manageaddons/<?php echo $venuebyvendor->venueid;?>" title="Addons" style="color:black;margin-right:5px;"><i class="fa fa-puzzle-piece"></i></a>
								<a href="<?php echo base_url()?>admin/managepricing/<?php echo $venuebyvendor->venueid;?>" title="Pricing" style="color:black;margin-right:5px;"><i class="fa fa-money"></i></a>
                                                                <a href="<?php echo base_url()?>admin/manageimages/<?php echo $venuebyvendor->venueid;?>/<?php echo $venuebyvendor->vendorid;?>" title="Images" style="color:black;margin-right:5px;"><i class="fa fa-picture-o"></i></a>
								<!--class="btn btn-primary btn-xs" -->
								
								</td>
                                
                            </tr>
								<?php $i++;} }else{?>
								<tr>
								<td colspan="4" style="text-align:center;"><strong>No Records Found</strong></td>
								</tr>
								<?php } ?>
                            </tbody>
                            </table>
                        </section>
                    </div>

                </div>

                

            </div>
            <!--body wrapper end-->
