<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;
?>
<!-- Header -->
<header>
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="header-text text-center">
                  <h1><?= Html::encode($this->title) ?></h1>

                  <p>This is the About page. You may modify the following file to customize its content:</p>

                  <code><?= __FILE__ ?></code>
                </div>
            </div>
        </div>
    </div>
</header>
