<?php

/**
 * Created by PhpStorm.
 * User: vuchien
 * Date: 5/16/16
 * Time: 1:05 PM
 */

namespace app\modules\app433\controllers;

use Yii;
use app\modules\app433\models\Categories;
use app\modules\app433\services\CategoriesService;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

class CategoriesController extends Controller {

    private $categoriesService = null;
    public $layout = 'post';

    public function __construct($id, $module, $config = []) {
        $this->id = $id;
        $this->module = $module;
        $this->categoriesService = new CategoriesService();
        //parent::__construct($config);
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
                            'delete',
                            'view'
                        ],
                        'allow' => true,
                        'roles' => ['433_categories'],
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
        $service = new CategoriesService();

        //$result = Categories::find()->all();
        $result = $service->getListAll();
        return $this->render('index', array("listCategories" => $result));
    }

    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Categories model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Categories();
        $listCategories = new CategoriesService();
        $mes = "";
        if ($model->load(Yii::$app->request->post())) {

            $mes = $this->categoriesService->save($model);

            return $this->render('update', [
                        'model' => $model,
                        'categories' => $listCategories->findAllCategory(),
                        'mes' => $mes
            ]);
        } else {
            return $this->render('create', [
                        'model' => $model,
                        'categories' => $listCategories->findAllCategory(),
                        'mes' => $mes
            ]);
        }
    }

    /**
     * Updates an existing Categories model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {

        $model = $this->findModel($id);
        $listCategories = new CategoriesService();
        $mes = "";
        if ($model->load(\Yii::$app->request->post())) {
            $mes = $this->categoriesService->save($model);

            return $this->render('update', [
                        'model' => $model,
                        'categories' => $listCategories->findAllCategory(),
                        'mes' => $mes
            ]);
        } else {
            return $this->render('update', [
                        'model' => $model,
                        'categories' => $listCategories->findAllCategory(),
                        'mes' => $mes
            ]);
        }
    }

    /**
     * Deletes an existing Categories model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Categories model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Categories the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Categories::findOne($id)) !== null) {
            return $model;
        } else {

//            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
