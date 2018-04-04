<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\OldbookSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '旧书市场';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="oldbook-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('新增旧书市场', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],

            'oldbookid',
            'oldbookname',
//            'oldbookintro',
            'oldbookprice',
            [
                'attribute'=>'oldbookimage',
                'format' => ['raw',],
                'value'=>function($dataProvider){
                    return Html::img($dataProvider->oldbookimage,['alt' => '缩略图','width' => 80]);
                }
            ],
             'uid',
            [
                'attribute'=>'发帖人',
                'value'=>'u.username',
            ],
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
