<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Pembelian */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pembelian-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'supplier')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'produk')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tgl_terima')->textInput() ?>

    <?= $form->field($model, 'cara_terima')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cara_bayar')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'karton')->textInput() ?>

    <?= $form->field($model, 'kilo')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
