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
                          <li><a href="form.html">Condutores</a></li>
                          <li><a href="#">Pontos de Referência</a></li>
                          <li><a href="#">Veículos</a></li>
                          <li><a href="tables/tableViagens.html">Viagens</a></li>
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
                    <h3>Cadastro de Condutores</h3>
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
                        <form id="idFormCadCondutor" data-parsley-validate class="form-horizontal form-label-left"  novalidate>

                             <div class="item form-group">
                               <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nome">Nome <span class="required">*</span></label>
                               <div class="col-md-6 col-sm-6 col-xs-12">
                                 <input type="text" id="nome" class="form-control col-md-7 col-xs-12" name="nome" data-validate-length-range="3,60" required="required" type="text" placeholder="">
                               </div>
                             </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="matricula">Matricula </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="matricula" class="form-control col-md-7 col-xs-12" name="matricula" data-validate-length-range="1,60" type="text" placeholder="(Opcional)">
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
                if($('#nome').val() == '' || $('#nome').val() == null){
                    $(':input[type="submit"]').prop('disabled', true);
                }else{
                    $(':input[type="submit"]').prop('disabled', false);
                }
            });

            //Formatando a data da viagem
//            $(function() {
//                $('input[name="reservation-time"]').daterangepicker({
//                    timePicker: true,
//                    locale: {
//                        format: 'DD/MM/YYYY HH:mm'
//                    }
//                });
//            });

            //Funcao cancelar o cadastro de viagem
            $('#buttonCancelar').click(function(){
                window.location.href = "../tables/tableCondutores.html";
            });

            //Funcao para envio dos dados de viagem
            $('#buttonSalvar').click(function(){

//                if($('#idComboReferenciaIni').val() == $ ('#idComboReferenciaFim').val()){
//                    new PNotify({
//                        title: 'Ops! ',
//                        text: 'Os pontos de inicio e fim devem ser diferentes.',
//                        type: 'error',
//                        styling: 'bootstrap3'
//                    });
//                    return;
//                }
//
//                if($('#descricaoViagem').val() == '' || $('#descricaoViagem').val() == null){
//                    new PNotify({
//                        title: 'Ops! ',
//                        text: "Voc&ecirc; deve preencher o campo 'Descri&ccedil;&atilde;o!'",
//                        type: 'error',
//                        styling: 'bootstrap3'
//                    });
//                    return;
//                }

                $(this).html("Aguarde...");

//                var descricaoViagem,
//                    codVeiculo,
//                    codReferenciaIni,
//                    codReferenciaFim,
//                    previsaoViagem;

//                descricaoViagem     = $ ('#descricaoViagem').val();
//                codVeiculo          = $ ('#idComboVeiculo').val();
//                codReferenciaIni    = $ ('#idComboReferenciaIni').val();
//                codReferenciaFim    = $ ('#idComboReferenciaFim').val();
//                previsaoViagem      = $ ('#reservation-time').val();

                $.ajax({
                    type: 'POST',
                    url: '../exec/execCondutor.php',
                    data: {
                        acao: 'novoCondutor',
                        nome: $('#nome').val(),
                        matricula: $('#matricula').val()
                    },
                    success: function(data) {
                        if(data != ''){
                            new PNotify({
                                title: 'Ops! ',
                                text: 'Contate a equipe de suporte Help Track: <br>'+data,
                                type: 'error',
                                styling: 'bootstrap3'
                            });
                        }else{
                            new PNotify({
                                title: 'Sucesso! ',
                                text: 'Condutor cadastrado!',
                                type: 'success',
                                styling: 'bootstrap3'
                            });
                            $('#idFormCadCondutor').trigger("reset");
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


