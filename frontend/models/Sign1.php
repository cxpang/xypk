<?php
namespace frontend\models;

use yii\base\Model;
use common\models\XUser;


/**
 * Signup form
 */
class Sign1 extends Model
{
    public $username;
    public $email;
    public $uphone;
    public $password;
    public $repassword;
    public $verifyCode;
    public $university;
    public $expe;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required','message'=>'用户名不能为空'],
            ['username', 'unique', 'targetClass' => '\common\models\XUser', 'message' => '用户名已存在'],
            ['username', 'string', 'min' => 2, 'max' => 255],
            ['uphone','required','message'=>'手机号不能为空'],
            ['university','required','message'=>'大学不能为空'],
            ['email', 'trim'],
            ['email', 'required','message'=>'邮箱不能为空'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\XUser', 'message' => '邮箱已存在'],
            [['uphone'], 'match', 'pattern' => '/^1[3|4|5|7|8][0-9]{9}$/','message'=>'手机号码无效'],
            [['uphone'], 'unique', 'targetClass' => '\common\models\XUser', 'message' => '该手机号已被注册！'],
            ['password', 'required','message'=>'密码不能为空'],
            ['repassword', 'compare', 'compareAttribute' => 'password','message'=>'两次输入的密码不一致！'],
            ['password', 'string', 'min' => 6],
            ['verifyCode', 'captcha'],
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
            return null;
        }

        $user = new XUser();
        $user->username = $this->username;
        $user->uphone = $this->uphone;
        $user->email = $this->email;
        $user->university=$this->university;
        $user->expe=0;
        $user->time =time();
        $user->setPassword($this->password);
        $user->generateAuthKey();



        return $user->save() ? $user : null;
    }
    public function attributeLabels()
    {
        return [
            'verifyCode' => 'Verification Code',
        ];
    }
}
