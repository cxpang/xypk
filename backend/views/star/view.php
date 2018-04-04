<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Star */

$this->title = $model->starname;
$this->params['breadcrumbs'][] = ['label' => '追星空间', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="star-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('更新', ['update', 'id' => $model->starid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->starid], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '确定要删除此项吗?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'starid',
            'starname',
            'starcontent',
            'starimage',
            [
                'attribute'=>'starimage',
                'format' => ['raw',],
                'value'=>function($dataProvider){
                    return Html::img($dataProvider->starimage,['alt' => '缩略图','width' => 80]);
                }
            ],
            'starprice',
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
            'status',
        ],
    ]) ?>

</div>
