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
                   Manage Facilities
                </h3>
                <!--<span class="sub-title">Welcome to Static Table</span>-->
                <div class="state-information">
                    <ol class="breadcrumb m-b-less bg-less">
                        <li><a href="<?php echo base_url();?>admin/dashboard">Home</a></li>
                        <li class="active">Facilities</li>
                    </ol>
                </div>
            </div>
            <!-- page head end-->

            <!--body wrapper start-->
            <div class="wrapper">
			<?php if($this->session->flashdata('facility_success')){?>
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
				
						<?php }?>
				<?php if($this->session->flashdata('update_facility')){?>
						<div class="alert alert-success alert-block fade in">
                        <button type="button" class="close close-sm" data-dismiss="alert">
                            <i class="fa fa-times"></i>
                        </button>
                        <h4>
                            <i class="fa fa-ok-sign"></i>
                            Success!
                        </h4>
                        <p><?php echo  $this->session->flashdata('update_facility');?></p>
                    </div>
				
						<?php }?>		
				<div class="row">
                    <div class="col-sm-12">
                        <section class="panel">
                           <!-- <header class="panel-heading ">
                               <strong>Facilities List</strong>
                                <span class="tools_new pull-right">
                                    <a class="btn btn-success" href="<?php //echo base_url()?>admin/addfacility"><i class="fa fa-plus"></i>Add Facility</a>
                                    <!--<a class="t-close fa fa-times" href="javascript:;"></a>
                                </span>
                            </header>-->
							 <div class="tbl-head clearfix">
                           <div class="ColVis">
                            <a class="btn btn-success" href="<?php echo base_url()?>admin/addfacility"><i class="fa fa-plus"></i>Add Facility</a>  
                           </div>
                           </div>
						   <!-- class="responsive-data-table" -->
                            <table class="datatable-1 table responsive-data-table data-table">
                            <thead>
                            <tr>
								   <th>
                                    S. No
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
							<?php 
							$i=1;
							foreach($getallfacilities as $getfacility) { ?>
                            <tr>
                                <td>
                                    <?php echo $i;//echo $getfacility->facility_id;?>
                                </td>
                                <td>
                                    <?php echo stripslashes(ucfirst($getfacility->facility_name));?>
                                </td>
                                
                                <td>
										<?php
											if($getfacility->status==1){?>
											<div><i class="fa fa-check" title="Active"></i></div>
												
											<?php }if($getfacility->status==0){?>
												<div><i class="fa fa-remove" title="Inactive"></i></div>
											<?php }
										?>
                                </td>
								<td>
								<?php if($getfacility->status==1){?> 
								<a href="<?php echo base_url()?>admin/updatestatus/<?php echo $getfacility->facility_id;?>/<?php echo $getfacility->status;?>/9" style="color:black" title="Inactive"><i class="fa fa-remove"></i></a>
								<?php }else { ?>
								<a href="<?php echo base_url()?>admin/updatestatus/<?php echo $getfacility->facility_id;?>/<?php echo $getfacility->status;?>/9" style="color:black" title="Active"><i class="fa fa-check"></i></a>
								<?php } ?>
                             <a href="<?php echo base_url() ?>admin/viewfacilityinfo/<?php echo $getfacility->facility_id;?>" style="color:black" title="View"><i class="fa fa-eye"></i></a>
								<!--class="label label-danger"-->
								
								<!--class="btn btn-success btn-xs"-->
								<a href="<?php echo base_url() ?>admin/editfacilityinfo/<?php echo $getfacility->facility_id;?>" style="color:black" title="Edit"><i class="fa fa-pencil"></i></a>
								<a href="<?php echo base_url() ?>admin/deletefacility/<?php echo $getfacility->facility_id;?>" style="color:black" title="Delete" onclick="return confirm('Are You Sure to Delete')"><i class="fa fa-trash-o"></i></a>
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


            <?php $this->load->view("includes/admin_footer")?>


</body>

<!-- Mirrored from thevectorlab.net/slicklab/table-dynamic.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 21 Dec 2015 07:04:39 GMT -->
</html>
