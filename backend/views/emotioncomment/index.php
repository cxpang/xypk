<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\EmotioncommentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '情感天地评论';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="emotioncomment-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],

            'emotioncommentid',
            'emotionid',
            'emotioncontent',
            'uid',
            [
                'attribute'=>'评论人姓名',
                'value'=>'u.username',
            ],
            'createtime:datetime',
            // 'updatetime:datetime',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
