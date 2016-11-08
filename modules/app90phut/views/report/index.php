<div class="list-item-index">
    <div class="panel panel-default">
        <div class="panel-heading">

            <h3 class="panel-title">Thiết đặt số liệu</h3>
        </div>
        <div class="panel-body">

            <input type="hidden" value="<?= Yii::$app->request->getCsrfToken(); ?>" id="_csrf"/>
            <div class="col-md-12">
                <div class="col-md-3 form-group">
                    <label>Loại báo cáo</label>
                    <select class="form-control" id="typeView" onChange="reportView90phut()">
                        <option value="total">Tổng bài</option>
                        <option value="view">Lượt xem</option>
                    </select>
                </div>
                <div class="col-md-3 form-group ">
                    <label>Mục báo cáo</label>
                    <select class="form-control" id="type">
                        <option value="news">Tin tức</option>
                        <option value="video">Video</option>
                        <option value="tips">Nhận định</option>
                        <option id="typeStar" value="star">Ngôi sao</option>
                        <option id="typeAlbum" value="album">Bóng hồng</option>
                    </select>
                </div>

                <div class="col-md-3 form-group ">
                    <label>Số liệu</label>
                    <select onchange="selectTypeReport()" class="form-control" id="typeReport" name="typeReport">
                        <option value="date">Theo ngày</option>
                        <option value="week">Theo tuần</option>
                        <option value="month">Theo tháng</option>
                        <option value="interval">Khoảng thời gian</option>
                    </select>
                </div>
                <div class="col-md-3 form-group ">
                    <label>Sắp xếp</label>
                    <select class="form-control" id="order">
                        <option value="DESC">Giảm dần</option>
                        <option value="ASC">Tăng dần</option>
                    </select>
                </div>
                <div class="col-md-3 form-group ">
                    <label>Biên tập viên</label>
                    <select class="form-control" id="userCreate">
                        <option value="">Tất cả</option>
                        <?php
                        foreach ($listAdmin as $id => $fullname) {
                            echo '<option value="' . $id . '">' . $fullname . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-3 form-group ">
                    <label>Chọn ngày</label>
                    <input onblur="loaddate();" onClick="loaddate();" id="datetimepicker3" name="date" class="form-control hasDatepicker" type="text" value="<?= date("Y-m-d") ?>">
                </div>
                <div class="col-md-3 form-group " id="toDate" style="display:none;">
                    <label>Đến ngày</label>
                    <input onblur="loaddateend();" onClick="loaddateend();" id="enddate" name="endDate" class="form-control hasDatepicker" type="text" value="<?= date("Y-m-d") ?>">
                </div>
                <div class="col-xs-2 pull-right text-right clearfix form-group ">
                    <button onclick="report()" id="btnSubmitReport" class="btn btn-default" style="margin-top:24px" type="submit">Thống kê</button>
                </div>
            </div>

        </div>
    </div>
    <div class="clearfix"></div>
</div>
<div class="list-item-index" id="data-report"></div>
<script>
    function selectTypeReport() {
        var type = $("#typeReport").val();
        if (type == "interval") {
            $("#toDate").show();
        } else {
            $("#toDate").hide();
        }
    }
    function loaddate2() {

    }
</script>

