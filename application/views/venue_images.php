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
                   Manage Images
                </h3>
                <!--<span class="sub-title">Welcome to Static Table</span>-->
                <div class="state-information">
                    <ol class="breadcrumb m-b-less bg-less">
                        <li><a href="<?php echo base_url();?>admin/dashboard">Home</a></li>
                        <li class="active">Venue Images</li>
                    </ol>
                </div>
            </div>
            <!-- page head end-->

            <!--body wrapper start-->
            <div class="wrapper">
			<?php if($this->session->flashdata('success')){?>
						<div class="alert alert-success alert-block fade in">
                        <button type="button" class="close close-sm" data-dismiss="alert">
                            <i class="fa fa-times"></i>
                        </button>
                        <h4>
                            <i class="fa fa-ok-sign"></i>
                            Success!
                        </h4>
                        <p><?php echo  $this->session->flashdata('success');?></p>
                    </div>
				
						<?php }?>
				<?php if($this->session->flashdata('error')){?>
						<div class="alert alert-success alert-block fade in">
                        <button type="button" class="close close-sm" data-dismiss="alert">
                            <i class="fa fa-times"></i>
                        </button>
                        <h4>
                            <i class="fa fa-ok-sign"></i>
                            Success!
                        </h4>
                        <p><?php echo  $this->session->flashdata('error');?></p>
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
                            <a class="btn btn-success" href="<?php echo base_url()?>admin/addimages/<?php echo $venueid;?>/<?php echo $vendorid;?>"><i class="fa fa-plus"></i>Add Image</a>  
                           </div>
                           </div>
						   <!-- class="responsive-data-table" -->
                            <table class="datatable-1 table responsive-data-table data-table">
                            <thead>
                            <tr>
								   <th style="text-align: center;">
                                    S. No
                                </th>
                                <th style="text-align: center;">
                                    Image
                                </th>
                                <th style="text-align: center;">
                                    Action
                                </th>
                            </tr>
                            </thead>
                            <tbody>
							<?php 
							$i=1;
                                                      if(!empty($images)){foreach($images as $image) { ?>
                            <tr>
                                <td width="10%" style="text-align: center;">
                                    <?php echo $i;//echo $getfacility->facility_id;?>
                                </td>
                                <td width="65%" style="text-align: center;">
                                    <?php 
                                    $img=explode(".",$image);
                                    $img2=explode("-",$img[0]);
                                    $imcount=$img2[2];
                                   ?>
                                    <img src="<?php echo base_url();?>/images/venues/<?php echo $image?>" height="50" width="50">
                                </td>
                                
                                <td width="25%" style="text-align: center;">
                                    <a href="<?php echo base_url();?>admin/deleteimages/<?php echo $venueid;?>/<?php echo $vendorid;?>/<?php echo $imcount;?>"><i class="fa fa-trash" aria-hidden="true"></i></a>
								</td>
            
                            </tr>
                                                      <?php $i++;}}else{ ?>
                            <tr><td colspan="3">No Records Found</td></tr><?php }?>
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
