<?php

namespace frontend\controllers;

use Yii;
use common\models\UploadFiles;
use common\models\Driver;
use frontend\models\DriverSearch;
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
            Yii::$app->session->setFlash('success', 'Berhasil mendaftar sebagai driver dengan nama <strong>' . $model->nama . '</strong>.');

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            Yii::$app->session->setFlash('error', 'Gagal  mendaftar sebagai driver <strong>' . $model->nama . '</strong>.');
        }
        if ($model->save()) {
          return $this->redirect(['view', 'id' => $model->id]);
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
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }


    /**
     *
     */
    public function actionFiles($id)
    {
        if (($model = UploadFiles::findOne($id)) !== null) {
            if ($model->status == $model::BERKAS_DELETED) {

                throw new NotFoundHttpException('The requested page does not exist.');
            }
        }

        if ($model->load(Yii::$app->request->post())) {
            $files = UploadedFile::getInstances($model, 'files');

            if ($model->save(false)) {
                if (is_file(Yii::getAlias($model::DIR_FILES) . '/' . $model->files)) {
                    @unlink(Yii::getAlias($model::DIR_FILES) . '/' . $model->files);
                }
                $files[0]->saveAs(Yii::getAlias($model::DIR_FILES) . '/' . $model->files);

                Yii::$app->session->setFlash('success', 'Berhasil mengunggah berkas verifikasi pendaftar <strong>' . $model->nama . '</strong>.');

                return $this->redirect(['view-files', 'id' => $id]);
            }
        }

        return $this->render('files', [
            'model' => $model,
        ]);
    }

    // /**
    //  *
    //  */
    // public function actionFiles($id)
    // {
    //       $model = new UploadFiles();
    //
    //       //Set the path that the file will be uploaded to
    //       $path = Yii::getAlias('@frontend') .'/web/upload/'
    //
    //       if (Yii::$app->request->isPost) {
    //           $model->file = UploadedFile::getInstance($model, 'file');
    //
    //           if ($model->file && $model->validate()) {
    //               $model->file->saveAs($path . $model->file->baseName . '.' . $model->file->extension);
    //           }
    //       }
    //
    //       return $this->renderPartial('index', ['model' => $model]);
    // }

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

        if (is_files(Yii::getAlias($model::DIR_FILES) . '/' . $model->files)) {
            @unlink(Yii::getAlias($model::DIR_FILES) . '/' . $model->files);
        }

        $model->berkas = null;
        $model->save(false);

        Yii::$app->session->setFlash('error', 'Berhasil menghapus berkas verifikasi pendaftar <strong>' . $model->nama . '</strong>.');

        return $this->redirect(['view', 'id' => $model->nama]);
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
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
