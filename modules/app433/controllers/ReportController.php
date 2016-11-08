<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\modules\app433\controllers;

use yii\web\Controller;
use app\modules\app433\services\ReportService;
use app\modules\app90phut\services\AdminService;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

class ReportController extends Controller {

    public $layout = 'post';
    private $getReport = null;
    private $getAdmin = null;

    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'report-post',
                        ],
                        'allow' => true,
                        'roles' => ['433_report'],
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
        $this->getReport = new ReportService();
        $this->getAdmin = new AdminService();
        parent::__construct($id, $module, $config);
    }

    public function actionIndex() {
        return $this->render('index');
    }

    private function paramsReport() {
        $paramsGet = [];
        $paramsGet['date'] = \Yii::$app->getRequest()->getQueryParam("date", "");
        $paramsGet['type'] = \Yii::$app->getRequest()->getQueryParam("type", "");
        $paramsGet['col'] = \Yii::$app->getRequest()->getQueryParam("col", "");
        $paramsGet['public'] = \Yii::$app->getRequest()->getQueryParam("public", '1');
        $paramsGet['order'] = \Yii::$app->getRequest()->getQueryParam("order", '');
        $paramsGet['userCreate'] = \Yii::$app->getRequest()->getQueryParam("userCreate", '');
        $paramsGet['typeReport'] = \Yii::$app->getRequest()->getQueryParam("typeReport", '');
        $paramsGet['report'] = \Yii::$app->getRequest()->getQueryParam("report", '');
        return $paramsGet;
    }

    public function actionReportPost() {
        $data['data'] = $data['pagination'] = null;
        $listAdmin = $this->getAdmin->getListAdmin();
        $params = $this->paramsReport();
        if ($params['date'] != "") {
            if ($params['report'] == "view") {
                $data = $this->getReport->reportPost($params['type'], $params['date'], $params['typeReport'], $params['col'], $params['order'], $params['userCreate'], $params['public']);
            } else {
                $data = $this->getReport->reportPostCount($params['type'], $params['date'], $params['typeReport'], $params['col'], $params['order'], $params['userCreate'], $params['public']);
            }
        }
        if ($params['report'] == "countTotal") {
            return $this->render('post-count', ['data' => $data,'paramsGet' => $params,'listAdmin' => $listAdmin
            ]);
        } else {
            return $this->render('post', ['data' => $data['data'],'pagination' => $data['pagination'],'paramsGet' => $params,'listAdmin' => $listAdmin
            ]);
        }
    }

}
