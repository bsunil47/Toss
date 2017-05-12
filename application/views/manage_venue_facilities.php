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

  <?php $this->load->view('includes/admin_header_links.php');?>
</head>

<body class="sticky-header">

    <section>
        <!-- sidebar left start-->
   <?php $this->load->view('includes/admin_leftmenu.php');?>
        <!-- sidebar left end-->

        <!-- body content start-->
        <div class="body-content" style="min-height: 1000px;">

            <!-- header section start-->
           <?php $this->load->view('includes/admin_header.php');?>
            <!-- header section end-->

            <!-- page head start-->
            <div class="page-head">
                <h3 class="m-b-less">
                   Facilities
                </h3>
                <!--<span class="sub-title">Welcome to Static Table</span>-->
                <div class="state-information">
                    <ol class="breadcrumb m-b-less bg-less">
                        <li><a href="<?php echo base_url();?>admin/dashboard">Home</a></li>
						<li><a href="<?php echo base_url();?>admin/listvenue/<?php echo $getdetails->vendor_id;?>">Venue List</a></li>
                        <li class="active">Manage Venue Facilities</li>
                    </ol>
                </div>
            </div>
            <!-- page head end-->

            <!--body wrapper start-->
            <div class="wrapper">
				<div class="row">
                    <div class="col-sm-12">
                        <section class="panel">
<!--                            <header class="panel-heading ">
                                 <a class="btn btn-success" style="float:right;" href="<?php //echo base_url()?>vendors/addfacility"><i class="fa fa-plus"></i>Add Facility</a>
                             </header>-->
                            
                            <?php if($this->session->flashdata('facility_success')){ ?>
						<div class="alert alert-success alert-block fade in">
                        <button type="button" class="close close-sm" data-dismiss="alert">
                            <i class="fa fa-times"></i>
                        </button>
                        <h4>
                            <i class="fa fa-ok-sign"></i>
                            Success!
                        </h4>
                        <p><?php echo  $this->session->flashdata('facility_success');?></p>
                    </div>
				
						<?php } ?>
                            <div class="tbl-head clearfix">
<div class="ColVis">
<!--<button class="ColVis_Button ColVis_MasterButton">
<span>Show / hide columns</span>
</button>-->
<a class="btn btn-success" style="float:right;" href="<?php echo base_url()?>admin/addvenuefacility/<?php echo $getdetails->venue_id;?>"><i class="fa fa-plus"></i>Add Facility</a>
                            
</div>
</div>
                            <table class="table responsive-data-table data-table">
                            <thead>
                            <tr>
								   <th>
                                    S. No
                                </th>
                                <th>
                                    Venue Name
                                </th>
                                <th>
                                    Facility Name
                                </th>
                                
									<th>
                                    Status
                                </th>
									<th>
                                    Action
                                </th>
                            </tr>
                            </thead>
                            <tbody>
							<?php //echo "<pre>";print_r($getallfacilities);exit;
							$i=1;
							
                                                        foreach($getallfacilities as $getfacility) { ?>
                            <tr>
                                <td>
                                    <?php echo $i;//$getfacility->facility_id;?>
                                </td>
                                <td>
                                    <?php echo stripslashes($getfacility->venue_display_name);?>
                                </td>
                                <td>
                                    <?php echo stripslashes($getfacility->facility_name);?>
                                </td>
                                
                                <td>
										<?php
											if($getfacility->status==1){?>
											<div><i class="fa fa-check"></i></div>
												
											<?php }if($getfacility->status==0){?>
												<div><i class="fa fa-remove"></i></div>
											<?php }
										?>
                                </td>
								<td>
								<?php if($getfacility->status==1){?> 
								<a href="<?php echo base_url()?>admin/updatefstatus/<?php echo $getfacility->facility_id;?>/<?php echo $getfacility->status;?>/<?php echo $getfacility->venue_id;?>" style="color:black;"><i class="fa fa-remove"></i></a>
								<?php }else{?>
								<a href="<?php echo base_url()?>admin/updatefstatus/<?php echo $getfacility->facility_id;?>/<?php echo $getfacility->status;?>/<?php echo $getfacility->venue_id;?>" style="color:black;"><i class="fa fa-check"></i></a>
								<?php }?>
                             <a href="<?php echo base_url()?>admin/viewfacility/<?php echo $getfacility->facility_id;?>/<?php echo $getfacility->venue_id;?>" style="color:black"><i class="fa fa-eye"></i></a>
								<!--class="label label-danger"-->
								
								<!--class="btn btn-success btn-xs"-->
								<a href="<?php echo base_url() ?>admin/editfacilityvenueinfo/<?php echo $getfacility->facility_id;?>/<?php echo $getfacility->venue_id;?>" style="color:black"><i class="fa fa-pencil"></i></a>
								<!--class="btn btn-primary btn-xs"-->
								<!--<a href="<?php //echo base_url()?>admin/deleteuser/<?php //echo $getvendor['u_id'];?>" style="color:black"><i class="fa fa-trash-o "></i></a>   
								class="btn btn-danger btn-xs"-->
								</td>
                                
                            </tr>
							<?php $i++;} ?>
                            </tbody>
                            </table>
                        </section>
                    </div>

                </div>

                

            </div>
            <!--body wrapper end-->


            <?php $this->load->view('includes/admin_footer.php');?>


</body>

<!-- Mirrored from thevectorlab.net/slicklab/table-dynamic.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 21 Dec 2015 07:04:39 GMT -->
</html>
