<?php

namespace app\components;


use yii\base\Component;

class DbHelper extends Component {
    public static function queryAll($db,$sql){
        $raw = \Yii::$app->$db->createCommand($sql)->queryAll();
        return $raw;
    }
}
