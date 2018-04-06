<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/4
 * Time: 15:22
 */

namespace api\controllers;
use yii\rest\Controller;
use common\models\Musium;
class MusiumController extends Controller
{
    public function actionIndex(){
        $result=Musium::find()->from('musium as a')->leftJoin('x_user as b','a.uid=b.id')
            ->select('a.*,b.username')->orderBy('a.updatetime desc')->asArray()->all();
        $musium=[];
        foreach ($result as $value){
            $value['musiumimage']="120.24.97.50".$value['musiumimage'];
            $musium[]=$value;
        }
        return $musium;
    }
    public function actionDetail(){
        $musiumid=\Yii::$app->request->get('musiumid');
        $result=Musium::find()->from('musium as a')->leftJoin('x_user as b','a.uid=b.id')
            ->select('a.*,b.username,b.username,b.email,b.uphone')->where(['a.musiumid'=>$musiumid])->orderBy('a.updatetime desc')->asArray()->all();
        $musium=[];
        foreach ($result as $value){
            $value['musiumimage']="120.24.97.50".$value['musiumimage'];
            $musium[]=$value;
        }
        return $musium;
    }
}