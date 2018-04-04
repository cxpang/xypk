<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Adminuser */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="adminuser-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true])->label('用户名') ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true])->label('密码') ?>
    <?= $form->field($model, 'repassword')->passwordInput(['maxlength' => true])->label('重复密码') ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true])->label('邮箱') ?>


    <?= $form->field($model, 'uphone')->textInput(['maxlength' => true])->label('电话') ?>

    <?= $form->field($model, 'university')->textInput(['maxlength' => true])->label('大学') ?>

    <div class="form-group">
        <?= Html::submitButton( '新增', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
