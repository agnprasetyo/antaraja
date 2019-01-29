<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Pendaftar */

$this->title = 'Files ' . $model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Data Pendaftar', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nama, 'url' => ['view', 'id' => $model->nama]];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="pendaftar-view">

    <p>
        <?= Html::a('Perbarui', ['files', 'id' => $model->nama], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Hapus', ['delete-files', 'id' => $model->nama], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
        <?php // Html::a('Download', Yii::$app->homeUrl . $model::URL_FILES . '/' . $model->files, ['class' => 'btn btn-success', 'download' => $model->files]) ?>
    </p>

    <div class="panel panel-default">
      <div class="panel-body">
          <embed width="100%" height="720" type="application/pdf" src="<?php echo 'uploads/files/'.$model->files; ?>">
      </div>
    </div>

</div>
