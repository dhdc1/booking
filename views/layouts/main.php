<?php
/* @var $this \yii\web\View */
/* @var $content string */


use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title>SmartQueue Booking</title>
        <?php $this->head() ?>
    </head>
    <body style="background-color:#fef1ec">
        <?php $this->beginBody() ?>

        <div class="wrap">
            <?php
           
            NavBar::begin([
                'brandLabel' => '<i class="glyphicon glyphicon-ok"></i>' . \Yii::$app->params['hospname'],
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-custom navbar-fixed-top',
                ],
                'innerContainerOptions' => ['class' => 'container-fluid'],
            ]);
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => [
                    ['label' => 'หน้าหลัก', 'url' => ['/site/index']],
                    ['label' => 'ช่วยเหลือ', 'url' => ['/site/about']],
                ],
            ]);
            NavBar::end();
             
            ?>

            <div class="container-fluid" style="padding-top: 54px">
                <?=
                Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ])
                ?>
               
                <div style="display: flex;flex-direction: column;text-align: center;align-items: center;border: solid #ccc 1px;padding: 15px;background-color: white;">

                    <?= $content ?>
                </div>

            </div>
        </div>

        <footer class="footer">
            <div class="container-fluid">
                <p class="pull-left">&copy; SmartBooking Version 1.2.0 (2019-05-14)</p>

                <p class="pull-right">Smart Queue System</p>
            </div>
        </footer>

        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
