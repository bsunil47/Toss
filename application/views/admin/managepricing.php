            <!-- page head start-->
			<?php //echo "<pre>";print_r($getdetails);exit;?>
           <div class="page-head">
                <h3 class="m-b-less">Manage Pricing</h3>
                <!--<span class="sub-title">Welcome to Static Table</span>-->
                <div class="state-information">
                    <ol class="breadcrumb m-b-less bg-less">
                        <li><a href="<?php echo base_url();?>admin/dashboard">Home</a></li>
						  <li><a href="<?php echo base_url();?>admin/listvenue/<?php echo $getdetails->vendor_id;?>">Venues List</a></li>
                        <li class="active">Pricing List</li>
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
				<div class="row">
                    <div class="col-sm-12">
                        <section class="panel">
<!--                            <header class="panel-heading ">Pricing List
                                <span class="tools_new pull-right" style="padding-bottom: 5px;">
                                    
                                    <a class="t-close fa fa-times" href="javascript:;"></a>
                                </span>
                            </header>-->
 <?php if($this->session->flashdata('pricing_success')){ ?>
						<div class="alert alert-success alert-block fade in">
                        <button type="button" class="close close-sm" data-dismiss="alert">
                            <i class="fa fa-times"></i>
                        </button>
                        <h4>
                            <i class="fa fa-ok-sign"></i>
                            Success!
                        </h4>
                        <p><?php echo  $this->session->flashdata('pricing_success');?></p>
                    </div>
				
						<?php } ?>
                     <div class="tbl-head clearfix">
                           <div class="ColVis">
                            <a class="btn btn-success" href="<?php echo base_url()?>admin/addpricing/<?php echo $venueid;?>"><i class="fa fa-plus"></i>Add Pricing</a>
                           </div>
                           </div>
                            <table class="datatable-33 table responsive-data-table data-table">
                            <thead>
                            <tr>
								<th>S.No</th>
                                                                <th>Venue Name</th>
                                                                <th>Subcategory/Subsubcategory Name</th>
                                                                <th>Pricing Type</th>
                                                                <th>Amount</th>
								<th>Status</th>
								<th>Action</th>
							</tr>
                            </thead>
                            <tbody>
							</tbody>
                            </table>
                        </section>
                    </div>
                </div>       
            </div>
 
<script>
			var venueid=<?php echo $venueid;?>;
			var vendorid=<?php echo $getdetails->vendor_id;?>;
			</script>