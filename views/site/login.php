<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container">
    <style>
        body {
            background: #eee !important;
        }

        .wrapper {
            margin-top: 80px;
            margin-bottom: 80px;
        }

        .form-signin {
            max-width: 380px;
            padding: 15px 35px 45px;
            margin: 0 auto;
            background-color: #fff;
            border: 1px solid rgba(0, 0, 0, 0.1);

        .checkbox {
            margin-bottom: 30px;
        }

        .checkbox {
            font-weight: normal;
        }

        .form-control {
            position: relative;
            font-size: 16px;
            height: auto;
            padding: 10px;
        }

        input[type="text"] {
            margin-bottom: -1px;
            border-bottom-left-radius: 0;
            border-bottom-right-radius: 0;
        }

        input[type="password"] {
            margin-bottom: 20px;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
        }

        h2.title {
            font-size: 19px
        }

    </style>
    <div class="wrapper">
        <form class="form-signin">
            <h2 style="font-size: 22px;
    margin-bottom: 20px;
    margin-top: 10px;">Yêu cầu truy cập</h2>
            <input type="text" class="form-control" name="username" placeholder="Tài khoản" required=""
                   autofocus=""/>
            <input type="password" class="form-control" name="password" placeholder="Mật khẩu" required=""/>
            <label class="checkbox">
                <!--                <input type="checkbox" value="remember-me" id="rememberMe" name="rememberMe"> Remember me-->
            </label>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Gửi</button>
        </form>
    </div>
</div>
