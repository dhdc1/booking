<?php

namespace app\modules\register\controllers;

use yii\web\Controller;
use app\modules\register\models\CheckCidForm;

/**
 * Default controller for the `register` module
 */
class DefaultController extends Controller {

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex() {
        $model = new CheckCidForm();
        if ($model->load(\Yii::$app->request->post())) {
            $sql = "select count(cid) from patient where cid='$model->cid'";
            $row = (int) \Yii::$app->db->createCommand($sql)->queryScalar();
            if ($row > 0) {
                $resp = 'ท่านมีประวัติที่โรงพยาบาลแห่งนี้อยู่แล้ว<br>Your information already exists.';
                return $this->render('index', [
                            'model' => $model,
                            'resp' => $resp
                ]);
            } else {
                \Yii::$app->session->set('cid', $model->cid);
                return $this->redirect(['patient/regis']);
            }
        }

        return $this->render('index', [
                    'model' => $model
        ]);
    }

}
