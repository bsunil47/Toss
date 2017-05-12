            <!-- page head start-->
            <div class="page-head">
                <h3 class="m-b-less">
                    View Venue Manager or Staff
                </h3>
                <!--<span class="sub-title">Welcome to Static Table</span>-->
                <div class="state-information">
                    <ol class="breadcrumb m-b-less bg-less">
                        <li><a href="<?php echo base_url();?>vendors/dashboard">Home</a></li>
                        <li><a href="<?php echo base_url();?>vendors/managevenues">Venues</a></li>
                         <li><a href="<?php echo base_url();?>vendors/manageusers/<?php echo $venue_id;?>">Mangers and Staff</a></li>
                        <li class="active">View Details</li>
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
<!--                                <strong>User Information</strong>-->
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
                                    &nbsp;
                                </td>
                                <td>
                                    &nbsp;
                                </td>
                                <td>
                                    
									<img src="<?php echo base_url();?>images/profiles/<?php echo $viewuserdetails->profile_pic;?>" style="width:auto;height:160px;"/>
                                </td>
                                
                          </tr>
                          <tr>
                                <td>
                                    Venue Name
                                </td>
                                <td>
                                    :
                                </td>
                                <td>
                                   <?php echo $viewuserdetails->venue_display_name;?>
									</td>
                                
                          </tr>
						  <tr>
                                <td>
                                    User Name
                                </td>
                                <td>
                                    :
                                </td>
                                <td>
                                   <?php echo $viewuserdetails->name;?>
									</td>
                                
                          </tr>
							<tr>
                                <td>
                                    Email
                                </td>
                                <td>
                                    :
                                </td>
                                <td>
                                    <?php echo $viewuserdetails->email;?>
                                </td>
                          </tr>
						  <tr>
                                <td>
                                    Gender
                                </td>
                                <td>
                                    :
                                </td>
                                <td>
                                    <?php if($viewuserdetails->gender == 1) { echo "Male"; } else { echo "Female"; } ?>
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
                                   <?php echo $viewuserdetails->phone;?>
                                </td>
                         </tr>
							<tr>
                                <td>
                                    Registered Date
                                </td>
                                <td>
                                    :
                                </td>
                                <td>
                                    <?php echo $viewuserdetails->created_on;?>
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
