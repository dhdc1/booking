<?php

namespace app\modules\register\controllers;

use yii\web\Controller;
use app\modules\register\models\PatientWiatApprove;

class PatientController extends Controller {

    public function actionRegis() {
        $model = new PatientWiatApprove();
        $model->cid = \Yii::$app->session->get('cid');
        if ($model->load(\Yii::$app->request->post())) {
            return $this->redirect(['confirm']);
        }
        return $this->render('regis', [
                    'model' => $model
        ]);
    }

    public function actionConfirm() {
        $cid = \Yii::$app->session->get('cid');
        $model = PatientWiatApprove::find()->where(['cid' => $cid])->one();
        return $this->render('confirm', [
                    'model' => $model
        ]);
    }

}
