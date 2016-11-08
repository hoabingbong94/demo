<?php

namespace app\modules\app433\controllers;

use app\modules\app433\services\TipsService;
use app\modules\app433\models\MatchTips;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use app\modules\app433\services\CategoriesService;
use app\modules\app433\services\VideoHighlightService;

class TipsController extends Controller {

    private $getTipsService = null;
    private $getVideoService = null;
    public $layout = 'post';

    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => [
                            'index',
                            'update',
                            'list-match',
                            'create'
                        ],
                        'allow' => true,
                        'roles' => ['433_tips'],
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
        $this->getTipsService = new TipsService();
        $this->getVideoService = new VideoHighlightService();

        //parent::__construct($config);
    }

    public function actionIndex() {
        $keyword = isset($_GET["keyword"]) ? $_GET["keyword"] : "";
        $public = isset($_GET["public"]) ? $_GET["public"] : "";
        $datePost = isset($_GET["datePost"]) ? $_GET["datePost"] : "";
        $type = isset($_GET["type"]) ? $_GET["type"] : "";

        $data = $this->getTipsService->findAll($keyword, $public, $datePost, $type);
        
        return $this->render('index', array(
                    "listPost" => $data['data'],
                    'pagination' => $data['pagination']
        ));
    }

    public function actionListMatch() {
        $dateTime = isset($_GET["StartDate"]) ? $_GET["StartDate"] : "";
        $keyword = isset($_GET["Keyword"]) ? $_GET["Keyword"] : "";
        $data = $this->getTipsService->listMatch($dateTime, $keyword);
        return $this->render('listMatch', array(
                    'data' => $data,
                    'keyword' => $keyword,
                    'dateTime' => $dateTime != "" ? $dateTime : date("Y-m-d")
        ));
    }

    public function actionUpdate($matchId) {
        $listCategories = new CategoriesService();
        $model = $this->getTipsService->findById($matchId);
        $mes = "";
        if ($model->load(\Yii::$app->request->post())) {
            $checkButton = $_POST['redirect'];
            $this->getTipsService->save($model);
            $this->redirectAfterSave($checkButton, $matchId, 'update');
        } else {
            $this->getVideoService->resetSessionItem();
            $model->Description = strip_tags($model->Description);
        }
        return $this->render('form', array(
                    'model' => $model,
                    'mes' => $mes,
                    'categories' => $listCategories->findAll())
        );
    }

    public function actionCreate($matchId) {
        //Find tips 90phut
        $mes = "";
        $listCategories = new CategoriesService();
        $model = new MatchTips();
        if ($model->load(\Yii::$app->request->post())) {
            //echo $model->MatchID;
            //die;
            $checkButton = $_POST['redirect'];
            $model->CreateDate = date("Y-m-d H:i:s");
            $model->UserCreate = \Yii::$app->user->id;
            $this->getTipsService->save($model);
            echo "<script>window.close();</script>";
            die;
            //$this->redirectAfterSave($checkButton, $matchId, 'create');
        } else {
            $model = $this->getTipsService->getData90Phut($model, $matchId);
            $this->getVideoService->resetSessionItem();
        }
        return $this->render('form', array('model' => $model,
                    'mes' => $mes,
                    'categories' => $listCategories->findAll())
        );
    }

    private function redirectAfterSave($redirect, $matchId, $flag) {
        if ($redirect == "post") {
            $this->redirect("/app433/tips");
        } else {
            $this->redirect("/app433/tips/update?matchId=" . $matchId . "&redirect=" . $flag);
        }
    }

}
