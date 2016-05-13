<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PembayaranIn */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pembayaran-in-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idbayar')->textInput(['readonly'=>!$model->isNewRecord]) ?>

    <?= $form->field($model, 'customer')->textInput(['readonly'=>!$model->isNewRecord],['maxlength' => true]) ?>

    <?= $form->field($model, 'tgl_trans')->textInput(['readonly'=>!$model->isNewRecord]) ?>

    <?= $form->field($model, 'tgl_bayar')->textInput(['readonly'=>!$model->isNewRecord]) ?>

    <?= $form->field($model, 'jumlahbayar')->textInput(['readonly'=>!$model->isNewRecord]) ?>

    <?= $form->field($model, 'status_bayar')->textInput(['readonly'=>!$model->isNewRecord],['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Submit') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
