<?php
use yii\helpers\Url;
use yii\helpers\Html;

return [
    // [
    //     'class' => 'kartik\grid\CheckboxColumn',
    //     'width' => '20px',
    // ],
    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
    ],
        // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'id',
    // ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'tanggal',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'nama',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'email',
    ],
    // [
    //     'class'=>'\kartik\grid\DataColumn',
    //     'attribute'=>'no_sim',
    // ],
    // [
    //     'class'=>'\kartik\grid\DataColumn',
    //     'attribute'=>'no_ktp',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'pendidikan',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'jenis_kelamin',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'status',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'usia',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'no_rek_mandiri',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'alamat_tinggal',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'alamat_ktp',
    // ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'merk_motor',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'pekerjaan',
    ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'nopol_kendaraan',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'files',
    // ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'ojol',
    ],
    [
      'attribute' => 'status',
      'options' => [
          'style' => 'width: 90px',
      ],
      'format'    => 'raw',
      'filter'    => $searchModel->listBerkas(),
      'value'     => function ($model)
      {
        switch ($model->flag) {
          case $model::FLAG_DITERIMA:
          $flag = '<span class="label label-success">'.$model::FLAG_DITERIMA.'</span>';
          break;

          case $model::FLAG_DITOLAK:
          $flag = '<span class="label label-danger">'.$model::FLAG_DITOLAK.'</span>';
          break;

          case $model::FLAG_PENDING:
          $flag = '<span class="label label-warning">'.$model::FLAG_PENDING.'</span>';
          break;

          default:
          $flag = '<span class="label label-danger">'.$model::FLAG_DELETED.'</span>';
          break;
        }

        return $flag;
      },
    ],
    [
        'class' => 'yii\grid\ActionColumn',
        'options' => [
            'style' => 'width: 70px',
        ],
        'header'   => 'Verifikasi',
        'template' => '{terima} {tolak}',
        'buttons' => [
            'terima'   => function ($url, $model) {
                if ($model->isTerima($model->id)) {
                    return null;
                }
                return Html::a('<i class="fa fa-check"></i>',
                    $url,
                    [
                        'title' => 'Terima',
                        'data-method'  => 'post',
                        'class' => 'btn btn-xs btn-success',
                    ]
                );
            },
            'tolak' => function ($url, $model) {
                if ($model->isTolak($model->id)) {

                    return null;
                }
                return Html::a('<i class="fa fa-times"></i>',
                    $url,
                    [
                        'title' => 'Tolak',
                        'data-method'  => 'post',
                        'class' => 'btn btn-danger btn-xs',
                    ]
                );
            },
        ],
    ],
    [
        'class' => 'yii\grid\ActionColumn',
        'options' => [
            'style' => 'width: 40px',
        ],
        'header'   => 'Files',
        'template' => '{files}',
        'buttons' => [
            'files' => function ($url, $model) {
                if ($model->hasFiles($model->id)) {
                    return Html::a('<i class="fa fa-search-plus"></i>',
                        ['view-files', 'id' => $model->id],
                        [
                            'title' => 'Lihat flag',
                            'class' => 'btn btn-xs btn-primary',
                        ]
                    );
                }
                elseif (!$model->hasFiles($model->id)) {
                    return Html::a('<i class="fa fa-upload"></i>',
                        ['files', 'id' => $model->id],
                        [
                            'title' => 'Unggah flag',
                            'class' => 'btn btn-xs btn-warning',
                        ]
                    );
                }
                // if ($model->isTolak($model->id)) {
                //
                //     return '<span class="label label-danger">Status Ditolak</span>';
                // }
                //
                // return '<span class="label label-warning">Status Pending</span>';
            },
        ],
    ],
    [
        'class' => 'yii\grid\ActionColumn',
        'options' => [
            'style' => 'min-width: 100px',
        ],
        'header'   => 'Action',
        'template' => '{view} {update} {delete}',
        'buttons' => [
            'view'   => function ($url, $model) {
                return Html::a('<i class="fa fa-eye"></i>',
                    $url,
                    [
                        'title' => 'Lihat',
                        'class' => 'btn btn-xs btn-primary',
                    ]
                );
            },
            'update' => function ($url, $model) {
                return Html::a('<i class="fa fa-paint-brush"></i>',
                    $url,
                    [
                        'title' => 'Perbarui',
                        'class' => 'btn btn-warning btn-xs',
                    ]
                );
            },
            'delete' => function ($url, $model) {
                return Html::a('<i class="fa fa-trash"></i>',
                    $url,
                    [
                        'title'        => 'Hapus',
                        'class'        => 'btn btn-danger btn-xs',
                        'data-method'  => 'post',
                        'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                    ]
                );
            },
        ],
    ],

    // [
    //     'class' => 'kartik\grid\ActionColumn',
    //     'dropdown' => false,
    //     'vAlign'=>'middle',
    //     'urlCreator' => function($action, $model, $key, $index) {
    //             return Url::to([$action,'id'=>$key]);
    //     },
    //     'viewOptions'=>['role'=>'modal-remote','title'=>'View','data-toggle'=>'tooltip'],
    //     'updateOptions'=>['role'=>'modal-remote','title'=>'Update', 'data-toggle'=>'tooltip'],
    //     'deleteOptions'=>['role'=>'modal-remote','title'=>'Delete',
    //                       'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
    //                       'data-request-method'=>'post',
    //                       'data-toggle'=>'tooltip',
    //                       'data-confirm-title'=>'Are you sure?',
    //                       'data-confirm-message'=>'Are you sure want to delete this item'],
    // ],

];
