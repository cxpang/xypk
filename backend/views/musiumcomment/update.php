<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Musiumcomment */

$this->title = 'Update Musiumcomment: ' . $model->musiumcommentid;
$this->params['breadcrumbs'][] = ['label' => 'Musiumcomments', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->musiumcommentid, 'url' => ['view', 'id' => $model->musiumcommentid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="musiumcomment-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
