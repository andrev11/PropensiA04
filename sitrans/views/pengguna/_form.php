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
	

    <?php if (!Yii::$app->user->isGuest && Yii::$app->user->identity->role == 'admin'){
		echo $form->field($model, 'username')->textInput(['maxlength' => true]);
		} else {
		echo $form->field($model, 'username')->textInput(['readonly'=>Yii::$app->user->identity->username]);
		}
			?>

    <?php if (!Yii::$app->user->isGuest && Yii::$app->user->identity->role == 'admin'){
		echo $form->field($model, 'nama')->textInput(['maxlength' => true]);
		} else {
		echo $form->field($model, 'nama')->textInput(['readonly'=>Yii::$app->user->identity->nama]);
		}
			 ?>
	<?php 
	//if (!Yii::$app->user->isGuest && Yii::$app->user->identity->role != 'admin'){
		echo $form->field($model, 'password_field')->passwordInput(['maxlength' => false])
		//;} 
		?>
   
   <?php 
   //if (!Yii::$app->user->isGuest && Yii::$app->user->identity->role != 'admin'){
		echo $form->field($model, 'repeatpassword')->passwordInput(['maxlength' => false])
		//;} 
		?>

   <?php if (!Yii::$app->user->isGuest && Yii::$app->user->identity->role == 'admin'){
	   echo $form->field($model, 'role')->dropDownList(ArrayHelper::map(Role::find()->all(),'role','role'),['prompt'=>'Select Role']);
	   } else {
	   echo $form->field($model, 'role')->textInput(['readonly'=>Yii::$app->user->identity->role]);
   } ?>
   


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
