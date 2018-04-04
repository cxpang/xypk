<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/10
 * Time: 19:46
 */

namespace backend\models;

use yii\base\Model;
use common\models\Adminuser;

class Resetpwd extends Model
{

    public $password;
    public $repassword;
    public function rules()
    {
        return [
            ['password', 'required','message'=>'密码不能为空'],
            ['repassword', 'compare', 'compareAttribute' => 'password','message'=>'两次输入的密码不一致！'],
            ['password', 'string', 'min' => 6],
        ];
    }
    public function attributeLabels(){
        return [
            'password' => '新密码',
            'repassword'=>'重复密码'
        ];
    }
    public function resetPassword($id){
        if (!$this->validate()) {
//            var_dump($this->getErrors());
//            exit(0);可以显示用户名已存在
            return null;
        }
        $user = Adminuser::findOne($id);

        $user->setPassword($this->password);
        $user->removePasswordResetToken();
        return $user->save() ? $user : null;

    }
}