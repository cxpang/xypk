<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Roomcontent */

$this->title = 'Create Roomcontent';
$this->params['breadcrumbs'][] = ['label' => 'Roomcontents', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="roomcontent-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
