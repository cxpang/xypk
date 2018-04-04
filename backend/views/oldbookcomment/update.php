<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Oldbookcomment */

$this->title = 'Update Oldbookcomment: ' . $model->oldbookcommentid;
$this->params['breadcrumbs'][] = ['label' => 'Oldbookcomments', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->oldbookcommentid, 'url' => ['view', 'id' => $model->oldbookcommentid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="oldbookcomment-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
