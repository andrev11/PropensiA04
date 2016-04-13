<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Pembelian */

$this->title = 'Kode Transaksi: ' . ' ' . + $model->idbeli;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Pembelian'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pembelian-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idbeli',
            'idbayar',
            'produk',
            'tgl_beli',
            'tgl_terima',
            'cara_terima',
            'cara_bayar',
            'status_del',
            'harga_total',
            'karton',
            'kilo',
        ],
    ]) ?>

</div>
