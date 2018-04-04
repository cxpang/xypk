<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\XUser */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => '用户管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="xuser-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('修改', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '确定要删除该用户吗?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'username',
            'password',
            'sex',
            'address',
            'email:email',
            [
                'attribute'=>'upicture',
                'format' => ['raw',],
                'value'=>function($model){
                    return Html::img('http://'.$model->upicture,['alt' => '缩略图','width' => 80]);
                }
            ],
            'uphone',
            'university',
            'status',
            'auth_key',
            'password_reset_token',
            ['attribute'=>'time',
                'format'=>['date','php:Y-m-d H:i:s'],
            ],
        ],
    ]) ?>

</div>
