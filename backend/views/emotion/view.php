<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\emotion */

$this->title = $model->emotionname;
$this->params['breadcrumbs'][] = ['label' => '情感空间', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="emotion-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('更新', ['update', 'id' => $model->emotionid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->emotionid], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '确定要删除这条记录吗?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'emotionid',
            'emotionname',
            'emotioncontent:ntext',
            [
                'attribute'=>'emotionimage',
                'format' => ['raw',],
                'value'=>function($model){
                    return Html::img('http://'.$model->emotionimage,['alt' => '缩略图','width' => 80]);
                }
            ],
            [
                'label'=>'发布人',
                'value'=>$model->u->username,
            ],
            [
                'attribute'=>'发布时间',
                'value'=>date('Y-m-d H:i:s',$model->createtime),
            ],
            [
                'attribute'=>'发布时间',
                'value'=>date('Y-m-d H:i:s',$model->updatetime),
            ],
        ],
    ]) ?>

</div>
