<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Competcomment */

$this->title = $model->competcommentid;
$this->params['breadcrumbs'][] = ['label' => 'Competcomments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="competcomment-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->competcommentid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->competcommentid], [
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
            'competcommentid',
            'competcommenttext',
            'uid',
            'competid',
            'createtime:datetime',
            'updatetime:datetime',
        ],
    ]) ?>

</div>
