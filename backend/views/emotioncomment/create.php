<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\emotioncomment */

$this->title = 'Create Emotioncomment';
$this->params['breadcrumbs'][] = ['label' => 'Emotioncomments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="emotioncomment-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
