<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\db\Query;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Daftar Barang Akan Keluar';
$this->params['breadcrumbs'][] = $this->title;
       
?>
<div class="penjualan-index2">

   <div id="w0" class="grid-view">
    <table class="table table-striped table-bordered">
        <thead>
            <th align="center">#</th>
            <th align="center">Customer</th>
            <th align="center">Nama Produk</th>
            <th align="center">Tanggal <br> Penjualan</th>
            <th align="center">Tanggal <br> Kirim</th>
            <th align="center">Jatuh <br> Tempo </th>
            <th align="center">Cara Kirim</th>
            <th align="center">Cara Bayar</th>
            <th align="center">KG</th>
            <th align="center">Karton</th>
        </thead>
        <tbody>
                                          
            <?php $number=1;
            $idbayarprev=0;
            foreach ($jual as $model): 
                $idbayarprev= $model->idbayar; ?>
                <tr>
                    <td><?= $number++ ?></td>
                    <td><?= $model->customer ?></td>
                    <td><?= $model->produk ?></td>
                    <td align="center"><?= $model->tgl_jual ?></td>
                    <td align="center"><?= $model->tgl_kirim ?></td>
                    <td align="center"><?= $model->cara_kirim ?></td>
                    <td align="center"><?= $model->harga_total ?></td>
                    <td align="center"><?= $model->kilo ?></td>
                    <td align="center"><?= $model->karton ?></td>
                    <td align="center"><?= Html::a('View', ['view', 'id' => $model->idjual], ['class' => 'btn btn-primary']) ?></td>
                    <td align="center"><?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->idjual], ['class' => 'btn btn-primary']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>    
    </table>
   </div>
</div>
