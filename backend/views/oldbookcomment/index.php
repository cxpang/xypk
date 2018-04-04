<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\OldbookcommentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '旧书市场评论';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="oldbookcomment-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],

            'oldbookcommentid',
            'oldbookcommenttext',
            'uid',
            'oldbookid',
            'createtime:datetime',
            // 'updatetime:datetime',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
