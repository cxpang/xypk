<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\RoomSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="room-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'roomid') ?>

    <?= $form->field($model, 'roomname') ?>

    <?= $form->field($model, 'roomimage') ?>

    <?= $form->field($model, 'roomprice') ?>

    <?= $form->field($model, 'roomaddress') ?>

    <?php // echo $form->field($model, 'roomstatus') ?>

    <?php // echo $form->field($model, 'uid') ?>

    <?php // echo $form->field($model, 'createtime') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
