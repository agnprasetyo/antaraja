<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\DriverSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


if (!$model) { ?>

  <div class="alert alert-danger">
    Tidak Ada data ditemukan!
  </div>

<?php
} else { ?>

  <div class="alert alert-success">
    Data ditemukan!
  </div>

<div class="jumbotron">
  Akun dengan nama 
  <?php echo $model->nama; ?>
  diyatakan 
  <?php 
    if ($model->flag == 'Diterima') {
      echo $model->flag;
    } elseif ($model->flag == 'Ditolak') {
      echo $model->flag;
    } else {
      echo $model->flag = $model::FLAG_PENDING;
    }
  ?>
</div>

<?php
}


?>
