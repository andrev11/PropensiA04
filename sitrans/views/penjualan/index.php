<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\controllers\SiteController;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PenjualanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

/*ini cobain*/

$this->title = Yii::t('app', 'Daftar Penjualan');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="penjualan-index">

   <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Tambah Penjualan'), ['create'], ['class' => 'btn btn-success']) ?>
        <?php 
          echo SiteController::connect();
          $query="Select * from pembayaran_in where jumlahbayar is null;";
          $isRecap1=pg_num_rows(pg_query($query));
          $query2= "Select sum(harga_total) as totalharga from penjualan p, pembayaran_in pi where p.idbayar=pi.idbayar 
                    group by p.idbayar, pi.jumlahbayar HAVING sum(harga_total) > jumlahbayar;";
          $isRecap2=pg_num_rows(pg_query($query2));
          if ($isRecap1 > 0 || $isRecap2 > 0){
            echo Html::a(Yii::t('app', 'Rekap'), ['recap'], ['class' => 'btn btn-success']);
          }
        ?>
        <?= Html::a(Yii::t('app', 'Cetak'), ['print', 'tgl_beli' => $searchModel->tgl_jual], ['class' => 'btn btn-success']) ?>
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
            'tgl_jual',
            //'tgl_kirim',
            //'lokasi',
            //'jatuh_tempo',
            // 'jam_kirim',
            // 'cara_kirim',
            // 'cara_bayar',
            'status_del',
             'harga_total',
             'kilo',
             'karton',

            ['class' => 'yii\grid\ActionColumn' , 'visible' => !Yii::$app->user->isGuest && Yii::$app->user->identity->role != 'sales marketing'],
        ],
    ]); ?>

</div>
