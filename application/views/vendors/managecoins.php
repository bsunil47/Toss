            <!-- page head start-->
            <div class="page-head">
                <h3 class="m-b-less">
                    Manage Coins
                </h3>
                <!--<span class="sub-title">Welcome to Static Table</span>-->
                <div class="state-information">
                    <ol class="breadcrumb m-b-less bg-less">
                        <li><a href="<?php echo base_url();?>vendors/dashboard">Home</a></li>
                        
                        <li class="active">Coins</li>
                    </ol>
                </div>
            </div>
            <!-- page head end-->
				
            <!--body wrapper start-->
            <div class="wrapper">
			<?php if($this->session->flashdata('update_cat')){?>
						<div class="alert alert-success alert-block fade in">
                        <button type="button" class="close close-sm" data-dismiss="alert">
                            <i class="fa fa-times"></i>
                        </button>
                        <h4>
                            <i class="fa fa-ok-sign"></i>
                            Success!
                        </h4>
                        <p><?php echo  $this->session->flashdata('update_cat');?></p>
                    </div>
				
						<?php }?>
				<div class="row">
                    <div class="col-sm-12">
                        <section class="panel">
                            <!--<header class="panel-heading ">
                              
                                <span class="tools_new pull-right">
                                    <a class="btn btn-success" href="<?php //echo base_url()?>admin/addcategory"><i class="fa fa-plus"></i>Add Category</a>
                                    <!--<a class="t-close fa fa-times" href="javascript:;"></a>
                                </span>
                            </header>-->
							 <div class="tbl-head clearfix">
                           <div class="ColVis">
                            <a class="btn btn-success" href="<?php echo base_url()?>vendors/addrequestcoins"><i class="fa fa-plus"></i>Add Coin</a>  
                           </div>
                           </div>
                            <table class="datatatable-1 table responsive-data-table data-table">
                            <thead>
                            <tr>
								   <th>
                                    S.No
                                </th>
                               
                                <th>
                                    Type
                                </th>
                                <th>
                                    Coins
                                </th>
									<!--<th>
                                    Status
                                </th>-->
								<th>
                                    Action
                                </th>
                            </tr>
                            </thead>
                            <tbody>
							
							<?php
								if(!empty($getallcoins)){
									$i=1;
							//echo "<pre>";print_r($getallcategories);exit;
							foreach($getallcoins as $getallcoin) { ?>
                            <tr>
                                <td>
                                    <?php echo $i;//echo $getallcategory->category_id;?>
                                </td>
                                <td>
                                    <?php if($getallcoin->type == 1){echo "Action";}else if($getallcoin->type == 2){echo "Request";}?>
                                </td>
									<td>
                                    <?php echo $getallcoin->coins;?>
                                </td>
                                <?php /*<td>
                                    <?php if($getallcoin->status == 1){?>
									<div><i class="fa fa-check" title="Active"></i></div>
										<?php } else{?>
										<div><i class="fa fa-remove" title="Inactive"></i></div><?php } ?>
                                </td>*/?>
                                
								<td>
								<!--<a href="<?php //echo base_url()?>admin/updatestatus/<?php //echo $getallcoin->coin_id;?>/<?php //echo $getallcoin->status;?>/10" title="Active" style="color:black;margin-right:5px;"><i class="fa fa-check"></i></a>
								
                             <a href="<?php //echo base_url()?>admin/viewvendor/<?php //echo $getallcategory->category_id;?>" style="color:black"><i class="fa fa-eye"></i></a>
								class="label label-danger"-->
								
								<!--class="btn btn-success btn-xs"-->
								<a href="<?php echo base_url()?>vendors/editrequestcoinsinfo/<?php echo $getallcoin->coin_id;?>" title="Inactive" style="color:black"><i class="fa fa-pencil"></i></a>
								<!--class="btn btn-primary btn-xs"-->
								
								</td>
                                
                            </tr>
                                                                <?php $i++;}} ?>
                            </tbody>
                            </table>
                        </section>
                    </div>

                </div>

                

            </div>
            <!--body wrapper end-->

