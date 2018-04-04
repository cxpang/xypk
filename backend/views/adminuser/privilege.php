<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Adminuser;
/* @var $this yii\web\View */
/* @var $model common\models\Adminuser */
$model=Adminuser::findone($id);
$this->title = '管理员权限设置: ' . $model->username;
$this->params['breadcrumbs'][] = ['label' => '管理员', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->username, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '更新';
?>
<div class="adminuser-update">

    <div class="adminuser-privilege-form">

        <?php $form = ActiveForm::begin(); ?>
        <?=Html::checkboxList('newPri',$authAssignmentsarray,$allprivilegesArray) ;     ?>
        <div class="form-group">
            <?= Html::submitButton( '修改', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
