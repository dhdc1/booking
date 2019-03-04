<?php

namespace app\modules\check\controllers;

use yii\web\Controller;
use app\components\MyHelper;

/**
 * Default controller for the `check` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        if(\Yii::$app->request->isPost){
            $cid = \Yii::$app->request->post('cid');
            $vn = MyHelper::getLastVn($cid);
            if(empty($vn)){
                throw new \yii\web\ForbiddenHttpException('ไม่พบการจองคิวของท่าน');
            }
            
            return $this->redirect(['/booking/default/result','vn'=>$vn]);
        }
        return $this->render('index');
    }
}
