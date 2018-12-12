<?php
use backend\assets\IndexAsset;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use yii\grid\GridView;

IndexAsset::register($this);

$this->title = 'SGPOC | Home';


?>


<div class='index-content'>
<img class='app-logo' src='http://localhost/sgpoc/backend/web/img/logo-sgpoc.png' alt='Logo App' hidden>
<h2 class="main-title" hidden>Bienvenidos a</h2>    
<h1 class="sub-title" hidden>SGPOC</h1>
<p class="desc" hidden>Sistema de Gestión para Presupuestación de Obras de Construcción</p>
</div>
<div class="footer">
<a href='http://www.fau.unt.edu.ar' target='_blank'>
    <img class='fau-logo' src='http://localhost/sgpoc/backend/web/img/logoFAU.png' alt='Logo Fau' hidden>
</a>
</div>

