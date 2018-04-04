<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Star */

$this->title = '新增追星剧场';
$this->params['breadcrumbs'][] = ['label' => '追星剧场', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="star-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
