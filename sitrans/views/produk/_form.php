<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Merk;
use app\models\Jenis;
use app\models\Produk;
use app\models\Lokasi;

/* @var $this yii\web\View */
/* @var $model app\models\Produk */
/*@var $form yii\widgets\ActiveForm */
?>

<div class="produk-form">

    <?php $form = ActiveForm::begin(); ?>
    <!--
    <?= $form->field($model, 'idmerk')->dropDownList(
        ArrayHelper::map(Merk::find()->all(),'idmerk','namasupplier'),
        ['prompt'=>'Select Merk']
    ) ?>

     <?= $form->field($model, 'idjenis')->dropDownList(
        ArrayHelper::map(Jenis::find()->all(),'idjenis','namajenis'),
        ['prompt'=>'Select Jenis']
    ) ?>

        
    
    <?php 
        if($model->isNewRecord) {
          echo   $form->field($model, 'namaproduk')->dropDownList(
            ArrayHelper::map(Produk::find()->all(),'namaproduk','namaproduk'),
            ['prompt'=>'Pilih Produk']
            ) ;
        } else {
            echo $form->field($model, 'produk')->textInput(['readonly'=>!$model->isNewRecord]); 
        }
    ?>
    -->
    <?php 
        if($model->isNewRecord) {
          echo   $form->field($model, 'idmerk')->dropDownList(
            ArrayHelper::map(Merk::find()->all(),'idmerk','namasupplier'),
            ['prompt'=>'Pilih Merk']
            ) ;
        } else {
            echo $form->field($model, 'idmerk')->textInput(['readonly'=>!$model->isNewRecord]); 
        }
    ?>

    <?php 
        if($model->isNewRecord) {
          echo   $form->field($model, 'idjenis')->dropDownList(
            ArrayHelper::map(Jenis::find()->all(),'idjenis','namajenis'),
            ['prompt'=>'Pilih Jenis']
            ) ;
        } else {
            echo $form->field($model, 'idjenis')->textInput(['readonly'=>!$model->isNewRecord]); 
        }
    ?>

    <?= $form->field($model, 'namaproduk')->textInput(['readonly'=>!$model->isNewRecord]) ?>


    <?= $form->field($model, 'lokasi')->dropDownList(
        ArrayHelper::map(Lokasi::find()->all(),'lokasi','lokasi'),
        ['prompt' => 'Select Lokasi']
        )
    ?> 


    <?= $form->field($model, 'harga_beli')->textInput() ?>

    <!--
    
    <?= $form->field($model, 'harga_jual')->textInput() ?>
    
    <?= $form->field($model, 'kilo')->textInput() ?>

    <?= $form->field($model, 'karton')->textInput() ?>

    -->

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
