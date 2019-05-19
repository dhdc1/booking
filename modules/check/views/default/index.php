<?php

use app\components\MyHelper;
use yii\widgets\ActiveForm;
?>

<style>

    .input-chk {
        height: 50px;
        width: 250px; 
        font-size:24px;
        text-align: center
    }
    .btn-chk {
        height: 50px;
        width: 80px;
    }

</style>

<div style="margin-top: 20px;text-align: center">
    <?php
    ActiveForm::begin();
    ?>
    <p><input id="cid" name="cid" autocomplete="off" placeholder="เลข 13 หลัก" maxlength="13" class="input-chk" /></p>
    <p><button class="btn-chk">ค้นหา</button></p>
    <?php
    ActiveForm::end();
    ?>
</div>
<?php
$js = <<<JS
  $('#cid').select();
JS;

$this->registerJs($js);
?>