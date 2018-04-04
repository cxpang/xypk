<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Adminuser */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => '管理员', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="adminuser-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('更新', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '您确定要删除此管理员吗?',
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
//            'auth_key',
//            'password_reset_token',
            [
                'attribute'=>'创建时间',
                'value'=>date('Y-m-d H:i:s',$model->time),
            ],
        ],
    ]) ?>

</div>
