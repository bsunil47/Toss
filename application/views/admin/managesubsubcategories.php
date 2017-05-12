        <!-- page head start-->
        <div class="page-head">
            <h3 class="m-b-less">
                Manage Sub Sub Categories
            </h3>
            <!--<span class="sub-title">Welcome to Static Table</span>-->
            <div class="state-information">
                <ol class="breadcrumb m-b-less bg-less">
                    <li><a href="<?php echo base_url(); ?>admin/dashboard">Home</a></li>
                    <li class="active">Sub Sub Categories</li>
                </ol>
            </div>
        </div>
        <!-- page head end-->

        <!--body wrapper start-->
        <div class="wrapper">
            <?php if ($this->session->flashdata('subcat_success')) { ?>
                <div class="alert alert-success alert-block fade in">
                    <button type="button" class="close close-sm" data-dismiss="alert">
                        <i class="fa fa-times"></i>
                    </button>
                    <h4>
                        <i class="fa fa-ok-sign"></i>
                        Success!
                    </h4>
                    <p><?php echo $this->session->flashdata('subcat_success'); ?></p>
                </div>

            <?php } ?>
            <?php if ($this->session->flashdata('update_subcat_sucess')) { ?>
                <div class="alert alert-success alert-block fade in">
                    <button type="button" class="close close-sm" data-dismiss="alert">
                        <i class="fa fa-times"></i>
                    </button>
                    <h4>
                        <i class="fa fa-ok-sign"></i>
                        Success!
                    </h4>
                    <p><?php echo $this->session->flashdata('update_subcat_sucess'); ?></p>
                </div>

            <?php } ?>
            <div class="row">
                <div class="col-sm-12">
                    <section class="panel">
                            <div class="tbl-head clearfix">
                            <div class="ColVis">
                                <a class="btn btn-success" href="<?php echo base_url() ?>admin/addsubsubcategory"><i
                                        class="fa fa-plus"></i>Add Subsubcategory</a>
                            </div>
                        </div>
                        <table class="datatable-36 table responsive-data-table data-table">
                            <thead>
                            <tr>
                                <th>
                                    S. No
                                </th>
                                <th>
                                    Category Name
                                </th>
                                <th>
                                    Subcategory Name
                                </th>

                                <th>
                                    Sub Subcategory Name
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
