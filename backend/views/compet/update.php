<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Compet */

$this->title = 'Update Compet: ' . $model->competid;
$this->params['breadcrumbs'][] = ['label' => 'Compets', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->competid, 'url' => ['view', 'id' => $model->competid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="compet-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
