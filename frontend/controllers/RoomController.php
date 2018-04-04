<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/14
 * Time: 13:44
 */

namespace frontend\controllers;


use yii\web\Controller;
use common\models\XUser;
use common\models\Room;
use common\models\Roomcontent;
use yii\web\NotFoundHttpException;
use common\models\Roomcontentres;
use common\services\DelroomService;
class RoomController extends Controller
{
    public function actionIndex()
    {
        $contion="1=1";
        if(\Yii::$app->request->isPost){
            $params=\Yii::$app->request->post();
            if($params['roomname']){
                $contion.=" and roomname like '%".$params['roomname']."%'";
            }
            if($params['status']&&$params['status']!='全部'){
                $contion.=" and roomstatus='".$params['status']."'";
            }
        }


        $this->layout='xypk';
        $rooms=new Room();
        $result=$rooms->find()->leftJoin('x_user','uid=id')->select('room.*,x_user.username')
            ->where($contion)->orderBy('createtime desc')->asArray()->all();
        return $this->render('index',
            ['rooms'=>$result]
        );
    }
    public function actionDetail($roomid){
        if(!$roomid){
            return false;
        }
        $room=new Room();
        $roomcontent=new Roomcontent();
        $roomdetail=$room->find()->leftJoin('x_user','uid=id')->select('room.*,x_user.username,x_user.email,x_user.uphone')
            ->where(['room.roomid'=>$roomid])->asArray()->all();
        $content=$roomcontent->find()->leftJoin('x_user','roomcontent.uid=x_user.id')
            ->select('roomcontent.*,x_user.username,x_user.upicture,x_user.expe,x_user.email,x_user.uphone')
            ->where(['roomcontent.roomid'=>$roomid])->asArray()->all();
        $this->layout='xypk';
        return $this->render('detail',[
            'roomdetail'=>$roomdetail,
            'content'=>$content,
        ]);
    }
    public function actionAddcontent(){
        if(\Yii::$app->request->isPost){
            $params=\Yii::$app->request->post();
            $uid=$params['uid'];
            $roomid=$params['roomid'];
            $contenttext=$params['contenttext'];
            $time=time();
            $sql="insert into roomcontent(contenttext,uid,roomid,createtime) VALUE ('$contenttext',$uid,$roomid,$time)";
            $connection = \Yii::$app->db; //连接
            $command=$connection->createCommand($sql);
            $result = $command->execute();
            if($result){
                $user=$this->findModel($uid);
                $expe=$user->expe;
                $expe=$expe+1;
                $user->expe=$expe;
                $user->save();
                $this->redirect(['detail','roomid'=>$roomid]);
            }
            else{
                return $this->goBack();
            }

        }
    }
    protected function findModel($id)
    {
        if (($model = XUser::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('用户不存在.');
        }
    }
    public function actionCreate(){
        if(\Yii::$app->request->isPost){
            $uid=\Yii::$app->user->identity->id;
            $param=\Yii::$app->request->post();
            $roomimage=$_FILES;
            $handleresult=self::handleupload($roomimage);
            $room=new Room();
            $room->roomname=$param['roomname'];
            $room->roomprice=$param['roomprice'];
            $room->roomaddress=$param['roomaddress'];
            $room->roomimage=$handleresult;
            $room->roomstatus='求租中';
            $room->createtime=time();
            $room->uid=$uid;
            if($room->save()){
                $user=$this->findModel($uid);
                $expe=$user->expe;
                $expe=$expe+5;
                $user->expe=$expe;
                $user->save();
                return $this->redirect(['room/index']);
            }
            else{
                return $this->goBack();
            }


        }
    }
    public function handleupload($roomimage){
        $type=substr($roomimage['roomimage']['name'], strrpos($roomimage['roomimage']['name'], '.'));
        $temp=$roomimage['roomimage']['tmp_name'];
        $imageName=time().rand(100,900).'roomtest'.$type;
        $path='../../uploads/'.$imageName;
        move_uploaded_file($temp, $path);
        return '/xypk/uploads/'.$imageName;
    }
    public function actionAddres(){
        $info=\Yii::$app->request->post();
//        var_dump($info);
//        exit(0);
        $roomcontentres=$info['roomcontentres'];
        $uid=$info['uid'];
        $roomid=$info['roomid'];
        $roomcententid=$info['roomcontentid'];
        $res=new Roomcontentres();
        $res->roomcontentid=$roomcententid;
        $res->uid=$uid;
        $res->contentrestext=$roomcontentres;
        $res->createtime=time();
        if($res->save()){
            return $this->redirect(['room/detail','roomid'=>$roomid]);
        }
        else{
            var_dump($res->getErrors());
        }
    }
    public  function actionShowcontentres(){
        if(\Yii::$app->request->isPost){
            $info=\Yii::$app->request->post();
            $roomcontentid=$info['roomcontentid'];
            $res=new Roomcontentres();
            $result=$res->find()->leftJoin('x_user','x_user.id=roomcontentres.uid')
                ->select('x_user.username,x_user.upicture,roomcontentres.*')->where(['roomcontentid'=>$roomcontentid])->asArray()->all();
            return json_encode($result);

        }
    }
    public function actionFinishroom(){
        if(\Yii::$app->request->isPost){
            $info=\Yii::$app->request->post();
            $roomid=$info['roomid'];
            $model=self::findRoom($roomid);
            $model->roomstatus='已结贴';
            if($model->save()) {
                return json_encode('ok');
            }
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

    public function actionDeleteroom(){
        if(\Yii::$app->request->isPost){
            $info=\Yii::$app->request->post();
            $roomid=$info['roomid'];
//            $roommodel=self::findRoom($roomid);
//            if($roommodel->delete()) {
//                return json_encode('ok');
//            }
            $delroom=new DelroomService();
            if($delroom->delRoom($roomid)){
                return json_encode('ok');
            }
            return false;
        }
    }

}