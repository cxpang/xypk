<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/4
 * Time: 15:25
 */

namespace api\controllers;
use yii\rest\Controller;
use common\models\Oldbook;
class OldbookController extends Controller
{
    public function actionIndex(){
        $result=Oldbook::find()->from('oldbook as a')->leftJoin('x_user as b','a.uid=b.id')
            ->select('a.*,b.username')->orderBy('a.updatetime desc')->asArray()->all();
        return $result;
    }
    public function actionDetail(){
        $oldbookid=\Yii::$app->request->get('oldbookid');
        $result=Oldbook::find()->from('oldbook as a')->leftJoin('x_user as b','a.uid=b.id')
            ->select('a.*,b.username,b.username,b.email,b.uphone')->where(['a.oldbookid'=>$oldbookid])->orderBy('a.updatetime desc')->asArray()->all();
        return $result;
    }
}