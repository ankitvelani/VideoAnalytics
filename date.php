<?php


if(isset($_POST['submit'])) {
    $time = strtotime($_POST['date1']);
    $UserOriginalDate=$_POST['date1'];
    $UserDate1 = $newformat = date('Y-m-d', $time);
    $UserHour1 = $newformat = date('H', $time);


    $time2 = strtotime($_POST['date2']);
    $UserOriginalDate2=$_POST['date2'];
    $UserDate2 = $newformat = date('Y-m-d', $time2);
    $UserHour2 = $newformat = date('H', $time2);


}
?>