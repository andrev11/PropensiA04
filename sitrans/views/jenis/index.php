<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\JenisSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Daftar Jenis Produk');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jenis-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php if (!\Yii::$app->user->isGuest){
			if (Yii::$app->user->identity->role == 'purchasing')
				echo Html::a(Yii::t('app', 'Tambah Jenis'), ['create'], ['class' => 'btn btn-success']);} 
			?>
    </p>

    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'idjenis',
            'namajenis',
            'rop',
            'stok_kilo',
            'stok_karton',

            ['class' => 'yii\grid\ActionColumn', 'visible' => !Yii::$app->user->isGuest && (Yii::$app->user->identity->role == 'purchasing' ||Yii::$app->user->identity->role == 'sales marketing')
            ],
        ],
    ]); ?>

</div>
