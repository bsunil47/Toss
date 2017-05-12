            <!-- page head start-->
            <div class="page-head">
                <h3 class="m-b-less">
                    Manage Venues
                </h3>
                <!--<span class="sub-title">Welcome to Static Table</span>-->
                <div class="state-information">
                    <ol class="breadcrumb m-b-less bg-less">
                        <li><a href="<?php echo base_url()?>vendors/dashboard">Home</a></li>
                        <li class="active">Venues List</li>
                    </ol>
                </div>
            </div>
            <!-- page head end-->

            <!--body wrapper start-->
            <div class="wrapper">
				<div class="row">
                    <div class="col-sm-12">
                        <section class="panel">
<!--                            <header class="panel-heading ">
                                Responsive Data Table
<span class="tools_new pull-right" style="padding-bottom: 5px;">
                                    
                                    <a class="t-close fa fa-times" href="javascript:;"></a>
                                </span>
                            </header>-->
 <?php if($this->session->flashdata('venue_success')){ ?>
						<div class="alert alert-success alert-block fade in">
                        <button type="button" class="close close-sm" data-dismiss="alert">
                            <i class="fa fa-times"></i>
                        </button>
                        <h4>
                            <i class="fa fa-ok-sign"></i>
                            Success!
                        </h4>
                        <p><?php echo  $this->session->flashdata('venue_success');?></p>
                    </div>
				
						<?php } ?>
<div class="tbl-head clearfix">
                            <div class="ColVis">
                              <a class="btn btn-success" href="<?php echo base_url()?>vendors/addvenue"><i class="fa fa-plus"></i>Add Venue</a>  
                            </div>
</div>
                            <table class="datatable-11 table responsive-data-table data-table">
                            <thead>
                            <tr>
								   <th>
                                    S.No
                                </th>
									<th>
                                     Venue Name
                                </th>
									
                                <th>
                                   Address
                                </th>
									<!--<th>
                                    Category
                                </th>-->
									<th>
                                    Phone
                                </th>
									<th>
                                    Email
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
     