<?php

namespace app\modules\app90phut\services;

use app\modules\app90phut\models;
use app\modules\app90phut\services;
use app\modules\app90phut\models\Category;
use app\modules\app90phut\models\CategoryPc;
use app\modules\app90phut\models\ExtendVideo;
use yii\data\Pagination;
use yii\db\Query;
use Yii;
use app\modules\app433\models\Post;
use app\modules\app433\models\Post90phut;
use app\modules\app433\services\PostService;
use app\modules\app90phut\models\News;

class NewsService {

    public function findAll($param) {
        $keyword = $param["keyword"];
        $category = $param["category"];
        $type = $param["type"];
        $page = $param["page"];
        $query = new Query();
        $queryEx = $query->select(['a.ID',
                    'a.Title',
                    'a.Summary',
                    'a.Thumbnails',
                    'a.ExtendVip',
                    'a.ExtendHot',
                    'a.ExtendUp',
                    'a.ExtendTop',
                    'a.ExtendUpdateDate',
                    'a.Author',
                    'a.ExtendIsPublic',
                    'b.CategoryName'
                ])
                ->from('News as a')
                ->leftJoin('Category as b', 'a.CategoryID=b.CategoryID')
                ->leftJoin('Extend_User as c', ' a.ExtendUserCreate = c.ID');

        $queryEx->where(['LIKE', 'a.Title', $keyword]);

        if ($type == 1) {
            $queryEx->andWhere(['=', 'a.ExtendVip', 1]);
        }
        if ($type == 2) {
            $queryEx->andWhere(['=', 'a.ExtendVip', 2]);
        }
        if ($type == 3) {
            $queryEx->andWhere(['=', 'a.ExtendTop', 1]);
        }
        if ($category != 0) {
            $queryEx->andWhere(['=', 'a.CategoryID', $category]);
        }

        $queryEx->orderBy("a.ID DESC")
                ->limit(10);

        $command = $query->createCommand(models\News::getDb());
        $data = $command->queryAll();

        $pagination = new Pagination([
            'defaultPageSize' => 10,
            'totalCount' => $query->count('*', models\News::getDb()),
        ]);

        $data = $queryEx->offset($pagination->offset)
                ->limit($pagination->limit)
                ->all(models\News::getDb());
        return array('data' => $data, 'pagination' => $pagination);
    }

    public function getCategory() {
        $data = array();
        $data = Category::find()->where(array('ExtendAllowGet' => 1))->all();
        return $data;
    }

    public function getCategoryArray() {
        $data = array();
        $data[0] = "--Chọn chuyên mục--";
        $category = Category::find()->where(array('ExtendAllowGet' => 1))->all();
        foreach ($category as $row) {
            $data[$row->CategoryID] = $row->CategoryName;
        }
        return $data;
    }

    public function getCategoryPCArray() {
        $data = array();
        $data[0] = "--Chọn chuyên mục--";
        $category = CategoryPc::find()->where(array('Public' => 1))->all();
        foreach ($category as $row) {
            $data[$row->ID] = $row->CategoryName;
        }
        return $data;
    }

    public function SearchVideoAjax($keyword) {
        $sql = "SELECT ID,Avatar,UrlVideo,EventName FROM Extend_Video WHERE EventName LIKE :keyword ORDER BY ID DESC limit 10";
        $data = Yii::$app->db2->createCommand($sql)
                ->bindValue(':keyword', "%$keyword%")
                ->queryAll();
        return $data;
    }

    public function saveData($model, $post) {

        $uploadserive = new UploadService();
        if ($model->Thumbnails != null && $model->Thumbnails != "") {
            $string_img = $post["News"]["Thumbnails"];
            $filename = $uploadserive->uploadBase64("images/", $string_img, 460, 270);
            if ($filename) {
                $model->Thumbnails = $filename;
            }
            $filename = $uploadserive->uploadBase64("images/", $string_img, 460, 270);
            if ($filename) {
                $model->ThumbnailsPc = $filename;
            }
            $filename = $uploadserive->uploadBase64("images/", $model->thumbnailsCover, 853, 320);
            if ($filename) {
//                $model->thumbnailsCover = $filename;
                $model->thumbnailsCover = $filename;
            }
        }

        if (!$model->ExtendUserCreate) {
            $model->ExtendUserCreate = \Yii::$app->user->id;
            $model->ExtendUpdateDate = date("Y-m-d H:i:s");
            $model->Author = \Yii::$app->user->identity->fullname;
        } else {
            $model->ExtendUserUpdate = \Yii::$app->user->id;
//$model->ExtendUpdateDate = date("Y-m-d H:i:s");
        }
        if (!$model->isNewRecord) {
            $model->AllowEdit = $model->AllowEdit - 1;
        }
        $postService = new PostService();
        if (!$postService->getRole('publish')) {
            $model->ExtendIsPublic = 0;
        }

//quan ly pin pc
        if ($model->save()) {
            if (isset($post["Pinpc"])) {
                $pin = models\PinContent::find()->where(['ContentID' => $model->ID])->one();
                if ($pin == null) {
                    $pin = new models\PinContent();
                    $pin->Title = $model->Title;
                    $pin->Type = 3;
                    $pin->Image = $model->Thumbnails;
                    $pin->ContentID = $model->ID;
                    $pin->DateCreate = date("Y-m-d H:i:s");
                    $pin->UserCreate = \Yii::$app->user->id;
                    $pin->Public = 1;
                } else {
                    $pin->Title = $model->Title;
                    $pin->Image = $model->Thumbnails;
                    $pin->save();
                }
            } else {
                models\PinContent::deleteAll("ContentID = " . $model->ID);
            }
            if ($model->save()) {
                $this->addPosts433($model);
                return 1;
            }
        }
        return 0;
    }

    private function addPosts433(News $model) {

        $postId = $this->savePost($model);
        if ($postId) {
            $this->savePost90phut($model, $postId);
            return true;
        }
        return false;
    }

    private function savePost90phut(News $modelNews, $postId) {
//Check
        $model = new Post90phut();
        $checkExist = Post90phut::find()->where(['PostID' => $postId])->one();
        if ($checkExist == null) {
            $model->PostID = $postId;
            $model->NewsId = $modelNews->ID;
            $model->StarId = 0;
            $model->Type = 1;
            $model->DateCreate = date("Y-m-d H:i:s");
            $model->UserCreate = Yii::$app->user->id;
            if ($model->save()) {
                return true;
            }
        }
        return false;
    }

    private function savePost(News $modelNews) {


//Check Exist
        $newsId = $modelNews->ID;
        $checkExist = Post90phut::find()->where(['NewsId' => $newsId])->one();
        $model = new Post();
        if ($checkExist != null) {
            $id = $checkExist->PostID;
            $model = Post::find()->where(['ID' => $id])->one();
        } else {
            $model->DatePublic = date('Y-m-d H:i:s');
        }
        $model->CategoryID = $modelNews->category433;
        $model->Title = $modelNews->Title;
        $model->Type = 4;
        $model->Summary = $modelNews->Summary;
        $model->Keyword = $modelNews->Keyword;
        $model->Content = $this->removeAllTag($modelNews->Contents);
        $model->ContentNone = $modelNews->Title;
        $model->ContentExtendNone = $modelNews->Title;
        $model->DateUpdate = $modelNews->ExtendUpdateDate;
        $model->DateCreate = $modelNews->ExtendUpdateDate;
        $model->Public = $modelNews->ExtendIsPublic;
        $model->Thumbnails = "90phut/" . $modelNews->Thumbnails;
        if ($modelNews->thumbnailsCover != "") {
            $model->ThumbnailsCover = "90phut/" . $modelNews->thumbnailsCover;
        }
        $model->UserCreate = $modelNews->ExtendUserCreate;
        $model->UserUpdate = $modelNews->ExtendUserCreate;
        $model->Author = $modelNews->Author;
//        echo "<pre>";
//        print_r($model);
//        die;
        if ($model->save()) {
            return $model->getPrimaryKey();
        } else {
            return false;
        }
    }

    private function removeAllTag($str) {
        $listTag = array("[tag]", "[/tag]");
        $listTagRemove = array("", "");
        $content = str_replace($listTag, $listTagRemove, $str);
        $ct = $this->replace_video_width($content);
        $rs = $this->strip_tags_content($ct, '<a>', true);
        return $rs;
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
