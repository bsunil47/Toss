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
			<?php $this->load->view("includes/admin_header.php");?>
            <!-- header section end-->

            <!-- page head start-->
            <div class="page-head">
                <h3 class="m-b-less">
                    View Staff Details
                </h3>
                <!--<span class="sub-title">Welcome to Static Table</span>-->
                <div class="state-information">
                    <ol class="breadcrumb m-b-less bg-less">
                        <li><a href="<?php echo base_url();?>venues/dashboard">Home</a></li>
                        <li><a href="<?php echo base_url();?>venues/managestaff">Staff</a></li>
                        <li class="active">View Staff Details</li>
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
                                <strong>Staff Information</strong>                                
                            </header>-->
                            <table class="table responsive-data-table data-table">
                            
                            
							<?php //echo "<pre>";print_r($getstaffdetails);exit;?>
							<?php if($getstaffdetails->profile_pic!=""){?>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td><img src="<?php echo base_url();?>images/profiles/<?php echo $getstaffdetails->profile_pic;?>" style="width:auto;height:160px;"/></td>                                
							</tr>
							<?php } ?>
							<tr>
                                <td>Name</td>
                                <td> :</td>
                                <td><?php echo $getstaffdetails->name;?></td>                                
							</tr>
							<tr>
                                <td>E-mail</td>
                                <td>:</td>
                                <td><?php echo $getstaffdetails->email;?></td>
							</tr>
							<tr>
                                <td>gender</td>
                                <td> : </td>
                                <td><?php if($getstaffdetails->gender == 1) { echo "Male"; } else { echo "Female"; } ?></td>
							</tr>
							<tr>
                                <td>phone</td>
                                <td>:</td>
                                <td><?php echo $getstaffdetails->phone;?></td>
							</tr>
							<tr>
                                <td>Registered Date</td>
                                <td> : </td>
                                <td><?php echo $getstaffdetails->created_on;?></td>
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
            