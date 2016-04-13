<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Pengguna */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Pengguna'];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengguna-view">

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->username], ['class' => 'btn btn-primary']) ?>
        
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'username',
            'nama',
            
            'role',
        ],
    ]) ?>

</div>
