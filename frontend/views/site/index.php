<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\DriverSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


$q = Yii::$app->request->get('q');
$urlData = Url::to(['', 'q' => '']);
$js = <<< JS

var result = $("#result");
var qDefault = "$q";

// console.log(content);

$("#search").change(function() {

    var q = $("#search").val();
    q = q ? q : qDefault;

    if (q) {
        result.show();

        $.get( "$urlData" + q, function( data ) {
            result.html( data );
        });
    } else {
        result.hide();
    }
});

JS;
$this->registerJs($js);

?>

<header class="masthead d-flex">
    <!-- <img class="for1" src="../public/images/1.png"> -->
<div class="container">
    <br><br>
    <img class="for" src="../public/images/profil.png">
    <br><br>
  <div class="jumbotron">

          <!-- <h1>Selamat Datang !</h1>
          <p class="lead">Buat kamu mudah, Tanpa ribet</p>
          <p class="lead">AntarAja Solusinya</p> -->

      <p>
          <?php echo Html::button('Daftar Sekarang', ['value' => Url::to('driver/create'),'class' => 'btn btn-primary','id'=>'modalButton']) ?>
      </p>
      <br>

      <div class="driver-index">

          <div class="form-group">
              <div class="input-group">
                  <span class="input-group-addon">Cari</span>
                  <input type="text" name="q" id="search" placeholder="Cek status pendaftaran berdasarkan nomor KTP / nomor SIM" class="form-control">
              </div>
          </div>
          <br>

          <?php // Pjax::begin(['id' => 'table-pjax']); ?>
          <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

          <div id="result" class="table-responsive"></div>

          <?php // Pjax::end(); ?>

      </div>
  </div>
  <?php
          Modal::begin([
          'header' => '<h2 class="text-center">Formulir Pendaftaran Driver Baru</h2>',
          'id' => 'modal',
          'size' => 'modal-lg',
          ]);

          echo "<div id='modalContent'></div>";
          Modal::end()
      ?>
  <div class="overlay"></div>
</div>
</header>
