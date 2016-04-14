<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Role;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Pengguna */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pengguna-form">

    <?php $form = ActiveForm::begin(); ?>
	

    <?= $form->field($model, 'currentPassword')->passwordInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'newPassword')->passwordInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'newPasswordConfirm')->passwordInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>