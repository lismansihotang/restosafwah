<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
$this->title = 'e-Warung POS';
?>
<div class="site-index">
    <div class="jumbotron">

        <h1>Selamat Datang!</h1>

        <p class="lead">Aplikasi e-Warung berbasis Web.</p>
        <?php
        echo Html::img('@web/images/mie-piring-panas.jpg', ['class' => 'img img-responsive img-thumbnail']);
        ?>
    </div>
    <div class="body-content">
    </div>
</div>
<style>
    .jumbotron img {
        width: 60%;
    }
</style>