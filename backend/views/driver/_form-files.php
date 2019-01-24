<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model app\models\BerkasPendaftar */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="files-driver-form">

    <?php $form = ActiveForm::begin([
        'options' => [
            'enctype' => 'multipart/form-data',
        ]
    ]) ?>

    <?= $form->field($model, 'files')->widget(FileInput::classname())->label('Berkas (.pdf)') ?>

    <div class="form-group">
        <?= Html::submitButton('Simpan', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
