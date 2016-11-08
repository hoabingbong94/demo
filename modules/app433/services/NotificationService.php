<?php

namespace app\modules\app433\services;

use yii\db\Query;
use app\modules\app90phut\models\News;
use app\modules\app90phut\models\MatchTips;
use app\modules\app433\models\NotificationLastTimeScan;
use app\modules\app433\models\Notification;

class NotificationService {
    /*
     * 1->News
     * 2->Tips
     */

    public function scanNews() {
        $time = $this->getLastTimeScan(1);
        $data = News::find()->where(['>', 'ExtendUpdateDate', $time])->orderBy("ExtendUpdateDate DESC")->all();
        if ($data != null) {
            $total = count($data);
            $this->updateLastTime($data[0]->ExtendUpdateDate, $total, 1);
            foreach ($data as $k => $v) {
                $this->saveNotice($v->ID, 0, 1, $v->ExtendUpdateDate);
            }
            return $total;
        } else {
            return 0;
        }
    }

    public function scanTips() {
        $time = $this->getLastTimeScan(2);
        $data = MatchTips::find()->where(['>', 'CreateDate', $time])->orderBy("CreateDate DESC")->all();
        if ($data != null) {
            $total = count($data);
            $this->updateLastTime($data[0]->CreateDate, $total, 2);
            foreach ($data as $k => $v) {
                $this->saveNotice(0, $v->MatchID, 2, $v->CreateDate);
            }
            return $total;
        } else {
            return 0;
        }
    }

    private function saveNotice($newsId, $matchId, $type, $time) {
        $model = new Notification();
        $model->NewsId = $newsId;
        $model->MatchId = $matchId;
        $model->Type = $type;
        $model->DateCreate = $time;
        $model->save();
    }

    private function updateLastTime($lastTime, $total, $type) {
        NotificationLastTimeScan::updateAll(['DateScan' => $lastTime, 'TotalRecord' => $total], "Type=" . $type);
    }

    private function getLastTimeScan($type) {
        $dataLastTime = NotificationLastTimeScan::find()->where(['Type' => $type])->one();
        return $dataLastTime->DateScan;
    }

    public function countNotification($type) {
        $date = date("Y-m-d") . " 00:00:00";
        $listNews = Notification::find()->where(['Type' => $type])
                ->andWhere(['>=', 'DateCreate', $date])
                ->all();
        return count($listNews);
    }

}
