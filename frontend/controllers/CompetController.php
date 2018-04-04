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
use common\models\Compet;
use common\models\Competcomment;
use common\models\Competcommentres;
use common\services\DelcompetService;
class CompetController extends Controller
{
    public function actionIndex()
    {
        $contion="1=1";
        if(\Yii::$app->request->isGet){
            $info=\Yii::$app->request->get();
            if(isset($info['competname'])){
                $contion .=" and a.competname like '%".$info['competname']."%'";
            }
            if(isset($info['status'])&&$info['status']!='全部'){
                $contion .=" and a.status='".$info['status']."'";
            }
        }
        $query=Compet::find()->from('compet as a')->leftJoin('x_user as b','a.uid=b.id')
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
            $competimage=$_FILES;
            $handleresult=self::handleupload($competimage);
            $compet=new Compet();
            $compet->competname=$param['competname'];
            $compet->compettime=$param['compettime'];
            $compet->competcontent=$param['competcontent'];
            $compet->competimage=$handleresult;
            $compet->status='求健身';
            $compet->createtime=time();
            $compet->updatetime=time();
            $compet->uid=$uid;
            if($compet->save()){
                $user=$this->findModel($uid);
                $expe=$user->expe;
                $expe=$expe+5;
                $user->expe=$expe;
                $user->save();
                return $this->redirect(['compet/index']);
            }
            else{
                echo $compet->getErrors();
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


    public function handleupload($competimage){
        $type=substr($competimage['competimage']['name'], strrpos($competimage['competimage']['name'], '.'));
        $temp=$competimage['competimage']['tmp_name'];
        $imageName=time().rand(100,900).'compet'.$type;
        $path='../../uploads/'.$imageName;
        move_uploaded_file($temp, $path);
        return '/xypk/uploads/'.$imageName;
    }
    public function actionDetail($competid){
        if(empty($competid)){
            return false;
        }

        $this->layout='xypk';
        $competdetail=Compet::find()->leftJoin('x_user','x_user.id=compet.uid')
            ->select('compet.*,x_user.username,x_user.email,x_user.uphone')
            ->where(['competid'=>$competid])->asArray()->all();


        $commont=Competcomment::find()->from('competcomment as a')->leftJoin('x_user as b','a.uid=b.id')
            ->select('a.*,b.username,b.upicture,b.expe,b.email')->where(['a.competid'=>$competid])->asArray()->all();


        return $this->render('detail',[
            'competdetail'=>$competdetail,
            'content'=>$commont,
        ]);
    }

    public function actionAddcontent(){
        if(\Yii::$app->request->isPost){
            $params=\Yii::$app->request->post();
            $uid=$params['uid'];
            $competid=$params['competid'];
            $contenttext=$params['contenttext'];
            $time=time();
            $model=new Competcomment();
            $model->competid=$competid;
            $model->uid=$uid;
            $model->competcommenttext=$contenttext;
            $model->createtime=$time;
            $model->updatetime=$time;
            if($model->save()){
                $star=self::findcompet($competid);
                $star->updatetime=$time;
                if ($star->save()){
                    $this->redirect(['detail','competid'=>$competid]);
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
    protected function findcompet($competid){
        if (($model = Compet::findOne($competid)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('健身空间不存在.');
        }
    }

    public function actionAddres(){
        $info=\Yii::$app->request->post();
//        var_dump($info);
//        exit(0);
        $starcommontres=$info['competcommontres'];
        $uid=$info['uid'];
        $competid=$info['competid'];
        $competcommontid=$info['competcommontid'];
        $res=new Competcommentres();
        $res->competcommentid=$competcommontid;
        $res->uid=$uid;
        $res->competcommentrestext=$starcommontres;
        $res->createtime=time();
        $res->competid=$competid;
        if($res->save()){
            return $this->redirect(['compet/detail','competid'=>$competid]);
        }
        else{
            var_dump($res->getErrors());
        }
    }
    public  function actionShowcontentres(){
        if(\Yii::$app->request->isPost){
            $info=\Yii::$app->request->post();
            $competcommontid=$info['competcommontid'];
            $res=new Competcommentres();
            $result=$res->find()->leftJoin('x_user','x_user.id=competcommentres.uid')
                ->select('x_user.username,x_user.upicture,competcommentres.*')->where(['competcommentid'=>$competcommontid])->asArray()->all();
            return json_encode($result);

        }
    }
    public function actionFinishcompet(){
        if(\Yii::$app->request->isPost){
            $info=\Yii::$app->request->post();
            $competid=$info['competid'];
            $model=self::findcompet($competid);
            $model->status='已结贴';
            if($model->save()) {
                return json_encode('ok');
            }
            return false;
        }
    }
    public function actionDeletecompet(){
        if(\Yii::$app->request->isPost){
            $info=\Yii::$app->request->post();
            $competid=$info['competid'];
            $delcompet=new DelcompetService();
            if($delcompet->delcompet($competid)){
                return json_encode('ok');
            }
            return false;
        }
    }
}