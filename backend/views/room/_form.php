<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Room */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="room-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'roomname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'roomimage')->fileInput() ?>

    <?= $form->field($model, 'roomprice')->textInput() ?>

    <?= $form->field($model, 'roomaddress')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'roomstatus')->dropDownList(['求租中'=>'求租中','已结帖'=>'已结帖'],
        ['prompt'])?>

    <?= $form->field($model, 'uid')->textInput() ?>
    <?= $form->field($model, 'createtime')->textInput()->hiddenInput()->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '创建' : '修改', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
