<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\StarSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="star-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'starid') ?>

    <?= $form->field($model, 'starname') ?>

    <?= $form->field($model, 'starcontent') ?>

    <?= $form->field($model, 'starimage') ?>

    <?= $form->field($model, 'startime') ?>

    <?php // echo $form->field($model, 'starprice') ?>

    <?php // echo $form->field($model, 'uid') ?>

    <?php // echo $form->field($model, 'createtime') ?>

    <?php // echo $form->field($model, 'updatetime') ?>

    <?php // echo $form->field($model, 'status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
