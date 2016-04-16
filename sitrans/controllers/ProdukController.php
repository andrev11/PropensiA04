<?php

namespace app\controllers;

use Yii;
use app\models\Produk;
use app\models\ProdukSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use mPDF;
use app\controllers\SiteController;
use app\models\Jenis;

/**
 * ProdukController implements the CRUD actions for Produk model.
 */
class ProdukController extends Controller
{
    public function beforeAction($action)
        {
		if (Yii::$app->user->isGuest){
			return $this->redirect(Yii::$app->user->loginUrl);
		} else if (Yii::$app->user->identity->role == 'admin'){
			return $this->redirect(Yii::$app->user->loginUrl);
		} else {
			return true;
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
     * Lists all Produk models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProdukSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Produk model.
     * @param integer $idmerk
     * @param integer $idjenis
     * @param string $lokasi
     * @return mixed
     */
    public function actionView($idmerk, $idjenis, $lokasi)
    {
        return $this->render('view', [
            'model' => $this->findModel($idmerk, $idjenis, $lokasi),
        ]);
    }

    /**
     * Creates a new Produk model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {   
        $model = new Produk();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'idmerk' => $model->idmerk, 'idjenis' => $model->idjenis, 'lokasi' => $model->lokasi]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
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
<?php include "../views/produk/_reportView.php";//The php page you want to convert to pdf
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
            return $this->redirect(['view', 'idmerk' => $model->idmerk, 'idjenis' => $model->idjenis, 'lokasi' => $model->lokasi]);
        } else {
            return $this->render('print', [
                'model' => $model,
            ]);
        }

        */
    }
    /**
     * Updates an existing Produk model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $idmerk
     * @param integer $idjenis
     * @param string $lokasi
     * @return mixed
     */
    public function actionUpdate($idmerk, $idjenis, $lokasi)
    {
         echo SiteController::connect(); 
         $model = $this->findModel($idmerk, $idjenis, $lokasi);   
            
         $idjenis=$model->idjenis;
         $currentStokkiloJenis = pg_fetch_array(pg_query("select stok_kilo from jenis where idjenis =".$idjenis.";"));
         $currentStokkartonJenis = pg_fetch_array(pg_query("select stok_karton from jenis where idjenis =".$idjenis.";"));
         $currentkiloProduk=$model->kilo;
         $currentkartonProduk=$model->karton;
        
    
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $kiloupdated=$model->kilo;
            $kartonupdated=$model->karton;
            $updatekilo=$currentkiloProduk-$kiloupdated;
            $updatekarton=$currentkartonProduk-$kartonupdated;
            $stokcurrentkilo= $currentStokkiloJenis[0];
            $stokcurrentkarton= $currentStokkartonJenis[0]; 
            $updatestokkilo=$stokcurrentkilo - $updatekilo;
            $updatestokkarton=$stokcurrentkarton - $updatekarton;
            $updateQueryKilo="update jenis  set stok_kilo=".$updatestokkilo." where idjenis =".$idjenis.";";
            $updateQueryKarton="update jenis  set stok_karton=".$updatestokkarton." where idjenis =".$idjenis.";";
            pg_query($updateQueryKilo);
            pg_query($updateQueryKarton);           
           
            return $this->redirect(['view', 'idmerk' => $model->idmerk, 'idjenis' => $model->idjenis, 'lokasi' => $model->lokasi]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Produk model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $idmerk
     * @param integer $idjenis
     * @param string $lokasi
     * @return mixed
     */
    public function actionDelete($idmerk, $idjenis, $lokasi)
    {
        $this->findModel($idmerk, $idjenis, $lokasi)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Produk model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $idmerk
     * @param integer $idjenis
     * @param string $lokasi
     * @return Produk the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($idmerk, $idjenis, $lokasi)
    {
        if (($model = Produk::findOne(['idmerk' => $idmerk, 'idjenis' => $idjenis, 'lokasi' => $lokasi])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
