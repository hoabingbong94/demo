<?php

namespace app\modules\app90phut\controllers;

use app\modules\app90phut\models\News;
use app\modules\app90phut\services\NewsService;
use app\modules\app90phut\services\CategoryService;
use Yii;
use yii\data\Pagination;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use app\modules\app433\services\CategoriesService;
use app\modules\app433\models\Post;
use app\modules\app433\models\Categories;
use app\modules\app433\models\Post90phut;

class NewsController extends Controller {

    public $layout = 'post';
    public $NewsService;
    private $category433 = null;
    private $thumbnailsCover = null;

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
                            'nopublich',
                            'all',
                            'search-video-ajax',
                            'allow-edit'
                        ],
                        'allow' => true,
                        'roles' => ['90phut_news'],
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
        $this->NewsService = new NewsService();
        $this->category433 = new CategoriesService();
        //parent::__construct($config);
    }

    public function actionIndex() {

        $param['keyword'] = isset($_GET["keyword"]) ? $_GET["keyword"] : "";
        $param['category'] = isset($_GET["category"]) ? $_GET["category"] : 0;
        $param['type'] = isset($_GET["type"]) ? $_GET["type"] : 0;
        $param['page'] = isset($_GET["page"]) ? $_GET["page"] : 1;
        $param['urlback'] = urlencode(Url::current());

        $category = $this->NewsService->getCategory();
        $data = $this->NewsService->findAll($param);

        return $this->render('index', [
                    "param" => $param,
                    "category" => $category,
                    "data" => $data,
        ]);
    }

    public function actionSearchVideoAjax() {
        $keyword = isset($_GET["keyword"]) ? $_GET["keyword"] : "";
        $data = $this->NewsService->SearchVideoAjax($keyword);
        return $this->renderpartial("search-video-ajax", array('data' => $data)
        );
    }

    public function actionCreate() {
        try {
            $model433 = new Post();
            $post433 = new Post90phut();
            $model = new News();
            $model->Contents = "";
            $mes = "";
            //        sửa thêm
            $category433 = $this->category433->findAll();
            //        kết thúc
            $urlback = isset($_GET["urlback"]) ? urldecode($_GET["urlback"]) : "/app90phut/news";
            $category = $this->NewsService->getCategoryArray();
            $categoryPc = $this->NewsService->getCategoryPcArray();

            if ($model->load(\Yii::$app->request->post())) {
                $model433->ThumbnailsCover = $model->thumbnailsCover;
                $save = $this->NewsService->saveData($model, $_POST);
                if ($save) {
                    $mes = "Thêm mới thành cống";
                    if (isset($_POST['quit'])) {
                        $this->redirect("/app90phut/news");
                    } else {
                        $this->redirect(["update", 'id' => $model->ID,
                            'mes' => urlencode('Thêm mới thành công')]);
                    }
                }
            }

            return $this->render("_form", array('model' => $model,
                        'category' => $category,
                        'model433' => $model433,
                        'categoryPc' => $categoryPc,
                        'category433' => $category433,
                        'mes' => $mes,
                        'urlback' => $urlback
            ));
        } catch (Exception $exc) {
            echo "Loi :" . $exc->getTraceAsString();
        }
    }

    public function actionAllowEdit($id) {
        return $this->render('allow-edit', ['id' => $id]);
    }

    public function actionUpdate($id) {
        try {
            $postService = new \app\modules\app433\services\PostService();
            $model = $this->findModel($id);
            if ($model->AllowEdit <= 0 && !$postService->getRole('allowEdit')) {
                $this->redirect('/app90phut/news/allow-edit?id=' . $id);
            }
            $model433 = new Post();
            //$model433 = new Post::find()->where(['']);
            $post433 = Post90phut::find()->where(['NewsId' => $id])->one();
            if ($post433 != null) {
                $model433 = Post::find()->where(['ID' => $post433->PostID])->one();
            }
            //        sửa thêm
            $model->category433 = $model433->CategoryID;
            $category433 = $this->category433->findAll();
            //        kết thúc
            $category = $this->NewsService->getCategoryArray();
            $categoryPc = $this->NewsService->getCategoryPcArray();
            $mes = isset($_GET["mes"]) ? urldecode($_GET["mes"]) : "";
            $urlback = isset($_GET["urlback"]) ? urldecode($_GET["urlback"]) : "/app90phut/news";
//            var_dump($_POST); die;
            if ($model->load(\Yii::$app->request->post())) {
                //$model433->CategoryID = $model->category433;
                //$post433->NewsId = $model->ID;
                $save = $this->NewsService->saveData($model, $_POST);
//                var_dump($save); die;
                if ($save) {
                    $mes = "Cập nhật thành công";
                    if (isset($_POST['quit'])) {
                        return $this->redirect($urlback);
                    }
                }
            }
            return $this->render("_form", array('model' => $model,
                        'model433' => $model433,
                        'category' => $category,
                        'categoryPc' => $categoryPc,
                        'category433' => $category433,
                        'post433' => $post433,
                        'mes' => $mes,
                        'urlback' => $urlback
            ));
        } catch (Exception $exc) {
            echo "Loi :" . $exc->getTraceAsString();
        }
    }

    protected function findModel($id) {
        if (($model = News::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}

?>