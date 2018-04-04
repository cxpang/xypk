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
use common\models\Exam;
use common\models\Examcomment;
use common\models\Examcommentres;
use common\services\DelexamService;
class ExamController extends Controller
{
    public function actionIndex()
    {
        $contion="1=1";
        if(\Yii::$app->request->isGet){
            $info=\Yii::$app->request->get();
            if(isset($info['examname'])){
                $contion .=" and a.examname like '%".$info['examname']."%'";
            }
            if(isset($info['status'])&&$info['status']!='全部'){
                $contion .=" and a.status='".$info['status']."'";
            }
        }
        $query=exam::find()->from('exam as a')->leftJoin('x_user as b','a.uid=b.id')
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
            $examimage=$_FILES;
            $handleresult=self::handleupload($examimage);
            $exam=new exam();
            $exam->examname=$param['examname'];
            $exam->examcontent=$param['examcontent'];
            $exam->examimage=$handleresult;
            $exam->status='备考中';
            $exam->createtime=time();
            $exam->updatetime=time();
            $exam->uid=$uid;
            if($exam->save()){
                $user=$this->findModel($uid);
                $expe=$user->expe;
                $expe=$expe+5;
                $user->expe=$expe;
                $user->save();
                return $this->redirect(['exam/index']);
            }
            else{
                echo $exam->getErrors();
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


    public function handleupload($examimage){
        $type=substr($examimage['examimage']['name'], strrpos($examimage['examimage']['name'], '.'));
        $temp=$examimage['examimage']['tmp_name'];
        $imageName=time().rand(100,900).'exam'.$type;
        $path='../../uploads/'.$imageName;
        move_uploaded_file($temp, $path);
        return '/xypk/uploads/'.$imageName;
    }
    public function actionDetail($examid){
        if(empty($examid)){
            return false;
        }

        $this->layout='xypk';
        $examdetail=exam::find()->leftJoin('x_user','x_user.id=exam.uid')
            ->select('exam.*,x_user.username,x_user.email,x_user.uphone')
            ->where(['examid'=>$examid])->asArray()->all();


        $commont=examcomment::find()->from('examcomment as a')->leftJoin('x_user as b','a.uid=b.id')
            ->select('a.*,b.username,b.upicture,b.expe,b.email')->where(['a.examid'=>$examid])->asArray()->all();


        return $this->render('detail',[
            'examdetail'=>$examdetail,
            'content'=>$commont,
        ]);
    }

    public function actionAddcontent(){
        if(\Yii::$app->request->isPost){
            $params=\Yii::$app->request->post();
            $uid=$params['uid'];
            $examid=$params['examid'];
            $contenttext=$params['contenttext'];
            $time=time();
            $model=new examcomment();
            $model->examid=$examid;
            $model->uid=$uid;
            $model->examcommenttext=$contenttext;
            $model->createtime=$time;
            $model->updatetime=$time;
            if($model->save()){
                $star=self::findexam($examid);
                $star->updatetime=$time;
                if ($star->save()){
                    $this->redirect(['detail','examid'=>$examid]);
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
    protected function findexam($examid){
        if (($model = exam::findOne($examid)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('健身空间不存在.');
        }
    }

    public function actionAddres(){
        $info=\Yii::$app->request->post();
//        var_dump($info);
//        exit(0);
        $starcommontres=$info['examcommontres'];
        $uid=$info['uid'];
        $examid=$info['examid'];
        $examcommontid=$info['examcommontid'];
        $res=new examcommentres();
        $res->examcommentid=$examcommontid;
        $res->uid=$uid;
        $res->examcommentrestext=$starcommontres;
        $res->createtime=time();
        $res->examid=$examid;
        if($res->save()){
            return $this->redirect(['exam/detail','examid'=>$examid]);
        }
        else{
            var_dump($res->getErrors());
        }
    }
    public  function actionShowcontentres(){
        if(\Yii::$app->request->isPost){
            $info=\Yii::$app->request->post();
            $examcommontid=$info['examcommontid'];
            $res=new examcommentres();
            $result=$res->find()->leftJoin('x_user','x_user.id=examcommentres.uid')
                ->select('x_user.username,x_user.upicture,examcommentres.*')->where(['examcommentid'=>$examcommontid])->asArray()->all();
            return json_encode($result);

        }
    }
    public function actionFinishexam(){
        if(\Yii::$app->request->isPost){
            $info=\Yii::$app->request->post();
            $examid=$info['examid'];
            $model=self::findexam($examid);
            $model->status='已结贴';
            if($model->save()) {
                return json_encode('ok');
            }
            return false;
        }
    }
    public function actionDeleteexam(){
        if(\Yii::$app->request->isPost){
            $info=\Yii::$app->request->post();
            $examid=$info['examid'];
            $delexam=new DelexamService();
            if($delexam->delexam($examid)){
                return json_encode('ok');
            }
            return false;
        }
    }
}