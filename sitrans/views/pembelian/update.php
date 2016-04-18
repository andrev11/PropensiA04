<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Pembelian */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Pembelian',
]) . ' ' . $model->idbeli;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Pembelians'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idbeli, 'url' => ['view', 'id' => $model->idbeli]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="pembelian-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
