<?php

namespace app\modules\app90phut\services;

use yii\imagine;
use yii\imagine\Image;
use Imagine\Gd;
use Imagine\Image\Box;
use Imagine\Image\BoxInterface;

class UploadService {

    public function uploadBase64($path, $base64Img, $width, $height) {
        $strSplit = explode("}}}", $base64Img);
//        var_dump($strSplit); die;
        if (count($strSplit) == 2) {
            $fileNameAll = $strSplit[0];
            $extFile = substr($fileNameAll, strrpos($fileNameAll, '.') + 1);
            $fileName = str_replace("." . $extFile, "", $fileNameAll) . time() . rand(0, 10) . "." . $extFile;
            $strBase64Img = explode("base64,", $strSplit[1]);
            $base64Decode = base64_decode($strBase64Img[1]);
            $this->mkdir(Path_Upload_90phut . "/cms_upload/" . $path . '/');
            $path = $path . "/" . date("Y/m/d");
            file_put_contents(Path_Upload_90phut . "/cms_upload/" . $path . "/" . $fileName, $base64Decode);
            $file = Path_Upload_90phut . "cms_upload/" . $path . "/" . $fileName;
            //echo $file; die;
            if ($width < 99999) {
                Image::thumbnail($file, $width, $height)->save($file);
            }
//            echo $fileName; die; 
            return "cms_upload/" . $path . "/" . $fileName;
        } else
            return false;
    }

    public function uploadCkE($type, $tmp_name, $fileNameRoot) {
        $path = date("Y/m/d");
        $this->mkdir(Path_Upload_90phut . $type . '/');
        $rootDir = Path_Upload_90phut . $type . "/" . $path;
        $extFile = substr($fileNameRoot, strrpos($fileNameRoot, '.') + 1);
        $fileName = str_replace("." . $extFile, "", $fileNameRoot) . time() . "." . $extFile;
        @move_uploaded_file($tmp_name, $rootDir . "/" . $fileName);

        if ($type == "images") {
            $this->resize($rootDir . "/" . $fileName, $rootDir . "/" . $fileName, 460);
        }
        return "/service/cms_upload/" . $type . "/" . $path . "/" . $fileName;
    }

    public function uploadImageMap($tmp_name, $name) {
        $path = date("Y/m/d");
        $this->mkdir(Path_Upload_90phut . "cms_upload/images/");
        $rootDir = Path_Upload_90phut . "cms_upload/images/" . $path;
        $extFile = substr($name, strrpos($name, '.') + 1);
        $fileName = str_replace("." . $extFile, "", $name) . time() . "." . $extFile;
//        echo "<pre>";
//        print_r($fileName);die();
        $this->resize($tmp_name, $rootDir . "/" . $fileName, 580);
        return "cms_upload/images/" . $path . "/" . $fileName;
    }

//        die("OK");
////        save image so do tran dau
//        $path = date("Y/m/d");
//        $rootDir = Path_Upload_90phut . "cms_upload/images/" . $path;
//        $extFile = substr($name, strrpos($name, '.') + 1);
//        $fileName = str_replace("." . $extFile, "", $name) . time() . "." . $extFile;
////        $this->resize($tmp_name, $rootDir . "/" . $fileName, 460);
//        return "cms_upload/images/" . $path . "/" . $fileName;

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

    public function mkdir($path) {
//        echo $path; die;
        if (!is_dir($path . date("Y"))) {
            mkdir($path . date("Y"), 0775, true);
        }

        if (!is_dir($path . date("Y/m"))) {
            mkdir($path . date("Y/m"), 0775, true);
        }

        if (!is_dir($path . date("Y/m/d"))) {
            mkdir($path . date("Y/m/d"), 0775, true);
        }


//            $this->chmod($path);
    }

}
