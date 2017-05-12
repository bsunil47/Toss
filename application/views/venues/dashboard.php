            <!-- page head start-->
            <div class="page-head">
                <h3>
                    Venue Manager Dashboard
                </h3>
                <span class="sub-title">Welcome to <?php echo $this->session->userdata('user_name');?></span>
                 </div>
            <!-- page head end-->

            <!--body wrapper start-->
            <div class="wrapper">
                <!--state overview start-->
          <div class="row state-overview">
                    <div class="col-lg-3 col-sm-6">
                        <section class="panel purple">
                            <div class="symbol">
                                <i class="fa fa-send"></i>
                            </div>
                            <div class="value white">
                                <h1 class="timer" data-from="0" data-to="320"
                                    data-speed="1000">
                                    <?php echo $staffusers->countall;?>
                                </h1>
                                <p>Staff Users</p>
                            </div>
                        </section>
                    </div>
                    
                </div>
                <!--state overview end-->

                <div class="row">
                    <div class="col-md-8">
                        <section class="panel">
                            <header class="panel-heading">
                               Pie Chart
                                <!--<span class="tools pull-right">
                                    <a class="fa fa-repeat box-refresh" href="javascript:;"></a>
                                    <a class="t-collapse fa fa-chevron-down" href="javascript:;"></a>
                                    <a class="t-close fa fa-times" href="javascript:;"></a>
                                </span>-->
                            </header>
                            <div class="panel-body">
								<div id="donutchart" style="width: 700px; height:350px;"></div>
								<div id="number_format_chart" style="display:none;" ></div>
                              
                            </div>
                        </section>
                    </div>
                    
                </div>

               


            </div>
            <!--body wrapper end-->

