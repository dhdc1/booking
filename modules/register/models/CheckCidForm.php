<?php

namespace app\modules\register\models;

use Yii;
use yii\base\Model;

class CheckCidForm extends Model {

    public $cid;

    public function rules() {
        return [
            // username and password are both required
            [['cid'], 'required', 'message' => ''],
            [['cid'], 'string', 'length' => 13,'message' => '']

                // rememberMe must be a boolean value
        ];
    }

}
