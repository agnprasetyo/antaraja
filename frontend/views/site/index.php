<?php

use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = Yii::$app->name;

?>
<div class="site-index">
    <div class="jumbotron">
        <h1>Selamat Datang !</h1>
        <p class="lead">Buat kamu mudah, Tanpa ribet</p>
        <p class="lead">AntarAja Solusinya</p>

        <p>
            <?php echo Html::a('Daftar Sekarang', ['driver/create'], ['class' => 'btn btn-lg btn-success']) ?>
            <?php echo Html::a('Data Pendaftar', ['driver/index'], ['class' => 'btn btn-lg btn-primary']) ?>
        </p>
    </div>
</div>
