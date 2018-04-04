<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\emotion */

$this->title = '新增情感空间';
$this->params['breadcrumbs'][] = ['label' => '情感空间', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="emotion-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
