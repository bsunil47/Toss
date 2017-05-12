            <!-- page head start-->
            <div class="page-head">
                <h3 class="m-b-less">
                   Manage Slots
                </h3>
                <!--<span class="sub-title">Welcome to Static Table</span>-->
                <div class="state-information">
                    <ol class="breadcrumb m-b-less bg-less">
                        <li><a href="<?php echo base_url();?>vendors/dashboard">Home</a></li>
                         <li><a href="<?php echo base_url();?>vendors/managevenues">Venues</a></li>
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
<!--                            <header class="panel-heading ">
                                <strong>Slots List</strong>
                                <span class="tools_new pull-right" style="padding-bottom: 5px;">
                                    
                                    <a class="t-close fa fa-times" href="javascript:;"></a>
                                </span>
                            </header>-->
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
<div class="tbl-head clearfix">
                            <div class="ColVis">
                               <a class="btn btn-success" href="<?php echo base_url()?>vendors/addslots/<?php echo $venue_id;?>"><i class="fa fa-plus"></i>Add Slot</a> 
                            </div>
</div>
                            <table class="datatable-14 table responsive-data-table data-table">
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
            var venue_id=<?php echo $venue_id;?>
            </script>
