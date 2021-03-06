<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/1
 * Time: 21:06
 */

namespace api\controllers;
use yii\rest\Controller;
use common\models\Room;
use common\models\Roomcontent;
class RoomController extends Controller
{
    public function actionIndex(){
        $result=Room::find()->from('room as a')->leftJoin('x_user as b','a.uid=b.id')
            ->select('a.*,b.username')->asArray()->all();
        $room=[];
        foreach ($result as $value){
            $value['roomimage']="120.24.97.50".$value['roomimage'];
            $room[]=$value;
        }
        return $room;
    }
    public function actionDetail(){
        $roomid=\Yii::$app->request->get('roomid');
        $result=Room::find()->from('room as a')->leftJoin('x_user as b','a.uid=b.id')
            ->select('a.*,b.username,b.email,b.uphone')->where(['a.roomid'=>$roomid])->asArray()->all();
        $roomdetail=[];
        foreach ($result as $value){
            $value['roomimage']="120.24.97.50".$value['roomimage'];
            $roomdetail[]=$value;
        }
        return $roomdetail;
    }
    public function actionDetailcomment(){
        $roomid=\Yii::$app->request->get('roomid');
        $roomcontent=New Roomcontent();
        $result= $roomcontent->find()->leftJoin('x_user','roomcontent.uid=x_user.id')
            ->select('roomcontent.*,x_user.username,x_user.upicture,x_user.expe,x_user.email,x_user.uphone')
            ->where(['roomcontent.roomid'=>$roomid])->asArray()->all();
        $commentdetail=[];
        foreach ($result as $value){
            $value['upicture']="120.24.97.50".$value['upicture'];
            $commentdetail[]=$value;
        }
        return $commentdetail;
    }
}