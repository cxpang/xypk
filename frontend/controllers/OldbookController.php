<?php

namespace frontend\controllers;
use yii\web\Controller;
use common\models\XUser;
use yii\web\NotFoundHttpException;
use common\models\Oldbook;
use common\models\Oldbookcomment;
use common\models\Oldbookcommentres;
use common\services\Deloldbookservice;

class OldbookController extends Controller
{
    public function actionIndex()
    {
        $contion="1=1";

        if(\Yii::$app->request->isGet){
            $info=\Yii::$app->request->get();
            if(isset($info['oldbookname'])){
                $contion .=" and a.oldbookname like '%".$info['oldbookname']."%'";
            }
            if(isset($info['status'])&&$info['status']!='全部'){
                $contion .=" and a.status='".$info['status']."'";
            }
        }

        $query=oldbook::find()->from('oldbook as a')->leftJoin('x_user as b','a.uid=b.id')
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
            $oldbookimage=$_FILES;
            $handleresult=self::handleupload($oldbookimage);
            $oldbook=new oldbook();
            $oldbook->oldbookname=$param['oldbookname'];
            $oldbook->oldbookintro=$param['oldbookintro'];
            $oldbook->oldbookimage=$handleresult;
            $oldbook->oldbookprice=$param['oldbookprice'];
            $oldbook->status='卖书中';
            $oldbook->createtime=time();
            $oldbook->updatetime=time();
            $oldbook->uid=$uid;
            if($oldbook->save()){
                $user=$this->findModel($uid);
                $expe=$user->expe;
                $expe=$expe+5;
                $user->expe=$expe;
                $user->save();
                return $this->redirect(['oldbook/index']);
            }
            else{
                echo $oldbook->getErrors();
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


    public function handleupload($oldbookimage){
        $type=substr($oldbookimage['oldbookimage']['name'], strrpos($oldbookimage['oldbookimage']['name'], '.'));
        $temp=$oldbookimage['oldbookimage']['tmp_name'];
        $imageName=time().rand(100,900).'oldbook'.$type;
        $path='../../uploads/'.$imageName;
        move_uploaded_file($temp, $path);
        return '/xypk/uploads/'.$imageName;
    }

    public function actionDetail($oldbookid){
        if(empty($oldbookid)){
            return false;
        }

        $this->layout='xypk';
        $oldbookdetail=oldbook::find()->leftJoin('x_user','x_user.id=oldbook.uid')
            ->select('oldbook.*,x_user.username,x_user.email,x_user.uphone')
            ->where(['oldbookid'=>$oldbookid])->asArray()->all();


        $commont=oldbookcomment::find()->from('oldbookcomment as a')->leftJoin('x_user as b','a.uid=b.id')
            ->select('a.*,b.username,b.upicture,b.expe,b.email')->where(['a.oldbookid'=>$oldbookid])->asArray()->all();


        return $this->render('detail',[
            'oldbookdetail'=>$oldbookdetail,
            'content'=>$commont,
        ]);
    }
    public function actionAddcontent(){
        if(\Yii::$app->request->isPost){
            $params=\Yii::$app->request->post();
            $uid=$params['uid'];
            $oldbookid=$params['oldbookid'];
            $contenttext=$params['contenttext'];
            $time=time();
            $model=new oldbookcomment();
            $model->oldbookid=$oldbookid;
            $model->uid=$uid;
            $model->oldbookcommenttext=$contenttext;
            $model->createtime=$time;
            $model->updatetime=$time;
            if($model->save()){
                $oldbook=self::findoldbook($oldbookid);
                $oldbook->updatetime=$time;
                if ($oldbook->save()){
                    $this->redirect(['detail','oldbookid'=>$oldbookid]);
                }
                else{
                    echo $oldbook->getErrors();
                    return $this->goBack();
                }

            }
            else{
                echo $model->getErrors();
                return $this->goBack();

            }
        }
    }
    protected function findoldbook($oldbookid){
        if (($model = oldbook::findOne($oldbookid)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('追梦空间不存在.');
        }
    }

    public function actionAddres(){
        $info=\Yii::$app->request->post();
//        var_dump($info);
//        exit(0);
        $oldbookcommontres=$info['oldbookcommontres'];
        $uid=$info['uid'];
        $oldbookid=$info['oldbookid'];
        $oldbookcommontid=$info['oldbookcommontid'];
        $res=new oldbookcommentres();
        $res->oldbookcommentid=$oldbookcommontid;
        $res->uid=$uid;
        $res->oldbookcommentrestext=$oldbookcommontres;
        $res->createtime=time();
        $res->oldbookid=$oldbookid;
        if($res->save()){
            return $this->redirect(['oldbook/detail','oldbookid'=>$oldbookid]);
        }
        else{
            var_dump($res->getErrors());
        }
    }
    public  function actionShowcontentres(){
        if(\Yii::$app->request->isPost){
            $info=\Yii::$app->request->post();
            $oldbookcommontid=$info['oldbookcommontid'];
            $res=new oldbookcommentres();
            $result=$res->find()->leftJoin('x_user','x_user.id=oldbookcommentres.uid')
                ->select('x_user.username,x_user.upicture,oldbookcommentres.*')->where(['oldbookcommentid'=>$oldbookcommontid])->asArray()->all();
            return json_encode($result);

        }
    }

    public function actionFinisholdbook(){
        if(\Yii::$app->request->isPost){
            $info=\Yii::$app->request->post();
            $oldbookid=$info['oldbookid'];
            $model=self::findoldbook($oldbookid);
            $model->status='已结贴';
            if($model->save()) {
                return json_encode('ok');
            }
            return false;

        }
    }
    public function actionDeleteoldbook(){
        if(\Yii::$app->request->isPost){
            $info=\Yii::$app->request->post();
            $travalid=$info['oldbookid'];
            $deltraval=new Deloldbookservice();
            if($deltraval->deloldbook($travalid)){
                return json_encode('ok');
            }
            return false;
        }
    }
}