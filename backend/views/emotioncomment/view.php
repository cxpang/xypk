<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\emotioncomment */

$this->title = $model->emotioncommentid;
$this->params['breadcrumbs'][] = ['label' => 'Emotioncomments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="emotioncomment-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->emotioncommentid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->emotioncommentid], [
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
            'emotioncommentid',
            'emotionid',
            'emotioncontent',
            'uid',
            'createtime:datetime',
            'updatetime:datetime',
        ],
    ]) ?>

</div>
