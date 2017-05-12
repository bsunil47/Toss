            <!-- page head start-->
            <div class="page-head">
                <h3 class="m-b-less">
                    View Venue Manager Details
                </h3>
                <!--<span class="sub-title">Welcome to Static Table</span>-->
                <div class="state-information">
                    <ol class="breadcrumb m-b-less bg-less">
                        <li><a href="<?php echo base_url();?>venues/dashboard">Home</a></li>
                        <!--<li><a href="#">Data Table</a></li>-->
                        <li class="active">View Venue Manager Details</li>
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
                                <strong>Venue Manager Information</strong>                                
                            </header>-->
                            <table class="table responsive-data-table data-table">
                            
                            
							<?php //echo "<pre>";print_r($getstaffdetails);exit;?>
							<?php if($getstaffdetails->profile_pic!=""){?>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td><img src="<?php echo base_url();?>images/profiles/<?php echo $getstaffdetails->profile_pic;?>" style="width:auto;height:160px;"/></td>                                
							</tr>
							<?php } ?>
							<tr>
                                <td>Name</td>
                                <td> :</td>
                                <td><?php echo $getstaffdetails->name;?></td>                                
							</tr>
							<tr>
                                <td>Email</td>
                                <td>:</td>
                                <td><?php echo $getstaffdetails->email;?></td>
							</tr>
							<tr>
                                <td>Gender</td>
                                <td> : </td>
                                <td><?php if($getstaffdetails->gender == 1) { echo "Male"; } else { echo "Female"; } ?></td>
							</tr>
							<tr>
                                <td>Phone</td>
                                <td>:</td>
                                <td><?php echo $getstaffdetails->phone;?></td>
							</tr>
							<tr>
                                <td>Registered Date</td>
                                <td> : </td>
                                <td><?php echo $getstaffdetails->created_on;?></td>
							</tr>
							</tbody>
                            </table>
                        </section>
						</div>					
                    </div>
                </div>           
            </div>
            <!--body wrapper end-->
	