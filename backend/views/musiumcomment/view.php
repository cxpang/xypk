<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Musiumcomment */

$this->title = $model->musiumcommentid;
$this->params['breadcrumbs'][] = ['label' => 'Musiumcomments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="musiumcomment-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->musiumcommentid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->musiumcommentid], [
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
            'musiumcommentid',
            'musiumcommenttext',
            'uid',
            'musiumid',
            'createtime:datetime',
            'updatetime:datetime',
        ],
    ]) ?>

</div>
