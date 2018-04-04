<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Competcomment */

$this->title = 'Update Competcomment: ' . $model->competcommentid;
$this->params['breadcrumbs'][] = ['label' => 'Competcomments', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->competcommentid, 'url' => ['view', 'id' => $model->competcommentid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="competcomment-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
