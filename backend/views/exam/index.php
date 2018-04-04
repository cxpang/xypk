<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ExamSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '考试有方';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="exam-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('新增考试有方', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],

            'examid',
            'examname',
            'examcontent',
            [
                'attribute'=>'examimage',
                'format' => ['raw',],
                'value'=>function($dataProvider){
                    return Html::img($dataProvider->examimage,['alt' => '缩略图','width' => 80]);
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
