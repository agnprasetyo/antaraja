<?php

namespace backend\controllers;

use Yii;
use common\models\Driver;
use backend\models\DriverSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

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
                    'terima' => ['POST'],
                    'tolak' => ['POST'],
                    'pending' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Driver models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DriverSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

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
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Driver model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Driver();

        if ($model->load(Yii::$app->request->post())) {
          $model->tanggal = date('Y-m-d');
          if ($model->save()) {
              Yii::$app->session->setFlash('success', 'Berhasil menambahkan pendaftar <strong>' . $model->nama . '</strong>.');

              return $this->redirect(['index']);
          } else {
              Yii::$app->session->setFlash('error', 'Gagal menambahkan pendaftar <strong>' . $model->nama . '</strong>.');
          }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Driver model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Driver model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        // $this->findModel($id)->delete();

        $model = $this->findModel($id);
        $model->berkas = $model::BERKAS_DELETED;
        $model->delete();

        Yii::$app->session->setFlash('success', 'Berhasil menghapus pendaftar <strong>' . $model->nama . '</strong>.');

        return $this->redirect(['index']);
    }

    /**
     *
     */
    public function actionTerima($id)
    {
        $model = $this->findModel($id);
        $model->berkas = $model::BERKAS_DITERIMA;
        $model->save(false);

        Yii::$app->session->setFlash('success', 'Berhasil menerima pendaftar <strong>' . $model->nama . '</strong>.');

        return $this->redirect(['index']);
    }

    /**
     *
     */
    public function actionTolak($id)
    {
        $model = $this->findModel($id);
        $model->berkas = $model::BERKAS_DITOLAK;
        $model->save(false);

        Yii::$app->session->setFlash('success', 'Berhasil menolak pendaftar <strong>' . $model->nama . '</strong>.');

        return $this->redirect(['index']);
    }

    /**
     *
     */
    public function actionPending($id)
    {
        $model = $this->findModel($id);
        $model->berkas = $model::BERKAS_PENDING;
        $model->save(false);

        Yii::$app->session->setFlash('success', 'Berhasil mengubah pendaftar <strong>' . $model->nama . '</strong>.');

        return $this->redirect(['index']);
    }

    /**
     *
     */
    public function actionFiles($id)
    {
        if (($model = Driver::findOne($id)) !== null) {
            if ($model->status == $model::BERKAS_DELETED) {
                throw new NotFoundHttpException('The requested page does not exist.');

            }
        }
        if ($model->load(Yii::$app->request->post())) {
              $file = \yii\web\UploadedFile::getInstance($model, 'files');
              if (!empty($file))
                  $model->files = $file;

              if($model->save())
              {

                if (!empty($file))
                  $file->saveAs( Yii::getAlias('@root') .'uploads/files/'. $model->nama .'-'.$model->files->extension);

                return $this->redirect(['view-files', 'id' => $model->id]);
              }
              return $this->render('files', ['model' => $model]);
        } else {
            return $this->render('files', ['model' => $model]);
        }
        // echo "<pre>";print_r($files);exit();

        return $this->render('files', [
            'model' => $model,
        ]);
    }

    /**
     *
     */
    public function actionViewFiles($id)
    {
        $model = $this->findModel($id);

        return $this->render('view-files', [
            'model' => $model,
        ]);
    }

    /**
     *
     */
    public function actionDeleteFiles($id)
    {
        $model = $this->findModel($id);
        if(file_exists(Yii::getAlias('@root') . 'uploads/files/'. $model->files))
          unlink(Yii::getAlias('@root') . 'uploads/files/'. $model->files);
        $model->delete();

        Yii::$app->session->setFlash('error', 'Berhasil menghapus berkas verifikasi pendaftar <strong>' . $model->nama . '</strong>.');

        // return $this->redirect(['view', 'id' => $model->nama]);
        return $this->redirect(['index']);
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
          if ($model->status !== $model::BERKAS_DELETED) {

              return $model;
          }
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
