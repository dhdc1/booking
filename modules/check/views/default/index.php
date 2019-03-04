<?php

use app\components\MyHelper;
use yii\widgets\ActiveForm;
?>

<style>
    
    input{
        height: 50px;
        width: 250px;       
    }
    button {
        height: 50px;
        width: 80px;
    }
    
</style>

<div style="margin-top: 20px;text-align: center">
    <?php
    ActiveForm::begin();
    ?>
    <input id="cid" name="cid" autocomplete="off" placeholder="เลข 13 หลัก" maxlength="13" />
    <button>ค้นหา</button>
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