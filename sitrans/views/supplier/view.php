<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Supplier */

$this->title = Yii::t('app', 'ID {modelClass}: ', [
    'modelClass' => 'Supplier',
]) . ' ' . $model->idsupplier;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Suppliers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="supplier-view">

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->idsupplier], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idsupplier',
            'namasupplier',
            'telponsupplier',
            'alamatsupplier',
            'no_rekening',
        ],
    ]) ?>

</div>
