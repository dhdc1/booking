<?php

use yii\helpers\Url;

$sql = " SELECT  t.online_dep depcode,k.booking_tname depname,k.booking_ename ename from ovst_queue_server_online t 
LEFT JOIN kskdepartment k ON k.depcode = t.online_dep
WHERE t.online_active = 'y'   and t.online_date > CURDATE() GROUP BY t.online_dep  ";

$raw = \Yii::$app->db->createCommand($sql)->queryAll();
?>
<style>

    .box-x {        
        width: 280px;
        height: 130px;
        text-align: center;        
        cursor: pointer;
        margin: 15px;

    }

</style>
<div class="alert alert-danger">
    <span style="font-size: 22px">ขั้นตอนที่ 1/3 [เลือกบริการ]</span>
</div>
<div class="row">

    <?php foreach ($raw as $row): ?>
        <div class="box-x col-md-2" style="  background-color: #db4865;">
            <a href="<?= Url::to(['bookingtime', 'depcode' => $row['depcode']]) ?>" >
                <span style="font-size: 28px;color: white"><?= $row['depname'] ?></span><br>
                 <span style="font-size: 28px;color: white"><?= $row['ename'] ?></span><br>
            </a>
        </div>

    <?php endforeach; ?>


</div>

<?php
$js = <<<JS
    $('.box-x').click(function(){
       //window.location = 'index.php?r=booking/default/bookingtime';
     });   
        
JS;
$this->registerJs($js);



