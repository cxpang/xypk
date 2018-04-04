<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\CompetSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="compet-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'competid') ?>

    <?= $form->field($model, 'competname') ?>

    <?= $form->field($model, 'competcontent') ?>

    <?= $form->field($model, 'compettime') ?>

    <?= $form->field($model, 'competimage') ?>

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
