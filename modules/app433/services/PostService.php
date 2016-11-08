<?php

namespace app\modules\app433\services;

use app\modules\app433\models\Categories;
use app\modules\app433\models\Post;
use app\modules\app433\services\UploadService;
use app\modules\app433\services\VideoHighlightService;
use app\modules\app433\services\TagService;
use app\modules\app433\services\TipsService;
use app\modules\app433\models\Notification;
use app\modules\app433\models\Post90phut;
use yii\data\Pagination;
use yii\db\Query;
use yii\web\UploadedFile;

class PostService {

    public function findAll($keyword, $public, $datePost, $type, $categoriesId, $date, $userId) {
        $dateOff = [];
        $query = new Query();
        $queryEx = $query->select([
                    'a.ID', 'a.Recommened', 'a.DatePublic', 'a.Type', 'a.Title',
                    'a.Content', 'a.Thumbnails', 'a.DateCreate', 'a.UrlVideo',
                    'a.UrlVideo240p', 'a.UrlVideo360p', 'a.UrlVideo480p',
                    'a.ThumbVideo', 'a.Pin', 'a.View',
                    'b.CategoryName', 'b.LOGO', 'b.TitleAlias', 'c.fullname'
                ])
                ->from('Post as a')
                ->leftJoin('Categories as b', 'a.CategoryID = b.CategoryID')
                ->leftJoin('Admin_Cms as c', 'c.id = a.UserCreate')
                ->where(['LIKE', 'Content', $keyword])
                ->orWhere(['LIKE', 'ContentNone', $keyword])
                ->orWhere(['LIKE', 'a.Title', $keyword])
                ->orWhere(['LIKE', 'a.ID', $keyword])
                ->orWhere(['LIKE', 'a.Keyword', $keyword]);
        $wherePublic = 1;
        $timePublic = date("Y-m-d H:i:s");
        if ($public != "") {
            if ($public == "date" && $date != "") {
                $timePublic = $date . " " . date("H:i:s");
                $datePost = "ofDate";
            }
            if ($public == "date" && $date == "") {
                $datePost = "ofDate";
            }
            $wherePublic = $public;
        }
        if ($public != "all" && $public != "date") {
            $queryEx->andWhere(['a.Public' => $wherePublic]);
        }
        if ($userId != "all") {
            $queryEx->andWhere(['a.UserCreate' => $userId]);
        }
        if ($datePost != "") {
            $queryEx->andWhere(['>=', 'a.DatePublic', $timePublic]);
        }
        if ($type != "") {
            $queryEx->andWhere(['a.Type' => $type]);
        }
        if ($categoriesId != "") {
            $queryEx->andWhere(['a.CategoryID' => $categoriesId]);
        }
        if ($date != "") {
            $queryEx->andWhere([">=", 'a.DateCreate', $date . " 00:00:00"])
                    ->andWhere(["<=", 'a.DateCreate', $date . " 23:59:59"]);
        }
        $queryEx->andWhere(['<>', 'a.IsDelete', 1]);

        $queryEx->orderBy("a.Live DESC,a.Pin DESC,a.DatePublic DESC")->limit(10);
        $pagination = new Pagination([
            'defaultPageSize' => 10,
            'totalCount' => $query->count(),
        ]);
        $orderBy = "a.Live DESC,a.Pin DESC,a.DatePublic DESC";
        if ($public != "") {
            $orderBy = "a.DatePublic DESC";
        }

        $data = $queryEx->orderBy($orderBy)->offset($pagination->offset)->limit($pagination->limit)->all();

        return array('data' => $data, 'pagination' => $pagination);
    }

    public function findById($postId) {
        $data = Post::find()->where(['ID' => $postId])->one();
        return $data;
    }

    public function save(Post $model) {
        //title : 100
        $path = date("Y/m/d");
        $model->ContentNone = strip_tags($model->Content);
        $model->ContentExtendNone = strip_tags($model->Content);
        $date = date('Y-m-d H:i:s');

        $model->DateUpdate = $date;
        if ($model->DatePublic == null) {
            $model->DatePublic = $date;
        }
        if (!$model->isNewRecord) {
            $model->AllowEdit = $model->AllowEdit - 1;
        } else {
            $model->DateCreate = $date;
        }
        $upload = new UploadService();
        $uploadedThumbnails = false;
        if ($model->Type == 4) {
            $uploadedThumbnails = $upload->uploadBase64("images/" . $path, $model->Thumbnails, 670, 377);
        } else {
            $uploadedThumbnails = $upload->uploadBase64("images/" . $path, $model->Thumbnails, 80, 80);
        }
        if ($uploadedThumbnails != false) {
            $model->Thumbnails = "/media433/images/" . $path . "/" . $uploadedThumbnails;
        }
        $uploadedThumbnailsCover = $upload->uploadBase64("images/" . $path, $model->ThumbnailsCover, 853, 320);
        if ($uploadedThumbnailsCover != false) {
            $model->ThumbnailsCover = "/media433/images/" . $path . "/" . $uploadedThumbnailsCover;
        }
        if ($model->Type == 6) {
            if ($model->ID == null) {
                $streamKey = md5(time());
                $model->StreamKey = $streamKey;
            }
            $imagesShare = $upload->uploadBase64("images/" . $path, $model->ThumbVideo, 670, 377);
            if ($imagesShare != false) {
                $model->ThumbVideo = "/media433/images/" . $path . "/" . $imagesShare;
            }
        }
        //echo $model->Thumbnails; die;
        $urlVideoRoot = "";
        $fileName = "";
        $ext = "";
        if ($model->Type == 1) {
            //Video
            $uploadedThumbVideo = $upload->uploadBase64("images/" . $path, $model->ThumbVideo, 480, 270);
            if ($uploadedThumbVideo != false) {
                $model->ThumbVideo = "/media433/images/" . $path . "/" . $uploadedThumbVideo;
            }
            //Upload video
            $upload->mkdir(PathUpload . "videos/");
            $upload->mkdir(PathUpload . "videos/240p/");
            $upload->mkdir(PathUpload . "videos/360p/");
            $upload->mkdir(PathUpload . "videos/480p/");
            $file_video = UploadedFile::getInstance($model, 'UrlVideo');
            if ($file_video != null) {
                $name_video = $file_video->baseName . time();
                $name_video = str_replace(" ", "-", $name_video);
                $pathVideo = '/videos/' . $path . "/" . $name_video;
                $urlVideoRoot = $pathVideo . "." . $file_video->extension;
                $fileName = $name_video;
                $ext = $file_video->extension;
                $file_video->saveAs(PathUpload . $pathVideo . '.' . $file_video->extension);
                $model->UrlVideo = "/media433" . $pathVideo . '.' . $file_video->extension;
            } else {
                if ($model->UrlVideo != "") {
                    $model->UrlVideo = $model->UrlVideo;
                } else {
                    $model->UrlVideo = $model->oldAttributes['UrlVideo'];
                }
            }
        }
        if (!$this->getRole('publish')) {
            $model->Public = 0;
        }
        if ($model->Type == 5) {
            $model->AllowEdit = 9999999999;
        }
        $insert = $model->save();
        $postId = $model->ID;
        $type = $model->Type;
        $videoService = new VideoHighlightService();
        if ($insert) {
            $tagService = new TagService();
            $tagService->removePostTag($postId);
            @$tagService->addTag($model->Content, $postId, "post");
            @$tagService->addTag($model->ContentExtend, $postId, "post");
            if ($urlVideoRoot != "") {
                \Yii::$app->db->createCommand()->batchInsert("tblConvertVideo", ['videoFileRoot', 'video240p', 'video360p', 'video480p', 'fileName', 'ext', 'path', 'postId', 'type', 'status'], [[$urlVideoRoot, 0, 0, 0, $fileName, $ext, $path . "/", $postId, 3, 0]])
                        ->execute();
            }
            if ($type == 3) {
                $videoService->removeAll($postId);
                $videoService->save($postId);
            }
            return $postId;
        } else {
            return 0;
        }
    }

    /*
     * Xử lý albumVideo
     */

    public function addItem($files, $post) {
        $path = date("Y/m/d");
        $session = new \yii\web\Session();
        if (!$session->isActive) {
            $session->open();
        }
        $upload = new \app\modules\app433\services\UploadService();
        $tmpVideoName = $files['videoFile']['tmp_name'];
        //$tmpImageName = $files['imagesFile']['tmp_name'];
        $videoName = $files['videoFile']['name'];
        //$imageName = $files['imagesFile']['name'];
        $title = addslashes($post['title']);
        $order = addslashes($post['order']);
        $video = $upload->uploadCkE("videos", $tmpVideoName, $videoName);
        $img = "/media433/images/" . $path . "/" . $upload->uploadBase64("images/" . $path, $post['imagesFile'], 670, 377);
        //$img = $upload->uploadCkE("images", $tmpImageName, $imageName);
        $tmp = [
            [
                'video' => $video,
                'images' => $img,
                'title' => $title,
                'order' => $order
            ]
        ];
        $listFile = $session["listTmp"];
        if (!empty($listFile)) {
            $listFile2 = array_merge($listFile, $tmp);
        } else {
            $listFile2 = $tmp;
        }
        $session["listTmp"] = $listFile2;
        return $this->getHtmlItemVideo($session["listTmp"]);
    }

    public function editItem($files, $post) {
        $path = date("Y/m/d");
        $id = $post['id'];
        $session = new \yii\web\Session();
        if (!$session->isActive) {
            $session->open();
        }
        $listItem = $session["listTmp"];
        $upload = new \app\modules\app433\services\UploadService();
        if (isset($files['videoFile']['name'])) {
            $tmpName = $files['videoFile']['tmp_name'];
            $name = $files['videoFile']['name'];
            $video = $upload->uploadCkE("videos", $tmpName, $name);
            $listItem[$id]['video'] = $video;
        }
        if (isset($post['imagesFile']) && $post['imagesFile'] != "") {

            $img = "/media433/images/" . $path . "/" . $upload->uploadBase64("images/" . $path, $post['imagesFile'], 670, 377);
            $listItem[$id]['images'] = $img;
        }
        $listItem[$id]['title'] = addslashes($post['title']);
        $listItem[$id]['order'] = addslashes($post['order']);
        $session["listTmp"] = $listItem;
        return $this->getHtmlItemVideo($session["listTmp"]);
    }

    public function removeItem($k) {
        $session = new \yii\web\Session();
        if (!$session->isActive) {
            $session->open();
        }
        $list = $session["listTmp"];
        //Get Info Item
        $info = $list[$k];
        //Remove File 
        @unlink(PathUpload . $info['video']);
        @unlink(PathUpload . $info['images']);
        //Remove Item
        unset($list[$k]);
        $session["listTmp"] = $list;
        return $this->getHtmlItemVideo($session["listTmp"]);
    }

    private function getHtmlItemVideo($list) {
        $view = "";
        foreach ($list as $k => $v) {
            $pathVideo = \Yii::$app->params['pathMedia'] . $v['video'];
            $pathImages = \Yii::$app->params['pathMedia'] . $v['images'];
            $view.='<li>' .
                    '<div class="controlListVideo">' .
                    '<span onClick="removeItemVideo(' . $k . ');">' .
                    '<i class="glyphicon glyphicon-trash"></i>' .
                    '</span>' .
                    '<span onClick="loadItemVideo(' . $k . ');">' .
                    '<i class="glyphicon glyphicon-pencil"></i>' .
                    '</span>' .
                    '</div>' .
                    '<video src="' . $pathVideo . '" controls="true" poster="' . $pathImages . '"/>' .
                    '</li>';
        }
        $view.='<li onClick="addAlbumVideo();"><i class="glyphicon glyphicon-film"></i><span>Thêm video</span></li>';
        return $view;
    }

    public function deletePost($id) {
        $model = new Post();
        $model->IsDelete = 1;
        $model->ID = $id;
        $model->update();
        \Yii::$app->db->createCommand()->update('Post', ['IsDelete' => 1], ['ID' => $id])->execute();
    }

    /* Lich su cap nhat bai viet */

    public function getHistory($postId) {
        $query = new Query();
        $data = $query->select(['a.Action',
                            'a.Content',
                            'a.ContentExtend',
                            'a.DateCreate',
                            'a.DatePublic',
                            'a.DateUpdate',
                            'a.Keyword',
                            'a.Thumbnails',
                            'a.ThumbVideo',
                            'a.Type',
                            'a.UrlVideo',
                            'b.fullname',
                            'c.CategoryName',
                            'c.Logo'])->from('History_Post as a')
                        ->leftJoin('Admin_Cms as b', 'a.UserUpdate=b.id')
                        ->leftJoin('Categories as c', 'a.CategoryID=c.CategoryID')
                        ->where(['a.PostID' => $postId])
                        ->groupBy('a.DateCreate')
                        ->orderBy('a.ID ASC')->all();
        return $data;
    }

    public function updateNews90phut($newsId) {
        //remove notice
        Notification::deleteAll(['NewsId' => $newsId, 'Type' => 1]);
        $model = new Post90phut();
        $model->NewsId = $newsId;
        $model->StarId = 0;
        $model->UserCreate = \Yii::$app->user->id;
        $model->DateCreate = date("Y-m-d H:i:s");
        $model->Type = 1;
        $model->save();
    }

    public function getRole($role) {
        $userId = \Yii::$app->user->id;
        $listRole = \Yii::$app->getAuthManager()->getPermissionsByUser($userId);
        if (isset($listRole[$role])) {
            return true;
        }
        return false;
    }

}
