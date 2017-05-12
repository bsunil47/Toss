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

    <!--right slidebar-->
    <link href="<?php echo base_url()?>css/slidebars.css" rel="stylesheet">

    <!--switchery-->
    <link href="<?php echo base_url()?>js/switchery/switchery.min.css" rel="stylesheet" type="text/css" media="screen" />

    <!--Data Table-->
    <link href="<?php echo base_url()?>js/data-table/css/jquery.dataTables.css" rel="stylesheet">
    <link href="<?php echo base_url()?>js/data-table/css/dataTables.tableTools.css" rel="stylesheet">
    <link href="<?php echo base_url()?>js/data-table/css/dataTables.colVis.min.css" rel="stylesheet">
    <link href="<?php echo base_url()?>js/data-table/css/dataTables.responsive.css" rel="stylesheet">
    <link href="<?php echo base_url()?>js/data-table/css/dataTables.scroller.css" rel="stylesheet">
    <!-- Base Styles -->
	
	<!--gritter-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>js/gritter/css/jquery.gritter.css" />
	
    <!--common style-->
	
    <link href="<?php echo base_url()?>css/style.css" rel="stylesheet">
    <link href="<?php echo base_url()?>css/style-responsive.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
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
                            <!--<header class="panel-heading ">
                                <strong>Pricing Information</strong>
                            </header>-->
                            <table class="datatable-2 table responsive-data-table data-table">                                             
							<?php //echo "<pre>";print_r($getdetails);exit; ?>
                             <!--tr>
                                <td>Vendor Name</td> <td>:</td>
                                <td><?php  //echo $getdetails->company_name;?> </td>
                            </tr-->
							<tr>
                                <td> Venue Name </td>
                                <td> : </td>
                                <td><?php echo $getdetails->venue_display_name;?></td>
							</tr>
							<tr>
                                <td> Pricing Type</td>
                                <td> :</td>
                                <td> <?php if($getdetails->price_type==1){
                                        echo "Membership-".$getdetails->membership_name;
                                    } else if($getdetails->price_type==2){
                                        echo "Category-".$getdetails->category_name;
                                    }else if($getdetails->price_type==3){
                                        echo "Subcategory-".$getdetails->sub_category_name;
                                    }else if($getdetails->price_type==4){
                                        echo "Facility-".$getdetails->facility_name;
                                    }?>                                    
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
<!--body wrapper end-->
<?php $this->load->view("includes/admin_footer");?>
</body>
<!-- Mirrored from thevectorlab.net/slicklab/table-dynamic.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 21 Dec 2015 07:04:39 GMT -->
</html>
