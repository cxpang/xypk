<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Roomcontent */

$this->title = '更新用户评论: ' . $model->roomcontentid;
$this->params['breadcrumbs'][] = ['label' => '合租评论空间', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->roomcontentid, 'url' => ['view', 'id' => $model->roomcontentid]];
$this->params['breadcrumbs'][] = '更新';
?>
<div class="roomcontent-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
