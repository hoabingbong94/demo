<?php

namespace app\modules\app433\services;

use app\modules\app433\models\Tags;
use app\modules\app433\models\PostTag;
use app\modules\app433\models\TipsTag;

class TagService {

    private function checkTag($tagAlias) {
        $getByAlias = Tags::find()->where(['NameAlias' => $tagAlias])->one();
        if ($getByAlias != null) {
            return $getByAlias->ID;
        } else {
            return false;
        }
    }

    public function removePostTag($postId) {
        @PostTag::deleteAll(['PostID' => $postId]);
    }

    public function removeTipsTag($matchId) {
        @TipsTag::deleteAll(['MatchId' => $matchId]);
    }

    public function addPostTag($idTag, $postId) {
        $model = new PostTag();
        $model->PostID = $postId;
        $model->TagID = $idTag;
        $model->save();
    }

    public function addTipsTag($matchId, $tagId) {
        $model = new TipsTag();
        $model->MatchId = $matchId;
        $model->TagId = $tagId;
        $model->save();
    }

    public function getListTag($content) {
        preg_match_all('/\[tag\].+?\[\/tag\]/', $content, $tags);
        return $tags[0];
    }

    public function clearTag($str) {
        $openTag = str_replace("[tag]", "", $str);
        $closeTag = str_replace("[/tag]", "", $openTag);
        return trim($closeTag);
    }

    public function addTag($strTag, $dataId, $type) {
        if ($strTag != null) {
            $listTag = $this->getListTag($strTag);
            foreach ($listTag as $v) {
                $tag = $this->clearTag($v);
                $tagAlias = $this->getAlias($tag);
                $tagId = $this->checkTag($tagAlias);
                if ($tagId == false) {
                    @$tagId = $this->saveTag($v, $tagAlias, $tag);
                }
                if ($type == "post") {
                    @$this->addPostTag($tagId, $dataId);
                } else {
                    @$this->addTipsTag($dataId, $tagId);
                }
            }
        }
    }

    private function saveTag($tagName, $tagAlias, $tag) {
        $dateCreate = date("Y-m-d H:i:s");
        $model = new Tags();
        $model->Name = $tagName;
        $model->NameAlias = $tagAlias;
        $model->TagName = $tag;
        $model->CreateDate = $dateCreate;
        $model->save();
        return $model->ID;
    }

    public function getAlias($cs, $tolower = false) {
        $marTViet = array(
            "à", "á", "ạ", "ả", "ã", "â", "ầ", "ấ", "ậ", "ẩ", "ẫ", "ă",
            "ằ", "ắ", "ặ", "ẳ", "ẵ", "è", "é", "ẹ", "ẻ", "ẽ", "ê", "ề",
            "ế", "ệ", "ể", "ễ", "ì", "í", "ị", "ỉ", "ĩ", "ò", "ó", "ọ",
            "ỏ", "õ", "ô", "ồ", "ố", "ộ", "ổ", "ỗ", "ơ", "ờ", "ớ", "ợ",
            "ở", "ỡ", "ù", "ú", "ụ", "ủ", "ũ", "ư", "ừ", "ứ", "ự", "ử",
            "ữ", "ỳ", "ý", "ỵ", "ỷ", "ỹ", "đ", "À", "Á", "Ạ", "Ả", "Ã",
            "Â", "Ầ", "Ấ", "Ậ", "Ẩ", "Ẫ", "Ă", "Ằ", "Ắ", "Ặ", "Ẳ", "Ẵ",
            "È", "É", "Ẹ", "Ẻ", "Ẽ", "Ê", "Ề", "Ế", "Ệ", "Ể", "Ễ", "Ì",
            "Í", "Ị", "Ỉ", "Ĩ", "Ò", "Ó", "Ọ", "Ỏ", "Õ", "Ô", "Ồ", "Ố",
            "Ộ", "Ổ", "Ỗ", "Ơ", "Ờ", "Ớ", "Ợ", "Ở", "Ỡ", "Ù", "Ú", "Ụ",
            "Ủ", "Ũ", "Ư", "Ừ", "Ứ", "Ự", "Ử", "Ữ", "Ỳ", "Ý", "Ỵ", "Ỷ",
            "Ỹ", "Đ", "-", ":", " - ", "/");
        $marKoDau = array(
            "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a",
            "a", "a", "a", "a", "a", "e", "e", "e", "e", "e", "e", "e",
            "e", "e", "e", "e", "i", "i", "i", "i", "i", "o", "o", "o",
            "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o",
            "o", "o", "u", "u", "u", "u", "u", "u", "u", "u", "u", "u",
            "u", "y", "y", "y", "y", "y", "d", "A", "A", "A", "A", "A",
            "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A",
            "E", "E", "E", "E", "E", "E", "E", "E", "E", "E", "E", "I",
            "I", "I", "I", "I", "O", "O", "O", "O", "O", "O", "O", "O",
            "O", "O", "O", "O", "O", "O", "O", "O", "O", "U", "U", "U",
            "U", "U", "U", "U", "U", "U", "U", "U", "Y", "Y", "Y", "Y",
            "Y", "D", " ", "", " ", " ");

        if ($tolower) {
            return strtolower(str_replace($marTViet, $marKoDau, $cs));
        }

        $chuyendoirs = str_replace($marTViet, $marKoDau, $cs);
        $chuyendoirs = strtolower($chuyendoirs);
        $st = str_replace(' ', '#', $chuyendoirs);
        $strs = preg_replace('([^a-zA-Z0-9#])', '', $st);
        $strs = str_replace('##', '#', $strs);
        return preg_replace('([^a-zA-Z0-9])', '-', $strs);
    }

}
