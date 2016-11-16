<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Penjualan */
$this->title = 'Create Penjualan';
$this->params['breadcrumbs'][] = ['label' => 'Penjualan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="penjualan-create">
    <h1><?php echo Html::encode($this->title); ?></h1>
    <?php echo $this->render(
        '_form',
        [
            'model' => $model,
        ]
    ); ?>
</div>
