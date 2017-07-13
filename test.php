<?php
$m=new MongoClient("mongodb://localhost:27017");
$db=$m->VideoAnalytics;
$collection=$db->PersonCount;
/*
$ops=array(

    array(
        '$group'=>array(
            "_id"=>array(
                "FileName"=>'$FileName',
            ),
            "Total"=>array('$sum'=>'$PersonCount')
        )
    )
);*/

$ops=array(

    array(
        '$project'=>array(
            "_id"=>0,
            'dates'=>array('$dateToString'=>array('format'=>'%Y-%m-%d',"date"=>'$date')),
            'year'=>array('$dateToString'=>array('format'=>'%Y',"date"=>'$date')),
            'hour'=>array('$dateToString'=>array('format'=>'%H',"date"=>'$date')),
            'minute'=>array('$dateToString'=>array('format'=>'%M',"date"=>'$date'))
        )
    ),
    array(
        '$match'=>array(
            "dates"=>"2017-07-05"
        )
    ),
    array(
        '$group'=>array(
            '_id'=>array(
                'minute'=>"$minute",

            ),
            'PersonCount'=>array('$sum'=>"$PersonCount")

        )
    )
);

$c=$collection->aggregate($ops);
echo json_encode($c);


?>