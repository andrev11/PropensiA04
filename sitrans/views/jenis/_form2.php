<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Jenis */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="jenis-form">

    <?php $form = ActiveForm::begin(); ?>
 
   <?php 
	   if(!\Yii::$app->user->isGuest && Yii::$app->user->identity->role == 'purchasing') {
	       echo $form->field($model,'namajenis')->textInput();           
	   } 
    ?>

     
   
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
