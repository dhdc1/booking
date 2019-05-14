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

    public static function getLastVn($cid) {
        $sql = "select reserv_vn from ovst_queue_server_reserv where CURDATE()<= reserv_date and reserv_cid = '$cid' order by d_update DESC limit 1";
        return \Yii::$app->db->createCommand($sql)->queryScalar();
    }

    public static function thaiDate($date) {

        $strYear = date("Y", strtotime($date)) + 543;
        $strMonth = date("n", strtotime($date));
        $strDay = date("j", strtotime($date));

        $strMonthCut = Array("", "ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");
        $strMonthThai = $strMonthCut[$strMonth];
        return "$strDay $strMonthThai $strYear";
    }

    public static function thaiDateTime($datetime) {

        $strYear = date("Y", strtotime($datetime)) + 543;
        $strMonth = date("n", strtotime($datetime));
        $strDay = date("j", strtotime($datetime));
        $strHour = date("H", strtotime($datetime));
        $strMinute = date("i", strtotime($datetime));
        $strSeconds = date("s", strtotime($datetime));
        $strMonthCut = Array("", "ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");
        $strMonthThai = $strMonthCut[$strMonth];
        return "$strDay $strMonthThai $strYear, $strHour:$strMinute";
    }

}
