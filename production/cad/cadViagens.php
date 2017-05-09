<?php
    require_once ('../../../includes/OracleCielo.class.php');

    $oraCielo   = new OracleCielo ();
    $conexao    = $oraCielo->getCon();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Help Track | Gestor de Viagens </title>
    <link rel="icon" href="../images/imagens/16x16/veiculo.png">

    <!-- Bootstrap -->
    <link href="../../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="../../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- bootstrap-progressbar -->
    <link href="../../vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="../../vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="../../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    <!-- jQuery -->
    <script src="../../vendors/jquery/dist/jquery.min.js"></script>
    <!-- DataTables CSS -->
    <link href="../../vendors/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet" />
    <!-- DataTables Responsive CSS -->
    <link href="../../vendors/datatables-responsive/dataTables.responsive.css" rel="stylesheet" />
    <!-- DataTables JavaScript -->
    <script src="../../vendors/datatables/js/jquery.dataTables.min.js"></script>
    <script src="../../vendors/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="../../vendors/datatables-responsive/dataTables.responsive.js"></script>
    <!-- Custom Theme Style -->
    <link href="../../build/css/custom.min.css" rel="stylesheet">
    <!-- PNotify -->
    <link href="../../vendors/pnotify/dist/pnotify.css" rel="stylesheet">
    <link href="../../vendors/pnotify/dist/pnotify.buttons.css" rel="stylesheet">
    <link href="../../vendors/pnotify/dist/pnotify.nonblock.css" rel="stylesheet">

</head>

<body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="../index.html" class="site_title"><span>Help Track</span></a>
            </div>

            <div class="clearfix"></div>

            <!--=====================================================================================================-->
            <!-- BEM VINDO -->
            <!--=====================================================================================================-->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="../images/perfil.jpg" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Bem vindo,</span>
                <h2>Bruno Souza</h2>
              </div>
            </div>

            <!--=====================================================================================================-->
            <!-- MENU LATERAL -->
            <!--=====================================================================================================-->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-bar-chart"></i> Opera&ccedil;&atilde;o <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="../dashboard.html">Dashboard</a></li>
                      <li><a href="#">Mapa</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-cogs"></i> Manuten&ccedil;&atilde;o <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="#">Condutores</a></li>
                      <li><a href="#">Ve&iacute;culos</a></li>
                      <li><a href="../tables/tableViagens.html">Viagens</a></li>
                    </ul>
                  </li>
                </ul>
              </div>
            </div>
            <!--=====================================================================================================-->
            <!-- FIM MENU LATERAL -->
            <!--=====================================================================================================-->

          </div>
        </div>

        <!--=========================================================================================================-->
        <!-- BUTTON TOP DASHBOARD -->
        <!--=========================================================================================================-->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    Sistema
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="#"> Seu Perfil</a></li>
                    <li>
                      <a href="#">
                        <!--<span class="badge bg-red pull-right">50%</span>-->
                        <span>Configura&ccedil;&otilde;es</span>
                      </a>
                    </li>
                    <li><a href="#">Ajuda</a></li>
                    <li><a href="#"><i class="fa fa-sign-out pull-right"></i> Sair</a></li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>

        <!--=========================================================================================================-->
        <!-- DASHBOARD -->
        <!--=========================================================================================================-->
        <div class="right_col" role="main">
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="dashboard_graph">

                <div class="row x_title">
                  <div class="col-md-6">
                    <h3>Cadastro de Viagens</h3>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                      <div class="x_title">
                        <h2> Dados Gerais</h2>

                        <div class="clearfix"></div>
                      </div>
                      <div class="x_content">
                        <br/>
                        <form id="idFormCadViagem" data-parsley-validate class="form-horizontal form-label-left"  novalidate>

                          <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="descricaoViagem">Descri&ccedil;&atilde;o <span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <input type="text" id="descricaoViagem" class="form-control col-md-7 col-xs-12" name="descricaoViagem" data-validate-length-range="1,60" required="required" type="text" placeholder="Informe uma descri&ccedil;&atilde;o para a viagem">
                            </div>
                          </div>

                          <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Ve&iacute;culo <span class="required">*</span></label>

                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <select class="form-control" id="idComboVeiculo">
                                <?
                                $sqlVeiculos = "SELECT * FROM help_track_veiculo WHERE codigo_veiculo NOT IN (SELECT veiculo FROM HELP_TRACK_VIAGEM WHERE veiculo IS NOT NULL)";
                                $respostaVeiculos = oci_parse ($conexao, $sqlVeiculos);
                                oci_execute($respostaVeiculos);
                                while (($rowVeiculo = oci_fetch_assoc($respostaVeiculos)) != false) {
                                ?>
                                    <option value="<?=$rowVeiculo['CODIGO_VEICULO']?>"><?=$rowVeiculo['PLACA'].' - '.$rowVeiculo['FROTA']?></option>
                                <? } ?>
                              </select>
                            </div>
                          </div>

                          <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Ponto Inicial <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <select class="form-control" id="idComboReferenciaIni">
                                  <?
                                  $sqlReferenciaIni = "SELECT * FROM help_track_referencia";
                                  $respostaReferenciaIni = oci_parse ($conexao, $sqlReferenciaIni);
                                  oci_execute($respostaReferenciaIni);
                                  while (($rowReferenciaIni  = oci_fetch_assoc($respostaReferenciaIni)) != false) {
                                  ?>
                                      <option value="<?=$rowReferenciaIni['CODIGO_REFERENCIA']?>"><?=$rowReferenciaIni['DESCRICAO']?></option>
                                  <? } ?>
                              </select>
                            </div>
                          </div>

                          <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Ponto Final <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <select class="form-control" id="idComboReferenciaFim">
                                  <?
                                  $sqlReferenciaFim = "SELECT * FROM help_track_referencia";
                                  $respostaReferenciaFim = oci_parse ($conexao, $sqlReferenciaFim);
                                  oci_execute($respostaReferenciaFim);
                                  while (($rowReferenciaFim = oci_fetch_assoc($respostaReferenciaFim)) != false) {
                                  ?>
                                      <option value="<?=$rowReferenciaFim['CODIGO_REFERENCIA']?>"><?=$rowReferenciaFim['DESCRICAO']?></option>
                                  <? } ?>
                              </select>
                            </div>
                          </div>

                          <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" > Previs&atilde;o de In&iacute;cio e Fim <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <form class="form-horizontal">
                                <fieldset>
                                  <div class="control-group">
                                    <div class="controls">
                                      <div class="input-prepend input-group">
                                        <span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
                                          <input type="text" name="reservation-time" id="reservation-time" class="form-control col-md-7 col-xs-12" required="required" data-ad-format="DD/MM/YYYY HH:mm"/>
                                      </div>
                                    </div>
                                  </div>
                                </fieldset>
                              </form>
                            </div>
                          </div>

                          <div class="ln_solid"></div>

                          <div class="item form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                              <button class="btn btn-danger" id="buttonCancelar" type="button">Voltar</button>
                              <button type="submit" id="buttonSalvar" disabled="true" class="btn btn-success">Salvar</button>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="clearfix"></div>
              </div>
            </div>
          </div>
          <br>
        </div>
        <!--=========================================================================================================-->
        <!-- FIM DASHBOARD -->
        <!--=========================================================================================================-->

      </div>
    </div>

    <script type="text/javascript">

        $ (document).ready (function () {

            //Disable button salvar
            $('input[type="text"]').keyup(function() {
                if($(this).val() != '') {
                    $(':input[type="submit"]').prop('disabled', false);
                }else{
                    $(':input[type="submit"]').prop('disabled', true);
                }
            });

            //Formatando a data da viagem
            $(function() {
                $('input[name="reservation-time"]').daterangepicker({
                    timePicker: true,
                    locale: {
                        format: 'DD/MM/YYYY HH:mm'
                    }
                });
            });

            //Funcao cancelar o cadastro de viagem
            $('#buttonCancelar').click(function(){
                window.location.href = "../tables/tableViagens.html";
            });

            //Funcao para envio dos dados de viagem
            $('#buttonSalvar').click(function(){
                $(this).html("Aguarde...");
                var descricaoViagem,
                    codVeiculo,
                    codReferenciaIni,
                    codReferenciaFim,
                    previsaoViagem;

                descricaoViagem     = $ ('#descricaoViagem').val();
                codVeiculo          = $ ('#idComboVeiculo').val();
                codReferenciaIni    = $ ('#idComboReferenciaIni').val();
                codReferenciaFim    = $ ('#idComboReferenciaFim').val();
                previsaoViagem      = $ ('#reservation-time').val();

                $.ajax({
                    type: 'POST',
                    url: '../exec/execViagem.php',
                    data: {
                        acao: 'novaViagem',
                        descricaoViagem: descricaoViagem,
                        codVeiculo: codVeiculo,
                        codReferenciaIni: codReferenciaIni,
                        codReferenciaFim: codReferenciaFim,
                        previsao: previsaoViagem
                    },
                    success: function(data) {
                        if(data != 'null'){
                            new PNotify({
                                title: 'Ops! ',
                                text: 'Contate a equipe de suporte Help Track: <br>'+data,
                                type: 'error',
                                styling: 'bootstrap3'
                            });
                        }else{
                            new PNotify({
                                title: 'Sucesso! ',
                                text: 'Viagem cadastrada.',
                                type: 'success',
                                styling: 'bootstrap3'
                            });
                            $('#idFormCadViagem').trigger("reset");
                            $('#reservation-time').val('01/01/2017 12:00 - 01/01/2017 12:00');
                        }
                    },
                    error: function () {
                        new PNotify({
                            title: 'Ops! ',
                            text: 'Houve algum problema com a sua comunica&ccedil;&atilde;o. Tente novamente',
                            type: 'error',
                            styling: 'bootstrap3'
                        });
                    }
                });
                $(this).html("Salvar");
                $(':input[type="submit"]').prop('disabled', true);
            });
        });
    </script>
    <!-- Bootstrap -->
    <script src="../../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="../../vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="../../vendors/nprogress/nprogress.js"></script>
    <!-- Chart.js -->
    <script src="../../vendors/Chart.js/dist/Chart.min.js"></script>
    <!-- gauge.js -->
    <script src="../../vendors/gauge.js/dist/gauge.min.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="../../vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="../../vendors/iCheck/icheck.min.js"></script>
    <!-- Skycons -->
    <script src="../../vendors/skycons/skycons.js"></script>
    <!-- Flot -->
    <script src="../../vendors/Flot/jquery.flot.js"></script>
    <script src="../../vendors/Flot/jquery.flot.pie.js"></script>
    <script src="../../vendors/Flot/jquery.flot.time.js"></script>
    <script src="../../vendors/Flot/jquery.flot.stack.js"></script>
    <script src="../../vendors/Flot/jquery.flot.resize.js"></script>
    <!-- Flot plugins -->
    <script src="../../vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
    <script src="../../vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
    <script src="../../vendors/flot.curvedlines/curvedLines.js"></script>
    <!-- DateJS -->
    <script src="../../vendors/DateJS/build/date.js"></script>
    <!-- JQVMap -->
    <script src="../../vendors/jqvmap/dist/jquery.vmap.js"></script>
    <script src="../../vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    <script src="../../vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="../../vendors/moment/min/moment.min.js"></script>
    <script src="../../vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="../../build/js/custom.min.js"></script>
    <!-- validator -->
    <script src="../../vendors/validator/validator.js"></script>
    <!-- PNotify -->
    <script src="../../vendors/pnotify/dist/pnotify.js"></script>
    <script src="../../vendors/pnotify/dist/pnotify.buttons.js"></script>
    <script src="../../vendors/pnotify/dist/pnotify.nonblock.js"></script>
</body>
</html>


