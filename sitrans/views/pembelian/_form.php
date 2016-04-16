<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Supplier;
use app\models\Produk; 
use app\models\Caraterima;
use app\models\Carabayar;
/* @var $this yii\web\View */
/* @var $model app\models\Pembelian */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pembelian-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'supplier')->dropDownList(
        ArrayHelper::map(Supplier::find()->all(),'namasupplier','namasupplier'),
        ['prompt'=>'Pilih Supplier']
    ) ?>
    <?= $form->field($model, 'produk')->dropDownList(
        ArrayHelper::map(Produk::find()->all(),'namaproduk','namaproduk'),
        ['prompt'=>'Pilih Produk']
    ) ?>
   
    <?= $form->field($model, 'tgl_terima')->textInput() ?>
    <?= $form->field($model, 'cara_terima')->dropDownList(
        ArrayHelper::map(Caraterima::find()->all(),'caraterima','caraterima'),
        ['prompt'=>'Pilih Cara Terima']
    ) ?>
    <?= $form->field($model, 'cara_bayar')->dropDownList(
        ArrayHelper::map(Carabayar::find()->all(),'carabayar','carabayar'),
        ['prompt'=>'Pilih Cara Bayar']
    ) ?>
    <?= $form->field($model, 'karton')->textInput(['readonly'=>!$model->isNewRecord]) ?>

    <?= $form->field($model, 'kilo')->textInput(['readonly'=>!$model->isNewRecord]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
