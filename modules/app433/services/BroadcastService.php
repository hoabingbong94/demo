<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\modules\app433\services;

use app\modules\app433\models\Broadcast;
use yii\db\Query;
use app\modules\app90phut\models\SoccerTeam;
use app\modules\app433\services\UploadService;

class BroadcastService {

    private function getDateReport($date) {
        $date = strtotime($date);
        $fromDate = date('Y-m-d', strtotime('monday this week', $date));
        $toDate = date('Y-m-d', strtotime('next sunday', $date));
        return array('fromDate' => $fromDate . " 00:00:00", 'toDate' => $toDate . " 23:59:59");
    }

    public function findByDate($date, $status) {
        $dateTime = $this->getDateReport($date);
        $startDate = $dateTime['fromDate'];
        $endDate = $dateTime['toDate'];
        $query = new Query();
        $data = $query->select(['a.ID',
                    'a.HomeId',
                    'a.HomeColor',
                    'a.AwayId',
                    'a.AwayColor',
                    'a.StartTime',
                    'a.Channel',
                    'a.Sopcast',
                    'a.LiveStream',
                    'a.LiveStreamLink',
                    'a.DateCreate',
                    'a.UserCreate',
                    'b.CategoryName',
                    'c.fullname'])
                ->from('Broadcast as a')
                ->leftJoin('Categories as b', 'b.CategoryID = a.CategoriesID')
                ->leftJoin('Admin_Cms as c', 'c.ID = a.UserCreate')
                ->orderBy("a.ID DESC")
                ->where(['>=', "a.StartTime", $startDate])
                ->andWhere(["<=", "a.StartTime", $endDate]);
        if ($status != 3) {
            $data->andWhere(['a.Status' => $status]);
        }
        return $data->all();
    }

    public function fetchTeam($listBroadcast) {
        $listTeamId = array();
        $i = 0;
        foreach ($listBroadcast as $k => $values) {
            $homeId = $values['HomeId'];
            $awayId = $values['AwayId'];
            if (!isset($listBroadcast[$homeId])) {
                $listTeamId[$i] = $homeId;
                $i++;
            }
            if (!isset($listBroadcast[$awayId])) {
                $listTeamId[$i] = $awayId;
                $i++;
            }
        }
        return $this->getListTeamById($listTeamId);
    }

    public function getListTeamById($listTeamId) {
        $query = new Query();
        $data = $query->select(['TeamID', 'TeamName', 'NameVN', 'Logo'])
                        ->from('Soccer_Team')
                        ->where(['IN', 'TeamID', $listTeamId])->all();
        $rsTeam = array();
        foreach ($data as $k => $values) {
            $rsTeam[$values['TeamID']] = $values;
        }
        return $rsTeam;
    }

    public function findById($id) {
        $data = Broadcast::find()->where(['ID' => $id])->one();
        return $data;
    }

    public function searchTeam($keyword, $idElement) {
        $data = SoccerTeam::find()->where(['LIKE', 'TeamName', $keyword])
                        ->orWhere(['LIKE', 'NameVN', $keyword])
                        ->limit(10)->all();
        $rs = array();
        $view = '';
        foreach ($data as $key => $values) {
            $thumb = $values->Logo;
            $view.='<li onClick="loadImg(' . $values->TeamID . ',' . "'" . $idElement . "'" . ',' . "'" . str_replace("'", "", $values->TeamName) . "'" . ')">' . $values->TeamName . '</li>';
        }
        return $view;
    }

    public function save(Broadcast $model) {

        $date = date("Y-m-d H:i:s");
        $path = date("Y/m/d");
        $userId = \Yii::$app->user->id;
        $upload = new UploadService();
        if ($model->ID == '') {
            $model->UserCreate = $userId;
            $model->DateCreate = $date;
        }
        $model->UserUpdate = $userId;
        $model->DateUpdate = $date;
        if ($model->AwayColor == '') {
            $model->AwayColor = '#C0C0C0';
        }
        if ($model->HomeColor == '') {
            $model->HomeColor = '#C0C0C0';
        }
        //Upload
        $uploadedAvatar = $upload->uploadBase64("images/" . $path, $model->Avatar, 256, 94);
        if ($uploadedAvatar != false) {
            $model->Avatar = "/media433/images/" . $path . "/" . $uploadedAvatar;
        }
        if ($model->save()) {
            return true;
        } else {
            return false;
        }
    }

}
