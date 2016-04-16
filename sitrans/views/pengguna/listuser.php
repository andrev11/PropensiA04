<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\db\Query;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pengguna';
$this->params['breadcrumbs'][] = $this->title;
       
?>


		<div class="pembelian-index2">

		   <p>
				<?= Html::a('Create Pengguna', ['create'], ['class' => 'btn btn-success']) ?>
			</p>
			
			<div id="w0" class="grid-view">
				<table class="table table-striped table-bordered">
					<thead>
						<!-- <th> idbeli </th> -->
						<!-- <th> idbayar </th>-->
						<th align="center">Username</th>
						<th align="center">Nama</th>
						<th align="center">Password</th>
						<th align="center">Role</th>

					</thead>
					<tbody>
						<?php foreach ($user as $model): ?>
							<tr>

								<td><?= $model->username ?></td>
								<td><?= $model->nama ?></td>
								<td ><?= md5($model->password) ?></td>
								<td ><?= $model->role ?></td>
								<td ><?= Html::a(Yii::t('app', 'Reset Password'), ['resetpassadmin', 'username' => $model->username], 
									['class' => 'btn btn-primary', 
									'data' => [
										'confirm' => 'Are you sure you want to reset password ?',
										'method' => 'post',
									],
								])
								 ?></td>
							</tr>
						<?php endforeach; ?>
					</tbody>    
				</table>
			</div>
		</div>


