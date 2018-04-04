<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Traval */

$this->title = '新增旅行故事';
$this->params['breadcrumbs'][] = ['label' => 'Travals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="traval-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
