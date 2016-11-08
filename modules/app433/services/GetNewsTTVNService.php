<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\modules\app433\services;

use app\modules\app433\models\GetNewsTTVN;
use yii\data\Pagination;
use yii\db\Query;
use app\modules\app433\models\Post;

class GetNewsTTVNService {

    private $host = "http://thethaovietnam.vn";

    public function scanListItem() {
        $content = file_get_contents($this->host . "/services/thethao.svc/Articles_GetListByCategoryId/278,50,0,1,web,2_0,notset?format=json");
        $data = json_decode($content, true);
        $mArticlesList = $data['mArticlesList'];
        $listItem = array();
        foreach ($mArticlesList as $k => $v) {
            $listItem[$k]['title'] = $v['ArticleTitle'];
            $listItem[$k]['sapo'] = $v['ArticleLead'];
            $listItem[$k]['url'] = $v['ArticleUrl'];
            $listItem[$k]['categoryId'] = $v['CategoryId'];
            $listItem[$k]['photoPath'] = "http://static.thethaovietnam.vn/medias/standard/" . $v['PhotoPath'];
            $listItem[$k]['id'] = $v['ArticleId'];
        }
        $this->getDetail($listItem);
    }

    private function getDetail($listItem) {
        foreach ($listItem as $value) {
            $checkId = $this->checkExits($value['id']);
            if ($checkId) {
                $this->getContent($value);
            }
        }
    }

    private function getContent($value) {
        $categories = $value['categoryId'];
        $link = $this->host . $value['url'];
        if ($categories == "354" || $categories == "278") {
            $data = $this->getNews($link);
            $value['content'] = $data['content'];
            $value['description'] = $data['description'];
            $value['type'] = 1;
            $value['urlVideo'] = null;
            $this->save($value);
        } else {
            $linkVideo = $this->getVideo($link);
            $value['content'] = "";
            $value['description'] = "";
            $value['type'] = 2;
            $value['urlVideo'] = $linkVideo;
            $this->save($value);
        }
    }

    private function getNews($link) {
        $splitContent = explode('<div class="itemFullText">', file_get_contents($link));
        $contentData = explode('<div class="clr">', $splitContent[1]);
        $doc = new \DOMDocument();
        libxml_use_internal_errors(true);
        $doc->loadHTML(mb_convert_encoding($contentData[0], 'HTML-ENTITIES', 'UTF-8'));
        $tags = $doc->getElementsByTagName('strong');
        $description = "";
        foreach ($tags as $tag) {
            $description = $tag->textContent;
            break;
        }
        $content = str_replace("<strong>$description</strong><br />", "", $contentData[0]);
        return ['description' => $description, 'content' => $content];
    }

    private function getVideo($link) {
        $fileContent = file_get_contents($link);
        $data = explode('<div class="itemFullText">', $fileContent);
        $contentData = explode('<div class="articlerelatepannel">', $data[1]);
        $ctn = $contentData[0];
        $doc = new \DOMDocument();
        libxml_use_internal_errors(true);
        $doc->loadHTML(mb_convert_encoding($ctn, 'HTML-ENTITIES', 'UTF-8'));
        $tags = $doc->getElementsByTagName('div');
        $linkVideo = "";
        foreach ($tags as $tag) {
            $dataVideo = $tag->getAttribute('data-href');
            if ($dataVideo != "") {
                $linkVideo = $dataVideo;
                break;
            }
        }
        return $linkVideo;
    }

    private function checkExits($newsId) {
        $data = GetNewsTTVN::find()->where(['News_ID' => $newsId])->one();
        if ($data != null) {
            return false;
        } else {
            return true;
        }
    }

    private function save($data) {

        $model = new GetNewsTTVN();
        $model->Title = $data['title'];
        $model->Thumb = $data['photoPath'];
        $model->Description = $data['description'];
        $model->Content = $data['content'];
        $model->Categories = $data['categoryId'];
        $model->DateCreate = date("Y-m-d H:i:s");
        $model->Type = $data['type'];
        $model->News_ID = $data['id'];
        $model->Url_Video = $data['urlVideo'];
        if ($model->save()) {
            return true;
        } else {
            return false;
        }
    }

    public function listAll() {
        $query = new Query();
        $queryEx = $query->select(['ID', 'Title', 'Thumb', 'Description', 'Type', 'Categories', 'DateCreate'])
                ->from('Get_News_TTVN')
                ->where(['Status' => 0]);
        $queryEx->orderBy("ID DESC")->limit(10);
        $pagination = new Pagination([
            'defaultPageSize' => 10,
            'totalCount' => $query->count('*'),
        ]);
        $data = $queryEx->orderBy("ID DESC")
                ->offset($pagination->offset)
                ->limit($pagination->limit)
                ->all();
        return array('data' => $data, 'pagination' => $pagination);
    }

    public function getCategries($id) {
        $listCategories = ['354' => 'Giải đấu', '278' => 'Quần vợt', '357' => 'Video'];
        if (isset($listCategories[$id])) {
            return $listCategories[$id];
        } else {
            return "Không xác định";
        }
    }

    public function getById($ttvnId) {
        $model = new Post();
        $data = GetNewsTTVN::find()->where(['ID' => $ttvnId])->one();
        $model->Title = $data->Title;
        $model->Thumbnails = $data->Thumb;
        $model->Summary = $data->Description;
        $model->UrlVideo = $data->Url_Video;
        $model->Content = $data->Content;
        if ($data->Type == 2) {
            $model->Content = $data->Title;
            $model->ThumbVideo = $data->Thumb;
        }
        return $model;
    }

    public function updateById($ttvnId) {
        GetNewsTTVN::updateAll(['Status' => 1], 'ID=' . $ttvnId);
    }

}
