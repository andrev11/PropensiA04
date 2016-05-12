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
          $isRecap1=pg_num_rows(pg_query($query));
          $query2= "Select sum(harga_total) as totalharga from pembelian p, pembayaran_out po where p.idbayar=po.idbayar 
                    group by p.idbayar, po.jumlahbayar HAVING sum(harga_total) > jumlahbayar;";
          $isRecap2=pg_num_rows(pg_query($query2));
          if ($isRecap1 > 0 || $isRecap2 > 0){
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
            'kilo',
            'karton',
            ['class' => 'yii\grid\ActionColumn' , 'visible' => !Yii::$app->user->isGuest && Yii::$app->user->identity->role != 'purchasing'],
        ],
    ]); ?>

</div>
