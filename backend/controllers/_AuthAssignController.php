<?php

namespace app\controllers;

use Yii;
use common\models\AuthAssign;
use backend\models\searchs\AuthAssign as AuthAssignSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * AuthAssignController implements the CRUD actions for AuthAssign model.
 */
class AuthAssignController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => Yii::$app->assign->isAdministrator(),
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all AuthAssign models.
     * @return mixed
     */
    public function actionIndex($assign)
    {
        $searchModel = new AuthAssignSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $assign);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new AuthAssign model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($assign)
    {
        $model = new AuthAssign();

        if ($model->load(Yii::$app->request->post())) {

            $model->assign = $assign;

            if ($model->save()) {

                Yii::$app->session->setFlash('success', 'Berhasil menambahkan <strong>' . $assign . '</strong>.');

                return $this->redirect(['index', 'assign' => $assign]);
            } else {
                Yii::$app->session->setFlash('error', 'Gagal menambahkan <strong>' . $assign . '</strong>.');
            }

        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing AuthAssign model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model  = $this->findModel($id);
        $assign = $model->assign;
        $model->delete();

        Yii::$app->session->setFlash('success', 'Berhasil menghapus <strong>' . $model->assign . '</strong>.');

        return $this->redirect(['index', 'assign' => $assign]);
    }

    /**
     * Finds the AuthAssign model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AuthAssign the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AuthAssign::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
