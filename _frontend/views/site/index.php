<?php

use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = Yii::$app->name;

?>
<div class="site-index">
    <div class="jumbotron">
        <h1>Selamat Datang !</h1>
        <p class="lead">Anda Belum Login.</p>
        <p>
            <?php echo Html::a('Login Sekarang', ['login'], ['class' => 'btn btn-lg btn-success']) ?>
        </p>
    </div>
</div>
