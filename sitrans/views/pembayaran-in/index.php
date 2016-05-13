<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PembayaranInSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Daftar Pembayaran Masuk');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pembayaran-in-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <!--
   
    -->

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'idbayar',
            'tgl_trans',
            'customer',
            'status_bayar',
            'tgl_bayar',
            'jumlahbayar',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
