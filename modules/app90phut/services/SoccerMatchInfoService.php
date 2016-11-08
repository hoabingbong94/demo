<?php

namespace app\modules\app90phut\services;

use app\modules\app90phut\models;
use app\modules\app90phut\services;
use app\modules\app90phut\models\ExtendCategory;
use app\modules\app90phut\models\ExtendMatchTips;
use yii\data\Pagination;
use yii\db\Query;
use Yii;
use app\modules\app433\models\MatchTips;
use app\modules\app433\services\TipsService;

class SoccerMatchInfoService {

    public function findAll($keyword, $state, $type, $start_date, $end_date, $page) {

        $start = ($page - 1) * 20;

        $sql = 'FROM Soccer_Match_Info as a Left Join Soccer_LeagueInfo_Details b on  a.LeagueID=b.CompetitionID'
                . ' Left Join Extend_Match_Tips c on a.MatchID = c.MatchID'
                . ' WHERE a.StartTime >= :startdate AND a.StartTime<=:enddate'
                . ' AND (a.AwayName LIKE :keyword or a.HomeName LIKE :keyword)'
        ;

        $sqlcount = "SELECT COUNT(*) " . $sql;

        $count = Yii::$app->db2->createCommand($sqlcount)
                ->bindValue(':startdate', $start_date)
                ->bindValue(':enddate', $end_date)
                ->bindValue(':keyword', "%$keyword%")
                ->queryScalar();

        $sql = 'SELECT a.MatchID,'
                . ' a.AwayName,'
                . ' a.HomeName,'
                . ' a.MatchPeriod,'
                . ' a.MatchState,'
                . ' a.StartTime,'
                . ' a.AwayID,'
                . ' a.HomeID,'
                . ' c.Author,'
                . ' c.Description,'
                . ' c.hot,'
                . ' b.CompetitionID,'
                . ' b.NameVN ' . $sql . ' Limit :start,20';

        $post = Yii::$app->db2->createCommand($sql)
                ->bindValue(':startdate', $start_date)
                ->bindValue(':enddate', $end_date)
                ->bindValue(':start', $start)
                ->bindValue(':keyword', "%$keyword%")
                ->queryAll();

        $pages = new Pagination(['totalCount' => $count]);

        return array('data' => $post, 'pages' => $pages);
    }

    public function getTips($id) {
        if (($model = models\ExtendMatchTips::findOne($id)) !== null) {
            return $model;
        } else {
            return new models\ExtendMatchTips();
        }
    }

    public function getCategoryTipPC() {
        $category = array();
        $category[0] = 'Chọn chuyên mục';
        $cate = ExtendCategory::find()->asArray()->all();
        foreach ($cate as $row) {
            $category[$row["ID"]] = $row["CategoryName"];
        }

        return $category;
    }

    public function getPinStatus($matchid) {
        $pin = models\PinContent::find()->where(['ContentID' => $matchid])->one();
//    var_dump($pin); die;
        if ($pin == null) {
            return 0;
        } else {
            return 1;
        }
    }

    public function addtags($tags, $matchid) {

        foreach ($tags as $row) {
//        var_dump($row); die;
            $tag = str_replace("[tag]", "", $row);
            $tag = str_replace("[/tag]", "", $tag);
            $tag = \app\services\FunctionStatic::getAlias($tag);

            $old_tag = models\ExtendTags::find()->where(['Name' => $tag])->one();

            if ($old_tag == null) {

                $tagModel = new models\ExtendTags();
                $tagModel->TagName = $row;
                $tagModel->Name = $tag;
                $tagModel->CreateDate = date("Y-m-d H:i:s");
                $tagModel->save();
                $tagid = $tagModel->ID;
// echo $tagid; die;
                $this->insertMatchTag($matchid, $tagid);
            } else {
                $tagid = $old_tag->ID;

                $this->insertMatchTag($matchid, $tagid);
            }
        }
    }

    public function insertMatchTag($matchid, $tagid) {
        $match_tag = new models\ExtendMatchTag();
        $match_tag->MatchID = $matchid;
        $match_tag->TagID = $tagid;
        $match_tag->save();
    }

    public function SearchTeam($keyword) {
        $sql = 'SELECT TeamID,TeamName FROM Soccer_Team WHERE Teamname LIKE :keyword OR ShortName LIKE :keyword OR NameVN LIKE :keyword LIMIT 5';
        $teams = models\SoccerTeam::findBySql($sql, [':keyword' => "%$keyword%"])->all();
        return $teams;
    }

    public function SaveMatch($model) {
        if ($model->MatchID == NULL) {
            $matchid = $this->getMatchID();
            $model->MatchID = $matchid;
        }
        return $model->save();
    }

//lấy matchid để thêm trận
    public function getMatchID() {
        $sql = 'SELECT * FROM Soccer_Match_Info WHERE MatchID < 100000 Order By MatchID DESC';
        $match = models\SoccerMatchInfo::findBySql($sql, [])->one();

        return $match->MatchID + 1;
    }

    public function SaveData($tips, $file, $post) {
        $uploadserive = new UploadService();
//    luu anh so do tran dau
        if ($file["ImageMap"]["size"] != 0) {
            $filename = $uploadserive->uploadImageMap($file["ImageMap"]["tmp_name"], $file["ImageMap"]["name"]);
            $tips->ImageMap = $filename;
        }

//    luu anh dai dien pc
        if ($post["ExtendMatchTips"]["Image"] != null and $post["ExtendMatchTips"]["Image"] != "") {
            $filename = $uploadserive->uploadBase64("images/", $post["ExtendMatchTips"]["Image"], 650, 368);
            if ($filename) {
                $tips->Image = $filename;
            }
        }
//    quan ly pin pc
        if (isset($post["Pinpc"])) {
            $pin = models\PinContent::find()->where(['ContentID' => $tips["MatchID"]])->one();
            if ($pin == null) {
                $pin = new models\PinContent();
                $pin->Title = $tips->Title;
                $pin->Type = 1;
                $pin->Image = $tips->Image;
                $pin->ContentID = $tips->MatchID;
                $pin->DateCreate = date("Y-m-d H:i:s");
                $pin->UserCreate = \Yii::$app->user->id;
                $pin->Public = 1;
//           var_dump($pin); die;
                $pin->save();
            } else {
                $pin->Title = $tips->Title;
                $pin->Image = $tips->Image;
                $pin->save();
            }
        } else {
            models\PinContent::deleteAll("ContentID = " . $tips["MatchID"]);
        }
//  save tag tips
        $pattern = '\\[tag\\].+?\\[\\/tag\\]';
        preg_match_all('/\[tag\].+?\[\/tag\]/', $tips->Tips, $tags);
        $tags = $tags[0];
//    var_dump($tags); die;
        models\ExtendMatchTag::deleteAll("MatchID = " . $tips->MatchID);
        $this->addtags($tags, $tips->MatchID);
        if ($tips->pin433 == NULL) {
            $tips->pin443 = 1;
            $tips->category433 = $this->addTips433($tips);
        }
        if ($tips->UserCreate == null) {
            $tips->UserCreate = \Yii::$app->user->id;
            $tips->CreateDate = date("Y-m-d H:i:s");
            $tips->Author = \Yii::$app->user->identity->fullname;
        } else {
            $tips->UserUpdate = \Yii::$app->user->id;
            $tips->UpdateDate = date("Y-m-d H:i:s");
        }
//      save tip data   
        if (!$tips->isNewRecord) {
            $tips->AllowEdit = $tips->AllowEdit - 1;
        }
        if ($tips->save()) {
            $this->addTips433($tips);

            return 1;
        }
        return 0;
    }

    public function getPin(models\ExtendMatchTips $tips) {
        $model433 = $model433 = MatchTips::findOne($tips->MatchID);
        if ($model433 == null) {
            $model433 = new MatchTips();
        }
        $tips->pin433 = $model433->pin;
        $tips->category433 = $model433->CategoryID;
        return $tips;
    }

    private function addTips433(models\ExtendMatchTips $tips) {
        $model433 = MatchTips::findOne($tips->MatchID);
        if ($model433 == null) {
            $model433 = new MatchTips();
        }
        $model433 = $this->list433($model433, $tips);
        
        if ($model433->save()) {
            return 2;
        }
    }

    public function list433($model433, $modelTips) {
        $model433->MatchID = $modelTips->MatchID;
        $model433->CategoryID = $modelTips['category433'];
        $model433->pin = $modelTips->pin433;
        $model433->Title = $modelTips->Title;
        $model433->Description = $modelTips->Description;
        $model433->Keyword = $modelTips->Keyword;
        $model433->Tips = $this->removeAllTag($modelTips->Tips);
        $model433->UserCreate = $modelTips->UserCreate;
        $model433->UserUpdate = $modelTips->UserUpdate;
        $model433->CreateDate = $modelTips->CreateDate;
        $model433->Image = "90phut/" . $modelTips->Image;
        $model433->ImageMap = "90phut/" . $modelTips->ImageMap;
        $model433->Author = $modelTips->Author;
        $model433->CreateDate = $modelTips->CreateDate;
        $model433->UpdateDate = $modelTips->UpdateDate;
        return $model433;
    }

    private function removeAllTag($str) {
        $listTag = array("[tag]", "[/tag]");
        $listTagRemove = array("", "");
        $content = str_replace($listTag, $listTagRemove, $str);
        $ct = $this->replace_video_width($content);
        return $this->strip_tags_content($ct, '<a>', true);
    }

    private function replace_video_width($video_tag) {
        $doc = new \DOMDocument();
        libxml_use_internal_errors(true);
        $doc->loadHTML(mb_convert_encoding($video_tag, 'HTML-ENTITIES', 'UTF-8'));
        $tags = $doc->getElementsByTagName('video');
        foreach ($tags as $tag) {
            $tag->setAttribute('style', "width:100% !important;height:100% !important");
            $tag->setAttribute('width', "100%");
            $tag->setAttribute('height', "100%");
        }
        return $doc->saveHTML();
    }

    private function strip_tags_content($text, $tags = '', $invert = FALSE) {
        preg_match_all('/<(.+?)[\s]*\/?[\s]*>/si', trim($tags), $tags);
        $tags = array_unique($tags[1]);
        if (is_array($tags) AND count($tags) > 0) {
            if ($invert == FALSE) {
                return preg_replace('@<(?!(?:' . implode('|', $tags) . ')\b)(\w+)\b.*?>.*?</\1>@si', '', $text);
            } else {
                return preg_replace('@<(' . implode('|', $tags) . ')\b.*?>.*?</\1>@si', '', $text);
            }
        } elseif ($invert == FALSE) {
            return preg_replace('@<(\w+)\b.*?>.*?</\1>@si', '', $text);
        }
        return $text;
    }

}
