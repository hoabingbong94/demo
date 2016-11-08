<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\modules\app433\controllers;

use yii\web\Controller;
use app\modules\app433\services\BroadcastService;
use app\modules\app433\models\Broadcast;
use app\modules\app433\services\CategoriesService;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

class BroadcastController extends Controller {

    private $broadcastService = null;
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
                            'search-team'
                        ],
                        'allow' => true,
                        'roles' => ['433_broadcast'],
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
        $this->broadcastService = new BroadcastService();
        parent::__construct($id, $module, $config);
    }

    public function actionIndex() {
        $startDate = isset($_GET['date']) ? $_GET['date'] : date("Y-m-d");
        $status = isset($_GET['status']) ? $_GET['status'] : 3;
        $data = $this->broadcastService->findByDate($startDate, $status);
        $listTeam = $this->broadcastService->fetchTeam($data);
        return $this->render('index', ['data' => $data,
                    'listTeam' => $listTeam,
                    'date' => $startDate,
                    'status' => $status
        ]);
    }

    public function actionCreate() {
        $model = new Broadcast();
        $this->frmSubmit($model);
        return $this->render('form', [
                    'model' => $model,
                    'categories' => $this->getCategories()
        ]);
    }

    public function actionUpdate($id) {
        $model = $this->broadcastService->findById($id);

        $this->frmSubmit($model);
        return $this->render('form', [
                    'model' => $model,
                    'categories' => $this->getCategories()
        ]);
    }

    private function getCategories() {
        $listCategories = new CategoriesService();
        return $listCategories->findAll();
    }

    private function frmSubmit(Broadcast $model) {
        if ($model->load(\Yii::$app->request->post())) {
            $this->broadcastService->save($model);
            $this->redirect("/app433/broadcast");
        }
    }

    public function actionSearchTeam($keyword, $idElement) {
        $data = $this->broadcastService->searchTeam($keyword, $idElement);
        echo $data;
        die;
    }

}
