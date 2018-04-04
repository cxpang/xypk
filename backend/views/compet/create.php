<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Compet */

$this->title = '新增竞技空间';
$this->params['breadcrumbs'][] = ['label' => '竞技空间', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="compet-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
