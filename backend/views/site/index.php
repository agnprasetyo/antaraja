<?php
use dosamigos\highcharts\HighCharts;

/* @var $this yii\web\View */

$this->title = 'AntarAja';
?>
<div class="site-index">

    <!-- <div class="jumbotron">
        <h1>Congratulations!</h1>

        <p class="lead">You have successfully created your Yii-powered application.</p>

    </div> -->

    <div class="body-content">
      <?=
         Highcharts::widget([
            'clientOptions' => [
               'chart'=>[
                  // 'type'=>'bar'
               ],
               'title' => ['text' => 'Grafik Pendaftar'],
               'xAxis' => [
                  // 'categories' => ['Jumlah'],
                    'categories' => $categories,
               ],
               'yAxis' => [
                  'title' => ['text' => 'Jumlah Pendaftar']
               ],
               'series' => $series
            ]
         ]);
      ?>


    </div>
</div>
