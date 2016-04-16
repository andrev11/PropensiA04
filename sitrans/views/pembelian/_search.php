<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PembelianSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pembelian-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idbeli') ?>

    <?= $form->field($model, 'idbayar') ?>

    <?= $form->field($model, 'supplier') ?>

    <?= $form->field($model, 'produk') ?>

    <?= $form->field($model, 'tgl_beli') ?>

    <?php // echo $form->field($model, 'tgl_terima') ?>

    <?php // echo $form->field($model, 'cara_terima') ?>

    <?php // echo $form->field($model, 'cara_bayar') ?>

    <?php // echo $form->field($model, 'status_del') ?>

    <?php // echo $form->field($model, 'harga_total') ?>

    <?php // echo $form->field($model, 'karton') ?>

    <?php // echo $form->field($model, 'kilo') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
