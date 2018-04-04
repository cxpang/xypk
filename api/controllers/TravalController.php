<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/4
 * Time: 15:18
 */

namespace api\controllers;
use yii\rest\Controller;
use common\models\Traval;
class TravalController extends Controller
{
    public function actionIndex(){
        $result=Traval::find()->from('traval as a')->leftJoin('x_user as b','a.uid=b.id')
            ->select('a.*,b.username')->orderBy('a.updatetime desc')->asArray()->all();
        return $result;
    }
    public function actionDetail(){
        $travalid=\Yii::$app->request->get('travalid');
        $result=Traval::find()->from('traval as a')->leftJoin('x_user as b','a.uid=b.id')
            ->select('a.*,b.username,b.username,b.email,b.uphone')->where(['a.travalid'=>$travalid])->orderBy('a.updatetime desc')->asArray()->all();
        return $result;
    }
}