<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use kartik\sidenav\SideNav;
use yii\helpers\Url;

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
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'SGPOC',
        'brandUrl' => '/sgpoc/backend/web/site/login',
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
            'style' => 'font-family: Verdana'
        ],
    ]);
    

    if(Yii::$app->user->isGuest){
        $menuItems = [ 
            ['label' => 'Acceder', 'url' => '/sgpoc/backend/web/site/login'], 
            ['label' => 'Contaco', 'url' => ''],
        ];  
    }
    else {
        $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Salir (' . Yii::$app->user->identity->Nombre . ')',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>';
        $menuItems[] = ['label' => 'Contaco', 'url' => ''];
    }
    echo Nav::widget([
        'encodeLabels' => false,
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems
    ]);
    NavBar::end();
    ?>

    
    <div class="container">        
        <div class="col-xs-5 col-sm-4 col-lg-3">
            <?=
                SideNav::widget([
                'type' => SideNav::TYPE_DEFAULT,
                'encodeLabels' => false,
                'options' => ['style' => 'font-family: Verdana'],    
                'heading' => false,
                'items' => [
                    [
                        'label' => 'Inicio', 
                        'icon' => 'home', 
                        'url' => Url::to('/sgpoc/backend/web/site/login'), 
                        'type' =>SideNav::TYPE_PRIMARY,                        
                    ],
                    [
                        'label' => 'Familias', 
                        'icon' => 'th', 
                        'url' => Url::to('/sgpoc/backend/web/familias/listar'), 
                        'type' =>SideNav::TYPE_PRIMARY,                        
                    ],
                    [
                        'label' => 'Usuarios', 
                        'icon' => 'user', 
                        'url' => Url::to('/sgpoc/backend/web/usuarios/listar'), 
                        'type' =>SideNav::TYPE_PRIMARY,                        
                    ],
                    [
                        'label' => 'Grupos Trabajo', 
                        'icon' => 'education', 
                        'url' => Url::to('/sgpoc/backend/web/grupos-trabajo/listar'), 
                        'type' =>SideNav::TYPE_PRIMARY,
                    ],
                ],
                ])
             ?>
        </div>   
        <div class="col-xs-7 col-sm-8 col-lg-9">
            <?= $content ?>
        </div>  
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left"> SGPOC <?= date('Y/M/D') ?></p>

        <!-- <p class="pull-right"><?= Yii::powered() ?></p> -->
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>