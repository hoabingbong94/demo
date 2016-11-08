<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\modules\app90phut\controllers;

use app\modules\app90phut\models\Category;
use app\modules\app90phut\services\CategoryService;
use Yii;
use yii\data\Pagination;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

class CategoryController extends Controller {

    public $layout = 'post';

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
                            'nopublich',
                            'all'
                        ],
                        'allow' => true,
                        'roles' => ['90phut_category_news'],
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
        $service = new CategoryService();

       
        $listCategory = $service->getAllCategoryActive();
        
        return $this->render('index', [
                    'listCategory' => $listCategory,
        ]);
    }

    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $service = new CategoryService();
        $mes = '';
        $listParent = $service->FillRoot();
        
        if ($model->load(\Yii::$app->request->post())) {
            try {
                if($model->save())
                {   
                    return $this->redirect("/app90phut/category");
                }    
            } catch (Exception $exc) {
                echo "Loi :" . $exc->getTraceAsString();
            }
        } else
            return $this->render("update", array('model' => $model, 'mes' => $mes, 'listParent' => $listParent));
    }

    public function actionCreate() {
        try {

            $model = new Category();
            $service = new CategoryService();
            $mes = '';
            $listParent = $service->FillRoot();
            // $this->layout = 'post';

            if ($model->load(\Yii::$app->request->post())) {
                $model->ExtendAllowGet = 1;
                $model->ShowHome = 0;
                $mes = $model->save();
                return $this->render("update", array('model' => $model, 'mes' => $mes, 'listParent' => $listParent));
            } else
                return $this->render("create", array('model' => $model, 'mes' => $mes, 'listParent' => $listParent));
        } catch (Exception $exc) {
            echo "Loi :" . $exc->getTraceAsString();
        }
    }

       
    protected function findModel($id) {
        if (($model = Category::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
