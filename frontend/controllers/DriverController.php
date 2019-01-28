<?php

namespace frontend\controllers;

use Yii;
use common\models\Driver;
use common\models\UploadFiles;
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

        $dataName = $model->nama;
        $file = \yii\web\UploadedFile::getInstance($model, 'files');
        if (!empty($file))
            $model->files = $file;

        if ($model->save()) {
            if (!empty($file))
                $file->saveAs( Yii::getAlias('@webroot') .'/uploads/files/'.$model->id.'-'.$model->nama.'.'.$model->files->extension);

            Yii::$app->session->setFlash('success', 'Berhasil mendaftar sebagai driver dengan nama <strong>' . $model->nama . '</strong>.');

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            Yii::$app->session->setFlash('error', 'Gagal  mendaftar sebagai driver <strong>' . $model->nama . '</strong>.');
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

        if ($model->load(Yii::$app->request->post())){
            $dataName = $model->nama;
            $file = \yii\web\UploadedFile::getInstance($model, 'files');
            if (!empty($file)){
                $delete = $model->oldAttributes['files'];
                $model->files= $file;
            }else{
                $model->files = $model->oldAttributes['files'];
            }

            if($model->save()){
                if (!empty($file))
                    $file->saveAs( Yii::getAlias('@webroot') .'/uploads/files/'.$model->id.'-'.$model->nama.'.'.$model->files->extension);

                Yii::$app->session->setFlash('success', 'Berhasil mengupdate data driver dengan nama <strong>' . $model->nama . '</strong>.');

                return $this->redirect(['view', 'id' => $model->id]);
            }
            Yii::$app->session->setFlash('error', 'Gagal  mendaftar sebagai driver <strong>' . $model->nama . '</strong>.');
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
        $model = $this->findModel($id);
        if(file_exists(Yii::getAlias('@webroot').'/uploads/files/'.$model->id.'-'.$model->nama.'.'.$model->files))
        unlink(Yii::getAlias('@webroot').'/uploads/files/'.$model->id.'-'.$model->nama.'.'.$model->files);
        $model->delete();

        return $this->redirect(['index']);
    }

    // /**
    //  *
    //  */
    // public function hasFiles($id)
    // {
    //     $model = static::findOne($id);
    //
    //     return $model ? (bool) $model->files : false;
    // }

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
