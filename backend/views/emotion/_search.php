<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\EmotionSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="emotion-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'emotionid') ?>

    <?= $form->field($model, 'emotionname') ?>

    <?= $form->field($model, 'emotioncontent') ?>

    <?= $form->field($model, 'emotionimage') ?>

    <?= $form->field($model, 'uid') ?>

    <?php // echo $form->field($model, 'createtime') ?>

    <?php // echo $form->field($model, 'updatetime') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
