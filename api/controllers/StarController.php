<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/4
 * Time: 15:22
 */

namespace api\controllers;
use yii\rest\Controller;
use common\models\Star;
class StarController extends Controller
{
    public function actionIndex(){
        $result=Star::find()->from('star as a')->leftJoin('x_user as b','a.uid=b.id')
            ->select('a.*,b.username')->orderBy('a.updatetime desc')->asArray()->all();
        return $result;
    }
    public function actionDetail(){
        $starid=\Yii::$app->request->get('starid');
        $result=Star::find()->from('star as a')->leftJoin('x_user as b','a.uid=b.id')
            ->select('a.*,b.username,b.username,b.email,b.uphone')->where(['a.starid'=>$starid])->orderBy('a.updatetime desc')->asArray()->all();
        return $result;
    }
}