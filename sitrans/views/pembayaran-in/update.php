<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PembayaranIn */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Pembayaran In',
]) . ' ' . $model->idbayar;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Pembayaran Masuk'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idbayar, 'url' => ['view', 'id' => $model->idbayar]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="pembayaran-in-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
