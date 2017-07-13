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
            'PersonCount'=>1,
            'CameraID'=>1,
            'dates'=>array('$dateToString'=>array('format'=>'%Y-%m-%d',"date"=>'$date')),
            'hours'=>array('$dateToString'=>array('format'=>'%H',"date"=>'$date'))
        )
    ),

    array(
        '$match'=>array(
            'dates'=>array('$gte'=>$UserDate1,'$lte'=>$UserDate2)
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



$ops=array(
    array(
        '$group'=>array(
            '_id'=>array(
                'dates'=>array('$dateToString'=>array('format'=>'%Y-%m-%d',"date"=>'$date')),
                'hours'=>array('$dateToString'=>array('format'=>'%H',"date"=>'$date')),
                'minute'=>array('$dateToString'=>array('format'=>'%M',"date"=>'$date')),
                'second'=>array('$dateToString'=>array('format'=>'%S',"date"=>'$date'))
            ),
            'PersonCount'=>array('$sum'=>'$PersonCount')
        )
    ),
    array(
        '$match'=>array(
            '_id.dates'=>$UserDate,
            '_id.hours'=>sprintf("%02d", $UserHour),
             'PersonCount'=>array('$gt'=>1)
        )
    ),
    array(
        '$project'=>array(
            '_id.minute'=>1,
            '_id.hours'=>1,
            '_id.second'=>1,
            '_id.dates'=>1,
             'PersonCount'=>array('$divide'=>array('$PersonCount','$PersonCount'))


                //array('$divide'=>array('$PersonCount',$PersonCount))
            //{ $cond: [ { $eq: [ "$PersonCount", 0 ] }, 0, {"$divide":["$PersonCount", "$PersonCount"]} ] }


        )
    ),
    array(
        '$sort'=>array(
            '_id.dates'=>1,
            '_id.hours'=>1,
            '_id.minute'=>1,
            '_id.second'=>1,
            'PersonCount'=>1
        )
    )
);


$c=$collection->aggregate($ops);
$str3="";

foreach ($c as $document)
{
    foreach ($document as $d)
    {

        $str3.="[".$d['_id']['dates'].",
                ".$d['_id']['hours'].",
                ".$d['_id']['minutes']."
                ".$d['_id']['second'].",
                ".$d['PersonCount']."]";


    }

}

$str3=substr($str3,0,strlen($str3)-1);

?>