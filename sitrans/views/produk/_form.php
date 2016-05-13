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
   
    <?php 
        if($model->isNewRecord) {
          echo   $form->field($model, 'idmerk')->dropDownList(
            ArrayHelper::map(Merk::find()->all(),'idmerk','namasupplier'),
            ['prompt'=>'Pilih Merk']
            ) ;
        } 
    ?>

    <?php 
        if($model->isNewRecord) {
          echo   $form->field($model, 'idjenis')->dropDownList(
            ArrayHelper::map(Jenis::find()->all(),'idjenis','namajenis'),
            ['prompt'=>'Pilih Jenis']
            ) ;
        }
    ?>

    <?= $form->field($model, 'namaproduk')->textInput(['readonly'=>!$model->isNewRecord]) ?>

   <?php
        if($model->isNewRecord) {
            echo $form->field($model, 'lokasi')->dropDownList(
                ArrayHelper::map(Lokasi::find()->all(),'lokasi','lokasi'),
                ['prompt' => 'Select Lokasi']
                );
        }
    ?>
    <?php
        if($model->isNewRecord || Yii::$app->user->identity->role == 'purchasing'){
            echo $form->field($model, 'harga_beli')->textInput();
        } 
        if (Yii::$app->user->identity->role == 'sales marketing'){
            echo $form->field($model, 'harga_jual')->textInput();
        }
    ?>
    <?php 
        if(!$model->isNewRecord && Yii::$app->user->identity->role == 'admin inventori') {
             echo $form->field($model, 'kilo')->textInput(['readonly'=>!$model->isNewRecord]);
             echo $form->field($model, 'karton')->textInput(['readonly'=>!$model->isNewRecord]);
             echo $form->field($model, 'newstokkilo')->textInput();
             echo $form->field($model, 'newstokkarton')->textInput();
        } 
    ?>

    <!--
    
    <?= $form->field($model, 'harga_jual')->textInput() ?>
    
    <?= $form->field($model, 'kilo')->textInput() ?>

    <?= $form->field($model, 'karton')->textInput() ?>

    -->

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Submit') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
