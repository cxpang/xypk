<?php
namespace frontend\controllers;


use yii\web\Controller;
use common\models\Room;
use common\models\Traval;
use common\models\Emotion;
use common\models\Star;
use common\models\Compet;
use common\models\Oldbook;
use common\models\Musium;
use common\models\Exam;
class SpellguestController extends Controller
{
    public function actionIndex(){
        $uid=\yii::$app->user->identity->getId();
        $this->layout='xypk';
        $rooms=[];
        $room=new Room();
        $rooms=$room->find()->where(['uid'=>$uid])->orderBy('createtime desc')->asArray()->all();

        $traval=[];
        $traval=Traval::find()->where(['uid'=>$uid])->orderBy('createtime desc')->asArray()->all();



        $emotion=[];
        $emotion=Emotion::find()->where(['uid'=>$uid])->orderBy('createtime desc')->asArray()->all();


        $star=[];
        $star=Star::find()->where(['uid'=>$uid])->orderBy('createtime desc')->asArray()->all();

        $compet=[];
        $compet=Compet::find()->where(['uid'=>$uid])->orderBy('createtime desc')->asArray()->all();

        $Oldbook=[];
        $Oldbook=Oldbook::find()->where(['uid'=>$uid])->orderBy('createtime desc')->asArray()->all();

        $musium=[];
        $musium=Musium::find()->where(['uid'=>$uid])->orderBy('createtime desc')->asArray()->all();

        $Exam=[];
        $Exam=Exam::find()->where(['uid'=>$uid])->orderBy('createtime desc')->asArray()->all();






        return  $this->render('index',
           [
               'rooms'=>$rooms,
               'travals'=>$traval,
               'emotion'=>$emotion,
               'star'=>$star,
               'compet'=>$compet,
               'oldbook'=>$Oldbook,
               'musium'=>$musium,
               'exam'=>$Exam,
           ]);

    }

}