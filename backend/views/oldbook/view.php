<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Oldbook */

$this->title = $model->oldbookname;
$this->params['breadcrumbs'][] = ['label' => '旧书市场', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="oldbook-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('更新', ['update', 'id' => $model->oldbookid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->oldbookid], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '您确定要删除此项吗?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'oldbookid',
            'oldbookname',
            'oldbookintro',
            'oldbookprice',
            [
                'attribute'=>'oldbookimage',
                'format' => ['raw',],
                'value'=>function($model){
                    return Html::img('http://'.$model->oldbookimage,['alt' => '缩略图','width' => 80]);
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
            'status',
        ],
    ]) ?>

</div>
