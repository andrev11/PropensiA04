<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Customer */

$this->title = Yii::t('app', 'ID {modelClass}: ', [
    'modelClass' => 'Customer',
]) . ' ' . $model->idcustomer;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Customer'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customer-view">

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->idcustomer], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idcustomer',
            'namacustomer',
            'telponcustomer',
            'alamatcustomer',
        ],
    ]) ?>

</div>
