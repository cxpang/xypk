<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/10
 * Time: 15:51
 */

namespace frontend\controllers;
use yii\web\Controller;
use common\models\XUser;
use yii\web\NotFoundHttpException;
use common\models\Musium;
use common\models\Musiumcomment;
use common\models\Musiumcommentres;
use common\services\DelmusiumService;

class MusiumController extends Controller
{
    public function actionIndex()
    {
        $contion="1=1";
        if(\Yii::$app->request->isGet){
            $info=\Yii::$app->request->get();
            if(isset($info['musiumname'])){
                $contion .=" and a.musiumname like '%".$info['musiumname']."%'";
            }
            if(isset($info['status'])&&$info['status']!='全部'){
                $contion .=" and a.status='".$info['status']."'";
            }
        }
        $query=musium::find()->from('musium as a')->leftJoin('x_user as b','a.uid=b.id')
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
            $musiumimage=$_FILES;
            $handleresult=self::handleupload($musiumimage);
            $musium=new musium();
            $musium->musiumname=$param['musiumname'];
            $musium->musiumcontent=$param['musiumcontent'];
            $musium->musiumimage=$handleresult;
            $musium->status='求约中';
            $musium->createtime=time();
            $musium->updatetime=time();
            $musium->uid=$uid;
            if($musium->save()){
                $user=$this->findModel($uid);
                $expe=$user->expe;
                $expe=$expe+5;
                $user->expe=$expe;
                $user->save();
                return $this->redirect(['musium/index']);
            }
            else{
                echo $musium->getErrors();
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


    public function handleupload($musiumimage){
        $type=substr($musiumimage['musiumimage']['name'], strrpos($musiumimage['musiumimage']['name'], '.'));
        $temp=$musiumimage['musiumimage']['tmp_name'];
        $imageName=time().rand(100,900).'musium'.$type;
        $path='../../uploads/'.$imageName;
        move_uploaded_file($temp, $path);
        return '/xypk/uploads/'.$imageName;
    }
    public function actionDetail($musiumid){
        if(empty($musiumid)){
            return false;
        }

        $this->layout='xypk';
        $musiumdetail=musium::find()->leftJoin('x_user','x_user.id=musium.uid')
            ->select('musium.*,x_user.username,x_user.email,x_user.uphone')
            ->where(['musiumid'=>$musiumid])->asArray()->all();


        $commont=musiumcomment::find()->from('musiumcomment as a')->leftJoin('x_user as b','a.uid=b.id')
            ->select('a.*,b.username,b.upicture,b.expe,b.email')->where(['a.musiumid'=>$musiumid])->asArray()->all();


        return $this->render('detail',[
            'musiumdetail'=>$musiumdetail,
            'content'=>$commont,
        ]);
    }

    public function actionAddcontent(){
        if(\Yii::$app->request->isPost){
            $params=\Yii::$app->request->post();
            $uid=$params['uid'];
            $musiumid=$params['musiumid'];
            $contenttext=$params['contenttext'];
            $time=time();
            $model=new musiumcomment();
            $model->musiumid=$musiumid;
            $model->uid=$uid;
            $model->musiumcommenttext=$contenttext;
            $model->createtime=$time;
            $model->updatetime=$time;
            if($model->save()){
                $star=self::findmusium($musiumid);
                $star->updatetime=$time;
                if ($star->save()){
                    $this->redirect(['detail','musiumid'=>$musiumid]);
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
    protected function findmusium($musiumid){
        if (($model = musium::findOne($musiumid)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('健身空间不存在.');
        }
    }

    public function actionAddres(){
        $info=\Yii::$app->request->post();
//        var_dump($info);
//        exit(0);
        $starcommontres=$info['musiumcommontres'];
        $uid=$info['uid'];
        $musiumid=$info['musiumid'];
        $musiumcommontid=$info['musiumcommontid'];
        $res=new musiumcommentres();
        $res->musiumcommentid=$musiumcommontid;
        $res->uid=$uid;
        $res->musiumcommentrestext=$starcommontres;
        $res->createtime=time();
        $res->musiumid=$musiumid;
        if($res->save()){
            return $this->redirect(['musium/detail','musiumid'=>$musiumid]);
        }
        else{
            var_dump($res->getErrors());
        }
    }
    public  function actionShowcontentres(){
        if(\Yii::$app->request->isPost){
            $info=\Yii::$app->request->post();
            $musiumcommontid=$info['musiumcommontid'];
            $res=new musiumcommentres();
            $result=$res->find()->leftJoin('x_user','x_user.id=musiumcommentres.uid')
                ->select('x_user.username,x_user.upicture,musiumcommentres.*')->where(['musiumcommentid'=>$musiumcommontid])->asArray()->all();
            return json_encode($result);

        }
    }
    public function actionFinishmusium(){
        if(\Yii::$app->request->isPost){
            $info=\Yii::$app->request->post();
            $musiumid=$info['musiumid'];
            $model=self::findmusium($musiumid);
            $model->status='已结贴';
            if($model->save()) {
                return json_encode('ok');
            }
            return false;
        }
    }
    public function actionDeletemusium(){
        if(\Yii::$app->request->isPost){
            $info=\Yii::$app->request->post();
            $musiumid=$info['musiumid'];
            $delmusium=new DelmusiumService();
            if($delmusium->delmusium($musiumid)){
                return json_encode('ok');
            }
            return false;
        }
    }
}