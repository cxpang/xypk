<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Exam */

$this->title = '新增考试有方';
$this->params['breadcrumbs'][] = ['label' => '考试有方', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="exam-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
