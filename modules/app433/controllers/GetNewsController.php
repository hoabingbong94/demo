<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\modules\app433\controllers;

use yii\web\Controller;
use app\modules\app433\services\GetNewsTTVNService;

class GetNewsController extends Controller {

    public $layout = 'post';
    private $host = "http://thethaovietnam.vn/";
    private $newsTTVNService = null;

    public function __construct($id, $module, $config = array()) {
        $this->newsTTVNService = new GetNewsTTVNService();
        parent::__construct($id, $module, $config);
    }

    public function actionIndex() {
        $this->newsTTVNService->scanListItem();
        die("Done.");
    }

    public function actionListAll() {
        $listNews = $this->newsTTVNService->listAll();
        return $this->render('list-all', ['data' => $listNews['data'], 'pagination' => $listNews['pagination']]);
    }

}
