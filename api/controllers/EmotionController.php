<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/4
 * Time: 15:22
 */

namespace api\controllers;
use yii\rest\Controller;
use common\models\Emotion;
class EmotionController extends Controller
{
    public function actionIndex(){
        $result=Emotion::find()->from('emotion as a')->leftJoin('x_user as b','a.uid=b.id')
            ->select('a.*,b.username')->orderBy('a.updatetime desc')->asArray()->all();
        $emotion=[];
        foreach ($result as $value){
            $value['emotionimage']="120.24.97.50".$value['emotionimage'];
            $emotion[]=$value;
        }
        return $emotion;
    }
    public function actionDetail(){
        $emotionid=\Yii::$app->request->get('emotionid');
        $result=Emotion::find()->from('emotion as a')->leftJoin('x_user as b','a.uid=b.id')
            ->select('a.*,b.username,b.username,b.email,b.uphone')->where(['a.emotionid'=>$emotionid])->orderBy('a.updatetime desc')->asArray()->all();
        $emotion=[];
        foreach ($result as $value){
            $value['emotionimage']="120.24.97.50".$value['emotionimage'];
            $emotion[]=$value;
        }
        return $emotion;
    }
}