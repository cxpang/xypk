<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\MusiumSearchcomment */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '图书馆约评论';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="musiumcomment-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],

            'musiumcommentid',
            'musiumcommenttext',
            'uid',
            'musiumid',
            'createtime:datetime',
            // 'updatetime:datetime',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
