<?php

namespace backend\controllers;

use Yii;
use common\models\Driver;
use common\models\NoHp;
use common\models\MerkHp;
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
                    'delete-files' => ['POST'],
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
        // $model = Driver::find()
        // ->joinWith(['noHp'])
        // ->where(['noHp.id_driver' => $id]);

        $model = $this->findModel($id);

        // if (isset($_POST['hasEditable'])) {
        //     // use Yii's response format to encode output as JSON
        //     Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        //
        //     // read your posted model attributes
        //     if ($model->load($_POST)) {
        //         // read or convert your posted information
        //         $value = $model->nama;
        //
        //         $model->save(false);
        //         // return JSON encoded output in the below format
        //         return ['output'=>$value, 'message'=>''];
        //
        //         // alternatively you can return a validation error
        //         // return ['output'=>'', 'message'=>'Validation error'];
        //     }
        //     // else if nothing to do always return an empty JSON encoded output
        //     else {
        //         return ['output'=>'', 'message'=>''];
        //     }
        // }

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
                    Yii::$app->session->setFlash('success', 'Berhasil mendaftarkan driver dengan nama <strong>' . $model['Driver']->nama . '</strong>.');

                    return $this->redirect(['view', 'id' => $model['Driver']->id]);

                } else {
                    $transaction->rollBack();

                    Yii::$app->session->setFlash('error', 'Gagal  mendaftarkan driver <strong>' . $model['Driver']->nama . '</strong>.');
                }
            } catch (\yii\db\Exception $e) {
             $transaction->rollBack();

             Yii::$app->session->setFlash('error', 'Gagal  mendaftarkan driver <strong>' . $model['Driver']->nama . '</strong>.');
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
        $model['Driver'] = $this->findModel($id);
        // $model['NoHp'] = $this->findModel1($id_driver);
        // $model['MerkHp'] = MerkHp::find()->indexBy('id_driver')->all();

        $model['NoHp'] = new NoHp();
        $model['MerkHp'] = new MerkHp();

        if ($model['Driver']->load(Yii::$app->request->post()) && $model['NoHp']->load(Yii::$app->request->post()) && $model['MerkHp']->load(Yii::$app->request->post())) {
            $files = UploadedFile::getInstance($model['Driver'], 'files');

            if ($model['Driver']->validate() && $model['NoHp']->validate() && $model['MerkHp']->validate()) {
                $transaction = Yii::$app->db->beginTransaction();
                try {
                    $model['Driver']->tanggal = date('Y-m-d');

                    if (!empty($files))
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

                        if (!empty($files))
                            $files->saveAs( Yii::getAlias('@public') . '/uploads/files/' . $model['Driver']->files);

                        Yii::$app->session->setFlash('success', 'Berhasil mendaftarkan driver dengan nama <strong>' . $model['Driver']->nama . '</strong>.');

                        return $this->redirect(['view', 'id' => $model['Driver']->id]);

                    } else {
                        $transaction->rollBack();

                        Yii::$app->session->setFlash('error', 'Gagal  mendaftarkan driver <strong>' . $model['Driver']->nama . '</strong>.');
                    }
                } catch (\yii\db\Exception $e) {
                 $transaction->rollBack();

                 Yii::$app->session->setFlash('error', 'Gagal  mendaftarkan driver <strong>' . $model['Driver']->nama . '</strong>.');
                }
        }

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
        $model->save(false);

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
            if ($model->berkas == $model::BERKAS_DELETED) {
                throw new NotFoundHttpException('The requested page does not exist.');

            }
        }

        if ($model->load(Yii::$app->request->post())) {
              $files = UploadedFile::getInstance($model, 'files');

              if (!empty($files))
                  $model->files = $model->no_ktp.'.'.$files->extension;

              if($model->save()){
                if (!empty($files))
                  $files->saveAs(Yii::getAlias('@public').'/uploads/files/'.$model->files);

                return $this->redirect(['view-files', 'id' => $model->id]);
              }
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

        if(file_exists(Yii::getAlias('@public').'/uploads/files/'.$model->files))
          unlink(Yii::getAlias('@public').'/uploads/files/'.$model->files);

        $model->files = null;
        $model->save();

        Yii::$app->session->setFlash('error', 'Berhasil menghapus berkas pendaftar <strong>' . $model->nama . '</strong>.');

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
          if ($model->berkas !== $model::BERKAS_DELETED) {
              return $model;

          }
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    // protected function findModel($id, $id_driver)
    // {
    //     if (($model = Driver::findOne(['id' => $id_driver])) !== null) {
    //       // if ($model->berkas !== $model::BERKAS_DELETED) {
    //           return $model;
    //
    //       // }
    //     }
    //
    //     throw new NotFoundHttpException('The requested page does not exist.');
    // }
}
