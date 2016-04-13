<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\db\Query;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Daftar Hutang');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pembayaran-out-index2">

    
    
<table class="table">
        <thead>
            <!-- <th> idbayar </th>-->
            <th align="center">Supplier</th>
            <th align="center">Tanggal Pembelian</th>
            <th align="center">Tanggal Pembayaran</th>
            <th align="center">Status Pembayaran</th>
            <th align="center">Jumlah Hutang</th>
        </thead>
        <tbody>
            <?php foreach ($hutang as $hutang): ?>
                <tr>
                    <td><?= $hutang->supplier ?></td>
                    <td align="center"><?= $hutang->tgl_trans ?></td>
                    <td align="center"><?= $hutang->tgl_bayar ?></td>
                    <td align="center"><?= $hutang->status_bayar ?></td>
                    <td align="center"><?= $hutang->jumlahbayar ?></td>
                    <td align="center"><?= Html::a('View', ['view', 'id' => $hutang->idbayar], ['class' => 'btn btn-primary']) ?></td>
                    <td align="center"><?= Html::a('Confirm', ['confirm', 'id' => $hutang->idbayar], [
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
