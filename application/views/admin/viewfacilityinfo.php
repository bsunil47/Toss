            <!-- page head start-->
            <div class="page-head">
                <h3 class="m-b-less">
                    View Facilities
                </h3>
                <!--<span class="sub-title">Welcome to Static Table</span>-->
                <div class="state-information">
                    <ol class="breadcrumb m-b-less bg-less">
                        <li><a href="<?php echo base_url();?>admin/dashboard">Home</a></li>
                        <li><a href="<?php echo base_url();?>admin/managefacilities">Facilities</a></li>
                        <li class="active">View Facilities</li>
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
                               
                            </header>
                            <table class="table responsive-data-table data-table">
                            
                            
							<?php 
								//echo "<pre>";print_r($viewuserdetails);exit;
							?>
                            <tr>
                                <td>
                                    Facility Image
                                </td>
                                <td>
                                    &nbsp;
                                </td>
                                <td>
                                    
									<img src="<?php echo base_url();?>images/facilities/<?php echo $viewfacilities->facility_image;?>" style="width:auto;height:160px;"/>
                                </td>
                                
                          </tr>
						  <?php if($viewfacilities->base_type!=4){?>
						  <tr>
                                <td>
                                    Type
                                </td>
                                <td>
                                    :
                                </td>
                                <td>
                                    
									<?php if($viewfacilities->base_type==1){echo "Category";}if($viewfacilities->base_type==2){echo "Sub Category";}if($viewfacilities->base_type==3){echo "Sub Sub Category";}?>
                                </td>
                                
                          </tr>
						  <tr>
                                <td>
								<?php if($viewfacilities->base_type==1){echo "Category Name";}?>
                             <?php if($viewfacilities->base_type==2){echo "Subcategory Name";} if($viewfacilities->base_type==3){echo "Sub Sub Ctaegory Name";}?>
                                </td>
                                <td>
                                    :
                                </td>
                                <td>
                                   <?php if($viewfacilities->base_type==1){echo $viewfacilities->category_name;}if($viewfacilities->base_type==2){echo $viewfacilities->sub_category_name;}if($viewfacilities->base_type==3){echo $viewfacilities->sub_sub_category_name;}?> 
									
                                </td>
                                
                          </tr>
						  <?php } ?>
						  <tr>
                                <td>
                                    Facility Name
                                </td>
                                <td>
                                    :
                                </td>
                                <td>
                                   <?php echo $viewfacilities->facility_name;?>
									</td>
                                
                          </tr>
							
							</tbody>
                            </table>
                        </section>
						
						
                    </div>

                </div>

                

            </div>
  