<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/26
 * Time: 19:21
 */

namespace frontend\models;
use Yii;
use yii\base\Model;
use common\models\XUser;

class NewEmailSend extends Model
{
    public $email;
    public function rules()
    {
        return [
            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'exist',
                'targetClass' => '\common\models\XUser',
                'message' => '对不起Email邮箱不正确'
            ],
        ];
    }
    public function sendEmail()
    {
        /* @var $user User */
        $user = XUser::findOne([
            'email' => $this->email,
        ]);

        if (!$user) {
            return false;
        }

        if (!XUser::isPasswordResetTokenValid($user->password_reset_token)) {
            $user->generatePasswordResetToken();
            if (!$user->save()) {
                return false;
            }
        }

        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'passwordResetToken-html', 'text' => 'passwordResetToken-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($this->email)
            ->setSubject('用户找回密码 ' . Yii::$app->name)
            ->send();
    }
}