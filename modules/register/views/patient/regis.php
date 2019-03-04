<div class="alert alert-danger">
    <span style="font-size: 32px">ขั้นตอนที่ 2/3 [กรอกรายละเอียด]</span>
</div>
<?php

use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
?>
<div class="container">
    <?php
    $form = ActiveForm::begin();
    ?>
    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'cid')->textInput(['disabled' => 'disabled'])->label('เลข13หลัก/passport') ?>
        </div>
        <div class="col-md-3">
            <?php
            $sql = "select name from pname";
            $raw = \Yii::$app->db->createCommand($sql)->queryAll();
            $items = ArrayHelper::map($raw, 'name', 'name');
            ?>
            <?=
            $form->field($model, 'pname')->widget(Select2::classname(), [
                'data' => $items,
                'language' => 'th',
                'options' => ['placeholder' => '...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ])->label('คำนำหน้า/prename');
            ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'fname')->textInput(['autocomplete' => 'off'])->label('ชื่อ/name') ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'lname')->textInput(['autocomplete' => 'off'])->label('นามสกุล/lastname') ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'sex')->dropDownList(['1' => 'ชาย', '2' => 'หญิง'])->label('เพศ/sex') ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'birthday')->textInput(['placeholder' => '28/02/1980'])->label('วดป.เกิด/birthdate') ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'addrpart')->label('บ้านเลขที่/Address No') ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'moopart')->label('หมู่ที่/Village No') ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'chwpart')->label('จังหวัด/Province') ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'amppart')->label('อำเภอ/District') ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'tmbpart')->label('ตำบล/Subdistrict') ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'mobile_phone_number')->label('เบอร์โทร/phone number') ?>
        </div>

    </div>
    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'tmbpart')->label('อาชีพ/Occupation') ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'tmbpart')->label('สัญชาติ/Nation') ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'tmbpart')->label('เชื้อชาติ/Race') ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'tmbpart')->label('ศาสนา/Religion') ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'tmbpart')->label('สถานภาพ/Married Status') ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'tmbpart')->label('หมู่เลือด/BloodGroup') ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'tmbpart')->label('อิเมลย์/Email') ?>
        </div>
        <div class="col-md-3"></div>
        
    </div>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-3"></div>
        <div class="col-md-3"></div>
        <div class="col-md-3"></div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div  style="text-align: center"><button> ตกลง </button> <button> ยกเลิก </button></div>
        </div>
    </div>

    <?php
    ActiveForm::end();
    ?>
</div>