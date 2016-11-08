<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\modules\app433\controllers;

use yii\web\Controller;
use app\modules\app433\services\NewsHomeService;
use app\modules\app433\models\NewsHome;
use app\modules\app433\services\PostService;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

class NewsHomeController extends Controller {

    private $getNewsHomeService = null;
    private $getPostService = null;
    public $layout = "post";

    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => [
                            'index',
                            'update',
                            'create'
                        ],
                        'allow' => true,
                        'roles' => ['433_news_home'],
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
        $this->getNewsHomeService = new NewsHomeService();
        $this->getPostService = new PostService();
        parent::__construct($id, $module, $config);
    }

    public function actionIndex() {
        $keyword = isset($_GET["keyword"]) ? $_GET["keyword"] : "";
        $public = isset($_GET["public"]) ? $_GET["public"] : "";
        $listData = $this->getNewsHomeService->findAll($keyword, $public);
        return $this->render('index', array('data' => $listData));
    }

    public function actionCreate($postId) {
        $model = new NewsHome();
        $data = $this->getNewsHomeService->findPostByID($postId);
        $content = $data['Title'];
        if ($data['Title'] == null) {
            $content = $data['Content'];
            $partern = '/(\[tag\])(.+?)(\[\/tag\])/';
            $replacement = '$2';
            $content = preg_replace($partern, $replacement, $content);
            $content = preg_replace("/<img[^>]+\>/i", "", $content);
            $content = preg_replace("/<iframe[^>]+\>/i", "", $content);
            $content = strip_tags($content);
        }
        $model->Title = $content;
        if ($model->load(\Yii::$app->request->post())) {
            $this->getNewsHomeService->save($model);
            $this->redirect("/app433/news-home");
        } else {
            $model->PostID = $postId;
        }
        return $this->render('form', array('model' => $model, 'data' => $data));
    }

    public function actionUpdate($id) {
        $model = $this->getNewsHomeService->findById($id);
        if ($model->load(\Yii::$app->request->post())) {
            $this->getNewsHomeService->save($model);
            $this->redirect("/app433/news-home");
        }
        $postId = $model->PostID;
        $data = $this->getNewsHomeService->findPostByID($postId);
        return $this->render('form', array('model' => $model, 'data' => $data));
    }

}
