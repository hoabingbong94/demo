<?php

namespace app\modules\app433\services;

use app\modules\app433\models\VideoHighlight;

class VideoHighlightService {

    public function removeAll($postId) {
        $model = new VideoHighlight();
        $model->deleteAll(['PostID' => $postId]);
    }

    public function save($postId) {
        $session = new \yii\web\Session();
        if (!$session->isActive) {
            $session->open();
        }
        $listVideo = $session["listTmp"];
        if ($listVideo != null) {
            foreach ($listVideo as $k => $v) {
                $model = new VideoHighlight();
                $model->Title = $v['title'];
                $model->Avatar =  $v['images'];
                $model->UrlVideo =  $v['video'];
                $model->PostID = $postId;
                $model->OrderNumber = $v['order'];
                $model->CreateDate = date('Y-m-d H:i:s');
                $model->UpdateDate = date('Y-m-d H:i:s');
                $model->save();
            }
        }
        $session->remove("listTmp");
    }

    public function findById($postId) {
        $session = new \yii\web\Session();
        if (!$session->isActive) {
            $session->open();
        }
        $list = VideoHighlight::find()->where(['PostID' => $postId])->all();
        $listItem = array();
        foreach ($list as $k => $v) {
            $listItem[$k]['title'] = $v->Title;
            $listItem[$k]['images'] = $v->Avatar;
            $listItem[$k]['video'] = $v->UrlVideo;
            $listItem[$k]['order'] = $v->OrderNumber;
        }
        $session["listTmp"] = $listItem;
        return $listItem;
    }

    public function resetSessionItem() {
        $session = new \yii\web\Session();
        if (!$session->isActive) {
            $session->open();
        }
        $session->remove("listTmp");
        $session->remove("listtag");
    }

}
