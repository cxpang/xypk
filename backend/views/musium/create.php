<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Musium */

$this->title = '新增图书馆约';
$this->params['breadcrumbs'][] = ['label' => '图书馆约', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="musium-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
