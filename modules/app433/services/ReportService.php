<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\modules\app433\services;

use yii\data\Pagination;
use yii\db\Query;

class ReportService {

    private function getDateReport($date, $type) {
        $fromDate = "";
        $toDate = "";
        if ($type == "date") {
            $fromDate = $date;
            $toDate = $date;
        }
        if ($type == "week") {
            $date = strtotime($date);
            $fromDate = date('Y-m-d', strtotime('last monday', $date));
            $toDate = date('Y-m-d', strtotime('next sunday', $date));
        }
        if ($type == "month") {
            $date = strtotime($date);
            $fromDate = date('Y-m-d', strtotime('first day of this month', $date));
            $toDate = date('Y-m-d', strtotime('last day of this month', $date));
        }
        return array('fromDate' => $fromDate . " 00:00:00", 'toDate' => $toDate . " 23:59:59");
    }

    public function reportPostCount($type, $date, $typeReport, $col, $order, $userCreate, $public) {
        $dateReport = $this->getDateReport($date, $typeReport);
        $fromDate = $dateReport['fromDate'];
        $toDate = $dateReport['toDate'];
        $query = new Query();
        $queryEx = $query->select(['COUNT(a.ID) as total', 'b.fullname', 'a.DateCreate'])
                ->from('Post as a')
                ->leftJoin('Admin_Cms as b', 'a.UserCreate = b.id')
                ->where(['>=', 'a.DateCreate', $fromDate])
                ->andWhere(['<=', 'a.DateCreate', $toDate]);
        if ($type != "all") {
            $queryEx->andWhere(['a.Type' => $type]);
        }
        if ($public != "all") {
            $queryEx->andWhere(['a.Public' => $public]);
        }
        $groupBy = "b.fullname";
        if ($userCreate != "") {
            $groupBy = "DATE(a.DateCreate)";
            $queryEx->andWhere(['a.UserCreate' => $userCreate]);
        }
        $data = $queryEx->groupBy($groupBy)->orderBy("total " . $order)->all();
        return $data;
    }

    public function reportPost($type, $date, $typeReport, $col, $order, $userCreate, $public) {
        $dateReport = $this->getDateReport($date, $typeReport);

        $fromDate = $dateReport['fromDate'];
        $toDate = $dateReport['toDate'];
        $query = new Query();
        $queryEx = $query->select([
                    'a.ID',
                    'a.Recommened',
                    'a.DatePublic',
                    'a.Type',
                    'a.Title',
                    'a.Content',
                    'a.Thumbnails',
                    'a.DateCreate',
                    'a.ThumbVideo',
                    'a.Pin',
                    'a.View',
                    'b.CategoryName',
                    'b.LOGO',
                    'b.TitleAlias',
                    'c.fullname'
                ])
                ->from('Post as a')
                ->leftJoin('Categories as b', 'a.CategoryID = b.CategoryID')
                ->leftJoin('Admin_Cms as c', 'c.id = a.UserCreate')
                ->andWhere(['>=', 'a.DatePublic', $fromDate])
                ->andWhere(['<=', 'a.DatePublic', $toDate]);

        if ($type != "") {
            $queryEx->andWhere(['a.Type' => $type]);
        }
        if ($public != "all") {
            $queryEx->andWhere(['a.Public' => $public]);
        }
        if ($userCreate != "") {
            $queryEx->andWhere(['a.UserCreate' => $userCreate]);
        }
        $queryEx->andWhere(['<>', 'a.IsDelete', 1]);
        $queryEx->orderBy("a." . $col . " " . $order)
                ->limit(10);
        $query->createCommand();
        $pagination = new Pagination([
            'defaultPageSize' => 10,
            'totalCount' => $query->count(),
        ]);

        $data = $queryEx->orderBy("a." . $col . " " . $order)
                ->offset($pagination->offset)
                ->limit($pagination->limit)
                ->all();

        return array('data' => $data, 'pagination' => $pagination);
    }

    public function settingReport($type, $paramGet) {
        $listOption = [];
        $option = '';
        switch ($type) {
            case "type":
                $listOption = [4 => 'Tin dài', 1 => 'Tin video', 'all' => 'Tất cả'];
                break;
            case "typeReport":
                $listOption = ['date' => 'Theo ngày', 'week' => 'Theo tuần', 'month' => 'Theo tháng'];
                break;
            case "col":
                $listOption = ['View' => 'Lượt xem', 'DatePublic' => 'Ngày xuất bản', 'DateCreate' => 'Ngày tạo', 'ID' => 'Mã bài'];
                break;
            case "public":
                $listOption = ['1' => 'Hiển thị', '0' => 'Tin ẩn', 'all' => 'Tất cả'];
                break;
            case "order":
                $listOption = ['DESC' => 'Giảm dần', 'ASC' => 'Tăng dần'];
                break;
            case "report":
                $listOption = ['view' => 'View', 'countTotal' => 'Tổng bài'];
                break;
        }
        foreach ($listOption as $k => $v) {
            $select = '';
            if ($paramGet == $k) {
                $select = "selected";
            }
            $option.='<option ' . $select . '  value="' . $k . '">' . $v . '</option>';
        }
        return $option;
    }

}
