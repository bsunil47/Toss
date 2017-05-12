            <!-- page head start-->
           <div class="page-head">
                <h3 class="m-b-less">View Customer</h3>
               <!--<span class="sub-title">Welcome to Static Table</span>-->
                <div class="state-information">
                    <ol class="breadcrumb m-b-less bg-less">
                        <li><a href="<?php echo base_url();?>venues/dashboard">Home</a></li>
                        <li><a href="<?php echo base_url();?>venues/managecustomers">Customers</a></li>
                        <li class="active">View Customer</li>
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
                                <strong>Pricing Information</strong>
                            </header>-->
                            <table class="datatable-1 table responsive-data-table data-table">                                             
							<?php //echo "<pre>";print_r($getcustomerdata);exit; ?>
                             <!--tr>
                                <td>Vendor Name</td> <td>:</td>
                                <td><?php  //echo $getdetails->company_name;?> </td>
                            </tr-->
							<tr>
                                <td> Booking Id </td>
                                <td> : </td>
                                <td><?php echo $getcustomerdata->booking_id;?></td>
							</tr>
							<tr>
                                <td> First Name</td>
                                <td> :</td>
                                <td> <?php echo $getcustomerdata->firstname.$getcustomerdata->lastname;?>                                   
                                   </td>
							</tr>
							<tr>
                                <td> Email </td>
                                <td> : </td>
                                <td> <?php echo $getcustomerdata->email; ?> </td>
							</tr>
							<tr>
                                <td> Phone </td>
                                <td>:</td>
                                <td><?php echo $getcustomerdata->phone; ?>
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
