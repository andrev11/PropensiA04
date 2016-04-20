<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\PembayaranOut */

$this->title = Yii::t('app', 'ID {modelClass}: ', [
    'modelClass' => 'Pembayaran',
]) . ' ' . $model->idbayar;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Pembayaran Outs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pembayaran-out-view">

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->idbayar], ['class' => 'btn btn-primary']) ?>
        <?
		//= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->idbayar], [
        //    'class' => 'btn btn-danger',
        //    'data' => [
        //        'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
        //        'method' => 'post',
        //    ],
        //]) 
		?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idbayar',
            'supplier',
            'tgl_trans',
            'tgl_bayar',
            'jumlahbayar',
            'status_bayar',
        ],
    ]) ?>

</div>
