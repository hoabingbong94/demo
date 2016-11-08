<?php

namespace app\modules\saoplus\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use app\modules\saoplus\models\Videos;
use app\modules\saoplus\services\VideosService;
use app\modules\saoplus\services\CategoriesService;

class VideosController extends Controller {

    public $layout = 'site';
    public $videos = null;
    public $categories = null;

    public function __construct($id, $module, $config = array()) {
        parent::__construct($id, $module, $config);
        $this->videos = new VideosService();
        $this->categories = new CategoriesService();
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
                        'roles' => ['saoplus_video'],
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
        $request = \Yii::$app->request;
        $param['keyword'] = $request->getQueryParam('keyword', '');
        $param['CategoriesID'] = $request->get('CategoriesID');
        $param['status'] = $request->get('status');
        $param['page'] = $request->get('page');
        $admin = $this->videos->getFullname();
        $model = $this->videos->findAll($param);
        $categories = $this->categories->getListAll();
        $listPar = $this->categories->FillRoot();
//        echo "<pre>";
//        print_r($listPar[186]);
//        die;
        return $this->render('index', ['model' => $model,
                    'param' => $param,
                    'categories' => $categories,
                    'admin' => $admin,
                    'listPar' => $listPar,
        ]);
    }

    public function actionCreate() {
        try {
            /*
             * Khởi tạo đối tượng vì form create là form in ra đối tượng chứ không phải mảng
             */
            $model = new Videos();
//            echo "<pre>"; print_r($model);die();
            $listParent = $this->categories->FillRoot();
            $model->Status = 1;
            if ($model->load(Yii::$app->request->post())) {
                $save = $this->videos->saveData($model, $_POST);
                if ($save) {
                    $this->redirect('index');
                }
            }
            $model->scenario = 'create';
            return $this->render('_form', [
                        'model' => $model,
                        'listParent' => $listParent,]);
        } catch (Exception $ex) {
            echo "Loi" . $ex->getTraceAsString();
        }
    }

    public function actionUpdate($id) {
        try {
            $request = \Yii::$app->request;
            $id = $request->get('id');
            $model = Videos::find()->where(['ID' => $id])->one();
            $listParent = $this->categories->FillRoot();
            if ($model->load(Yii::$app->request->post())) {
                $save = $this->videos->saveData($model, $_POST);
                if ($save) {
                    $this->redirect(['index']);
                }
            }
            return $this->render('_form', [
                        'model' => $model,
                        'listParent' => $listParent
            ]);
        } catch (Exception $ex) {
            echo "Loi" . $ex->getTraceAsString();
        }
    }

}
