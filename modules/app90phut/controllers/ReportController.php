<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\modules\app90phut\controllers;

use yii\web\Controller;
use app\modules\app90phut\services\ReportService;
use app\modules\app90phut\services\AdminService;

class ReportController extends Controller {

    private $getReport = null;
    private $getAdmin = null;
    public $layout = 'post';

    public function __construct($id, $module, $config = array()) {
        $this->getReport = new ReportService();
        $this->getAdmin = new AdminService();
        parent::__construct($id, $module, $config);
    }

    public function actionIndex() {
        $listAdmin = $this->getAdmin->getListAdmin();
        return $this->render('index', ['listAdmin' => $listAdmin]);
    }

    private function getParams() {
        $data['type'] = isset($_GET['type']) ? $_GET['type'] : "";
        $data['typeReport'] = isset($_GET['typeReport']) ? $_GET['typeReport'] : "";
        $data['order'] = isset($_GET['order']) ? $_GET['order'] : "";
        $data['userCreate'] = isset($_GET['userCreate']) ? $_GET['userCreate'] : "";
        $data['date'] = isset($_GET['date']) ? $_GET['date'] : "";
        $data['enddate'] = isset($_GET['enddate']) ? $_GET['enddate'] : "";
        $data['typeView'] = isset($_GET['typeView']) ? $_GET['typeView'] : "";
        return $data;
    }

    public function actionReport() {
        $this->layout = false;
        $view = "report";
        $params = $this->getParams();
        if ($params['typeView'] == "view") {
            $data = $this->loadActionView($params);
            $view = "report-view";
        } else {
            $data = $this->loadAction($params);
        }
        $json = json_encode($data);
        $dataEncode = urlencode($json);
        return $this->render($view, array('data' => $data,
                    'userId' => $params['userCreate'],
                    'params' => urlencode(json_encode($params)),
                    'json' => $dataEncode));
    }

    private function loadActionView($params) {
        $data = array();
        switch ($params['type']) {
            case "news":
                $data = $this->getReport->reportViewNews($params);
                break;
            case "video":
                $data = $this->getReport->reportViewVideo($params);
                break;
            case "tips":
                $data = $this->getReport->reportViewTips($params);
                break;
            case "all":
                $dataNews = $this->getReport->reportViewNews($params);
                $countNews = count($dataNews);
                $dataVideo = $this->getReport->reportViewVideo($params);
                $countVideo = count($dataVideo);
                $dataTips = $this->getReport->reportViewTips($params);
                $countTips = count($dataTips);
                if ($countNews > $countVideo && $countNews > $countTips) {
                    $data = $this->sumView($dataNews, $dataVideo, $dataTips);
                } else if ($countVideo > $countNews && $countVideo > $countTips) {
                    $data = $this->sumView($dataVideo, $dataNews, $dataTips);
                } else {
                    $data = $this->sumView($dataTips, $dataNews, $dataVideo);
                }
        }
        return $data;
    }

    private function sumView($dataRoot, $dataparent1, $dataparent2) {
        foreach ($dataRoot as $k => $v) {
            $view1 = isset($dataparent1[$k]['totalView']) ? $dataparent1[$k]['totalView'] : 0;
            $view2 = isset($dataparent2[$k]['totalView']) ? $dataparent2[$k]['totalView'] : 0;
            $dataRoot[$k]['totalView'] = $v['totalView'] + $view1 + $view2;
        }
        return $dataRoot;
    }

    private function loadAction($params) {
        $data = array();
        switch ($params['type']) {
            case "news":
                $data = $this->getReport->reportNews($params);
                break;
            case "video":
                $data = $this->getReport->reportVideo($params);
                break;
            case "tips":
                $data = $this->getReport->reportTips($params);
                break;
            case "star":
                $data = $this->getReport->reportStar($params);
                break;
            case "album":
                $data = $this->getReport->reportAlbum($params);
                break;
        }
        return $data;
    }

    public function actionExportExcel($data, $params) {
        $reportName = "";
        $params = json_decode(urldecode($params), true);
        switch ($params['type']) {
            case "news":
                $reportName = "tin tức";
                break;
            case "video":
                $reportName = "video";
                break;
            case "tips":
                $reportName = "nhận định";
                break;
            case "star":
                $reportName = "ngôi sao";
                break;
            case "album":
                $reportName = "bóng hồng";
                break;
        }
        $data = json_decode(urldecode($data), true);
        $excel = new \PHPExcel();

        $excel->setActiveSheetIndex(0);
        $excel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
        $excel->getActiveSheet()->getColumnDimension('B')->setWidth(50);
        $excel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
        $excel->getActiveSheet()->setCellValue('A1', 'Báo cáo thống kê ' . $reportName);
        $excel->setActiveSheetIndex(0)->mergeCells("A1:C1");
        $style = array(
            'alignment' => array(
                'horizontal' => \PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            )
        );
        $styleLeft = array(
            'alignment' => array(
                'horizontal' => \PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
            )
        );
        $styleRight = array(
            'alignment' => array(
                'horizontal' => \PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,
            )
        );
        $styleArray = array(
            'borders' => array(
                'allborders' => array(
                    'style' => \PHPExcel_Style_Border::BORDER_THIN
                )
            )
        );

        $excel->getActiveSheet()->getStyle('A1:C1')->applyFromArray($style);
        $excel->getActiveSheet()->getStyle('A1:C1')->getFont()->setBold(true);
        $excel->getActiveSheet()->setCellValue('A2', 'TT');
        $excel->getActiveSheet()->getStyle('A2')->getFont()->setBold(true);
        if ($params['userCreate'] == "") {
            $excel->getActiveSheet()->setCellValue('B2', 'Biên tập');
        } else {
            $excel->getActiveSheet()->setCellValue('B2', 'Ngày thống kê');
        }
        $excel->getActiveSheet()->getStyle('B2')->getFont()->setBold(true);
        $excel->getActiveSheet()->setCellValue('C2', 'Tổng số bài');
        $excel->getActiveSheet()->getStyle('C2')->getFont()->setBold(true);
        $row = 3;
        $total = 0;
        foreach ($data as $k => $v) {
            $excel->getActiveSheet()->setCellValue('A' . $row, $k + 1);
            $excel->getActiveSheet()->getStyle('A' . $row)->applyFromArray($styleLeft);
            if ($params['userCreate'] == "") {
                $excel->getActiveSheet()->setCellValue('B' . $row, $v['fullname']);
            } else {
                $excel->getActiveSheet()->setCellValue('B' . $row, $v['dateCreate']);
            }
            $excel->getActiveSheet()->setCellValue('C' . $row, $v['total']);
            $total = $total + $v['total'];
            $excel->getActiveSheet()->getStyle('C' . $row)->applyFromArray($styleLeft);
            $row++;
        }
        $row++;
        $excel->getActiveSheet()->setCellValue('B' . $row, 'Tổng');
        //$excel->setActiveSheetIndex(0)->mergeCells("A" . $row . ":B" . $row);
        $excel->getActiveSheet()->getStyle("B" . $row)->getFont()->setBold(true);
        $excel->getActiveSheet()->getStyle("B" . $row)->applyFromArray($styleLeft);
        $excel->getActiveSheet()->setCellValue('C' . $row, $total);
        $excel->getActiveSheet()->getStyle("C" . $row)->applyFromArray($styleLeft);
        $excel->getActiveSheet()->getStyle("C" . $row)->getFont()->setBold(true);
        for ($i = 1; $i <= $row; $i++) {
            $excel->getActiveSheet()->getStyle("A" . $i . ":C" . $i)->applyFromArray($styleArray);
        }
        header('Content-Type: application/vnd.ms-excel');
        $filename = "export" . date("d-m-Y-His") . ".xls";
        header('Content-Disposition: attachment;filename=' . $filename . ' ');
        header('Cache-Control: max-age=0');
        $objWriter = \PHPExcel_IOFactory::createWriter($excel, 'Excel5');
        $objWriter->save('php://output');
        die;
    }

}
