<?php

$modules = [];

$modules['portal']=['class' => 'app\modules\portal\Portal'];
$modules['booking']=['class' => 'app\modules\booking\Booking'];
$modules['register']=['class' => 'app\modules\register\Register'];
$modules['check'] = ['class' => 'app\modules\check\Check'];
$modules['logon']=  ['class' => 'app\modules\logon\Logon'];

return $modules;
