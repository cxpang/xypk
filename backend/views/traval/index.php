<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\TravalSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '旅行故事';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="traval-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('新增旅行故事', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'travalid',
            'travalname',
            'travaltime',
//            'travalcontent',
            'travalprice',
             'travaldays',
            [
                'attribute'=>'travalimage',
                'format' => ['raw',],
                'value'=>function($dataProvider){
                    return Html::img($dataProvider->travalimage,['alt' => '缩略图','width' => 80]);
                }
            ],
            'uid',
            [
                'attribute'=>'发帖人',
                'value'=>'u.username',
            ],
             'status',
            ['attribute'=>'createtime',
                'format'=>['date','php:Y-m-d H:i:s'],

            ],
            ['attribute'=>'updatetime',
                'format'=>['date','php:Y-m-d H:i:s'],

            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
