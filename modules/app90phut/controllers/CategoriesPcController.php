<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\modules\app90phut\controllers;

use yii\web\Controller;
use app\modules\app90phut\models\CategoryPc;
use app\modules\app90phut\services\CategoriesPcService as CategoryService;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
class CategoriesPcController extends Controller {

    public $layout = 'post';
    private $getCategories = null;
public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => [
                            'index',
                            'create',
                            'update'
                        ],
                        'allow' => true,
                        'roles' => ['90phut_categories_pc'],
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
    public function __construct($id, $module, $config = array()) {
        $this->getCategories = new CategoryService();
        parent::__construct($id, $module, $config);
    }

    public function actionIndex() {
        $public = isset($_GET['public']) ? $_GET['public'] : 1;
        $keyword = isset($_GET['keyword']) ? $_GET['keyword'] : "";
        $data = $this->getCategories->findAll($public,$keyword);
        return $this->render('index', array('data' => $data));
    }

    public function actionCreate() {
        $mes = "";
        $model = new CategoryPc();
        $listCategories = $this->getCategories->getAllCategories();
        $listCategories[0] = "Danh mục gốc";
        unset($listCategories['']);
        if ($model->load(\Yii::$app->request->post())) {
            $save = $this->getCategories->save($model);
            if ($save) {
                $this->redirect('/app90phut/categories-pc');
            } else {
                
            }
        }
        return $this->render('form', array('model' => $model, 'listParent' => $listCategories, 'mes' => $mes));
    }

    public function actionUpdate($id) {
        $mes = "";
        $listCategories = $this->getCategories->getAllCategories();
        $listCategories[0] = "Danh mục gốc";
        unset($listCategories['']);
        $model = $this->getCategories->findById($id);
        if ($model->load(\Yii::$app->request->post())) {
            $save = $this->getCategories->save($model);
            if ($save) {
                $this->redirect('/app90phut/categories-pc');
            } else {
                
            }
        }
        return $this->render('form', array('model' => $model, 'listParent' => $listCategories, 'mes' => $mes));
    }
    

}
