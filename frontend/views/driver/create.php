<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Driver */

$this->title = '';
// $this->params['breadcrumbs'][] = ['label' => 'Data Driver', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
?>

<div class="driver-create bgform">
    <!-- <div class="container"> -->

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
    <!-- </div> -->
</div>
