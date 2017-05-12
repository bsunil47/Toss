            <!-- page head start-->
            <div class="page-head">
                <h3 class="m-b-less">
                   Manage Images
                </h3>
                <!--<span class="sub-title">Welcome to Static Table</span>-->
                <div class="state-information">
                    <ol class="breadcrumb m-b-less bg-less">
                        <li><a href="<?php echo base_url();?>venues/dashboard">Home</a></li>
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
                            <a class="btn btn-success" href="<?php echo base_url()?>venues/addimages"><i class="fa fa-plus"></i>Add Image</a>  
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
                                    <a href="<?php echo base_url();?>venues/deleteimages/<?php echo $venueid;?>/<?php echo $vendorid;?>/<?php echo $imcount;?>"><i class="fa fa-trash" aria-hidden="true"></i></a>
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
