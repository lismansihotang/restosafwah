<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use yii\bootstrap\Modal;
use app\models\Kategori;

/* @var $this yii\web\View */
/* @var $model app\models\PenjualanDetail */
/* @var $form yii\widgets\ActiveForm */
$arrKategori = ArrayHelper::map(Kategori::find()->all(), 'id', 'desc');
Modal::begin(
    [
        'header' => '<h3>Pembayaran</h3>',
        'id'     => 'modal',
        'size'   => 'modal-md'
    ]
);
echo '<div id="modalContent"></div>';
Modal::end();
?>
    <div class="pull-right margin-bottom-lg">
        <?php echo Html::button(
            '<span class="glyphicon glyphicon-shopping-cart"> </span> Pembayaran',
            [
                'value' => Url::to('index.php?r=penjualan/payment&id=' . $idJual),
                'class' => 'btn btn-sm btn-success',
                'id'    => 'modalButton'
            ]
        );
        ?>
    </div>
    <div class="penjualan-detail-form">
        <h1><?php
            echo number_format($subtotal);
            ?>
        </h1>

        <div class="row margin-bottom-5">
            <?php
            if (count($recordBarang) > 0) {
                foreach ($recordBarang as $row) {
                    echo '<div class="col-md-2"><button id="' . $row->id . '" class="btn-add"><h2>' . $row->nm_barang . '</h2><h1>' . number_format(
                            $row->harga_jual
                        ) . '</h1></button></div>';
                }
            }
            ?>
        </div>
        <?php
        $form = ActiveForm::begin(['id' => 'frm-penjualan']);
        foreach ($arrKategori as $key => $value) {
            ?>
            <button class="btn-kategori btn btn-app btn-primary margin-bottom-5"
                    alt="<?php echo Url::to(
                        'index.php?r=penjualan-detail/create&id-jual=' . $idJual . '&id-kategori=' . $key
                    ); ?>">

                <h3><?php echo $value; ?></h3>
            </button>

            <?php
        }
        ?>
        <?php ActiveForm::end(); ?>
    </div>
<?php
$js = <<<JS
$('.btn-kategori').on('click',function(){
        window.location = $(this).attr('alt');
        return false;
        //window.location = url+idKategori;
});

$('.btn-add').on('click',function() {
  $.ajax({
           url: '?r=penjualan-detail/item-price',
           dataType:'json',
           data: {id: $(this).attr('id'),jual:$idJual},
           success: function(data) {
               if(data.redirect===false){
                    alert(data.msg);
               }
               window.location.reload(data.redirect);
           },
           error: function(){
            alert('Error!!! Some function not run');
            }
        });
        $('#frm-penjualan').submit(function(){
            return false;
        });
        $(this).val('');
        e.preventDefault();
});
/*$('#id-barang').val('');
$('#id-barang').focus();
$('#id-barang').keypress(function(e){
    var key = e.which || e.ctrlKey;
    if(key === 13){
        $.ajax({
           url: '?r=penjualan-detail/item-price',
           dataType:'json',
           data: {id: $(this).val(),jual:$idJual},
           success: function(data) {
               if(data.redirect===false){
                    alert(data.msg);
               }
               window.location.reload(data.redirect);
           },
           error: function(){
            alert('Error!!! Some function not run');
            }
        });
        $('#frm-penjualan').submit(function(){
            return false;
        });
        $(this).val('');
        e.preventDefault();
    }

});*/
JS;
$this->registerJs($js);

