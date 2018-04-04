<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Traval */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="traval-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'travalname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'travaltime')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'travalcontent')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'travalprice')->textInput() ?>

    <?= $form->field($model, 'travaldays')->textInput() ?>

    <?= $form->field($model, 'travalimage')->fileInput() ?>

    <?= $form->field($model, 'uid')->textInput() ?>


    <?= $form->field($model, 'status')->dropDownList(['求拼游'=>'求拼游','已结帖'=>'已结帖'],
        ['prompt'])?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '新增' : '修改', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
