<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\select2\Select2;
use kartik\widgets\FileInput;
use kartik\widgets\SwitchInput;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use common\models\Bouteille;
use common\models\Categorie;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel common\providers\ProduitSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Stock Hollando';
?>
<div id="flash" style="z-index:1500;position: fixed;left:60%;width: 40%"> 
    <?php if (Yii::$app->getSession()->hasFlash('success'))  ?>    
    <?php if (Yii::$app->getSession()->hasFlash('danger'))  ?>
</div>
<div class="produit-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <ul class="nav nav-tabs" style="font-size: 15px">
        <li class="active"><a data-toggle="tab" href="#boissons">Boissons</a></li>
        <li><a data-toggle="tab" href="#tabac">Tabac</a></li> 
    </ul>
    <?php
    $pdfconfigurations = [
        'label' => 'Save as pdf',
//    'icon' => $isFa ? 'file-pdf-o' : 'floppy-disk',
        'iconOptions' => ['class' => 'text-danger'],
        'showHeader' => true,
        'showPageSummary' => true,
        'showFooter' => true,
        'showCaption' => false,
        'filename' => 'liste des produits du black and white',
        'alertMsg' => "The PDF export file will be generated for download.",
        'options' => ['title' => 'Portable Document Format'],
        'mime' => 'application/pdf',
        'config' => [
            'mode' => 'c',
            'format' => 'A4-L',
            'destination' => 'D',
            'marginTop' => 20,
            'marginBottom' => 20,
            'cssInline' => '.kv-wrap{padding:20px;}' .
            '.kv-align-center{text-align:center;}' .
            '.kv-align-left{text-align:left;}' .
            '.kv-align-right{text-align:right;}' .
            '.kv-align-top{vertical-align:top!important;}' .
            '.kv-align-bottom{vertical-align:bottom!important;}' .
            '.kv-align-middle{vertical-align:middle!important;}' .
            '.kv-page-summary{border-top:4px double #ddd;font-weight: bold;}' .
            '.kv-table-footer{border-top:4px double #ddd;font-weight: bold;}' .
            '.kv-table-caption{font-size:1.5em;padding:8px;border:1px solid #ddd;border-bottom:none;}',
//        'methods' => [
//            'SetHeader' => [
//                ['odd' => $pdfHeader, 'even' => $pdfHeader]
//            ],
//            'SetFooter' => [
//                ['odd' => $pdfFooter, 'even' => $pdfFooter]
//            ],
//        ],
        ],
//    'options' => [
//        'title' => 'liste',
//        'subject' =>  'PDF export generated by kartik-v/yii2-grid extension',
//        'keywords' => 'black, grid, export, yii2-grid, pdf'
//    ],
        'contentBefore' => '',
        'contentAfter' => ''
    ];

    $gridColumns_drink = [
// the name column configuration
        [
            'class' => '\kartik\grid\SerialColumn',
            'width' => '15px',
        ],
        [
            'attribute' => 'nom',
            'width' => '100px',
        ],
        [
            'attribute' => 'categorie',
            'width' => '150px',
            'filterType' => GridView::FILTER_SELECT2,
            'filter' => ArrayHelper::map(Categorie::find()->where(['<>','type','repas'])->groupBy(['nom'])->asArray()->all(), 'nom', 'nom'),
            'filterWidgetOptions' => [
                'pluginOptions' => ['allowClear' => true],
            ],
            'filterInputOptions' => ['placeholder' => 'Any category'],
        ],
        [
            'attribute' => 'nb_btlle',
            'width' => '100px',
            'label' => 'nombre de bouteille',
            'filterType' => GridView::FILTER_SELECT2,
            'filter' => ArrayHelper::map(Bouteille::find()->groupBy(['nb_btlle'])->asArray()->all(), 'nb_btlle', 'nb_btlle'),
            'filterWidgetOptions' => [
                'pluginOptions' => ['allowClear' => true],
            ],
            'filterInputOptions' => ['placeholder' => 'Any quantity'],
        ],
        [
            'attribute' => 'capacite',
            'label' => 'capacité / bouteille',
            'width' => '100px',
        ],
        [
            'attribute' => 'prix_achat_btlle',
            'label' => 'prix d\'achat',
            'width' => '100px',
        ],
        [
            'attribute' => 'prix_vente_btlle',
            'label' => 'prix de vente',
            'width' => '100px',
        ],
        [
            'class' => '\kartik\grid\ActionColumn',
            'deleteOptions' => ['label' => '<i class="glyphicon glyphicon-remove"></i>'],
            'viewOptions' => ['class' => 'hidden'],
            'width' => '30px',
        ],
    ];
// Generate a bootstrap responsive striped table with row highlighted on hover
    ?>
    <div class="tab-content">
        <div id="boissons" class="tab-pane fade in active">  
            <?=
            GridView::widget([
                'dataProvider' => $data_drinkProvider,
                'filterModel' => $searchModel,
                'columns' => $gridColumns_drink,
                'headerRowOptions' => ['class' => 'kartik-sheet-style',],
                'filterRowOptions' => ['class' => 'kartik-sheet-style'],
                'hover' => true,
                'bordered' => true,
                'striped' => true,
                'condensed' => true,
                'responsive' => true,
                'panel' => [
                    'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-glass"></i> Boissons</h3>',
                    'type' => 'primary',
                ],
                'showPageSummary' => false,
                'toolbar' => [
                    [
                        'content' =>
                        '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#stockproductform-modal">
                           <i class="glyphicon glyphicon-plus"></i>
                         </button>' . ' ' .
                        Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['view'], [
                            'class' => 'btn btn-default',
                            'title' => 'Recharger le tableau '
                        ]),
                    ],
                    '{export}',
                    '{toggleData}'
                ],
                'exportConfig' => [
                    GridView::PDF => $pdfconfigurations,
                ],
            ]);
            ?>

        </div>
        <div id="tabac" class="tab-pane fade">
            <?=
            GridView::widget([
                'dataProvider' => $data_tabacProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    [
                        'class' => '\kartik\grid\SerialColumn',
                        'width' => '15px',
                    ],
                    [ 'attribute' => 'nom',
                        'width' => '130px',
                    ],
                    'quantite',
                    'prix_achat',
                    'prix_vente',
                    [
                        'class' => '\kartik\grid\ActionColumn',
                        'deleteOptions' => ['label' => '<i class="glyphicon glyphicon-remove"></i>'],
                        'viewOptions' => ['class' => 'hidden'],
                        'width' => '30px',
                    ],
                ],
                'headerRowOptions' => ['class' => 'kartik-sheet-style'],
                'filterRowOptions' => ['class' => 'kartik-sheet-style'],
                'hover' => true,
                'bordered' => true,
                'striped' => true,
                'condensed' => true,
                'responsive' => true,
                'panel' => [
                    'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-list"></i>Tabac</h3>',
                    'type' => 'primary',
                ],
                'showPageSummary' => false,
                'toolbar' => [
                    [
                        'content' =>
                        '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#stockproductform-modal">
                           <i class="glyphicon glyphicon-plus"></i>
                         </button>' . ' ' .
                        Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['view'], [
                            'class' => 'btn btn-default',
                            'title' => 'Recharger le tableau '
                        ]),
                    ],
                    '{export}',
                    '{toggleData}'
                ],
                'exportConfig' => [
                    GridView::PDF => $pdfconfigurations,
                ],
            ]);
            ?>
        </div>
    </div>
    <div class="modal fade" style="margin-top:70px;" id="stockproductform-modal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Nouveau Produit</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="stockproductform-close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">                
                    <?php $form = ActiveForm::begin(['action' => Url::toRoute(['warehouse/create-product']), 'method' => 'post', 'options' => ['enctype' => 'multipart/form-data']]) ?>
                    <div class="col-lg-7 col-md-7 col-xs-7">                  
                        <?=
                        $form->field($model, 'categorie')->widget(Select2::className(), [
                            'data' => ArrayHelper::map(Categorie::find()->where(['<>','type','repas'])->groupBy(['nom'])->asArray()->all(), 'id_categorie', 'nom'),
                            'theme' => Select2::THEME_BOOTSTRAP,
                            'options' => ['placeholder' => 'Select category ...'],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ]);
                        ?>
                        <?=
                        $form->field($model, 'nom')->textInput(['maxlength' => true])->input('nom', [
                            'placeholder' => "Entrer un nom ..."
                        ])
                        ?>  
                        <div class="fieldset">
                            <fieldset >
                                <legend style="font-size:14px"> Mode de vente</legend>
                                <div class="col-lg-3 col-md-3 col-xs-3">
                                    <?=
                                    $form->field($model, 'btlle')->checkbox(['value' => '0'])
                                    ?>
                                </div>
                                <div class="col-lg-3 col-md-3 col-xs-3">
                                    <?=
                                    $form->field($model, 'verre')->checkbox(['value' => '0'])
                                    ?>
                                </div>
                                <div class="col-lg-3 col-md-3 col-xs-3">
                                    <?=
                                    $form->field($model, 'conso')->checkbox(['value' => '0'])
                                    ?>
                                </div>
                                <div class="col-lg-3 col-md-3 col-xs-3">
                                    <?=
                                    $form->field($model, 'demie_btlle')->checkbox(['value' => '0'])
                                    ?>
                                </div>       
                            </fieldset>
                        </div>

                        <div  id="attributs_tabac">
                            <?=
                            $form->field($model, 'tabac')->textInput(['maxlength' => true])
                            ?>
                            <?=
                            $form->field($model, 'prix_achat_tabac')->textInput(['maxlength' => true])->input('prix_achat_tabac', [
                                'placeholder' => "Entrer le prix d'achat en fcfa..."
                            ])
                            ?>
                            <?=
                            $form->field($model, 'prix_vente_tabac')->textInput(['maxlength' => true])->input('prix_vente_tabac', [
                                'placeholder' => "Entrer le prix de vente en fcfa..."
                            ])
                            ?>
                           
                        </div>
                        
                        <div  id="attributs_btlle">
                            <?=
                            $form->field($model, 'prix_achat_btlle')->textInput(['maxlength' => true])->input('prix_achat', [
                                'placeholder' => "Entrer le prix d'achat en fcfa..."
                            ])
                            ?>
                            <?=
                            $form->field($model, 'prix_vente_btlle')->textInput(['maxlength' => true])->input('prix_vente', [
                                'placeholder' => "Entrer le prix de vente en fcfa..."
                            ])
                            ?>
                        </div>
                        <div  id="attributs_demie_btlle">
                            <?=
                            $form->field($model, 'prix_vente_demie_btlle')->textInput(['maxlength' => true])->input('prix_vente', [
                                'placeholder' => "Entrer le prix de vente en fcfa..."
                            ])
                            ?>
                        </div>
                        <?php // $form->field($model, 'quantite')->textInput(['maxlength' => true])->input('quantite', ['placeholder' => "Entrer la quantité du produit livré ..."])   ?>
                    </div>
                    <div class="col-lg-5 col-md-5 col-xs-5"> 

                        <div  id="attributs_btlle">
                            <?=
                            $form->field($model, 'capacite_btlle')->textInput(['maxlength' => true])->input('capacite_btlle', [
                                'placeholder' => "Entrer la capacité en cl ..."
                            ])
                            ?>
                            <?=
                            $form->field($model, 'dilluant')->widget(Select2::classname(), [
                                'data' => ['non' => 'non', 'oui' => 'oui'],
                                'theme' => Select2::THEME_BOOTSTRAP,
                                'options' => ['placeholder' => 'Est ce un dilluant ? ...'],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]);
                            ?> 

                        </div>
                        
                        <div  id="attributs_conso">
                            <?=
                            $form->field($model, 'prix_vente_conso')->textInput(['maxlength' => true])->input('prix_vente_conso', [
                                'placeholder' => "Entrer le prix de vente en fcfa..."
                            ])
                            ?>
                            <?=
                            $form->field($model, 'nombre_conso')->textInput(['maxlength' => true])->input('prix_vente_conso', [
                                'placeholder' => "Entrer le nombre de conso par bouteille..."
                            ])
                            ?>
                            <?=
                            $form->field($model, 'capacite_conso')->textInput(['maxlength' => true])->input('capacite_conso', [
                                'placeholder' => "Entrer la capacité en cl ..."
                            ])
                            ?>
                        </div>
                        <div  id="attributs_verre">
                            <?=
                            $form->field($model, 'prix_vente_verre')->textInput(['maxlength' => true])->input('prix_vente_verre', [
                                'placeholder' => "Entrer le prix de vente en fcfa..."
                            ])
                            ?>
                            <?=
                            $form->field($model, 'nombre_verre')->textInput(['maxlength' => true])->input('prix_vente_verre', [
                                'placeholder' => "Entrer le nombre de verre par bouteille..."
                            ])
                            ?>
                            <?=
                            $form->field($model, 'capacite_verre')->textInput(['maxlength' => true])->input('capacite_verre', [
                                'placeholder' => "Entrer la capacité en cl ..."
                            ])
                            ?>
                        </div>
                        <?=
                        $form->field($model, 'photo')->widget(FileInput::classname(), [
                            'pluginOptions' => [
                                'showUpload' => false,
                                'browseLabel' => '',
                                'browseClass' => 'btn btn-primary',
                                'removeLabel' => '',
                                'allowedFileExtensions' => ['jpg', 'png', 'jpeg', 'gif'],
                                'msgInvalidFileExtension' => 'uniquement les fichiers jpg,png,jpeg,gif'
                            ]
                        ]);
                        ?>
                    </div>          
                </div>
                <div class="modal-footer">                

                    <?= Html::resetButton('Close', ['class' => 'btn btn-primary', 'id' => 'stockproductform-reset']) ?> 
                    <?= Html::button('Close', ['class' => 'btn btn-default', 'data-dismiss' => 'modal', 'id' => 'stockproductform-close']) ?> 
                    <?= Html::submitButton('Creer', ['class' => 'btn btn-primary',]) ?>                      
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>


<?php
$this->registerJs("$(function () {    
            $('.alert').css({'position':'fixed',
                            'left':'60%',
                            'width':'40%',
            });
            $('.alert-success.alert.fade.in').fadeOut(9000);
            $('.alert-danger.alert.fade.in').fadeOut(9000);
            $('#stockproductform-reset').click();  
            $('#stockproductform-reset').hide();  
            $('.field-stockproductform-tabac').hide();  
            $('div .fieldset').hide(); 

             $('#stockproductform-modal').on('hide.bs.modal', function () {
                     
                    $('span #select2-stockproductform-categorie-container').html(\"<span class='select2-selection__placeholder'>Select category ...</span>\");
                    $('div .fieldset').hide(); 
                    $('#stockproductform-reset').click();
                    $('div #attributs_btlle').hide(); 
                    $('div #attributs_demie_btlle').hide(); 
                    $('div #attributs_conso').hide();
                    $('div #attributs_verre').hide();
                    $('div #attributs_tabac').hide(); 
                     
             });
           $('div #attributs_tabac').hide();  
           $('#stockproductform-categorie').on('change',function () {
                if ($('#stockproductform-categorie option:selected').text() == 'Tabac'){                       
                         $('input[name=\'StockProductForm[tabac]\']').val('tabac');
                         $('div #attributs_tabac').show();                          
                         $('div .fieldset').hide();
                        
                 }  else 
                 {
                        $('input[name=\'StockProductForm[tabac]\']').val(''); 
                        $('div .fieldset').show(); 
                        $('div #attributs_tabac').hide(); 
                 }
                if ($('#stockproductform-categorie option:selected').val() == ''){                       
                         $('div .fieldset').hide();                          
                         $('#stockproductform-reset').click();
                         $('div #attributs_btlle').hide();
                         $('div #attributs_demie_btlle').hide();
                         $('div #attributs_conso').hide();
                         $('div #attributs_verre').hide();
                 } 
            });
            $('div #attributs_btlle').hide(); 
            $('input[name=\'StockProductForm[btlle]\']').click(function () {
                if (!($(this).is(':checked'))){   
                          $(this).val('1');
                          $('div #attributs_btlle').hide();
                          $('#stockproductform-reset').click();
                          $('div #attributs_btlle').hide();
                          $('div #attributs_demie_btlle').hide();
                          $('div #attributs_conso').hide();
                          $('div #attributs_verre').hide();
                          $('span #select2-stockproductform-categorie-container').html(\"<span class='select2-selection__placeholder'>Select category ...</span>\");
                 }
                 else
                 {
                 $(this).val('bouteille');
                 $('div #attributs_btlle').show(); 
                 }
                                 
            });

            $('div #attributs_demie_btlle').hide(); 
            $('input[name=\'StockProductForm[demie_btlle]\']').click(function () {
                if (!$(this).is(':checked')){   
                         $(this).val('1');
                         $('div #attributs_demie_btlle').hide();
                         $('#stockproductform-reset').click();
                         $('div #attributs_btlle').hide();
                          $('div #attributs_demie_btlle').hide();
                          $('div #attributs_conso').hide();
                          $('div #attributs_verre').hide();
                          $('span #select2-stockproductform-categorie-container').html(\"<span class='select2-selection__placeholder'>Select category ...</span>\");
                 }
                 else
                 {
                 $(this).val('demie_btlle');
                 $('div #attributs_demie_btlle').show();
                 }
                 
            });
            $('div #attributs_conso').hide(); 
            $('input[name=\'StockProductForm[conso]\']').click(function () {
                if (!$(this).is(':checked')){ 
                         $(this).val('1');
                         $('div #attributs_conso').hide();
                         $('#stockproductform-reset').click();
                         $('div #attributs_btlle').hide();
                         $('div #attributs_demie_btlle').hide();
                         $('div #attributs_conso').hide();
                         $('div #attributs_verre').hide();
                         $('span #select2-stockproductform-categorie-container').html(\"<span class='select2-selection__placeholder'>Select category ...</span>\");
                 }
                 else
                 {
                 $(this).val('conso');
                 $('div #attributs_conso').show(); 
                 }
            });
            $('div #attributs_verre').hide(); 
            $('input[name=\'StockProductForm[verre]\']').click(function () {
                if (!$(this).is(':checked')){
                         $(this).val('1');
                         $('div #attributs_verre').hide();
                         $('#stockproductform-reset').click();
                         $('div #attributs_btlle').hide();
                         $('div #attributs_demie_btlle').hide();
                         $('div #attributs_conso').hide();
                         $('div #attributs_verre').hide();
                         $('span #select2-stockproductform-categorie-container').html(\"<span class='select2-selection__placeholder'>Select category ...</span>\");
                 }
                 else
                 {
                 $(this).val('verre');
                 $('div #attributs_verre').show();
                }
            });

    });"
);
?>
