<?php
/**
 * Created by PhpStorm.
 * User: pangchenxu
 * Date: 2018/3/12
 * Time: 11:31
 */

namespace frontend\controllers;
use yii\web\Controller;
use common\models\XUser;
use common\models\Chatpoint;
use yii\web\NotFoundHttpException;
class ChatpointController extends Controller
{
    public  function actionIndex(){
        $gets=\Yii::$app->request->get();
        if(isset($gets['tochatid'])) {
            $this->layout = 'xypk';
            $params['fromchatid'] = \Yii::$app->user->identity->getId();
            $touser = XUser::find()->where(['id' => $gets['tochatid']])->select('id,username,upicture')->asArray()->all();
            $touser[0]['fromuserid'] = $params['fromchatid'];
            $params['tochatid'] = $gets['tochatid'];
            if (!$this->findexist($params['fromchatid'], $gets['tochatid'])) {
                $chats = new Chatpoint();
                $chats->fromid = $params['fromchatid'];
                $chats->toid = $touser[0]['id'];
                $chats->updated_at = time();
                $chats->created_at = time();
                $chats->save();
            }
            return $this->render('index', [
                'tousers' => $touser,
            ]);
        }
        else{
            $this->layout = 'xypk';
            $currentid = \Yii::$app->user->identity->getId();
            $touserall=Chatpoint::find()->from('chatpoint as  a')->leftJoin('x_user as b','a.fromid=b.id')->select('a.fromid,b.username,b.upicture')
                ->where(['a.toid'=>$currentid])->orderBy('updated_at desc')->asArray()->all();
            return $this->render('index',[
                'touserall'=>$touserall,
            ]);
        }
    }
    protected function findexist($fromid,$toid){
        if (($model = Chatpoint::find()->where(['fromid'=>$fromid,'toid'=>$toid])->one()) !== null) {
            $model->updated_at=time();
            $model->save();
            return $model;
        } else {
            return null;
        }
    }
}