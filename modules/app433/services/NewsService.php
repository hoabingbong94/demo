<?php

/*
 * Kho tin 90phut
 */

namespace app\modules\app433\services;

use yii\data\Pagination;
use yii\db\Query;
use app\modules\app433\models\SoccerMatchInfo;
use app\modules\app433\models\Post90phut;
use app\modules\app433\models\Post;

class NewsService {

//Danh sach tin tuc 90phut
    public function news90phut($public, $keyword, $date) {

        $fromDate = $date . " 00:00:00";
        $endDate = $date . " 23:59:59";
        //Quet danh sach tin da them
        $listData = Post90phut::find()->where(['Type' => 1])->orderBy("ID DESC")->limit(100)->all();
        $listId = array();
        foreach ($listData as $k => $v) {
            $listId[$v->NewsId] = $v->NewsId;
        }
        $query = new Query();
        $queryEx = $query->select(['a.ID', 'a.Title', 'a.Summary', 'a.Thumbnails', 'a.ExtendUpdateDate', 'b.CategoryName', 'c.FullName'])
                ->from('News as a')
                ->leftJoin('Category as b', 'a.CategoryID = b.CategoryID')
                ->leftJoin('Extend_User as c', 'c.ID = a.ExtendUserCreate')
                ->where(['LIKE', 'a.Title', $keyword])
                ->orWhere(['LIKE', 'a.Summary', $keyword])
                ->orWhere(['LIKE', 'a.Keyword', $keyword])
                ->andWhere(['NOT IN', 'a.ID', $listId]);
        if ($public != "") {
            $queryEx->andWhere(['a.ExtendIsPublic' => $public]);
        }
        if ($date != "") {
            $queryEx->andWhere([">=", 'a.ExtendUpdateDate', $fromDate]);
            $queryEx->andWhere(["<=", 'a.ExtendUpdateDate', $endDate]);
        }
        $queryEx->orderBy("a.ID DESC")
                ->limit(10);
        $command = $query->createCommand(SoccerMatchInfo::getDb());
        $data = $command->queryAll();
        $pagination = new Pagination([
            'defaultPageSize' => 10,
            'totalCount' => $query->count('*', SoccerMatchInfo::getDb()),
        ]);
        $data = $queryEx->orderBy("a.ID DESC")
                ->offset($pagination->offset)
                ->limit($pagination->limit)
                ->all(SoccerMatchInfo::getDb());
        return array('data' => $data, 'pagination' => $pagination);
    }

    public function findNews90phutById(Post $model, $newsId) {
        $query = new Query();
        $data = $query->select(['CategoryID', 'Title', 'Summary', 'Thumbnails', 'ThumbnailsPc', 'Contents', 'Keyword'])
                ->from('News')
                ->where(['ID' => $newsId])
                ->one(SoccerMatchInfo::getDb());
        if ($data != null) {
            //Filter Data
            $tipsService = new TipsService();
            $content90phut = $data['Contents'];
            //Clear data
            $contentFilter = $tipsService->clearTips($content90phut);
            //Copy images
            $images90phut = $data['Thumbnails'];
            if ($data['ThumbnailsPc'] != "") {
                $images90phut = $data['ThumbnailsPc'];
            }
            //$images = $tipsService->copyImage90phutTo433($images90phut);
            $images = "/90phut/" . $images90phut;
            $model->Title = $data['Title'];
            $model->Summary = $data['Summary'];
            $model->CategoryID = $data['CategoryID'];
            $model->Keyword = $data['Keyword'];
            $model->Thumbnails = "/" . $images;
            $model->Content = $contentFilter;
        }
        return $model;
    }

}
