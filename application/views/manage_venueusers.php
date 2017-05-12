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
                    Venue Users
                </h3>
                <!--<span class="sub-title">Welcome to Static Table</span>-->
                <div class="state-information">
                    <ol class="breadcrumb m-b-less bg-less">
                        <li><a href="<?php echo base_url();?>admin/dashboard">Home</a></li>
                        <li><a href="<?php echo base_url();?>admin/listvenue/<?php echo $getdetails->vendor_id;?>">Venue List</a></li>
                        <li class="active">Venue Users</li>
                    </ol>
                </div>
            </div>
            <!-- page head end-->

            <!--body wrapper start-->
            <div class="wrapper">
			<?php if($this->session->flashdata('add_user_success')){?>
						<div class="alert alert-success alert-block fade in">
                        <button type="button" class="close close-sm" data-dismiss="alert">
                            <i class="fa fa-times"></i>
                        </button>
                        <h4>
                            <i class="fa fa-ok-sign"></i>
                            Success!
                        </h4>
                        <p><?php echo  $this->session->flashdata('add_user_success');?></p>
                    </div>
								
						<?php }?>
				<?php if($this->session->flashdata('update_user_success')){?>
						<div class="alert alert-success alert-block fade in">
                        <button type="button" class="close close-sm" data-dismiss="alert">
                            <i class="fa fa-times"></i>
                        </button>
                        <h4>
                            <i class="fa fa-ok-sign"></i>
                            Success!
                        </h4>
                        <p><?php echo  $this->session->flashdata('update_user_success');?></p>
                    </div>
				
						<?php }?>
				<div class="row">
                    <div class="col-sm-12">
                        <section class="panel">
                            <header class="panel-heading ">
                               
                               <span class="tools_new pull-right">
							   <?php //if(!empty($viewvenueusers)){ ?>
									<a class="btn btn-success" href="<?php echo base_url()?>admin/adduser/<?php echo $getdetails->venue_id;?>"><i class="fa fa-plus"></i>Add User</a>
							   <?php //} ?>   <!-- <a class="fa fa-repeat box-refresh" href="javascript:;"></a>
                                    <a class="t-close fa fa-times" href="javascript:;"></a>
                                </span>-->
                            </header>
                         
							 <table class="table responsive-data-table data-table">
							  <thead>
                            <tr>
								   <th>
                                    S.No
                                </th>
								 <th>
                                    User Name
                                </th>
                                <th>
                                    User Type
                                </th>
                                <th>
                                    Email
                                </th>
                                <th>
                                    Phone
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
							//echo "<pre>";print_r($viewuserdetails);exit;
							if(!empty($viewvenueusers)){
							foreach($viewvenueusers as $viewvenueuser) { 
							if($viewvenueuser->usertype != 2){
							?>
                            <tr>
                                <td>
                                    <?php echo $i;?>
                                </td>
								<td>
                                    <?php echo ucfirst($viewvenueuser->name);?>
                                </td>
                                
								<td>
                                    <?php if($viewvenueuser->usertype == 3) { echo "Venue Manager"; } if($viewvenueuser->usertype == 4){ echo "Staff"; }?>
                                </td>
								<td>
                                    <?php echo $viewvenueuser->email;?>
                                </td>
								<td>
                                    <?php echo $viewvenueuser->phone;?>
                                </td>

                                <td>
                                    <?php if($viewvenueuser->venueuserstatus == 1){?>
									<div><i class="fa fa-check"></i></div>
										<?php } else {?>
										<div><i class="fa fa-remove"></i></div><?php } ?>
                                </td>
                                
								<td>
                                <?php if($viewvenueuser->venueuserstatus == 1){?>
								<a href="<?php echo base_url()?>admin/updatestatus/<?php echo $viewvenueuser->user_id;?>/<?php echo $viewvenueuser->venueuserstatus;?>/<?php echo $viewvenueuser->usertype;?>" style="color:black;margin-right:5px;"><i class="fa fa-remove"></i></a>
                                    <?php } else {?>
                                    <a href="<?php echo base_url()?>admin/updatestatus/<?php echo $viewvenueuser->user_id;?>/<?php echo $viewvenueuser->venueuserstatus;?>/<?php echo $viewvenueuser->usertype;?>" style="color:black;margin-right:5px;"><i class="fa fa-check"></i></a>

                                <?php } ?>
                             <a href="<?php echo base_url()?>admin/viewuserinfo/<?php echo $viewvenueuser->venueid;?>/<?php echo $viewvenueuser->user_id;?>" style="color:black"><i class="fa fa-eye"></i></a>
								<!--class="label label-danger"-->
								
								<!--class="btn btn-success btn-xs"-->
								<a href="<?php echo base_url()?>admin/edituserinfo/<?php echo $viewvenueuser->venueid;?>/<?php echo $viewvenueuser->user_id;?>" style="color:black"><i class="fa fa-pencil"></i></a>
								<!--class="btn btn-primary btn-xs"-->
								
								</td>
                                
                            </tr>
							<?php 
								$i++;
								
									}
								}
							}
							else {?>
							<tr>
							<td colspan="7" style="text-align:center;"><strong>No Records Found</strong></td>
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
			<script>
			var venueid=<?php echo $getdetails->venue_id;?>;
			var vendorid=<?php echo $getdetails->vendor_id;?>;
			</script>

</body>

<!-- Mirrored from thevectorlab.net/slicklab/table-dynamic.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 21 Dec 2015 07:04:39 GMT -->
</html>
