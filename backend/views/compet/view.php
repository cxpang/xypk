<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Compet */

$this->title = $model->competname;
$this->params['breadcrumbs'][] = ['label' => '竞技空间', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="compet-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('更新', ['update', 'id' => $model->competid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->competid], [
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
            'competid',
            'competname',
            'competcontent',
            'compettime',
            [
                'attribute'=>'competimage',
                'format' => ['raw',],
                'value'=>function($model){
                    return Html::img('http://'.$model->competimage,['alt' => '缩略图','width' => 80]);
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
                'attribute'=>'更新时间',
                'value'=>date('Y-m-d H:i:s',$model->updatetime),
            ],
            'status',
        ],
    ]) ?>

</div>
