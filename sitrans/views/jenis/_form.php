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
	   } else {
	   	   echo $form->field($model, 'namajenis')->textInput(['readonly'=>!$model->isNewRecord]);	
		 }
    ?>
     <?php 
	   if(!\Yii::$app->user->isGuest && Yii::$app->user->identity->role == 'sales marketing') {
	        echo $form->field($model,'rop')->textInput(['readonly'=>!$model->isNewRecord]);
            echo $form->field($model,'newrop')->textInput();
            
	   } else {
            if($model->isNewRecord){
	   	       echo $form->field($model, 'rop')->textInput();	
		   }
        }
    ?>
   
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Submit') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
