<?php


$m=new MongoClient("mongodb://localhost:27017");
$db=$m->VideoAnalytics;
$collection=$db->PersonCount;





$ops=array(

    array(
        '$project'=>array(
            "_id"=>0,
            'PersonCount'=>1,
            'CameraID'=>1,
            'dates'=>array('$dateToString'=>array('format'=>'%Y-%m-%d',"date"=>'$date')),

        )
    ),
    array(
        '$match'=>array(
            'dates'=>array('$gte'=>$UserDate1,'$lte'=>$UserDate2),

        )
    ),
    array(
        '$group'=>array(
            '_id'=>array(

                'dates'=>'$dates'
            ),
            'Total'=>array('$max'=>'$PersonCount')

        )
    ),
    array(
        '$sort'=>array(
            '_id'=>1
        )
    )
);

$c=$collection->aggregate($ops);

$str0="";
$DateRange=new ArrayObject();
foreach ($c as $document)
{
    foreach ($document as $d)
    {

        $str0.="['".$d['_id']['dates']."',".$d['Total']."],";
        $DateRange->append($d['_id']['dates']);

    }

}

$str0=substr($str0,0,strlen($str0)-1);







$ops=array(

    array(
        '$project'=>array(
            "_id"=>0,
            'PersonCount'=>1,
            'CameraID'=>1,
            'dates'=>array('$dateToString'=>array('format'=>'%Y-%m-%d',"date"=>'$date')),
            'hours'=>array('$dateToString'=>array('format'=>'%H',"date"=>'$date'))
        )
    ),

    array(
        '$match'=>array(
            'dates'=>array('$gte'=>$UserDate1,'$lte'=>$UserDate2),
            'hours'=>array('$gte'=>sprintf("%02d", $UserHour1),'$lte'=>sprintf("%02d", $UserHour2))

        )
    ),

    array(
        '$group'=>array(
            '_id'=>array(

                'hours'=>'$hours',
                'CameraID'=>'$CameraID',
            ),
            'Total'=>array('$max'=>'$PersonCount')

        )
    ),
    array(
        '$sort'=>array(
            '_id'=>1
        )
    )
);

$c=$collection->aggregate($ops);

$str="";
foreach ($c as $document)
{
    foreach ($document as $d)
    {
        $str.="['".$d['_id']['hours']."',".$d['Total']."],";


    }

}

$str= substr($str,0,strlen($str)-1);



$ops=array(

    array(
        '$project'=>array(
            "_id"=>0,
            'PersonCount'=>1,
            'CameraID'=>1,
            'dates'=>array('$dateToString'=>array('format'=>'%Y-%m-%d',"date"=>'$date')),
            'hours'=>array('$dateToString'=>array('format'=>'%H',"date"=>'$date')),
            'minute'=>array('$dateToString'=>array('format'=>'%M',"date"=>'$date'))
        )
    ),
    array(
        '$match'=>array(
            'dates'=>array('$gte'=>$UserDate1,'$lte'=>$UserDate2),
            'hours'=>array('$gte'=>sprintf("%02d", $UserHour1),'$lte'=>sprintf("%02d", $UserHour2))

        )
    ),
    array(
        '$group'=>array(
            '_id'=>array(
                'CameraID'=>'$CameraID',
                'minute'=>'$minute'
            ),
            'Total'=>array('$max'=>'$PersonCount')

        )
    ),
    array(
        '$sort'=>array(
            '_id'=>1
        )
    )
);

$c=$collection->aggregate($ops);

$str2="";

foreach ($c as $document)
{
    foreach ($document as $d)
    {

        $str2.="[".$d['_id']['minute'].",".$d['Total']."],";


    }

}

$str2=substr($str2,0,strlen($str2)-1);



?>