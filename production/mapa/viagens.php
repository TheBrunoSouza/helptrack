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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
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

    <!--Mapa Google-->
    <script src="../js/maps/markerclusterer.js"></script>
    <script src="../js/maps/markerwithlabel.js" async></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC0oFYKDpD5zmMsUZJkJfv8SKiEu3JJ_ZA" async defer></script>

    <!-- Custom Theme Style -->
    <link href="../../build/css/custom.min.css" rel="stylesheet">

    <style type="text/css">
        html, body, #map-canvas {
            margin: 0;
            padding: 0;
            height: 100%;
        }

        #map-canvas {
            width:860px;
            height:480px;
        }

        .labels {
            color: white;
            background-color: gray;
            font-family: "Lucida Grande", "Arial", sans-serif;
            font-size: 8px;
            text-align: center;
            width: 30px;
            white-space: nowrap;
        }

        .toolbar {
            float:left;
        }
    </style>

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
                        <img src="../images/perfil.jpg" alt="..." class="img-circle profile_img">
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
                            <li><a><i class="fa fa-bar-chart"></i> Operação <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="../dashboard.php">Dashboard</a></li>
                                    <li><a href="#">Mapa</a></li>
                                </ul>
                            </li>
                            <li><a><i class="fa fa-cogs"></i> Manutenção <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="../tables/tableCondutores.html">Condutores</a></li>
                                    <li><a href="#">Pontos de Referência</a></li>
                                    <li><a href="#">Veículos</a></li>
                                    <li><a href="tableViagens.html">Viagens</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>

        <!-- =========================================================================================================== -->
        <!-- NEVAGAÇÃO DO TOPO -->
        <!-- =========================================================================================================== -->
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

        <!-- =========================================================================================================== -->
        <!-- DIV PRINCIPAL -->
        <!-- =========================================================================================================== -->
        <div class="right_col" role="main">
            <div id="page-wrapper">
                <!-- Título da tela central -->
                <!-- 1 linha por 1 coluna -->
                <div class="row">
                    <div class="col-lg-12 col-xs-12">
                        <h1 class="page-header"> Mapa de viagens </h1>
                        <!-- esta tag mostra dinamicamente o total de veículos no mapa -->
                        <h4 id="total_veiculos"></h4>
                    </div>
                </div>

                <!-- Mapa com as viagens -->
                <!-- 1 linha por 10 colunas -->
                <div class="row">
                    <div class="col-lg-9 col-xs-9">
                        <div id="map-canvas" class=""></div>
                    </div>
                    <!-- Legenda do mapa -->
                    <!-- 1 linha por 2 colunas -->
                    <div class="col-lg-3 col-xs-3">
<!--                        <h4> Legenda: </h4>-->
                        <?php
                        if ($_REQUEST ["acao"] == "dashboard")
                        {
                            $checks = array ("", "checked", "", "", "", "checked", "", "", "", "");
                        }
                        else
                        {
                            $checks = array ("checked", "checked", "checked", "checked", "checked", "checked", "checked", "checked", "checked", "checked");
                        }
                        ?>
<!--                        <p> <input type="checkbox" onclick="oculta_markers ('1001')" --><?//=$checks[0]?><!-- /> <img src="../img/icones_mapa/veiculo_amarelo.png" /> Pode Atrasar </p>-->
<!--                        <p> <input type="checkbox" onclick="oculta_markers ('1000')" --><?//=$checks[1]?><!-- /> <img src="../img/icones_mapa/veiculo_amarelo_2.png" /> Atrasado </p>-->
<!--                        <p> <input type="checkbox" onclick="oculta_markers ('1003')" --><?//=$checks[2]?><!-- /> <img src="../img/icones_mapa/veiculo_azul.png" /> No Prazo </p>-->
                    </div>
                </div>
                <!-- Fim da tela principal -->
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">


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

<!-- Google Maps -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC0oFYKDpD5zmMsUZJkJfv8SKiEu3JJ_ZA"></script>
<script src="../js/maps/markerwithlabel.js" async></script> <!-- NÃO DESISTI DE COLOCAR UM CDN NELE -->

<!-- Overlapping Marker Spiderfier -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/OverlappingMarkerSpiderfier/1.0.3/oms.min.js"></script>

<!-- Custom Theme Scripts -->
<script src="../../build/js/custom.min.js"></script>
<script type="text/javascript">
    map = new google.maps.Map(document.getElementById('map-canvas'), {
        center: {
            lat: -22.397,
            lng: -44.644
        },
        zoom:4
    });

//    $('#codViagemFinalizarHidden').val(e.relatedTarget.dataset.viagem);
//    $('#descViagemFinalizarHidden').val(e.relatedTarget.dataset.descricao);

    var infowindow = new google.maps.InfoWindow();
    var marker;
    var line;
    var latLngOld = '';
    var image;
    var map, mapDetalhes;
    var infoWindow, infoWindowDetalhes;
    var marker, markerDetalhes;
    var markers = [];
    var markersRef = [];
    var markerCluster;
    var icon;
    var posicoesLatitude = [];
    var posicoesLongitude = [];
    var i = 0;
//    var data = {
//        codReferenciaIni: e.relatedTarget.dataset.refini,
//        codReferenciaFim: e.relatedTarget.dataset.reffim
//    };

    var posicaoFlag = "";
    var flag = 0;
    var aux = 'Partida';

    infoWindow = new google.maps.InfoWindow();

//    var dataRota = {
//        placa: e.relatedTarget.dataset.placa
//    };

    $.getJSON('../json/jsonRotaGeral.php', /*dataRota,*/ function (json1) {
//        console.info(json1);

        $.each(json1.viagens, function(key, data) {
            console.info(data);

            switch (data.status){
                case 1:
                    icon = 'ponto_atual';
                    break;
                case 2:
                    icon = 'ponto_inicial';
                    break;
                case 3:
                    icon = 'poiwait';
                    break;
            }
            image = {
                url: "../images/map/"+icon+".png",
                origin: new google.maps.Point(0, 0),
                anchor: new google.maps.Point(4, 4),
                scaledSize: new google.maps.Size(8, 8)
            };
//
            var latLng = new google.maps.LatLng(data.lat, data.lon);
//
            marker = new google.maps.Marker({
                center:     location,
                map:        map,
                position:   latLng,
                title:      data.veiculo,
                icon : '../images/map/ponto_atual.png'
            });
//
            var details =
                "<div data-placa='" + data.veiculo + "'>" +
                "<p><b>Veiculo</b> " + data.veiculo + "</p>" +
                "<p><b>Data Hora</b> " + data.data_hora + "</p>" +
                "<p><b>Lat</b>: " + data.lat + "</p>" +
                "<p><b>Lon</b>: " + data.lon + "</p>";
//
            bindInfoWindow(marker, map, infowindow, details);
//
            markers.push(marker);
//
//            //Ligando pontos
//            if(latLngOld != '') {
//                line = new google.maps.Polyline({
//                    path: [latLng, latLngOld],
//                    strokeOpacity: 2,
//                    strokeWeight: 2,
//                    strokeColor: '#5763ff',
//                    geodesic: true,
//                    map: map
//                });
//            }
            latLngOld = latLng;
//
//            //centraliza o mapa na última latitude e longitude pesquisada
            map.setCenter (latLng);
//
//            //Adiciona os pontos
            markers.push(marker);
        });

        //ULTIMO PONTO
        image = {
            url: '../images/map/ponto_atual.png',
            scaledSize: new google.maps.Size(35, 48)
        }
        marker.setIcon(image, marker);
    });

    function bindInfoWindow(marker, map, infowindow, strDescription) {
        google.maps.event.addListener(marker, 'click', function () {
            infowindow.setContent(strDescription);
            infowindow.open(map, marker);
        });
    }
</script>

</body>
</html>
