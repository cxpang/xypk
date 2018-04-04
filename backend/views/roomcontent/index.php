<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\RoomcontentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '合租空间评论';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="roomcontent-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],

            'roomcontentid',
            'contenttext',
            'uid',
            [
                    'attribute'=>'评论人姓名',
                    'value'=>'u.username',
            ],
            'roomid',
            [
                'attribute'=>'合租空间帖子名',
                'value'=>'room.roomname',
            ],
            ['attribute'=>'createtime',
                'format'=>['date','php:Y-m-d H:i:s'],

            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
