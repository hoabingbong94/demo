<?php

namespace app\modules\app433\services;

use app\modules\app433\models\MatchTips;
use yii\data\Pagination;
use yii\db\Query;
use app\modules\app433\services\UploadService;
use app\modules\app433\services\TagService;
use app\modules\app433\models\SoccerMatchInfo;

class TipsService {

    private function getListMatchByDay() {
        $query = new Query();
        $data = $query->select(['a.MatchID'])
                        ->from('Extend_Match_Tips AS a')
                        ->innerJoin('Soccer_Match_Info AS b', 'a.MatchID=b.MatchID')
                        ->where(['>=', 'b.StartTime', date("Y-m-d H:i:s")])->all(SoccerMatchInfo::getDb());
        $listMatch = array();
        foreach ($data as $key => $values) {
            $listMatch[$key] = $values['MatchID'];
        }
        return $listMatch;
    }

    public function findAll($keyword, $public, $datePost, $type) {
        $listMatch = $this->getListMatchByDay();
        $dateOff = [];
        $query = new Query();
        $queryEx = $query->select([
                    'a.MatchID',
                    'a.Title',
                    'a.Description',
                    'a.CreateDate',
                    'b.CategoryName',
                    'b.LOGO',
                    'b.TitleAlias',
                    'c.fullname'
                ])->from('Match_Tips as a')
                ->leftJoin('Categories as b', 'a.CategoryID = b.CategoryID')
                ->leftJoin('Admin_Cms as c', 'c.id = a.UserCreate')
                ->where(['LIKE', 'a.Title', $keyword])
                ->andWhere(['IN', 'a.MatchID', $listMatch]);
        $queryEx->orderBy("a.CreateDate DESC")
                ->limit(10);
        $command = $query->createCommand();
        $pagination = new Pagination([
            'defaultPageSize' => 10,
            'totalCount' => $query->count(),
        ]);
        $data = $queryEx->orderBy("a.CreateDate DESC")
                        ->offset($pagination->offset)->limit($pagination->limit)->all();

        return array('data' => $data, 'pagination' => $pagination);
    }

    public function findTips90phutByMatchId($matchId) {
        $query = new Query();
        $data = $query->select(['Title',
                    'Tips',
                    'Description',
                    'Keyword',
                    'Image',
                    'Author',
                ])->from('Extend_Match_Tips')
                ->where(['MatchID' => $matchId])
                ->one(\app\modules\app433\models\SoccerMatchInfo::getDb());
        return $data;
    }

    public function findById($matchId) {
        return MatchTips::find()->where(['MatchID' => $matchId])->one();
    }

    public function save(MatchTips $model) {
        $upload = new UploadService();
        $path = date("Y/m/d");
        $images = $upload->uploadBase64("images/" . $path, $model->Image, 670, 377);
        if ($images != false) {
            $model->Image = "/media433/images/" . $path . "/" . $images;
        }
        $date = date('Y-m-d H:i:s');
        $userId = \Yii::$app->user->id;
        $model->UserUpdate = $userId;
        $model->UpdateDate = $date;
        //Check ton tai
        $data = MatchTips::find()->where(['MatchID' => $model->MatchID])->one();
        if ($data != null) {
            $save = $model->update();
        } else {
            $save = $model->save();
        }
        if ($save) {
            $matchId = $model->MatchID;
            $tagService = new TagService();
            $tagService->removeTipsTag($matchId);
            $tagService->addTag($model->Tips, $matchId, "tips");
            //Remove notice
            @\app\modules\app433\models\Notification::deleteAll(['MatchId' => $matchId, 'Type' => 2]);
            return true;
        } else {
            return false;
        }
    }

    public function listMatch($today, $keyword) {
        /* get list matchId */
        $first_date = "";
        $last_date = "";
        if ($today == "") {
            $d = date("Y-m-d");
            $h = date("H");
            if ($h < 11) {
                $first_date = strtotime('-1 day', strtotime($d));
                $first_date = date('Y-m-d', $first_date);
                $last_date = $d;
            } else {
                $first_date = $d;
                $last_date = strtotime('+1 day', strtotime($d));
                $last_date = date('Y-m-d', $last_date);
            }
        } else {
            $first_date = date('Y-m-d', strtotime($today));
            $last_date = strtotime('+1 day', strtotime($today));
            $last_date = date('Y-m-d', $last_date);
        }
        $first_date .=' 11:00:00.000';
        //echo $first_date;die;
        $last_date .= ' 10:59:59.000';
        $query = new Query();
        $data = $query->select(['a.AwayName',
                    'a.HomeName',
                    'a.MatchID',
                    'a.MatchPeriod',
                    'a.MatchState',
                    'a.Score',
                    'a.StartTime',
                    'a.AwayID',
                    'a.HomeID',
                    'b.CompetitionID',
                    'b.NameVN',
                    'c.Description'
                ])
                ->from('Soccer_Match_Info as a')
                ->leftJoin('Soccer_LeagueInfo_Details as b', 'a.LeagueID=b.CompetitionID')
                ->leftJoin('Extend_Match_Tips as c', 'a.MatchID=c.MatchID')
                ->where(['LIKE', 'a.HomeName', $keyword])
                ->orWhere(['LIKE', 'a.AwayName', $keyword])
                ->andWhere(['>=', 'a.StartTime', $first_date])
                ->andWhere(['<=', 'a.StartTime', $last_date])
                ->orderBy('b.CompetitionID DESC')
                ->limit(500)
                ->all(SoccerMatchInfo::getDb());
        $listMatchId = array();
        foreach ($data as $k => $v) {
            $listMatchId[$v['MatchID']] = $v['MatchID'];
        }
        $dataTip = MatchTips::find()->where(['IN', 'MatchID', $listMatchId])->all();
        $matchTmp = array();
        foreach ($dataTip as $kTips => $vTips) {
            $matchTmp[$vTips->MatchID] = $vTips->MatchID;
        }
        $listMatch = array();
        foreach ($data as $kMatch => $vMatch) {
            $matchId = $vMatch['MatchID'];
            if (!isset($matchTmp[$matchId])) {
                $listMatch[$kMatch] = $vMatch;
            }
        }
        return $listMatch;
    }

    public function copyImage90phutTo433($images) {
        $upload = new UploadService();
        $imageSplit = explode("/", $images);
        $fileName = $imageSplit[(count($imageSplit) - 1)];
        //Create folder upload
        $path = date("Y/m/d");
        $upload->mkdir(PathUpload . "images/");
        $patchCopy = PathUpload . "images/" . $path . "/" . $fileName;
        @copy("http://90phut.vn/service/" . $images, $patchCopy);
        return "media433/images/" . $path . "/" . $fileName;
    }

    public function copyVideo90phutTo433($fileVideo) {
        $upload = new UploadService();
        $videoSplit = explode("/", $fileVideo);
        $fileName = $videoSplit[(count($videoSplit) - 1)];
        //Create folder upload
        $path = date("Y/m/d");
        $upload->mkdir(PathUpload . "videos/");
        $patchCopy = PathUpload . "videos/" . $path . "/" . $fileName;
        copy("http://90phut.vn/service/" . $fileVideo, $patchCopy);
        return "videos/" . $path . "/" . $fileName;
    }

    private function better_strip_tags($text, $tags = false, $replace = '') {
        if ($tags === false) {
            return strip_tags($text);
        }
        if (!is_array($tags)) {
            $tags = array($tags);
        }
        foreach ($tags as $tag) {
            $text = preg_replace("/<[\/\!]*?" . $tag . "[^<>]*?>/si", $replace, $text);
        }
        return $text;
    }

    private function replace_img_src($img_tag) {
        $doc = new \DOMDocument();
        libxml_use_internal_errors(true);
        $doc->loadHTML(mb_convert_encoding($img_tag, 'HTML-ENTITIES', 'UTF-8'));
        $tags = $doc->getElementsByTagName('img');
        foreach ($tags as $tag) {
            $srcImg = "/90phut/" . $tag->getAttribute('src');
            //$newFile = \Yii::$app->params['pathMedia'] . "/" . $this->copyImage90phutTo433($srcImg);
            //$newFile = \Yii::$app->params['pathMedia'] . "/" . $this->copyImage90phutTo433($srcImg);
            $tag->setAttribute('src', $srcImg);
        }
        return $doc->saveHTML();
    }

    private function replace_video_src($video_tag) {
        $doc = new \DOMDocument();
        libxml_use_internal_errors(true);
        $doc->loadHTML(mb_convert_encoding($video_tag, 'HTML-ENTITIES', 'UTF-8'));
        $tags = $doc->getElementsByTagName('source');
        foreach ($tags as $tag) {
            //$srcVideo = str_replace("/service/", "", $tag->getAttribute('src'));
            //$newFile = \Yii::$app->params['pathMedia'] . "/" . $this->copyVideo90phutTo433($srcVideo);

            $newFile = "/90phut/" . $tag->getAttribute('src');
            $tag->setAttribute('src', $newFile);
            $tag->setAttribute('style', "width:100%;");
        }
        return $doc->saveHTML();
    }

    private function getPosterVideo90phut($poster_tag) {
        $doc = new \DOMDocument();
        libxml_use_internal_errors(true);
        $doc->loadHTML(mb_convert_encoding($poster_tag, 'HTML-ENTITIES', 'UTF-8'));
        $tags = $doc->getElementsByTagName('video');
        foreach ($tags as $tag) {
            $srcImage = str_replace("/service/", "", $tag->getAttribute('poster'));
            $newFile = \Yii::$app->params['pathMedia'] . $this->copyImage90phutTo433($srcImage);
            $tag->setAttribute('poster', $newFile);
            $tag->setAttribute('width', '100%');
            $tag->setAttribute('height', 'auto');
            $tag->setAttribute('style', "width:100%;");
        }
        return $doc->saveHTML();
    }

    public function clearTips($tips) {
        //Remove Tag
        $arrListTag = array('[tag]', '[/tag]', '<div', '</div>', 'width:320px;');
        $arrRemoveTag = array('', '', '<p', '</p>', '');
        $clearTag = str_replace($arrListTag, $arrRemoveTag, $tips);
        $tipsImg = $this->replace_img_src($clearTag);
        $tipsPoster = $this->getPosterVideo90phut($tipsImg);
        $tipsVideo = $this->replace_video_src($tipsPoster);
        //Remove Link
        return $this->better_strip_tags($tipsVideo, 'a');
    }

    public function getData90Phut(MatchTips $model, $matchId) {
        $data = $this->findTips90phutByMatchId($matchId);
        $model->MatchID = $matchId;
        if ($data != null) {
            $model->Title = $data['Title'];
            $model->Description = strip_tags($data['Description']);
            $model->Keyword = $data['Keyword'];
            $model->Author = $data['Author'];
            if ($data['Image'] != null) {
                $model->Image = $this->copyImage90phutTo433($data['Image']);
            }
            $model->Tips = $this->clearTips($data['Tips']);
        }
        return $model;
    }

}
