<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\emotioncomment */

$this->title = 'Update Emotioncomment: ' . $model->emotioncommentid;
$this->params['breadcrumbs'][] = ['label' => 'Emotioncomments', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->emotioncommentid, 'url' => ['view', 'id' => $model->emotioncommentid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="emotioncomment-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
