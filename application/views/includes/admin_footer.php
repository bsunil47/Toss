<!--footer section start-->
            <footer>
                2016 &copy; Omulus Infotech Private Limited.
            </footer>
            <!--footer section end-->


            <!-- Right Slidebar start -->
            <?php //include_once("includes/right_sidebar.php");?>
            <!-- Right Slidebar end -->

        </div>
        <!-- body content end-->
    </section>

<!-- Placed js at the end of the document so the pages load faster -->
<script src="<?php echo base_url() ?>js/jquery-1.10.2.min.js"></script>
<script src="<?php echo base_url() ?>js/jquery-migrate.js"></script>
<script src="<?php echo base_url() ?>js/bootstrap.min.js"></script>
<script src="<?php echo base_url() ?>js/modernizr.min.js"></script>

<!--Nice Scroll-->
<script src="<?php echo base_url() ?>js/jquery.nicescroll.js" type="text/javascript"></script>

<!--right slidebar-->
<script src="<?php echo base_url() ?>js/slidebars.min.js"></script>

<!--switchery-->
<script src="<?php echo base_url() ?>js/switchery/switchery.min.js"></script>

<?php
$allowed_url=array("addvenue","addvendor","editvendor","addsubcategory","addpricing","editvenueinfo","addslots","editslotinfo","addfacility","editsubcategory"); 
$segment=$this->uri->segment(2);
if(in_array($segment,$allowed_url)){ ?>
<script src="<?php echo base_url() ?>js/switchery/switchery-init.js"></script>
<?php } ?>

<!-- multi selectbox -->
<?php

if(in_array($segment,$allowed_url)){ ?>

<script src="<?php echo base_url() ?>js/select2.js"></script>

<script src="<?php echo base_url() ?>js/select2-init.js"></script>	
	
<?php } ?>
<!-- multi select box end-->

<!--Sparkline Chart
<script src="<?php //echo base_url() ?>js/sparkline/jquery.sparkline.js"></script>
<script src="<?php //echo base_url() ?>js/sparkline/sparkline-init.js"></script>-->

<?php

if(in_array($segment,$allowed_url)){ ?>
<!--Form Wizard-->

<script src="<?php echo base_url()?>js/jquery.steps.min.js" type="text/javascript"></script>

<script src="<?php echo base_url()?>js/jquery.validate.min.js" type="text/javascript"></script>

<!--Form Validation-->
<script src="<?php echo base_url()?>js/bootstrap-validator.min.js" type="text/javascript"></script>
<!--wizard initialization-->
<script src="<?php echo base_url()?>js/wizard-init.js" type="text/javascript"></script>
<!--bootstrap-fileinput-master-->
<script type="text/javascript" src="<?php echo base_url()?>js/bootstrap-fileinput-master/js/fileinput.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>js/file-input-init.js"></script>

<!--bootstrap picker-->



<script type="text/javascript" src="<?php echo base_url()?>js/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>

<script type="text/javascript" src="<?php echo base_url()?>js/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>

<!--picker initialization-->


<!-- google map js initialization-->
<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?v=3&sensor=true&callback=initializeMap&libraries=places"></script>
<!--<script type="text/javascript" src="<?php //echo base_url();?>js/gMap.js"></script>-->

<!-- end google map initialization -->
<?php } ?>
<!-- -->
<?php

if($this->router->fetch_method()=="addrequestcoins" || $this->router->fetch_method()=="editrequestcoinsinfo" || $this->router->fetch_method()=="editcoininfo" || $this->router->fetch_method()=="addcoins"){ ?>
<script type="text/javascript" src="<?php echo base_url()?>js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>js/bootstrap-daterangepicker/moment.min.js"></script>	
<script type="text/javascript" src="<?php echo base_url()?>js/bootstrap-daterangepicker/daterangepicker.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>js/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>	
<script type="text/javascript" src="<?php echo base_url()?>js/picker-init.js"></script>	
<?php } ?>
<!-- -->

<!--data table init-->
<?php
$segment=$this->uri->segment(2);
$array=array("managevendors","managevenues","manageappusers","manageusers","manageadminusers","managevenuemanagers","managecategories","managesubcategories","manageslots","managefacilities","managevenuefacilities","managepricing","managestaff","manageaddons","managecoins","managecustomers","managesubsubcategories");
 if(in_array($segment,$array )){?>

<!--<script src="<?php //echo base_url() ?>js/datatables/jquery.dataTables.js"></script>-->
<script src="<?php echo base_url() ?>js/data-table/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url() ?>js/data-table/js/dataTables.tableTools.min.js"></script>
<script src="<?php echo base_url() ?>js/data-table/js/bootstrap-dataTable.js"></script>
<script src="<?php echo base_url() ?>js/data-table/js/dataTables.responsive.min.js"></script>
<!--<script src="<?php echo base_url() ?>js/data-table-init.js"></script>-->
<script src="<?php echo base_url() ?>js/admin_common.js"></script>
<?php } ?>
<?php if($this->uri->segment(2)=="view_vendors" || $this->uri->segment(2)=="view_venue"){ ?>
<!--pulsate-->
<script type="text/javascript" src="<?php echo base_url() ?>js/jquery.pulsate.min.js"></script>
<script src="<?php echo base_url() ?>js/pulstate.js" type="text/javascript"></script>

<!--gritter-->
<script type="text/javascript" src="<?php echo base_url() ?>js/gritter/js/jquery.gritter.js"></script>
<script src="js/gritter.js" type="<?php echo base_url() ?>text/javascript"></script>
<?php } ?>

<!--common scripts for all pages-->
<script src="<?php echo base_url()?>js/scripts.js"></script>

<!--<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>-->
<script src="<?php echo base_url()?>js/app.js"></script>

