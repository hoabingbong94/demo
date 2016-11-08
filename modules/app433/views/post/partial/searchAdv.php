<div class="panel panel-default" style="display:none" id="searchAdv">
    <div class="panel-heading">
        <h3 class="panel-title"> Tìm kiếm nâng cao
            <span onclick="closeSearchAdv()" style="float:right;cursor: pointer;"><i class="fa fa-times" aria-hidden="true"></i></span>
        </h3>
    </div>
    <div class="panel-body">
        <form id="searchForm" action="" method="GET">
            <input type="hidden" value="<?= Yii::$app->request->getCsrfToken(); ?>" id="_csrf"/>
            <div class="col-md-12">
                <div class="col-md-3 form-group ">
                    <label>Ngày tạo</label>
                    <input onblur="loaddate();" onClick="loaddate();" id="datetimepicker3" name="date" class="form-control hasDatepicker" type="text" value="">
                </div>
                <div class="col-md-3 form-group ">
                    <label>Loại tin</label>
                    <select class="form-control" name="type">
                        <option value="">Tất cả</option>
                        <option value="0">Tin nhanh</option>
                        <option value="4">Tin dài</option>
                        <option value="1">Tin video</option>
                        <option value="5">Tin live</option>
                        <option value="6">Live stream</option>
                        <option value="3">Album video</option>
                    </select>
                </div>
                <div class="col-md-3 form-group ">
                    <label>Trạng thái</label>
                    <select class="form-control" name="public">
                        <option value="all">Tất cả</option>
                        <option value="1">Tin hiện</option>
                        <option value="0">Tin ẩn</option>
                        <option value="date">Chờ xuất bản</option>
                    </select>
                </div>
                <div class="col-md-3 form-group ">
                    <label>Chuyên mục</label>
                    <select class="form-control" name="categoriesId">
                        <option value="">Tất cả</option>
                        <?php

                        use app\modules\app433\services\CategoriesService;

$categoriesService = new CategoriesService();
                        $listCategories = $categoriesService->findAll();
                        foreach ($listCategories as $id => $values) {
                            echo '<option value="' . $id . '">' . $values . '</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-md-12 form-group ">
                <div class="col-md-3 form-group ">
                    <select class="form-control" name="userId">
                        <option value="all">Tất cả biên tập</option>
                        <?php
                        $listAdmin = \app\modules\app433\models\AdminCms::find()->where(['status'=>1]) ->all();
                        foreach ($listAdmin as $k => $v) {
                            echo ' <option value="' . $v->id . '">' . $v->fullname . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-6 form-group">
                    <input type="text" class="form-control" placeholder="Nhập nội dung tìm kiếm" name="keyword"/>
                </div>
                <div class="col-md-3">
                    <button class="btn btn-default">
                        <i class="fa fa-search" aria-hidden="true"></i> Tìm kiếm
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>