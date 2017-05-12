            <!-- page head start-->
            <div class="page-head">
                <h3 class="m-b-less">
                   View App User
                </h3>
                <!--<span class="sub-title">Welcome to Static Table</span>-->
                <div class="state-information">
                    <ol class="breadcrumb m-b-less bg-less">
                        <li><a href="<?php echo base_url()?>">Home</a></li>
                        <li><a href="<?php echo base_url()?>users/manageadminusers">Admin Users</a></li>
                        <li class="active">View Admin User</li>
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
                                <!-- <strong>App User Information</strong>
                               <span class="tools pull-right">
                                    <a class="fa fa-repeat box-refresh" href="javascript:;"></a>
                                    <a class="t-close fa fa-times" href="javascript:;"></a>
                                </span>-->
                            </header>
                            <table class="table responsive-data-table data-table">
                            
                            
							<?php 
								//echo "<pre>";print_r($viewappuser);exit;
							?>
                            <tr>
                                <td>
                                    &nbsp;
                                </td>
                                <td>
                                    &nbsp;
                                </td>
                                <td>
                                    
									<img src="<?php echo base_url();?>images/profiles/<?php echo $viewadminuser->profile_pic;?>" style="width:auto;height:160px;"/>
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
                                   <?php echo $viewadminuser->name;?>
									</td>
                                
                          </tr>
							<tr>
                                <td>
                                    E-mail
                                </td>
                                <td>
                                    :
                                </td>
                                <td>
                                    <?php echo $viewadminuser->email;?>
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
                                    <?php if($viewadminuser->gender==1){ echo "Male";}else { echo "Female";}?>
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
                                   <?php echo $viewadminuser->phone; ?>
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
                                    <?php echo $viewadminuser->created_on;?>
                                </td>
                          </tr>
							</tbody>
                            </table>
                        </section>
						
						
                    </div>

                </div>

                

            </div>
            <!--body wrapper end-->
