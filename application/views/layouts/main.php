<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from thevectorlab.net/slicklab/ by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 21 Dec 2015 07:01:40 GMT -->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="author" content="Mosaddek" />
    <meta name="keyword" content="slick, flat, dashboard, bootstrap, admin, template, theme, responsive, fluid, retina" />
    <meta name="description" content="" />
    <link rel="shortcut icon" href="javascript:;" type="image/png">

    <title>TOSS</title>

    <?php $this->load->view("includes/admin_header_links")?>
</head>

<body class="sticky-header">

<section>
    <!-- sidebar left start-->
     <?php $class=$this->router->fetch_class();
    if($class=='admin' || $class=='users'){$this->load->view("includes/admin_leftmenu");}else if($class=='vendors'){$this->load->view("includes/vendor_leftmenu");}else if($class=='venues'){$this->load->view("includes/venues_leftmenu");}?>
    <!-- sidebar left end-->

    <!-- body content start-->
    <div class="body-content" >

        <!-- header section start-->
        <?php $this->load->view("includes/admin_header")?>
        <!-- header section end-->
        <!-- main Content start ->
        <?php echo $content_for_layout; ?>
            <!-- main Content end ->
            <?php $this->load->view("includes/admin_footer")?>


            <!--<script type="text/javascript">
            
                $(document).ready(function() {
            
                    //countTo
            
                    $('.timer').countTo();
            
                    //owl carousel
            
                    $("#news-feed").owlCarousel({
                        navigation : true,
                        slideSpeed : 300,
                        paginationSpeed : 400,
                        singleItem : true,
                        autoPlay:true
                    });
                });
            
                $(window).on("resize",function(){
                    var owl = $("#news-feed").data("owlCarousel");
                    owl.reinit();
                });
            
            </script>-->
            <?php if($this->router->fetch_method() == 'dashboard'){ ?>
            <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

            <script type="text/javascript">
                google.charts.load("current", {packages: ["corechart"]});
                google.charts.setOnLoadCallback(drawChart);
                function drawChart() {
                    var data = google.visualization.arrayToDataTable([
                        ['List', 'List in Toss'],
                        ['Vendors', <?php echo $vendors->countall; ?>],
                        ['Venues', <?php echo $venues[0]->venuescount; ?>],
                        ['App Users', <?php echo $appusers->countall; ?>],

                    ]);
                    var options = {
                        pieSliceText:'value',
                        tooltip:{text:'value'},
                        pieHole: 0.1,
                    };
                    var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
                    chart.draw(data, options);
                }
            </script>
        <?php } ?>
</body>

<!-- Mirrored from thevectorlab.net/slicklab/ by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 21 Dec 2015 07:02:49 GMT -->
</html>
