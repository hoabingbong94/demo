<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\modules\app433\services;

use app\models\bongda433\Post;
use yii\imagine;
use yii\imagine\Image;
use Imagine\Gd;
use Imagine\Image\Box;
use Imagine\Image\BoxInterface;

class UploadService {

    public function uploadBase64($path, $base64Img, $width, $height) {
        $strSplit = explode("}}}", $base64Img);
        if (count($strSplit) == 2) {
            $fileNameAll = $strSplit[0];
            $extFile = substr($fileNameAll, strrpos($fileNameAll, '.') + 1);
            $fileName = str_replace("." . $extFile, "", $fileNameAll) . time() . rand(99, 9999) . "." . $extFile;
            $strBase64Img = explode("base64,", $strSplit[1]);
            $base64Decode = base64_decode($strBase64Img[1]);
            $this->mkdir(PathUpload . "images/");
            file_put_contents(PathUpload . $path . "/" . $fileName, $base64Decode);
            $file = PathUpload . $path . "/" . $fileName;
            if ($width < 99999) {
                Image::thumbnail($file, $width, $height)->save($file);
            }
            return $fileName;
        } else
            return false;
    }

    public function uploadCkE($type, $tmp_name, $fileNameRoot) {
        $path = date("Y/m/d");
        $this->mkdir(PathUpload . $type . "/");
        $rootDir = PathUpload . $type . "/" . $path;
        $extFile = substr($fileNameRoot, strrpos($fileNameRoot, '.') + 1);
        if ($type == "videos") {
            $e = strtolower($extFile);
            if ($e != "mp4") {
                return "";
            }
        }
        $fileName = str_replace("." . $extFile, "", $fileNameRoot) . time() . "." . $extFile;
        @move_uploaded_file($tmp_name, $rootDir . "/" . $fileName);
        if ($type == "images") {
            $this->resize($rootDir . "/" . $fileName, $rootDir . "/" . $fileName, 670);
        }
        return "/media433/" . $type . "/" . $path . "/" . $fileName;
    }

    public function resize($input, $file, $width) {
        $infoImages = getimagesize($input);
        $widthImage = $infoImages[0];
        if ($widthImage > $width) {
            $heightImage = $infoImages[1];
            $ratio = $widthImage / $heightImage;
            $height = round($width / $ratio);
            Image::thumbnail($input, $width, $height)->save($file);
        }
    }

    public function makedir($path) {
        mkdir(PathUpload . "videos/" . $path, 0777, true);
        $this->chmod(PathUpload . "videos/");
    }

    public function mkdir($path) {
        if (!is_dir($path . date("Y"))) {
            mkdir($path . date("Y"), 0775, true);
        }

        if (!is_dir($path . date("Y/m"))) {
            mkdir($path . date("Y/m"), 0775, true);
        }

        if (!is_dir($path . date("Y/m/d"))) {
            mkdir($path . date("Y/m/d"), 0775, true);
        }
    }

    private function chmod($path) {
        chmod($path . date('Y'), 0777);
        chmod($path . date('Y/m'), 0777);
        chmod($path . date('Y/m/d'), 0777);
    }

}
