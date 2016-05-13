<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Daftar Pengguna';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengguna-index">

    <p>
        <?= Html::a('Tambah Pengguna', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'username',
            'nama',
            //'password',
            'role',
            
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
  

</div>
