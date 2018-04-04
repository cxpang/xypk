<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Room */

$this->title = '修改合租空间：' . $model->roomname;
$this->params['breadcrumbs'][] = ['label' => '合租空间', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->roomname, 'url' => ['view', 'id' => $model->roomid]];
$this->params['breadcrumbs'][] = '修改';
?>
<div class="room-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
