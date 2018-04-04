<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\TravalcommentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '旅行故事评论管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="travalcomment-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],

            'travalcommentid',
            'travalid',
            [
                'attribute'=>'旅行目的地',
                'value'=>'traval.travalname',
            ],
            'travalcontent',
            'uid',
            [
                'attribute'=>'评论人',
                'value'=>'u.username',
            ],
            'createtime:datetime',
            // 'updatetime:datetime',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
