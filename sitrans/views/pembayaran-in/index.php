<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PembayaranInSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Pembayaran Ins');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pembayaran-in-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Pembayaran In'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idbayar',
            'customer',
            'tgl_trans',
            'tgl_bayar',
            'jumlahbayar',
            // 'status_bayar',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
