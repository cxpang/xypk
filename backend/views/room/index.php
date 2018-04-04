<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\RoomSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '合租空间';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="room-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('新建合租空间', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
             'roomid',
             'roomname',
             [
                     'attribute'=>'roomimage',
                     'format' => ['raw',],
                     'value'=>function($dataProvider){
                       return Html::img($dataProvider->roomimage,['alt' => '缩略图','width' => 80]);
                     }
             ],
             'roomprice',
             'roomaddress',
             'roomstatus',
            'uid',
            [
                    'attribute'=>'发帖人',
                    'value'=>'status0.username',
            ],
            ['attribute'=>'createtime',
                'format'=>['date','php:Y-m-d H:i:s'],

            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
