
<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\widgets\Pjax;
?>
<div class="alert alert-danger">
    <span style="font-size: 32px">ขั้นตอนที่ 1/3 [ตรวจสอบข้อมูล]</span>
</div>
<div style="display:flex;flex-direction: column;align-items: center;">
    <?php
    Pjax::begin();
    ?>
    <?php
    $form = ActiveForm::begin([
                'id' => 'my-form',
                'options' => ['data-pjax' => true]
    ]);
    ?>
    <div class="box-x" >เลขบัตรประชาชน</div>
    <div style="font-size: 22px;text-align: center">Passport ID </div>

    <div >
        <?= $form->field($model, 'cid')->textInput(['class' => 'box-x','maxlength'=>13 ,'autocomplete' => 'off'])->label(FALSE) ?>
    </div>
    <?php
    if (!empty($resp)):
        ?>
        <div class="alert alert-danger" style="text-align: center"><h3><?= $resp ?></h3></div>

        <?php
    endif;
    ?>
    <div class="box-x" ><button id='confirm' type="submit" style="width: 400px" >ตรวจสอบ/Check</button></div>
    <div class="box-x" ><button id='cancel' type="button"  style="width: 400px">ยกเลิก/Cancel</button></div>
    <?php
    ActiveForm::end();
    Pjax::end();
    ?>

</div>
<?php
$this->registerCss($this->render('style.css'));
$js = <<<JS
   $('#checkcidform-cid').focus();
   $('#checkcidform-cid').select();
   $(document).on('pjax:success', function() {
       $('#checkcidform-cid').focus(); 
       $('#checkcidform-cid').select(); 
       $('#cancel').click(function(){
           window.location = 'index.php?r=site/index';
       });
   });
        
   $('#cancel').click(function(){
      window.location = 'index.php?r=site/index';
   });   
        
     
  
JS;
$this->registerJs($js);
