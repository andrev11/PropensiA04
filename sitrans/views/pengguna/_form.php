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
	

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password_field')->passwordInput(['maxlength' => false]) ?>
    <?= $form->field($model, 'repeatpassword')->passwordInput(['maxlength' => false]) ?>

   <?= $form->field($model, 'role')->dropDownList(
        ArrayHelper::map(Role::find()->all(),'role','role'),
        ['prompt'=>'Select Role']
    ) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
		<?php if (Yii::$app->user->identity->role == 'admin') {
			echo Html::a(Yii::t('app', 'Reset Password'), ['resetpassadmin', 'username' => $model->username], 
			['class' => 'btn btn-primary', 'data' => ['confirm' => 'Are you sure you want to reset password ?', 'method' => 'post',],]);
		}
		?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
