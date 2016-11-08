<?php

namespace app\modules\app90phut\controllers;

use Yii;
use app\modules\app90phut\models\SoccerMatchInfo;
use app\modules\app90phut\models\ExtendMatchTips;
use app\modules\app90phut\models\SoccerMatchInfoSearch;
use app\modules\app90phut\services\SoccerMatchInfoService;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\db\Query;
use yii\helpers\Url;
use app\modules\app433\services\CategoriesService;
use app\modules\app433\models\MatchTips;
use app\modules\app433\models\Categories;
use app\modules\app433\services\PostService;

/**
 * SoccerMatchInfoController implements the CRUD actions for SoccerMatchInfo model.
 */
class SoccerMatchInfoController extends Controller {

    public $layout = 'post';
    public $SoccertMatchInfoService;
    private $categories433 = null;
    private $postService = null;

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => [
                            'index',
                            'tips',
                            'create',
                            'update',
                            'search-team'
                        ],
                        'allow' => true,
                        'roles' => ['90phut_nhandinh'],
                    ],
                ],
            ],
//            'verbs' => [
//                'class' => VerbFilter::className(),
//                'actions' => [
//                    'logout' => ['post'],
//                ],
//            ],
        ];
    }

    public function __construct($id, $module, $config = []) {
        $this->id = $id;
        $this->module = $module;
        $this->SoccertMatchInfoService = new SoccerMatchInfoService();
        $this->categories433 = new CategoriesService();
        $this->postService = new PostService();
        //parent::__construct($config);
    }

    /**
     * Lists all SoccerMatchInfo models.
     * @return mixed
     */
    public function actionIndex() {

        $start = \app\services\FunctionStatic::getdate("-1 day");
        $end = \app\services\FunctionStatic::getdate("+5 day");
        $param['keyword'] = isset($_GET["Keyword"]) ? $_GET["Keyword"] : "";
        $param['state'] = isset($_GET["State"]) ? $_GET["State"] : 3;
        $param['type'] = isset($_GET["Type"]) ? $_GET["Type"] : 0;
        $param['start_date'] = isset($_GET["StartDate"]) ? $_GET["StartDate"] : $start;
        $param['end_date'] = isset($_GET["EndDate"]) ? $_GET["EndDate"] : $end;
        $param['page'] = isset($_GET["page"]) ? $_GET["page"] : 1;
        $param['urlback'] = urlencode(Url::current());
        $data = $this->SoccertMatchInfoService->findAll($param['keyword'], $param['state'], $param['type'], $param['start_date'], $param['end_date'], $param['page']);
        return $this->render('index', array(
                    "data" => $data['data'],
                    "param" => $param,
                    'pages' => $data['pages']
        ));
    }

    /**
     * Displays a single SoccerMatchInfo model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    public function actionTips($id) {
        $model433 = new MatchTips();
        $tips = $this->SoccertMatchInfoService->getTips($id);
        if ($tips != null && $tips->AllowEdit <= 0 && !$this->postService->getRole('allowEdit')) {
            $this->redirect('/app90phut/news/allow-edit?id=' . $id);
        }
        $tips->MatchID = $id;
        $urlback = isset($_GET["urlback"]) ? urldecode($_GET["urlback"]) : "/app90phut/soccer-match-info";
        $match = $this->findModel($id);
        $category = $this->SoccertMatchInfoService->getCategoryTipPC();
        $categories433 = $this->categories433->findAll();
        $pin = $this->SoccertMatchInfoService->getPinStatus($id);
        $mes = "";
        $this->SoccertMatchInfoService->getPin($tips);
        if ($tips->load(Yii::$app->request->post())) {

            $save = $this->SoccertMatchInfoService->savedata($tips, $_FILES, $_POST);
            if ($save) {
                $mes = "Cập nhật thành công";
                if (isset($_POST['quit'])) {
                    return $this->redirect($urlback);
                }
            }
        }

        return $this->render('tips', [
                    'tips' => $tips,
                    'match' => $match,
                    'category' => $category,
                    'categories433' => $categories433,
                    'pin' => $pin,
                    'mes' => $mes,
                    'urlback' => $urlback
        ]);
    }

    /**
     * Creates a new SoccerMatchInfo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new SoccerMatchInfo();
        //$model433 = new MatchTips();
        $model->StartTime = date("Y-m-d H:i:s");
        $model->Score = "0 - 0";
        $model->MinutePlaying = 0;
        $model->MinuteEx = 0;
        $model->LeagueID = 10001;
        $model->MatchState = 1;
        //$model433->CategoryID = 0;
        if ($model->load(Yii::$app->request->post())) {
            //$model433->pin = $tips->pin433;
            //$model433->CategoryID = $tips->CategoryID;
            $save = $this->SoccertMatchInfoService->SaveMatch($model);

            if ($save) {

                return $this->redirect(['/app90phut/soccer-match-info']);
            }
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing SoccerMatchInfo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($matchid) {

        $model = $this->findModel($matchid);
        $urlback = isset($_GET["urlback"]) ? urldecode($_GET["urlback"]) : "/app90phut/soccer-match-info";
        if ($model->load(Yii::$app->request->post())) {
            $save = $this->SoccertMatchInfoService->SaveMatch($model);
            if ($save) {
                return $this->redirect(['/app90phut/soccer-match-info']);
            }
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing SoccerMatchInfo model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionSearchTeam($keyword) {
        $keyword = isset($_REQUEST["keyword"]) ? $_REQUEST["keyword"] : "";
        $data = $this->SoccertMatchInfoService->SearchTeam($keyword);

        return $this->renderpartial("search-team", array('data' => $data)
        );
    }

    protected function findModel($id) {
        if (($model = SoccerMatchInfo::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
