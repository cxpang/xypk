<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Traval */

$this->title = '修改旅行故事: ' . $model->travalname;
$this->params['breadcrumbs'][] = ['label' => '旅行故事', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->travalname, 'url' => ['view', 'id' => $model->travalid]];
$this->params['breadcrumbs'][] = '修改';
?>
<div class="traval-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
