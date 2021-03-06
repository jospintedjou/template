<?php
use kartik\form\ActiveForm;
use kartik\builder\TabularForm;
use kartik\grid\GridView;
use yii\bootstrap\Html;
use yii\helpers\Url;

$this->title = 'Commande Magasin';

$this->registerCss("tr.kv-tabform-row>td{padding:1px !important}"
                    . "tr.kv-tabform-row>td>.form-control-static{padding:0px; margin-top:1px; font-size:1.2em; font-weight:250 !important}"
                    . "tr.kv-tabform-row>td>.bootstrap-touchspin{padding:0px; margin:2px !important}");
?>

<div style="margin-top: 5%">                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 
    <div style='display:none' class ='totalItems' id="<?= $total ?>"></div>
    <?php
    $form = ActiveForm::begin(['id'=>'products-list',  'action'=>URL::toRoute('branch-stock/save-order')]);
    $attribs = $formAttribs;
    //unset($attribs['attributes']['color']);
    //var_dump($dataProvider);
     \yii\widgets\Pjax::begin(["formSelector"=>false]); 
    echo TabularForm::widget([
        'dataProvider'=>$dataProvider,
        'form'=>$form,
        'attributes'=>$attribs,
        //'emptyCell'=>'-',
        'actionColumn'=>false,
        'rowSelectedClass'=>GridView::TYPE_INFO,

        'gridSettings'=>[
            //'rowOptions'=>['style'=>['height'=>'5px']],
            'floatHeader'=>false,
            'panel'=>[
                'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-shopping-cart"></i> Commande au magasin</h3>',
                'type' => GridView::TYPE_PRIMARY,
                'after'=> 
                        //Html::button('<i class="glyphicon glyphicon-plus"></i> Add New', ['class'=>'btn btn-success']) . ' ' . 
                        Html::button('<i class="glyphicon glyphicon-remove"></i> Reset', ['class'=>'btn btn-danger', 'id'=>'resetPList', 'style'=>'margin-left:70%']) . ' ' .
                        Html::submitButton('<i class="glyphicon glyphicon-floppy-disk"></i> Save', ['class'=>'btn btn-primary', 'id'=>'saveChecked', 'style'=>'margin-left:0%'])

            ]
        ],
        //'checkboxColumn'=>['class'=>'blue']
    ]);
      \yii\widgets\Pjax::end();

    ActiveForm::end();
?>
</div>
<?php
$this->registerJsFile('js/orderWarehouse.js');
?>
