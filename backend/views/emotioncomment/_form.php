<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\emotioncomment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="emotioncomment-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'emotionid')->textInput() ?>

    <?= $form->field($model, 'emotioncontent')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'uid')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '新建' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
