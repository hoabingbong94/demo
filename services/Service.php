<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\services;

use yii\imagine;
use yii\imagine\Image;
use Imagine\Gd;
use Imagine\Image\Box;
use Imagine\Image\BoxInterface;

class Service {

    public function uploadCkE($type, $tmp_name, $fileNameRoot, $module, $resize = false, $width = 0) {
        $fileNameRoot = $this->getAlias($fileNameRoot);
        ;
        $dir = Path_Upload_90phut;
        if ($module == "433") {
            $dir = PathUpload;
        }
        $path = date("Y/m/d");
        $this->mkdir($dir . $type);
        $rootDir = $dir . $type . "/" . $path;
        $extFile = substr($fileNameRoot, strrpos($fileNameRoot, '.') + 1);
        $fileName = str_replace("." . $extFile, "", $fileNameRoot) . time() . "." . $extFile;
        @move_uploaded_file($tmp_name, $rootDir . "/" . $fileName);
        if ($type == "images" && $resize) {
            $this->resize($rootDir . "/" . $fileName, $rootDir . "/" . $fileName, $width);
        }
        if ($module == "90phut") {
            return "/cms_upload/" . $type . "/" . $path . "/" . $fileName;
        } else {
            return "/" . $type . "/" . $path . "/" . $fileName;
        }
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
        if (!is_dir($path . "/" . date("Y/m/d"))) {
            mkdir($path . "/" . date("Y/m/d"), 0777, true);
            $this->chmod($path);
        }
    }

    private function chmod($path) {
        chmod($path . "/" . date('Y'), 0777);
        chmod($path . "/" . date('Y/m'), 0777);
        chmod($path . "/" . date('Y/m/d'), 0777);
    }

    private function sessionStart() {
        $session = new \yii\web\Session();
        if (!$session->isActive) {
            $session->open();
        }
        return $session;
    }

    public function addSession($key, $data) {
        $session = $this->sessionStart();
        $listItem = $session[$key];
        $lastId = 0;
        if (isset($listItem['lastItem'])) {
            $lastId = $listItem['lastItem'] + 1;
        }
        $listItem['lastItem'] = $lastId;
        $listItem['items'][$lastId] = $data;
        $session[$key] = $listItem;
        return $listItem['items'];
    }

    public function editSession($key, $data, $id) {
        $session = $this->sessionStart();
        $listItem = $session[$key];
        $listItem['items'][$id] = $data;
        $session[$key] = $listItem;
        return $listItem['items'];
    }

    public function getSession($key) {
        $session = $this->sessionStart();
        return $session[$key];
    }

    public function removeSession($key, $k) {
        $session = $this->sessionStart();
        $listItem = $session[$key];
        $items = $listItem['items'];
        unset($items[$k]);
        $listItem['items'] = $items;
        $session[$key] = $listItem;
    }

    public function unsetSession($key) {
        $session = $this->sessionStart();
        $session[$key] = null;
    }

    public static function getAlias($cs, $tolower = false) {
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

    public function debug($input) {
        echo "<pre>";
        print_r($input);
        die;
    }

}
