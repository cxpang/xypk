<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Examcomment */

$this->title = 'Update Examcomment: ' . $model->examcommentid;
$this->params['breadcrumbs'][] = ['label' => 'Examcomments', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->examcommentid, 'url' => ['view', 'id' => $model->examcommentid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="examcomment-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
