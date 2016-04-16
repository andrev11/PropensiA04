<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Pembelian */

$this->title = $model->idbeli;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Pembelians'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pembelian-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->idbeli], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->idbeli], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idbeli',
            'idbayar',
            'supplier',
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
