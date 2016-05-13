<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Customer;
use app\models\Produk; 
use app\models\Carakirim;
use app\models\Carabayar;
use app\models\Lokasi;

/* @var $this yii\web\View */
/* @var $model app\models\Penjualan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="penjualan-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php 
        if($model->isNewRecord) {
          echo   $form->field($model, 'produk')->dropDownList(
            ArrayHelper::map(Produk::find()->all(),'namaproduk','namaproduk'),
            ['prompt'=>'Pilih Produk']
            ) ;
        } else {
            echo $form->field($model, 'produk')->textInput(['readonly'=>!$model->isNewRecord]); 
        }
    ?>

    <?php
        if($model->isNewRecord) {
          echo $form->field($model, 'lokasi')->dropDownList(
            ArrayHelper::map(Lokasi::find()->all(),'lokasi','lokasi'),
            ['prompt' => 'Select Lokasi']
            );
        } else {
            echo $form->field($model, 'lokasi')->textInput(['readonly'=>!$model->isNewRecord]); 
        }
    ?> 

    <?php 
        if($model->isNewRecord) {
           echo  $form->field($model, 'customer')->dropDownList(
            ArrayHelper::map(Customer::find()->all(),'namacustomer','namacustomer'),
            ['prompt'=>'Pilih Customer']
            );
        } else {
            echo $form->field($model, 'customer')->textInput(['readonly'=>!$model->isNewRecord]); 
        }
    ?>

    <?= $form->field($model, 'tgl_kirim')->textInput(['type' => 'date', 'min' => date('Y-m-d')]) ?>

    <?= $form->field($model, 'jatuh_tempo')->textInput(['type' => 'date', 'min' => date('Y-m-d')]) ?>

    <?= $form->field($model, 'cara_kirim')->dropDownList(
        ArrayHelper::map(Carakirim::find()->all(),'carakirim','carakirim'),
        ['prompt'=>'Pilih Cara Kirim']
    ) ?>
    
    <?= $form->field($model, 'cara_bayar')->dropDownList(
        ArrayHelper::map(Carabayar::find()->all(),'caraterima','caraterima'),
        ['prompt'=>'Pilih Cara Bayar']
    ) ?>

    <?= $form->field($model, 'kilo')->textInput(['readonly'=>!$model->isNewRecord]) ?>
    
    <?= $form->field($model, 'karton')->textInput(['readonly'=>!$model->isNewRecord]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Submit') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
