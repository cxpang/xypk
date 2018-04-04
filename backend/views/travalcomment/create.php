<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Travalcomment */

$this->title = 'Create Travalcomment';
$this->params['breadcrumbs'][] = ['label' => 'Travalcomments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="travalcomment-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
