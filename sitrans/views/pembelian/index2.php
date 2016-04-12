<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\db\Query;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Daftar Barang Akan Masuk';
$this->params['breadcrumbs'][] = $this->title;
       
?>
<div class="pembelian-index2">

   
    <table class="table">
        <thead>
            <!-- <th> idbeli </th> -->
            <!-- <th> idbayar </th>-->
            <th>Nama Produk</th>
            <th>Tanggal Pembelian</th>
            <th>Tanggal Terima</th>
            <th>Cara Penerimaan</th>
            <!-- <th> <th>    cara_bayar</th>-->
            <th>Status Deliveri</th>
            <!-- <th> <th>    harga_total</th>-->
            <th>Jumlah Karton</th>
            <th>Jumlah Kilo</th>
        </thead>
        <tbody>
            <?php foreach ($beli2 as $beli): ?>
                <tr>
                    <!--<td><?= $beli->idbeli ?></td>-->
                    <!--<td><?= $beli->idbayar ?></td>-->
                    <td><?= $beli->produk ?></td>
                    <td><?= $beli->tgl_beli ?></td>
                    <td><?= $beli->tgl_terima ?></td>
                    <td><?= $beli->cara_terima ?></td>
                    <!--<td><?= $beli->cara_bayar ?></td>-->
                    <td><?= $beli->status_del ?></td>
                    <!--<td><?= $beli->harga_total ?></td>-->
                    <td><?= $beli->karton ?></td>
                    <td><?= $beli->kilo ?></td>
                    <td><?= Html::a('View', ['view', 'id' => $beli->idbeli], ['class' => 'btn btn-primary']) ?></td>
                    <td><?= Html::a('Confirm', ['confirm', 'id' => $beli->idbeli], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => 'Are you sure you want to confirm this item?',
                            'method' => 'post',
                        ],
                    ]) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>    
    </table>
</div>
