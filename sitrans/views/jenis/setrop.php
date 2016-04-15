<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\db\Query;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Daftar Jenis Barang';
$this->params['breadcrumbs'][] = $this->title;
       
?>
<div class="pembelian-index2">

   
    <table class="table">
        <thead>
            <!-- <th> idbeli </th> -->
            <!-- <th> idbayar </th>-->
            <th align="center">Nama Jenis</th>
            <th align="center">Stok Kilo</th>
            <th align="center">Stok Karton</th>
            <th align="center">ROP</th>

        </thead>
        <tbody>
            <?php foreach ($jenis2 as $model): ?>
                <tr>

                    <td><?= $model->namajenis ?></td>
                    <td><?= $model->stok_kilo ?></td>
                    <td ><?= $model->stok_karton ?></td>
                    <td ><?= $model->rop ?></td>
                    <td ><?= Html::a(Yii::t('app', 'Update ROP'), ['update', 'id' => $model->idjenis], ['class' => 'btn btn-primary']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>    
    </table>
</div>
