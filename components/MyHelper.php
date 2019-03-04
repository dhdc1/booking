<?php

namespace app\components;

use yii\base\Component;

class MyHelper extends Component {

    public static function getDepartName($depcode) {
        $sql = "select booking_tname from kskdepartment where depcode = '$depcode' limit 1";
        return \Yii::$app->db->createCommand($sql)->queryScalar();
    }

    public static function getQueue($vn) {
        $sql = "select reserv_depq from ovst_queue_server_reserv where reserv_vn = '$vn' limit 1";
        return \Yii::$app->db->createCommand($sql)->queryScalar();
    }
    
    public static function getLastVn($cid){
        $sql = "select reserv_vn from ovst_queue_server_reserv where CURDATE()<= reserv_date and reserv_cid = '$cid' order by d_update DESC limit 1";
        return \Yii::$app->db->createCommand($sql)->queryScalar();
    }

}
