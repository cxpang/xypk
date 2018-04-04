<?php

namespace frontend\controllers;
use yii\web\Controller;
use common\models\XUser;
use yii\web\NotFoundHttpException;
use common\models\Star;
use common\models\Starcomment;
use common\models\Starcommentres;
use common\services\Delstarservice;

class StarController extends Controller
{
    public function actionIndex()
    {
        $contion="1=1";

        if(\Yii::$app->request->isGet){
            $info=\Yii::$app->request->get();
            if(isset($info['starname'])){
                $contion .=" and a.starname like '%".$info['starname']."%'";
            }
            if(isset($info['status'])&&$info['status']!='全部'){
                $contion .=" and a.status='".$info['status']."'";
            }
        }

        $query=Star::find()->from('star as a')->leftJoin('x_user as b','a.uid=b.id')
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
            $starimage=$_FILES;
            $handleresult=self::handleupload($starimage);
            $star=new Star();
            $star->starname=$param['starname'];
            $star->startime=$param['startime'];
            $star->starcontent=$param['starcontent'];
            $star->starimage=$handleresult;
            $star->starprice=$param['starprice'];
            $star->status='求约中';
            $star->createtime=time();
            $star->updatetime=time();
            $star->uid=$uid;
            if($star->save()){
                $user=$this->findModel($uid);
                $expe=$user->expe;
                $expe=$expe+5;
                $user->expe=$expe;
                $user->save();
                return $this->redirect(['star/index']);
            }
            else{
                echo $star->getErrors();
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


    public function handleupload($starimage){
        $type=substr($starimage['starimage']['name'], strrpos($starimage['starimage']['name'], '.'));
        $temp=$starimage['starimage']['tmp_name'];
        $imageName=time().rand(100,900).'star'.$type;
        $path='../../uploads/'.$imageName;
        move_uploaded_file($temp, $path);
        return '/xypk/uploads/'.$imageName;
    }

    public function actionDetail($starid){
        if(empty($starid)){
            return false;
        }

        $this->layout='xypk';
        $stardetail=Star::find()->leftJoin('x_user','x_user.id=star.uid')
            ->select('star.*,x_user.username,x_user.email,x_user.uphone')
            ->where(['starid'=>$starid])->asArray()->all();


        $commont=Starcomment::find()->from('starcomment as a')->leftJoin('x_user as b','a.uid=b.id')
            ->select('a.*,b.username,b.upicture,b.expe,b.email')->where(['a.starid'=>$starid])->asArray()->all();


        return $this->render('detail',[
            'stardetail'=>$stardetail,
            'content'=>$commont,
        ]);
    }
    public function actionAddcontent(){
        if(\Yii::$app->request->isPost){
            $params=\Yii::$app->request->post();
            $uid=$params['uid'];
            $starid=$params['starid'];
            $contenttext=$params['contenttext'];
            $time=time();
            $model=new Starcomment();
            $model->starid=$starid;
            $model->uid=$uid;
            $model->starcommenttext=$contenttext;
            $model->createtime=$time;
            $model->updatetime=$time;
            if($model->save()){
                $star=self::findstar($starid);
                $star->updatetime=$time;
                if ($star->save()){
                    $this->redirect(['detail','starid'=>$starid]);
                }
                else{
                    echo $star->getErrors();
                    return $this->goBack();
                }

            }
            else{
                echo $model->getErrors();
                return $this->goBack();

            }
        }
    }
    protected function findstar($starid){
        if (($model = Star::findOne($starid)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('追梦空间不存在.');
        }
    }

    public function actionAddres(){
        $info=\Yii::$app->request->post();
//        var_dump($info);
//        exit(0);
        $starcommontres=$info['starcommontres'];
        $uid=$info['uid'];
        $starid=$info['starid'];
        $starcommontid=$info['starcommontid'];
        $res=new Starcommentres();
        $res->starcommentid=$starcommontid;
        $res->uid=$uid;
        $res->starcommentrestext=$starcommontres;
        $res->createtime=time();
        $res->starid=$starid;
        if($res->save()){
            return $this->redirect(['star/detail','starid'=>$starid]);
        }
        else{
            var_dump($res->getErrors());
        }
    }
    public  function actionShowcontentres(){
        if(\Yii::$app->request->isPost){
            $info=\Yii::$app->request->post();
            $starcommontid=$info['starcommontid'];
            $res=new Starcommentres();
            $result=$res->find()->leftJoin('x_user','x_user.id=starcommentres.uid')
                ->select('x_user.username,x_user.upicture,starcommentres.*')->where(['starcommentid'=>$starcommontid])->asArray()->all();
            return json_encode($result);

        }
    }

    public function actionFinishstar(){
        if(\Yii::$app->request->isPost){
            $info=\Yii::$app->request->post();
            $starid=$info['starid'];
            $model=self::findstar($starid);
            $model->status='已结贴';
            if($model->save()) {
                return json_encode('ok');
            }
            return false;

        }
    }
    public function actionDeletestar(){
        if(\Yii::$app->request->isPost){
            $info=\Yii::$app->request->post();
            $travalid=$info['starid'];
            $deltraval=new Delstarservice();
            if($deltraval->delstar($travalid)){
                return json_encode('ok');
            }
            return false;
        }
    }
}