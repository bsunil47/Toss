            <!-- page head start-->
            <div class="page-head">
                <h3 class="m-b-less">Manage Slots</h3>
                <div class="state-information">
                    <ol class="breadcrumb m-b-less bg-less">
                        <li><a href="<?php echo base_url()?>venues/dashboard">Home</a></li>
                        <!--<li><a href="#">Data Table</a></li>-->
                        <li class="active">Slots</li>
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
                                    <a class="btn btn-success" href="<?php echo base_url()?>venues/addslots"><i class="fa fa-plus"></i>Add Slot</a>
                                </span>
                            </header-->
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
 <?php if($this->session->flashdata('error_slot')){?>
						<div class="alert alert-danger alert-block fade in">
                        <button type="button" class="close close-sm" data-dismiss="alert">
                            <i class="fa fa-times"></i>
                        </button>
                        <h4>
                            <i class="fa fa-ok-sign"></i>
                            Failure!
                        </h4>
                        <p><?php echo  $this->session->flashdata('error_slot');?></p>
                    </div>
								
						<?php }?>
							<div class="tbl-head clearfix">
                           <div class="ColVis">
                            <a class="btn btn-success" href="<?php echo base_url()?>venues/addslots"><i class="fa fa-plus"></i>Add Slot</a>  
                           </div>
                           </div>
                            <table class="datatable-19 table responsive-data-table data-table">
                            <thead>
                            <tr>
								<th>S.No</th>
                                <th>Venue Name</th>
                                <!--<th>Day</th>-->
								<th>From Time</th>
								<th>To Time</th>
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
            <!--body wrapper end-->
            <script>
                var venueid=<?php echo $venueid;?>;
                </script>