<?php

/* Check */
$check = file_get_contents("convert.dat");
if ($check == "" || $check == 0) {
    file_put_contents("convert.dat", "1");
    $dir = str_replace("\\", "/", __DIR__) . "/";
    try {
        $con = new PDO('mysql:host=210.245.84.18;dbname=bongda433_test;charset=utf8', "bongda433", "f9xfKT6rtZCQKLsr");
        $strQuery = "SELECT * FROM tblConvertVideo";
        $sth = $con->prepare($strQuery);
        $sth->execute();
        $result = $sth->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $k => $v) {
            $id = $v['id'];
            $urlVideo = $v['videoFileRoot'];
            $filename = $v['fileName'];
            $ext = $v['ext'];
            $path = $v['path'];
            $out = true;
            $v240p = 0;
            $v360p = 0;
            $v480p = 0;
            //Convert 240p
            $inputPath = $dir . $urlVideo;
            if ($v['video240p'] != 1) {
                $pathOut = $dir . "videos/240p/" . $path;
                if (!is_dir($pathOut)) {
                    mkdir($pathOut, 0777, true);
                }
                convertVideo($inputPath, $pathOut, $filename, 240);
                if (!file_exists($pathOut . $filename . ".mp4")) {
                    $out = false;
                    $v240p = 1;
                }
            }
            //Convert 360p
            if ($v['video360p'] != 1) {
                $pathOut = $dir . "videos/360p/" . $path;
                if (!is_dir($pathOut)) {
                    mkdir($pathOut, 0777, true);
                }
                convertVideo($inputPath, $pathOut, $filename, 360);
                if (!file_exists($pathOut . $filename . ".mp4")) {
                    $out = false;
                    $v360p = 1;
                }
            }
            //Convert 480p
            if ($v['video480p'] != 1) {
                $pathOut = $dir . "videos/480p/" . $path;
                if (!is_dir($pathOut)) {
                    mkdir($pathOut, 0777, true);
                }
                convertVideo($inputPath, $pathOut, $filename, 480);
                if (!file_exists($pathOut . $filename . ".mp4")) {
                    $out = false;
                    $v480p = 1;
                }
            }
            if ($out) {
                $filename = str_replace("/videos", "", $urlVideo);

                //Update Table Post
                $sqlUpdate = "UPDATE Post SET UrlVideo240p=?,UrlVideo360p=?,UrlVideo480p=? WHERE ID=?";
                $sth = $con->prepare($sqlUpdate);
                $sth->bindValue(1, "/videos/240p/" . $filename, PDO::PARAM_STR);
                $sth->bindValue(2, "/videos/360p/" . $filename, PDO::PARAM_STR);
                $sth->bindValue(3, "/videos/480p/" . $filename, PDO::PARAM_STR);
                $sth->bindValue(4, $v['postId'], PDO::PARAM_STR);
                $sth->execute();
                //Del
                $sqlDel = "DELETE FROM tblConvertVideo WHERE id=?";
                $sth = $con->prepare($sqlDel);
                $sth->bindValue(1, $id, PDO::PARAM_STR);
                $sth->execute();
            } else {
                $sqlUpdate = "UPDATE tblConvertVideo SET video240p=?,video360p=?,video480p=? WHERE id=?";
                $sth = $con->prepare($sqlUpdate);
                $sth->bindValue(1, $v240p, PDO::PARAM_STR);
                $sth->bindValue(2, $v360p, PDO::PARAM_STR);
                $sth->bindValue(3, $v480p, PDO::PARAM_STR);
                $sth->bindValue(4, $id, PDO::PARAM_STR);
                $sth->execute();
            }
        }
    } catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        die();
    }
    file_put_contents("convert.dat", "0");
} else {
    echo "wait";
}

function convertVideo($inputPath, $folderSave, $file_name, $quality) {
    $cmdPath = "F:/xampp/htdocs/yii/90phut/db2/web/libs/ffmpeg/start.cmd";
    $inputPath = getByOS($inputPath);
    $folderSave = getByOS($folderSave);
    $random_str = 'OK_' . time();
    $cmd = $cmdPath . ' ' . $inputPath . ' ' . $folderSave . ' ' . $file_name . ' ' . $quality . ' ' . $random_str;
    if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
        $result = exec($cmd);
    } else {
        $result = shell_exec($cmd);
    }
    if (file_exists($folderSave . "/" . $file_name . ".mp4")) {
        return true;
    }
    return false;
}

function getByOS($inputPath) {
    $inputPath = str_replace("//", "/", $inputPath);
    if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
        $inputPath = str_replace("/", "\\", $inputPath);
    }
    return $inputPath;
}
