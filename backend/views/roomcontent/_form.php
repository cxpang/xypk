<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Roomcontent */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="roomcontent-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'contenttext')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'uid')->textInput() ?>

    <?= $form->field($model, 'roomid')->textInput() ?>

    <?= $form->field($model, 'createtime')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '新建' : '删除', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
