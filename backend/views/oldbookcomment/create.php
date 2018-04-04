<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Oldbookcomment */

$this->title = 'Create Oldbookcomment';
$this->params['breadcrumbs'][] = ['label' => 'Oldbookcomments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="oldbookcomment-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
