<?php

use backend\assets\AppAsset;
use yii\helpers\Html;
use app\assets\FontAsset;

AppAsset::register($this);
FontAsset::register($this);

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
    <link rel="icon" href="http://localhost/sgpoc/backend/web/img/logo-sgpoc.png" type="image/ico">
    <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js" crossorigin="anonymous"></script>
    <?php $this->head() ?>
</head>
<body class="hold-transition skin-black-light sidebar-collapse fixed sidebar-mini">
<?php $this->beginBody() ?>
<div class="wrapper">
    <header class="main-header">
        <a href="/sgpoc/backend/web/site/index" class="logo">
            <span class="logo-mini"><img src="http://localhost/sgpoc/backend/web/img/logo-sgpoc.png" alt='logo' width="40" height="40" align="middle" /></span>
            <span class="logo-lg"><img src="http://localhost/sgpoc/backend/web/img/logo-sgpoc.png" alt='logo' width="40" height="40" align="middle" /> SGPOC</span>
        </a>
        <nav class="navbar navbar-static-top">
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button"></a>
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <li class="dropdown user user-menu"> 
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded='false'>
                            <img src="https://cdn2.iconfinder.com/data/icons/ios-7-icons/50/user_male2-512.png" class="user-image" alt='imagen usuario'>
                            <span class="hiddex-xs"><?= Yii::$app->user->identity['Apellido']?></span>
                            <span class="hidden-xs"><?= Yii::$app->user->identity['Nombre']?></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="user-header">
                                <img src="https://cdn2.iconfinder.com/data/icons/ios-7-icons/50/user_male2-512.png"  class="img-circle" alt='imagen usuario'/>
                                <p>
                                    <span class="hiddex-xs"><?= Yii::$app->user->identity['Apellido']?></span>
                                    <span class="hidden-xs"><?= Yii::$app->user->identity['Nombre']?></span>
                                </p>
                            </li>
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="/sgpoc/backend/web/site/logout" class="btn btn-default btn-flat" data-method="post">Salir</a>
                                </div>
                                <div class="pull-right">
                                    <a href="/sgpoc/backend/web/usuarios/perfil" class="btn btn-default btn-flat">Perfil</a>
                                </div>
                            </li>
                        </ul>
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
                        <i class="fa fa-th-large"></i>
                        <span>Familias</span>
                    </a>
                </li>
                <li>
                    <a href="/sgpoc/backend/web/subfamilias/listar">
                        <i class="fa fa-th-list"></i>
                        <span>SubFamilias</span>
                    </a>
                </li>
                <li>
                    <a href="/sgpoc/backend/web/insumos/listar">
                        <i class="fa fa-wrench"></i>
                        <span>Insumos</span>
                    </a>
                </li>
                <li>
                    <a href="/sgpoc/backend/web/items/listar">
                        <i class="fa fa-cog"></i>
                        <span>Items</span>
                    </a>
                </li>
                <li>
                    <a href="/sgpoc/backend/web/elementos-constructivos/listar">
                        <i class="fa fa-cogs"></i>
                        <span>Elementos Constructivos</span>
                    </a>
                </li>
                <li>
                    <a href="/sgpoc/backend/web/computos-metricos/listar">
                        <i class="fa fa-book"></i>
                        <span>Cómputos Métricos</span>
                    </a>
                </li>
                <li>
                    <a href="/sgpoc/backend/web/presupuestos/listar">
                        <i class="fa fa-dollar-sign"></i>
                        <span>Presupuestos</span>
                    </a>
                </li>
                <li>
                    <a href="/sgpoc/backend/web/obras/listar">
                        <i class="fa fa-building"></i>
                        <span>Obras</span>
                    </a>
                </li>
                <li>
                    <a href="/sgpoc/backend/web/lista-precios/listar">
                        <i class="fa fa-file-invoice-dollar"></i>
                        <span>Lista de Precios</span>
                    </a>
                </li>
                <li>
                    <a href="/sgpoc/backend/web/proveedores/listar">
                        <i class="fa fa-truck"></i>
                        <span>Proveedores</span>
                    </a>
                </li>
                
                <?php if(Yii::$app->user->identity['IdRol'] === 1): ?>
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
                <?php endif; ?>
            </ul>
        </section>
    </aside>
    <div class="content-wrapper">
        <section class="content">
        <div class="box-body">
          <?= $content ?>
        </div>    
        </section>
    </div>  

    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b> 1.0
        </div>
        <strong>Copyright &copy; 2018.</strong> Tesis de Grado. Todos los derecho reservados.
    </footer>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>