<?php

namespace app\modules\app90phut\controllers;

use \yii\web\Controller;
use app\modules\app90phut\services\StarService;
use app\modules\app90phut\models\Star;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use app\modules\app433\services\CategoriesService;
use app\modules\app433\services\PostService;
use app\modules\app433\models\Post;
use app\modules\app433\models\Post90phut;

//use app\modules\app433\models\Categories;

class StarController extends Controller {

    public $layout = 'post';
    private $getStarService = null;
    private $category433 = null;
    private $thumbnailsCover = null;
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
                            'search-video-ajax'
                        ],
                        'allow' => true,
                        'roles' => ['90phut_star'],
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
        $this->getStarService = new StarService();
        $this->category433 = new CategoriesService();
        $this->postService = new PostService();
    }

    public function actionIndex() {
        $keyword = isset($_GET["keyword"]) ? $_GET["keyword"] : "";
        $public = \Yii::$app->getRequest()->getQueryParam('public');
        $data = $this->getStarService->findAll($keyword, $public);
        return $this->render('index', array("data" => $data['data'],
                    'pagination' => $data['pagination']));
    }

    public function actionSearchVideoAjax() {
        $keyword = isset($_GET["keyword"]) ? $_GET["keyword"] : "";
        $data = $this->getStarService->SearchVideoAjax($keyword);
        return $this->renderpartial("search-video-ajax", array('data' => $data)
        );
    }

    public function actionCreate() {
        $mes = "";
        $model433 = new Post();
        $model = new Star();
//        sửa thêm
        $category433 = $this->category433->findAll();
//        kết thúc
        if ($model->load(\Yii::$app->request->post())) {
            $this->getStarService->save($model);
            $model433->ThumbnailsCover = $model->thumbnailsCover;
            $this->redirect("/app90phut/star");
        }
        return $this->render('form', array('model' => $model,
                    'category433' => $category433,
                    'model433' => $model433,
                    'postService' => $this->postService,
                    'mes' => $mes
        ));
    }

    public function actionUpdate($id) {
        $mes = "";

        $model = $this->getStarService->findById($id);
        if ($model->AllowEdit <= 0 && !$this->postService->getRole('allowEdit')) {
            $this->redirect('/app90phut/news/allow-edit?id=' . $id);
        }
        $model433 = new Post();
        $category433 = $this->category433->findAll();
        $post433 = Post90phut::find()->where(['StarID' => $id])->one();
        if ($post433 != null) {
            $model433 = Post::find()->where(['ID' => $post433->PostID])->one();
        }
        if ($model->load(\Yii::$app->request->post())) {
            $model->category433 = "";
            $this->getStarService->save($model);
            $this->redirect("/app90phut/star");
        }
        return $this->render('form', array('model' => $model,
                    'mes' => $mes,
                    'category433' => $category433,
                    'postService' => $this->postService,
                    'model433' => $model433,
        ));
    }

}
