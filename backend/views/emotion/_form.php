<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\emotion */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="emotion-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'emotionname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'emotioncontent')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'emotionimage')->fileInput() ?>

    <?= $form->field($model, 'uid')->textInput() ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '新增' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
