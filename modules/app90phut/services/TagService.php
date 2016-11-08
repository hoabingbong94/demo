<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\modules\app90phut\services;

use app\modules\app90phut\models\ExtendTags;
use app\modules\app433\services\TagService as Tag433;
use app\modules\app90phut\models\StarTags;

class TagService extends Tag433 {

    private $getTag433Service = null;

    private function checkExistTag($tagName) {
        $getData = ExtendTags::find()->where(['Name' => $tagName])->one();
        if ($getData != null) {
            return $getData->ID;
        } else {
            return false;
        }
    }

    public function addTag90phut($strTag, $dataId, $type) {
        $listTag = $this->getListTag($strTag);
        foreach ($listTag as $v) {
            $tagName = $this->clearTag($v);
            $tagId = $this->checkExistTag($tagName);
            if ($tagId == false) {
                $tagId = $this->saveTag90phut($v, $tagName);
            }
            switch ($type) {
                case "star":
                    $this->addStarTag($dataId, $tagId);
                    break;
            }
        }
    }

    public function addTag90phutMany($listContent, $dataId, $type) {
        foreach ($listContent as $v) {
            $this->addTag90phut($v, $dataId, $type);
        }
    }

    public function addStarTag($starId, $tagId) {
        if ($tagId != false) {
            $model = new StarTags();
            $model->StarId = $starId;
            $model->TagId = $tagId;
            $model->save();
        }
    }

    public function saveTag90phut($tag, $tagName) {
        $model = new ExtendTags();
        $model->Name = $tagName;
        $model->TagName = $tag;
        $model->CreateDate = date("Y-m-d H:i:s");
        $save = $model->save();
        if ($save) {
            return $model->ID;
        } else {
            return false;
        }
    }

}
