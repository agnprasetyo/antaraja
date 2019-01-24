<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Driver */

$this->title = 'Tambah Driver Baru';
$this->params['breadcrumbs'][] = ['label' => 'Daftar Driver', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="driver-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
