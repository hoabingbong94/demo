<?php

namespace app\modules\app433\controllers;

use app\modules\app433\services\PostService;
use app\modules\app433\services\VideoHighlightService;
use app\modules\app433\services\LiveService;
use yii\web\Controller;
use app\modules\app433\models\Post;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use app\modules\app433\services\CategoriesService;

class PostController extends Controller {

    private $getPostService = null;
    private $getVideoService = null;
    private $getLiveService = null;
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
                            'choice-post-type',
                            'update',
                            'upload-img',
                            'upload-video',
                            'add-item-video',
                            'remove-item-video',
                            'load-item-video',
                            'edit-item-video',
                            'add-tag',
                            'update-live',
                            'add-event',
                            'reload-event',
                            'del-event',
                            'edit-event',
                            'find-by-event-id',
                            'get-img-categories',
                            'search-match',
                            'delete-post',
                            'list-news',
                            'view-log'
                        ],
                        'allow' => true,
                        'roles' => ['433_post'],
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
        $this->getPostService = new PostService();
        $this->getVideoService = new VideoHighlightService();
        $this->getLiveService = new LiveService();
        //parent::__construct($config);
    }

    public function actionIndex() {
        $keyword = isset($_GET["keyword"]) ? $_GET["keyword"] : "";
        $public = isset($_GET["public"]) ? $_GET["public"] : "";
        $datePost = isset($_GET["datePost"]) ? $_GET["datePost"] : "";
        $type = isset($_GET["type"]) ? $_GET["type"] : "";

        $data = $this->getPostService->findAll($keyword, $public, $datePost, $type);
        return $this->render('index', array(
                    "listPost" => $data['data'],
                    'pagination' => $data['pagination']
        ));
    }

    public function actionChoicePostType() {
        return $this->render("choice-post-type");
    }

    public function actionCreate($type) {
        //findCategories
        $mes = "";
        $model = new Post();
        if ($model->load(\Yii::$app->request->post())) {
            $checkButton = $_POST['redirect'];

            if ($checkButton == "close") {
                $this->redirect("/app433/post");
            }
            //Submit form
            $userId = \Yii::$app->user->id;
            $model->UserCreate = $userId;
            $model->UserUpdate = $userId;
            $type = $model->Type;
            $postId = $this->getPostService->save($model);
            if ($type == 5) {
                if ($checkButton == "post") {
                    $this->redirect("/app433/post");
                } else {
                    $this->redirect("/app433/post/update-live?postId=" . $postId);
                }
            } else {
                if ($checkButton == "post") {
                    $this->redirect("/app433/post");
                } else {
                    $this->redirect("/app433/post/update?postId=" . $postId . "&redirect=insert");
                }
            }
        } else {
            $this->getVideoService->resetSessionItem();
            $model->Type = $type;
            $model->Public = 1;
            $model->DatePublic = date('Y-m-d H:i:s');
            if ($type == 5) {
                $model->Live = 1;
            }
            /* Lay tin 90phut */
            if (isset($_GET['newsId'])) {
                $newsId90phut = addslashes(trim($_GET['newsId']));
                $model = $this->getPostService->findNews90phutById($model, $newsId90phut);
            }
        }
        $listCategories = new CategoriesService();
        return $this->render("form", array(
                    'model' => $model,
                    'mes' => $mes,
                    'matchInfo' => '',
                    'categories' => $listCategories->findAll()
        ));
    }

    public function actionUpdate($postId, $redirect) {
        $model = $this->getPostService->findById($postId);

        $listCategories = new CategoriesService();
        $mes = "";
        $modelVideo = array();
        $matchInfo = "";
        if ($redirect == "insert") {
            $mes = "Thêm mới bài tin thành công.";
        }if ($redirect == "update") {
            $mes = "Cập nhật bài tin thành công.";
        }
        if ($model->load(\Yii::$app->request->post())) {
            $checkButton = $_POST['redirect'];

            if ($checkButton == "close") {
                $this->redirect("/app433/post");
            }
            //Submit form
            $model->UserUpdate = \Yii::$app->user->id;
            if ($model->DatePublic == "") {
                $model->DatePublic = date("Y-m-d H:i:s");
            }
            $postId = $this->getPostService->save($model);
            if ($checkButton == "post") {
                $this->redirect("/app433/post");
            } else {
                $this->redirect("/app433/post/update?postId=" . $postId . "&redirect=insert");
            }
        } else {
            if ($model->Type == 3) {
                $modelVideo = $this->getVideoService->findById($postId);
            }
            if ($model->Type == 5) {
                $matchId = $model->MatchID;
                if ($matchId != null) {
                    $match = $this->getLiveService->getMatchById($matchId);
                    $homeName = $match->HomeName;
                    $awayName = $match->AwayName;
                    $matchInfo = $matchId . " | " . $homeName . " vs " . $awayName;
                }
            }
            $this->getVideoService->resetSessionItem();
        }
        return $this->render("form", array(
                    'model' => $model,
                    'modelVideo' => $modelVideo,
                    'mes' => $mes,
                    'matchInfo' => $matchInfo,
                    'categories' => $listCategories->findAll()
        ));
    }

    public function actionUpdateLive($postId) {
        $listEvent = $this->getLiveService->findByPostId($postId);
        return $this->render('formLive', array(
                    'data' => $listEvent,
                    'postId' => $postId
        ));
    }

    public function actionUploadImg() {
        $upload = new \app\modules\app433\services\UploadService();
        $tmpName = $_FILES['file_up']['tmp_name'];
        $fileName = $_FILES['file_up']['name'];
        $file = $upload->uploadCkE("images", $tmpName, $fileName);
        $path = \Yii::$app->params['pathMedia'] . $file;
        echo '<img width="100%" src="' . $path . '"/>';
        die;
    }

    public function actionUploadVideo() {
        $upload = new \app\modules\app433\services\UploadService();
        $tmpName = $_FILES['file_up']['tmp_name'];
        $fileName = $_FILES['file_up']['name'];
        $file = $upload->uploadCkE("videos", $tmpName, $fileName);
        if ($file == "") {
            echo "loi";
            die;
        }
        $path = \Yii::$app->params['pathMedia'] . $file;
        echo '<video width="100%" src="' . $path . '" controls="true"/>';
        die;
    }

    public function actionAddItemVideo() {
        $session = new \yii\web\Session();
        if (!$session->isActive) {
            $session->open();
        }
        //$session->remove("listTmp");die();
        echo $this->getPostService->addItem($_FILES, $_POST);
        die;
    }

    public function actionEditItemVideo() {
        $session = new \yii\web\Session();
        if (!$session->isActive) {
            $session->open();
        }
        //$session->remove("listTmp");die();
        echo $this->getPostService->editItem($_FILES, $_POST);
        die;
    }

    public function actionRemoveItemVideo($id) {
        $session = new \yii\web\Session();
        if (!$session->isActive) {
            $session->open();
        }
        echo $this->getPostService->removeItem($id);
        die;
    }

    public function actionLoadItemVideo($id) {
        $session = new \yii\web\Session();
        if (!$session->isActive) {
            $session->open();
        }
        $item = $session['listTmp'][$id];
        $item['images'] = \Yii::$app->params['pathMedia'] . $item['images'];
        $item['video'] = \Yii::$app->params['pathMedia'] . $item['video'];
        echo json_encode($item);
        die;
    }

    public function actionAddTag() {
        $tag = \Yii::$app->request->post("tag");
        $tagService = new \app\modules\app433\services\TagService();
        $tagService->addTag($tag);
    }

    public function actionAddEvent() {
        $model = new \app\modules\app433\models\MatchLiveEvent();
        $userId = \Yii::$app->user->id;
        $date = date("Y-m-d H:i:s");
        $model->UserCreate = $userId;
        $model->UserUpdate = $userId;
        $model->DateCreate = $date;
        $model->DateUpdate = $date;
        $liveService = new \app\modules\app433\services\LiveService();
        $add = $liveService->save($_FILES, $_POST, $model);
        if ($add) {
            echo "Thêm dữ liệu thành công.";
        } else {
            echo "Lỗi hệ thống.";
        }
        die;
    }

    public function actionEditEvent() {
        $model = new \app\modules\app433\models\MatchLiveEvent();
        $model = \app\modules\app433\models\MatchLiveEvent::find()->where(['ID' => $_POST['id']])->one();
        $userId = \Yii::$app->user->id;
        $date = date("Y-m-d H:i:s");
        $model->UserUpdate = $userId;
        $model->DateUpdate = $date;
        $liveService = new \app\modules\app433\services\LiveService();
        $add = $liveService->save($_FILES, $_POST, $model);
        if ($add) {
            echo "Thêm dữ liệu thành công.";
        } else {
            echo "Lỗi hệ thống.";
        }
        die;
    }

    public function actionReloadEvent($postId) {
        $this->layout = false;
        $listEvent = $this->getLiveService->findByPostId($postId);
        return $this->render('reload-event', array('data' => $listEvent));
    }

    public function actionDelEvent($id) {
        $del = $this->getLiveService->delById($id);
        if ($del) {
            echo 1;
        } else {
            echo 0;
        }
        die;
    }

    public function actionFindByEventId($id) {
        $data = $this->getLiveService->findByEventId($id);
        $arr = array();
        $arr['Minute'] = $data->Minute;
        $arr['PostID'] = $data->PostID;
        $arr['Type'] = $data->Type;
        $arr['Content'] = $data->Content;
        $arr['UrlVideo'] = $data->UrlVideo;
        echo json_encode($arr);
        die;
    }

    public function actionGetImgCategories($id) {
        $categoriesService = new CategoriesService();
        $objectCategories = $categoriesService->findById($id);
        $img = "http://posts.media.profile.bongda433.com/" . $objectCategories->Logo;
        echo $img;
        die;
    }

    public function actionSearchMatch($keyword) {
        $this->layout = false;
        $data = $this->getLiveService->searchMatch($keyword);
        return $this->render('search-match', array('data' => $data));
    }

    public function actionDeletePost($id) {
        $this->getPostService->deletePost($id);
        die;
    }

    /* Kho tin 90phut */

    public function actionListNews() {
        $public = isset($_GET["public"]) ? $_GET["public"] : "";
        $keyword = isset($_GET["keyword"]) ? $_GET["keyword"] : "";
        $data = $this->getPostService->news90phut($public, $keyword);
        return $this->render('listNews', array(
                    "data" => $data['data'],
                    'pagination' => $data['pagination']
        ));
    }

    /* Lich su cap nhat */

    public function actionViewLog($id) {
        $data = $this->getPostService->getHistory($id);
        return $this->render('viewLog', array('data' => $data));
    }

}
