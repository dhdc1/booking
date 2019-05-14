<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use app\components\MyHelper;
?>

<style>

    input[type='radio'] { transform: scale(2); cursor: pointer;}
    th{
        text-align: center
    }

</style>
<div class="alert alert-danger">
    <span style="font-size: 22px">ขั้นตอนที่ 2/3 [เลือกเวลา]</span>
</div>

<div style="margin-bottom: 15px">
    <?php
    $limit_day = \Yii::$app->params['limit_day'];
    $limit_day = "+$limit_day day";
    ?>
    <?php
    ActiveForm::begin([
        'id' => 'search',
        'method' => 'get',
        'action' => Url::to(['bookingtime', 'depcode' => $depcode]),
    ]);
    ?>
    เลือกวันที่ 
    <input autocomplete="off"  name='date_book' type="date" value="<?= $init_date ?>" min='<?= date('Y-m-d', strtotime("+1 day")) ?>' max='<?= date('Y-m-d', strtotime($limit_day)) ?>'/> 
    <button class="btn btn-sm btn-danger"> ตกลง </button>
    <?php ActiveForm::end(); ?>

</div>

<h3>แผนก: <?= MyHelper::getDepartName($depcode); ?>  วันที่จอง <?= $init_date ?></h3>
<?php ActiveForm::begin(); ?>
<div style="font-size: 22px;text-align: center" >
    <div >
        <table border="1">
            <thead>                
                <tr>
                    <th style="width: 100px;">เลือก</th>

                    <th style="width: 200px">เวลา</th>
                    <th style="width: 200px">เปิดจอง</th>
                    <th style="width: 200px">จองแล้ว</th>
                </tr>
            </thead>
            <?php foreach ($raw as $row): ?>
                <tr>
                    <td style="padding: 5px;text-align: center">
                        <input type="radio" name="slot_id" value="<?= $row['online_id'] ?>" <?= $row['online_total'] <= $row['booked'] ? 'disabled' : '' ?> /></td>

                    <td style="padding: 5px"><?= substr($row['online_time'], 0, 5) ?></td>
                    <td style="color: green;font-weight: bold"><?= $row['online_total'] ?></td>
                    <td style="color: green;font-weight: bold"><?= $row['booked'] ?></td>
                </tr>

            <?php endforeach; ?>

        </table>
    </div>

</div>
<div  style="margin-top: 10px"> 
    <div >

        <?php echo Html::hiddenInput('depcode', $depcode) ?>
        <p>เลข 13 หลัก <input name="cid" autocomplete="off" maxlength="13" /></p> 
        <p>ปี พ.ศ.เกิด <input name="byear" type="number"  autocomplete="off"/></p>
        <p><button class="btn btn-lg btn-success">ทำการจอง</button></p>

    </div>
</div>
<?php ActiveForm::end(); ?>

