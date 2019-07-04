<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\DriverSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="driver-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?php // echo $form->field($model, 'id') ?>

    <?php // echo $form->field($model, 'tanggal') ?>

    <?= $form->field($model, 'nama') ?>

    <?= $form->field($model, 'email') ?>

    <?= $form->field($model, 'no_sim') ?>

    <?php // echo $form->field($model, 'no_ktp') ?>

    <?php // echo $form->field($model, 'pendidikan') ?>

    <?php // echo $form->field($model, 'jenis_kelamin') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'usia') ?>

    <?php // echo $form->field($model, 'no_rek_mandiri') ?>

    <?php // echo $form->field($model, 'alamat_tinggal') ?>

    <?php // echo $form->field($model, 'alamat_ktp') ?>

    <?php // echo $form->field($model, 'merk_motor') ?>

    <?php // echo $form->field($model, 'pekerjaan') ?>

    <?php // echo $form->field($model, 'nopol_kendaraan') ?>

    <?php // echo $form->field($model, 'files') ?>

    <?php // echo $form->field($model, 'ojol') ?>

    <?php // echo $form->field($model, 'flag') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
