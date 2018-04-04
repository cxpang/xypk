<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Musiumcomment */

$this->title = 'Create Musiumcomment';
$this->params['breadcrumbs'][] = ['label' => 'Musiumcomments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="musiumcomment-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
