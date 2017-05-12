<!-- page head start-->
<div class="page-head">
    <h3 class="m-b-less">
        Vendors List
    </h3>
    <!--<span class="sub-title">Welcome to Static Table</span>-->
    <div class="state-information">
        <ol class="breadcrumb m-b-less bg-less">
            <li><a href="<?php echo base_url(); ?>admin/dashboard">Home</a></li>
            <li class="active">Manage Vendors</li>
        </ol>
    </div>
</div>
<!-- page head end-->

<!--body wrapper start-->
<div class="wrapper">
    <?php if ($this->session->flashdata('vendor_success')) { ?>
        <div class="alert alert-success alert-block fade in">
            <button type="button" class="close close-sm" data-dismiss="alert">
                <i class="fa fa-times"></i>
            </button>
            <h4>
                <i class="fa fa-ok-sign"></i>
                Success!
            </h4>
            <p><?php echo $this->session->flashdata('vendor_success'); ?></p>
        </div>

    <?php } ?>
    <div class="wrapper">
        <?php if ($this->session->flashdata('venodr_upload')) { ?>
            <div class="alert alert-success alert-block fade in">
                <button type="button" class="close close-sm" data-dismiss="alert">
                    <i class="fa fa-times"></i>
                </button>
                <h4>
                    <i class="fa fa-ok-sign"></i>
                    Success!
                </h4>
                <p><?php echo $this->session->flashdata('venodr_upload'); ?></p>
            </div>

        <?php } ?>
        <?php if ($this->session->flashdata('update_vendor')) { ?>
            <div class="alert alert-success alert-block fade in">
                <button type="button" class="close close-sm" data-dismiss="alert">
                    <i class="fa fa-times"></i>
                </button>
                <h4>
                    <i class="fa fa-ok-sign"></i>
                    Success!
                </h4>
                <p><?php echo $this->session->flashdata('update_vendor'); ?></p>
            </div>

        <?php } ?>
        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <!--<header class="panel-heading ">
                                
                               <span class="tools_new pull-right">
									<a class="btn btn-success" href="<?php //echo base_url()?>admin/addvendor"><i class="fa fa-plus"></i>Add Vendor</a>
                                     <a class="fa fa-repeat box-refresh" href="javascript:;"></a>
											<a class="t-close fa fa-times" href="javascript:;"></a>
											</span> 
                            </header>-->
                    <div class="tbl-head clearfix">
                        <div class="ColVis">
                            <a class="btn btn-success" href="<?php echo base_url() ?>admin/addvendor"><i
                                    class="fa fa-plus"></i>Add Vendor</a>
                        </div>
                    </div>

                    <table class="datatable-2 table responsive-data-table data-table">
                        <thead>
                        <tr>
                            <th>
                                S.No
                            </th>
                            <th>
                                Vendor Name
                            </th>
                            <th>
                                Email
                            </th>
                            <th>
                                Phone
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
