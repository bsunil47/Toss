            <!-- page head start-->
            <div class="page-head">
                <h3 class="m-b-less">
                   Edit User
                </h3>
                <!--<span class="sub-title">Welcome to Static Table</span>-->
                <div class="state-information">
                    <ol class="breadcrumb m-b-less bg-less">
                        <li><a href="<?php echo base_url();?>admin/dashboard">Home</a></li>
                        <li><a href="<?php echo base_url();?>admin/managecoins">Coins</a></li>
                        <li class="active">Edit Coins</li>
                    </ol>
                </div>
            </div>
            <!-- page head end-->

            <!--body wrapper start-->
            <div class="wrapper">
            <div class="row">
            <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    
                </header>
                <div class="panel-body">
                    <form action="<?php echo  base_url() ?>admin/editcoindetails" name="edit_coin" method="POST" id="edit_coin" class="form-horizontal tasi-form" enctype="multipart/form-data">
                      <?php if($this->session->flashdata('edit_success_coin')){?>
						<div class="alert alert-success alert-block fade in">
                        <button type="button" class="close close-sm" data-dismiss="alert">
                            <i class="fa fa-times"></i>
                        </button>
                        <h4>
                            <i class="fa fa-ok-sign"></i>
                            Success!
                        </h4>
                        <p><?php echo  $this->session->flashdata('edit_success_coin');?></p>
                    </div>
								
						<?php }?>
						<?php //echo "<pre>";print_r($editcoin);?>
					  
						
						<?php if($this->session->flashdata('t_and_c_error')){?>
						<div class="alert alert-block alert-danger fade in">
                        <button type="button" class="close close-sm" data-dismiss="alert">
                            <i class="fa fa-times"></i>
                        </button>
                        <strong>Request!&nbsp;</strong><?php echo  $this->session->flashdata('t_and_c_error');?>
                    </div>
								
						<?php }?>
						<?php //echo "<pre>";print_r($editrequestcoininfo);
						 
						 $editfromdate=explode("-",$editcoin->from_date);
						 $editfromday=substr($editfromdate[2],0,2);
						 $editfrommonth=$editfromdate[1];
						 $editfromyear=$editfromdate[0];
						 $editfromdate=$editfrommonth."-".$editfromday."-".$editfromyear;
						 
						 $edittodate=explode("-",$editcoin->end_date);
						 $edittoday=substr($edittodate[2],0,2);
						 $edittomonth=$edittodate[1];
						 $edittoyear=$edittodate[0];
						 $edittodate=$edittomonth."-".$edittoday."-".$edittoyear;
						 
						 ?>
						
						<div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Coins</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="coin" value="<?php if(isset($editcoin->coins)){echo $editcoin->coins;}?>">
								<?php echo form_error('coin')?>
                            </div>
							
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Method</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="method" value="<?php if(isset($editcoin->method)){echo $editcoin->method;}?>">
								<?php echo form_error('method')?>
                            </div>
                        </div>
						<div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Type</label>
                            <div class="col-sm-10">
                                <select class="form-control m-b-10" name="type">
									   <option value="">--Select Type--</option>
									   <option value="1"<?php if($editcoin->type==1) {?>selected<?php }?>>Action</option>
                                    <option value="2"<?php if($editcoin->type==2) {?>selected<?php }?>>Request</option>
                                    
                                </select>
								<?php echo form_error('type')?>
                            </div>
							
                        </div>
						<div class="form-group">
                                <label class="col-sm-2 col-sm-2 control-label ">From Date</label>
                               <div class="col-md-9 col-xs-11">
<input class="form-control form-control-inline input-medium default-date-picker" type="text" value="<?php if(!empty($editfromdate)){echo $editfromdate;}?>" size="16" name="from_date">
                                     </div>
                            </div>
						<div class="form-group">
                                <label class="col-sm-2 col-sm-2 control-label">End Date</label>
                                <div class="col-md-9 col-xs-11">
<input class="form-control form-control-inline  default-date-picker" type="text" value="<?php if(!empty($edittodate)){echo $edittodate;}?>" size="16" name="to_date">
                                  </div>
                            </div>
                      <!-- <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">From Date</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="from_date" value="<?php if(isset($editcoin->from_date)){echo $editcoin->from_date;}?>">
								<?php //echo form_error('from_date')?>
                            </div>
                        </div>-->
						<!--<div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">To Date</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="to_date" value="<?php if(isset($editcoin->end_date)){echo $editcoin->end_date;}?>">
								<?php //echo form_error('to_date')?>
                            </div>
                        </div>-->
						
						<div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Limit</label>
                            <div class="col-sm-10">
                                <input type="text" name="limit" class="form-control" id="focusedInput"  value="<?php if(isset($editcoin->limit)){echo $editcoin->limit;}?>" >
								<?php echo form_error('limit');?>
                            </div>
                        </div>
						
				<div class="form-group clearfix">
                      <label class="col-lg-2 col-sm-2 control-label">&nbsp;</label>
                         <div class="col-lg-10">
						 <input type="hidden" name="coin_id" value="<?php echo $editcoin->coin_id;?>">
							
						    <button class="btn btn-info" type="submit" name="coinsubmit">Submit</button>
						</div>
					  </div>
					
							
                    </form>
                </div>
            </section>
            
            

            

            </div>
            </div>

            </div>
            <!--body wrapper end-->
