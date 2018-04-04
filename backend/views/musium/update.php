<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Musium */

$this->title = 'Update Musium: ' . $model->musiumid;
$this->params['breadcrumbs'][] = ['label' => 'Musia', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->musiumid, 'url' => ['view', 'id' => $model->musiumid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="musium-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
