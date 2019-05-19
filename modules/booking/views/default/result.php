<?php

use yii\helpers\Html;
use yii\helpers\Url;
use app\components\MyHelper;

$sql = "select * from ovst_queue_server_reserv where reserv_vn = '$vn' limit 1";
$row = \Yii::$app->db->createCommand($sql)->queryOne();
$dep = $row['reserv_dep'];
$hn = $row['reserv_hn'];
$depart = \Yii::$app->db->createCommand("select department from kskdepartment where depcode = '$dep'")->queryScalar();
$sql_pt = "select concat(pname,fname,' ',lname,' ','อายุ  ',TIMESTAMPDIFF(YEAR,birthday, CURDATE()),' ปี') from patient where hn = '$hn' ";
$pt = \Yii::$app->db->createCommand($sql_pt)->queryScalar();
?>

<style>
    @media print {
        body * {
            visibility: hidden;
        }
        #slip, #slip * {
            visibility: visible;
        }
        #slip {
            position: absolute;
            left: 5;
            top: 10;
        }
    }
</style>

<div class="alert alert-danger">
    <span style="font-size: 32px">ขั้นตอนที่ 3/3 [ผลการจอง]</span>

</div>

<div id='slip' style="background-color: wheat;color: black;padding: 5px;border-style: dotted;">


    <h3>เอกสารเข้ารับบริการ</h3>
    <h4><u><?= \Yii::$app->params['hospname'] ?></u></h4>
    <h4>หมายเลขคิว <?= MyHelper::getQueue($vn) ?></h4>     
    <p>(VN : <?= $vn ?>)</p>       
    <h4>HN : <?= $hn ?> </h4>
    <h4><?= $pt ?></h4>
    <h4>ไปที่แผนก: <u><?= $depart ?></u> <i class="glyphicon glyphicon-check"></i></h4>
    <p>วันเข้ารับบริการ</p>
    <h4><?= MyHelper::thaiDate($row['reserv_date']) ?> เวลา <?= substr($row['reserv_time'], 0, 5) ?> น.</h4>
    <hr style="border-top: dotted 1px;" />
    <div>
        <?php
        $generator = new \Picqer\Barcode\BarcodeGeneratorPNG();
        echo '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($vn, $generator::TYPE_CODE_128)) . '">';
        ?>
    </div>
    <hr style="border-top: dotted 1px;" />

    <p>กรุณาแสดงเอกสารนี้ที่หน้าแผนกที่ท่านทำการจองไว้ควรเดินทางไปถึงโรงพยาบาลก่อนเวลานัดอย่างน้อย 45 นาที</p>
    <div>แสดงบัตรประชาชนก่อนเข้ารับบริการทุกครั้ง</div>
    <div>ยกเลิกการจองกรุณาโทร <?= \Yii::$app->params['tel_cancel'] ?></div>
    <div class="pull-right">( จองเมื่อ <?= MyHelper::thaiDateTime($row['d_update']) ?> )</div>

</div>

<br>
<div>
    <a href="#" onclick="print()" class="btn btn-primary btn-lg">พิมพ์</a>
    <a href="<?= Url::to(['/site/index']) ?>" class="btn btn-success btn-lg">ตกลง</a>
</div>