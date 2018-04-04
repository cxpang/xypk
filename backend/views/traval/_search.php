<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\TravalSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="traval-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'travalid') ?>

    <?= $form->field($model, 'travalname') ?>

    <?= $form->field($model, 'travaltime') ?>

    <?= $form->field($model, 'travalcontent') ?>

    <?= $form->field($model, 'travalprice') ?>

    <?php // echo $form->field($model, 'travaldays') ?>

    <?php // echo $form->field($model, 'travalimage') ?>

    <?php // echo $form->field($model, 'uid') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'createtime') ?>

    <?php // echo $form->field($model, 'updatetime') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
