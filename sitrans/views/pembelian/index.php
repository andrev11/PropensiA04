<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PembelianSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Pembelians');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pembelian-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Pembelian'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idbeli',
            'idbayar',
            'supplier',
            'produk',
            'tgl_beli',
            // 'tgl_terima',
            // 'cara_terima',
            // 'cara_bayar',
            // 'status_del',
            // 'harga_total',
            // 'karton',
            // 'kilo',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
