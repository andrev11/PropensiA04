<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Jenis */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="jenis-form">

    <?php $form = ActiveForm::begin(); ?>

   <!--<?= $form->field($model, 'namajenis')->textInput(['readonly'=>!$model->isNewRecord]) ?>
    <?= $form->field($model, 'stok_kilo')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'stok_karton')->textInput(['maxlength' => true]) ?> -->
 
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
	   } else {
            if($model->isNewRecord)
	   	 echo $form->field($model, 'rop')->textInput();	
		 }
    ?>
	
	<?php 
	   if(!\Yii::$app->user->isGuest && Yii::$app->user->identity->role == 'sales marketing') {
	     if(!$model->isNewRecord){
			echo $form->field($model,'newrop')->textInput();
		 }
	   }
    ?>
   
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
