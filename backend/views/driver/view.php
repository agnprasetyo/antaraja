<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Driver */

$this->title = 'Detail Driver : ' . $model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Driver', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nama, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Detail';
\yii\web\YiiAsset::register($this);
?>
<div class="driver-view">

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Yakin mau menghapus data driver ini?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id',
            'tanggal',
            'nama',
            'email:email',
            'no_sim',
            'no_ktp',
            'pendidikan',
            'jenis_kelamin',
            'status',
            'usia',
            'no_rek_mandiri',
            'alamat_tinggal',
            'alamat_ktp',
            'merk_motor',
            'pekerjaan',
            'nopol_kendaraan',
            [
                'attribute'=>'files',
                'label'=>'File',
            ],
            'ojol',
            [
                'label'=>'Nomor HP Utama',
                'format'=>'raw',
                'value'=>function($model)
                {
                    return $model['noHps'][0]->nomer;
                }
            ],
            [
                'label'=>'Nomor HP Alternatif',
                'format'=>'raw',
                'value'=>function($model)
                {
                    return $model['noHps'][1]->nomer;
                }
            ],
        ],
        // 'template' = '<tr><th{captionOptions}>{label}</th><td{contentOptions}>{value}</td></tr>';
    ]) ?>

</div>
