<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/4
 * Time: 15:22
 */

namespace api\controllers;
use yii\rest\Controller;
use common\models\Compet;
class CompetController extends Controller
{
    public function actionIndex(){
        $result=Compet::find()->from('compet as a')->leftJoin('x_user as b','a.uid=b.id')
            ->select('a.*,b.username')->orderBy('a.updatetime desc')->asArray()->all();
        $compet=[];
        foreach ($result as $value){
            $value['competimage']="120.24.97.50".$value['competimage'];
            $compet[]=$value;
        }
        return $compet;
    }
    public function actionDetail(){
        $competid=\Yii::$app->request->get('competid');
        $result=Compet::find()->from('compet as a')->leftJoin('x_user as b','a.uid=b.id')
            ->select('a.*,b.username,b.username,b.email,b.uphone')->where(['a.competid'=>$competid])->orderBy('a.updatetime desc')->asArray()->all();
        $compet=[];
        foreach ($result as $value){
            $value['competimage']="120.24.97.50".$value['competimage'];
            $compet[]=$value;
        }
        return $compet;
    }
}