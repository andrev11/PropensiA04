<?php

namespace app\controllers;

use Yii;
use app\models\PembayaranIn;
use app\models\PembayaranInSearch;
use app\models\PembelianSearch;
use yii\data\ActiveDataProvider;
use app\controllers\SiteController;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PembayaranInController implements the CRUD actions for PembayaranIn model.
 */
class PembayaranInController extends Controller
{
    public function beforeAction($action)
        {
        if (Yii::$app->user->isGuest){
            return $this->redirect(Yii::$app->user->loginUrl);
        } else if (Yii::$app->user->identity->role == 'finance' || Yii::$app->user->identity->role == 'bod'){
            return true;
        } else {
            return $this->redirect(Yii::$app->user->loginUrl);
        }
    }

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all PembayaranIn models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PembayaranInSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
         $dataProvider ->setSort([
            'defaultOrder' => ['tgl_trans'=>SORT_DESC],
            ]);
		if (!\Yii::$app->user->isGuest && Yii::$app->user->identity->role == 'finance'){
			return $this->render('index', [
				'searchModel' => $searchModel,
				'dataProvider' => $dataProvider,
			]);
		} else {
            return $this->redirect(Yii::$app->user->loginUrl);
        }
    }

    public function actionIndex2()
    {
            $piutang = PembayaranIn::find()
                ->where("status_bayar= 'Piutang'")
                ->andWhere(['not', ['jumlahbayar' => null]])
                ->orderBy(['tgl_trans' => SORT_ASC])
                ->all();
		if (!\Yii::$app->user->isGuest && Yii::$app->user->identity->role == 'finance'){
            return $this->render('index2', [
                'piutang' => $piutang,
            ]);
		} else {
            return $this->redirect(Yii::$app->user->loginUrl);
        }
    }


    public function actionIndex3()
    {
        /**
        $dataProvider = new ActiveDataProvider([
            'query' => PembayaranOut::find(),
        ]);

        return $this->render('index2', [
            'dataProvider' => $dataProvider,
        ]);
        **/
        /**
            $rekap = PembayaranIn::find()
                ->where("status_bayar= 'Lunas'")
                ->andWhere("EXTRACT(MONTH FROM tgl_bayar) = 4")
                ->andWhere("EXTRACT(YEAR FROM tgl_bayar) = 2016")
                ->orderBy(['tgl_bayar' => SORT_ASC])
                ->all();
	**/
		if (!\Yii::$app->user->isGuest && Yii::$app->user->identity->role == 'bod'){
            return $this->render('index3');
		} else {
            return $this->redirect(Yii::$app->user->loginUrl);
        }
    }    
    /**
     * Displays a single PembayaranIn model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Updates an existing PembayaranIn model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idbayar]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing PembayaranIn model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionConfirm($id)
    {
             echo SiteController::connect();
             $tglBayar = date('Y-m-d'); 
            $ubahStatus = "UPDATE PEMBAYARAN_IN SET status_bayar = 'Lunas' WHERE idbayar = '".$id."';";
            $ubahTanggal = "UPDATE PEMBAYARAN_IN SET tgl_bayar = '".$tglBayar."' WHERE idbayar = '".$id."';";
            $masukin = pg_query($ubahStatus);
            $masukin2 = pg_query($ubahTanggal);

                return $this->render('view', [
                        'model' => $this->findModel($id),
                    ]);
    }

    /**
     * Finds the PembayaranIn model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PembayaranIn the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PembayaranIn::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
