<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/4
 * Time: 20:31
 */

namespace api\controllers;

use yii\rest\ActiveController;

class UserController extends ActiveController
{
    //public $enableCsrfValidation = false;
    public $modelClass='common\models\Xuser';
    public function actionTest1(){
        $data=array('name'=>'cxpang');
        echo json_encode($data);
    }
}