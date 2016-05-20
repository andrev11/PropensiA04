<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\db\Query;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Daftar Pembelian Belum Diterima';
$this->params['breadcrumbs'][] = $this->title;
       
?>
<div class="pembelian-index2">

   <div id="w0" class="grid-view">
    <table class="table table-striped table-bordered">
        <thead>
            <th align="center">#</th>
            <th align="center">Supplier</th>
            <th align="center">Nama Produk</th>
            <th align="center">Tanggal <br> Terima</th>
            <th align="center">Cara Terima</th>
            <th align="center">Cara Bayar</th>
            <th align="center">KG</th>
            <th align="center">Karton</th>
        </thead>
        <tbody>
                                          
            <?php $number=1;
            $idbayarprev=0;
            foreach ($beli as $model): 
                $idbayarprev= $model->idbayar; ?>
                <tr>
                    <td><?= $number++ ?></td>
                    <td><?= $model->supplier ?></td>
                    <td><?= $model->produk ?></td>
                    <td align="center"><?= $model->tgl_terima ?></td>
                    <td align="center"><?= $model->cara_terima ?></td>
                    <td align="center"><?= $model->cara_bayar ?></td>
                    <td align="center"><?= $model->kilo ?></td>
                    <td align="center"><?= $model->karton ?></td>
                    <td align="center"><?= Html::a('View', ['view', 'id' => $model->idbeli], ['class' => 'btn btn-primary']) ?></td>
                    <td align="center"><?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->idbeli], ['class' => 'btn btn-primary']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>    
    </table>
   </div>
</div>
