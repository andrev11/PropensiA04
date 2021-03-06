<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProdukSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Daftar Produk');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="produk-index">
   
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
	

        <?php if (!\Yii::$app->user->isGuest){
            if (Yii::$app->user->identity->role == 'purchasing') 
                echo Html::a(Yii::t('app', 'Tambah Produk'), ['create'], ['class' => 'btn btn-success']);
            }
        ?>
		<?php if (!\Yii::$app->user->isGuest){
			if (Yii::$app->user->identity->role == 'admin inventori') 
		       echo Html::a(Yii::t('app', 'Print'), ['print'], ['class' => 'btn btn-success']);
            }
		?>	
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'idmerk',
            //'idjenis',
            'namaproduk',
            'harga_beli',
            'harga_jual',
            'kilo',
            'karton',
            'lokasi',
            ['class' => 'yii\grid\ActionColumn', 'visible' => !Yii::$app->user->isGuest && (Yii::$app->user->identity->role == 'admin inventori' || Yii::$app->user->identity->role == 'purchasing' || Yii::$app->user->identity->role == 'sales marketing')],
        ],
    ]); ?>

</div>
