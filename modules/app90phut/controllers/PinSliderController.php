<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\modules\app90phut\controllers;

use yii\web\Controller;
use app\modules\app90phut\services\PinSliderService;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

class PinSliderController extends Controller {

    public $layout = 'post';
    private $getPinSliderService = null;

    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => [
                            'index',
                            'delete'
                        ],
                        'allow' => true,
                        'roles' => ['90phut_pin_slider'],
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
        $this->getPinSliderService = new PinSliderService();
        parent::__construct($id, $module, $config);
    }

    public function actionIndex() {
        $data = $this->getPinSliderService->findAll();
        return $this->render('index', array('data' => $data));
    }

    public function actionDelete($id) {
        $mes = "";
        $del = $this->getPinSliderService->delete($id);
        if ($del > 0) {
            $mes = "Xóa dữ liệu thành công.";
        } else {
            $mes = "Lỗi hệ thống.";
        }
        $this->redirect("/app90phut/pin-slider?mes=" . $mes);
    }

}
