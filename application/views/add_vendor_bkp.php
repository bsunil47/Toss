<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from thevectorlab.net/slicklab/form-layout.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 21 Dec 2015 07:04:39 GMT -->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Mosaddek">
    <meta name="keyword" content="slick, flat, dashboard, bootstrap, admin, template, theme, responsive, fluid, retina">
    <link rel="shortcut icon" href="javascript:;" type="image/png">

    <title>form layout</title>
<?php include_once("includes/admin_header_links.php")?>
</head>

<body class="sticky-header">

    <section>
        <!-- sidebar left start-->
        <?php include_once("includes/admin_leftmenu.php");?>
        <!-- sidebar left end-->

        <!-- body content start-->
        <div class="body-content" style="min-height: 1000px;">

            <!-- header section start-->
        <?php include_once("includes/admin_header.php");?>
            <!-- header section end-->

            <!-- page head start-->
            <div class="page-head">
                <h3 class="m-b-less">
                    Form Layout
                </h3>
                <!--<span class="sub-title">Welcome to Static Table</span>-->
                <div class="state-information">
                    <ol class="breadcrumb m-b-less bg-less">
                        <li><a href="#">Home</a></li>
                        <li><a href="#">Form</a></li>
                        <li class="active">Form Layout</li>
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
                    Form Elements
                </header>
				<?php if($this->session->flashdata('vendor_success')){?>
						<div class="alert alert-success alert-block fade in">
                        <button type="button" class="close close-sm" data-dismiss="alert">
                            <i class="fa fa-times"></i>
                        </button>
                        <h4>
                            <i class="fa fa-ok-sign"></i>
                            Success!
                        </h4>
                        <p><?php echo  $this->session->flashdata('vendor_success');?></p>
                    </div>
								
						<?php }?>
						<?php if($this->session->flashdata('t_and_c_error')){?>
						<div class="alert alert-block alert-danger fade in">
                        <button type="button" class="close close-sm" data-dismiss="alert">
                            <i class="fa fa-times"></i>
                        </button>
                        <strong>Request!&nbsp;</strong><?php echo  $this->session->flashdata('t_and_c_error');?>
                    </div>
					<?php } ?>
                <div class="panel-body no-pad">
                    <form id="basic-form" action="<?php echo  base_url() ?>admin/addvendor" name="add_user" method="POST"  class="form-horizontal tasi-form" enctype="multipart/form-data">
                    <h3>General Info</h3>
						<section>
						<div class="form-group clearfix">
                            <label class="col-sm-2 col-sm-2 control-label">Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="uname" value="<?php if(isset($_POST['uname'])){echo $_POST['uname'];}else{echo "";}?>">
								<?php echo form_error('uname')?>
                            </div>
							
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Email</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="u_email" value="<?php if(isset($_POST['u_email'])){echo $_POST['u_email'];}else{echo "";}?>">
								<?php echo form_error('u_email')?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Password</label>
                            <div class="col-sm-10">
                                <input type="password"  class="form-control" name="u_passw" placeholder="">
								<?php echo form_error('u_passw')?>
                            </div>
                        </div>
						<div class="form-group">
                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Gender</label>
                <div class="col-lg-10">
                    
                    
                    <div class="check-box">
                        <label>
                            <input type="radio" value="male" id="optionsRadios1" name="gender">
                            Male
                        </label>
                    
                    
                        <label>
                            <input type="radio" value="female" id="optionsRadios2" name="gender">
                            Female
                        </label>
						<?php echo form_error('gender')?>
                    </div>

                      </div>
                    </div>
						<div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Phone</label>
                            <div class="col-sm-10">
                                <input type="text" name="u_phone" class="form-control" id="focusedInput"  value="<?php if(isset($_POST['u_phone'])){echo $_POST['u_phone'];}else{echo "";}?>" >
								<?php echo form_error('u_phone');?>
                            </div>
                        </div>
						<div class="form-group">
						<?php if($this->session->flashdata('error')){?>
				<div id="msg"><?php echo  $this->session->flashdata('error');?></div>
						<?php }?>
                            <label class="col-lg-2 col-sm-2 control-label">Upload picture</label>
                            <div class="col-lg-10">
                                <input type="file" id="file-2" name="u_pic" class="file"  multiple=true>
                            </div>
                        </div>
						</section>
						<h3>Details</h3>
						<section>
						<!-- vendor details form start -->
						<div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Company Name</label>
                            <div class="col-sm-10">
                                <input type="text" name="c_name" class="form-control" id="focusedInput"  value="<?php if(isset($_POST['c_name'])){echo $_POST['c_name'];}else{echo "";}?>">
								<?php echo form_error('c_name');?>
                            </div>
                        </div>
						<div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Category Type</label>
                            <div class="col-sm-10">
                                <select class="form-control m-b-10" name="cat_type">
									   <option value="">--Select Category--</option>
									   <?php foreach($getallcategories as $getcategory) { ?>
                                    <option value="<?php echo $getcategory['category_name'];?>"><?php echo $getcategory['category_name'];?></option>
									   <?php } ?>
                                    
                                </select>
								<?php echo form_error('cat_type')?>
                            </div>
							
                        </div>
						<div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Company Address1</label>
                            <div class="col-sm-10">
                                <input type="text" name="c_add1" class="form-control" id="focusedInput"  value="<?php if(isset($_POST['c_add1'])){echo $_POST['c_add1'];}else{echo "";}?>">
								<?php echo form_error('c_add1');?>
                            </div>
                        </div>
						<div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Company Address2</label>
                            <div class="col-sm-10">
                                <input type="text" name="c_add2" class="form-control" id="focusedInput"  value="<?php if(isset($_POST['c_add2'])){echo $_POST['c_add2'];}else{echo "";}?>">
								<?php echo form_error('c_add2');?>
                            </div>
                        </div>
						<div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Company City</label>
                            <div class="col-sm-10">
                                <input type="text" name="c_city" class="form-control" id="focusedInput"  value="<?php if(isset($_POST['c_city'])){echo $_POST['c_city'];}else{echo "";}?>">
								<?php echo form_error('c_city');?>
                            </div>
                        </div>
						<div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Company State</label>
                            <div class="col-sm-10">
                                <input type="text" name="c_state" class="form-control" id="focusedInput"  value="<?php if(isset($_POST['c_state'])){echo $_POST['c_state'];}else{echo "";}?>">
								<?php echo form_error('c_state');?>
                            </div>
                        </div>
						<div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Company Country</label>
                            <div class="col-sm-10">
                                <input type="text" name="c_country" class="form-control" id="focusedInput"  value="<?php if(isset($_POST['c_country'])){echo $_POST['c_country'];}else{echo "";}?>">
								<?php echo form_error('c_country');?>
                            </div>
                        </div>
						<div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Company Pincode</label>
                            <div class="col-sm-10">
                                <input type="text" name="c_pincode" class="form-control" id="focusedInput"  value="<?php if(isset($_POST['c_pincode'])){echo $_POST['c_pincode'];}else{echo "";}?>">
								<?php echo form_error('c_pincode');?>
                            </div>
                        </div>
						<div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Service Provider Display Name</label>
                            <div class="col-sm-10">
                                <input type="text" name="s_disp_name" class="form-control" id="focusedInput"  value="<?php if(isset($_POST['s_disp_name'])){echo $_POST['s_disp_name'];}else{echo "";}?>">
								<?php echo form_error('s_disp_name');?>
                            </div>
                        </div>
						</section>
						<h3>Account Details</h3>
						<section>
						<div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">PAN</label>
                            <div class="col-sm-10">
                                <input type="text" name="c_pan" class="form-control" id="focusedInput"  value="<?php if(isset($_POST['c_pan'])){echo $_POST['c_pan'];}else{echo "";}?>">
								<?php echo form_error('c_pan');?>
                            </div>
                        </div>
						<div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">VAT</label>
                            <div class="col-sm-10">
                                <input type="text" name="c_vat" class="form-control" id="focusedInput"  value="<?php if(isset($_POST['c_vat'])){echo $_POST['c_vat'];}else{echo "";}?>">
								<?php echo form_error('c_vat');?>
                            </div>
                        </div>
						<div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">CST</label>
                            <div class="col-sm-10">
                                <input type="text" name="c_cst" class="form-control" id="focusedInput"  value="<?php if(isset($_POST['c_cst'])){echo $_POST['c_cst'];}else{echo "";}?>">
								<?php echo form_error('c_cst');?>
                            </div>
                        </div>
						<div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">TAN</label>
                            <div class="col-sm-10">
                                <input type="text" name="c_tan" class="form-control" id="focusedInput"  value="<?php if(isset($_POST['c_tan'])){echo $_POST['c_tan'];}else{echo "";}?>">
								<?php echo form_error('c_tan');?>
                            </div>
                        </div>
						<div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Service TAX</label>
                            <div class="col-sm-10">
                                <input type="text" name="c_service_tax" class="form-control" id="focusedInput"  value="<?php if(isset($_POST['c_service_tax'])){echo $_POST['c_service_tax'];}else{echo "";}?>">
								<?php echo form_error('c_service_tax');?>
                            </div>
                        </div>
						<div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Beneficiary Name</label>
                            <div class="col-sm-10">
                                <input type="text" name="benf_name" class="form-control" id="focusedInput"  value="<?php if(isset($_POST['benf_name'])){echo $_POST['benf_name'];}else{echo "";}?>">
								<?php echo form_error('benf_name');?>
                            </div>
                        </div>
						<div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Account Number</label>
                            <div class="col-sm-10">
                                <input type="text" name="account_number" class="form-control" id="focusedInput"  value="<?php if(isset($_POST['account_number'])){echo $_POST['account_number'];}else{echo "";}?>">
								<?php echo form_error('account_number');?>
                            </div>
                        </div>
						<div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Type of Account</label>
                            <div class="col-sm-10">
                                <input type="text" name="t_account" class="form-control" id="focusedInput"  value="<?php if(isset($_POST['t_account'])){echo $_POST['t_account'];}else{echo "";}?>">
								<?php echo form_error('t_account');?>
                            </div>
                        </div>
						<div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">IFSC Code</label>
                            <div class="col-sm-10">
                                <input type="text" name="ifsc_cde" class="form-control" id="focusedInput"  value="<?php if(isset($_POST['ifsc_cde'])){echo $_POST['ifsc_cde'];}else{echo "";}?>">
								<?php echo form_error('ifsc_cde');?>
                            </div>
                        </div>
						</section>
						<h3>Scanned Images</h3>
						<section>
						<div class="form-group">
						<?php if($this->session->flashdata('error')){?>
				<div id="msg"><?php echo  $this->session->flashdata('error');?></div>
						<?php }?>
                            <label class="col-lg-2 col-sm-2 control-label">Scanned Copy of PAN</label>
                            <div class="col-lg-10">
                                <input type="file" id="file-2" name="s_pan" class="file"  multiple=true>
                            </div>
                        </div>
						<div class="form-group">
						<?php if($this->session->flashdata('error')){?>
				<div id="msg"><?php echo  $this->session->flashdata('error');?></div>
						<?php }?>
                            <label class="col-lg-2 col-sm-2 control-label">Scanned Copy of Cancelled Cheque</label>
                            <div class="col-lg-10">
                                <input type="file" id="file-2" name="s_cancl_chq" class="file"  multiple=true>
                            </div>
                        </div>
						<div class="form-group">
						<?php if($this->session->flashdata('error')){?>
				<div id="msg"><?php echo  $this->session->flashdata('error');?></div>
						<?php }?>
                            <label class="col-lg-2 col-sm-2 control-label">Scanned Copy of TAN</label>
                            <div class="col-lg-10">
                                <input type="file" id="file-2" name="s_tan" class="file"  multiple=true>
                            </div>
                        </div>
						<div class="form-group">
						<?php if($this->session->flashdata('error')){?>
				<div id="msg"><?php echo  $this->session->flashdata('error');?></div>
						<?php }?>
                            <label class="col-lg-2 col-sm-2 control-label">Scanned Copy of VAT</label>
                            <div class="col-lg-10">
                                <input type="file" id="file-2" name="s_vat" class="file"  multiple=true>
                            </div>
                        </div>
						<div class="form-group">
						<?php if($this->session->flashdata('error')){?>
				<div id="msg"><?php echo  $this->session->flashdata('error');?></div>
						<?php }?>
                            <label class="col-lg-2 col-sm-2 control-label">Scanned Copy of CST</label>
                            <div class="col-lg-10">
                                <input type="file" id="file-2" name="s_cst" class="file"  multiple=true>
                            </div>
                        </div>
						
						<div class="form-group">
						<?php if($this->session->flashdata('error')){?>
				<div id="msg"><?php echo  $this->session->flashdata('error');?></div>
						<?php }?>
                            <label class="col-lg-2 col-sm-2 control-label">Scanned Copy of Service TAX</label>
                            <div class="col-lg-10">
                                <input type="file" id="file-2" name="s_srvc_tax" class="file"  multiple=true>
                            </div>
                        </div>
						<div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Accept Terms and Conditions</label>
                            <div class="col-sm-10">
                               <!-- <input type="text" name="t_and_c" class="form-control" id="focusedInput"  value="">-->
								<input type="checkbox" name="tandc" value="1"><br />
								click here to see&nbsp;<a href="#" target="__blank">Terms and contions</a>
								<?php echo form_error('tandc');?>
                            </div>
                        </div>
						</section>
						
					<h3>Other Info</h3>
					<section>
						<div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Existing Website</label>
                            <div class="col-sm-10">
                                <input type="text" name="exst_wb" class="form-control" id="focusedInput"  value="<?php if(isset($_POST['exst_wb'])){echo $_POST['exst_wb'];}else{echo "";}?>">
								<?php echo form_error('exst_wb');?>
                            </div>
                        </div>
						<div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Other Website</label>
                            <div class="col-sm-10">
                                <input type="text" name="other_web" class="form-control" id="focusedInput"  value="<?php if(isset($_POST['other_web'])){echo $_POST['other_web'];}else{echo "";}?>">
								<?php echo form_error('other_web');?>
                            </div>
                        </div>
						<div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Other Information1</label>
                            <div class="col-sm-10">
                                <input type="text" name="other_info1" class="form-control" id="focusedInput"  value="<?php if(isset($_POST['other_info1'])){echo $_POST['other_info1'];}else{echo "";}?>">
								<?php echo form_error('other_info1');?>
                            </div>
                        </div>
						<div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Other Information2</label>
                            <div class="col-sm-10">
                                <input type="text" name="other_info2" class="form-control" id="focusedInput"  value="<?php if(isset($_POST['other_info2'])){echo $_POST['other_info2'];}else{echo "";}?>">
								<?php echo form_error('other_info2');?>
                            </div>
                        </div>
						<div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Other Information3</label>
                            <div class="col-sm-10">
                                <input type="text" name="other_info3" class="form-control" id="focusedInput"  value="<?php if(isset($_POST['other_info3'])){echo $_POST['other_info3'];}else{echo "";}?>">
								<?php echo form_error('other_info3');?>
                            </div>
                        </div>
						
						<!-- vendor details form close -->
						<div class="form-group">
                            <label class="col-lg-2 col-sm-2 control-label">&nbsp;</label>
                            <div class="col-lg-10">
						<button class="btn btn-info" type="submit" name="usersubmit">Submit</button>
						</div>
						
                        </div>
                       </section> 
							
                    </form>
                </div>
            </section>
            
            

            

            </div>
            </div>

            </div>
            <!--body wrapper end-->

<?php include_once("includes/admin_footer.php");?>


</body>

<!-- Mirrored from thevectorlab.net/slicklab/form-layout.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 21 Dec 2015 07:04:39 GMT -->
</html>
