<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\modules\app90phut\controllers;

use yii\web\Controller;
use app\modules\app90phut\services\VideoService;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use app\modules\app90phut\models\Video;
use app\modules\app90phut\services\CategoriesVideoService;
use app\modules\app90phut\services\CategoriesPcService;
use yii\helpers\Url;
use app\modules\app433\services\PostService;

class VideoController extends Controller {

    public $layout = 'post';
    private $getVideoService;
    private $getCategoriesVideo;
    private $getCategoriesPc;
    private $postService = null;

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
                            'top',
                            'top-hot',
                        ],
                        'allow' => true,
                        'roles' => ['90phut_video'],
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

    public function __construct($id, $module, $config = []) {
        $this->id = $id;
        $this->module = $module;
        $this->getVideoService = new VideoService();
        $this->getCategoriesVideo = new CategoriesVideoService();
        $this->getCategoriesPc = new CategoriesPcService();
        $this->postService = new PostService();
    }

    /*
     * Danh sach video
     */

    public function actionIndex() {
        $param['keyword'] = \Yii::$app->getRequest()->getQueryParam('keyword', '');
        $param['type'] = \Yii::$app->getRequest()->getQueryParam('type', 0);
        $param['category'] = \Yii::$app->getRequest()->getQueryParam('category', 0);
        $param['urlback'] = urlencode(Url::current());
        $param['categories'] = $this->getCategoriesVideo->findAll();

        $data = $this->getVideoService->fillAll($param);
        return $this->render('index', array("data" => $data['data'],
                    'pagination' => $data['pagination'
                    ],
                    'param' => $param));
    }

    public function actionCreate() {
        $model = new Video();
        $model->IsPublic = 1;
        $categoriesVideo = $this->getCategoriesVideo->findAll();
        $categoriesPc = $this->getCategoriesPc->getAllCategories();
        $urlback = isset($_GET["urlback"]) ? $_GET["urlaback"] : "/app90phut/video";
        // var_dump($categoriesPc); die;
        if ($model->load(\Yii::$app->request->post())) {
            // var_dump($model); die;
            $save = $this->getVideoService->save($model, \Yii::$app->request->post());
            if ($save) {
                if (isset($_POST['quit'])) {
                    $this->redirect(["/app90phut/video"]);
                } else {
                    $this->redirect(["update", 'id' => $model->ID, 'mes' => urlencode('Thêm mới thành công')]);
                }
            }
        }
        return $this->render('form', ['model' => $model,
                    'categoriesVideo' => $categoriesVideo,
                    'categoriesPc' => $categoriesPc,
                    'urlback' => $urlback,
                    'postService' => $this->postService,
        ]);
    }

    public function actionUpdate($id) {
        $model = $this->getVideoService->findById($id);

        if ($model->AllowEdit <= 0 && !$this->postService->getRole('allowEdit')) {
            $this->redirect('/app90phut/news/allow-edit?id=' . $id);
        }
        $categoriesVideo = $this->getCategoriesVideo->findAll();
        $categoriesPc = $this->getCategoriesPc->getAllCategories();
        $mes = isset($_GET["mes"]) ? $_GET["mes"] : "";
        $urlback = isset($_GET["urlback"]) ? urldecode($_GET["urlback"]) : "/app90phut/video";
        if ($model->load(\Yii::$app->request->post())) {
            $save = $this->getVideoService->save($model, \Yii::$app->request->post());

            if ($save) {
                $mes = "Cập nhật thành công";
                if (isset($_POST['quit'])) {
                    return $this->redirect($urlback);
                }
            }
        }

        return $this->render('form', array('model' => $model,
                    'categoriesVideo' => $categoriesVideo,
                    'categoriesPc' => $categoriesPc,
                    'urlback' => $urlback,
                    'postService' => $this->postService,
                    'mes' => $mes));
    }

    public function actionTop($id) {
        $model = $this->findModel($id);
        $urlback = isset($_GET["urlback"]) ? urldecode($_GET["urlback"]) : "/app90phut/video";
        if ($model->Top == 1) {
            $model->Top = 0;
        } else {
            $model->Top = 1;
        }
        $model->save();

        return $this->redirect($urlback);
    }

    public function actionTopHot($id) {
        $urlback = isset($_GET["urlback"]) ? urldecode($_GET["urlback"]) : "/app90phut/video";
        $model = $this->findModel($id);
        if ($model->TopHot == 1) {
            $model->TopHot = 0;
        } else {
            $model->TopHot = 1;
        }
        $model->save();
        return $this->redirect($urlback);
    }

    protected function findModel($id) {
        if (($model = Video::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
