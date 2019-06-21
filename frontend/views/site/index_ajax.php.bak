<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\DriverSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>

<?=
GridView::widget([
    'dataProvider' => $dataProvider,
    // 'filterModel' => $searchModel,
    'columns' => [
        // ['class' => 'yii\grid\SerialColumn'],

        // 'id',
        'tanggal',
        'nama',
        'email:email',
        // 'no_sim',
        //'no_ktp',
        //'pendidikan',
        //'jenis_kelamin',
        //'status',
        //'usia',
        //'no_rek_mandiri',
        'alamat_tinggal',
        //'alamat_ktp',
        //'merk_motor',
        'pekerjaan',
        //'nopol_kendaraan',
        //'files',
        //'ojol',
        //'berkas',
        [
          'attribute' => 'status',
          'options' => [
              'style' => 'width: 90px',
          ],
          'format'    => 'raw',
          'filter'    => $searchModel->listBerkas(),
          'value'     => function ($model)
          {
            switch ($model->berkas) {
              case $model::BERKAS_DITERIMA:
              $berkas = '<span class="label label-success">'.$model::BERKAS_DITERIMA.'</span>';
              break;

              case $model::BERKAS_DITOLAK:
              $berkas = '<span class="label label-danger">'.$model::BERKAS_DITOLAK.'</span>';
              break;

              case $model::BERKAS_PENDING:
              $berkas = '<span class="label label-warning">'.$model::BERKAS_PENDING.'</span>';
              break;

              default:
              $berkas = '<span class="label label-danger">'.$model::BERKAS_DELETED.'</span>';
              break;
            }

            return $berkas;
          },
        ],
        // ['class' => 'yii\grid\ActionColumn'],
    ],
]);
?>
