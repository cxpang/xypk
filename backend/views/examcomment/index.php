<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ExamcommentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '考试有方评论';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="examcomment-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [

            'examcommentid',
            'examcommenttext',
            'uid',
            'examid',
            'createtime:datetime',
            // 'updatetime:datetime',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
