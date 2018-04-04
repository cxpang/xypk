<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Traval */

$this->title = $model->travalname;
$this->params['breadcrumbs'][] = ['label' => '旅行故事', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="traval-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('更新', ['update', 'id' => $model->travalid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->travalid], [
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
            'travalid',
            'travalname',
            'travaltime',
            'travalcontent',
            'travalprice',
            'travaldays',
            [
                'attribute'=>'travalimage',
                'format' => ['raw',],
                'value'=>function($model){
                    return Html::img('http://'.$model->travalimage,['alt' => '缩略图','width' => 80]);
                }
            ],
            [
                'label'=>'发布人',
                'value'=>$model->u->username,
            ],
            'status',
            [
                'attribute'=>'发布时间',
                'value'=>date('Y-m-d H:i:s',$model->createtime),
            ],
            [
                'attribute'=>'修改时间',
                'value'=>date('Y-m-d H:i:s',$model->updatetime),
            ],
        ],
    ]) ?>

</div>
