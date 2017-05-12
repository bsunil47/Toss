            <!-- page head start-->
            <div class="page-head">
                <h3 class="m-b-less">
                    View Slot
                </h3>
                <!--<span class="sub-title">Welcome to Static Table</span>-->
                <div class="state-information">
                    <ol class="breadcrumb m-b-less bg-less">
                        <li><a href="<?php echo base_url();?>vendors/dashboard">Home</a></li>
                         <li><a href="<?php echo base_url();?>vendors/managevenues">Venues</a></li>
                        <li><a href="<?php echo base_url();?>vendors/manageslots/<?php echo $venue_id;?>">Slots</a></li>
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
                                <td> Sub Category Type</td>
                                <td> :</td>
                                <td> <?php echo $editslotinfo->sub_category_name;?>                                    
                                   </td>
							</tr>
							<!--<tr>
                                <td> Day </td>
                                <td> : </td>
                                <td> <?php //$dayarray=array('1'=>'Monday','2'=>'Tuesday','3'=>'Wednesday','4'=>'Thursday','5'=>'Friday','6'=>'Saturday','7'=>'Sunday');
                                //echo $dayarray[$editslotinfo->day_id];?> </td>
							</tr>-->
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
