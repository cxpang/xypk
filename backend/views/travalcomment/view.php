<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Travalcomment */

$this->title = $model->travalcommentid;
$this->params['breadcrumbs'][] = ['label' => 'Travalcomments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="travalcomment-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->travalcommentid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->travalcommentid], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'travalcommentid',
            'travalid',
            'travalcontent',
            'uid',
            'createtime:datetime',
            'updatetime:datetime',
        ],
    ]) ?>

</div>
