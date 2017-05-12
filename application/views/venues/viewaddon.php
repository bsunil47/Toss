            <!-- page head start-->
           <div class="page-head">
                <h3 class="m-b-less">View Addon</h3>
               <!--<span class="sub-title">Welcome to Static Table</span>-->
                <div class="state-information">
                    <ol class="breadcrumb m-b-less bg-less">
                        <li><a href="<?php echo base_url();?>venues/dashboard">Home</a></li>
			<li><a href="<?php echo base_url();?>venues/manageaddons">Manage Addons</a></li>
                        <li class="active">View Addon</li>
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
                                <td>Addon Type</td> <td>:</td>
                                <td><?php  if($getdetails->base_type == 1){echo "Category";}else if($getdetails->base_type == 2){echo "Sub Category";}else{echo "Sub Sub Category";}?> </td>
                            </tr>
                            <tr>
                                <td>Addon For</td> <td>:</td>
                                <td><?php  if($getdetails->base_type == 1){echo $getdetails->category_name;}else if($getdetails->base_type == 2){echo $getdetails->sub_category_name;}else{echo $getdetails->sub_sub_category_name;}?> </td>
                            </tr>
				<tr>
                                <td> Addon Name</td>
                                <td> :</td>
                                <td> <?php echo stripslashes($getdetails->addon_name);?>                                    
                                   </td>
							</tr>
					<tr>
                                <td>Amount</td> <td>:</td>
                                <td><?php echo $getdetails->amount;?></td>
                            </tr>		
														
				            </tbody>
                            </table>
                        </section>
						</div>			
                    </div>
                </div>    
            </div>
