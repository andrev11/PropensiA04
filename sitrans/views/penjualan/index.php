<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\controllers\SiteController;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PenjualanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

/*ini cobain*/

$this->title = Yii::t('app', 'Penjualan');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="penjualan-index">

   <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Tambah Penjualan'), ['create'], ['class' => 'btn btn-success']) ?>
        <?php 
          echo SiteController::connect();
          $query="Select * from pembayaran_in where jumlahbayar is null;";
          $isRecap=pg_num_rows(pg_query($query));
          if ($isRecap > 0){
            echo Html::a(Yii::t('app', 'Rekap'), ['recap'], ['class' => 'btn btn-success']);
          }
        ?>
        <?= Html::a(Yii::t('app', 'Print'), ['print', 'tgl_beli' => $searchModel->tgl_jual], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'idjual',
            //'idbayar',
            'customer',
            'produk',
            //'tgl_jual',
            'tgl_kirim',
            'lokasi',
            'jatuh_tempo',
            // 'jam_kirim',
            // 'cara_kirim',
            // 'cara_bayar',
            'status_del',
            'harga_total',
            // 'karton',
            // 'kilo',

            ['class' => 'yii\grid\ActionColumn' , 'visible' => !Yii::$app->user->isGuest && Yii::$app->user->identity->role != 'sales marketing'],
        ],
    ]); ?>

</div>
