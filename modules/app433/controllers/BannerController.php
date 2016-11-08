<?php

namespace app\modules\app433\controllers;

use app\modules\app433\services\BannerService;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use app\modules\app433\models\Banner;

class BannerController extends Controller {

    private $getBannerService = null;
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
                            'delete'
                        ],
                        'allow' => true,
                        'roles' => ['433_banner'],
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
        $this->getBannerService = new BannerService();
        //parent::__construct($config);
    }

    public function actionIndex() {
        $data = $this->getBannerService->findAll();
        return $this->render('index', array(
                    "listBanner" => $data['data'],
                    'pagination' => $data['pagination']
        ));
    }

    public function actionCreate() {
        $model = new Banner();
        if ($model->load(\Yii::$app->request->post())) {
            $this->getBannerService->save($model);
            $this->redirect('/app433/banner');
        }
        return $this->render('form', array('model' => $model));
    }

    public function actionUpdate($id) {
        $model = $this->getBannerService->findById($id);
        if ($model->load(\Yii::$app->request->post())) {
            $this->getBannerService->save($model);
            $this->redirect('/app433/banner');
        }
        return $this->render('form', array('model' => $model));
    }
    public function actionDelete($id){
        $this->getBannerService->delete($id);
        $this->redirect('/app433/banner');
    }

}
