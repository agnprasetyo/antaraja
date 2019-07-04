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
<!-- <div class="for"> -->
  <div class="row">

      <?php $form = ActiveForm::begin(); ?>
      <div class="panel-group" id="accordion">
          <div class="panel panel-default">
            <div class="panel-heading">
              <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
              <h4 class="panel-title">
                User Information
              </h4>
              </a>
            </div>
            <div id="collapse1" class="panel-collapse collapse in">
              <div class="panel-body">
                <div class="col-xs-12 col-sm-6">
                <?= $form->field($model['Driver'], 'nama')->textInput(['maxlength' => true, 'autocomplete' => 'off']) ?>
                <?= $form->field($model['Driver'], 'usia')->textInput(['autocomplete' => 'off']) ?>

                <?= $form->field($model['Driver'], 'alamat_ktp')->textInput(['maxlength' => true, 'autocomplete' => 'off']) ?>

                <?= $form->field($model['Driver'], 'no_ktp')->textInput(['maxlength' => true, 'autocomplete' => 'off']) ?>

                <?= $form->field($model['Driver'], 'pendidikan')->widget(Select2::classname(), [
                      'data' => $model['Driver']->listPendidikan(),
                      'pluginOptions' => [
                          'placeholder' => ' --- Pilih Pendidikan Terkhir --- ',
                      ],
                  ]) ?>
                </div>
                
                <div class="col-xs-12 col-sm-6">
                <?= $form->field($model['Driver'], 'email')->textInput(['maxlength' => true, 'autocomplete' => 'off']) ?>
                
                <?= $form->field($model['Driver'], 'pekerjaan')->textInput(['maxlength' => true, 'autocomplete' => 'off']) ?>

                <?= $form->field($model['Driver'], 'alamat_tinggal')->textInput(['maxlength' => true, 'autocomplete' => 'off']) ?>

                <?= $form->field($model['Driver'], 'no_sim')->textInput(['maxlength' => true, 'autocomplete' => 'off']) ?>
                
                <?= $form->field($model['Driver'], 'jenis_kelamin')->widget(Select2::classname(), [
                      'data' => $model['Driver']->listJenisKelamin(),
                      'pluginOptions' => [
                        'placeholder' => ' --- Pilih Jenis Kelamin --- ',
                      ],
                  ]) ?>
                </div>
              </div>
            </div>
          </div>
          <div class="panel panel-default">
            <div class="panel-heading">
              <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
              <h4 class="panel-title">
                Contact Information
              </h4>
              </a>
            </div>
            <div id="collapse2" class="panel-collapse collapse">
              <div class="panel-body">
                <div class="col-xs-12 col-sm-6">
                
                <?= $form->field($model['Driver'], 'no_rek_mandiri')->textInput(['autocomplete' => 'off']) ?>

                <?= $form->field($model['Driver'], 'merk_motor')->textInput(['maxlength' => true, 'autocomplete' => 'off']) ?>

                  <div class="row">
                      <div class=" col-xs-12 col-sm-6">
                          <?= $form->field($model['NoHp'], 'nomer1')->textInput(['maxlength' => true, 'autocomplete' => 'off']) ?>
                          <?= $form->field($model['MerkHp'], 'merk')->textInput(['maxlength' => true, 'autocomplete' => 'off']) ?>
                      </div>
                      <div class="col-xs-12 col-sm-6">
                          <?= $form->field($model['NoHp'], 'nomer2')->textInput(['maxlength' => true, 'autocomplete' => 'off']) ?>
                          <?= $form->field($model['MerkHp'], 'type')->textInput(['maxlength' => true, 'autocomplete' => 'off']) ?>
                      </div>
                  </div>

                  <?= $form->field($model['Driver'], 'status')->widget(Select2::classname(), [
                      'data' => $model['Driver']->listStatus(),
                      'pluginOptions' => [
                        'placeholder' => ' --- Pilih Status --- ',
                      ],
                  ]) ?>

                  <?= $form->field($model['Driver'], 'ojol')->widget(Select2::classname(), [
                        'data' => $model['Driver']->listOjol(),
                        'pluginOptions' => [
                            'placeholder' => ' --- Ikut Ojek Online --- ',
                        ],
                    ])->label('Ikut Ojek Online ?')  ?>

                </div>

                <div class="col-xs-12 col-sm-6">
                  <?= $form->field($model['Driver'], 'nopol_kendaraan')->textInput(['maxlength' => true, 'autocomplete' => 'off']) ?>
                  
                  <?= $form->field($model['Driver'], 'files')->widget(FileInput::classname())->label('Lampiran Berkas (.pdf)') ?>
                </div>
              </div>
            </div>
          </div>
      </div>
          <div class="clearfix">
              <div class="col-xs-12 col-sm-12">
                  <div class="form-group">
                      <?php echo Html::a('Cancel', ['../public'], ['class' => 'btn btn-secondary']) ?>
                      <?php echo Html::submitButton('Simpan', ['class' => 'btn btn-primary pull-right']) ?>
                  </div>
              </div>
          </div>


      <?php ActiveForm::end(); ?>
  </div>
</div>
