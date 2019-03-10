<?php
$gateway_url = "http://localhost:8001";
return [
    'adminEmail' => '',
    'hospcode'=>'00000',
    'hospname'=>'โรงพยาบาลแห่งหนึ่ง',
    'queue_gateway'=>"$gateway_url/queuevisit",
    'logon_gateway'=>"$gateway_url/checkuser",
    'limit_day'=>15,// จองล่วงหน้าได้กี่วัน
    'tel_cancel'=>'055252052 ต่อ 999'
];
