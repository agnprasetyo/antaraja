<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\file\FileInput;
// use kartik\switchinput\SwitchInput;

/* @var $this yii\web\View */
/* @var $model common\models\Driver */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="driver-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="col-xs-12 col-sm-6">
        <?= $form->field($model, '_nama')->textInput(['maxlength' => true, 'autocomplete' => 'off']) ?>

        <?= $form->field($model, '_email')->textInput(['maxlength' => true, 'autocomplete' => 'off']) ?>

        <?= $form->field($model, '_no_rek_mandiri')->textInput(['autocomplete' => 'off']) ?>

        <?= $form->field($model, '_alamat_ktp')->textInput(['maxlength' => true, 'autocomplete' => 'off']) ?>

        <?= $form->field($model, '_alamat_tinggal')->textInput(['maxlength' => true, 'autocomplete' => 'off']) ?>

        <?= $form->field($model, '_no_ktp')->textInput(['maxlength' => true, 'autocomplete' => 'off']) ?>

        <?= $form->field($model, '_no_sim')->textInput(['maxlength' => true, 'autocomplete' => 'off']) ?>

    <div class="row">
        <div class=" col-xs-12 col-sm-6">
            <?= $form->field($model, '_merk_motor')->textInput(['maxlength' => true, 'autocomplete' => 'off']) ?>
            <?= $form->field($model, '_nomer1')->textInput(['maxlength' => true, 'autocomplete' => 'off']) ?>
            <?= $form->field($model, '_merk')->textInput(['maxlength' => true, 'autocomplete' => 'off']) ?>
        </div>
        <div class="col-xs-12 col-sm-6">
            <?= $form->field($model, '_nopol_kendaraan')->textInput(['maxlength' => true, 'autocomplete' => 'off']) ?>
            <?= $form->field($model, '_nomer2')->textInput(['maxlength' => true, 'autocomplete' => 'off']) ?>
            <?= $form->field($model, '_type')->textInput(['maxlength' => true, 'autocomplete' => 'off']) ?>
        </div>
    </div>

    <?= $form->field($model, '_ojol')->widget(Select2::classname(), [
      'data' => $modelDefault->listOjol(),
      'pluginOptions' => [
          'placeholder' => ' --- Ikut Ojek Online --- ',
      ],
    ]) ?>

    </div>

    <div class="col-xs-12 col-sm-6">
        <?= $form->field($model, '_usia')->textInput(['autocomplete' => 'off']) ?>

        <?= $form->field($model, '_pekerjaan')->textInput(['maxlength' => true, 'autocomplete' => 'off']) ?>

        <?= $form->field($model, '_pendidikan')->widget(Select2::classname(), [
            'data' => $modelDefault->listPendidikan(),
            'pluginOptions' => [
                'placeholder' => ' --- Pilih Pendidikan Terkhir --- ',
            ],
        ]) ?>

        <?= $form->field($model, '_jenis_kelamin')->widget(Select2::classname(), [
            'data' => $modelDefault->listJenisKelamin(),
            'pluginOptions' => [
              'placeholder' => ' --- Pilih Jenis Kelamin --- ',
            ],
        ]) ?>

        <?= $form->field($model, '_status')->widget(Select2::classname(), [
            'data' => $modelDefault->listStatus(),
            'pluginOptions' => [
              'placeholder' => ' --- Pilih Status --- ',
            ],
        ]) ?>

        <?= $form->field($model, '_files')->widget(FileInput::classname())->label('Lampiran Berkas (.pdf)') ?>
    </div>
    <div class="clearfix">
    <div class="col-xs-12 col-sm-12">
        <hr>
        <div class="form-group">
            <?php echo Html::submitButton('Simpan', ['class' => 'btn btn-primary pull-right']) ?>
        </div>
    </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
