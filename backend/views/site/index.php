<?php
use backend\assets\IndexAsset;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Modal;

IndexAsset::register($this);

$this->title = 'SGPOC | Home';

?>

<head>
    <title><?php $this->title?></title>
</head>
<body class='content-wrapper'>
    <div class='index-content'>
        <img class='app-logo' src='http://localhost/sgpoc/backend/web/img/logo-sgpoc.png' alt='Logo App'>
        <h2>Bienvenidos a</h2>    
        <h1>SGPOC</h1>
        <p class="desc">Sistema de Gestión para Presupuestación de Obras de Construcción</p>
    </div>
    <div class="footer">
        <a href='http://www.fau.unt.edu.ar' target='_blank'>
            <img class='fau-logo' src='http://localhost/sgpoc/backend/web/img/logoFAU.png' alt='Logo Fau'>
        </a>
    </div>
</body>



