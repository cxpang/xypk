<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Roomcontent */

$this->title = $model->roomcontentid;
$this->params['breadcrumbs'][] = ['label' => '合租空间评论', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="roomcontent-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('更新', ['update', 'id' => $model->roomcontentid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->roomcontentid], [
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
            'roomcontentid',
            'contenttext',
            [
                'attribute'=>'评论人姓名',
                'value'=>$model->u->username,
            ],
            [
                'attribute'=>'合租空间帖子名',
                'value'=>$model->room->roomname,
            ],
            ['attribute'=>'createtime',
                'format'=>['date','php:Y-m-d H:i:s'],

            ],
        ],
    ]) ?>

</div>
