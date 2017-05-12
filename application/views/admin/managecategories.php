            <!-- page head start-->
            <div class="page-head">
                <h3 class="m-b-less">
                    Categories List
                </h3>
                <!--<span class="sub-title">Welcome to Static Table</span>-->
                <div class="state-information">
                    <ol class="breadcrumb m-b-less bg-less">
                        <li><a href="<?php echo base_url();?>admin/dashboard">Home</a></li>
                        
                        <li class="active"> Categories</li>
                    </ol>
                </div>
            </div>
            <!-- page head end-->
				
            <!--body wrapper start-->
            <div class="wrapper">
			<?php if($this->session->flashdata('cat_success')){ ?>
						<div class="alert alert-success alert-block fade in">
                        <button type="button" class="close close-sm" data-dismiss="alert">
                            <i class="fa fa-times"></i>
                        </button>
                        <h4>
                            <i class="fa fa-ok-sign"></i>
                            Success!
                        </h4>
                        <p><?php echo  $this->session->flashdata('cat_success');?></p>
                    </div>
				
						<?php } ?>
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
                            <a class="btn btn-success" href="<?php echo base_url()?>admin/addcategory"><i class="fa fa-plus"></i>Add Category</a>  
                           </div>
                           </div>
                            <table class="table responsive-data-table data-table">
                            <thead>
                            <tr>
								   <th>
                                    S.No
                                </th>
                               
                                <th>
                                    Category Name
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
							
							<?php
								if(!empty($getallcategories)){
									$i=1;
							//echo "<pre>";print_r($getallcategories);exit;
							foreach($getallcategories as $getallcategory) { ?>
                            <tr>
                                <td>
                                    <?php echo $i;//echo $getallcategory->category_id;?>
                                </td>
                                <td>
                                    <?php echo ucfirst($getallcategory->category_name);?>
                                </td>
                                <td>
                                    <?php if($getallcategory->status == 1){?>
									<div><i class="fa fa-check" title="Active"></i></div>
										<?php } else{?>
										<div><i class="fa fa-remove" title="Inactive"></i></div><?php } ?>
                                </td>
                                
								<td>
								<?php if($getallcategory->status == 1){?>
								<a href="<?php echo base_url()?>admin/updatestatus/<?php echo $getallcategory->category_id;?>/<?php echo $getallcategory->status;?>/10" title="Inactive" style="color:black;margin-right:5px;"><i class="fa fa-remove"></i></a>
								<?php } else{?>
								<a href="<?php echo base_url()?>admin/updatestatus/<?php echo $getallcategory->category_id;?>/<?php echo $getallcategory->status;?>/10" title="Active" style="color:black;margin-right:5px;"><i class="fa fa-check"></i></a>
								<?php } ?>
                             <!--<a href="<?php //echo base_url()?>admin/viewvendor/<?php //echo $getallcategory->category_id;?>" style="color:black"><i class="fa fa-eye"></i></a>
								class="label label-danger"-->
								
								<!--class="btn btn-success btn-xs"-->
								<a href="<?php echo base_url()?>admin/editcategoryinfo/<?php echo $getallcategory->category_id;?>" title="Inactive" style="color:black"><i class="fa fa-pencil"></i></a>
								<!--class="btn btn-primary btn-xs"-->
								
								</td>
                                
                            </tr>
								<?php $i++;} }else{?>
								<tr>
								<td colspan="4" style="text-align:center;"><strong>No Records Found</strong></td>
								</tr>
								<?php } ?>
                            </tbody>
                            </table>
                        </section>
                    </div>

                </div>

                

            </div>
            <!--body wrapper end-->
