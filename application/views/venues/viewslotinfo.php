            <!-- page head start-->
            <div class="page-head">
                <h3 class="m-b-less">
                    View Slot
                </h3>
                <!--<span class="sub-title">Welcome to Static Table</span>-->
                <div class="state-information">
                    <ol class="breadcrumb m-b-less bg-less">
                        <li><a href="<?php echo base_url();?>venues/dashboard">Home</a></li>
			 <li><a href="<?php echo base_url();?>venues/manageslots">Slots</a></li>
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
                         <tr>
                                <td>
                                    SubSubcategory Name
                                </td>
                                <td>
                                    :
                                </td>
                                <td>
                                    <?php echo $viewslotinfo->sub_sub_category_name ?>
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
