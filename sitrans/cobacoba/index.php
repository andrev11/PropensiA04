<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\grid\GridView;
use yii\base\Model; 
use app\models\Pembelian;
use yii\db\Query;
/* @var $this yii\web\View */
/* @var $searchModel app\models\PembelianSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Pembelian');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pembelian-index">

    
    <?php $start_date = $end_date = "" ?>
    <p>
        <?= Html::a(Yii::t('app', 'Create Pembelian'), ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('app', 'Recapitulation'), ['recap'], ['class' => 'btn btn-success']) ?>
        <br>
        <br>
        
     
        <label for="start_date"> Tanggal Awal</label>
        <input class ="input" type="date" name="start_date" value="start_date" placeholder="Enter your start date" id="start_date" required autofocus>
        <label for="end_date"> Tanggal Akhir</label>
        <input class ="input" type="date" name="end_date" value="end_date" placeholder="Enter your end date" id="end_date" required autofocus>
        
        
        <?php // $coba = '<a href="/PropensiA04/sitrans/web/pembelian/print?'$start_date'='.$start_date.'&'$end_date'='.$end_date.'>' ?>;
            
        <?= Html::a(Yii::t('app', 'Print'), ['print', $coba], ['class' => 'btn btn-success']) ?>

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

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
