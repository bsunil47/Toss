            <!-- page head start-->
           <div class="page-head">
                <h3 class="m-b-less">View Facility</h3>
                <div class="state-information">
                    <ol class="breadcrumb m-b-less bg-less">
                        <li><a href="<?php echo base_url();?>venues/dashboard">Home</a></li>
                        <li><a href="<?php echo base_url();?>venues/managefacilities">Facilities</a></li>
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
                            <!--<header class="panel-heading ">
                                <strong>Facility Information</strong>
                            </header>-->
                            <table class="datatable-2 table responsive-data-table data-table">
                                                       
							<?php //echo "<pre>";print_r($getdetails);exit; ?>
                             <tr>
                                <td>Facility Name</td><td>: </td>
                                <td> <?php echo stripslashes($getdetails->facility_name);?> </td>
                            </tr>
							<?php if($getdetails->facility_image!=""){?>
							<tr>
                                <td>Facility Image</td><td>: </td>
								<td> <img src="<?php echo base_url()?>images/facilities/<?php echo $getdetails->facility_image;?>" name="facility_image" width="auto" height="100"/></td>
                            </tr>
							<?php } ?>
				            </tbody>
                            </table>
                        </section>
						</div>
						
                    </div>

                </div>

                

            </div>
<!--body wrapper end-->
