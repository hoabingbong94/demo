<?php

/*
 * Kho tin người đẹp 90phut
 */

namespace app\modules\app433\services;

use app\modules\app90phut\models\Star;
use app\modules\app433\services\TipsService;
use yii\db\Query;
use app\modules\app433\models\Post;
use app\modules\app433\models\Post90phut;
use yii\data\Pagination;

class StarService {

    public function getListStar($keyword, $public) {
      
        //Bo qua tin da dang
        $listData = Post90phut::find()->where(['Type' => 2]) ->orderBy("ID DESC")->limit(100)->all();
        $listId = array();
        foreach ($listData as $k => $v) {
            $listId[$v->StarId] = $v->StarId;
        }
        $query = new Query();
        $queryEx = $query->select(['ID', 'Title', 'Summary', 'Thumbnails', 'Author', 'ReleaseDate'])
                ->from('Extend_Star')
                ->where(['LIKE', 'Title', $keyword])
                ->orWhere(['LIKE', 'Summary', $keyword])
                ->orWhere(['LIKE', 'Keyword', $keyword])
                ->andWhere(['NOT IN', 'ID', $listId]);
        if ($public != "") {
            $queryEx->where(['a.IsPublic' => $public]);
        }
        $queryEx->orderBy("ID DESC")
                ->limit(10);
        $command = $query->createCommand(Star::getDb());
        $data = $command->queryAll();
        $pagination = new Pagination([
            'defaultPageSize' => 10,
            'totalCount' => $query->count('*', Star::getDb()),
        ]);
        $data = $queryEx->orderBy("ID DESC")
                ->offset($pagination->offset)
                ->limit($pagination->limit)
                ->all(Star::getDb());
        return array('data' => $data, 'pagination' => $pagination);
    }

    public function findStar90phutById(Post $model, $starId) {
        
        //
        $data = Star::find()->where(['ID' => $starId])->one(Star::getDb());
        if ($data != null) {
            //Filter Data
            $tipsService = new TipsService();
            $content90phut = $data->Contents;
            $contentExtend = $data->ContentsExtend;
            //Clear data
            $contentExtendFilter = "";
            $contentFilter = $tipsService->clearTips(str_replace('style="width: 460;"', '', $content90phut));
            if ($contentExtend != "") {
                $contentExtendFilter = "<br/>" . $tipsService->clearTips(str_replace('style="width: 460;"', '', $contentExtend));
            }
            //Copy images
            $images90phut = $data['Thumbnails'];
            $images = $tipsService->copyImage90phutTo433($images90phut);
            $model->Title = $data['Title'];
            $model->Summary = $data['Summary'];
            $model->CategoryID = 0;
            $model->Keyword = $data['Keyword'];
            $model->Thumbnails = "/" . $images;
            $model->Content = $contentFilter . $contentExtendFilter;
        }
        return $model;
    }

    private function getStarId433() {
        $listData = Post90phut::find()->where(['Type' => 2])->orderBy("ID DESC")->limit(100)->all();
        $notIn = "";
        foreach ($listData as $k => $v) {
            $notIn.="'".$v->ID . "',";
        }
        return rtrim($notIn, ",");
    }

    public function updateNews90phut($starId) {
        //remove notice
        $model = new Post90phut();
        $model->NewsId = 0;
        $model->StarId = $starId;
        $model->UserCreate = \Yii::$app->user->id;
        $model->DateCreate = date("Y-m-d H:i:s");
        $model->Type = 2;
        $model->save();
    }

}
