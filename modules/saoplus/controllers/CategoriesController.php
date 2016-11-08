<?php

namespace app\modules\saoplus\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use app\modules\saoplus\models\Categories;
use app\modules\saoplus\services\CategoriesService;

class CategoriesController extends Controller {

    public $layout = 'site';
    public $Categories = null;

    public function __construct($id, $module, $config = array()) {
        parent::__construct($id, $module, $config);
        $this->Categories = new CategoriesService();
    }

    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => [
                            'index',
                            'create',
                            'update',
                            'delete'
                        ],
                        'allow' => true,
                        'roles' => ['saoplus_categories'],
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

    public function actionIndex() {
        $model = $this->Categories->getListAll();
        return $this->render('index', ['listCategories' => $model]);
    }

    public function actionCreate() {
        try {
            $model = new Categories ();
            $listCategories = $this->Categories->FillRoot();
            if ($model->load(Yii::$app->request->post())) {
                $save = $this->Categories->saveData($model, $_POST);
                if ($save) {
                    return $this->redirect(['index',
                                'model' => $model,
                    ]);
                }
            }
            return $this->render('form', [
                        'model' => $model,
                        'listCategories' => $listCategories
            ]);
        } catch (Exception $ex) {
            echo "Loi" . $ex->getTraceAsString();
        }
    }

    public function actionUpdate($id) {
        try {
            $model = new Categories();
            $request = \Yii::$app->request;
            $id = $request->get('id');
            $model = Categories::find()->where(['ID' => $id])->one();
            $listCategories = $this->Categories->FillRoot();
            if ($model->load(Yii::$app->request->post())) {
                $save = $this->Categories->saveData($model, $_POST);
                if ($save) {
                    return $this->redirect(['index',
                                'model' => $model,
                    ]);
                }
            }
            return $this->render('form', [
                        'model' => $model,
                        'listCategories' => $listCategories
            ]);
        } catch (Exception $ex) {
            echo "Loi" . $ex->getTraceAsString();
        }
    }

}
