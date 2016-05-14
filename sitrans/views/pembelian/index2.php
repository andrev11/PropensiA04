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

   <div id="w0" class="grid-view">
    <table class="table table-striped table-bordered">
        <thead>
            <!-- <th> idbeli </th> -->
            <!-- <th> idbayar </th>-->
             <th align="center">#</th>
             <th align="center">Supplier</th>
            <th align="center">Nama Produk</th>
            <th align="center">Tanggal Pembelian</th>
            <th align="center">Tanggal Terima</th>
            <th align="center">Cara Penerimaan</th>
            <!-- <th> <th>    cara_bayar</th>-->
            <!-- <th> <th>    harga_total</th>-->
            <th align="center">Jumlah Karton</th>
            <th align="center">Jumlah Kilo</th>
        </thead>
        <tbody>
                                          
            <?php $number=1;
            foreach ($beli2 as $beli): ?>
                <tr>
                    <!--<td><?= $beli->idbeli ?></td>-->
                    <!--<td><?= $beli->idbayar ?></td>-->
                    <td><?= $number++ ?></td>
                    <td><?= $beli->supplier ?></td>
                    <td><?= $beli->produk ?></td>
                    <td align="center"><?= $beli->tgl_beli ?></td>
                    <td align="center"><?= $beli->tgl_terima ?></td>
                    <td align="center"><?= $beli->cara_terima ?></td>
                    <!--<td><?= $beli->cara_bayar ?></td>-->
                    <!--<td><?= $beli->harga_total ?></td>-->
                    <td align="center"><?= $beli->karton ?></td>
                    <td align="center"><?= $beli->kilo ?></td>
                    <td align="center"><?= Html::a('View', ['view', 'id' => $beli->idbeli], ['class' => 'btn btn-primary']) ?></td>
                    <td align="center"><?= Html::a('Konfirmasi', ['confirm', 'id' => $beli->idbeli], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => 'Apakah anda yakin ingin mengkonfirmasi transaksi ini ?',
                            'method' => 'post',
                        ],
                    ]) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>    
    </table>
   </div>
</div>
