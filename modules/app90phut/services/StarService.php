<?php

namespace app\modules\app90phut\services;

use app\modules\app90phut\models\Star;
use app\modules\app90phut\services\UploadService;
use app\modules\app90phut\services\TagService;
use yii\data\Pagination;
use yii\db\Query;
use Yii;
use app\modules\app433\models\Post;
use app\modules\app433\models\Post90phut;
use app\modules\app433\services\PostService;
use app\modules\app90phut\models\ExtendVideo;

class StarService {

    private $getUploadService = null;
    private $getTagService = null;

    public function __construct() {
        $this->getUploadService = new UploadService();
        $this->getTagService = new TagService();
    }

    public function findAll($keyword, $public) {
        $query = new Query();
        $queryEx = $query->select(['ID', 'Title', 'Summary', 'Thumbnails', 'Contents', 'Author', 'ReleaseDate', 'UserCreate'])
                ->from('Extend_Star')
                ->where(['LIKE', 'Title', $keyword])
                ->orWhere(['LIKE', 'Summary', $keyword])
                ->orWhere(['LIKE', 'Keyword', $keyword]);
        if ($public != "") {
            $queryEx->andWhere(['IsPublic' => $public]);
        }
        $queryEx->orderBy("ID DESC")->limit(10);
        $query->createCommand(Star::getDb());
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

    public function findById($id) {
        return Star::find()->where(['ID' => $id])->one();
    }

    public function SearchVideoAjax($keyword) {
        $sql = "SELECT ID,Avatar,UrlVideo,EventName FROM Extend_Video WHERE EventName LIKE :keyword ORDER BY ID DESC limit 10";
        $data = Yii::$app->db2->createCommand($sql)
                ->bindValue(':keyword', "%$keyword%")
                ->queryAll();
        return $data;
    }

    public function save(Star $model) {

        $path = date("Y/m/d");
        $uploadThumbnails = $this->getUploadService->uploadBase64("images/", $model->Thumbnails, 670, 377);
        if ($uploadThumbnails != FALSE) {
            $model->Thumbnails = $uploadThumbnails;
        }
        $fileCover = $this->getUploadService->uploadBase64("images/", $model->thumbnailsCover, 853, 320);
        if ($fileCover != FALSE) {
            $model->thumbnailsCover = $fileCover;
        }
        $date = date("Y-m-d H:i:s");
        $userId = \Yii::$app->user->id;
        $model->DateUpdate = $date;
        $model->UserUpdate = $userId;
        if ($model->ID == null) {
            $model->ReleaseDate = $date;
            $model->UserCreate = $userId;
        }
        $postService = new PostService();
        if (!$postService->getRole('publish')) {
            $model->IsPublic = 0;
        }
        if (!$model->isNewRecord) {
            $model->AllowEdit = $model->AllowEdit - 1;
        }
        if ($model->save()) {
            $starId = $model->ID;
            $this->removeTag($starId);
            $this->getTagService->addTag90phutMany([$model->Contents, $model->ContentsExtend], $starId, "star");
            if ($model->save()) {
                $this->addPosts433($model);

                return 1;
            }
            return true;
        } else {
            return false;
        }
    }

    private function addPosts433(Star $model) {
        $postId = $this->savePost($model);

        if ($postId) {
            $this->savePost90Phut($model, $postId);
            return TRUE;
        }
        return FALSE;
    }

    public function savePost90Phut(Star $modelStar, $postId) {

        $model = new Post90phut();
        $checkExist = Post90phut::find()->where(['PostID' => $postId])->one();
        if ($checkExist == null) {
            $model->StarId = $modelStar->ID;
            $model->PostID = $postId;
            $model->NewsId = 0;
            $model->Type = 2;
            $model->DateCreate = date('Y-m-d H:i:s');
            $model->UserCreate = Yii::$app->user->id;
            if ($model->save()) {
                return true;
            }
        }
        return FALSE;
    }

    public function savePost(Star $modelStar) {
        //Check
        $starID = $modelStar->ID;
        $checkExist = Post90phut::find()->where(['StarId' => $starID])->one();
        $model = new Post();
        if ($checkExist != null) {
            $id = $checkExist->PostID;
            $model = Post::find()->where(['ID' => $id])->one();
        }
        $model->CategoryID = $modelStar->CategoryID;
        $model->Title = $modelStar->Title;
        $model->Type = 4;
        $model->Summary = $modelStar->Summary;
        $model->Keyword = $modelStar->Keyword;
        $content = str_replace(array('width=""', 'height=""'), '', $this->removeAllTag($modelStar->Contents));
        $contentExtend = str_replace(array('width=""', 'height=""'), '', $this->removeAllTag($modelStar->ContentsExtend));
        $model->Content = $content;
        $model->Public = $modelStar->IsPublic;
        $model->ContentExtend = $modelStar->ContentsExtend;
        $model->Thumbnails = "90phut/" . $modelStar->Thumbnails;
        if ($modelStar->thumbnailsCover != '') {
            $model->ThumbnailsCover = "90phut/" . $modelStar->thumbnailsCover;
        }
        $model->UserCreate = $modelStar->UserCreate;
        $model->UserUpdate = $modelStar->UserUpdate;
        $model->DateUpdate = $modelStar->DateUpdate;
        $model->Author = $modelStar->Author;
        $model->DatePublic = date('Y-m-d H:i:s');
        $model->DateCreate = $modelStar->ReleaseDate;
        $model->Pin = 0;
        $model->ContentNone = $modelStar->Title;
        $model->ContentExtendNone = $modelStar->Title;
        if ($model->save()) {
            return $model->getPrimaryKey();
        } else {
            RETURN FALSE;
        }
    }

    public function removeTag($starId) {
        \app\modules\app90phut\models\StarTags::deleteAll(['StarId' => $starId]);
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
            $tag->setAttribute('style', "width:100% !important;");
            $tag->setAttribute("width", "");
            $tag->setAttribute("height", "");
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
