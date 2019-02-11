<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\DriverSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


$q = Yii::$app->request->get('q');
$urlData = Url::to(['', 'q' => '']);
$js = <<< JS

var result = $("#result");
var qDefault = "$q";

// console.log(content);

$("#search_text").keyup(function() {

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
<div class="jumbotron">
    <h1>Selamat Datang !</h1>
    <p class="lead">Buat kamu mudah, Tanpa ribet</p>
    <p class="lead">AntarAja Solusinya</p>

    <p>
        <?php echo Html::a('Daftar Sekarang', ['driver/create'], ['class' => 'btn btn-lg btn-success']) ?>
    </p>
    <br>

    <div class="driver-index">

        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon">Cari</span>
                <input type="text" name="q" id="search_text" placeholder="Cek status pendaftaran berdasarkan nomor KTP / nomor SIM" class="form-control" />
            </div>
        </div>
        <br>

        <?php // Pjax::begin(['id' => 'table-pjax']); ?>
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

        <div id="result" class="table-responsive"></div>

        <?php // Pjax::end(); ?>

    </div>
</div>
