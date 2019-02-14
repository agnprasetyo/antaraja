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

$("#search_text").click(function() {

    var q = $("#search_text").val();
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
  <!-- <div class="container text-center my-auto">
    <h1 class="mb-1">Stylish Portfolio</h1>
    <h3 class="mb-5">
      <em>A Free Bootstrap Theme by Start Bootstrap</em>
    </h3>
    <a class="btn btn-primary btn-xl js-scroll-trigger" href="#about">Find Out More</a>
  </div> -->
<div class="container">
  <div class="jumbotron">

      <h1>Selamat Datang !</h1>
      <p class="lead">Buat kamu mudah, Tanpa ribet</p>
      <p class="lead">AntarAja Solusinya</p>

      <p>
          <?php echo Html::button('Daftar Sekarang', ['value' => Url::to('driver/create'),'class' => 'btn btn-success','id'=>'modalButton']) ?>
      </p>
      <br>

      <div class="driver-index">

          <div class="form-group">
              <div class="input-group">
                  <span class="input-group-addon">Cari</span>
                  <input type="text" name="q" id="search_text" placeholder="Cek status pendaftaran berdasarkan nomor KTP / nomor SIM" class="form-control">
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

          echo "<div id='modalContent'><div>";
          Modal::end()
      ?>
  <div class="overlay"></div>
</div>
</header>
