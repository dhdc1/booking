<?php

namespace app\modules\logon\controllers;

use yii\web\Controller;
use yii\httpclient\Client;

/**
 * Default controller for the `Logon` module
 */
class DefaultController extends Controller {

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex() {
        if (\Yii::$app->request->isPost) {

            $gateway = \Yii::$app->params['logon_gateway'];
            $client = new Client(['baseUrl' => $gateway]);

            $data = [
                'username' => \Yii::$app->request->post('user'),
                'password' => \Yii::$app->request->post('pass'),
            ];

            try {
                $response = $client->createRequest()
                                ->setMethod('POST')
                                ->setData($data)->send();
            } catch (yii\httpclient\Exception $ex) {

                print_r($ex);
            }

            if ($response->isOk) {
                return $this->render('index', [
                            'response' => $response->data
                ]);
            }
        }
        return $this->render('index');
    }

}
