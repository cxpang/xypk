<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\XUserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '用户管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="xuser-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [

             'id',
             'username',
//             'password',
             'sex',
             'address',
             'email:email',
            [
                'attribute'=>'upicture',
                'format' => ['raw',],
                'value'=>function($dataProvider){
                    return Html::img($dataProvider->upicture,['alt' => '缩略图','width' => 80]);
                }
            ],
             'uphone',
             'status',
            'university',
//             'auth_key',
//             'password_reset_token',
            ['attribute'=>'time',
                'format'=>['date','php:Y-m-d H:i:s'],

            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
