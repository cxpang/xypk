<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\AdminuserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '管理员';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="adminuser-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('新建管理员', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],

             'id',
             'username',
//             'password',
             'sex',
             'address',
             'email:email',
            [
                'attribute'=>'upicture',
                'format' => ['raw',],
                'value'=>function($dataProvider){
                    return Html::img($dataProvider->upicture,['alt' => '缩略图','width' => 80]);
                }
            ],
             'uphone',
             'university',
             'status',
//             'auth_key',
//             'password_reset_token',
            ['attribute'=>'time',
                'format'=>['date','php:Y-m-d H:i:s'],

            ],

            ['class' => 'yii\grid\ActionColumn',
                'template'=>'{view}{update}{resetpwd}{privilege}',
                'buttons'=>[
                        'resetpwd'=>function($url,$model,$key){
                             $options=[
                                 'title'=>Yii::t('yii','重置密码'),
                                 'aria-label'=>Yii::t('yii','重置密码'),
                                 'data-pjax'=>'0',
                             ];
                             return Html::a('<span class="glyphicon glyphicon-lock"></span>',$url,$options);
                        },
                        'privilege'=>function($url,$model,$key){
                            $options=[
                               'title'=>Yii::t('yii','权限'),
                                'aria-label'=>Yii::t('yii','权限'),
                                'data-pjax'=>'0',
                            ];
                            return Html::a('<span class="glyphicon glyphicon-user">',$url,$options);
                        }

                ]
            ],
        ],
    ]); ?>
</div>
