<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Room */

$this->title = $model->roomname;
$this->params['breadcrumbs'][] = ['label' => '合租管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="room-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('更新', ['update', 'id' => $model->roomid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->roomid], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '确定要删除吗?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'roomid',
            'roomname',
            [
                'attribute'=>'roomimage',
                'format' => ['raw',],
                'value'=>function($model){
                    return Html::img($model->roomimage,['alt' => '缩略图','width' => 80]);
                }
            ],
            'roomprice',
            'roomaddress',
            'roomstatus',
            [
                    'label'=>'发布人',
                    'value'=>$model->status0->username,
            ],
            [
                    'attribute'=>'发布时间',
                    'value'=>date('Y-m-d H:i:s',$model->createtime),
            ],
        ],
    ]) ?>

</div>
