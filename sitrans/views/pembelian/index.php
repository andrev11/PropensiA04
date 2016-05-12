<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\controllers\SiteController;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PembelianSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Pembelian');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pembelian-index">

    
    
   
    <p>
        <?= Html::a(Yii::t('app', 'Tambah Pembelian'), ['create'], ['class' => 'btn btn-success']) ?>
        <?php 
          echo SiteController::connect();
          $query="Select * from pembayaran_out where jumlahbayar is null;";
          $isRecap=pg_num_rows(pg_query($query));
          if ($isRecap > 0){
            echo Html::a(Yii::t('app', 'Rekap'), ['recap'], ['class' => 'btn btn-success']);
          }
        ?>
        <?= Html::a(Yii::t('app', 'Print'), ['print', 'tgl_beli' => $searchModel->tgl_beli], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'idbeli',
            //'idbayar',
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

            ['class' => 'yii\grid\ActionColumn' , 'visible' => !Yii::$app->user->isGuest && Yii::$app->user->identity->role != 'purchasing'],
        ],
    ]); ?>

</div>
