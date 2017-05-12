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
                <h3 class="m-b-less">View Facility</h3>
               <!--<span class="sub-title">Welcome to Static Table</span>-->
                <div class="state-information">
                    <ol class="breadcrumb m-b-less bg-less">
                        <li><a href="<?php echo base_url();?>admin/dashboard">Home</a></li>
						<li><a href="<?php echo base_url();?>admin/listvenue/<?php echo $venueid;?>">Venue List</a></li>
                        <li><a href="<?php echo base_url();?>admin/managevenuefacilities/<?php echo $venueid;?>">Manage Venue Facilities</a></li>
                        <li class="active">View Facility</li>
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
                            <!--      <strong>Venue Facility Information</strong>-->
                            </header>
                            <table class="datatable-2 table responsive-data-table data-table">
                                
							<?php //echo "<pre>";print_r($getdetails);exit; ?>
                            <tr>
                                <td>Venue Name</td> <td>:</td>
                                <td><?php  echo $getdetails->venue_display_name;?> </td>
                            </tr>
				<tr>
                                <td> Facility Name</td>
                                <td> :</td>
                                <td> <?php echo stripslashes($getdetails->facility_name);?>                                    
                                   </td>
							</tr>
							<tr>
                                <td> Facility Image </td>
                                <td> : </td>
                                <td> <img src="<?php echo base_url();?>images/facilities/<?php echo $getdetails->facility_image;?>" width="100" height="100"> </td>
							</tr>
														
				            </tbody>
                            </table>
                        </section>
						</div>			
                    </div>
                </div>    
            </div>
<!--body wrapper end-->
<?php $this->load->view("includes/admin_footer");?>

</body>
<!-- Mirrored from thevectorlab.net/slicklab/table-dynamic.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 21 Dec 2015 07:04:39 GMT -->
</html>
