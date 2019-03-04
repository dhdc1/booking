<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\httpclient\Client;

class TestController extends Controller {

    public function actionIndex() {

        if (\Yii::$app->request->isPost) {
            $client = \Yii::$app->checkSit;
            $cid = \Yii::$app->request->post('cid');
            $args = [
                'user_person_id' => "3650300161017",
                'smctoken' => "4c785k89415q6r5p",
                'person_id' => $cid
            ];
            $data = $client->searchCurrentByPID($args);
            return $this->render('index', [
                        'data' => $data,
                        'cid' => $cid
            ]);
        }
        return $this->render('index', [
                    'cid' => '',
        ]);
    }

    public function actionPost($cid=null) {
        $gateway = \Yii::$app->params['queue_gateway'];
        $client = new Client(['baseUrl' => $gateway]);
        try {
            $response = $client->createRequest()
                    ->setMethod('POST')
                    ->setData([
                        'cid' => $cid,
                        'depcode' => '010',
                        'date_book' => '20190301',
                        'time_book' => '1100',
                        'slot_id' => 2
                    ])
                    ->send();
        } catch (yii\httpclient\Exception $ex) {
            echo "ไม่สามารถติดต่อ QueueService";
            return;
        }

        if ($response->isOk) {
            echo "ok";
            print_r($response->data[0]['queue']);
        } else {
            echo "ไม่สามารถจองได้";
        }
    }

}
