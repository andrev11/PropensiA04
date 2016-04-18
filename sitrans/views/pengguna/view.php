<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Pengguna */

$this->title = Yii::t('app', ' {modelClass}: ', [
    'modelClass' => 'Pengguna',
]) . ' ' . $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Pengguna'];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengguna-view">

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->username], ['class' => 'btn btn-primary']) ?>
        <?php if (Yii::$app->user->identity->role == 'admin') {
			echo Html::a(Yii::t('app', 'Reset Password'), ['resetpassadmin', 'username' => $model->username], 
			['class' => 'btn btn-primary', 'data' => ['confirm' => 'Are you sure you want to reset password ?', 'method' => 'post',],]);
		}
		?>
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
