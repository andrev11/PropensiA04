<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PembelianOutSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Pembayaran Keluar');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pembayaran-out-index">

    
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'idbayar',
            'tgl_trans',
            'supplier',
            'status_bayar',
            'tgl_bayar',
            'jumlahbayar',
        
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
