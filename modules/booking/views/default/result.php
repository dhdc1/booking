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

<div id="slip" style="width: 650px;height: 365px;background-color: wheat;color: black;padding: 5px;border-style: dotted;">

    <div style="display: flex;flex-direction: row;justify-content: flex-end;text-align: center">
        <div style="flex: 2;font-size: 18px;text-align: left">เอกสารเข้ารับบริการ <u><?= \Yii::$app->params['hospname'] ?></u></div> 
        <div style="flex: 1;font-size: 18px;text-align: right">Visiting Pass</div>
    </div>


    <div style="display: flex;flex-direction: row;justify-content: space-between;">
        <div style="flex: 1;font-size: 18px;text-align: left">จองเมื่อ <?= MyHelper::thaiDateTime($row['d_update']) ?></div> 
        <div style="flex: 1;text-align: right">หมายเลขบริการ <?= $vn ?></div>
    </div>

    <div style="display: flex;flex-direction: row;justify-content: space-between;font-size: 22px;background-color: white">
        <div style="flex: 1">HN : <?= $hn ?></div> <div style="flex: 2"><?= $pt ?></div>
    </div>

    <div style="display: flex;flex-direction: row;justify-content: space-between;font-size: 24px">
        <div style="flex: 1.25">ไปที่:<u><?= $depart ?></u> <i class="glyphicon glyphicon-check"></i></div>
        <div style="flex: 1">

            วัน-เวลาที่จองได้<br><?= MyHelper::thaiDate($row['reserv_date']) ?> เวลา <?= substr($row['reserv_time'], 0, 5) ?> น.

        </div>
    </div>
    <div style="display: flex;flex-direction: row;justify-content: space-between">
        <div style="flex: 1;border-bottom-style:  dotted;border-bottom-width: 1px"></div>
    </div>

    <div style="display: flex;flex-direction: row;justify-content: space-between;font-size: 22 px">
        <div style="flex: 1;display: flex;flex-direction: column;text-align: center; justify-content: center">
            <?php
            $generator = new \Picqer\Barcode\BarcodeGeneratorPNG();
            echo '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($vn, $generator::TYPE_CODE_128)) . '">';
            ?>
        </div>
        <div style="flex: 2">
            <div style="display: flex;flex-direction: column">
                <div style="flex:1;text-align: center">
                    กรุณาแสดงเอกสารนี้ที่หน้าแผนกที่ท่านทำการจองไว้ควรเดินทางไปถึง<br>โรงพยาบาลก่อนเวลานัดอย่างน้อย 45 นาที

                </div>
                <div style="flex:1;text-align: center">
                    <h1>หมายเลข <?= MyHelper::getQueue($vn) ?></h1>
                    <div>แสดงบัตรประชาชนก่อนเข้ารับบริการทุกครั้ง</div>
                    <div>ยกเลิกการจองกรุณาโทร <?= \Yii::$app->params['tel_cancel'] ?></div>
                </div>
            </div>
        </div>
    </div>



</div>
<br>
<div>
    <a href="#" onclick="print()" class="btn btn-primary btn-lg">พิมพ์</a>
    <a href="<?= Url::to(['/site/index']) ?>" class="btn btn-success btn-lg">ตกลง</a>

</div>