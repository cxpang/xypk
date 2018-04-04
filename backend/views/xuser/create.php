<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\XUser */

$this->title = 'Create Xuser';
$this->params['breadcrumbs'][] = ['label' => 'Xusers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="xuser-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
