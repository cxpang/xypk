<?php
/**
 * Created by PhpStorm.
 * User: pangchenxu
 * Date: 2018/2/27
 * Time: 15:25
 */
namespace common\services;

use common\models\Room;
use common\models\Roomcontent;
use common\models\Roomcontentres;
use yii\web\NotFoundHttpException;


class DelroomService
{
    public function delRoom($roomid){

        $room=self::findRoom($roomid);
        $roomcontents=self::findRoomcontent($roomid);

        if($room->delete()){
            if($result=Roomcontent::deleteAll("roomid=$roomid")){
                if($roomcontents) {
                    foreach ($roomcontents as $roomcontent) {
                        if ($result = Roomcontentres::deleteAll("roomcontentid=$roomcontent->roomcontentid")) {
                            return true;
                        }
                    }
                }
                return true;
            }
            return true;
        }
        else{
            return false;
        }

    }
    protected function findRoom($roomid){
        if (($model = Room::findOne($roomid)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('房间号不存在.');
        }
    }
    protected function findRoomcontent($roomid){
        if(($models=Roomcontent::find()->where(['roomid'=>$roomid])->all())!=null){
            return $models;
        }
        else{
            return false;
        }
    }

}