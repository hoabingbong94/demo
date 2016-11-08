<?php

namespace app\modules\app433\services;

use app\modules\app433\models\MatchLiveEvent;
use app\modules\app433\services\UploadService;
use app\modules\app433\models\SoccerMatchInfo;

class LiveService {

    public function findByPostId($postId, $order = 'ID') {
        $data = MatchLiveEvent::find()->where(['PostID' => $postId])->orderBy($order . ' DESC')->all();
        return $data;
    }

    public function findByEventId($id) {
        $data = MatchLiveEvent::find()->where(['ID' => $id])->one();
        return $data;
    }

    public function delById($id) {
        $del = MatchLiveEvent::deleteAll(['ID' => $id]);
        if ($del) {
            return true;
        } else {
            return false;
        }
    }

    public function save($files, $post, MatchLiveEvent $model) {
        if (isset($post['id']) && $post['id'] != null) {
            $model->ID = addslashes($post['id']);
        }
        $model->Minute = $post['minute'];
        $model->PostID = addslashes($post['postId']);
        $model->Type = addslashes($post['eventType']);
        $strContent = preg_replace('/(<br>)+$/', '', $post['content']);
        $model->Content = $strContent;
        $model->Order = addslashes($post['order']);
        //
        if (isset($files['videoFile']['name'])) {
            $upload = new UploadService();
            $tmpName = $files['videoFile']['tmp_name'];
            $name = $files['videoFile']['name'];
            $video = $upload->uploadCkE("videos", $tmpName, $name);
            $model->UrlVideo = $video;
        }

        $add = $model->save();
        if ($add) {
            return true;
        } else {
            return false;
        }
    }

    public function searchMatch($strKeyword) {
        $date = date("Y-m-d");
        $query = "SELECT MatchID,HomeName,AwayName,StartTime,MatchState FROM Soccer_Match_Info 
WHERE (AwayName LIKE '$strKeyword%' OR HomeName LIKE '$strKeyword%') AND StartTime >= '$date 00:00:00' ORDER BY StartTime DESC LIMIT 10";
        $rs = SoccerMatchInfo::findBySql($query)->all();
        return $rs;
    }

    public function getMatchById($matchId) {
        $matchInfo = SoccerMatchInfo::find()->where(['MatchID' => $matchId])->one();
        return $matchInfo;
    }

}
