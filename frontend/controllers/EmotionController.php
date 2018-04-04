<?php
/**
 * Created by PhpStorm.
 * User: pangchenxu
 * Date: 2018/3/6
 * Time: 16:11
 */

namespace frontend\controllers;
use Yii;
use yii\web\Controller;
use common\models\XUser;
use yii\web\NotFoundHttpException;
use common\models\Emotion;
use common\models\Emotioncomment;
use common\services\DelEmotionService;
use common\models\Emotioncommentres;


class EmotionController  extends Controller
{
    public function actionIndex()
    {
        $contion="1=1";

        $query=Emotion::find()->from('emotion as a')->leftJoin('x_user as b','a.uid=b.id')
            ->select('a.*,b.username')->orderBy('updatetime desc')
            ->asArray()->all();

        $this->layout='xypk';
        return $this->render('index',[
                'data'=>$query,
            ]
        );
    }
    public function actionDetail($emotionid){
        $this->layout='xypk';
        $query=Emotion::find()->from('emotion as a')->leftJoin('x_user as b','a.uid=b.id')
            ->select('a.*,b.username,b.expe,b.upicture,b.email')->where(['emotionid'=>$emotionid])->asArray()->all();

        $commont=Emotioncomment::find()->from('emotioncomment as a')->leftJoin('x_user as b','a.uid=b.id')
            ->select('a.*,b.username,b.upicture,b.expe,b.email')->where(['a.emotionid'=>$emotionid])->asArray()->all();


        return $this->render('detail',[
            'data'=>$query,
            'content'=>$commont,
        ]);
    }
    public function actionCreate(){
        if(\Yii::$app->request->isPost){
            $uid=\Yii::$app->user->identity->id;
            $param=\Yii::$app->request->post();

            $emotionimage=$_FILES;
            $handleresult=self::handleupload($emotionimage);
            $emotion=new Emotion();
            $emotion->emotionname=$param['emotionname'];
            $emotion->emotioncontent=$param['emotioncontent'];
            $emotion->emotionimage=$handleresult;
            $emotion->uid=$uid;
            if($emotion->save()){
                $user=$this->findModel($uid);
                $expe=$user->expe;
                $expe=$expe+5;
                $user->expe=$expe;
                $user->save();
                return $this->redirect(['emotion/index']);
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
    public function handleupload($emotionimage){
        $type=substr($emotionimage['emotionimage']['name'], strrpos($emotionimage['emotionimage']['name'], '.'));
        $temp=$emotionimage['emotionimage']['tmp_name'];
        $imageName=time().rand(100,900).'emotionimage'.$type;
        $path='../../uploads/'.$imageName;
        move_uploaded_file($temp, $path);
        return '/xypk/uploads/'.$imageName;
    }

    public function actionDeleteemotion(){
        if(\Yii::$app->request->isPost){
            $info=\Yii::$app->request->post();
            $emotionid=$info['emotionid'];
            $deltraval=new DelEmotionService();
            if($deltraval->delemotion($emotionid)){
                return json_encode('ok');
            }
            return false;
        }
    }
    public function actionAddcontent(){
        if(\Yii::$app->request->isPost){
            $params=\Yii::$app->request->post();
            $uid=$params['uid'];
            $emotionid=$params['emotionid'];
            $contenttext=$params['contenttext'];
            $time=time();
            $model=new Emotioncomment();
            $model->emotionid=$emotionid;
            $model->uid=$uid;
            $model->emotioncontent=$contenttext;
            $model->createtime=$time;
            $model->updatetime=$time;
            if($model->save()){
                $emotion=self::findemotion($emotionid);
                $emotion->updatetime=$time;
                if ($emotion->save()){
                    $this->redirect(['detail','emotionid'=>$emotionid]);
                }
                else{
                    echo $emotion->getErrors();
                    return $this->goBack();
                }
            }
            else{
                echo $model->getErrors();
                return $this->goBack();
            }
        }
    }

    protected function findemotion($emotionid){
        if (($model = Emotion::findOne($emotionid)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('情感天地不存在.');
        }
    }

    public function actionAddres(){
        $info=\Yii::$app->request->post();
//        var_dump($info);
//        exit(0);
        $emotioncommontres=$info['emotioncommontres'];
        $uid=$info['uid'];
        $emotionid=$info['emotionid'];
        $emotioncommontid=$info['emotioncommontid'];
        $res=new Emotioncommentres();
        $res->emotioncommentid=$emotioncommontid;
        $res->uid=$uid;
        $res->emotioncommentrestext=$emotioncommontres;
        $res->createtime=time();
        $res->emotionid=$emotionid;
        if($res->save()){
            return $this->redirect(['emotion/detail','emotionid'=>$emotionid]);
        }
        else{
            var_dump($res->getErrors());
        }
    }
    public  function actionShowcontentres(){
        if(\Yii::$app->request->isPost){
            $info=\Yii::$app->request->post();
            $emotioncommontid=$info['emotioncommontid'];
            $res=new Emotioncommentres();
            $result=$res->find()->leftJoin('x_user','x_user.id=emotioncommentres.uid')
                ->select('x_user.username,x_user.upicture,emotioncommentres.*')->where(['emotioncommentid'=>$emotioncommontid])->asArray()->all();
            return json_encode($result);

        }
    }

}