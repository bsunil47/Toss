            <!-- page head start-->
            <div class="page-head">
                <h3 class="m-b-less">
                    Add Coin
                </h3>
                <!--<span class="sub-title">Welcome to Static Table</span>-->
                <div class="state-information">
                    <ol class="breadcrumb m-b-less bg-less">
                        <li><a href="<?php echo base_url();?>admin/dashboard">Home</a></li>
                        <li><a href="<?php echo base_url();?>admin/managecoins">Coins</a></li>
                        <li class="active">Add Coins</li>
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
                  <!--   Form Elements-->
                </header>
                <div class="panel-body">
                    <form action="<?php echo  base_url() ?>admin/addcoins" name="add_coins" method="POST" id="user_frm" class="form-horizontal tasi-form" enctype="multipart/form-data">
                      <?php if($this->session->flashdata('add_coin_success')){?>
						<div class="alert alert-success alert-block fade in">
                        <button type="button" class="close close-sm" data-dismiss="alert">
                            <i class="fa fa-times"></i>
                        </button>
                        <h4>
                            <i class="fa fa-ok-sign"></i>
                            Success!
                        </h4>
                        <p><?php echo  $this->session->flashdata('add_coin_success');?></p>
                    </div>
								
						<?php }?>
					  
						
						<?php if($this->session->flashdata('t_and_c_error')){?>
						<div class="alert alert-block alert-danger fade in">
                        <button type="button" class="close close-sm" data-dismiss="alert">
                            <i class="fa fa-times"></i>
                        </button>
                        <strong>Request!&nbsp;</strong><?php echo  $this->session->flashdata('t_and_c_error');?>
                    </div>
								
						<?php }?>
						 
						<div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Coins</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="coins" value="<?php if(isset($_POST['coins'])){echo $_POST['coins'];}else{echo "";}?>">
								<?php echo form_error('coins')?>
                            </div>
							
                        </div>
						<div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Method</label>
                            <div class="col-sm-10">
                            <input type="text" class="form-control" name="method" value="">
								<?php echo form_error('method')?>
                            </div>			
                        </div>
                        <!--<div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Type</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="type" value="<?php //if(isset($_POST['type'])){echo $_POST['type'];}else{echo "";}?>">
								<?php //echo form_error('type')?>
                            </div>
                        </div>-->
						<div class="form-group">
                                <label class="col-sm-2 col-sm-2 control-label ">From Date</label>
                                <div class="col-md-9 col-xs-11">
                                    <input class="form-control form-control-inline input-medium default-date-picker" type="text" value="" size="16" name="from_date">
                                </div>
                            </div>
						<div class="form-group">
                                <label class="col-sm-2 col-sm-2 control-label">End Date</label>
                                <div class="col-md-9 col-xs-11">
                                    <input class="form-control form-control-inline  default-date-picker" type="text" value="" size="16" name="to_date">
                                </div>
                            </div>
						<!--<div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">From Date</label>
                            <div class="col-sm-10">
                                <input type="text" name="from_date" class="form-control" id="focusedInput"  value="<?php //if(isset($_POST['from_date'])){echo $_POST['from_date'];}else{echo "";}?>" >
								<?php //echo form_error('from_date');?>
                            </div>
                        </div>
						<div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">End Date</label>
                            <div class="col-sm-10">
                                <input type="text" name="to_date" class="form-control" id="focusedInput"  value="<?php //if(isset($_POST['to_date'])){echo $_POST['to_date'];}else{echo "";}?>" >
								<?php //echo form_error('to_date');?>
                            </div>
                        </div>-->
						<div class="form-group">
						<?php if($this->session->flashdata('error')){?>
				<div id="msg"><?php echo  $this->session->flashdata('error');?></div>
						<?php }?>
                            <label class="col-lg-2 col-sm-2 control-label">Limit</label>
                            <div class="col-lg-10">
                          <input type="text" name="limit" class="form-control" id="focusedInput"  value="<?php if(isset($_POST['limit'])){echo $_POST['limit'];}else{echo "";}?>" >
                         <?php echo form_error('limit');?>   
							</div>
                        </div>
				<div class="form-group clearfix">
                      <label class="col-lg-2 col-sm-2 control-label">&nbsp;</label>
                         <div class="col-lg-10">
						<input type="hidden" name="venue_id" value="<?php echo $this->uri->segment(3);?>" >
						    <button class="btn btn-info" type="submit" name="addcoin">Submit</button>
						</div>
					  </div>
					
							
                    </form>
                </div>
            </section>
            
            

            

            </div>
            </div>

            </div>
            <!--body wrapper end-->
