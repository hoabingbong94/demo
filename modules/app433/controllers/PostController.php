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
use app\modules\app433\services\StarService;
use app\modules\app433\services\NewsService;
use app\modules\app433\services\GetNewsTTVNService;
use app\modules\app433\models\MatchLiveEvent;

class PostController extends Controller {

    private $getPostService = null;
    private $getVideoService = null;
    private $getLiveService = null;
    private $getStarService = null;
    private $getNewsService = null;
    private $getTTVNService = null;
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
                            'list-star',
                            'view-log',
                            'allow-edit',
                            'upload-video-poster'
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
        $this->getStarService = new StarService();
        $this->getNewsService = new NewsService();
        $this->getTTVNService = new GetNewsTTVNService();
        parent::__construct($id, $module);
    }

    private function getParams($name, $default) {
        return \Yii::$app->getRequest()->getQueryParam($name, $default);
    }

    /* Danh sách tin */

    public function actionIndex() {
        $keyword = $this->getParams('keyword', '');
        $public = $this->getParams('public', '');
        $datePost = $this->getParams('datePost', '');
        $type = $this->getParams('type', '');
        $categoriesId = $this->getParams('categoriesId', '');
        $date = $this->getParams('date', '');
        $userId = $this->getParams('userId', 'all');
        $data = $this->getPostService->findAll($keyword, $public, $datePost, $type, $categoriesId, $date, $userId);
        return $this->render('index', array(
                    "listPost" => $data['data'],
                    'pagination' => $data['pagination']
        ));
    }

    /* Thêm mới bài viết */

    public function actionCreate($type) {
//findCategories
        $mes = "";
        $newsId90phut = "";
        $starId90phut = "";
        $ttvnId = "";
        $model = new Post();
        if ($model->load(\Yii::$app->request->post())) {
            $checkButton = $_POST['redirect'];
            $newsId = addslashes(trim($_POST['newsId']));
            $starId = addslashes(trim($_POST['starId']));
            $ttvnId = addslashes(trim($_POST['ttvnId']));
            if ($checkButton == "close") {
                $this->redirect("/app433/post");
            }
//Submit form
            $userId = \Yii::$app->user->id;
            $model->UserCreate = $userId;
            $model->UserUpdate = $userId;
            $type = $model->Type;
            if (isset($_POST['urlvideo']) && $_POST['urlvideo'] != '') {
                $model->UrlVideo = $_POST['urlvideo'];
            }
            $postId = $this->getPostService->save($model);
            if ($newsId != "") {
                $this->getPostService->updateNews90phut($newsId);
            }
            if ($starId != "") {
                $this->getStarService->updateNews90phut($starId);
            }
            if ($ttvnId != "") {
                $this->getTTVNService->updateById($ttvnId);
            }
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
            $newsId90phut = $this->getParams('newsId', 0);
            if ($newsId90phut > 0) {
                $model = $this->getNewsService->findNews90phutById($model, $newsId90phut);
            }
            $starId90phut = $this->getParams('starId', 0);
            if ($starId90phut > 0) {
                $model = $this->getStarService->findStar90phutById($model, $starId90phut);
            }
            $ttvnId = $this->getParams('ttvnId', 0);
            if ($ttvnId > 0) {
                $model = $this->getTTVNService->getById($ttvnId);
                $model->Type = $this->getParams('type', 0);
            }
        }
        $listCategories = new CategoriesService();
        return $this->render("form", array(
                    'model' => $model,
                    'mes' => $mes,
                    'matchInfo' => '',
                    'newsId' => $newsId90phut,
                    'starId' => $starId90phut,
                    'ttvnId' => $ttvnId,
                    'categories' => $listCategories->findAll(),
                    'postService' => $this->getPostService
        ));
    }

    /* Cập nhật bài viết */

    public function actionAllowEdit($id) {
        $data = $this->getPostService->findById($id);
        return $this->render('allow-edit', ['data' => $data]);
    }

    public function actionUpdate($postId, $redirect) {
        $model = $this->getPostService->findById($postId);
        if ($model->AllowEdit <= 0 && !$this->getPostService->getRole('allowEdit')) {
            $this->redirect('/app433/post/allow-edit?id=' . $postId);
        }
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
            $this->getVideoService->resetSessionItem();
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
        }
        return $this->render("form", array(
                    'model' => $model,
                    'modelVideo' => $modelVideo,
                    'mes' => $mes,
                    'matchInfo' => $matchInfo,
                    'newsId' => "",
                    'starId' => "",
                    'ttvnId' => "",
                    'categories' => $listCategories->findAll(),
                    'postService' => $this->getPostService
        ));
    }

    /* Danh sách sự kiện bài live */

    public function actionUpdateLive($postId) {

        $listEvent = $this->getLiveService->findByPostId($postId, 'Order');
        $order = isset($listEvent[0]) ? $listEvent[0]->Order + 1 : 1;
        return $this->render('formLive', array(
                    'data' => $listEvent,
                    'order' => $order,
                    'postId' => $postId
        ));
    }

    /* Upload image trong ckeditor */

    public function actionUploadImg() {
        $upload = new \app\modules\app433\services\UploadService();
        $view = "";
        foreach ($_FILES['file_up']['name'] as $k => $v) {
            $fileName = $v;
            $tmpName = $_FILES['file_up']['tmp_name'][$k];
            $file = $upload->uploadCkE("images", $tmpName, $fileName);
            $path = \Yii::$app->params['pathMedia'] . $file;
            if ($k == 0) {
                $view.= '<img width="100%" src="' . $path . '"/>';
            } else {
                $view.= '<br/><img width="100%" src="' . $path . '"/>';
            }
        }
        echo $view;
        die;
    }

    /* Upload video trong ckeditor */

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
        echo '<video width="100%" controls="true">'
        . '<source src="' . $path . '" type="video/mp4">'
        . '</video><br>';


        die;
    }

    public function actionUploadVideoPoster() {
        $upload = new \app\modules\app433\services\UploadService();
        $tmpName = $_FILES['videoFile']['tmp_name'];
        $fileName = $_FILES['videoFile']['name'];
        $file = $upload->uploadCkE("videos", $tmpName, $fileName);
        if ($file == "") {
            echo "loi";
            die;
        }
        $pathVideo = \Yii::$app->params['pathMedia'] . $file;
        $pathPoster = "";
//Upload thumb
        $path = date("Y/m/d");
        $poster = $upload->uploadBase64("images/" . $path, $_POST['imageFile'], 480, 270);
        if ($poster != false) {
            $pathPoster = \Yii::$app->params['pathMedia'] . "/media433/images/" . $path . "/" . $poster;
        }
        echo '<video width="100%" controls="true" poster="' . $pathPoster . '">'
        . '<source src="' . $pathVideo . '" type="video/mp4">'
        . '</video><br>';


        die;
    }

    /* Thêm 1 video vào album video */

    public function actionAddItemVideo() {
        $session = new \yii\web\Session();
        if (!$session->isActive) {
            $session->open();
        }
        echo $this->getPostService->addItem($_FILES, $_POST);
        die;
    }

    /* Sửa 1 video trong album video */

    public function actionEditItemVideo() {
        $session = new \yii\web\Session();
        if (!$session->isActive) {
            $session->open();
        }
        echo $this->getPostService->editItem($_FILES, $_POST);
        die;
    }

    /* Xóa 1 video khỏi album video */

    public function actionRemoveItemVideo($id) {
        $session = new \yii\web\Session();
        if (!$session->isActive) {
            $session->open();
        }
        echo $this->getPostService->removeItem($id);
        die;
    }

    /* Album video danh sách video */

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

    /* Thêm mới sự kiện bài live */

    public function actionAddEvent() {
        $model = new MatchLiveEvent();
        $userId = \Yii::$app->user->id;
        $date = date("Y-m-d H:i:s");
        $model->UserCreate = $userId;
        $model->UserUpdate = $userId;
        $model->DateCreate = $date;
        $model->DateUpdate = $date;
        $liveService = new LiveService();
        $add = $liveService->save($_FILES, $_POST, $model);
        if ($add) {
            echo "Thêm dữ liệu thành công.";
        } else {
            echo "Lỗi hệ thống.";
        }
        die;
    }

    /* Chỉnh sửa sự kiện bài live */

    public function actionEditEvent() {
        $model = new MatchLiveEvent();
        $model = MatchLiveEvent::find()->where(['ID' => $_POST['id']])->one();
        $userId = \Yii::$app->user->id;
        $date = date("Y-m-d H:i:s");
        $model->UserUpdate = $userId;
        $model->DateUpdate = $date;
        $liveService = new LiveService();
        $add = $liveService->save($_FILES, $_POST, $model);
        if ($add) {
            echo "Thêm dữ liệu thành công.";
        } else {
            echo "Lỗi hệ thống.";
        }
        die;
    }

    /* Danh sách sự kiện bài live */

    public function actionReloadEvent($postId) {

        $this->layout = false;
        $listEvent = $this->getLiveService->findByPostId($postId, 'Order');
        $order = isset($listEvent[0]) ? $listEvent[0]->Order + 1 : 1;
        return $this->render('reload-event', [
                    'data' => $listEvent,
                    'order' => $order,
        ]);
//'order' => $listEvent[0]->Order + 1,
    }

    /* Xóa sự kiện bài live */

    public function actionDelEvent($id) {
        $del = $this->getLiveService->delById($id);
        if ($del) {
            echo 1;
        } else {
            echo 0;
        }
        die;
    }

    /* Lấy thông tin sự kiện bài live theo ID */

    public function actionFindByEventId($id) {
        $data = $this->getLiveService->findByEventId($id);
        $arr = array();
        $arr['Minute'] = $data->Minute;
        $arr['PostID'] = $data->PostID;
        $arr['Type'] = $data->Type;
        $arr['Content'] = $data->Content;
        $arr['UrlVideo'] = $data->UrlVideo;
        $arr['Order'] = $data->Order;
        echo json_encode($arr);
        die;
    }

    /* Lấy logo chuyên mục */

    public function actionGetImgCategories($id) {
        $categoriesService = new CategoriesService();
        $objectCategories = $categoriesService->findById($id);
        $img = "http://posts.media.profile.bongda433.com/" . $objectCategories->Logo;
        echo $img;
        die;
    }

    /* Tìm kiếm trận trong bài live */

    public function actionSearchMatch($keyword) {
        $this->layout = false;
        $data = $this->getLiveService->searchMatch($keyword);
        return $this->render('search-match', array('data' => $data));
    }

    /* Xóa tin */

    public function actionDeletePost($id) {
        $this->getPostService->deletePost($id);
        die;
    }

    /* Kho tin 90phut */

    public function actionListNews() {
        $public = $this->getParams('public', '');
        $keyword = $this->getParams('keyword', '');
        $date = $this->getParams('StartDate', '');
        $data = $this->getNewsService->news90phut($public, $keyword, $date);
        return $this->render('listNews', array(
                    "data" => $data['data'],
                    'pagination' => $data['pagination']
        ));
    }

    /* Kho tin người đẹp 90phut */

    public function actionListStar() {
        $public = $this->getParams('public', '');
        $keyword = $this->getParams('keyword', '');
        $data = $this->getStarService->getListStar($keyword, $public);
        return $this->render('listStar', array(
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
