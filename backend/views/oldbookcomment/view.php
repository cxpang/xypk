<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Oldbookcomment */

$this->title = $model->oldbookcommentid;
$this->params['breadcrumbs'][] = ['label' => 'Oldbookcomments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="oldbookcomment-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->oldbookcommentid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->oldbookcommentid], [
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
            'oldbookcommentid',
            'oldbookcommenttext',
            'uid',
            'oldbookid',
            'createtime:datetime',
            'updatetime:datetime',
        ],
    ]) ?>

</div>
