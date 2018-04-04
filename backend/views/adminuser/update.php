<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model common\models\Adminuser */

$this->title = '更改管理员信息: ' . $model->username;
$this->params['breadcrumbs'][] = ['label' => '管理员', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->username, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '更新';
?>
<div class="adminuser-update">

    <div class="adminuser-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'username')->textInput(['maxlength' => true])->label('用户名') ?>

        <?= $form->field($model, 'email')->textInput(['maxlength' => true])->label('用户名') ?>

        <?= $form->field($model, 'uphone')->textInput(['maxlength' => true])->label('用户名') ?>

        <?= $form->field($model, 'university')->textInput(['maxlength' => true])->label('用户名') ?>

        <div class="form-group">
            <?= Html::submitButton( '修改', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
