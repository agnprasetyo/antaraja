<?php

namespace frontend\controllers;

use Yii;
use common\models\Driver;
use common\models\NoHp;
use common\models\MerkHp;
use frontend\models\DriverSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\web\Response;
use yii\helpers\Json;

/**
 * DriverController implements the CRUD actions for Driver model.
 */
class DriverController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Driver models.
     * @return mixed
     */
    public function actionIndex($q = null)
    {
     $searchModel = new DriverSearch();
     $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $q);

     if (Yii::$app->request->isAjax) {
         Yii::$app->response->format = Response::FORMAT_JSON;

         return $this->renderAjax('index_ajax', [
             'searchModel' => $searchModel,
             'dataProvider' => $dataProvider,
         ]);
     }

     return $this->render('index', [
         'searchModel' => $searchModel,
         'dataProvider' => $dataProvider,
     ]);
    }

    /**
     * Displays a single Driver model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new Driver model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model['Driver'] = new Driver();
        $model['NoHp'] = new NoHp();
        $model['MerkHp'] = new MerkHp();

        if ($model['Driver']->load(Yii::$app->request->post()) && $model['NoHp']->load(Yii::$app->request->post()) && $model['MerkHp']->load(Yii::$app->request->post())) {
            $files = UploadedFile::getInstance($model['Driver'], 'files');

            // if ($model['Driver']->validate() && $model['NoHp']->validate() && $model['MerkHp']->validate()) {
                $transaction = Yii::$app->db->beginTransaction();
                try {
                    $model['Driver']->tanggal = date('Y-m-d');
                    $model['Driver']->files   = $model['Driver']->no_ktp . '.' . $files->extension;

                    $flag = $model['Driver']->save();

                    if ($flag) {
                        $model['MerkHp']->id_driver = $model['Driver']->id;

                        $flag = $model['MerkHp']->save();

                        if ($flag) {
                            $nomer2 = $model['NoHp']->nomer2;

                            $model['NoHp']->id_driver = $model['Driver']->id;
                            $model['NoHp']->nomer = $model['NoHp']->nomer1;

                            $flag = $model['NoHp']->save();

                            if ($nomer2 && $flag) {
                                $modelNoHp = new NoHp();
                                $modelNoHp->id_driver = $model['Driver']->id;
                                $modelNoHp->nomer     = $nomer2;
                                $modelNoHp->type      = $modelNoHp::TYPE_ALTERNATIF;

                                $flag = $modelNoHp->save(false);
                            }
                        }
                    }

                    if ($flag) {
                        $transaction->commit();

                        $files->saveAs( Yii::getAlias('@public') . '/uploads/files/' . $model['Driver']->files);
                        Yii::$app->session->setFlash('success', '<div class="container">Berhasil mendaftar sebagai driver dengan nama <strong>' . $model['Driver']->nama . '</strong>.</div>');

                        // return $this->redirect(['view', 'id' => $model['Driver']->id]);
                        return $this->redirect(['../public']);

                    } else {
                        $transaction->rollBack();

                        Yii::$app->session->setFlash('error', 'Gagal  mendaftar sebagai driver <strong>' . $model['Driver']->nama . '</strong>.');
                    }
                } catch (\yii\db\Exception $e) {
                 $transaction->rollBack();

                 Yii::$app->session->setFlash('error', 'Gagal  mendaftar sebagai driver <strong>' . $model['Driver']->nama . '</strong>.');
                }
        // }

    }

    return $this->renderajax('create', [
       'model' => $model,
    ]);
 }


    /**
     * Finds the Driver model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Driver the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Driver::findOne($id)) !== null) {
            if ($model->berkas !== $model::BERKAS_DELETED) {

                return $model;
            }
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
