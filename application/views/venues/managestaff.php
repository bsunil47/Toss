            <!-- page head start-->
            <div class="page-head">
                <h3 class="m-b-less">Manage Staff </h3>
                <!--<span class="sub-title">Welcome to Static Table</span>-->
                <div class="state-information">
                    <ol class="breadcrumb m-b-less bg-less">
                        <li><a href="<?php echo base_url();?>venues/dashboard">Home</a></li>
                        <!--<li><a href="<?php //echo base_url();?>venues/managestaff">Staff</a></li>-->
                        <li class="active">Staff</li>
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
									<a class="btn btn-success" href="<?php //echo base_url()?>venues/addstaff"><i class="fa fa-plus"></i>Add Staff</a>
                                </span>
                            </header-->
							<div class="tbl-head clearfix">
							<div class="ColVis">
                            <a class="btn btn-success" href="<?php echo base_url()?>venues/addstaff"><i class="fa fa-plus"></i>Add Staff</a>  
                           </div>
                           </div>
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
							 <table class="datatable-17 table responsive-data-table data-table">
							  <thead>
                            <tr>
								<th>S.No</th>
                                <th>User Name</th>
                                <th>Email</th>
                                <th>Phone</th>
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