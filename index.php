<?php

if(isset($_POST['submit'])) {
    $time = strtotime($_POST['date1']);
    $UserOriginalDate1=$_POST['date1'];
    $UserDate1 = $newformat = date('Y-m-d', $time);
    $UserHour1 = $newformat = date('H', $time);


    $time2 = strtotime($_POST['date2']);
    $UserOriginalDate2=$_POST['date2'];
    $UserDate2 = $newformat = date('Y-m-d', $time2);
    $UserHour2 = $newformat = date('H', $time2);

    include "GraphData.php";


}
?>



<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> Dashboard</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

     <link rel="stylesheet" type="text/css" media="screen" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css"/>


    <!-- Font Awesome -->
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

    <!-- Theme style -->
    <link rel="stylesheet" href="css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="css/_all-skins.min.css">

    <link href="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/build/css/bootstrap-datetimepicker.css"
          rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>-->

    <script type="text/javascript" src="//code.jquery.com/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
    <script src="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/src/js/bootstrap-datetimepicker.js"></script>


    <!-- Google Font -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">


    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>


    <script type="text/javascript">
        google.charts.load('current', {'packages':['bar']});
        google.charts.setOnLoadCallback(drawStuff);

        function drawStuff() {
            var data = new google.visualization.arrayToDataTable([
                ['Hours', 'Head Count'],
                <?=$str;?>

            ]);

            var options = {
                height:350,
                chart: {
                    title: '',
                    subtitle: ''
                },
                legend: {position: 'none'},
                bars: 'verticle', // Required for Material Bar Charts.
                series: {
                    0: { axis: 'distance' }, // Bind series 0 to an axis named 'distance'.
                    1: { axis: 'brightness' } // Bind series 1 to an axis named 'brightness'.
                },
                axes: {
                    x: {
                        distance: {label: 'parsecs'}, // Bottom x-axis.
                        brightness: {side: 'top', label: 'apparent magnitude'} // Top x-axis.
                    }
                }
            };

            var chart = new google.charts.Bar(document.getElementById('dual_x_div'));
            chart.draw(data, options);
        };
    </script>



    <script type="text/javascript">
        google.charts.load('current', {'packages':['bar']});
        google.charts.setOnLoadCallback(drawStuff);

        function drawStuff() {
            var data = new google.visualization.arrayToDataTable([
                ['Minute', 'Head Count'],
                <?=$str2;?>
            ]);

            var options = {
                height:350,
                chart: {
                    title: '',
                    subtitle: ''
                },
                legend: {position: 'none'},
                bars: 'verticle', // Required for Material Bar Charts.
                series: {
                    0: { axis: 'distance' }, // Bind series 0 to an axis named 'distance'.
                    1: { axis: 'brightness' } // Bind series 1 to an axis named 'brightness'.
                },
                axes: {
                    x: {
                        distance: {label: 'parsecs'}, // Bottom x-axis.
                        brightness: {side: 'top', label: 'apparent magnitude'} // Top x-axis.
                    }
                }
            };

            var chart = new google.charts.Bar(document.getElementById('dual_x_div1'));
            chart.draw(data, options);
        };
    </script>




</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    <header class="main-header">
        <!-- Logo -->
        <a href="index2.html" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>A</b>LT</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>Admin</b></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
                            <span class="hidden-xs">Alexander Pierce</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                                <p>
                                    Alexander Pierce - Web Developer
                                    <small>Member since Nov. 2012</small>
                                </p>
                            </li>

                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="#" class="btn btn-default btn-flat">Profile</a>
                                </div>
                                <div class="pull-right">
                                    <a href="#" class="btn btn-default btn-flat">Sign out</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <!-- Control Sidebar Toggle Button -->
                    <li>
                        <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Dashboard
                <small>Control panel</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Dashboard</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            <div class="row">
                <div class="col-sm-12">

                    <!-- TABLE: LATEST ORDERS -->
                    <div class="box box-info">
                        <div class="box-header">
                            <h3 class="box-title">Date </h3>

                        </div>
                        <!-- /.box-header -->
                        <div class="box-body text-center">


                            <form class="form-inline" method="post" action="">


                                <div class="form-group">
                                    <div class='input-group date' id='datetimepicker1'>
                                        <input type='text' class="form-control" name="date1" value="<?=$UserOriginalDate1;?>" required />
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class='input-group date' id='datetimepicker2'  >
                                        <input type='text' name="date2" class="form-control"  value="<?=$UserOriginalDate2;?>" required/>
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                    </div>
                                </div>

                                <button type="submit" name="submit" class="btn btn-primary">Submit</button>

                            </form>

                            <br><br>
                        </div>

                    </div>

                </div>

                <div class="col-sm-12">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">Head Count By Hours</h3>


                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                                <div id="dual_x_div" class="img img-responsive"></div>

                        </div>
                    </div>

                </div>
                <div class="col-sm-12">

                        <div class="box box-info">
                            <div class="box-header with-border">
                                <h3 class="box-title">Head Count By Minute</h3>


                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">

                    <div id="dual_x_div1"  class="img img-responsive"></div>
                            </div>
                        </div>
                </div>

            </div>
            <!-- /.row (main row) -->

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b> 2.4.0
        </div>
        <strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
        reserved.
    </footer>

</div>
<!-- ./wrapper -->
<script type="text/javascript">
    $(function () {
        $('#datetimepicker1').datetimepicker();
    });
</script>
<script type="text/javascript">
    $(function () {
        $('#datetimepicker2').datetimepicker();
    });
</script>

</body>
</html>

