<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Musium */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="musium-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'musiumname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'musiumcontent')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'musiumimage')->fileInput() ?>

    <?= $form->field($model, 'uid')->textInput() ?>

    <?= $form->field($model, 'status')->dropDownList(['求约馆'=>'求约馆','已结帖'=>'已结帖'],
        ['prompt']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '新增' : '修改', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
