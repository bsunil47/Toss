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
		<?php $this->load->view("includes/venues_leftmenu");?>
        
        <!-- sidebar left end-->

        <!-- body content start-->
        <div class="body-content" style="min-height: 1000px;">

            <!-- header section start-->
			<?php $this->load->view("includes/admin_header");?>
          
            <!-- header section end-->

            <!-- page head start-->
            <div class="page-head">
                <h3 class="m-b-less">Manage Facilities</h3>
                <div class="state-information">
                    <ol class="breadcrumb m-b-less bg-less">
                        <li><a href="<?php echo base_url();?>venues/dashboard">Home</a></li>
                        <!--<li><a href="#">Data Table</a></li>-->
                        <li class="active">Facilities</li>
                    </ol>
                </div>
            </div>
            <!-- page head end-->

            <!--body wrapper start-->
            <div class="wrapper">
				<div class="row">
                    <div class="col-sm-12">
                        <section class="panel">
                            <!--header class="panel-heading ">
								<span class="tools_new pull-right">
                                    <a class="btn btn-success" href="<?php //echo base_url()?>venues/addfacility"><i class="fa fa-plus"></i>Add Facility
								</span>
                            </header-->
							<div class="tbl-head clearfix">
                           <div class="ColVis">
                            <a class="btn btn-success" href="<?php echo base_url()?>venues/addfacility"><i class="fa fa-plus"></i>Add Facility</a>  
                           </div>
                           </div>
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
                            <table class="table responsive-data-table data-table">
                            <thead>
                            <tr>
								<th>S.No</th>
                                <th>Facility Name</th>
                                <th>Status</th>
								<th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
								<?php  for ($i = 0; $i < count($getallfacilities); $i++) {?>
                            <tr>
                                <td><?php echo $i+1; ?></td>
                                <td><?php echo stripslashes($getallfacilities[$i]->facility_name);?></td>
                                <td>
										<?php 
											if($getallfacilities[$i]->facilitystatus=='1'){?>
											<div><i class="fa fa-check"></i></div>
												
											<?php }if($getallfacilities[$i]->facilitystatus=='0'){?>
												<div><i class="fa fa-remove"></i></div>
											<?php }	?>																			
                                </td>
								<td>							
								<a href="<?php echo base_url()?>venues/updatestatus/<?php echo $getallfacilities[$i]->facid;?>/<?php echo $getallfacilities[$i]->facilitystatus;?>/9" style="color:black"><i class="fa fa-check"></i></a>
								<a href="<?php echo base_url() ?>venues/viewfacilities/<?php echo $getallfacilities[$i]->facid;?>" style="color:black"><i class="fa fa-eye"></i></a>
								<a href="<?php echo base_url() ?>venues/editfacilityinfo/<?php echo $getallfacilities[$i]->facid;?>" style="color:black"><i class="fa fa-pencil"></i></a>
								</td>                                
                            </tr>
							<?php } ?>
                            </tbody>
                            </table>
                        </section>
                    </div>
                </div>               
            </div>
            <!--body wrapper end-->
			<?php $this->load->view("includes/admin_footer");?>         
</body>

<!-- Mirrored from thevectorlab.net/slicklab/table-dynamic.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 21 Dec 2015 07:04:39 GMT -->
</html>
