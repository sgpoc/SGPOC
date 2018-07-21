<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use kartik\sidenav\SideNav;
use yii\helpers\Url;
use rmrevin\yii\fontawesome\FA;


AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <?php $this->head() ?>
</head>
<body class="hold-transimition skin-blue fixed sidebar-mini">
<?php $this->beginBody() ?>
<div class="wrapper">
    <header class="main-header">
        <a href="../../index2.html" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>POC</b></span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>SGPOC</b></span>
        </a>
        <nav class="navbar navbar-static-top">
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button"></a>
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="" class="img-circle">
                            <span class="hidden-xs"><?= Yii::$app->user->identity['Nombre']?></span> 
                            <span class="hiddex-xs"><?= Yii::$app->user->identity['Apellido']?></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="user-header">
                                <img src="" class="img-circle"/>
                                <p>
                                    <span class="hidden-xs"><?= Yii::$app->user->identity['Nombre']?></span> 
                                    <span class="hiddex-xs"><?= Yii::$app->user->identity['Apellido']?></span>
                                    <small>Miembro desde Nov. 2012</small>
                                </p>
                            </li>
                            <li class="user-body">
                                <div class="col-xs4 text-center">
                                    <a href="/sgpoc/backend/web/site/login">Logout</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="">Contacto</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    
    <aside class="main-sidebar">
        <section class="sidebar">
            <ul class="sidebar-menu" data-widget="tree">
                <li class="header">Barra de Navegación</li>
                <li>
                    <a href="/sgpoc/backend/web/site/index">
                    <i class="fa fa-home"></i>
                        <span>Inicio</span>
                    </a>
                </li>
                <li>
                    <a href="/sgpoc/backend/web/familias/listar">
                        <i class="glyphicon glyphicon-th"></i>
                        <span>Familias</span>
                    </a>
                </li>
                <li>
                    <a href="/sgpoc/backend/web/familias/listar">
                        <i class="glyphicon glyphicon-list"></i>
                        <span>Tipos de Insumo</span>
                    </a>
                </li>
                <li>
                    <a href="/sgpoc/backend/web/familias/listar">
                        <i class="fa fa-wrench"></i>
                        <span>Insumos</span>
                    </a>
                </li>
                <li>
                    <a href="/sgpoc/backend/web/familias/listar">
                        <i class="fa fa-gear"></i>
                        <span>Items</span>
                    </a>
                </li>
                <li>
                    <a href="/sgpoc/backend/web/familias/listar">
                        <i class="fa fa-gears"></i>
                        <span>Elementos Constructivos</span>
                    </a>
                </li>
                <li>
                    <a href="/sgpoc/backend/web/familias/listar">
                        <i class="fa fa-book"></i>
                        <span>Computo Metrico</span>
                    </a>
                </li>
                <li>
                    <a href="/sgpoc/backend/web/familias/listar">
                        <i class="fa fa-dollar"></i>
                        <span>Presupuestos</span>
                    </a>
                </li>
                <li>
                    <a href="/sgpoc/backend/web/familias/listar">
                        <i class="fa fa-building"></i>
                        <span>Obras</span>
                    </a>
                </li>
                <li>
                    <a href="/sgpoc/backend/web/familias/listar">
                        <i class="fa fa-money"></i>
                        <span>Lista de Precios</span>
                    </a>
                </li>
                <li>
                    <a href="/sgpoc/backend/web/familias/listar">
                        <i class="fa fa-truck"></i>
                        <span>Proveedores</span>
                    </a>
                </li>
                <li>
                    <a href="/sgpoc/backend/web/usuarios/listar">
                    <i class="fa fa-user"></i>
                        <span>Usuarios</span>
                    </a>
                </li>
                <li>
                    <a href="/sgpoc/backend/web/grupos-trabajo/listar">
                        <i class="fa fa-graduation-cap"></i>
                        <span>Grupos Trabajo</span>
                    </a>
                </li>
            </ul>
        </section>
    </aside>
    
<div class="content-wrapper">
    

    <section class="content">
      <div class="callout callout-info">
        <?= $content ?>
      </div>    
    </section>
  </div>  
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left"> Copyright <?= date('Y')?> Ortiz-Ledesma fACET </p>

        <!-- <p class="pull-right"><?= Yii::powered() ?></p> -->
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>