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
         'Driver' => (int) Driver::find()->count(),
      ];

      // echo "<pre>";print_r(array_values($data));exit;
      $series = [['name' => 'AntarAja', 'data' => array_values($data)]];

       return $this->render('index', [
         'categories' => array_keys($data),
         'series'  => $series,
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
