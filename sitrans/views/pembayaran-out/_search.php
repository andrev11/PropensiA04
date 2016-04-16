<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PembayaranOutSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pembayaran-out-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idbayar') ?>

    <?= $form->field($model, 'supplier') ?>

    <?= $form->field($model, 'tgl_trans') ?>

    <?= $form->field($model, 'tgl_bayar') ?>

    <?= $form->field($model, 'jumlahbayar') ?>

    <?php // echo $form->field($model, 'status_bayar') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
