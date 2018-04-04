<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Exam */

$this->title = $model->examname;
$this->params['breadcrumbs'][] = ['label' => '考试有方', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="exam-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('更新', ['update', 'id' => $model->examid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->examid], [
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
            'examid',
            'examname',
            'examcontent',
            [
                'attribute'=>'examimage',
                'format' => ['raw',],
                'value'=>function($model){
                    return Html::img('http://'.$model->examimage,['alt' => '缩略图','width' => 80]);
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
