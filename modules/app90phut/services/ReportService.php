<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\modules\app90phut\services;

use app\services\Service;
use yii\db\Query;
use app\modules\app90phut\models\News;
use app\modules\app90phut\services\AdminService;

class ReportService extends Service {

    public function reportNews($params) {
        $dateReport = $this->getDateReport($params['date'], $params['enddate'], $params['typeReport']);
        $fromDate = $dateReport['fromDate'];
        $endDate = $dateReport['toDate'];
        $groupBy = "ExtendUserCreate";
        $orderBy = "total " . $params['order'];
        if ($params['userCreate'] != "") {
            $groupBy = "DATE(ExtendUpdateDate)";
            $orderBy = "ExtendUpdateDate " . $params['order'];
        }
        $query = new Query();
        $data = $query->select(['ExtendUpdateDate as dateCreate', 'ExtendUserCreate as userId', 'COUNT(*) AS total'])
                        ->from('News')
                        ->where(['>=', 'ExtendUpdateDate', $fromDate])
                        ->andWhere(['<=', 'ExtendUpdateDate', $endDate])
                        ->groupBy($groupBy)
                        ->orderBy($orderBy)->all(News::getDb());
        $dataReport = $this->getDataReport($data);
        return $dataReport;
    }

    public function reportVideo($params) {
        $dateReport = $this->getDateReport($params['date'], $params['enddate'], $params['typeReport']);
        $fromDate = $dateReport['fromDate'];
        $endDate = $dateReport['toDate'];
        $groupBy = "UserID";
        $orderBy = "total " . $params['order'];
        if ($params['userCreate'] != "") {
            $groupBy = "DATE(DateCreate)";
            $orderBy = "DateCreate " . $params['order'];
        }
        $query = new Query();
        $data = $query->select(['DateCreate as dateCreate', 'UserID as userId', 'COUNT(*) AS total'])
                        ->from('Extend_Video')
                        ->where(['>=', 'DateCreate', $fromDate])
                        ->andWhere(['<=', 'DateCreate', $endDate])
                        ->groupBy($groupBy)
                        ->orderBy($orderBy)->all(News::getDb());
        $dataReport = $this->getDataReport($data);

        return $dataReport;
    }

    public function reportTips($params) {
        $dateReport = $this->getDateReport($params['date'], $params['enddate'], $params['typeReport']);
        $fromDate = $dateReport['fromDate'];
        $endDate = $dateReport['toDate'];
        $groupBy = "UserCreate";
        $orderBy = "total " . $params['order'];
        if ($params['userCreate'] != "") {
            $groupBy = "DATE(CreateDate)";
            $orderBy = "CreateDate " . $params['order'];
        }
        $query = new Query();
        $data = $query->select(['CreateDate as dateCreate', 'UserCreate as userId', 'COUNT(*) AS total'])
                        ->from('Extend_Match_Tips')
                        ->where(['>=', 'CreateDate', $fromDate])
                        ->andWhere(['<=', 'CreateDate', $endDate])
                        ->groupBy($groupBy)
                        ->orderBy($orderBy)->all(News::getDb());
        $dataReport = $this->getDataReport($data);

        return $dataReport;
    }

    public function reportStar($params) {
        $dateReport = $this->getDateReport($params['date'], $params['enddate'], $params['typeReport']);
        $fromDate = $dateReport['fromDate'];
        $endDate = $dateReport['toDate'];
        $groupBy = "UserCreate";
        $orderBy = "total " . $params['order'];
        if ($params['userCreate'] != "") {
            $groupBy = "DATE(ReleaseDate)";
            $orderBy = "ReleaseDate " . $params['order'];
        }
        $query = new Query();
        $data = $query->select(['ReleaseDate as dateCreate', 'UserCreate as userId', 'COUNT(*) AS total'])
                        ->from('Extend_Star')
                        ->where(['>=', 'ReleaseDate', $fromDate])
                        ->andWhere(['<=', 'ReleaseDate', $endDate])
                        ->groupBy($groupBy)
                        ->orderBy($orderBy)->all(News::getDb());
        $dataReport = $this->getDataReport($data);

        return $dataReport;
    }

    public function reportAlbum($params) {
        $dateReport = $this->getDateReport($params['date'], $params['enddate'], $params['typeReport']);
        $fromDate = $dateReport['fromDate'];
        $endDate = $dateReport['toDate'];
        $groupBy = "UserUpdate";
        $orderBy = "total " . $params['order'];
        if ($params['userCreate'] != "") {
            $groupBy = "DATE(DateCreate)";
            $orderBy = "DateCreate " . $params['order'];
        }
        $query = new Query();
        $data = $query->select(['DateCreate as dateCreate', 'UserUpdate as userId', 'COUNT(*) AS total'])
                        ->from('Extend_Album_Image')
                        ->where(['>=', 'DateCreate', $fromDate])
                        ->andWhere(['<=', 'DateCreate', $endDate])
                        ->groupBy($groupBy)
                        ->orderBy($orderBy)->all(News::getDb());
        $dataReport = $this->getDataReport($data);
        return $dataReport;
    }

    public function reportViewNews($params) {
        $dateReport = $this->getDateReport($params['date'], $params['enddate'], $params['typeReport']);
        $fromDate = $dateReport['fromDate'];
        $endDate = $dateReport['toDate'];
        $groupBy = "ExtendUserCreate";
        $orderBy = "totalView " . $params['order'];
        $query = new Query();
        $data = $query->select(['SUM(ViewCount) AS totalView', 'ExtendUserCreate as userId'])
                        ->from('News')
                        ->where(['>=', 'ExtendUpdateDate', $fromDate])
                        ->andWhere(['<=', 'ExtendUpdateDate', $endDate])
                        ->groupBy($groupBy)
                        ->orderBy($orderBy)->all(News::getDb());
        $dataReport = $this->getDataReportView($data);
        return $dataReport;
    }

    public function reportViewVideo($params) {
        $dateReport = $this->getDateReport($params['date'], $params['enddate'], $params['typeReport']);
        $fromDate = $dateReport['fromDate'];
        $endDate = $dateReport['toDate'];
        $groupBy = "UserID";
        $orderBy = "totalView " . $params['order'];
        $query = new Query();
        $data = $query->select(['SUM(ViewCount) AS totalView', 'UserID as userId'])
                        ->from('Extend_Video')
                        ->where(['>=', 'DateCreate', $fromDate])
                        ->andWhere(['<=', 'DateCreate', $endDate])
                        ->groupBy($groupBy)
                        ->orderBy($orderBy)->all(News::getDb());
        $dataReport = $this->getDataReportView($data);
        return $dataReport;
    }

    public function reportViewTips($params) {
        $dateReport = $this->getDateReport($params['date'], $params['enddate'], $params['typeReport']);
        $fromDate = $dateReport['fromDate'];
        $endDate = $dateReport['toDate'];
        $groupBy = "UserCreate";
        $orderBy = "totalView " . $params['order'];
        $query = new Query();
        $data = $query->select(['SUM(ViewCount) AS totalView', 'UserCreate as userId'])
                        ->from('Extend_Match_Tips')
                        ->where(['>=', 'CreateDate', $fromDate])
                        ->andWhere(['<=', 'CreateDate', $endDate])
                        ->groupBy($groupBy)
                        ->orderBy($orderBy)->all(News::getDb());
        $dataReport = $this->getDataReportView($data);
        return $dataReport;
    }

    private function getDataReport($data) {
        $adminService = new AdminService();
        $listAdmin = $adminService->getListAdmin();
        $dataReport = array();
        foreach ($data as $key => $values) {
            $dataReport[$key] = $values;
            $dataReport[$key]['dateCreate'] = date("d-m-Y", strtotime($values['dateCreate']));
            $dataReport[$key]['fullname'] = isset($listAdmin[$values['userId']]) ? $listAdmin[$values['userId']] : "";
        }
        return $dataReport;
    }

    private function getDataReportView($data) {
        $adminService = new AdminService();
        $listAdmin = $adminService->getListAdmin();
        $dataReport = array();
        foreach ($data as $key => $values) {
            $dataReport[$values['userId']] = $values;
            $dataReport[$values['userId']]['fullname'] = isset($listAdmin[$values['userId']]) ? $listAdmin[$values['userId']] : "";
        }
        return $dataReport;
    }

}
