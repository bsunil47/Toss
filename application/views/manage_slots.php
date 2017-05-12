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

    <title>data table</title>

    <?php include_once("includes/admin_header_links.php");?>
</head>

<body class="sticky-header">

    <section>
        <!-- sidebar left start-->
        <?php include_once("includes/admin_leftmenu.php");?>
        <!-- sidebar left end-->

        <!-- body content start-->
        <div class="body-content" style="min-height: 1000px;">

            <!-- header section start-->
            <?php include_once("includes/admin_header.php");?>
            <!-- header section end-->

            <!-- page head start-->
            <div class="page-head">
                <h3 class="m-b-less">
                   Manage Slots
                </h3>
				<?php //echo "<pre>";print_r($getdetails);exit;?>
                <!--<span class="sub-title">Welcome to Static Table</span>-->
                <div class="state-information">
                    <ol class="breadcrumb m-b-less bg-less">
                        <li><a href="<?php echo base_url();?>admin/dashboard">Home</a></li>
                        <li><a href="<?php echo base_url();?>admin/listvenue/<?php echo $getdetails->vendor_id;?>">Venues List</a></li>
                        <li class="active">Slots</li>
                    </ol>
                </div>
            </div>
            <!-- page head end-->

            <!--body wrapper start-->
            <div class="wrapper">
			<?php if($this->session->flashdata('success_slot')){?>
						<div class="alert alert-success alert-block fade in">
                        <button type="button" class="close close-sm" data-dismiss="alert">
                            <i class="fa fa-times"></i>
                        </button>
                        <h4>
                            <i class="fa fa-ok-sign"></i>
                            Success!
                        </h4>
                        <p><?php echo  $this->session->flashdata('success_slot');?></p>
                    </div>
								
						<?php }?>
				<div class="row">
                    <div class="col-sm-12">
                        <section class="panel">
                            <!--<header class="panel-heading ">
                                
                                <span class="tools_new pull-right">
                                    <a class="btn btn-success" href="<?php //echo base_url()?>admin/addslots/<?php //echo $this->uri->segment(3);?>"><i class="fa fa-plus"></i>Add Slot</a>
                                    <!--<a class="t-close fa fa-times" href="javascript:;"></a>
                                </span>
                            </header>-->
							<?php //echo "<pre>";print_r($getdetails);exit;?>
							 <div class="tbl-head clearfix">
                           <div class="ColVis">
                            <a class="btn btn-success" href="<?php echo base_url()?>admin/addslots/<?php echo $getdetails->vendor_id?>/<?php echo $getdetails->venue_id;?>"><i class="fa fa-plus"></i>Add Slots</a>  
                           </div>
                           </div>
                            <table class="datatable-22 table responsive-data-table data-table">
                            <thead>
                            <tr>
								   <th>
                                    S. No
                                </th>
                                <th>
                                    Venue Name
                                </th>
                                
									<!--<th>
                                    Day
                                </th>-->
								<th>
                                    From Time
                                </th>
								<th>
                                    To Time
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
							
                            </tbody>
                            </table>
                        </section>
                    </div>

                </div>

                

            </div>
            <!--body wrapper end-->


            <?php include_once("includes/admin_footer.php");?>


</body>

<!-- Mirrored from thevectorlab.net/slicklab/table-dynamic.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 21 Dec 2015 07:04:39 GMT -->
</html>
<script>
var venueid=<?php echo $getdetails->venue_id;?>;
var vendorid=<?php echo $getdetails->vendor_id;?>;
</script>