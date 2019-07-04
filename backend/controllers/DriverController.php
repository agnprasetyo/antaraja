<?php

namespace backend\controllers;

use Yii;
use common\models\Driver;
use common\models\NoHp;
use common\models\MerkHp;
use backend\models\DriverSearch;
use backend\models\DriverForm;
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
        if (($modelDefault = Driver::findOne($id)) !== null) {
            if ($modelDefault->flag == $modelDefault::FLAG_DELETED) {
                throw new NotFoundHttpException('The requested page does not exist.');
            }
        }

        $model = new DriverForm();
        
        if ($model->load(Yii::$app->request->post())) {
            $model->_files = UploadedFile::getInstance($model, '_files');

            $flag = $model->updateRecord($id);

            if ($flag == 3) {
                Yii::$app->session->setFlash('success', 'Berhasil.');

                return $this->redirect(['view', 'id' => $modelDefault->id]);

            } else if ($flag == 2) {
                Yii::$app->session->setFlash('error', 'Gagal Merk.');
            } else if ($flag == 1) {
                Yii::$app->session->setFlash('error', 'Gagal No Hp.');
            }
        }

        $model->_nama = $modelDefault->nama;
        $model->_email = $modelDefault->email;
        $model->_no_rek_mandiri = $modelDefault->no_rek_mandiri;
        $model->_alamat_ktp = $modelDefault->alamat_ktp;
        $model->_alamat_tinggal = $modelDefault->alamat_tinggal;
        $model->_no_ktp = $modelDefault->no_ktp;
        $model->_no_sim = $modelDefault->no_sim;
        $model->_merk_motor = $modelDefault->merk_motor;
        $model->_nomer1 = $modelDefault['noHps'][0]->nomer;
        $model->_merk = $modelDefault['merkHps'][0]->merk;
        $model->_nopol_kendaraan = $modelDefault->nopol_kendaraan;
        $model->_nomer2 = $modelDefault['noHps'][1]->nomer;
        $model->_type = $modelDefault['merkHps'][0]->type;
        $model->_ojol = $modelDefault->ojol;
        $model->_usia = $modelDefault->usia;
        $model->_pekerjaan = $modelDefault->pekerjaan;
        $model->_pendidikan = $modelDefault->pendidikan;
        $model->_jenis_kelamin = $modelDefault->jenis_kelamin;
        $model->_status = $modelDefault->status;
        // $model->_files = $modelDefault->files;

        return $this->render('update', [
            'model' => $model,
            'modelDefault' => $modelDefault
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
        $model->flag = $model::FLAG_DELETED;
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
        $model->flag = $model::FLAG_DITERIMA;
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
        $model->flag = $model::FLAG_DITOLAK;
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
        $model->berkas = $model::FLAG_PENDING;
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
            if ($model->flag == $model::FLAG_DELETED) {
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

        
        // $model->_nomer1 = $modelDefault['noHps'][0]->nomer;
        // $model->_merk = $modelDefault['merkHps'][0]->merk;
        // $model->_nopol_kendaraan = $modelDefault->nopol_kendaraan;
        // $model->_nomer2 = $modelDefault['noHps'][1]->nomer;
        // $model->_type = $modelDefault['merkHps'][0]->type;

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
          if ($model->flag !== $model::FLAG_DELETED) {
              return $model;

          }
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
