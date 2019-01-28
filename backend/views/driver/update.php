<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Driver */

$this->title = 'Update Driver : ' . $model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Data Driver', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nama, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="driver-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
