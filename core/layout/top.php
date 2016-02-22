<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Área administrativa</title>
        <!-- Bootstrap Core CSS -->
        <link href="./sbadmin/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- MetisMenu CSS -->
        <link href="./sbadmin/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">
        <!-- Custom CSS -->
        <link href="./sbadmin/dist/css/sb-admin-2.css" rel="stylesheet">
        <link href="./sbadmin/bower_components/morrisjs/morris.css" rel="stylesheet">
        <!-- Custom Fonts -->
        <link href="./sbadmin/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link href="./media/css/site.css" rel="stylesheet" type="text/css">
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <div id="wrapper">
            <!-- Navigation -->
            <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Ativar navegação</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="./">Frete Agora - Área administrativa</a>                    
                </div>
                <!-- /.navbar-header -->

                <ul class="nav navbar-top-links navbar-right">
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li>
                                <a>Olá, <?= explode(" ", $_SESSION["uname"])[0]; ?>!</a>
                            </li>
                            </li>
                            <li class="divider"></li>
                            <li><a href="?destroy=true"><i class="fa fa-sign-out fa-fw"></i> Sair</a>
                            </li>
                        </ul>
                        <!-- /.dropdown-user -->
                    </li>
                    <!-- /.dropdown -->
                </ul>
                <!-- /.navbar-top-links -->

                <div class="navbar-default sidebar" role="navigation">
                    <div class="sidebar-nav navbar-collapse">
                        <ul class="nav" id="side-menu">
                            <li>
                                <a href="./index.php"><i class="fa fa-dashboard fa-fw"></i> Página inicial</a>
                            </li>
                            <li>
                                <a href="#pages"><i class="glyphicon glyphicon-picture fa-fw"></i> Banners<i class="fa arrow"></i></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="?module=banners&action=insert">Adicionar novo banner</a>
                                    </li>
                                    <li>
                                        <a href="?module=banners&action=manage">Gerenciar banners</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="#pages"><i class="glyphicon glyphicon-duplicate fa-fw"></i> Textos fixos<i class="fa arrow"></i></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="?module=texts&action=insert">Adicionar novo texto</a>
                                    </li>
                                    <li>
                                        <a href="?module=texts&action=manage">Gerenciar textos</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="#clients"><i class="fa fa-truck fa-fw"></i> Clientes<i class="fa arrow"></i></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="?module=orders&action=manage">Ver pedidos</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="#users"><i class="fa fa-users fa-fw"></i> Usuários<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="?module=users&action=manage">Gerenciar usuários</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        <div id="credits">
                            <p class="monospace-font" style="font-size: 14px">powered by duckie</p>
                            <p>Desenvolvido por <a target="_blank" href="http://motioncrazy.github.io">Francisco Júnior</a> e <a target="_blank" href="https://www.facebook.com/yan.ferreira.92">Yan Fernandes</a>.</p>
                        </div>
                    </div>
                    <!-- /.sidebar-collapse -->
                </div>
                <!-- /.navbar-static-side -->
            </nav>

            <!-- Page Content -->
            <div id="page-wrapper">