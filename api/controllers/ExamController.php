<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/4
 * Time: 15:22
 */

namespace api\controllers;
use yii\rest\Controller;
use common\models\Exam;
class ExamController extends Controller
{
    public function actionIndex(){
        $result=Exam::find()->from('exam as a')->leftJoin('x_user as b','a.uid=b.id')
            ->select('a.*,b.username')->orderBy('a.updatetime desc')->asArray()->all();
        $exam=[];
        foreach ($result as $value){
            $value['examimage']="120.24.97.50".$value['examimage'];
            $exam[]=$value;
        }
        return $exam;
    }
    public function actionDetail(){
        $examid=\Yii::$app->request->get('examid');
        $result=Exam::find()->from('exam as a')->leftJoin('x_user as b','a.uid=b.id')
            ->select('a.*,b.username,b.username,b.email,b.uphone')->where(['a.examid'=>$examid])->orderBy('a.updatetime desc')->asArray()->all();
        $exam=[];
        foreach ($result as $value){
            $value['examimage']="120.24.97.50".$value['examimage'];
            $exam[]=$value;
        }
        return $exam;
    }
}