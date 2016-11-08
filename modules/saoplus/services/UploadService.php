<?php

namespace app\modules\saoplus\services;

use yii\imagine;
use yii\imagine\Image;
use Imagine\Gd;
use Imagine\Image\Box;
use Imagine\Image\BoxInterface;
use app\modules\saoplus\services\Services;

class UploadService {

    public function uploadBase64($path, $base64Img, $width, $height) {
        $service = new Services();
        $strSplit = explode("}}}", $base64Img);
        if (count($strSplit) == 2) {
            //đường dẫn ảnh
            $fileNameAll = $strSplit[0];
            //đuôi mở rộng
            $extFile = substr($fileNameAll, strrpos($fileNameAll, '.') + 1);
            //hình ảnh 
            $urlImages = str_replace("." . $extFile, "", $fileNameAll);
            $name = $service->getAlias($urlImages);
            $fileName = $name . time() . rand(0, 10) . "." . $extFile;
            $strBase64Img = explode("base64,", $strSplit[1]);
            $base64Decode = base64_decode($strBase64Img[1]);
            $this->mkdir(Path_Upload_Saoplus . $path . '/');

            $path = $path . "/" . date("Y/m/d");
            file_put_contents(Path_Upload_Saoplus . $path . "/" . $fileName, $base64Decode);

            $file = Path_Upload_Saoplus . $path . "/" . $fileName;

            if ($width < 99999) {
                Image::thumbnail($file, $width, $height)->save($file);
            }

            return $path ."/". $fileName;
        } else
            return false;
    }

    public function uploadCkE($type, $tmp_name, $fileNameRoot) {
        $path = date("Y/m/d");
        $this->mkdir(Path_Upload_Saoplus . $type . '/');
        $rootDir = Path_Upload_Saoplus . $type . "/" . $path;
        $extFile = substr($fileNameRoot, strrpos($fileNameRoot, '.') + 1);
        $fileName = str_replace("." . $extFile, "", $fileNameRoot) . time() . "." . $extFile;
        @move_uploaded_file($tmp_name, $rootDir . "/" . $fileName);

        if ($type == "images") {
            $this->resize($rootDir . "/" . $fileName, $rootDir . "/" . $fileName, 460);
        }
        return "/service/saoplus/" . $type . "/" . $path . "/" . $fileName;
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

}
