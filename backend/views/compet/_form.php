<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Compet */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="compet-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'competname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'competcontent')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'compettime')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'competimage')->fileInput() ?>

    <?= $form->field($model, 'uid')->textInput() ?>


    <?= $form->field($model, 'status')->dropDownList(['求竞技'=>'求竞技','已结帖'=>'已结帖'],
        ['prompt']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '新增' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
