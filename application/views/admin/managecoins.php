            <!-- page head start-->
            <div class="page-head">
                <h3 class="m-b-less">
                    Manage Coins
                </h3>
                <!--<span class="sub-title">Welcome to Static Table</span>-->
                <div class="state-information">
                    <ol class="breadcrumb m-b-less bg-less">
                        <li><a href="<?php echo base_url();?>admin/dashboard">Home</a></li>
                        
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
                            <div class="tbl-head clearfix">
                                <div class="ColVis">
                            <a class="btn btn-success" href="<?php echo base_url()?>admin/addcoins"><i class="fa fa-plus"></i>Add Coin</a>  
                           </div>
                                                    </div>
                            <table class="datatable-1 table responsive-data-table data-table">
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
							foreach($getallcoins as $getallcoin) { ?>
                            <tr>
                                <td>
                                    <?php echo $i;?>
                                </td>
                                <td>
                                    <?php if($getallcoin->type == 1){echo "Action";}else if($getallcoin->type == 2){echo "Request";}?>
                                </td>
									<td>
                                    <?php echo $getallcoin->coins;?>
                                </td>
                                                           
								<td>
								
								<a href="<?php echo base_url()?>admin/editcoinsinfo/<?php echo $getallcoin->coin_id;?>" title="Edit" style="color:black"><i class="fa fa-pencil"></i></a>
															
								</td>
                                
                            </tr>
								<?php  $i++;} }?> 
                            </tbody>
                            </table>
                        </section>
                    </div>

                </div>

                

            </div>
            <!--body wrapper end-->
