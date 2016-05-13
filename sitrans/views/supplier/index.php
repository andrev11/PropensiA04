<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SupplierSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Daftar Supplier');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="supplier-index">

    
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Tambah Supplier'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'idsupplier',
            'namasupplier',
            'telponsupplier',
            'alamatsupplier',
            'no_rekening',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
