<?php

use yii\widgets\ActiveForm;
?>

<?php ActiveForm::begin(); ?>

<input name="user" />
<input name="pass" />
<button>ลงชื่อเข้าใช้</button>

<?php ActiveForm::end(); ?>

<?php
if(!empty($response)){
    print_r($response);
}