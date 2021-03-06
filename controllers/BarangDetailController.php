<?php
namespace app\controllers;

use Yii;
use app\models\BarangDetail;
use app\models\BarangDetailSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;

/**
 * BarangDetailController implements the CRUD actions for BarangDetail model.
 */
class BarangDetailController extends Controller
{

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class'   => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all BarangDetail models.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BarangDetailSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render(
            'index',
            [
                'searchModel'  => $searchModel,
                'dataProvider' => $dataProvider,
            ]
        );
    }

    /**
     * Displays a single BarangDetail model.
     *
     * @param integer $id
     *
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render(
            'view',
            [
                'model' => $this->findModel($id),
            ]
        );
    }

    /**
     * Creates a new BarangDetail model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     *
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new BarangDetail();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render(
                'create',
                [
                    'model' => $model,
                ]
            );
        }
    }

    /**
     * Updates an existing BarangDetail model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param integer $id
     *
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render(
                'update',
                [
                    'model' => $model,
                ]
            );
        }
    }

    /**
     * Deletes an existing BarangDetail model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     *
     * @param integer $id
     *
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the BarangDetail model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param integer $id
     *
     * @return BarangDetail the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BarangDetail::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * @return string
     */
    public function actionItemBarcode()
    {
        $data = [];
        $modelDetail = new BarangDetail();
        $record = $modelDetail->findOne(
            ['id_barang' => Yii::$app->request->post('id_barang'), 'barcode' => Yii::$app->request->post('barcode')]
        );
        if ($record !== null) {
            $model = $record;
        } else {
            $model = $modelDetail;
        }
        $model->id_barang = Yii::$app->request->post('id_barang');
        $model->barcode = Yii::$app->request->post('barcode');
        if ($model->save(false)) {
            $data = ['msg' => 'Data Berhasil di simpan', 'redirect' => true];
        } else {
            $data = ['msg' => 'Data Gagal di simpan', 'redirect' => false];
        }
        return Json::encode($data);
    }
}
