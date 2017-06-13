<?php
require_once ('../../includes/OracleCielo.class.php');

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
    <link rel="icon" href="images/imagens/16x16/veiculo.png">

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">

    <!-- bootstrap-progressbar -->
    <link href="../vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="../vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- jQuery -->
    <script src="../vendors/jquery/dist/jquery.min.js"></script>

    <!-- DataTables CSS -->
    <link href="../vendors/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet" />
    <!-- DataTables Responsive CSS -->
    <link href="../vendors/datatables-responsive/dataTables.responsive.css" rel="stylesheet" />

    <!-- DataTables JavaScript -->
    <script src="../vendors/datatables/js/jquery.dataTables.min.js"></script>
    <script src="../vendors/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="../vendors/datatables-responsive/dataTables.responsive.js"></script>

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
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

                <!-- BEM VINDO -->
                <div class="profile clearfix">
                    <div class="profile_pic">
                        <img src="images/perfil.jpg" alt="..." class="img-circle profile_img">
                    </div>
                    <div class="profile_info">
                        <span>Bem vindo,</span>
                        <h2>Bruno Souza</h2>
                    </div>
                </div>

                <!-- MENU LATERAL -->
                <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                    <div class="menu_section">
                        <ul class="nav side-menu">
                            <li><a><i class="fa fa-bar-chart"></i> Opera&ccedil;&atilde;o <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="dashboard.php">Dashboard</a></li>
                                    <li><a href="mapa/viagens.php">Mapa</a></li>
                                </ul>
                            </li>
                            <li><a><i class="fa fa-cogs"></i> Manuten&ccedil;&atilde;o <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="tables/tableCondutores.html">Condutores</a></li>
                                    <li><a href="#">Pontos de Refer&ecirc;ncia</a></li>
                                    <li><a href="#">Ve&iacute;culo</a></li>
                                    <li><a href="tables/tableViagens.html">Viagens</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>

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

        <!--=====================================================================================================-->
        <!--DIV PRINCIPAL-->
        <!--=====================================================================================================-->
        <div class="right_col" role="main">

            <div class="title_left">
                <h3>Totalizador</h3>
            </div>
            <div class="row tile_count">
                <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                    <span class="count_top"><i class="fa fa-road"></i><a href="tables/tableViagens.html?param=todas"> Viagens</a> </span>
                    <div class="count" id="totalViagens">0</div>
                </div>
                <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                    <span class="count_top"><i class="fa fa-exclamation-triangle"></i> <a href="tables/tableViagens.html?param=atrasadas">Atrasados </a></span>
                    <div class="count" style="color: crimson" id="totalAtrasados">0</div>
                </div>
                <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                    <span class="count_top"><i class="fa fa-check"></i> <a href="tables/tableViagens.html?param=prazo">No prazo </a></span>
                    <div class="count" style="color: #00A000" id="totalNoPrazo">0</div>
                </div>
                <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                    <span class="count_top"><i class="fa fa-exclamation-triangle"></i> <a href="tables/tableViagens.html?param=aguardando">Aguardando In&iacute;cio </a></span>
                    <div class="count" style="color: #faa400" id="totalAgurdandoInicio">0</div>
                </div>
                <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                    <span class="count_top"><i class="fa fa-automobile"></i><a href="#"> Ve&iacute;culo</a></span>
                    <div class="count" id="totalVeiculos">0</div>
                </div>
                <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                    <span class="count_top"><i class="fa fa-user"></i><a href="tables/tableCondutores.html"> Condutores</a></span>
                    <div class="count" id="totalCondutores">0</div>
                </div>
            </div>

            <div id="divEsqueda">
                <div class="title_left">
                    <h3>Finalizados Hoje</h3>
                </div>
                <div class="row tile_count">
                    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                        <span class="count_top"><i class="fa fa-road"></i><a href="tables/tableViagens.html?param=todasHoje"> Viagens</a></span>
                        <div class="count" id="totalViagensDia">0</div>
                    </div>
                    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                        <span class="count_top"><i class="fa fa-exclamation-triangle"></i> <a href="tables/tableViagens.html?param=atrasosHoje">Atrasos </a></span>
                        <div class="count" style="color: crimson" id="totalAtrasosDia">0</div>
                    </div>
                    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                        <span class="count_top"><i class="fa fa-check"></i> <a href="tables/tableViagens.html?param=prazoHoje">No Prazo </a></span>
                        <div class="count" style="color: #00A000" id="totalPrazoDia">0</div>
                    </div>
                </div>
            </div>

            <div id="divDireita">
                <div class="title_left">
                    <h3>Acontecendo Agora</h3>
                </div>
                <div class="row tile_count">
                    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                        <span class="count_top"><i class="fa fa-road"></i><a href="tables/tableViagens.html?param=viagensAgora"> Viagens</a></span>
                        <div class="count" id="totalViagensAgora">0</div>
                    </div>
                    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                        <span class="count_top"><i class="fa fa-exclamation-triangle"></i> <a href="tables/tableViagens.html?param=atrasadasAgora">Atrasada</a></span>
                        <div class="count" style="color: crimson" id="totalAtrasosAgora">0</div>
                    </div>
                    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                        <span class="count_top"><i class="fa fa-check"></i> <a href="tables/tableViagens.html?param=prazoAgora">Dentro do Prazo </a></span>
                        <div class="count" style="color: #00A000" id="totalPrazoAgora">0</div>
                    </div>
                    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                        <span class="count_top"><i class="fa fa-exclamation-triangle"></i> <a href="tables/tableViagens.html?param=podeAtrasarAgora">Pode Atrasar </a></span>
                        <div class="count" style="color: #faa400" id="totalPodeAtrasarAgora">0</div>
                    </div>
                </div>
            </div>

            <!--=====================================================================================================-->
            <!--GRAFICO DE ATRASOS E RANKING-->
            <!--=====================================================================================================-->
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="dashboard_graph">

                        <!--ATRASOS-->
                        <div class="row x_title">
                            <div class="col-md-6">
                                <h3>Atrasos</h3>
                            </div>
                        </div>

                        <!--GRAFICO DE ATRASOS DIARIOS-->
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <div id="chart_plot_01" class="demo-placeholder"></div>
                        </div>

                        <!--INICIO RANKING DE CONDUTORES-->
                        <div class="col-md-3 col-sm-3 col-xs-12 bg-white">
                            <br>
                            <div class="x_title">
                                <i class="fa fa-trophy"></i> <a href="tables/tableCondutores.html">Ranking de Condutores</a>
                            </div>

                            <div class="col-md-12 col-sm-12 col-xs-6">
                                <?
                                $sqlRanking = "
                                    SELECT  * from (
                                      SELECT * FROM HELP_TRACK_CONDUTOR ORDER BY TOTAL_ATRASOS ASC
                                    ) WHERE rownum >= 1 and rownum <= 3";

                                $respostaVeiculos = oci_parse ($conexao, $sqlRanking);

                                oci_execute($respostaVeiculos);
                                while (($rowVeiculo = oci_fetch_assoc($respostaVeiculos)) != false) {

                                    ?>
                                    <div>
                                        <p><?=$rowVeiculo['NOME']?></p>
                                        <p><?=$rowVeiculo['TOTAL_ATRASOS']?> Atrasos no total</p>
                                        <div class="">
                                            <div class="progress progress_sm" style="width: 90%;">
                                                <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="<?=$rowVeiculo['TOTAL_ATRASOS']*10?>"></div>
                                            </div>
                                        </div>
                                    </div>
                                <?
                                    $count++;
                                } ?>
<!--                                <div>-->
<!--                                    <p>1º</p>-->
<!--                                    <p>Ademir Rosa - 04 Atrasos no total</p>-->
<!--                                    <div class="">-->
<!--                                        <div class="progress progress_sm" style="width: 90%;">-->
<!--                                            <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="4"></div>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                                <div>-->
<!--                                    <p>2º</p>-->
<!--                                    <p>Jeferson Marques - 35 Atrasos no total</p>-->
<!--                                    <div class="">-->
<!--                                        <div class="progress progress_sm" style="width: 90%;">-->
<!--                                            <div class="progress-bar bg-blue" role="progressbar" data-transitiongoal=35></div>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="col-md-12 col-sm-12 col-xs-6">-->
<!--                                <div>-->
<!--                                    <p>3º</p>-->
<!--                                    <p>Carlos Alberto - 55 Atrasos no total</p>-->
<!--                                    <div class="">-->
<!--                                        <div class="progress progress_sm" style="width: 90%;">-->
<!--                                            <div class="progress-bar bg-orange" role="progressbar" data-transitiongoal="55"></div>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                </div>-->
                            </div>
                        </div>
                        <!--FIM RANKING DE CONDUTORES-->

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <!-- FIM DOS ATRASOS E RANKING-->

            <br>

            <!--------------------------------------------------------------------------------------------- OCORRENCIAS-->
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="dashboard_graph">
                        <!--<div class="row x_title">-->
                        <!--<div class="col-md-6">-->
                        <!--&lt;!&ndash;<h3>Ocorrências</h3>&ndash;&gt;-->
                        <!--</div>-->
                        <!--</div>-->
                        <div class="row x_title">
                            <div class="col-md-6">
                                <h3>Registro de Atividade</h3>
                            </div>
                        </div>
                        <!--GRID DE OCORRENCIAS-->
                        <div class="x_panel">

                            <div class="x_content">

                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Descri&ccedil;&atilde;o</th>
                                        <th>Data</th>
                                        <th>Usuario</th>
                                        <th>Viagem</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?
                                    $sqlVeiculos = " 
                                      SELECT  CODIGO_REGISTRO, DESCRICAO, TO_CHAR(DATA_HORA, 'DD/MM/YYYY HH24:MI:SS') AS DATA_HORA, USUARIO, VIAGEM from (
                                        SELECT  *
                                        FROM    HELP_TRACK_REGISTROS r 
                                        ORDER BY data_hora desc
                                      ) WHERE rownum >= 1 and rownum <= 10";
                                    $respostaVeiculos = oci_parse ($conexao, $sqlVeiculos);
                                    oci_execute($respostaVeiculos);
                                    while (($rowVeiculo = oci_fetch_assoc($respostaVeiculos)) != false) {
                                        ?>
                                        <tr>
                                            <td><?=$rowVeiculo['CODIGO_REGISTRO']?></td>
                                            <td><?=$rowVeiculo['DESCRICAO']?></td>
                                            <td><?=$rowVeiculo['DATA_HORA']?></td>
                                            <td><?=$rowVeiculo['USUARIO']?></td>
                                            <td><?=$rowVeiculo['VIAGEM']?></td>
                                        </tr>
                                    <? } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="dashboard_graph">
                        <div class="row x_title">
                            <div class="col-md-6">
                                <h3>Total de Atrasos por Condutor</h3>
                            </div>
                        </div>
                        <!--FIM DO GRID DE OCORRENCIAS-->

                        <!--INICIO DO CHART DE OCORRENCIAS POR CONDUTOR-->
                        <div class="x_panel">

                            <div class="x_content">
                                <canvas id="pieChart"></canvas>
                            </div>
                        </div>
                        <!--FIM DO CHART DE OCORRENCIAS POR CONDUTOR-->
                    </div>
                </div>
            </div>
            <br>
        </div>

    </div>
</div>

<script type="text/javascript">
    $ (document).ready (function () {

        var params = {
            idEmpresa: 64247
        };

        $.getJSON ('json/jsonDashboard.php', params, function (json1) {
            $ ('#totalCondutores').html (json1.totalCondutores['TOTAL_CONDUTORES']);
            $ ('#totalVeiculos').html (json1.totalVeiculos['TOTAL_VEICULOS']);
            $ ('#totalViagens').html (json1.totalViagens['TOTAL_VIAGENS']);
            $ ('#totalAtrasados').html (json1.totalAtrasados['TOTAL_ATRASADOS']);
            $ ('#totalNoPrazo').html (json1.totalNoPrazo['TOTAL_NO_PRAZO']);
            $ ('#totalViagensDia').html (json1.totalViagensDia['TOTAL_VIAGENS_DIA']);
            $ ('#totalAtrasosDia').html (json1.totalAtrasosDia['TOTAL_ATRASOS_DIA']);
            $ ('#totalPrazoDia').html (json1.totalPrazoDia['TOTAL_PRAZO_DIA']);
            $ ('#totalAgurdandoInicio').html (json1.totalAguardando['TOTAL_AGUARDANDO']);
            $ ('#totalViagensAgora').html (json1.totalViagensAgora['TOTAL_VIAGENS_AGORA']);
            $ ('#totalAtrasosAgora').html (json1.totalAtrasosAgora['TOTAL_ATRASOS_AGORA']);
            $ ('#totalPrazoAgora').html (json1.totalPrazoAgora['TOTAL_PRAZO_AGORA']);
            $ ('#totalPodeAtrasarAgora').html (json1.totalPodeAtrasarAgora['TOTAL_PODEATRASAR_AGORA']);
        });
    });
</script>

<!-- Bootstrap -->
<script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="../vendors/fastclick/lib/fastclick.js"></script>
<!-- NProgress -->
<script src="../vendors/nprogress/nprogress.js"></script>
<!-- Chart.js -->
<script src="../vendors/Chart.js/dist/Chart.min.js"></script>
<!-- gauge.js -->
<script src="../vendors/gauge.js/dist/gauge.min.js"></script>
<!-- bootstrap-progressbar -->
<script src="../vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
<!-- iCheck -->
<script src="../vendors/iCheck/icheck.min.js"></script>
<!-- Skycons -->
<script src="../vendors/skycons/skycons.js"></script>
<!-- Flot -->
<script src="../vendors/Flot/jquery.flot.js"></script>
<script src="../vendors/Flot/jquery.flot.pie.js"></script>
<script src="../vendors/Flot/jquery.flot.time.js"></script>
<script src="../vendors/Flot/jquery.flot.stack.js"></script>
<script src="../vendors/Flot/jquery.flot.resize.js"></script>
<!-- Flot plugins -->
<script src="../vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
<script src="../vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
<script src="../vendors/flot.curvedlines/curvedLines.js"></script>
<!-- DateJS -->
<script src="../vendors/DateJS/build/date.js"></script>
<!-- JQVMap -->
<script src="../vendors/jqvmap/dist/jquery.vmap.js"></script>
<script src="../vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
<script src="../vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
<!-- bootstrap-daterangepicker -->
<script src="../vendors/moment/min/moment.min.js"></script>
<script src="../vendors/bootstrap-daterangepicker/daterangepicker.js"></script>

<!-- Custom Theme Scripts -->
<script src="../build/js/custom.min.js"></script>

</body>
</html>


