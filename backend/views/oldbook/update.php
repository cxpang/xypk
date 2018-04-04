<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Oldbook */

$this->title = '更新旧书市场: ' . $model->oldbookname;
$this->params['breadcrumbs'][] = ['label' => '旧书市场', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->oldbookname, 'url' => ['view', 'id' => $model->oldbookid]];
$this->params['breadcrumbs'][] = '更新';
?>
<div class="oldbook-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
