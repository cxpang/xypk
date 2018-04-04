<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\OldbookSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="oldbook-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'oldbookid') ?>

    <?= $form->field($model, 'oldbookname') ?>

    <?= $form->field($model, 'oldbookintro') ?>

    <?= $form->field($model, 'oldbookprice') ?>

    <?= $form->field($model, 'oldbookimage') ?>

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
