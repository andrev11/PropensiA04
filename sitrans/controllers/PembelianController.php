<?php

namespace app\controllers;

use Yii;
use app\models\Pembelian;
use app\models\PembelianSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\Query;
use mPDF;
/**
 * PembelianController implements the CRUD actions for Pembelian model.
 */
class PembelianController extends Controller
{
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
     * Lists all Pembelian models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PembelianSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionIndex2()
    {
      /**
        //$myHost = "localhost";
        //$myUser = "postgres";
        //$myPassword = "1234";
        //$myPort = "5432";
        $blm = "Belum Diterima";
        // Create connection
        //$connection = new \yii\db\Connection(["host = ".$myHost." user = ".$myUser." password = ".$myPassword." port = ".$myPort." dbname = sitrans" ]);
        
        //$conn = "host = ".$myHost." user = ".$myUser." password = ".$myPassword." port = ".$myPort." dbname = sitrans";
            // Check connection
          //  if (!$database = pg_connect($conn)) {
            //    die("Connection failed");
            //}
        //$connection = new \Yii::$app->db;
        //$connection-> open();
        //$command = $connection->createCommand('SELECT * FROM PEMBELIAN P, PEMBAYARAN_OUT B, SUPPLIER S WHERE P.idbayar=B.idbayar AND S.namasupplier = B.supplier AND P.status_del="'.$blm.'";');     
        //$result = $command->queryAll();

        $dataProvider = new ActiveDataProvider([
            'query' => Pembelian::find()
                      ->WHERE ("status_del= 'Belum Diterima'")
                      ->all()
        ]);
      **/

      $beli2 = Pembelian::find()
          ->where("status_del= 'Belum Diterima'")
          ->all();
        return $this->render('index2', [
            'beli2' => $beli2,
        ]);

    }

    /**
     * Displays a single Pembelian model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionPrint()
    {  

         // get your HTML raw content without any layouts or scripts
    //$content = $this->renderPartial('_reportView');

   ini_set('memory_limit','3000M');//extending php memory
    $pdf=new mPDF('win-1252','A4','','',15,10,16,10,10,10);//A4 size page in landscape orientation
    date_default_timezone_set("Asia/Bangkok");
    $pdf->SetHeader(date('H:i:s'));
    $pdf->setFooter('{PAGENO}');
    $pdf->useOnlyCoreFonts = true;    // false is default
    //$mpdf->SetWatermarkText("any text");
    //$mpdf->showWatermarkText = true;
    //$mpdf->watermark_font = 'DejaVuSansCondensed';
    //$mpdf->watermarkTextAlpha = 0.1;
    $pdf->SetDisplayMode('fullpage');
    //$pdf->SetWatermarkImage('logo.png');
    //$pdf->showWatermarkImage = true;

    // setup kartik\mpdf\Pdf component
    //$pdf = new mPDF('utf-8', 'A4');
    //$pdf->allow_charset_conversion = true;
    //$pdf->WriteHTML('$html');

    // Buffer the following html with PHP so we can store it to a variable later
ob_start();
?>
<?php include "../views/pembelian/_reportPembelian.php";//The php page you want to convert to pdf
 // asasas?>

<?php 
$html = ob_get_contents();

ob_end_clean();

// send the captured HTML from the output buffer to the mPDF class for processing

$pdf->WriteHTML($html);
//$mpdf->SetProtection(array(), 'mawiahl', 'password');//for password protecting your pdf



    // return the pdf output as per the destination setting
     $pdf->Output(); 

      /*  $model = new Produk();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'idmerk' => $model->idmerk, 'idsupplier' => $model->idsupplier, 'idjenis' => $model->idjenis, 'lokasi' => $model->lokasi]);
        } else {
            return $this->render('print', [
                'model' => $model,
            ]);
        }

        */
    }

    /**
     * Creates a new Pembelian model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Pembelian();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idbeli]);
        } else {
            return $this->render('createpembelian', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Pembelian model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idbeli]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Pembelian model.
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
        //$model = $this->findModel($id);

        //if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //return $this->redirect(['view', 'id' => $model->idbeli]);
      
            $myHost = "localhost";
            $myUser = "postgres";
            $myPassword = "1234";
            $myPort = "5432";
            // Create connection
            $conn = "host = ".$myHost." user = ".$myUser." password = ".$myPassword." port = ".$myPort." dbname = sitrans";
            // Check connection
            if (!$database = pg_connect($conn)) {
                die("Connection failed");
            }
            
            //$ambilStatus = "SELECT status_del FROM pembelian WHERE idbeli = '".$id."';";
            $ubahStatus = "UPDATE PEMBELIAN SET status_del = 'Diterima' WHERE idbeli = '".$id."';";
            $masukin = pg_query($ubahStatus);


                return $this->render('view', [
                        'model' => $this->findModel($id),
                    ]);




       // } else {
        //    return $this->render('confirm', [
                //'model' => $model,
        //    ]);
        //}
    }

    /**
     * Finds the Pembelian model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Pembelian the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Pembelian::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
