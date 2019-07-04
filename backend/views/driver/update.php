<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Driver */

$this->title = 'Update Driver : ' . $modelDefault->nama;
$this->params['breadcrumbs'][] = ['label' => 'Driver', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $modelDefault->nama, 'url' => ['view', 'id' => $modelDefault->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="driver-update">

    <?= $this->render('_form-update', [
        'model' => $model,
        'modelDefault' => $modelDefault
    ]) ?>

</div>
