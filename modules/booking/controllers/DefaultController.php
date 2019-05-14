<?php

namespace app\modules\booking\controllers;

use yii\web\Controller;
use Yii;
use yii\httpclient\Client;

/**
 * Default controller for the `booking` module
 */
class DefaultController extends Controller {

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex() {
        return $this->render('index');
    }

    public function actionBookingtime($depcode = null, $date_book = null) {

        if (\Yii::$app->request->isPost) {
            //print_r(\Yii::$app->request->post());
            $cid = \Yii::$app->request->post('cid');



            $byear = \Yii::$app->request->post('byear');
            $byear = (int)$byear-543;
            $slot_id = \Yii::$app->request->post('slot_id');
            if (empty($slot_id)) {
                throw new \yii\web\ForbiddenHttpException('กรุณาเลือกเวลาจอง');
                return;
            }
            $sql = " select count(cid) from patient where cid = '$cid' and YEAR(birthday)  = '$byear' ";
            $count = \Yii::$app->db->createCommand($sql)->queryScalar();
            if ($count > 0) {

                $sql = "select count(reserv_cid) from ovst_queue_server_reserv where reserv_cid = '$cid' and reserv_date >= CURDATE() ";
                $row = \Yii::$app->db->createCommand($sql)->queryScalar();
                if ($row * 1 > 0) {
                    throw new \yii\web\ForbiddenHttpException("ท่านเคยจองคิวไว้แล้ว และยังไม่ได้เข้ารับบริการตามคิวที่จองไว้ หากต้องการเปลี่ยนแปลงหรือยกเลิกการจอง \r\nกรุณาติดต่อ  ".\Yii::$app->params['tel_cancel']);
                    return;
                }

                $sql_slot = "select online_date,online_time from ovst_queue_server_online where online_id ='$slot_id'";
                $row = \Yii::$app->db->createCommand($sql_slot)->queryOne();

                $gateway = \Yii::$app->params['queue_gateway'];
                $client = new Client(['baseUrl' => $gateway]);
                $date = date_create($row['online_date']);
                $date = date_format($date, "Ymd");
                $time = date_create($row['online_time']);
                $time = date_format($time, 'His');
                $data = [
                    'cid' => $cid,
                    'depcode' => $depcode,
                    'date_book' => $date,
                    'time_book' => $time,
                    'slot_id' => $slot_id
                ];
                //print_r($data);
                try {
                    $response = $client->createRequest()
                                    ->setMethod('POST')
                                    ->setData($data)->send();
                } catch (yii\httpclient\Exception $ex) {
                    //throw new \yii\web\ForbiddenHttpException($ex);
                    print_r($ex);
                }

                if ($response->isOk) {
                    $q = $response->data[0]['queue'];
                    $vn = $response->data[0]['vn'];
                    return $this->redirect(['result', 'vn' => $vn]);
                    //echo "ok";
                    //print_r($response->data[0]['queue']);
                } else {
                    //throw new \yii\web\ForbiddenHttpException($response->data);
                    print_r($response->data);
                }
            } else {
                //echo "";
                throw new \yii\web\ForbiddenHttpException('เลขบัตร หรือ ปีพ.ศ.เกิด ไม่ถูกต้อง');
                //echo $sql;
            }
        } else {
            $init_date = empty($date_book) ? date('Y-m-d', strtotime("+1 day")) : $date_book;
            $sql = " SELECT t.online_id,t.online_date,t.online_time,t.online_total
,( SELECT count(q.online_id) from ovst_queue_server_reserv q  WHERE q.online_id = t.online_id) booked
from ovst_queue_server_online t 
WHERE t.online_active = 'y'  
AND t.online_dep = '$depcode' AND  t.online_date = '$init_date'
 ";

            $raw = \Yii::$app->db->createCommand($sql)->queryAll();
            return $this->render('bookingtime', [
                        'depcode' => $depcode,
                        'init_date' => $init_date,
                        'raw' => $raw
            ]);
        }
    }

    public function actionResult($vn = null) {
        return $this->render('result', [
                    'vn' => $vn
        ]);
    }

}
