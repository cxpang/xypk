<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Examcomment */

$this->title = $model->examcommentid;
$this->params['breadcrumbs'][] = ['label' => 'Examcomments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="examcomment-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->examcommentid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->examcommentid], [
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
            'examcommentid',
            'examcommenttext',
            'uid',
            'examid',
            'createtime:datetime',
            'updatetime:datetime',
        ],
    ]) ?>

</div>
