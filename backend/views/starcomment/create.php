<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Starcomment */

$this->title = 'Create Starcomment';
$this->params['breadcrumbs'][] = ['label' => 'Starcomments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="starcomment-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
