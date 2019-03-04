<?php

use yii\widgets\ActiveForm;

$f = ActiveForm::begin();
?>

<input type="text" name="cid" id="cid" value="<?= $cid; ?>"/>
<button>OK</button>
<?php
ActiveForm::end();

echo "<pre>";
if (!empty($data->return)) {
    print_r($data->return);
    //echo "<hr/>";
    //$data = json_decode(json_encode($data->return),TRUE);
    
    //print_r($data);
}

echo "<pre>";

