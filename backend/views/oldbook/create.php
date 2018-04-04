<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Oldbook */

$this->title = '新增旧书市场';
$this->params['breadcrumbs'][] = ['label' => '旧书市场', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="oldbook-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
