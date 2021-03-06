<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Oldbook */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="oldbook-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'oldbookname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'oldbookintro')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'oldbookprice')->textInput() ?>

    <?= $form->field($model, 'oldbookimage')->fileInput() ?>

    <?= $form->field($model, 'uid')->textInput() ?>


    <?= $form->field($model, 'status')->dropDownList(['卖书中'=>'卖书中','已结帖'=>'已结帖'],
        ['prompt']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '新增' : '修改', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
