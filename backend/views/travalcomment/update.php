<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Travalcomment */

$this->title = 'Update Travalcomment: ' . $model->travalcommentid;
$this->params['breadcrumbs'][] = ['label' => 'Travalcomments', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->travalcommentid, 'url' => ['view', 'id' => $model->travalcommentid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="travalcomment-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
