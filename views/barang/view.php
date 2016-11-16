<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Barang */
$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Barang', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
    <div class="row">
        <div class="col-md-4">
            <div class="barang-view">
                <h1>#<?php echo Html::encode($this->title); ?></h1>

                <p>

                <div class="btn-group">
                    <?php
                    echo Html::a('Home', ['index'], ['class' => 'btn btn-sm btn-success']);
                    echo Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-sm btn-primary']);
                    echo Html::a(
                        'Delete',
                        ['delete', 'id' => $model->id],
                        [
                            'class' => 'btn btn-sm btn-danger',
                            'data'  => [
                                'confirm' => 'Are you sure you want to delete this item?',
                                'method'  => 'post',
                            ],
                        ]
                    );
                    ?>
                </div>
                </p>
                <?php echo DetailView::widget(
                    [
                        'model'      => $model,
                        'attributes' => [
                            'id',
                            'nm_barang',
                            'ket_barang:ntext',
                            'harga_beli',
                            'margin_jual',
                            'harga_jual',
                            'satuanKecil.nm_satuan',
                            'satuanBesar.nm_satuan',
                            'kategori.desc',
                            'lokasi.desc',
                            'stock',
                            'min_stock',
                        ],
                    ]
                ) ?>
            </div>
        </div>
        <div class="col-md-6">
            <h1>&nbsp;</h1>

            <p>&nbsp;</p>

            <div class="form-group">
                <label class="label label-default">Scan Barcode</label>
                <input type="text" id="tx-barcode" class="form-control" />
            </div>

            <?php echo GridView::widget(
                [
                    'dataProvider' => $dataProvider,
                    'columns'      => [
                        ['class' => 'yii\grid\SerialColumn'],
                        'id',
                        'barcode',
                        ['class' => 'yii\grid\ActionColumn', 'template' => '{delete}'],
                    ],
                ]
            ); ?>
        </div>
    </div>
<?php
$js = <<<JS
$('#tx-barcode').val('');
$('#tx-barcode').focus();
$('#tx-barcode').keypress(function(e){
    var key = e.which || e.ctrlKey;
    if(key === 13){
        $.ajax({
           url: '?r=barang-detail/item-barcode',
           dataType:'json',
           type:'post',
           data: {barcode: $(this).val(),id_barang:$model->id},
           success: function(data) {
               window.location.reload(data.redirect);
           },
           error: function(){
            alert('Error!!! Some function not run');
            }
        });
        $(this).val('');
        e.preventDefault();
    }

});
JS;
$this->registerJs($js);

