<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = '欢迎注册';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login col-md-10 col-md-offset-2 ">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>请将以下表单填写完整</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true])->label('用户名') ?>
                <?= $form->field($model, 'uphone')->textInput()->label('手机号') ?>

                <?= $form->field($model, 'email')->label('邮箱') ?>
                <?= $form->field($model, 'university')->textInput()->label('所在大学')?>
                <?= $form->field($model, 'password')->passwordInput()->label('请输入密码') ?>
                <?= $form->field($model, 'repassword')->passwordInput()->label('请重复密码') ?>
                <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                    'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6" style="margin-left: 20px">{input}</div></div>',
                 ])->label('请输入验证码') ?>
                <div class="form-group">
                    <?= Html::submitButton('注册', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                    <a href="index.php" style="margin-left: 40px;text-decoration: none;color: #2e6da4;font-size: 20px;">返回首页</a>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
