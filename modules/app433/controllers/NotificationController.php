<?php

namespace app\modules\app433\controllers;

use app\modules\app433\services\NotificationService;
use yii\web\Controller;

class NotificationController extends Controller {

    private $getNotificationService = null;

    public function __construct($id, $module, $config = []) {
        $this->id = $id;
        $this->module = $module;
        $this->getNotificationService = new NotificationService();
    }

    public function actionIndex() {
        $numberNotice = $this->getNotificationService->scanNews();
        echo $numberNotice;
        die;
    }

    public function actionScanTips() {
        $numberNotice = $this->getNotificationService->scanTips();
        echo $numberNotice;
        die;
    }

    public function actionCountNotification($type) {
        $numberNotice = $this->getNotificationService->countNotification($type);
        echo $numberNotice;
        die;
    }

}
