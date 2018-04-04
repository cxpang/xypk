<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Starcomment */

$this->title = $model->starcommentid;
$this->params['breadcrumbs'][] = ['label' => 'Starcomments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="starcomment-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->starcommentid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->starcommentid], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'starcommentid',
            'starcommenttext',
            'uid',
            'starid',
            'createtime:datetime',
            'updatetime:datetime',
        ],
    ]) ?>

</div>
