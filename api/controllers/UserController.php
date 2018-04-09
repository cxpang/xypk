<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/4
 * Time: 20:31
 */

namespace api\controllers;
use yii\rest\Controller;
use common\models\NewLoginForm;
use Yii;
use common\models\XUser;
class UserController extends Controller
{
   public function actionLogin(){

       $params=Yii::$app->request->post();
       $username=$params['username'];
       $password=$params['password'];
       $user=XUser::find()->where(['username'=>$username])->asArray()->one();
       if($user) {
           $user['upicture']="http://120.24.97.50".$user['upicture'];
           if (Yii::$app->security->validatePassword($password, $user['password'])) {
               return array(
                   'code'=>0,
                   'message'=>'登录成功',
                   'data'=>$user
               );
           } else {
               return array(
                   'code' => -1,
                   'message' => '密码错误',
               );
           }
       }
       else{
           return array(
               'code' => -1,
               'message' => '用户名不存在',
           );
       }
   }
   public function actionGetuserinfo($username){
       $user=XUser::find()->where(['username'=>$username])->asArray()->one();
       if($user){
           $user['upicture']="http://120.24.97.50".$user['upicture'];
           return $user;
       }
   }
    public function actionRegist(){

        $params=Yii::$app->request->post();
        $username=$params['username'];
        $password=$params['password'];
        $iphone=$params['iphone'];
        $university=$params['university'];
        $email=$params['email'];
        $user = new XUser();
        $user->username = $username;
        $user->uphone = $iphone;
        $user->email = $email;
        $user->university=$university;
        $user->expe=0;
        $user->time =time();
        $user->setPassword($password);
        $user->generateAuthKey();
        if($user->save()){
            return array(
                'code'=>0,
                'message'=>'登录成功',
                'data'=>$user
            );
        }
        else{
            return array(
                'code' => -1,
                'message' => '用户名或者邮箱已存在',
            );
        }
    }
}