<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/11
 * Time: 20:38
 */

namespace frontend\controllers;
use common\models\Room;
use common\models\Roomcontent;
use yii\web\NotFoundHttpException;
use common\models\UploadForm;
use yii\web\Controller;
use common\models\XUser;
use yii\web\UploadedFile;
use common\models\Emotion;
use common\models\Emotioncomment;
use common\models\Traval;
use common\models\Travalcomment;
use common\models\Star;
use common\models\Starcomment;
use common\models\Compet;
use common\models\Competcomment;
use common\models\Exam;
use common\models\Examcomment;
use common\models\Oldbook;
use common\models\Oldbookcomment;
use common\models\Musium;
use common\models\Musiumcomment;
class ResponseController  extends Controller
{
    public function actionIndex()
    {

        $this->layout='xypk';
        $roomcontent=new Roomcontent();
        $room=new Room();
        $currentid=\Yii::$app->user->getId();
        $rooms=$room->find()->where(['uid'=>$currentid])->asArray()->all();
        //$roomcontent=$roomcontent->find()->where(['roomid'=>18])->asArray()->all();
        $responses=$roomcontent->find()->leftJoin('room','roomcontent.roomid=room.roomid')->leftJoin('x_user','x_user.id=roomcontent.uid')->
            select('room.roomname,roomcontent.*,x_user.username,x_user.upicture')
            ->where(['room.uid'=>$currentid])->orderBy('roomcontent.createtime desc')->limit(1)->asArray()->all();

        $emotionres=Emotion::find()->from('emotion as a')->leftJoin('emotioncomment as b','a.emotionid=b.emotionid')
            ->leftJoin('x_user as c','a.uid=c.id')->select('a.emotionname,b.*,c.username,c.upicture')
            ->where(['a.uid'=>$currentid])->orderBy('b.createtime desc')->limit(1)->asArray()->all();

        $travelcres=Traval::find()->from('traval as a')->leftJoin('travalcomment as b','a.travalid=b.travalid')
            ->leftJoin('x_user as c','a.uid=c.id')->select('a.travalname,b.*,c.username,c.upicture')
            ->where(['a.uid'=>$currentid])->orderBy('b.createtime desc')->limit(1)->asArray()->all();

        $starres=Star::find()->from('star as a')->leftJoin('starcomment as b','a.starid=b.starid')->leftJoin('x_user as c','a.uid=c.id')
            ->select('a.starname,b.*,c.username,c.upicture')->where(['a.uid'=>$currentid])->orderBy('b.createtime desc')->limit(1)
            ->asArray()->all();
        $competres=Compet::find()->from('compet as a')->leftJoin('competcomment as b','a.competid=b.competid')
            ->leftJoin('x_user as c','a.uid=c.id')->select('a.competname,b.*,c.username,c.upicture')
            ->where(['a.uid'=>$currentid])->orderBy('b.createtime desc')->limit(1)->asArray()->all();

        $examres=Exam::find()->from('exam as a')->leftJoin('examcomment as b','a.examid=b.examid')->leftJoin('x_user as c','a.uid=c.id')
            ->select('a.examname,b.*,c.username,c.upicture')->where(['a.uid'=>$currentid])->limit(1)->asArray()->all();

        $oldbookres=Oldbook::find()->from('oldbook as a')->leftJoin('oldbookcomment as b','a.oldbookid=b.oldbookid')
            ->leftJoin('x_user as c','a.uid=c.id')->select('a.oldbookname,b.*,c.username,c.upicture')
            ->where(['a.uid'=>$currentid])->limit(1)->asArray()->all();

        $musiumres=Musium::find()->from('musium as a')->leftJoin('musiumcomment as b','a.musiumid=b.musiumid')
            ->leftJoin('x_user as c','a.uid=c.id')->select('a.musiumname,b.*,c.username,c.upicture')->limit(1)->asArray()->all();

        return $this->render('index',[
            'roomresponse'=>$responses,
            'emotionresponse'=>$emotionres,
            'travelresponse'=>$travelcres,
            'starresponse'=>$starres,
            'competresponse'=>$competres,
            'examresponse'=>$examres,
            'oldbookresponse'=>$oldbookres,
            'musiumresponse'=>$musiumres,
        ]);
    }
}
