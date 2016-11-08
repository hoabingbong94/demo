<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\modules\app90phut\controllers;

use yii\web\Controller;
use app\modules\app90phut\models\BroadCast;
use app\modules\app90phut\services\BroadCastService;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

class BroadCastController extends Controller {

    public $layout = 'post';
    private $getBroadCastService = null;

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
                        'roles' => ['90phut_broad-cast'],
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
        $this->getBroadCastService = new BroadCastService();
        parent::__construct($id, $module, $config);
    }

    public function actionIndex() {
        $keyword = isset($_GET["keyword"]) ? $_GET["keyword"] : "";
        $date = isset($_GET["date"]) ? $_GET["date"] : date("Y-m-d");
        $data = $this->getBroadCastService->findAll($date, $keyword);
        return $this->render('index', array('data' => $data, 'keyword' => $keyword, 'date' => $date));
    }

    public function actionCreate() {
        $mes = "";
        $model = new BroadCast();
        if ($model->load(\Yii::$app->request->post())) {
            $checkButton = $_POST['redirect'];
            $id = $this->getBroadCastService->save($model);
            if ($id) {
                if ($checkButton == "post") {
                    $this->redirect('/app90phut/broad-cast');
                } else {
                    $this->redirect("/app90phut/broad-cast/update?id=" . $id . "&redirect=insert");
                }
            }
        }
        return $this->render('form', array('model' => $model, 'mes' => $mes, 'action' => 'create'));
    }

    public function actionUpdate($id) {
        $mes = "";
        $model = $this->getBroadCastService->findById($id);
        if ($model->load(\Yii::$app->request->post())) {
            $checkButton = $_POST['redirect'];
            $save = $this->getBroadCastService->save($model);
            if ($checkButton == "post") {
                $this->redirect('/app90phut/broad-cast');
            } else {
                $this->redirect("/app90phut/broad-cast/update?id=" . $id . "&redirect=update");
            }
        }
        return $this->render('form', array('model' => $model, 'action' => 'update'));
    }

    public function actionDelete() {
        $request = \Yii::$app->request;
        $id = $request->get('id');
        $model = BroadCast::findOne($id);
        $model->Delete = 0;
        if ($model->save()) {
//            echo "<pre>";
//            print_r($model->save());
//            die();
            return $this->redirect(['broad-cast/index']);
        } else {
            echo "delete failt!";
        }
    }

}
