<?php
namespace backend\models;

use yii\base\Model;
use common\models\Adminuser;

/**
 * Signup form
 */
class Adminsign extends Model
{
    public $username;
    public $email;
    public $uphone;
    public $password;
    public $repassword;
    public $university;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required','message'=>'用户名不能为空'],
            ['username', 'unique', 'targetClass' => '\common\models\Adminuser', 'message' => '用户名已存在'],
            ['username', 'string', 'min' => 2, 'max' => 255],
            ['uphone','required','message'=>'手机号不能为空'],
            ['university','required','message'=>'大学不能为空'],
            ['email', 'trim'],
            ['email', 'required','message'=>'邮箱不能为空'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\Adminuser', 'message' => '邮箱已存在'],
            [['uphone'], 'match', 'pattern' => '/^1[3|4|5|7|8][0-9]{9}$/','message'=>'手机号码无效'],
            [['uphone'], 'unique', 'targetClass' => '\common\models\Adminuser', 'message' => '该手机号已被注册！'],
            ['password', 'required','message'=>'密码不能为空'],
            ['repassword', 'compare', 'compareAttribute' => 'password','message'=>'两次输入的密码不一致！'],
            ['password', 'string', 'min' => 6],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
//            var_dump($this->getErrors());
//            exit(0);可以显示用户名已存在
            return null;
        }

        $user = new Adminuser();
        $user->username = $this->username;
        $user->uphone = $this->uphone;
        $user->email = $this->email;
        $user->university=$this->university;
        $user->sex='男';
        $user->status='2';
        $user->address='null';
        $user->time =time();
        $user->setPassword($this->password);
        $user->generateAuthKey();
    //   $user->save();var_dump($user->errors);exit(0);
        return $user->save() ? $user : null;
    }
}
