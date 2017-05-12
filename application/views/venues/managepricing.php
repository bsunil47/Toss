            <!-- page head start-->
           <div class="page-head">
                <h3 class="m-b-less">Manage Pricing</h3>
                <div class="state-information">
                    <ol class="breadcrumb m-b-less bg-less">
                        <li><a href="<?php echo base_url();?>venues/dashboard">Home</a></li>
                         <li class="active">Pricing</li>
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
                            <!--header class="panel-heading ">
								<span class="tools_new pull-right">
                                    <a class="btn btn-success" href="<?php //echo base_url()?>venues/addpricing"><i class="fa fa-plus"></i>Add Pricing</a>
                                </span>
                            </header-->
							<div class="tbl-head clearfix">
                           <div class="ColVis">
                            <a class="btn btn-success" href="<?php echo base_url()?>venues/addpricing"><i class="fa fa-plus"></i>Add Pricing</a>  
                           </div>
                           </div>
                            <table class="datatable-16 table responsive-data-table data-table">
                            <thead>
                            <tr>
								<th>S. No</th>
                                <th>Venue Name</th>
                                <th>Name of the Category</th>
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
            <!--body wrapper end-->
      <script>
          var venueid=<?php echo $venueid;?>
          </script>