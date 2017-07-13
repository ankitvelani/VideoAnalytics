
<?php

if(isset($_POST['submit']))
{
    $UserDate=$_POST['date'];
    $UserHour=$_POST['hours'];
    include "GraphData.php";

}
?>


<html>
<head>
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
                width: 1200,
                chart: {
                    title: 'Head Count By Hours',
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
                width: 1200,
                chart: {
                    title: 'Head Count By Minute',
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
<body>


<form action="" method="post" style="padding-left: 300px;padding-top: 50px;">
    <b><label>Select the Date</label></b>
    <input type="date" name="date" value=<?=isset($UserDate)?$UserDate:"2017-07-07"?>>
    <b><label>Select the Hours</label></b>
   <select name="hours">
       <?php
       for ($i=0;$i<24;$i++)
       {
           ?>
           <option value="<?=$i?>" <?=$i == $UserHour ? ' selected="selected"' : '';?> ><?=$i?></option>
        <?php
       }
       ?>
   </select>

    <input type="submit" name="submit">
</form >

<div id="dual_x_div" style="width: 450px; height: 500px;"></div>
<div id="dual_x_div1" style="width: 450px; height: 500px;"></div>


</body>
</html>
