<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\modules\app90phut\controllers;

use yii\web\Controller;
use app\modules\app90phut\services\AlbumService;
use app\modules\app90phut\services\AlbumItemService;
use app\modules\app90phut\models\AlbumImage;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use app\modules\app433\services\PostService;

class AlbumController extends Controller {

    private $getAlbumService = null;
    private $getAlbumItemService = null;
    private $postService = null;
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
                            'add-item',
                            'update-item',
                            'remove-item',
                            'load-item'
                        ],
                        'allow' => true,
                        'roles' => ['90phut_album'],
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
        $this->getAlbumService = new AlbumService();
        $this->getAlbumItemService = new AlbumItemService();
        $this->postService = new PostService();
        parent::__construct($id, $module, $config);
    }

    public function actionIndex() {
        $keyword = isset($_GET['keyword']) ? $_GET['keyword'] : "";
        $public = isset($_GET['public']) ? $_GET['public'] : "";
        $data = $this->getAlbumService->findAll($keyword, $public);
        return $this->render('index', array("data" => $data['data'],
                    'pagination' => $data['pagination']));
    }

    public function actionCreate() {
        $mes = "";
        $type = \Yii::$app->getRequest()->getQueryParam('type');
        $model = new AlbumImage();
        $model->Type = $type;
        if ($model->load(\Yii::$app->request->post())) {
            $checkButton = $_POST['redirect'];
            $save = $this->getAlbumService->save($model);
            if ($save) {
                $mes = "Thêm mới thành công.";
            } else {
                $mes = "Lỗi hệ thống.";
            }
            if ($checkButton == "post") {
                $this->redirect("/app90phut/album/create");
            } else {
                $this->redirect("/app90phut/album/update?id=" . $save . "&redirect=insert");
            }
        } else {
            $this->getAlbumService->unsetSession('albumImage');
            $this->getAlbumService->unsetSession('albumVideo');
        }
        $listCategories = $this->getAlbumService->listCategoriesAlbum();
        return $this->render('form', ['model' => $model,
                    'categories' => $listCategories,
                    'listItem' => [],
                    'postService' => $this->postService,
                    'mes' => $mes]);
    }

    public function actionUpdate($id) {
        $listItem = $listCategories = [];
        $model = $this->getAlbumService->findById($id);
        if ($model->AllowEdit <= 0 && !$this->postService->getRole('allowEdit')) {
            $this->redirect('/app90phut/news/allow-edit?id=' . $id);
        }
        if ($model->load(\Yii::$app->request->post())) {
            $checkButton = $_POST['redirect'];
            $this->getAlbumService->save($model);
            if ($checkButton == "post") {
                $this->redirect("/app90phut/album/create");
            } else {
                $this->redirect("/app90phut/album/update?id=" . $id . "&redirect=insert");
            }
        } else {
            $listItem = $this->getAlbumItemService->findByAlbumId($id, $model->Type)['items'];
            $listCategories = $this->getAlbumService->listCategoriesAlbum();
        }
        return $this->render('form', [
                    'model' => $model,
                    'listItem' => $listItem,
                    'postService' => $this->postService,
                    'categories' => $listCategories]);
    }

    public function actionAddItem() {
        $type = $_POST['type'];
        $this->layout = false;
        if ($type == 1) {
            $data = $this->getAlbumItemService->addItemVideo($_POST, $_FILES);
            return $this->render('partial/loadItemVideo', array('listItems' => $data));
        } else {
            $data = $this->getAlbumItemService->addItemImage($_POST, $_FILES);
            return $this->render('partial/loadItemImage', array('listItems' => $data));
        }
    }

    public function actionUpdateItem() {
        $type = $_POST['type'];
        $key = $_POST['key'];
        $this->layout = false;
        if ($type == 1) {
            $data = $this->getAlbumItemService->updateItemVideo($_POST, $_FILES, $key);
            return $this->render('partial/loadItemVideo', array('listItems' => $data));
        } else {
            $data = $this->getAlbumItemService->updateItemImage($_POST, $_FILES, $key);
            return $this->render('partial/loadItemImage', array('listItems' => $data));
        }
    }

    public function actionRemoveItem($id, $type) {
        $this->getAlbumItemService->removeItemImage($id, $type);
        die;
    }

    public function actionLoadItem($k, $type) {
        $baseUrl = \Yii::$app->params['media90phut'];
        $data = $this->getAlbumItemService->findByKey($k, $type);
        $data['fileName'] = $baseUrl . "/" . $data['fileName'];
        if ($type == 1) {
            $data['fileVideo'] = $baseUrl . "/" . $data['fileVideo'];
        }
        echo json_encode($data);
        die;
    }

}
