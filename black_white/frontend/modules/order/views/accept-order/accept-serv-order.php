  <?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\widgets\Pjax;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
$this->registerCssFile('css/style.css');
?>

<div class="container-fluid " style=" padding-top: 80px;background-color: whitesmoke;padding-bottom: 0px;">
    <div class="row">
        <div class="btn-toolbar" style="float: right;padding-right: 20px;">
            <div class="btn-group">
                <button id="commande" class="btn btn-primary" type="button">Commandes</button>
                <button id="commandaccepte" class="btn btn-dark active" type="button">Commandes Acceptées</button>
            </div>
        </div>
    </div>

    <div id="notaccepted" style="height:750px; display: block;">
        <?php Pjax::begin(['id' => 'acceptsaveorder'])?>
          <div class="col-md-12 col-lg-12">

              <div class="row">
              <div class="col-md-12 col-lg-12">
                <div class="x_panel">
                  <div class="x_content">
                    <div class=" ">
<!--Order not yet served-->
                <?php foreach($commande as $commandeItem){ ?>                       
<!--                      block-->
                      <div class="col-md-4 col-sm-4  col-lg-4"  style="height:420px;">
                        <div class="welle profile_view col-lg-12 col-md-12 col-sm-12">                               
                              <div class="">
                                    <div class="panele_x col-md-12 col-lg-10">
                                      <div class="x_title">
                                          <div class="pull-left">
                                                <h2>Commande : <b><?= $commandeItem['code'] ?></b></h2>
                                                <br/>
                                                <h2>Table : <b><?= $commandeItem['table'] ?></b></h2>
                                                <br/>
                                                <h2>Date : <b><?= $commandeItem['date'] ?></b></h2>
                                                <br/>
                                                <ul class="nav navbar-right panel_toolbox">

                                                </ul>
                                          </div>
                                        <div class="clearfix"></div>
                                      </div>
                                      <div class="x_content col-md-12 col-lg-12 table-responsive " >

                                        <table class="table-striped table table-condensed table-bordered">
                                          <thead>
                                              <tr style="background-color:#272626;color: #ffffff;">
                                              <th>#</th>
                                              <th style="width:10%;">Nom</th>
                                              <th>entier</th>
                                              <th>demie</th>
                                              <th>verre</th>
                                              <th>conso</th>
                                            </tr>
                                          </thead>
                                          <tbody>
                                           <?php  foreach ($commandeItem['produit'] as $produit) {  ?>
                                            <tr>
                                              <th scope="row" style="background-color:#272626;color: #ffffff;">#</th>
                                              <td style="width:10%;"><b><?= $produit['nom'] ?></b></td>
                                              <td><b><?= $produit['nb_bouteille'] ?></b></td>
                                              <td><b><?= $produit['nb_demi'] ?></b></td>
                                              <td><b><?= $produit['nb_verre'] ?></b></td>
                                              <td><b><?= $produit['nb_conso'] ?></b></td>
                                            </tr>
                                           <?php } ?>
                                          </tbody>
                                        </table>
                                      </div>
                                    </div>                            
                              </div>
                              <div class="col-xs-12 bottom">
                                  <div class="col-xs-12 col-sm-6 col-lg-12 emphasis text-center">
                                    <a data-toggle="modal" href="#modalAuthenticationdelete" class="btn btn-danger btn-sm"> Annuler<span class="glyphicon glyphicon-remove"></span> </a>
                                    <a data-toggle="modal" href="#modalAuthentication" class="btn btn-primary btn-sm" id="<?=$commandeItem['id_commande']?>"> Accepter<i class="fa fa-comments-o"></i> </a>
                                  </div>
                              </div>
                        </div>
                      </div>
<!--                      end block-->
                <?php /*echo '</div>';}$i++;if($i===3){$i=0;}*/ } ?>

                    </div>
                  </div>
                </div>
              </div>
            </div>
          
          </div>
        <?php Pjax::end()?>
    </div>
    
  
 <!--Order yet served en waitting billing-->  

 <div id="accepted" style="height:750px;display:none;">
     <?php Pjax::begin(['id' => 'notacceptsaveorder'])?>
          <div class="col-md-12 col-lg-12">

            <div class="row">
              <div class="col-md-12 col-lg-12">
                <div class="x_panel">
                  <div class="x_content">
                    <div class="">
<!--Order not yet served-->
                <?php foreach($commande_ as $commandeItem_){ ?>                       
<!--                      block-->
                      <div class="col-md-6  col-lg-4">
                        <div class="welle profile_view col-lg-12 col-md-12">                               
                              <div class="">
                                    <div class="panele_x col-md-12 col-lg-10">
                                      <div class="x_title">
                                          <div class="pull-left">
                                                <h2>Commande : <b><?= $commandeItem_['code'] ?></b></h2>
                                                <br/>
                                                <h2>Table : <b><?= $commandeItem_['table'] ?></b></h2>
                                                <br/>
                                                <h2>Date : <b><?= $commandeItem_['date'] ?></b></h2>
                                                <br/>
                                          </div>
                                        <ul class="nav navbar-right panel_toolbox">
                                          
                                         
                                        </ul>
                                        <div class="clearfix"></div>
                                      </div>
                                      <div class="x_content col-md-12 col-lg-12 table-responsive" >

                                        <table class="table-striped table table-condensed table-bordered table-hover">
                                          <thead>
                                              <tr style="background-color:#272626;color: #ffffff;">
                                              <th>#</th>
                                              <th style="width:20%;">Nom</th>
                                              <th>entier</th>
                                              <th>demie</th>
                                              <th>verre</th>
                                              <th>conso</th>
                                            </tr>
                                          </thead>
                                          <tbody>
                                           <?php  foreach ($commandeItem_['produit'] as $produit_) {  ?>
                                            <tr>
                                              <th scope="row" style="background-color:#272626;color: #ffffff;">#</th>
                                              <td style="width:20%;"><b><?= $produit_['nom'] ?><b></td>
                                              <td><b><?= $produit_['nb_bouteille'] ?></b></td>
                                              <td><b><?= $produit_['nb_demi'] ?></b></td>
                                              <td><b><?= $produit_['nb_verre'] ?></b></td>
                                              <td><b><?= $produit_['nb_conso'] ?></b></td>
                                            </tr>
                                           <?php } ?>
                                          </tbody>
                                        </table>
                                      </div>
                                    </div>                            
                              </div>
                              <div class="col-xs-12 bottom">
                                  <div class="col-xs-12 col-sm-6 col-lg-12 emphasis text-center">
                                  <a data-toggle="modal" href="#modalAuthenticationdelete" class="btn btn-danger btn-sm"> Annuler<span class="glyphicon glyphicon-remove"></span> </a>
                                  <a data-toggle="modal" href="#modalAuthentication" class="btn btn-success btn-sm" id="<?= $commandeItem_['id_commande'] ?>"> print bill <span class="glyphicon glyphicon-print"></span> </a>
                                </div>
                             </div>
                        </div>
                      </div>
<!--                      end block-->
                <?php } ?>

<!--Order yet served en waitting billing-->
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
     <?php Pjax::end()?>
    </div>
 
<!--    start of Authenticate user code Modal-->
    <div class="modal fade modal-md" id="modalAuthentication" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="padding-top:200px;">
                <div class="modal-content modal-body">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h1 class="modal-title fontsize" style="color:black;">Code D'Authentification</h1>
                      </div>

                        <div class="container-fluid" >
                           <div class="row">
                                <center>
                                    <div class="" role="main">

                                        <div class="row">

                                            <div align="center" >
<!--                                                <h1 class="fontsize" style="color:black;"><?= Html::encode($this->title) ?></h1>-->
                        <!--                        <p class="alert alert-info"><strong>PLEASE FILL THE FORM BELOW TO LOGIN.</strong></p>-->
                                            </div> 

                                        </div>             
                                    </div>
                                </center>
                            </div>
                            <div class="container col-lg-5 col-lg-8">
                                <?php $form = ActiveForm::begin([
                                    'action' => 'index.php?r=order/accept-order/authenticate-serv',
                                    'enableAjaxValidation'=>true,
                                    'validationUrl' => 'index.php?r=order/accept-order/validate',
                                    'options'=>['id' => 'authenticationform',
                                                'class' => 'form-horizontal']
                                    ]);
                                ?>

                                    <div class = "form-group form-group-sm">
                                        <?= $form->field($model, 'code',['enableAjaxValidation'=>true])->textInput(['placeholder'=>'code de securite','autofocus' => true,'class'=>'form-control input-lg','id' => 'codeauth'])->label(FALSE) ?>
                                    </div>
                                    <div class = "">
                                        <?= $form->field($model, 'idauthentication')->hiddenInput(['id' => 'idorder','value'=>''])->label(FALSE) ?>
                                    </div>
                                    <div class="form-group form-group-sm" align="center">
                                        <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button','id'=>'idauthUser']) ?>
                                    </div>
                                    <div class="form-group form-group-sm" align="center" style="display:none;">
                                        <?= Html::resetButton('reset', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                                    </div>

                                <?php ActiveForm::end(); ?>
                            </div>
                        </div>
                        <div class="modal-footer">
                        </div>
                </div>
        </div>
    </div>
<!--end of Authenticate user code modal-->
<!--    start of Authenticate user code Modal-->
    <div class="modal fade modal-md" id="modalAuthenticationdelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="padding-top:200px;">
                <div class="modal-content modal-body">
                      <div class="modal-header">
                          <button id="idclose" type="button" class="close del1" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h1 class="modal-title fontsize" style="color:black;">Code D'Authentification</h1>
                      </div>

                        <div class="container-fluid" >
                           <div class="row">
                                <center>
                                    <div class="" role="main">

                                        <div class="row">

                                            <div align="center" >
<!--                                                <h1 class="fontsize" style="color:black;"><?= Html::encode($this->title) ?></h1>-->
                        <!--                        <p class="alert alert-info"><strong>PLEASE FILL THE FORM BELOW TO LOGIN.</strong></p>-->
                                            </div> 

                                        </div>             
                                    </div>
                                </center>
                            </div>
                            <div class="container col-lg-5 col-lg-8">
                                <?php $form = ActiveForm::begin([
                                    'action' => 'index.php?r=order/accept-order/delete-order',
                                    'enableAjaxValidation'=>true,
                                    'validationUrl' => 'index.php?r=order/accept-order/validate-delete',
                                    'options'=>['id' => 'authenticationformdelete',
                                                'class' => 'form-horizontal']
                                    ]);
                                ?>

                                    <div class = "form-group form-group-sm">
                                        <?= $form->field($modeldelete, 'code',['enableAjaxValidation'=>true])->textInput(['placeholder'=>'code de securite','autofocus' => true,'class'=>'form-control input-lg'])->label(FALSE) ?>
                                    </div>
                                    <div class = "">
                                        <?= $form->field($modeldelete, 'idauthentication')->hiddenInput(['id' => 'idorderdelete','value'=>''])->label(FALSE) ?>
                                    </div>
                                    <div class="form-group form-group-sm" align="center">
                                        <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button','id'=>'idauthUserdelete']) ?>
                                    </div>
                                    <div class="form-group form-group-sm" align="center" style="display:none;">
                                         <?= Html::resetButton('reset', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?> ?>
                                    </div>

                                <?php ActiveForm::end(); ?>
                            </div>
                        </div>
                        <div class="modal-footer">
                        </div>
                </div>
        </div>
    </div>
</div>

<!-- Appel Ajax de l'action accepter commande et rechargement de la page par pjax-->
<script>
// **************************************************************************************
// Authentication Ajax validation
// ****************************************************************************************
$(document).ready(function () {
$('body').on('beforeSubmit', 'form#authenticationform',function (e) {
          e.preventDefault();
          
            var form = $(this);
            
            if (form.find('.has-error').length)
            { 
                return false; 
            }
            $.ajax({
                url: $(this).attr( 'action' ),
                type: 'post',
                data: $(this).serialize(),
                success: function (response)
                {                           
                    $('div.modal-backdrop.fade.in').removeClass('modal-backdrop');
                    $.pjax.reload({container: '#acceptsaveorder'});
                    $('form#authenticationform').trigger('reset');
                    $('#modalAuthentication').modal('hide');
                },
                error: function ()
                { 
                 
                }
            });
            return false;
        });
    
// **************************************************************************************
// getting order with Ajax
// ****************************************************************************************
$(document).on('click', '.btn.btn-primary.btn-sm', function () {
         $('form#authenticationform').trigger('reset');
         document.getElementById('idorder').value = $(this).attr('id');
         
});
// **************************************************************************************
// Delete fron Ajax function
// ****************************************************************************************
$('body').on('beforeSubmit', 'form#authenticationformdelete',function (e) {
          e.preventDefault();
     
         var form = $(this);
           
            if (form.find('.has-error').length)
            { 
                return false; 
            }
            $.ajax({
                url: $(this).attr( 'action' ),
                type: 'post',
                data: $(this).serialize(),
                success: function (response)
                {             
                    $.pjax.reload({container: '#notacceptsaveorder'});
                    $.pjax.reload({container: '#acceptsaveorder'});
                    $('form#authenticationformdelete').trigger('reset');
                    $('#modalAuthenticationdelete').modal('hide');
                },
                error: function ()
                { 
                 
                }
            });
            return false;
        });         
});
// **************************************************************************************
// recharger la page automatiquement
// ****************************************************************************************

$(document).on('click', '.btn.btn-danger.btn-sm', function () {        
     $('form#authenticationformdelete').trigger('reset');
     document.getElementById('idorderdelete').value = $(this).next().attr('id');
});
// **************************************************************************************
// recharger la page automatiquement
// ****************************************************************************************

$(document).on('click', '.btn.btn-success.btn-sm', function () {    
     document.getElementById('idorder').value = $(this).attr('id');        
});
// **************************************************************************************
// recharger la page automatiquement
// ****************************************************************************************

$(document).on('click', '#commandaccepte', function () {   
     $.pjax.reload({container: '#notacceptsaveorder'});
     $("#notaccepted").css("display", "none");
     $("#accepted").css("display", "block");        
});
// **************************************************************************************
// recharger la page automatiquement
// ****************************************************************************************
$(document).on('click', '#commande', function () {   
     $.pjax.reload({container: '#acceptsaveorder'});
     $("#accepted").css("display", "none");
     $("#notaccepted").css("display", "block"); 
});
// **************************************************************************************
// recharger la page automatiquement
// ****************************************************************************************

function init(){
   loop();
}
function loop(){
   setTimeout('loop();',3000);
        $.ajax({
            type: "POST",
            url: "index.php?r=order/accept-order/is-order-add",
            success:function(data){
                if(data.isEmpty){
                    $.pjax.reload({container: '#acceptsaveorder'});
                }
            }
        });
}
init();
</script>

<?php
$this->registerCss(" "
        . "div .right_col{margin-bottom:-120px}"
        . ".footer{margin-left:210px;margin-right:14px}"
        . ".col-lg-5{border: 2px #777777 double;border-radius: 15px;background-color: black ;padding-top:10px;opacity:0.9;}"
        . ".site-login{height: 60em;background-image:url('uploads/seinovaLogo.png');background-repeat: no-repeat;background-position: center;background-size: 80%}"
        . ".alert{width:51%;margin-left:8%;margin-right:3%}"
        . "#fenetre{background-color:black;opacity:0.6;height: 1000px;position:absolute;z-index:3000;margin-top:2000%}"
        .".modal-body {position: relative;overflow-y: auto;max-height: 410px;}"
        .".backcolor{background-color:black;}"
        .".colorgrey{background-color:#2A3F54;}"
        .".welle{min-height: 20px;padding: 3px;margin-bottom: 17px;background-color: #272626;border: 1px solid #e3e3e3;border-radius: 4px;-webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .05);box-shadow: inset 0 1px 1px rgba(0, 0, 0, .05);}"
        .".panele_x{position: relative;width: 100%;margin-bottom: 10px;padding: 6px 4px;display: inline-block;background: #fff;border: 1px solid #E6E9ED;-webkit-column-break-inside: avoid;-moz-column-break-inside: avoid;column-break-inside: avoid;opacity: 1;-moz-transition: all .2s ease;-o-transition: all .2s ease;-webkit-transition: all .2s ease;-ms-transition: all .2s ease;transition: all .2s ease;}"
        ."@media (min-width: 1200px) {.heightdesktop {margin-top:1%;}}"
        ."@media (min-width: 992px) {.heightdesktop {margin-top:4%;}}"
        .".del1{color:grey;}}"
);
 ?>     

