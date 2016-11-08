<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\modules\app90phut\controllers;

use app\modules\app90phut\models\CategoryVideo;
use app\modules\app90phut\services\CategoryVideoService;
use Yii;
use yii\data\Pagination;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

class CategoryVideoController extends Controller {

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
                        'roles' => ['90phut_category_video'],
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
        $service = new CategoryVideoService();
    
        $listCategory = $service->getAllCategoryActive();
        
        return $this->render('index', [
                    'listCategory' => $listCategory,
        ]);
    }

    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $service = new CategoryVideoService();
        $mes = '';

        if ($model->load(\Yii::$app->request->post())) {
            try {
                if($model->save())
                {   
                    return $this->redirect("/app90phut/category-video");
                }    
            } catch (Exception $exc) {
                echo "Loi :" . $exc->getTraceAsString();
            }
        } else
            return $this->render("update", array('model' => $model, 'mes' => $mes));
    }

     
    
    protected function findModel($id) {
        if (($model = CategoryVideo::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
