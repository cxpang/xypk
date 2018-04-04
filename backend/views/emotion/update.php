<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\emotion */

$this->title = '修改情感空间: ' . $model->emotionname;
$this->params['breadcrumbs'][] = ['label' => '情感空间', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->emotionname, 'url' => ['view', 'id' => $model->emotionid]];
$this->params['breadcrumbs'][] = '修改';
?>
<div class="emotion-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
