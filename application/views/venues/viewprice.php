            <!-- page head start-->
           <div class="page-head">
                <h3 class="m-b-less">View Pricing</h3>
               <!--<span class="sub-title">Welcome to Static Table</span>-->
                <div class="state-information">
                    <ol class="breadcrumb m-b-less bg-less">
                        <li><a href="<?php echo base_url();?>venues/dashboard">Home</a></li>
			<li><a href="<?php echo base_url();?>venues/managepricing">Pricing</a></li>
                        <li class="active">View Pricing</li>
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
                                <td>Vendor Name</td> <td>:</td>
                                <td><?php  echo $getdetails->company_name;?> </td>
                            </tr>
							<tr>
                                <td> Venue Name </td>
                                <td> : </td>
                                <td><?php echo $getdetails->venue_display_name;?></td>
							</tr>
							<tr>
                                <td> Pricing Type</td>
                                <td> :</td>
                                <td> <?php 
                                        echo $getdetails->membership_name;
                                    
                                    ?>                                    
                                   </td>
							</tr>
							<tr>
                                <td> Price </td>
                                <td> : </td>
                                <td> <?php echo $getdetails->amount; ?> </td>
							</tr>
							<tr>
                                <td> Discount Type</td>
                                <td>:</td>
                                <td><?php if($getdetails->discount_type==1){
                                        echo "percentage";
                                    }else if($getdetails->discount_type==2){
                                        echo "Flat";
                                    }?>
                                </td>
							</tr>
							<tr>
                                <td>Discount Amount</td>
                                <td>:</td>
                                <td><?php echo $getdetails->discount_amount;?></td>
							</tr>
				            </tbody>
                            </table>
                        </section>
						</div>			
                    </div>
                </div>    
            </div>
