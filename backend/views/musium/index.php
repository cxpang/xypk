<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\MusiumSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '图书馆约';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="musium-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('新增图书馆约', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],

            'musiumid',
            'musiumname',
            'musiumcontent',
            [
                'attribute'=>'musiumimage',
                'format' => ['raw',],
                'value'=>function($dataProvider){
                    return Html::img($dataProvider->musiumimage,['alt' => '缩略图','width' => 80]);
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
             'status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
