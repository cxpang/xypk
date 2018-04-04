<?php

namespace frontend\controllers;

use yii\web\Controller;
use common\models\XUser;
use yii\web\NotFoundHttpException;
use common\models\Traval;
use common\models\Travalcomment;
use common\models\Travalcommentres;
use common\services\DeltravalService;
class TravelController extends Controller
{
    public function actionIndex()
    {
        $contion="1=1";

        if(\Yii::$app->request->isGet){
            $info=\Yii::$app->request->get();
            if(isset($info['travelname'])){
                $contion .=" and a.travalname like '%".$info['travelname']."%'";
            }
            if(isset($info['status'])&&$info['status']!='全部'){
                $contion .=" and a.status='".$info['status']."'";
            }
        }

        $query=Traval::find()->from('traval as a')->leftJoin('x_user as b','a.uid=b.id')
            ->select('a.*,b.username')->where($contion)->orderBy('updatetime desc')
            ->asArray()->all();

        $this->layout='xypk';
        return $this->render('index',[
            'data'=>$query,
            ]
        );
    }
    public function actionCreate(){

        if(\Yii::$app->request->isPost){
            $uid=\Yii::$app->user->identity->id;
            $param=\Yii::$app->request->post();
            $travelimage=$_FILES;
            $handleresult=self::handleupload($travelimage);
            $travel=new Traval();
            $travel->travalname=$param['travelname'];
            $travel->travaltime=$param['strat_time'];
            $travel->travalcontent=$param['travelcontent'];
            $travel->travalimage=$handleresult;
            $travel->travalprice=$param['travelprice'];
            $travel->travaldays=$param['traveldays'];
            $travel->status='求拼游';
            $travel->createtime=time();
            $travel->updatetime=time();
            $travel->uid=$uid;
            if($travel->save()){
                $user=$this->findModel($uid);
                $expe=$user->expe;
                $expe=$expe+5;
                $user->expe=$expe;
                $user->save();
                return $this->redirect(['travel/index']);
            }
            else{
                echo $travel->getErrors();
                return $this->goBack();
            }


        }
    }
    public function handleupload($travelimage){
        $type=substr($travelimage['travelimage']['name'], strrpos($travelimage['travelimage']['name'], '.'));
        $temp=$travelimage['travelimage']['tmp_name'];
        $imageName=time().rand(100,900).'roomtest'.$type;
        $path='../../uploads/'.$imageName;
        move_uploaded_file($temp, $path);
        return '/xypk/uploads/'.$imageName;
    }


    protected function findModel($id)
    {
        if (($model = XUser::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('用户不存在.');
        }
    }

    public function actionDetail($travalid){
        if(empty($travalid)){
            return false;
        }

        $this->layout='xypk';
        $travaldetail=Traval::find()->leftJoin('x_user','x_user.id=traval.uid')
            ->select('traval.*,x_user.username,x_user.email,x_user.uphone')
            ->where(['travalid'=>$travalid])->asArray()->all();


        $commont=Travalcomment::find()->from('travalcomment as a')->leftJoin('x_user as b','a.uid=b.id')
            ->select('a.*,b.username,b.upicture,b.expe,b.email')->where(['a.travalid'=>$travalid])->asArray()->all();


        return $this->render('detail',[
            'travaldetail'=>$travaldetail,
            'content'=>$commont,
        ]);
    }
    public function actionAddcontent(){
        if(\Yii::$app->request->isPost){
            $params=\Yii::$app->request->post();
            $uid=$params['uid'];
            $travalid=$params['travalid'];
            $contenttext=$params['contenttext'];
            $time=time();
            $model=new Travalcomment();
            $model->travalid=$travalid;
            $model->uid=$uid;
            $model->travalcontent=$contenttext;
            $model->createtime=$time;
            $model->updatetime=$time;
            if($model->save()){
                $traval=self::findtraval($travalid);
                $traval->updatetime=$time;
                if ($traval->save()){
                    $this->redirect(['detail','travalid'=>$travalid]);
                }
                else{
                    echo $traval->getErrors();
                    return $this->goBack();
                }

            }
            else{
                echo $model->getErrors();
                return $this->goBack();

            }
        }
    }
    public function actionFinishtraval(){
        if(\Yii::$app->request->isPost){
            $info=\Yii::$app->request->post();
            $travalid=$info['travalid'];
            $model=self::findtraval($travalid);
            $model->status='已结贴';
            if($model->save()) {
                return json_encode('ok');
            }
            return false;

        }
    }
    protected function findtraval($travalid){
        if (($model = Traval::findOne($travalid)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('旅行故事不存在.');
        }
    }
    public function actionAddres(){
        $info=\Yii::$app->request->post();
//        var_dump($info);
//        exit(0);
        $travalcommontres=$info['travalcommontres'];
        $uid=$info['uid'];
        $travalid=$info['travalid'];
        $travalcommontid=$info['travalcommontid'];
        $res=new Travalcommentres();
        $res->travalcommentid=$travalcommontid;
        $res->uid=$uid;
        $res->travalcommentrestext=$travalcommontres;
        $res->createtime=time();
        $res->travalid=$travalid;
        if($res->save()){
            return $this->redirect(['travel/detail','travalid'=>$travalid]);
        }
        else{
            var_dump($res->getErrors());
        }
    }
    public  function actionShowcontentres(){
        if(\Yii::$app->request->isPost){
            $info=\Yii::$app->request->post();
            $travalcommontid=$info['travalcommontid'];
            $res=new Travalcommentres();
            $result=$res->find()->leftJoin('x_user','x_user.id=travalcommentres.uid')
                ->select('x_user.username,x_user.upicture,travalcommentres.*')->where(['travalcommentid'=>$travalcommontid])->asArray()->all();
            return json_encode($result);

        }
    }
    public function actionDeletetraval(){
        if(\Yii::$app->request->isPost){
            $info=\Yii::$app->request->post();
            $travalid=$info['travalid'];
            $deltraval=new DeltravalService();
            if($deltraval->delTraval($travalid)){
                return json_encode('ok');
            }
            return false;
        }
    }
}