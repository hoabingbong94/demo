<?php
$controller = $this->context;
//$menus = $controller->module->menus;
$route = $controller->route;

if(!Yii::$app->user->isGuest){?>
<div class="col-md-3" id="left">
     <div class="list-group" id="contentMenu">
        <a href="/admin/user" class="list-group-item <?=(strpos($route, 'admin/user') === 0 || strpos($route, 'admin/assignment') === 0)?'active':''?>" >
            Quản lý user
            <i class="glyphicon glyphicon-chevron-right pull-right"></i></a>
        <a href="/admin/permission" class="list-group-item <?=(strpos($route, 'admin/permission') === 0)?'active':''?>">
            Quản lý quyền
            <i class="glyphicon glyphicon-chevron-right pull-right"></i></a>
     </div>
</div>
<?php }?>