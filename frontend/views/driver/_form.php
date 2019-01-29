<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model common\models\Driver */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="driver-form">
  <div class="row">

      <?php $form = ActiveForm::begin(); ?>
      <div class="col-xs-12 col-sm-6">
        <?= $form->field($model, 'nama')->textInput(['maxlength' => true])->label('Nama Lengkap') ?>
        <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'usia')->textInput() ?>

        <?= $form->field($model, 'no_rek_mandiri')->textInput() ?>

        <?= $form->field($model, 'alamat_tinggal')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'alamat_ktp')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'merk_motor')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'pekerjaan')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'no_sim')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'no_ktp')->textInput(['maxlength' => true]) ?>
      </div>
      <div class="col-xs-12 col-sm-6">


        <?= $form->field($model, 'pendidikan')->widget(Select2::classname(), [
          'data' => $model->listPendidikan(),
          'pluginOptions' => [
            'placeholder' => ' --- Pilih Pendidikan Terkhir --- ',
          ],
          ]) ?>
          <?= $form->field($model, 'jenis_kelamin')->widget(Select2::classname(), [
            'data' => $model->listJenisKelamin(),
            'pluginOptions' => [
              'placeholder' => ' --- Pilih Jenis Kelamin --- ',
            ],
          ]) ?>

          <?= $form->field($model, 'status')->widget(Select2::classname(), [
            'data' => $model->listStatus(),
            'pluginOptions' => [
              'placeholder' => ' --- Pilih Status --- ',
            ],
          ]) ?>
          <?= $form->field($model, 'nopol_kendaraan')->textInput(['maxlength' => true]) ?>
          <?= $form->field($model, 'ojol')->widget(Select2::classname(), [
              'data' => $model->listOjol(),
              'pluginOptions' => [
                  'placeholder' => ' --- Ikut Ojek Online --- ',
              ],
          ]) ?>
          <?= $form->field($model, 'files')->widget(FileInput::classname())->label('Upload Berkas') ?>
      </div>



      <!-- <div class="col-xs-12 col-sm-12"> -->

      <!-- </div> -->



      <!-- <div class="form-group">
          <?php// Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
      </div> -->
      <?php if (!Yii::$app->request->isAjax) { ?>
          <div class="clearfix">
          <div class="col-xs-12 col-sm-12">
              <hr>
              <div class="form-group">
                  <?php echo Html::a('Kembali', ['site/index'], ['class' => 'btn btn-secondary']) ?>
                  <?php echo Html::submitButton('Simpan', ['class' => 'btn btn-primary pull-right']) ?>
              </div>
          </div>
          </div>
      <?php } ?>
      <?php ActiveForm::end(); ?>
</div>
</div>
