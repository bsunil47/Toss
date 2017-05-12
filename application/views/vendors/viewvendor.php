            <!-- page head start-->
            <div class="page-head">
                <h3 class="m-b-less">
                    Vendor Information
                </h3>
                <!--<span class="sub-title">Welcome to Static Table</span>-->
                <div class="state-information">
                    <ol class="breadcrumb m-b-less bg-less">
                        <li><a href="<?php echo base_url();?>vendors/dashboard">Home</a></li>
                        <li class="active">Vendor Details</li>
                    </ol>
                </div>
            </div>
            <!-- page head end-->

            <!--body wrapper start-->
            <div class="wrapper">
				<div class="row">
                    <div class="col-sm-12">
					<div class="col-sm-6" style="float:left;">
                        <section class="panel">
                            <header class="panel-heading ">
<!--                                <strong>Vendor Information</strong>-->
                                <!--<span class="tools pull-right">
                                    <a class="fa fa-repeat box-refresh" href="javascript:;"></a>
                                    <a class="t-close fa fa-times" href="javascript:;"></a>
                                </span>-->
                            </header>
                            <table class="table responsive-data-table data-table">
                            
                            
							<?php //echo "<pre>";print_r($viewvendordetails);exit;
                                                        $viewvendordetails=(array)$viewvendordetails;?>
                            <tr>
                                <td>
                                    &nbsp;
                                </td>
                                <td>
                                    &nbsp;
                                </td>
                                <td>
                                    
                                                                        <?php if(isset($viewvendordetails['profile_pic'])){?><img src="<?php echo base_url();?>images/profiles/<?php echo $viewvendordetails['profile_pic'];?>" style="width:200px;height:100px;"/><?php }?>
                                </td>
                                
                          </tr>
						  <tr>
                                <td>
                                    Company Name
                                </td>
                                <td>
                                    :
                                </td>
                                <td>
                                    <?php if(isset($viewvendordetails['company_name'])){echo $viewvendordetails['company_name'];}?>
									</td>
                                
                          </tr>
							<tr>
                                <td>
                                    Category
                                </td>
                                <td>
                                    :
                                </td>
                                <td>
                                    <?php if(isset($viewvendordetails['venuecategory'])){echo $viewvendordetails['venuecategory'];}?>
                                </td>
                          </tr>
							<tr>
                                <td>
                                    Address1
                                </td>
                                <td>
                                    :
                                </td>
                                <td>
                                    <?php if(isset($viewvendordetails['vendoraddress'])){echo $viewvendordetails['vendoraddress'];}?>
                                </td>
                         </tr>
							<tr>
                                <td>
                                    Address2
                                </td>
                                <td>
                                    :
                                </td>
                                <td>
                                    <?php if(isset($viewvendordetails['vendoraddresstwo'])){echo $viewvendordetails['vendoraddresstwo'];}?>
                                </td>
                          </tr>
							<tr>
                                <td>
                                    City
                                </td>
                                <td>
                                    :
                                </td>
                                <td>
                                    <?php if(isset($viewvendordetails['city'])){echo $viewvendordetails['city'];}?>
                                </td>
                         </tr>
							<tr>
                                <td>
                                    State
                                </td>
                                <td>
                                    :
                                </td>
                                <td>
                                    <?php if(isset($viewvendordetails['state'])){echo $viewvendordetails['state'];}?>
                                </td>
                         </tr>
							<tr>
                                <td>
                                    Country
                                </td>
                                <td>
                                    :
                                </td>
                                <td>
                                    <?php if(isset($viewvendordetails['country'])){echo $viewvendordetails['country'];}?>
                                </td>
                         </tr>
							<tr>
                                <td>
                                    Pincode
                                </td>
                                <td>
                                    :
                                </td>
                                <td>
                                    <?php if(isset($viewvendordetails['vendorpin'])){echo $viewvendordetails['vendorpin'];}?>
                                </td>
                          </tr>
							<tr>
                                <td>
                                    Display Name
                                </td>
                                <td>
                                    :
                                </td>
                                <td>
                                    <?php if(isset($viewvendordetails['venue_display_name'])){echo $viewvendordetails['venue_display_name'];}?>
                                </td>
                          </tr>
							
						  
							
							
                            </tbody>
                            </table>
                        </section>
						</div>
                        <!--<div class="col-sm-6" style="float: right;">
                            <section class="panel">
                                <table>
                                    <tr>
                                <td>
                                    &nbsp;
                                </td>
                                <td>
                                    &nbsp;
                                </td>
                                <td>
                                    
                                                                        <?php //if(isset($viewvendordetails['profile_pic'])){?><img src="<?php //echo base_url();?>images/profiles/<?php //echo $viewvendordetails['profile_pic'];?>" style="width:200px;height:100px;"/><?php //}?>
                                </td>
                                
                          </tr>
                                </table>
                            </section>
                        </div>-->
						<div class="col-sm-6" style="float:right;">
						<section class="panel">
                            <header class="panel-heading ">
<!--                                <strong>Vendor Information</strong>-->
                                <!--<span class="tools pull-right">
                                    <a class="fa fa-repeat box-refresh" href="javascript:;"></a>
                                    <a class="t-close fa fa-times" href="javascript:;"></a>
                                </span>-->
                            </header>
                            <table class="datatable-2 table responsive-data-table data-table">
						<tbody>
						<tr>
                                <td>
                                    PAN
                                </td>
                                <td>
                                    :
                                </td>
                                <td>
                                    <a data-toggle="modal" href="#myModal2"><?php if(isset($viewvendordetails['pan'])){echo $viewvendordetails['pan'];}?></a>
                                </td>
								<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title">Modal Title</h4>
                                </div>
                                <div class="modal-body">

                                    <?php if(isset($viewvendordetails['profile_pic'])){?><img src="<?php echo base_url();?>images/profiles/<?php echo $viewvendordetails['profile_pic'];?>"/><?php }?>

                                </div>
                                <div class="modal-footer">
                                   <!-- <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                                    <button class="btn btn-warning" type="button"> Confirm</button>-->
                                </div>
                            </div>
                        </div>
                    </div>
                          </tr>
							<tr>
                                <td>
                                    VAT
                                </td>
                                <td>
                                    :
                                </td>
                                <td>
                                    <?php if(isset($viewvendordetails['vat'])){echo $viewvendordetails['vat'];}?>
                                </td>
                          </tr>
							<tr>
                                <td>
                                    CST
                                </td>
                                <td>
                                    :
                                </td>
                                <td>
                                    <?php if(isset($viewvendordetails['cst'])){echo $viewvendordetails['cst'];}?>
                                </td>
                          </tr>
							<tr>
                                <td>
                                    TAN
                                </td>
                                <td>
                                    :
                                </td>
                                <td>
                                    <?php if(isset($viewvendordetails['tan'])){echo $viewvendordetails['tan'];}?>
                                </td>
                         </tr>
							<tr>
                                <td>
                                    Service Tax
                                </td>
                                <td>
                                    :
                                </td>
                                <td>
                                    <?php if(isset($viewvendordetails['service_tax'])){echo $viewvendordetails['service_tax'];}?>
                                </td>
                          </tr>
						  <tr>
                                <td>
                                    Beneficiary Name
                                </td>
                                <td>
                                    :
                                </td>
                                <td>
                                    <?php if(isset($viewvendordetails['beneficiary_name'])){echo $viewvendordetails['beneficiary_name'];}?>
                                </td>
                          </tr>
						  <tr>
                                <td>
                                    Accont Number
                                </td>
                                <td>
                                    :
                                </td>
                                <td>
                                    <?php if(isset($viewvendordetails['account_number'])){echo $viewvendordetails['account_number'];}?>
                                </td>
                          </tr>
						  <tr>
                                <td>
                                    Account Type
                                </td>
                                <td>
                                    :
                                </td>
                                <td>
                                    <?php if(isset($viewvendordetails['account_type'])){echo $viewvendordetails['account_type'];}?>
                                </td>
                          </tr>
						  <tr>
                                <td>
                                    IFSC Code
                                </td>
                                <td>
                                    :
                                </td>
                                <td>
                                    <?php if(isset($viewvendordetails['ifsc_code'])){echo $viewvendordetails['ifsc_code'];}?>
                                </td>
                          </tr>
						  <tr>
                                <td>
                                    Website Url
                                </td>
                                <td>
                                    :
                                </td>
                                <td>
                                    <?php if(isset($viewvendordetails['web_url'])){echo $viewvendordetails['web_url'];}?>
                                </td>
                          </tr>
						  <tr>
                                <td>
                                    Ohter Website
                                </td>
                                <td>
                                    :
                                </td>
                                <td>
                                    <?php if(isset($viewvendordetails['web_url2'])){echo $viewvendordetails['web_url2'];}?>
                                </td>
                          </tr>
						  <tr>
                                <td>
                                    Other Info One
                                </td>
                                <td>
                                    :
                                </td>
                                <td>
                                    <?php if(isset($viewvendordetails['other_info_one'])){echo $viewvendordetails['other_info_one'];}?>
                                </td>
                          </tr>
						  <tr>
                                <td>
                                    Other Info Two
                                </td>
                                <td>
                                    :
                                </td>
                                <td>
                                    <?php if(isset($viewvendordetails['other_info_two'])){echo $viewvendordetails['other_info_two'];}?>
                                </td>
                          </tr>
						  <tr>
                                <td>
                                    Other Info Three
                                </td>
                                <td>
                                    :
                                </td>
                                <td>
                                    <?php if(isset($viewvendordetails['other_info_three'])){echo $viewvendordetails['other_info_three'];}?>
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
                                    <?php if(isset($viewvendordetails['created_on'])){echo $viewvendordetails['created_on'];}?>
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
