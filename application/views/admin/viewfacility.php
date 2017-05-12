            <!-- page head start-->
           <div class="page-head">
                <h3 class="m-b-less">View Facility</h3>
               <!--<span class="sub-title">Welcome to Static Table</span>-->
                <div class="state-information">
                    <ol class="breadcrumb m-b-less bg-less">
                        <li><a href="<?php echo base_url();?>admin/dashboard">Home</a></li>
						<li><a href="<?php echo base_url();?>admin/listvenue/<?php echo $venueid;?>">Venue List</a></li>
                        <li><a href="<?php echo base_url();?>admin/managevenuefacilities/<?php echo $venueid;?>">Manage Venue Facilities</a></li>
                        <li class="active">View Facility</li>
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
                            <!--      <strong>Venue Facility Information</strong>-->
                            </header>
                            <table class="datatable-2 table responsive-data-table data-table">
                                
							<?php //echo "<pre>";print_r($getdetails);exit; ?>
                            <tr>
                                <td>Venue Name</td> <td>:</td>
                                <td><?php  echo $getdetails->venue_display_name;?> </td>
                            </tr>
				<tr>
                                <td> Facility Name</td>
                                <td> :</td>
                                <td> <?php echo stripslashes($getdetails->facility_name);?>                                    
                                   </td>
							</tr>
							<tr>
                                <td> Facility Image </td>
                                <td> : </td>
                                <td> <img src="<?php echo base_url();?>images/facilities/<?php echo $getdetails->facility_image;?>" width="100" height="100"> </td>
							</tr>
														
				            </tbody>
                            </table>
                        </section>
						</div>			
                    </div>
                </div>    
            </div>
