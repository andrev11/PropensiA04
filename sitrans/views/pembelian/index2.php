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
            <th align="center">Nama Produk</th>
            <th align="center">Tanggal Pembelian</th>
            <th align="center">Tanggal Terima</th>
            <th align="center">Cara Penerimaan</th>
            <!-- <th> <th>    cara_bayar</th>-->
            <th align="center">Status Deliveri</th>
            <!-- <th> <th>    harga_total</th>-->
            <th align="center">Jumlah Karton</th>
            <th align="center">Jumlah Kilo</th>
        </thead>
        <tbody>
            <?php foreach ($beli2 as $beli): ?>
                <tr>
                    <!--<td><?= $beli->idbeli ?></td>-->
                    <!--<td><?= $beli->idbayar ?></td>-->
                    <td><?= $beli->produk ?></td>
                    <td align="center"><?= $beli->tgl_beli ?></td>
                    <td align="center"><?= $beli->tgl_terima ?></td>
                    <td align="center"><?= $beli->cara_terima ?></td>
                    <!--<td><?= $beli->cara_bayar ?></td>-->
                    <td align="center"><?= $beli->status_del ?></td>
                    <!--<td><?= $beli->harga_total ?></td>-->
                    <td align="center"><?= $beli->karton ?></td>
                    <td align="center"><?= $beli->kilo ?></td>
                    <td align="center"><?= Html::a('View', ['view', 'id' => $beli->idbeli], ['class' => 'btn btn-primary']) ?></td>
                    <td align="center"><?= Html::a('Confirm', ['confirm', 'id' => $beli->idbeli], [
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
