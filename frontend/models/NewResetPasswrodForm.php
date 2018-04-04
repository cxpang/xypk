<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/28
 * Time: 14:28
 */

namespace frontend\models;

use yii\base\Model;
use yii\base\InvalidParamException;
use common\models\XUser;
class NewResetPasswrodForm extends Model
{
    public $password;

    /**
     * @var \common\models\User
     */
    private $_user;
    public function __construct($token, $config = [])
    {
        if (empty($token) || !is_string($token)) {
            throw new InvalidParamException('找回密码口令不能为空.');
        }
        $this->_user = XUser::findByPasswordResetToken($token);
        if (!$this->_user) {
            throw new InvalidParamException('错误的口令');
        }
        parent::__construct($config);
    }

    public function rules()
    {
        return [
            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }
    public function resetPassword()
    {
        $user = $this->_user;
        $user->setPassword($this->password);
        $user->removePasswordResetToken();

        return $user->save(false);
    }
}