
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
<script>
var venueid=<?php echo $getdetails->venue_id;?>;
var vendorid=<?php echo $getdetails->vendor_id;?>;
</script>