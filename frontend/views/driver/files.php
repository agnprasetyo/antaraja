<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\BerkasPendaftar */

$this->title = 'Verifikasi Berkas Pendaftar';
$this->params['breadcrumbs'][] = ['label' => 'Pendaftar', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="berkas-pendaftar-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form-files', [
        'model' => $model,
    ]) ?>

</div>
