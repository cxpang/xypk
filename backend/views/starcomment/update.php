<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Starcomment */

$this->title = 'Update Starcomment: ' . $model->starcommentid;
$this->params['breadcrumbs'][] = ['label' => 'Starcomments', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->starcommentid, 'url' => ['view', 'id' => $model->starcommentid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="starcomment-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
