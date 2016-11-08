<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\modules\app433\controllers;

use yii\web\Controller;
use app\modules\app433\services\KeywordsService;
use app\modules\app433\models\Keywords;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

class KeywordsController extends Controller {

    private $keywordsService = null;
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
                            'update'
                        ],
                        'allow' => true,
                        'roles' => ['433_keywords'],
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
        $this->keywordsService = new KeywordsService();
        parent::__construct($id, $module, $config);
    }

    public function actionIndex() {
        $data = $this->keywordsService->findAll();
        return $this->render('index', ['data' => $data]);
    }

    public function actionCreate() {
        $model = new Keywords();
        $this->loadFrm($model);
        return $this->render('form', ['model' => $model]);
    }

    public function actionUpdate($id) {
        $model = $this->keywordsService->findById($id);
        $this->loadFrm($model);
        return $this->render('form', ['model' => $model]);
    }

    private function loadFrm(Keywords $model) {
        if ($model->load(\Yii::$app->request->post())) {
            $this->keywordsService->save($model);
            $this->redirect('/app433/keywords');
        }
    }

}
