<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from thevectorlab.net/slicklab/table-dynamic.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 21 Dec 2015 07:04:27 GMT -->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Mosaddek">
    <meta name="keyword" content="slick, flat, dashboard, bootstrap, admin, template, theme, responsive, fluid, retina">
    <link rel="shortcut icon" href="javascript:;" type="image/png">

    <title>TOSS</title>

    <?php $this->load->view("includes/admin_header_links");?>
</head>

<body class="sticky-header">

    <section>
        <!-- sidebar left start-->
        <?php $this->load->view("includes/admin_leftmenu");?>
        <!-- sidebar left end-->

        <!-- body content start-->
        <div class="body-content" style="min-height: 1000px;">

            <!-- header section start-->
            <?php $this->load->view("includes/admin_header");?>
            <!-- header section end-->

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
						  <?php if($viewfacilities->base_type!=3){?>
						  <tr>
                                <td>
                                    Type
                                </td>
                                <td>
                                    :
                                </td>
                                <td>
                                    
									<?php if($viewfacilities->base_type==1){echo "Category";}if($viewfacilities->base_type==2){echo "Sub Category";}?>
                                </td>
                                
                          </tr>
						  <tr>
                                <td>
								<?php if($viewfacilities->base_type==1){echo "Category Name";}?>
                             <?php if($viewfacilities->base_type==2){echo "Subcategory Name";}?>
                                </td>
                                <td>
                                    :
                                </td>
                                <td>
                                   <?php if($viewfacilities->base_type==1){echo $viewfacilities->category_name;}if($viewfacilities->base_type==2){echo $viewfacilities->sub_category_name;}?> 
									
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
            <!--body wrapper end-->


            <?php $this->load->view("includes/admin_footer");?>