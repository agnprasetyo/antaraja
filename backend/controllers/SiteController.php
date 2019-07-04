<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use common\models\Driver;

/**
 * Site controller
 */
class SiteController extends Controller
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
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }


    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
      $data = [
         'Drivers' => Driver::find()
         ->orderBy(['tanggal' => SORT_ASC])
         ->all(),
      ];

      // echo "<pre>";print_r($data['Drivers']);exit;

       return $this->render('index', [
         'data' => $data,
       ]);
    }

    // {
	// 	$sql= Driver::find()
    //     ->select(['count(*)'])
    //     ->groupBy('tanggal')
    //     ->all();
    //
    //     // 'SELECT count(id),jenisKelamin FROM profile GROUP BY jenisKelamin';
    //
	// 	$dataProvider=new CSqlDataProvider($sql,[
    //                         'keyField' => 'id',
	// 	]);
    //
	// 	$this->render('index',[
	// 		'dataProvider'=>$dataProvider,
	// 	]);
	// }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {

            if (!Yii::$app->assign->isAdministrator()) {

                Yii::$app->user->logout();
            }

            return $this->goBack();

        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
