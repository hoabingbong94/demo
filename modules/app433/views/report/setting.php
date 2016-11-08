<?php

use app\modules\app433\services\ReportService;

$report = new ReportService();
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Số liệu thống kê</h3>
    </div>
    <div class="panel-body">
        <form id="searchForm" action="" method="GET">
            <input type="hidden" value="<?= Yii::$app->request->getCsrfToken(); ?>" id="_csrf"/>
            <div class="col-md-12">
                <div class="col-md-3 form-group ">
                    <label>Chọn ngày</label>
                    <input onblur="loaddate();" onClick="loaddate();" id="datetimepicker3" name="date" class="form-control hasDatepicker" type="text" value="<?= $paramsGet['date'] ?>">
                </div>
                <div class="col-md-3 form-group ">
                    <label>Loại tin</label>
                    <select class="form-control" name="type">
                        <?= $report->settingReport('type', $paramsGet['type']) ?>
                    </select>
                </div>
                <div class="col-md-3 form-group ">
                    <label>Số liệu</label>
                    <select class="form-control" name="typeReport">
                        <?= $report->settingReport('typeReport', $paramsGet['typeReport']) ?>
                    </select>
                </div>
                <div class="col-md-3 form-group ">
                    <label>Kiểu tin</label>
                    <select class="form-control" name="public">
                        <?= $report->settingReport('public', $paramsGet['public']) ?>
                    </select>
                </div>
                <div class="col-md-3 form-group ">
                    <label>Sắp xếp theo</label>
                    <select class="form-control" name="col">
                        <?= $report->settingReport('col', $paramsGet['col']) ?>
                    </select>
                </div>
                <div class="col-md-3 form-group ">
                    <label>Sắp xếp</label>
                    <select class="form-control" name="order">
                        <?= $report->settingReport('order', $paramsGet['order']) ?>
                    </select>
                </div>
                <div class="col-md-3 form-group ">
                    <label>Biên tập viên</label>
                    <select class="form-control" name="userCreate">
                        <option value="">Tất cả</option>
                        <?php
                        foreach ($listAdmin as $id => $fullname) {
                            $select = "";
                            if ($paramsGet['userCreate'] == $id) {
                                $select = "selected";
                            }
                            echo '<option ' . $select . ' value="' . $id . '">' . $fullname . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-3 form-group ">
                    <label>Loại báo cáo</label>
                    <select class="form-control" name="report">
                        <?= $report->settingReport('report', $paramsGet['report']) ?>
                    </select>
                </div>
                <div class="col-xs-3 pull-right text-right clearfix form-group ">
                    <button class="btn btn-default" style="margin-top:24px" type="submit">
                        <i class="fa fa-bar-chart" aria-hidden="true"></i> Thống kê</button>
                </div>
            </div>
        </form>
    </div>
</div>